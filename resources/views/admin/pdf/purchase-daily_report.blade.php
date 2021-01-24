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

	  <h3 align="center" style="margin:0px">Daily Purchase Report ({{ date('d M, Y', strtotime($start_date)) }} - {{ date('d M, Y', strtotime($end_date)) }})</h3>
	  <br>


	  <table border="1" style="border-collapse: collapse;" width="100%" cellpadding="2">
	    <thead>
	      <tr class="text-center">
	        <th>SL</th>
	        <th>Supplier Name</th>
	        <th>Category Name</th>
	        <th>Product Name</th>
	        <th>Purchase No</th>
	        <th>Date</th>
	        <th>Quantity</th>
	        <th>Unit Price</th>
	        <th>Buying Price</th>
	      </tr>
	    </thead>
	    <tbody>
	      @php $total_sum = '0';  @endphp
	      @foreach($allData as $key=>$value)
	        <tr class="text-center">
	          <td>{{ $key+1 }}</td>
	          <td>{{ $value->supplier->name }}</td>
	          <td>{{ $value->category->name }}</td>
	          <td>{{ $value->product->name }}</td>
	          <td>{{ $value->purchase_no }}</td>
	          <td>{{ date('d M, Y', strtotime($value->date)) }}</td>
	          <td align="right">{{ $value->quantity }}</td>
	          <td align="right">{{ $value->unit_price }}</td>
	          <td align="right">{{ $value->buying_price }}</td>
	        </tr>
	        @php $total_sum += $value->buying_price; @endphp
	      @endforeach
	      <tr>
	        <td align="right" colspan="8"><b>Total:</b></td>
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