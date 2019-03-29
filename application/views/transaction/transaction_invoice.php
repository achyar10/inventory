<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title ?></title>
	<style type="text/css">
		body {
			font-family: sans-serif;
		}
		@page {
			margin-top: 1cm;
			margin-bottom: 0.2cm;
			margin-left: 1.5cm; 
			margin-right: 1.5cm;
		} 
		table	{
			border-collapse: collapse;
			font-size: 11pt;
			border-width: thick;
		}
		td{
			height: 30px;
			padding-right: 10px;
			padding-left: 10px;
		}
		th{
			height: 40px;
			color: #fff;
		}
	</style>
</head>
<body>
	<img src="<?php echo site_url('assets/images/logo-safira-full.png') ?>" style="height: 90px">
	<div style="margin-top: -90px;margin-left:420px;">
		<h2 style="color: blue;">KWITANSI</h2>
		<table>
			<tr>
				<td>NO</td>
				<td>&nbsp;&nbsp;&nbsp;</td>
				<td><?php echo $trx->transaction_no_trx ?></td>
			</tr>
			<tr>
				<td>TANGGAL</td>
				<td>&nbsp;&nbsp;&nbsp;</td>
				<td><?php echo $trx->transaction_created_at ?></td>
			</tr>
		</table>
	</div>
	<div style="margin-top: 30px">
		<table width="100%" border="1">
			<tr style="background-color: black;">
				<th>BARANG</th>
				<th>HARGA</th>
				<th>QUANTITY</th>
				<th>SUB TOTAL</th>
			</tr>
			<?php foreach ($detail as $row): ?>
				<tr>
					<td><?php echo $row->item_name ?></td>
					<td style="text-align: right"><?php echo number_format($row->item_price) ?></td>
					<td style="text-align: center"><?php echo $row->qty ?></td>
					<td style="text-align: right"><?php echo number_format($row->item_price * $row->qty) ?></td>
				</tr>
			<?php endforeach ?>
			
			<tr style="background-color: yellow;">
				<td colspan="3" style="text-align: center; font-weight: bold">GRAND TOTAL</td>
				<td style="font-weight: bold; text-align: right"><?php echo number_format($trx->transaction_total_price) ?></td>
			</tr>
		</table>
	</div>

	<div style="margin-top: 20px">
		<table>
			<tr>
				<td><?php echo date('d F Y',strtotime($trx->transaction_created_at)) ?></td>
			</tr>
			<tr>
				<td style="padding-top: 50px"><?php echo $this->session->userdata('full_name'); ?></td>
			</tr>
		</table>
	</div>
	<hr>
</body>
</html>
