<!DOCTYPE html>
<html>
<head>
	<title>Inventory Management System</title>

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

	  <h3 align="center" style="margin:0px">Invoice No #{{ $invoices->invoice_no }} ({{ date('d-m-Y', strtotime($invoices->date)) }})</h3>
	  <br>

	    @php
	      $payment = App\Models\Payment::where('invoice_id', $invoices->id)->first();
	    @endphp

	    <b><u>Customer Information</u></b>
	    <p>
	    	<b>Name:</b> {{ $payment->customer->name }}<br>
	    	<b>Mobile:</b> {{ $payment->customer->phone }}<br>
	    	<b>Address:</b> {{ $payment->customer->address }}
	    </p>
	    <br>

	  <table border="1" style="border-collapse: collapse;" width="100%" cellpadding="2">
	    <thead>
	      <tr class="text-center">
	        <th>SL</th>
	        <th>Category</th>
	        <th>Product Name</th>
	        <th>Quantity</th>
	        <th>Unit Price</th>
	        <th>Total Price</th>
	      </tr>
	    </thead>
	    <tbody>
	      @php $total_sum = '0';  @endphp
	      @foreach($invoices['invoiceDetail'] as $key=>$value)
	        <tr class="text-center">
	          <td>{{ $key+1 }}</td>
	          <td>{{ $value->category->name }}</td>
	          <td>{{ $value->product->name }}</td>
	          <td align="right">{{ $value->selling_qty }}</td>
	          <td align="right">{{ $value->unit_price }}</td>
	          <td align="right">{{ $value->selling_price }}</td>
	        </tr>
	        @php $total_sum += $value->selling_price; @endphp
	      @endforeach
	      <tr>
	        <td align="right" colspan="5"><b>Total:</b></td>
	        <td align="right"><b>{{ $total_sum }}<b></td>
	      </tr>
	      <tr>
	        <td align="right" colspan="5">Discount Amount: </td>
	        <td align="right">{{ $payment->discount_amount }}</td>
	      </tr>
	      <tr>
	        <td align="right" colspan="5">Paid Amount: </td>
	        <td align="right">{{ $payment->paid_amount }}</td>
	      </tr>
	      <tr>
	        <td align="right" colspan="5">Due Amount:</td>
	        <td align="right">{{ $payment->due_amount }}</td>
	      </tr>
	      <tr>
	        <td align="right" colspan="5"><b>Grand Total:</b></td>
	        <td align="right"><b>{{ $payment->total_amount }}</b></td>
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
	  		<td width="50%" align="left"><b><u>Customer Signature</u></b></td>
	  		<td width="50%" align="right"><b><u>Seller Signature</u></b></td>
	  	</tr>
	  </table>

</body>
</html>