<!DOCTYPE html>
<html>
<head>
	<title>Category Stock Report</title>

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

	  <h3 align="center" style="margin:0px">Stock Report (According to Category Criteria)</h3>
	  <br>

	  <p><b>Category Name:</b> {{ $category_name }}</p>
	  <table border="1" style="border-collapse: collapse;" width="100%" cellpadding="2">
	    <thead>
          <tr>
            <th>SL</th>
            <th>Supplier Name</th>
            <th>Product</th>
            <th>In.Qty</th>
            <th>Out.Qty</th>
            <th>Stock</th>>
          </tr>
          </thead>
          <tbody>
            @foreach($products as $key=>$value)
            	@php 
	              $buying_total = App\Models\Purchase::where('category_id', $value->category_id)->where('product_id', $value->id)->where('status', '1')->sum('quantity');
	              $selling_total = App\Models\InvoiceDetail::where('category_id', $value->category_id)->where('product_id', $value->id)->where('status', '1')->sum('selling_qty');
	            @endphp
              <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $value->supplier->name }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $buying_total }}</td>
                <td>{{ $selling_total }}</td>
                <td>{{ $value->quantity }} {{ $value->unit->name }}</td>
              </tr>
          @endforeach
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