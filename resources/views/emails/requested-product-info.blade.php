<h4>Automātiskais e-pasts no Modern House</h4>
<p>Ir pienākusi jauna ziņa no klienta par - <strong>{{ $data['product-name'] }}.</strong></p>
@if (isset($data['product-variant']))
  <p>Variants: <strong>{{ $data['product-variant'] }}</strong></p>
@endif
<p>Komplektācija: <strong>{{ $data['product-variant-option'] }}</strong></p>
<p>Vārds, uzvārds: <strong>{{ $data['name-surname'] }}</strong></p>
<p>E-pasts: <strong>{{ $data['email'] }}</strong></p>
<p>Kontakttālrunis: <strong>{{ $data['phone-number'] }}</strong></p>
@if (isset($data['company']))
  <p>Uzņēmums: <strong>{{ $data['company'] }}</strong></p>
@endif
@if (isset($data['customers-question']))
  <p>Klienta jautājums: <strong>{{ $data['customers-question'] }}</strong></p>
@endif

<p>Jautājums iesūtīts: {{ gmdate('Y-m-d h:i:s', time() + 3 * 60 * 60) }}</p>
