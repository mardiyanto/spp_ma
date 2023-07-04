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
									<a class="btn btn-success" href="<?php echo site_url('manage/report/pdf_report_bill_bayar' . '/?' . http_build_query($q)) ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> CETAK PDF</a>
								<?php } ?>
							</div>
						</div>
					</div>

				</div>

				<?php if ($q) { 
					$no       = 1;
					?>
					<div class="box box-success">
						<div class="box-body table-responsive">
						<table class="table table-bordered table-striped">
							<tbody>
								<tr>
								<td colspan="2"><?php echo isset($title) ? '' . $title : null; ?></td> 
								</tr>
								<tr> 
									<td width="17%">TANGGAL LAPORAN</td>
									<td width="83%"><?php echo pretty_date($q['ds'], 'd F Y', false) . ' s/d ' . pretty_date($q['de'], 'd F Y', false) ?></td> 
								</tr>
								<tr> 
									<td>PETUGAS</td>
									<td width="83%"> <?php echo $this->session->userdata('ufullname') ?></td> 
								</tr>
								<tr>
									<td>TOTAL PEMBAYARAN</td>
									<td width="83%">Rp. <?php echo number_format($byr, 0, ',', '.') ?></td> 
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
				  <th>PENGELUARAN</th>
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
                  <td> -</td>
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
                  <td> -</td>
                  <td><?php echo$row['bebas_pay_desc']?></td>
                </tr>
				<?php $no++; endforeach ?>
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