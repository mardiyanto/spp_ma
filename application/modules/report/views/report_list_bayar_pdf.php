<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $this->config->item('app_name') ?> <?php echo isset($title) ? ' | ' . $title : null; ?></title>
  </head>
  <style type="text/css">
	@page {
		margin-top: 0.5cm;
		/*margin-bottom: 0.1em;*/
		margin-left: 1cm;
		margin-right: 1cm;
		margin-bottom: 0.1cm;
	}

	.name-school {
		font-size: 15pt;
		font-weight: bold;
		padding-bottom: -15px;
		text-transform: uppercase;
	}

	.alamat {
		font-size: 12pt;
		margin-bottom: -10px;
	}

	.detail {
		font-size: 12pt;
		font-weight: bold;
		padding-top: -15px;
		padding-bottom: -12px;
	}

	body {
		font-family: sans-serif;
	}

	table {
		font-family: verdana, arial, sans-serif;
		font-size: 12px;
		color: #333333;
		border-width: none;
		/*border-color: #666666;*/
		border-collapse: collapse;
		width: 100%;
		
	}

	th {
		padding-bottom: 8px;
		padding-top: 8px;
		border-color: #666666;
		background-color: #dedede;
		/*border-bottom: solid;*/
		text-align: left;
		
	}

	td {
		text-align: left;
		border-color: #666666;
		background-color: #ffffff;
	}


	hr {
		border: none;
		height: 1px;
		/* Set the hr color */
		color: #333;
		/* old IE */
		background-color: #333;
		/* Modern Browsers */
	}

	.container {
		position: relative;
	}

	.topright {
		position: absolute;
		top: 0;
		right: 0;
		font-size: 18px;
		border-width: thin;
		padding: 5px;
	}

	.topright2 {
		position: absolute;
		top: 30px;
		right: 50px;
		font-size: 18px;
		border: 1px solid;
		padding: 5px;
		color: red;
	}
</style>
<body>
		<div class="row">


				<?php if ($q) { 
					$no       = 1;
					?>
					<div class="box box-success">
						<div class="box-body table-responsive">
						<table> 	<tr>
									<td width="15%" ><?php if (isset($setting_logo) and $setting_logo['setting_value'] != NULL) { ?>
                    <img src="<?php echo upload_url('school/' . $setting_logo['setting_value']) ?>" style="height: 100px">
                  <?php } else { ?>
                    <img src="<?php echo media_url('img/missing_logo.gif') ?>" style="height: 112px">
                  <?php } ?></td>
									<td width="85%" colspan="3"><p class="name-school"><?php echo $setting_school['setting_value'] ?></p>
	<p class="alamat"><?php echo $setting_address['setting_value'] ?><br>
		Telp. <?php echo $setting_phone['setting_value'] ?></p>
	<hr></td> 
									</tr>
				  </table> <table> 
									<tr>
									<td ><div align="center"><p class="name-school"><?php echo isset($title) ? '' . $title : null; ?></p></div></td> 
									</tr><tr>
									<td ><br></td> 	</table>
						<table class="table table-bordered table-striped">
							<tbody>
						
								<tr> 
									<td width="27%">TANGGAL LAPORAN</td>
									<td width="83%">: <?php echo pretty_date($q['ds'], 'd F Y', false) . ' s/d ' . pretty_date($q['de'], 'd F Y', false) ?></td> 
								</tr>
								<tr> 
									<td>PETUGAS</td>
									<td width="83%">: <?php echo $this->session->userdata('ufullname') ?></td> 
								</tr>
								<tr>
									<td>TOTAL PEMBAYARAN</td>
									<td width="83%">: Rp. <?php echo number_format($byr, 0, ',', '.') ?></td> 
								</tr>
								<tr>
								<td>&nbsp;</td>
								</tr>
							</tbody>
							</table>		
					
						<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>N0</th>
                  <th>NAMA SISWA</th>
                  <th>PEMBAYARAN</th>
                  <th>KELAS</th>
                  <th>TANGGAL</th>
				  <th>PENERIMAAN</th>
				  <th>KETERANGAN</th>
                </tr>
                </thead>
                <tbody>
				<?php foreach ($bulan_pay as $row) : ?>
                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $row['student_full_name'] ?></td>
                  <td><?php echo $row['pos_name'] . ' - T.P ' . $row['period_start'] . '/' . $row['period_end'] . ' - ' . '(' . $row['month_name'] . ')'?></td>
                  <td><?php echo($row['class_name']) ?></td>
                  <td><?php echo pretty_date($row['bulan_pay_input_date'], 'm/d/Y', FALSE) ?></td>
				  <td>Rp. <?php echo number_format($row['bulan_pay_bill'], 0, ',', '.') ?></td>
                  <td><?php echo$row['keterangan']?></td>
                </tr>
				<?php $no++; endforeach ?>
				<?php foreach ($dom as $row) : ?>
                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $row['student_full_name'] ?></td>
                  <td><?php echo $row['pos_name'] . ' - T.P ' . $row['period_start'] . '/' . $row['period_end']?></td>
                  <td><?php echo $row['class_name'] ?></td>
                  <td><?php echo pretty_date($row['bebas_pay_input_date'], 'm/d/Y', FALSE) ?></td>
				  <td>Rp. <?php echo number_format($row['bebas_pay_bill'], 0, ',', '.') ?></td>
                  <td><?php echo$row['bebas_pay_desc']?></td>
                </tr>
				<?php $no++; endforeach ?>
				<tr>
                  <th></th>
                  <th></th>
				  <th></th>
				  <th></th>
				  <th></th>
				  <th></th>
				  <th></th>
                </tr>
                </tbody>
							</table>
			<table width="100%" border="0">
                      <tr>
                        <td width="25%">&nbsp;</td>
                        <td width="25%">&nbsp;</td>
                        <td width="16%">&nbsp;</td>
                        <td width="34%">&nbsp;</td>
                      </tr>
					   <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><?php echo $setting_city['setting_value'] ?></span>, <?php echo pretty_date(date('Y-m-d'), 'd F Y', false) ?></td>
                      </tr>
					   <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
					   <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
					   <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
					   <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>( <?php echo $this->session->userdata('ufullname'); ?> )</td>
                      </tr>
                    </table>
						</div>
						<!-- /.box-body -->
					</div>
				<?php } ?>

			</div>
			</body>
</html>