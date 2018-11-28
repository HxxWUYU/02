<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Test Email</title>
</head>
<body>
	<div style="width:600px;padding:15px;margin:0 auto">
	<div style="text-align:center; width:200px; margin:0 auto;">
		
	</div>

	<h2 style='color:#d23600'>Hello <?php user()->fullname?>,</h2>
	<p>Your order confirmation details: <span>#<?php echo $data['order_no']?></span></p>
	<table cellpadding="5" cellspacing="5" border="0" width="600" style="border:1px solid #0a0a0a;">
		<tr style="background-color: black; color:white;">
			<th style="text-align: left;">Product Name</th>
			<th>Unit Price</th>
			<th>Quantity</th>
			<th>Total</th>
		</tr>
		<?php 
		foreach($data['product'] as $item):
		?>

			<tr>
				<td width="400"><?= $item['name']?></td>
				<td width="100"><?= $item['price']?></td>
				<td width="50"><?= $item['quantity']?></td>
				<td width="50">$<?= $item['total']?></td>
			</tr>
		<?php endforeach;?>
	</table>
	<h4>Total Amount: $<?=$data['total']?></h4>
</div>
</body>
</html>

