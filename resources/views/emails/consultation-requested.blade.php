<x-layouts.email title="Konsultācijas pieprasījums">
  <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
    @if (!empty($data['product-variant']))
      <tr>
        <td style="padding:6px 0 16px 0; color:#333333; font-size:14px;">Variants: <strong>{{ $data['product-variant'] }}</strong></td>
      </tr>
    @endif
    <tr>
      <td style="padding:6px 0; color:#333333; font-size:14px;">Vārds: <strong>{{ $data['first-name'] }}</strong></td>
    </tr>
    <tr>
      <td style="padding:6px 0; color:#333333; font-size:14px;">Uzvārds: <strong>{{ $data['last-name'] }}</strong></td>
    </tr>
    <tr>
      <td style="padding:6px 0; color:#333333; font-size:14px;">E-pasts: <strong>{{ $data['email'] }}</strong></td>
    </tr>
    <tr>
      <td style="padding:6px 0; color:#333333; font-size:14px;">Kontakttālrunis: <strong>{{ $data['phone-number'] }}</strong></td>
    </tr>
    @if (!empty($data['customer-agrees-for-data-processing']))
      <tr>
        <td style="padding:16px 0 6px 0; color:#919191; font-size:12px;">
          Klients mājaslapā ir devis apstiprinājumu datu apstrādei un uzglabāšanai.
        </td>
      </tr>
    @endif
    <tr>
      <td style="padding:6px 0; color:#919191; font-size:12px;">
        Iesūtīts: {{ gmdate('Y-m-d H:i:s', time() + 3 * 60 * 60) }}
      </td>
    </tr>
  </table>
</x-layouts.email>
