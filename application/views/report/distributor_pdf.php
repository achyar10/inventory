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
	<div style="margin-top: -90px;margin-left:320px;">
		<h3 style="color: blue;">LAPORAN DAFTAR DISTRIBUTOR</h3>
	</div>
	<br>
	<br>
	<div style="margin-top: 30px">
		<table width="100%" border="1">
              <tr style="background-color: #000">
                  <th>No</th>
                  <th>Nama Distributor</th>
                  <th>Tanggal Input</th>
                </tr>
                <?php
                  $i = 1;
                  foreach ($distributor as $row):
                    ?>
                    <tr>
                      <td><?php echo $i ?></td>
                      <td><?php echo $row->distributor_name ?></td>
                      <td><?php echo $row->distributor_created_at ?></td>
                    </tr>
                    <?php
                  $i++;
                  endforeach;
				 ?>
		</table>
	</div>

	<div style="margin-top: 20px">
		<table>
			<tr>
				<td><?php echo date('d F Y',strtotime(date('Y-m-d'))) ?></td>
			</tr>
			<tr>
				<td style="padding-top: 50px"><?php echo $this->session->userdata('full_name'); ?></td>
			</tr>
		</table>
	</div>
	<hr>
</body>
</html>
