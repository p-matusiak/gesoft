<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

        $contactRequest->update([
            'status' => $request->status,
        ]);

        return response()->json([
            'message' => 'Status zaktualizowany.',
            'data' => $contactRequest,
        ]);
    }

    public function stats(): JsonResponse
    {
        $total = ContactRequest::count();
        $new = ContactRequest::where('status', 'new')->count();
        $read = ContactRequest::where('status', 'read')->count();
        $responded = ContactRequest::where('status', 'responded')->count();

        $recentRequests = ContactRequest::orderByDesc('created_at')
            ->take(5)
            ->get();

        return response()->json([
            'data' => [
                'total' => $total,
                'new' => $new,
                'read' => $read,
                'responded' => $responded,
                'recent' => $recentRequests,
            ],
        ]);
    }
}
