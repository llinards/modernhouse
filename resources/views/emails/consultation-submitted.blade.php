<h4>Automatic email from Modern House</h4>
<p>A new message has arrived. Client has requested consultation.</p>
<p>Are you looking to buy in the 3 months, 6 months, 1 year? <strong>{{$data['question_one']}}</strong></p>
<p>What is your budget? <strong>{{$data['question_two']}}</strong></p>
<p>Which one of the products are you interested in? <strong>{{$data['product-variant']}}</strong></p>
<p>How can we help? <strong>{{$data['question_three']}}</strong></p>
<p>First Name: <strong>{{ $data['first-name'] }}</strong></p>
<p>Last Name: <strong>{{ $data['last-name'] }}</strong></p>
<p>Email: <strong>{{ $data['email'] }}</strong></p>
<p>Contact Phone: <strong>{{ $data['phone-number'] }}</strong></p>
@if (isset($data['company']))
  <p>Company: <strong>{{ $data['company'] }}</strong></p>
@endif
@if (isset($data['customer-agrees-for-data-processing']))
  <p>The client has given consent for data processing and storage on the website.</p>
@endif

<p>Question submitted: {{ gmdate('Y-m-d h:i:s', time() + 3 * 60 * 60) }}</p>
