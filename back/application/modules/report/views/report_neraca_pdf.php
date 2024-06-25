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
		<div class="container">
			<div class="col-md-12">
			

			<?php if ($q) { 
					$no       = 1;
					$tanggal_awal = $q['ds'];
					$tanggal_akhir = $q['de'];
					?>
					<div class="box box-success">
						<div class="box-body table-responsive">
							
						<table class="table table-bordered table-striped">
									<tr>
									<td colspan="4"><?php echo isset($title) ? '' . $title : null; ?></td> 
									</tr>
									<tr> 
										<td >TANGGAL LAPORAN</td>
										<td ><?php echo pretty_date($q['ds'], 'd F Y', false) . ' s/d ' . pretty_date($q['de'], 'd F Y', false) ?></td>
										<td >TOTAL PENERIMAAN UMUM</td>
										<td >Rp. <?php echo number_format($debit_pay, 0, ',', '.') ?></td> 
									</tr>
									<tr> 
										<td>PETUGAS </td>
										<td > <?php echo $this->session->userdata('ufullname') ?></td>
										<td >TOTAL PENGELUARAN</td>
										<td >Rp. <?php echo number_format($loss, 0, ',', '.') ?></td> 
									</tr>
									<tr>
										<td>TOTAL PENDAPATAN</td>
										<td >Rp. <?php echo number_format($byr, 0, ',', '.') ?></td>
										<td >SUB TOTAL PENDAPATAN</td>
										<td >Rp. <?php echo number_format($bersih, 0, ',', '.') ?></td> 
									</tr>
									<tr>
									<td>&nbsp;</td>
									</tr>
							</table>		
						<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>N0</th>
                  <th>KETERANGAN</th>
                  <th>PENDAPATAN</th>
				  <th>PENGELUARAN</th>
                </tr>
                </thead>
                <tbody>
					<?php
					$this->db->select('*, SUM(bulan_pay_bill) as total_pembayaran');
					$this->db->from('bulan_pay');
					$this->db->join('bulan', 'bulan.bulan_id = bulan_pay.bulan_bulan_id', 'left');
					$this->db->join('month', 'month.month_id = bulan.month_month_id', 'left');
					$this->db->join('payment', 'payment.payment_id = bulan.payment_payment_id', 'left');
					$this->db->join('period', 'period.period_id = payment.period_period_id', 'left');
					$this->db->join('pos', 'pos.pos_id = payment.pos_pos_id', 'left');
					$this->db->where('bulan_pay_input_date >=', $tanggal_awal);
					$this->db->where('bulan_pay_input_date <=', $tanggal_akhir);
					$this->db->group_by('pos_pos_id');
					$query = $this->db->get();
					$data_bulanpay = $query->result_array(); ?>
				<?php foreach ($data_bulanpay as $row) : ?>
                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $row['pos_name'] . ' - T.P ' . $row['period_start'] . '/' . $row['period_end'] . ' - ' . '(' . $row['month_name'] . ')'?></td>
                  <td>Rp. <?php echo number_format($row['total_pembayaran'], 0, ',', '.') ?></td>
				  <td>-</td>
                </tr>
				<?php $no++; endforeach ?>
				<?php
					$this->db->select('*, SUM(bebas_pay_bill) as total_bebas_pay');
					$this->db->from('bebas_pay');
					$this->db->join('bebas', 'bebas.bebas_id = bebas_pay.bebas_bebas_id', 'left');
					$this->db->join('payment', 'payment.payment_id = bebas.payment_payment_id', 'left');
					$this->db->join('period', 'period.period_id = payment.period_period_id', 'left');
					$this->db->join('pos', 'pos.pos_id = payment.pos_pos_id', 'left');
					$this->db->where('bebas_pay_input_date >=', $tanggal_awal);
					$this->db->where('bebas_pay_input_date <=', $tanggal_akhir);
					$this->db->group_by('pos_pos_id');
					$getbebas = $this->db->get();
					$data_bebas = $getbebas->result_array(); ?>
				<?php foreach ($data_bebas as $row) : ?>
                <tr>
				<td><?php echo $no ?></td>
                  <td><?php echo $row['pos_name'] . ' - T.P ' . $row['period_start'] . '/' . $row['period_end'] .')'?></td>
                  <td>Rp. <?php echo number_format($row['total_bebas_pay'], 0, ',', '.') ?></td>
				  <td>-</td>
                </tr>
				<?php $no++; endforeach ?>
				<?php
					$this->db->select('*, SUM(debit_value) as total_penerimaan');
					$this->db->from('debit');
					$this->db->join('debit_jenis', 'debit_jenis.debit_jenis_id = debit.debit_jenis_jenis_id', 'left');
					$this->db->where('debit_date >=', $tanggal_awal);
					$this->db->where('debit_date <=', $tanggal_akhir);
					$this->db->group_by('debit_jenis_jenis_id');
					$getpenerimaan = $this->db->get();
					$debit_pay = $getpenerimaan->result_array(); ?>
				<?php foreach ($debit_pay as $row) : ?>
                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $row['debit_jenis_desc'] ?></td>
                  <td>Rp. <?php echo number_format($row['total_penerimaan'], 0, ',', '.') ?></td>
				  <td>-</td>
                </tr>
				<?php $no++; endforeach ?>
				<?php
					$this->db->select('*, SUM(kredit_value) as total_pengeluaran');
					$this->db->from('kredit');
					$this->db->join('kredit_jenis', 'kredit_jenis.kredit_jenis_id = kredit.kredit_jenis_jenis_id', 'left');
					$this->db->where('kredit_date >=', $tanggal_awal);
					$this->db->where('kredit_date <=', $tanggal_akhir);
					$this->db->group_by('kredit_jenis_jenis_id');
					$getpengeluran = $this->db->get();
					$kredit_pay = $getpengeluran->result_array(); ?>
				<?php foreach ($kredit_pay as $row) : ?>
                <tr>
				  <td><?php echo $no ?></td>
                  <td><?php echo $row['kredit_jenis_desc'] ?></td>
                  <td>-</td>
				  <td>Rp. <?php echo number_format($row['total_pengeluaran'], 0, ',', '.') ?></td>
                </tr>
				<?php $no++; endforeach ?>
				
                <tr>
                  <td><?php echo $no ?></td>
                  <td>GAJI KARIAWAN DAN GURU</td>
				  <td>-</td>
                  <td>Rp. <?php echo number_format($total_gaji, 0, ',', '.') ?></td>
				  
                </tr>
				
                </tbody>
							</table>
						</div>
						<!-- /.box-body -->
					</div>
				<?php } ?>

			</div>
			</body>
</html>