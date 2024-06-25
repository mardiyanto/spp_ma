<script type="text/javascript" src="<?php echo media_url('js/jquery-migrate-3.0.0.min.js') ?>"></script>
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
					<?php if ($this->session->userdata('uroleid') <> BENDAHARA) { ?>
						<div class="box-header with-border">
							<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addguru"><i class="fa fa-plus"></i> Tambah Data</button>
							<a href="<?php echo site_url('manage/report/gaji_report_guru') ?>" class="btn btn-xs btn-warning" ><i class="fa fa-edit"></i>Laporan Gaji</a>
							
							<div class="box-tools">
								<?php echo form_open(current_url(), array('class' => 'form-horizontal', 'method' => 'get')) ?>
								<div class="input-group input-group-sm" style="width: 250px;">
									<input type="text" id="field" autofocus name="n" <?php echo (isset($f['n'])) ? 'placeholder="' . $f['n'] . '"' : 'placeholder="Cari data guru"' ?> class="form-control" required>
									<div class="input-group-btn">
										<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
									</div>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					<?php } ?>
					<!-- /.box-header -->
					<div class="box-body table-responsive">
						<table id="example1" class="table table-bordered table-striped">
              			  <thead>
							<tr>
								<th>No</th>
								<th>NIK</th>
								<th>NUPTK</th>
								<th>NAMA GURU</th>
								<th>Aksi</th>
							</tr>
						 </thead>
							<tbody>
								<?php
								if (!empty($guru)) {
									$i = 1;
									foreach ($guru as $row) :
								?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $row['guru_nik']; ?></td>
											<td><?php echo $row['guru_nuptk']; ?></td>
											<td><?php echo $row['guru_nama']; ?></td>
											<td>
												<?php if ($this->session->userdata('uroleid') <> BENDAHARA) { ?>
													<a href="<?php echo site_url('manage/guru/edit/' . $row['guru_id']) ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>

													<a href="#delModal<?php echo $row['guru_id']; ?>" data-toggle="modal" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" title="Hapus"></i></a>
												<?php } ?>
											</td>
										</tr>
										<div class="modal modal-default fade" id="delModal<?php echo $row['guru_id']; ?>">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span></button>
														<h3 class="modal-title"><span class="fa fa-warning"></span> Konfirmasi penghapusan</h3>
													</div>
													<div class="modal-body">
														<p>Apakah anda yakin akan menghapus data ini?</p>
													</div>
													<div class="modal-footer">
														<?php echo form_open('manage/guru/delete/' . $row['guru_id']); ?>
														<input type="hidden" name="delName" value="<?php echo $row['guru_nuptk']; ?>">
														<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><span class="fa fa-close"></span> Batal</button>
														<button type="submit" class="btn btn-danger"><span class="fa fa-check"></span> Hapus</button>
														<?php echo form_close(); ?>
													</div>
												</div>
												<!-- /.modal-content -->
											</div>
											<!-- /.modal-dialog -->
										</div>
									<?php
										$i++;
									endforeach;
								} else {
									?>
									<tr id="row">
										<td colspan="5" align="center">Data Kosong</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<!-- /.box-body -->
				</div>
				<div>
					<?php echo $this->pagination->create_links(); ?>
				</div>
				<!-- /.box -->
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>

<!-- Modal -->
<div class="modal fade" id="addguru" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Tambah Pengeluaran</h4>
			</div>
			<?php echo form_open('manage/guru/add_glob', array('method' => 'post')); ?>
			<div class="modal-body">
				<div id="p_scents_guru">
					<div class="row">
					    <div class="col-md-12">
						<label>NAMA GURU</label>
							<input type="text" required="" name="guru_nama[]" class="form-control" placeholder="NAMA">
						</div>
						<div class="col-md-6">
							<label>NIK</label>
							<input type="text" required="" name="guru_nik[]" class="form-control" placeholder="NIK">
						</div>
						<div class="col-md-6">
							<label>NUPTK</label>
							<input type="text" required="" name="guru_nuptk[]" class="form-control" >
						</div>
					</div>
				</div>
				<h6><a href="#" class="btn btn-xs btn-success" id="addScnt_guru"><i class="fa fa-plus"></i><b> Tambah Baris</b></a></h6>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
</div>


<script>
	$(function() {
		var scntDiv = $('#p_scents_guru');
		var i = $('#p_scents_guru .row').size() + 1;

		$("#addScnt_guru").click(function() {
			$('<div class="row"><div class="col-md-12"><label>NAMA GURU</label><input type="text" required="" name="guru_nama[]" class="form-control" placeholder="NAMA"></div><div class="col-md-6"><label>NIK</label><input type="text" required="" name="guru_nik[]" class="form-control" placeholder="NIK"></div><div class="col-md-6"><label>NUPTK</label><input type="text" required="" name="guru_nuptk[]" class="form-control" ></div><br><br><a href="#" class="btn btn-xs btn-danger remScnt_guru"><i class="fa fa-close"></i> <b>Hapus Baris</b></a></div>').appendTo(scntDiv);
			i++;

			return false;
		});

		$(document).on("click", ".remScnt_guru", function() {
			if (i > 2) {
				$(this).parents('.row').remove();
				i--;
			}
			return false;
		});
	});
</script>
<?php $this->load->view('manage/rupiah'); ?>