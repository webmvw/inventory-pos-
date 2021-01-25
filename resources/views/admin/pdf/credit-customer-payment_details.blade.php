<!DOCTYPE html>
<html>
<head>
	<title>Cradit Customer Payment Details</title>

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

	  <h3 align="center" style="margin:0px">Crdit Customer Payment Details - Invoice No #{{ $payments->invoice->invoice_no }} ({{ date('d-m-Y', strtotime($payments->invoice->date)) }})</h3>
	  <br>

	    <b><u>Customer Information</u></b>
	    <p>
	    	<b>Name:</b> {{ $payments->customer->name }}<br>
	    	<b>Mobile:</b> {{ $payments->customer->phone }}<br>
	    	<b>Address:</b> {{ $payments->customer->address }}
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
          @php
            $invoice_details = App\Models\InvoiceDetail::where('invoice_id', $payments->invoice_id)->get(); 
            $total_sum = '0';  
          @endphp
          @foreach($invoice_details as $key=>$value)
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
            <td align="right">{{ $payments->discount_amount }}</td>
          </tr>
          <tr>
            <td align="right" colspan="5">Paid Amount: </td>
            <td align="right">{{ $payments->paid_amount }}</td>
          </tr>
          <tr>
            <td align="right" colspan="5">Due Amount:</td>
            <td align="right">{{ $payments->due_amount }}</td>
          </tr>
          <tr>
            <td align="right" colspan="5"><b>Grand Total:</b></td>
            <td align="right"><b>{{ $payments->total_amount }}</b></td>
          </tr>
        </tbody>
      </table>

      <br>
      <p>Payment Details:</p>
      <table border="1" style="border-collapse: collapse;width: 40%">
        <thead>
          <tr>
            <th>SL</th>
            <th>Date</th>
            <th>Payment</th>
          </tr>
        </thead>
      
        <tbody>
          @php
              $payment_details = App\Models\PaymentDetail::where('invoice_id', $payments->invoice_id)->get(); 
              $total_sum = '0';  
            @endphp
            @foreach($payment_details as $key=>$value)
              <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ date('F j, Y', strtotime($value->date)) }}</td>
                <td align="right">{{ $value->current_paid_amount }}</td>
              </tr>
               @php $total_sum += $value->current_paid_amount; @endphp
            @endforeach
            <tr>
              <td align="right" colspan="2">Total:</td>
              <td align="right">{{ $total_sum }}</td>
            </tr>
        </tbody>
    </table>
    <br>

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