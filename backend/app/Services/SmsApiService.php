<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsApiService
{
    public function send(string $phone, string $message): bool
    {
        $token = config('services.smsapi.token');

        if (!$token) {
            Log::warning('SMSAPI: token not configured, SMS not sent', ['phone' => $phone]);
            return false;
        }

        $phone = $this->normalizePhone($phone);

        try {
            $response = Http::withToken($token)
                ->asForm()
                ->post('https://api.smsapi.pl/sms.do', [
                    'from'    => config('services.smsapi.sender', 'GESOFT'),
                    'to'      => $phone,
                    'message' => $message,
                    'format'  => 'json',
                ]);

            if ($response->failed()) {
                Log::error('SMSAPI: failed to send SMS', [
                    'phone'  => $phone,
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
                return false;
            }

            $data = $response->json();

            if (isset($data['error'])) {
                Log::error('SMSAPI: API error', ['phone' => $phone, 'error' => $data]);
                return false;
            }

            Log::info('SMSAPI: SMS sent', ['phone' => $phone]);
            return true;
        } catch (\Exception $e) {
            Log::error('SMSAPI: exception', ['phone' => $phone, 'message' => $e->getMessage()]);
            return false;
        }
    }

    private function normalizePhone(string $phone): string
    {
        $phone = preg_replace('/[\s\-\(\)]/', '', $phone);

        if (str_starts_with($phone, '0')) {
            return '+48' . substr($phone, 1);
        }

        if (preg_match('/^\d{9}$/', $phone)) {
            return '+48' . $phone;
        }

        return $phone;
    }
}
