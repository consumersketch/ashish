<table id="result_table" class="display" border="1" cellspacing="0" width="100%">
	<tr>
		<th>Invoice Num</th>
		<th>Invoice Date</th>
		<th>Product</th>
		<th>Qty</th>
		<th>Price</th>
		<th>Total</th>
	</tr>

	<?php
	//print message if no record found
	if(empty($result)){
		?>
		<tr>
			<td colspan="6">No Record found.</td>
		</tr>
		<?php
	}else{
		// Display all results
		foreach($result as $row){
			
			?>
			<tr>
				<td><?php echo $row['invoice_num'];?></td>
				<td><?php echo $row['invoice_date']; ?></td>
				<td><?php echo $row['product_description']; ?></td>
				<td><?php echo $row['qty']; ?></td>
				<td><?php echo $row['price']; ?></td>
				<td><?php echo $row['qty']*$row['price']; ?></td>
			</tr>
			<?php
		}
	}
	?>

</table>
