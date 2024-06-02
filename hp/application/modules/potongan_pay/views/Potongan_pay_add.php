<?php

if (isset($potongan_pay)) {

	$inputDateValue = $potongan_pay['potongan_pay_date'];
	$inputValue = $potongan_pay['potongan_pay_value'];
	$inputDescValue = $potongan_pay['potongan_pay_desc'];
} else {
	$inputDateValue = set_value('potongan_pay_date');
	$inputValue = set_value('potongan_pay_value');
	$inputDescValue = set_value('potongan_pay_desc');
}
?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('manage') ?>"><i class="fa fa-th"></i> Home</a></li>
			<li><a href="<?php echo site_url('manage/potongan_pay') ?>">potongan_pay Umum</a></li>
			<li class="active"><?php echo isset($title) ? '' . $title : null; ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<!-- Main content -->
	<section class="content">
		<?php echo form_open_multipart(current_url()); ?>
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-md-9">
				<div class="box box-success">
					<!-- /.box-header -->
					<div class="box-body">
						<?php echo validation_errors(); ?>
						<?php if (isset($potongan_pay)) { ?>
							<input type="hidden" name="potongan_pay_id" value="<?php echo $potongan_pay['potongan_pay_id']; ?>">
						<?php } ?>

						<div class="form-group">
							<label>Tanggal potongan_pay</label>
							<div class="input-group date " data-date="" data-date-format="yyyy-mm-dd">
								<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								<input class="form-control" type="text" name="potongan_pay_date" readonly="readonly" placeholder="Tanggal potongan_pay" value="<?php echo $inputDateValue; ?>">
							</div>
						</div>

						<div class="form-group">
							<label>Keterangan *</label>
							<input type="text" class="form-control" name="potongan_pay_desc" value="<?php echo $inputDescValue ?>" placeholder="Keterangan potongan_pay">
						</div>

						<div class="form-group">
							<label>Jumlah Rupiah *</label>
							<input type="text" class="form-control" name="potongan_pay_value" value="<?php echo $inputValue ?>" placeholder="Jumlah">
						</div>

						<p class="text-muted">*) Kolom wajib diisi.</p>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
			<div class="col-md-3">
				<div class="box box-success">
					<!-- /.box-header -->
					<div class="box-body">
						<button type="submit" class="btn btn-block btn-success"><i class="fa fa-save"></i> Simpan</button>
						<a href="<?php echo site_url('manage/potongan_pay'); ?>" class="btn btn-block btn-info"><i class="fa fa-close"></i> Batal</a>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
		<!-- /.row -->
	</section>
</div>