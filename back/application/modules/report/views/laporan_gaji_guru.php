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
						<div class="col-md-3">							
								<div class="form-group">
								<select required="" name="gr" class="form-control select2" style="width: 100%;">
								<option selected="selected">Pilih Guru</option>
								<?php foreach ($guru as $j)
								{ ?>
								<option value="<?php echo $j['guru_id'] ?>" ><?php echo $j['guru_nama'] ?></option>
								<?php } ?>				
								</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<div class="input-group date " data-date="" data-date-format="yyyy-mm-dd">
										<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
										<input class="form-control" required=""  type="text" name="ds" readonly="readonly" <?php echo (isset($q['ds'])) ? 'value="' . $q['ds'] . '"' : '' ?> placeholder="Tanggal Awal">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<div class="input-group date " data-date="" data-date-format="yyyy-mm-dd">
										<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
										<input class="form-control" required="" type="text" name="de" readonly="readonly" <?php echo (isset($q['de'])) ? 'value="' . $q['de'] . '"' : '' ?> placeholder="Tanggal Akhir">

									</div>
								</div>
							</div>
							<div class="col-md-3">
								<button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filter Data</button>
								<?php if ($q) { ?>
									<a class="btn btn-success" href="<?php echo site_url('manage/report/gaji_report_pdf' . '/?' . http_build_query($q)) ?>" target="_blank" ><i class="fa fa-file-pdf-o"></i> CETAK PDF</a>
								<?php } ?>
							</div>
						</div>
					</div>

				</div>

				<?php if ($q) { 
					$no       = 1;
					?>
					<?php $rt['total'] = 0;
					$rx['jum'] = 0;
					foreach ($gaji_pay as $rww) : ?>
					<?php  if ($rww['gaji_jenis']== 'paket' ) { 
					$rt['total'] += $rww['gaji_pay_value'];
					$ra=$rt['total'] ?>
					<?php  } else {
					$rx['jum'] += $rww['gaji_pay_value']*$rww['gaji_value'];
					$rb=$rx['jum'] ?>
					<?php  } ?>
					<?php  endforeach ?>
					
					<?php $pt['potong'] = 0;
					foreach ($potongan_pay as $rp) :
					$pt['potong'] += $rp['potongan_pay_value'];
					$rpb=$pt['potong'] ?>
					<?php  endforeach ?>

					<?php $jj=$rt['total']+$rx['jum']?>
					
					<div class="box box-success">
						<div class="box-body table-responsive">
						<table class="table table-bordered table-striped">
									<tr>
									<td colspan="4"><?php echo isset($title) ? '' . $title : null; ?></td> 
									</tr>
									<tr> 
										<td >TANGGAL LAPORAN</td>
										<td ><?php echo pretty_date($q['ds'], 'd F Y', false) . ' s/d ' . pretty_date($q['de'], 'd F Y', false) ?></td>
										<td> POTONGAN  GAJI</td>
										<td>Rp. <?php echo number_format($pt['potong'], 0, ',', '.') ?></td> 
										</tr>
										<tr> 
											<td>PETUGAS</td>
											<td > <?php echo $this->session->userdata('ufullname') ?></td>
										<td> GAJI BERSIH</td>
										<td>Rp. <?php echo number_format($jj-$pt['potong'], 0, ',', '.') ?>
										</tr>
										<tr>
										<td> GAJI</td>
										<td>Rp. <?php echo number_format($rt['total']+$rx['jum'], 0, ',', '.') ?>
										<td >-</td>
										<td >- </td> 
									</tr>
									<tr>
									<td>&nbsp;</td>
									</tr>
							</table>	
						
					
						<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>N0</th>
                  <th>NAMA GURU</th>
				  <th>JENIS GAJI</th>
				  <th>RP</th>
				  <th>TANGGAL INPUT</th>
				  <th>KETERANGAN</th>
                </tr>
                </thead>
                <tbody>
				<?php 
				foreach ($gaji_pay as $row) : ?>
                <tr>
                  <td><?php echo $no ?></td>
				  <td><?php echo $row['guru_nama'] ?></td>
				  <td><?php echo $row['gaji_desc'] ?></td>
                  <td> <?php  if ($row['gaji_jenis']== 'paket' ) { ?>
					Rp. <?php echo number_format($row['gaji_pay_value'], 0, ',', '.') ?>
					<?php  } else { ?>
					Rp. <?php echo number_format($row['gaji_value']*$row['gaji_pay_value'], 0, ',', '.') ?>
					 <?php  } ?> </td>
				  <td><?php echo pretty_date($row['gaji_pay_date'], 'm/d/Y', FALSE) ?></td>
				  <td><?php echo $row['gaji_pay_desc'] ?></td>
                </tr>
				<?php $no++; endforeach ?>
				<?php 
				foreach ($potongan_pay as $row) : ?>
                <tr>
                  <td><?php echo $no ?></td>
				  <td><?php echo $row['guru_nama'] ?></td>
				  <td>Potongan</td>
                  <td>- Rp.  <?php echo number_format($row['potongan_pay_value'], 0, ',', '.') ?></td>
				  <td><?php echo pretty_date($row['potongan_pay_date'], 'm-d-Y', FALSE) ?></td>
				  <td><?php echo $row['potongan_pay_desc'] ?></td>
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