<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
			<small>List</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('manage') ?>"><i class="fa fa-th"></i> Home</a></li>
			<li class="active"><?php echo isset($title) ? '' . $title : null; ?></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-success">
					<div class="box-header">
						<?php echo form_open(current_url(), array('method' => 'get')) ?> <br>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<div class="input-group date " data-date="" data-date-format="yyyy-mm-dd">
										<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
										<input class="form-control" required=""  type="text" name="ds" readonly="readonly" <?php echo (isset($q['ds'])) ? 'value="' . $q['ds'] . '"' : '' ?> placeholder="Tanggal Awal">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<div class="input-group date " data-date="" data-date-format="yyyy-mm-dd">
										<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
										<input class="form-control" required="" type="text" name="de" readonly="readonly" <?php echo (isset($q['de'])) ? 'value="' . $q['de'] . '"' : '' ?> placeholder="Tanggal Akhir">

									</div>
								</div>
							</div>
							<div class="col-md-4">
								<button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filter Data</button>
								<?php if ($q) { ?>
								<a class="btn btn-success" href="<?php echo site_url('manage/report/neraca_get_pdf' . '/?' . http_build_query($q)) ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> Cetak PDF</a>
								<?php } ?>
							</div>
						</div>
					</div>

				</div>

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

		</div>
	</section>
	<!-- /.content -->
</div>
