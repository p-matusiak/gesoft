<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Models\ContactRequest;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    public function store(StoreContactRequest $request): JsonResponse
    {
        $contactRequest = ContactRequest::create($request->validated());

        return response()->json([
            'message' => 'Dziękujemy za wiadomość! Skontaktujemy się wkrótce.',
            'data' => $contactRequest,
        ], 201);
    }

    public function services(): JsonResponse
    {
        $services = [
            [
                'id' => 1,
                'title' => 'Strony internetowe',
                'description' => 'Nowoczesne, responsywne strony internetowe dopasowane do Twoich potrzeb.',
                'icon' => 'globe',
            ],
            [
                'id' => 2,
                'title' => 'Aplikacje webowe',
                'description' => 'Zaawansowane aplikacje webowe z wykorzystaniem Laravel i Vue.js.',
                'icon' => 'code',
            ],
            [
                'id' => 3,
                'title' => 'Sklepy internetowe',
                'description' => 'Kompleksowe rozwiązania e-commerce z integracją płatności.',
                'icon' => 'shopping-cart',
            ],
            [
                'id' => 4,
                'title' => 'Systemy CRM/ERP',
                'description' => 'Dedykowane systemy do zarządzania firmą i relacjami z klientami.',
                'icon' => 'database',
            ],
            [
                'id' => 5,
                'title' => 'Integracje API',
                'description' => 'Integracje z zewnętrznymi systemami i usługami przez API.',
                'icon' => 'plug',
            ],
            [
                'id' => 6,
                'title' => 'Wsparcie i utrzymanie',
                'description' => 'Profesjonalne wsparcie techniczne i utrzymanie systemów.',
                'icon' => 'headset',
            ],
        ];

        return response()->json(['data' => $services]);
    }

    public function portfolio(): JsonResponse
    {
        $portfolio = [
            [
                'id' => 1,
                'title' => 'System CRM dla firmy logistycznej',
                'category' => 'crm',
                'description' => 'Kompleksowy system zarządzania klientami i zamówieniami.',
                'image' => '/images/portfolio/crm.jpg',
                'technologies' => ['Laravel', 'Vue.js', 'MySQL'],
            ],
            [
                'id' => 2,
                'title' => 'Sklep internetowy z meblami',
                'category' => 'ecommerce',
                'description' => 'Nowoczesny sklep e-commerce z konfiguratorem produktów.',
                'image' => '/images/portfolio/ecommerce.jpg',
                'technologies' => ['Laravel', 'Vue.js', 'Stripe'],
            ],
            [
                'id' => 3,
                'title' => 'Portal dla branży medycznej',
                'category' => 'webapp',
                'description' => 'System rezerwacji wizyt i zarządzania pacjentami.',
                'image' => '/images/portfolio/medical.jpg',
                'technologies' => ['Laravel', 'Vue.js', 'Redis'],
            ],
            [
                'id' => 4,
                'title' => 'Strona korporacyjna',
                'category' => 'website',
                'description' => 'Elegancka strona firmowa z systemem CMS.',
                'image' => '/images/portfolio/corporate.jpg',
                'technologies' => ['Laravel', 'TailwindCSS'],
            ],
            [
                'id' => 5,
                'title' => 'Aplikacja do zarządzania projektami',
                'category' => 'webapp',
                'description' => 'Narzędzie do zarządzania projektami w metodyce Agile.',
                'image' => '/images/portfolio/project.jpg',
                'technologies' => ['Laravel', 'Vue.js', 'WebSockets'],
            ],
            [
                'id' => 6,
                'title' => 'System rezerwacji online',
                'category' => 'webapp',
                'description' => 'Platforma rezerwacji dla hotelu z integracją kalendarza.',
                'image' => '/images/portfolio/booking.jpg',
                'technologies' => ['Laravel', 'Vue.js', 'Google API'],
            ],
        ];

        return response()->json(['data' => $portfolio]);
    }
}
