<?php

if (isset($debit)) {

	$inputDateValue = $debit['debit_date'];
	$inputValue = $debit['debit_value'];
	$inputjenis = $debit['debit_jenis_jenis_id'];
	$inputDescValue = $debit['debit_desc'];
} else {
	$inputDateValue = set_value('debit_date');
	$inputValue = set_value('debit_value');
	$inputjenis = set_value('debit_jenis_jenis_id');
	$inputDescValue = set_value('debit_desc');
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
			<li><a href="<?php echo site_url('manage/debit') ?>">Penerimaan Umum</a></li>
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
						<?php if (isset($debit)) { ?>
							<input type="hidden" name="debit_id" value="<?php echo $debit['debit_id']; ?>">
						<?php } ?>

						<div class="form-group">
							<label>Tanggal </label>
							<div class="input-group date " data-date="" data-date-format="yyyy-mm-dd">
								<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								<input class="form-control" type="text" name="debit_date" readonly="readonly" placeholder="Tanggal Penerimaan" value="<?php echo $inputDateValue; ?>">
							</div>
						</div>
						<div class="form-group">
							<label>Jenis Penerimaan *</label>	
							<select required="" name="debit_jenis_jenis_id" class="form-control select2" style="width: 100%;">
								<option value="<?php echo $inputjenis; ?>" selected="selected"><?php echo $debit['debit_jenis_desc'] ?></option>
								<?php 
								foreach ($debit_jenis as $j)
								{ ?>
								<option value="<?php echo $j['debit_jenis_id'] ?>" ><?php echo $j['debit_jenis_desc'] ?></option>
								<?php } ?>				
								</select>
							</div>
						<div class="form-group">
							<label>Keterangan *</label>
							<input type="text" class="form-control" name="debit_desc" value="<?php echo $inputDescValue ?>" placeholder="Keterangan Penerimaan">
						</div>

						<div class="form-group">
							<label>Jumlah Rupiah *</label>
							<input type="text" class="form-control" name="debit_value" value="<?php echo $inputValue ?>" placeholder="Jumlah">
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
						<a href="<?php echo site_url('manage/debit'); ?>" class="btn btn-block btn-info"><i class="fa fa-close"></i> Batal</a>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
		<!-- /.row -->
	</section>
</div>