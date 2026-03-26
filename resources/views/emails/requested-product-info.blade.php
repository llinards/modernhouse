<x-layouts.email title="Jauna ziņa no klienta par — {{ $data['product-name'] }}">
  <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
    @if (!empty($data['product-variant']))
      <tr>
        <td style="padding:6px 0; color:#333333; font-size:14px;">Variants: <strong>{{ $data['product-variant'] }}</strong></td>
      </tr>
    @endif
    @if (!empty($data['product-variant-option']))
      <tr>
        <td style="padding:6px 0; color:#333333; font-size:14px;">Komplektācija:
          <strong>
            @if($data['product-variant-option'] == 'Basic')
              Bāzes
            @elseif($data['product-variant-option'] == 'Middle')
              Pelēkā apdare
            @else
              Pilna
            @endif
          </strong>
        </td>
      </tr>
    @endif
    <tr>
      <td style="padding:16px 0 6px 0; border-top:1px solid #e5e5e5; color:#333333; font-size:14px;">Vārds: <strong>{{ $data['first-name'] }}</strong></td>
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
    @if (!empty($data['company']))
      <tr>
        <td style="padding:6px 0; color:#333333; font-size:14px;">Uzņēmums: <strong>{{ $data['company'] }}</strong></td>
      </tr>
    @endif
    @if (!empty($data['customers-question']))
      <tr>
        <td style="padding:16px 0 6px 0; color:#333333; font-size:14px;">
          <strong>Klienta jautājums:</strong><br>
          {{ $data['customers-question'] }}
        </td>
      </tr>
    @endif
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
