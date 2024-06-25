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
							<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addkredit_jenis"><i class="fa fa-plus"></i> Tambah Data</button>
							<div class="box-tools">
								<?php echo form_open(current_url(), array('class' => 'form-horizontal', 'method' => 'get')) ?>
								<div class="input-group input-group-sm" style="width: 250px;">
									<input type="text" id="field" autofocus name="n" <?php echo (isset($f['n'])) ? 'placeholder="' . $f['n'] . '"' : 'placeholder="Cari Pengeluaran Umum"' ?> class="form-control" required>
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
						<table class="table table-hover table-striped table-bordered">
							<tr>
								<th>No</th>
								<th>Tanggal</th>
								<th>Jenis Pengeluaran</th>
								<th>Aksi</th>
							</tr>
							<tbody>
								<?php
								if (!empty($kredit_jenis)) {
									$i = 1;
									foreach ($kredit_jenis as $row) :
								?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo pretty_date($row['kredit_jenis_date'], 'd F Y', false); ?></td>
											<td><?php echo $row['kredit_jenis_desc']; ?></td>
											<td>
												<?php if ($this->session->userdata('uroleid') <> BENDAHARA) { ?>
													<a href="<?php echo site_url('manage/kredit_jenis/edit/' . $row['kredit_jenis_id']) ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
													<a href="#delModal<?php echo $row['kredit_jenis_id']; ?>" data-toggle="modal" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" title="Hapus"></i></a>
												<?php } ?>
											</td>
										</tr>
										<div class="modal modal-default fade" id="delModal<?php echo $row['kredit_jenis_id']; ?>">
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
														<?php echo form_open('manage/kredit_jenis/delete/' . $row['kredit_jenis_id']); ?>
														<input type="hidden" name="delName" value="<?php echo $row['kredit_jenis_desc']; ?>">
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
<div class="modal fade" id="addkredit_jenis" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Tambah Jenis Pengeluaran</h4>
			</div>
			<?php echo form_open('manage/kredit_jenis/add_glob', array('method' => 'post')); ?>
			<div class="modal-body">
				<div id="p_scents_kredit_jenis">
				<div class="row">
				<div class="col-md-12">
					<label>Tanggal</label>
						<div class="input-group date " data-date="" data-date-format="yyyy-mm-dd">
							<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
							<input class="form-control" required="" type="text" name="kredit_jenis_date" placeholder="Tanggal jeni Pengeluaran">
						</div>
						
							<label>Keterangan *</label>
							<input type="text" required="" name="kredit_jenis_desc[]" class="form-control" placeholder="Keterangan jenis Pengeluaran">
						</div>
					</div>
				</div>
				<h6><a href="#" class="btn btn-xs btn-success" id="addScnt_kredit_jenis"><i class="fa fa-plus"></i><b> Tambah Baris</b></a></h6>
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
		var scntDiv = $('#p_scents_kredit_jenis');
		var i = $('#p_scents_kredit_jenis .row').size() + 1;

		$("#addScnt_kredit_jenis").click(function() {
			$('<div class="row"><br><div class="col-md-12"><label>Keterangan *</label><input type="text" required name="kredit_jenis_desc[]" class="form-control" placeholder="Keterangan Pengeluaran"><br><a href="#" class="btn btn-xs btn-danger remScnt_kredit_jenis"><i class="fa fa-close"></i> <b>Hapus Baris</b></a></div></div>').appendTo(scntDiv);
			i++;
			return false;
		});

		$(document).on("click", ".remScnt_kredit_jenis", function() {
			if (i > 2) {
				$(this).parents('.row').remove();
				i--;
			}
			return false;
		});
	});
</script>
<?php $this->load->view('manage/rupiah'); ?>