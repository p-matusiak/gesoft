<!DOCTYPE html>
<html lang="pl" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Nowe Zapytanie — GESOFT</title>
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
            <td style="padding:32px 40px 0 40px;">

              <h1 style="margin:0 0 6px 0;font-size:22px;font-weight:700;color:#111111;">Nowe zapytanie ze strony</h1>
              <p style="margin:0 0 24px 0;font-size:14px;color:#64748b;">
                {{ $contactRequest->created_at->format('d.m.Y \g\o\d\z\. H:i') }}
              </p>

              <!-- Client details -->
              <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:24px;background:#f8fafc;border-radius:6px;overflow:hidden;">
                <tr>
                  <td style="padding:14px 18px;border-bottom:1px solid #e2e8f0;">
                    <span style="font-size:11px;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;color:#94a3b8;">Email</span><br>
                    <a href="mailto:{{ $contactRequest->email }}" style="font-size:15px;font-weight:600;color:#d7241b;text-decoration:none;">{{ $contactRequest->email }}</a>
                  </td>
                </tr>
                @if($contactRequest->phone)
                <tr>
                  <td style="padding:14px 18px;">
                    <span style="font-size:11px;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;color:#94a3b8;">Telefon</span><br>
                    <a href="tel:{{ $contactRequest->phone }}" style="font-size:15px;font-weight:600;color:#d7241b;text-decoration:none;">{{ $contactRequest->phone }}</a>
                  </td>
                </tr>
                @endif
              </table>

              <!-- Message box -->
              <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:32px;">
                <tr>
                  <td style="background:#f8fafc;border-left:4px solid #d7241b;border-radius:0 6px 6px 0;padding:18px 20px;">
                    <p style="margin:0 0 8px 0;font-size:11px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#94a3b8;">Treść zapytania</p>
                    <p style="margin:0;font-size:14px;line-height:1.7;color:#334155;white-space:pre-wrap;">{{ $contactRequest->message }}</p>
                  </td>
                </tr>
              </table>

              <!-- CTA button -->
              <table cellpadding="0" cellspacing="0" border="0" style="margin-bottom:36px;">
                <tr>
                  <td align="center" style="background:#d7241b;border-radius:6px;">
                    <a href="https://gesoft.pl/admin/requests"
                       style="display:inline-block;padding:13px 32px;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:14px;font-weight:700;color:#ffffff;text-decoration:none;border-radius:6px;letter-spacing:0.02em;">
                      Otwórz panel admina
                    </a>
                  </td>
                </tr>
              </table>

            </td>
          </tr>

          <!-- ── FOOTER ── -->
          <tr>
            <td style="background:#f8fafc;border-top:1px solid #e2e8f0;padding:20px 40px;border-radius:0 0 10px 10px;">
              <p style="margin:0;font-size:12px;color:#94a3b8;">
                Powiadomienie automatyczne systemu GESOFT &nbsp;|&nbsp;
                <a href="https://gesoft.pl" style="color:#94a3b8;text-decoration:none;">gesoft.pl</a>
              </p>
            </td>
          </tr>

        </table>

      </td>
    </tr>
  </table>

</body>
</html>
