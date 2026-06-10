<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ClientReplyMail;
use App\Models\ContactRequest;
use App\Services\SmsApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RequestController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = ContactRequest::query()->orderByDesc('created_at');

        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $requests = $query->paginate(15);

        return response()->json($requests);
    }

    public function show(ContactRequest $contactRequest): JsonResponse
    {
        return response()->json(['data' => $contactRequest]);
    }

    public function update(Request $request, ContactRequest $contactRequest): JsonResponse
    {
        $request->validate([
            'status' => ['required', 'in:new,read,responded'],
        ]);

        $contactRequest->update(['status' => $request->status]);

        return response()->json([
            'message' => 'Status zaktualizowany.',
            'data' => $contactRequest,
        ]);
    }

    public function reply(Request $request, ContactRequest $contactRequest): JsonResponse
    {
        $request->validate([
            'reply' => ['required', 'string', 'min:5', 'max:5000'],
        ], [
            'reply.required' => 'Treść odpowiedzi jest wymagana.',
            'reply.min'      => 'Odpowiedź musi zawierać co najmniej 5 znaków.',
            'reply.max'      => 'Odpowiedź nie może przekraczać 5000 znaków.',
        ]);

        $emailSent = false;
        $smsSent = false;

        try {
            Mail::to($contactRequest->email)->send(new ClientReplyMail($contactRequest, $request->reply));
            $emailSent = true;
        } catch (\Exception $e) {
            Log::error('Failed to send reply email', [
                'contact_request_id' => $contactRequest->id,
                'error' => $e->getMessage(),
            ]);
        }

        if ($contactRequest->phone) {
            try {
                $sms = app(SmsApiService::class);
                $smsSent = $sms->send(
                    $contactRequest->phone,
                    'GESOFT: Odpowiedzieliśmy na Twoje zapytanie. Sprawdź skrzynkę email: ' . $contactRequest->email
                );
            } catch (\Exception $e) {
                Log::error('Failed to send reply SMS', [
                    'contact_request_id' => $contactRequest->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        if (!$emailSent) {
            return response()->json([
                'message' => 'Nie udało się wysłać emaila. Sprawdź konfigurację SMTP.',
            ], 500);
        }

        $contactRequest->update([
            'admin_reply' => $request->reply,
            'replied_at'  => now(),
            'status'      => 'responded',
        ]);

        return response()->json([
            'message' => 'Odpowiedź wysłana pomyślnie.' . ($contactRequest->phone && !$smsSent ? ' (SMS nie został wysłany — sprawdź konfigurację SMSAPI)' : ''),
            'data'    => $contactRequest->fresh(),
        ]);
    }

    public function stats(): JsonResponse
    {
        $total = ContactRequest::count();
        $new = ContactRequest::where('status', 'new')->count();
        $read = ContactRequest::where('status', 'read')->count();
        $responded = ContactRequest::where('status', 'responded')->count();

        $recentRequests = ContactRequest::orderByDesc('created_at')->take(5)->get();

        return response()->json([
            'data' => [
                'total'   => $total,
                'new'     => $new,
                'read'    => $read,
                'responded' => $responded,
                'recent'  => $recentRequests,
            ],
        ]);
    }
}
