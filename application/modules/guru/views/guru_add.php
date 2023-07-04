<?php

if (isset($guru)) {

	$inputDateValue = $guru['guru_nik'];
	$inputValue = $guru['guru_nama'];
	$inputDescValue = $guru['guru_nuptk'];
} else {
	$inputDateValue = set_value('guru_nik');
	$inputValue = set_value('guru_nama');
	$inputDescValue = set_value('guru_nuptk');
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
			<li><a href="<?php echo site_url('manage/guru') ?>">Pengeluaran Umum</a></li>
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
						<?php if (isset($guru)) { ?>
							<input type="hidden" name="guru_id" value="<?php echo $guru['guru_id']; ?>">
						<?php } ?>

					
						<div class="form-group">
							<label>Nama *</label>
							<input type="text" class="form-control" name="guru_nama" value="<?php echo $inputValue ?>" placeholder="NAMA">
						</div>
						<div class="form-group">
							<label>NUPTK *</label>
							<input type="text" class="form-control" name="guru_nuptk" value="<?php echo $inputDescValue ?>" placeholder="NUPTK">
						</div>

						<div class="form-group">
							<label>NIK *</label>
							<input type="text" class="form-control" name="guru_nik" value="<?php echo $inputDateValue ?>" placeholder="NIK">
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
						<a href="<?php echo site_url('manage/guru'); ?>" class="btn btn-block btn-info"><i class="fa fa-close"></i> Batal</a>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
		<!-- /.row -->
	</section>
</div>