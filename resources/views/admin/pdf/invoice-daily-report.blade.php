<!DOCTYPE html>
<html>
<head>
	<title>Daily Invoice Report</title>

</head>
<body>

	<table width="100%">
		<tr>
			<td>
				<img src="{{ public_path('img/pos.png') }}" width="100px"/>
			</td>
			<td>
				<h2 align="right" style="color:green;margin:0px">Inventory Management System</h2>
				<p align="right" style="margin:0px"><b>Phone:</b> 01745874587<br>
				<b>Email:</b> masudrana.bbpi@gmail.com<br>
				<b>Website:</b> www.webmvwit.com<br>
				<b>Address:</b> Bilash Super Market, Mirpur-10, Dhaka.</p>
			</td>
		</tr>
	</table>

	<hr style="width: 100%; height: 2px; background: green">

	  <h3 align="center" style="margin:0px">Daily Invoice Report ({{ date('d M, Y', strtotime($start_date)) }} - {{ date('d M, Y', strtotime($end_date)) }})</h3>
	  <br>


	  <table border="1" style="border-collapse: collapse;" width="100%" cellpadding="2">
	    <thead>
	      <tr class="text-center">
	        <th>SL</th>
	        <th>Customer Name</th>
	        <th>Invoice No</th>
	        <th>Date</th>
	        <th>Description</th>
	        <th>Amount</th>
	      </tr>
	    </thead>
	    <tbody>
	      @php $total_sum = '0';  @endphp
	      @foreach($allData as $key=>$value)
	        <tr class="text-center">
	          <td>{{ $key+1 }}</td>
	          <td>{{ $value->payment->customer->name }}</td>
	          <td>{{ $value->invoice_no }}</td>
	          <td>{{ date('d M, Y', strtotime($value->date)) }}</td>
	          <td>{{ $value->description }}</td>
	          <td align="right">{{ $value->payment->total_amount }}</td>
	        </tr>
	        @php $total_sum += $value->payment->total_amount; @endphp
	      @endforeach
	      <tr>
	        <td align="right" colspan="5"><b>Total:</b></td>
	        <td align="right"><b>{{ $total_sum }}<b></td>
	      </tr>
	    </tbody>
	  </table>

	  @php 
	  	$date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
	  @endphp
	  <p>Printing Time: {{ $date->format('F j, Y, g:i a') }}</p>

	  <br>
	  <br>
	  <table width="100%">
	  	<tr>
	  		<td width="50%" align="left"><b><u></u></b></td>
	  		<td width="50%" align="right"><b><u>Owner Signature</u></b></td>
	  	</tr>
	  </table>

</body>
</html>