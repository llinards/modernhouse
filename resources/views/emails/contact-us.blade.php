<h4>Automātiskais e-pasts no Modern House</h4>
<p>Ir pienākusi jauna ziņa.</p>
<p>Vārds: <strong>{{ $data['first-name'] }}</strong></p>
<p>Uzvārds: <strong>{{ $data['last-name'] }}</strong></p>
<p>E-pasts: <strong>{{ $data['email'] }}</strong></p>
<p>Kontakttālrunis: <strong>{{ $data['phone-number'] }}</strong></p>
@if (isset($data['company']))
  <p>Uzņēmums: <strong>{{ $data['company'] }}</strong></p>
@endif
@if (isset($data['customers-question']))
  <p>Klienta jautājums: <strong>{{ $data['customers-question'] }}</strong></p>
@endif
@if (isset($data['customer-agrees-for-data-processing']))
  <p>Klients mājaslapā ir devis apstiprinājumu datu apstrādei un uzglabāšanai.</p>
@endif

<p>Jautājums iesūtīts: {{ gmdate('Y-m-d h:i:s', time() + 3 * 60 * 60) }}</p>
