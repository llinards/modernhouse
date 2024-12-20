<h4>Automatic email from Modern House</h4>
<p>A new message has arrived from the client about - <strong>{{ $data['product-name'] }}.</strong></p>
@if (isset($data['product-variant']))
  <p>Variant: <strong>{{ $data['product-variant'] }}</strong></p>
@endif
<p>Configuration:
  @if($data['product-variant-option'] == 'Basic')
    <strong>Basic</strong>
  @elseif($data['product-variant-option'] == 'Middle')
    <strong>Gray finish</strong>
  @else
    <strong>Full</strong>
  @endif
</p>
<p>First Name: <strong>{{ $data['first-name'] }}</strong></p>
<p>Last Name: <strong>{{ $data['last-name'] }}</strong></p>
<p>Email: <strong>{{ $data['email'] }}</strong></p>
<p>Contact Phone: <strong>{{ $data['phone-number'] }}</strong></p>
@if (isset($data['company']))
  <p>Company: <strong>{{ $data['company'] }}</strong></p>
@endif
@if (isset($data['customers-question']))
  <p>Customer's Question: <strong>{{ $data['customers-question'] }}</strong></p>
@endif
@if (isset($data['customer-agrees-for-data-processing']))
  <p>The client has given consent for data processing and storage on the website.</p>
@endif

<p>Question submitted: {{ gmdate('Y-m-d h:i:s', time() + 3 * 60 * 60) }}</p>
