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
		<h2 style="">PEMBELIAN BARANG</h2>
		<table>
			<tr>
				<td>NO</td>
				<td>&nbsp;&nbsp;&nbsp;</td>
				<td><?php echo $order->order_no_trx ?></td>
			</tr>
			<tr>
				<td>TANGGAL</td>
				<td>&nbsp;&nbsp;&nbsp;</td>
				<td><?php echo $order->order_created_at ?></td>
			</tr>
		</table>
	</div>
	<div style="margin-top: 30px">
		<table width="100%" border="1">
			<tr style="background-color: black;">
				<th>NAMA BARANG</th>
				<th>MERK</th>
				<th>QUANTITY</th>
			</tr>
			<?php foreach ($detail as $row): ?>
				<tr>
					<td><?php echo $row->item_name ?></td>
					<td><?php echo $row->item_merk ?></td>
					<td style="text-align: center"><?php echo $row->qty ?></td>
				</tr>
			<?php endforeach ?>
			
		</table>
	</div>

	<div style="margin-top: 20px">
		<table>
			<tr>
				<td><?php echo date('d F Y',strtotime($order->order_created_at)) ?></td>
			</tr>
			<tr>
				<td style="padding-top: 50px"><?php echo $this->session->userdata('full_name'); ?></td>
			</tr>
		</table>
	</div>
	<hr>
</body>
</html>
