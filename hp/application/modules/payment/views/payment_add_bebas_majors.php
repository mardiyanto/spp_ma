<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('manage') ?>"><i class="fa fa-th"></i> Home</a></li>
			<li class="active"><?php echo isset($title) ? '' . $title : null; ?></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="box-body">
				<?php echo form_open_multipart(current_url(), array('class' => 'form-horizontal')); ?>
				<?php echo validation_errors(); ?>

				<div class="col-md-6">
					<div class="box box-success">
						<div class="box-header">
							<h3 class="box-title">Informasi Pembayaran</h3>
						</div>
						<div class="box-body">
							<div class="form-group">
								<label for="" class="col-sm-4 control-label">Jenis Pembayaran</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="<?php echo $payment['pos_name'] . ' - T.A ' . $payment['period_start'] . '/' . $payment['period_end'] ?>" readonly="">
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-4 control-label">Tahun pelajaran</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="<?php echo $payment['period_start'] . '/' . $payment['period_end'] ?>" readonly="">
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-4 control-label">Tipe Pembayaran</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="<?php echo ($payment['payment_type'] == 'BULAN' ? 'Bulanan' : 'Bebas') ?>" readonly="">
								</div>
							</div>

						</div>
					</div>

				</div>
				<div class="col-md-6">

					<div class="box box-success">
						<div class="box-header">
							<h3 class="box-title">Tarif Tagihan Per <?php echo $this->config->item('jrr') ?></h3>
						</div>
						<div class="box-body table-responsive">

							<table class="table">
								<tbody>
									<tr>
										<td><strong>Kelas</strong></td>
										<td>
											<select name="class_id" class="form-control select2" style="width: 100%;">
												<option selected="">---Pilih Kelas---</option>
												<?php foreach ($class as $row) : ?>
													<option value="<?php echo $row['class_id']; ?>"><?php echo $row['class_name']; ?></option>
												<?php endforeach; ?>
											</select>
										</td>
									</tr>
									<tr>
										<td><strong>Program <?php echo $this->config->item('jrr') ?></strong></td>
										<td>
											<select name="majors_id" class="form-control select2" style="width: 100%;">
												<option selected="">---Pilih <?php echo $this->config->item('jrr') ?>---</option>
												<?php foreach ($majors as $row) : ?>
													<option value="<?php echo $row['majors_id']; ?>"><?php echo $row['majors_name']; ?></option>
												<?php endforeach; ?>
											</select>
										</td>
									</tr>
									<tr>
										<td><strong>Tarif (Rp.)</strong></td>
										<td><input autofocus="" type="text" required="" name="bebas_bill" placeholder="Masukan Tarif" class="form-control">
										</td>
									</tr>
									<tr>
										<td><strong>Keterangan (Rincian)</strong></td>
										<td><textarea name="bebas_desc" id="" class="form-control"></textarea></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
							<a href="<?php echo site_url('manage/payment/view_bebas/' . $payment['payment_id']) ?>" class="btn btn-default"><i class="fa fa-repeat"></i> Cancel</a>
						</div>
					</div>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</section>
</div>