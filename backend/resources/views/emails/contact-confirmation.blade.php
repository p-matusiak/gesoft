<!DOCTYPE html>
<html lang="pl" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Potwierdzenie otrzymania zapytania — GESOFT</title>
</head>
<body style="margin:0;padding:0;background-color:#f1f5f9;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;color:#1e293b;">

  <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f1f5f9;padding:40px 16px;">
    <tr>
      <td align="center">

        <!-- Card -->
        <table width="600" cellpadding="0" cellspacing="0" border="0" style="max-width:600px;width:100%;background:#ffffff;border-radius:10px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,0.08);">

          <!-- ── HEADER / LOGO ── -->
          <tr>
            <td style="padding:28px 40px 24px 40px;border-bottom:1px solid #e2e8f0;">
              <img src="https://gesoft.pl/logo-email-v2.png"
                   srcset="https://gesoft.pl/logo-email-v2@2x.png 2x"
                   width="190" height="50"
                   alt="GESOFT"
                   style="display:block;border:0;outline:none;text-decoration:none;">
            </td>
          </tr>

          <!-- ── RED ACCENT BAR ── -->
          <tr>
            <td height="4" style="height:4px;background:linear-gradient(90deg,#e8001d,#7a000c);font-size:0;line-height:0;">&nbsp;</td>
          </tr>

          <!-- ── MAIN CONTENT ── -->
          <tr>
            <td style="padding:36px 40px 0 40px;">

              <h1 style="margin:0 0 8px 0;font-size:22px;font-weight:700;color:#111111;">Dziękujemy za kontakt!</h1>
              <p style="margin:0 0 24px 0;font-size:15px;line-height:1.6;color:#475569;">
                Twoja wiadomość dotarła do nas. Potwierdzamy jej otrzymanie i skontaktujemy się z Tobą <strong>w ciągu 24 godzin</strong>.
              </p>

              <!-- Message box -->
              <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:28px;">
                <tr>
                  <td style="background:#f8fafc;border-left:4px solid #d7241b;border-radius:0 6px 6px 0;padding:18px 20px;">
                    <p style="margin:0 0 8px 0;font-size:11px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#94a3b8;">Treść Twojego zapytania</p>
                    <p style="margin:0;font-size:14px;line-height:1.7;color:#334155;white-space:pre-wrap;">{{ $contactRequest->message }}</p>
                  </td>
                </tr>
              </table>

              <p style="margin:0 0 24px 0;font-size:15px;line-height:1.6;color:#475569;">
                Jeśli sprawa jest pilna, skontaktuj się z nami bezpośrednio:
              </p>

              <!-- Contact details -->
              <table cellpadding="0" cellspacing="0" border="0" style="margin-bottom:32px;">
                <tr>
                  <td style="padding:0 0 10px 0;font-size:14px;color:#475569;">
                    <span style="display:inline-block;width:20px;text-align:center;">&#9993;</span>
                    &nbsp;<a href="mailto:biuro@gesoft.pl" style="color:#d7241b;text-decoration:none;font-weight:600;">biuro@gesoft.pl</a>
                  </td>
                </tr>
                <tr>
                  <td style="font-size:14px;color:#475569;">
                    <span style="display:inline-block;width:20px;text-align:center;">&#128222;</span>
                    &nbsp;<a href="tel:+48517123374" style="color:#d7241b;text-decoration:none;font-weight:600;">+48 517 123 374</a>
                  </td>
                </tr>
              </table>

              <!-- CTA button -->
              <table cellpadding="0" cellspacing="0" border="0" style="margin-bottom:36px;">
                <tr>
                  <td align="center" style="background:#d7241b;border-radius:6px;">
                    <a href="https://gesoft.pl"
                       style="display:inline-block;padding:13px 32px;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:14px;font-weight:700;color:#ffffff;text-decoration:none;border-radius:6px;letter-spacing:0.02em;">
                      Wróć na stronę GESOFT
                    </a>
                  </td>
                </tr>
              </table>

            </td>
          </tr>

          <!-- ── FOOTER ── -->
          <tr>
            <td style="background:#f8fafc;border-top:1px solid #e2e8f0;padding:24px 40px;border-radius:0 0 10px 10px;">
              <p style="margin:0 0 4px 0;font-size:13px;color:#64748b;">
                Pozdrawiamy,<br>
                <strong style="color:#111111;">Zespół GESOFT</strong>
              </p>
              <p style="margin:8px 0 0 0;font-size:12px;color:#94a3b8;">
                Profesjonalne strony i aplikacje webowe &nbsp;|&nbsp;
                <a href="https://gesoft.pl" style="color:#94a3b8;text-decoration:none;">gesoft.pl</a>
              </p>
            </td>
          </tr>

        </table>
        <!-- /Card -->

        <!-- Bottom note -->
        <p style="margin:20px 0 0 0;font-size:12px;color:#94a3b8;text-align:center;">
          Wiadomość wysłana automatycznie — prosimy na nią nie odpowiadać.
        </p>

      </td>
    </tr>
  </table>

</body>
</html>
