<?php

if (isset($hutang)) {

	$inputDateValue = $hutang['hutang_date'];
	$inputValue = $hutang['hutang_value'];
	$inputDescValue = $hutang['hutang_desc'];
} else {
	$inputDateValue = set_value('hutang_date');
	$inputValue = set_value('hutang_value');
	$inputDescValue = set_value('hutang_desc');
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
			<li><a href="<?php echo site_url('manage/hutang') ?>">Hutang Umum</a></li>
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
						<?php if (isset($hutang)) { ?>
							<input type="hidden" name="hutang_id" value="<?php echo $hutang['hutang_id']; ?>">
						<?php } ?>

						<div class="form-group">
							<label>Tanggal Hutang</label>
							<div class="input-group date " data-date="" data-date-format="yyyy-mm-dd">
								<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								<input class="form-control" type="text" name="hutang_date" readonly="readonly" placeholder="Tanggal Hutang" value="<?php echo $inputDateValue; ?>">
							</div>
						</div>

						<div class="form-group">
							<label>Keterangan *</label>
							<input type="text" class="form-control" name="hutang_desc" value="<?php echo $inputDescValue ?>" placeholder="Keterangan Hutang">
						</div>

						<div class="form-group">
							<label>Jumlah Rupiah *</label>
							<input type="text" class="form-control numeric" name="hutang_value" value="<?php echo $inputValue ?>" placeholder="Jumlah">
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
						<a href="<?php echo site_url('manage/hutang'); ?>" class="btn btn-block btn-info"><i class="fa fa-close"></i> Batal</a>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
		<!-- /.row -->
	</section>
</div>