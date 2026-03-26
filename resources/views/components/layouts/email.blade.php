@props(['title'])
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="lv">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="format-detection" content="telephone=no">
  <title>{{ $title }}</title>
  <style type="text/css">
    body, table, td { font-family: Arial, Helvetica, sans-serif; }
    img { border: 0; outline: none; text-decoration: none; }
    @media only screen and (max-width: 600px) {
      .email-container { width: 100% !important; }
      .email-content { padding: 20px 16px !important; }
    }
  </style>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f4; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;">
  <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4;">
    <tr>
      <td align="center" style="padding:30px 10px;">
        <table class="email-container" role="presentation" width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-collapse:collapse;">

          {{-- Header with logo --}}
          <tr>
            <td align="center" style="padding:32px 20px; border-bottom:1px solid #e5e5e5;">
              <img src="{{ asset('storage/logo/logo-black.png') }}" alt="Modern House" width="120" style="display:block;">
            </td>
          </tr>

          {{-- Title --}}
          <tr>
            <td style="padding:28px 40px 0 40px;">
              <h2 style="margin:0; font-size:20px; font-weight:bold; color:#000000; line-height:1.4;">{{ $title }}</h2>
            </td>
          </tr>

          {{-- Content --}}
          <tr>
            <td class="email-content" style="padding:20px 40px 32px 40px; font-size:14px; line-height:1.8; color:#333333;">
              {{ $slot }}
            </td>
          </tr>

          {{-- Footer --}}
          <tr>
            <td align="center" style="padding:20px 40px; background-color:#000000;">
              <p style="margin:0; font-size:12px; color:#999999; line-height:1.6;">
                &copy; {{ date('Y') }} Modern House &middot; info@modern-house.lv
              </p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>
</html>
