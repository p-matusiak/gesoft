<x-mail::message>
# Odpowiedź na Twoje zapytanie

Dziękujemy za kontakt z **GESOFT**. Poniżej znajdziesz odpowiedź na Twoje zapytanie:

---

**Twoja wiadomość:**

{{ $contactRequest->message }}

---

**Nasza odpowiedź:**

{{ $reply }}

---

W razie dodatkowych pytań zapraszamy do kontaktu:

- **Email:** biuro@gesoft.pl
- **Telefon:** +48 517 123 374
- **Strona:** [gesoft.pl](https://gesoft.pl)

<x-mail::button :url="'https://gesoft.pl/kontakt'" color="red">
Napisz ponownie
</x-mail::button>

Pozdrawiamy,<br>
**Zespół GESOFT**<br>
*Profesjonalne strony i aplikacje webowe*
</x-mail::message>
