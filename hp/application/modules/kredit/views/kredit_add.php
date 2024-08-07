<?php

if (isset($kredit)) {

	$inputDateValue = $kredit['kredit_date'];
	$inputValue = $kredit['kredit_value'];
	$inputjenis = $kredit['kredit_jenis_jenis_id'];
	$inputDescValue = $kredit['kredit_desc'];
} else {
	$inputDateValue = set_value('kredit_date');
	$inputValue = set_value('kredit_value');
	$inputjenis = set_value('kredit_jenis_jenis_id');
	$inputDescValue = set_value('kredit_desc');
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
			<li><a href="<?php echo site_url('manage/kredit') ?>">Pengeluaran Umum</a></li>
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
						<?php if (isset($kredit)) { ?>
							<input type="hidden" name="kredit_id" value="<?php echo $kredit['kredit_id']; ?>">
						<?php } ?>

						<div class="form-group">
							<label>Tanggal Pengeluaran</label>
							<div class="input-group date " data-date="" data-date-format="yyyy-mm-dd">
								<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								<input class="form-control" type="text" name="kredit_date" readonly="readonly" placeholder="Tanggal Pengeluaran" value="<?php echo $inputDateValue; ?>">
							</div>
						</div>
						<div class="form-group">
							<label>Jenis Pengeluaran *</label>	
							<select required="" name="kredit_jenis_jenis_id" class="form-control select2" style="width: 100%;">
								<option value="<?php echo $inputjenis; ?>" selected="selected"><?php echo $kredit['kredit_jenis_desc'] ?></option>
								<?php 
								foreach ($kredit_jenis as $j)
								{ ?>
								<option value="<?php echo $j['kredit_jenis_id'] ?>" ><?php echo $j['kredit_jenis_desc'] ?></option>
								<?php } ?>				
								</select>
							</div>
						<div class="form-group">
							<label>Keterangan *</label>
							<input type="text" class="form-control" name="kredit_desc" value="<?php echo $inputDescValue ?>" placeholder="Keterangan Pengeluaran">
						</div>

						<div class="form-group">
							<label>Jumlah Rupiah *</label>
							<input type="text" class="form-control" name="kredit_value" value="<?php echo $inputValue ?>" placeholder="Jumlah">
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
						<a href="<?php echo site_url('manage/kredit'); ?>" class="btn btn-block btn-info"><i class="fa fa-close"></i> Batal</a>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
		<!-- /.row -->
	</section>
</div>