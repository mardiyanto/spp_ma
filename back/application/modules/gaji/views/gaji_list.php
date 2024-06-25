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
							<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addgaji"><i class="fa fa-plus"></i> Tambah Data</button>
							<a href="<?php echo site_url('manage/report/gaji_report') ?>" class="btn btn-success btn-sm" ><i class="fa fa-plus"></i> Laporan Total Gaji</a>
							<a href="<?php echo site_url('manage/report/gaji_report_guru') ?>" class="btn btn-warning btn-sm" ><i class="fa fa-plus"></i> Laporan Gaji Per Guru</a>
							<a href="<?php echo site_url('manage/potongan_pay') ?>" class="btn btn-danger btn-sm" ><i class="fa fa-edit"></i>Potongan Gaji</a>
							<div class="box-tools">
								<?php echo form_open(current_url(), array('class' => 'form-horizontal', 'method' => 'get')) ?>
								<div class="input-group input-group-sm" style="width: 250px;">
									<input type="text" id="field" autofocus name="n" <?php echo (isset($f['n'])) ? 'placeholder="' . $f['n'] . '"' : 'placeholder="Cari gaji Umum"' ?> class="form-control" required>
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
								<th>Keterangan</th>
								<th>Tarip Gaji</th>
								<th>Aksi</th>
							</tr>
						</thead>
							<tbody>
								<?php
								if (!empty($gaji)) {
									$i = 1;
									foreach ($gaji as $row) :
										$p = $this->db->query("SELECT SUM(gaji_pay_value) AS Total FROM gaji_pay where gaji_gaji_id = $row[gaji_id]")->row_array();
										$tt = $p['Total'];	
										$sis = $row['gaji_value'] - $p['Total'];
								?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $row['gaji_desc']; ?></td>
											<td> <?php  if ($row['gaji_jenis']== 'paket' ) { ?>
												<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addpaygajipaket<?php echo $row['gaji_id'] ?>"><?php echo 'Rp. ' . number_format($row['gaji_value'], 0, ',', '.') ?></button>
												<?php  } else { ?>
													<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addpaygaji<?php echo $row['gaji_id'] ?>"><?php echo 'Rp. ' . number_format($row['gaji_value'], 0, ',', '.') ?></button>
												    <?php  } ?>  
												</td>
											<td>
												<?php if ($this->session->userdata('uroleid') <> BENDAHARA) { ?>
													<a href="<?php echo site_url('manage/gaji/edit/' . $row['gaji_id']) ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>

													<a href="#delModal<?php echo $row['gaji_id']; ?>" data-toggle="modal" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" title="Hapus"></i></a>
													<a href="#riciangaji<?php echo $row['gaji_id']; ?>" data-toggle="modal" class="btn btn-success btn-xs"><i class="fa fa-eye" data-toggle="tooltip" title="Hapus"></i></a>
												<?php } ?>
											</td>
										</tr>
										<div class="modal modal-default fade" id="delModal<?php echo $row['gaji_id']; ?>">
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
														<?php echo form_open('manage/gaji/delete/' . $row['gaji_id']); ?>
														<input type="hidden" name="delName" value="<?php echo $row['gaji_desc']; ?>">
														<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><span class="fa fa-close"></span> Batal</button>
														<button type="submit" class="btn btn-danger"><span class="fa fa-check"></span> Hapus</button>
														<?php echo form_close(); ?>
													</div>
												</div>
												<!-- /.modal-content -->
											</div>
											<!-- /.modal-dialog -->
										</div>
										<div class="modal modal-default fade" id="riciangaji<?php echo $row['gaji_id']; ?>">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span></button>
														<h3 class="modal-title"> Cicilan gaji</h3>
													</div>
													<div class="modal-body">
													<div class="container">
														<div class="heading">
															<div class="col">TANGAL BAYAR</div>
															<div class="col">KETERANGAN</div>
															<div class="col">CICILAN</div>
															<div class="col">#</div>
														</div>
														<?php $query = $this->db->query("SELECT * FROM gaji_pay where gaji_gaji_id =$row[gaji_id];");
                                                    foreach ($query->result_array() as $x)
                                                    { ?>
														<div class="table-row">                                                       
															<div class="col"><?php echo $x['gaji_pay_date'] ?></div>
															<div class="col"><?php echo $x['gaji_pay_desc'] ?></div>
														
															<div class="col">Rp. <?php echo number_format($x['gaji_pay_value'], 0, ',', '.') ?></div>
															<div class="col"><a href="<?php echo site_url('manage/gaji_pay/delete/'. $x['gaji_pay_id']) ?>">Hapus</a></div>
														</div>
														<?php } ?>
														<div class="table-row">
                                                        <div class="col"></div>
                                                        <div class="col">TOTAL BAYAR</div>
                                                        <div class="col">Rp. <?php echo number_format($tt, 0, ',', '.') ?></div>
														<div class="col"></div>
                                                    </div>
                                                    <div class="table-row">
                                                        <div class="col"></div>
                                                        <div class="col">KURANG BAYAR</div>
                                                        <div class="col">Rp. <?php echo number_format($sis, 0, ',', '.') ?></div>
														<div class="col"></div>
                                                    </div>
													</div>
													</div>
												</div>
												<!-- /.modal-content -->
											</div>
											<!-- /.modal-dialog -->
										</div>
										<!-- Modal PAY gaji-->
											<div class="modal fade" id="addpaygaji<?php echo $row['gaji_id'] ?>" role="dialog">
												<div class="modal-dialog modal-md">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">Bayar gaji <?php echo $row['gaji_id'] ?></h4>
														</div>
														<?php echo form_open('manage/gaji_pay/add_glob', array('method' => 'post')); ?>
														<div class="modal-body">
															<div id="p_scents_gaji">
																<div class="row">
																<div class="col-md-6">
																	<label>Tanggal gaji</label>
																	<div class="input-group date " data-date="" data-date-format="yyyy-mm-dd">
																		<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
																		<input class="form-control" required="" type="text" name="gaji_pay_date" placeholder="Tanggal bayar gaji">
																	</div>
																</div>
																<div class="col-md-6">
																		<label>NAMA GURU</label>
																		<select required="" name="guru_guru_id" class="form-control select2" style="width: 100%;">
																		<option selected="selected">Pilih Guru</option>
																		<?php $query = $this->db->query("SELECT * FROM guru");
																		foreach ($query->result_array() as $j)
																		{ ?>
																		<option value="<?php echo $j['guru_id'] ?>" ><?php echo $j['guru_nama'] ?></option>
																		<?php } ?>				
																		</select>
																</div>
																	<div class="col-md-6">
																		<label>Keterangan *</label>
																		<input type="text" required="" name="gaji_pay_desc" class="form-control" placeholder="Keterangan bayar gaji">
																		<input type="hidden" required="" name="gaji_id" value="<?php echo $row['gaji_id'] ?>" class="form-control" >
																	</div>
																	<div class="col-md-6">
																		<label>Jumlah Jam = <?php echo 'Rp. ' . number_format($row['gaji_value']*$tt, 0, ',', '.') ?></label>
																		<input type="number" id="gaji" required="" name="gaji_pay_value" class="form-control" placeholder="Jumlah JAM">
																	</div>
																</div>
															</div>
														
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
															<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
														</div>
														<?php echo form_close(); ?>
													</div>
												</div>
											</div>
										<!-- Modal PAY gaji-->
										<div class="modal fade" id="addpaygajipaket<?php echo $row['gaji_id'] ?>" role="dialog">
												<div class="modal-dialog modal-md">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">Bayar gaji <?php echo $row['gaji_id'] ?></h4>
														</div>
														<?php echo form_open('manage/gaji_pay/add_glob', array('method' => 'post')); ?>
														<div class="modal-body">
															<div id="p_scents_gaji">
																<div class="row">
																<div class="col-md-6">
																	<label>Tanggal gaji</label>
																	<div class="input-group date " data-date="" data-date-format="yyyy-mm-dd">
																		<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
																		<input class="form-control" required="" type="text" name="gaji_pay_date" placeholder="Tanggal bayar gaji">
																	</div>
																</div>
																<div class="col-md-6">
																		<label>NAMA GURU</label>
																		<select required="" name="guru_guru_id" class="form-control select2" style="width: 100%;">
																		<option selected="selected">Pilih Guru</option>
																		<?php $query = $this->db->query("SELECT * FROM guru");
																		foreach ($query->result_array() as $j)
																		{ ?>
																		<option value="<?php echo $j['guru_id'] ?>" ><?php echo $j['guru_nama'] ?></option>
																		<?php } ?>				
																		</select>
																</div>
																	<div class="col-md-6">
																		<label>Keterangan *</label>
																		<input type="text" required="" name="gaji_pay_desc" class="form-control" placeholder="Keterangan bayar gaji">
																		<input type="hidden" required="" name="gaji_id" value="<?php echo $row['gaji_id'] ?>" class="form-control" >
																	</div>
																	<div class="col-md-6">
																		<label>Total Bayar = <?php echo 'Rp. ' . number_format($tt, 0, ',', '.') ?></label>
																		<input type="text" id="gaji" required="" name="gaji_pay_value" class="form-control numeric" placeholder="Jumlah Bayar">
																	</div>
																</div>
															</div>
														
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
															<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
														</div>
														<?php echo form_close(); ?>
													</div>
												</div>
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
<div class="modal fade" id="addgaji" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Tambah gaji</h4>
			</div>
			<?php echo form_open('manage/gaji/add_glob', array('method' => 'post')); ?>
			<div class="modal-body">
				<div id="p_scents_gaji">
					
					<div class="row">
					<div class="col-md-6">
						<label>Tanggal gaji</label>
						<div class="input-group date " data-date="" data-date-format="yyyy-mm-dd">
							<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
							<input class="form-control" required="" type="text" name="gaji_date" placeholder="Tanggal gaji">
						</div>
					</div>
					<div class="col-md-6">
							<label>Jenis Gaji *</label>
							<select name="gaji_jenis" class="form-control select2" style="width: 100%;">
								<option selected="selected">Pilih Jenis</option>
								<option value="khusus">khusus</option>
								<option value="umum">Umum</option>
								<option value="paket">Paket</option>
							</select>
						</div>
						<div class="col-md-6">
							<label>Keterangan *</label>
							<input type="text" required="" name="gaji_desc[]" class="form-control" placeholder="Keterangan gaji">
						</div>
						<div class="col-md-6">
							<label>Jumlah Rupiah *</label>
							<input type="text" id="gaji" required="" name="gaji_value[]" class="form-control numeric" placeholder="Jumlah" onfocus="unformatRupiah(this)" onblur="formatRupiah(this);">
						</div>
					</div>
				</div>
				<h6><a href="#" class="btn btn-xs btn-success" id="addScnt_gaji"><i class="fa fa-plus"></i><b> Tambah Baris</b></a></h6>
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

<style>

.container{
    display:table;
    width:500px;
    border-collapse:collapse;
    margin:0 auto;
    line-height:25px;
}
.table-row:hover{background-color:#99ccff;}
.heading{
    font-weight:bold;
    display:table-row;
    background-color:#C91622;
    text-align:center;
    line-height:35px;
    color:#ffffff;
}
.table-row{  
    display:table-row;
    text-align:center;
}
.strip{  
    display:table-row;
    text-align:center;
    background-color:#f0f0f0;
}
.col{ 
    display:table-cell;
    border:1px solid #CCC;
}
</style>
<script>
	$(function() {
		var scntDiv = $('#p_scents_gaji');
		var i = $('#p_scents_gaji .row').size() + 1;

		$("#addScnt_gaji").click(function() {
			$('<div class="row"><br><div class="col-md-6"><label>Keterangan *</label><input type="text" required name="gaji_desc[]" class="form-control" placeholder="Keterangan gaji"><br><a href="#" class="btn btn-xs btn-danger remScnt_gaji"><i class="fa fa-close"></i> <b>Hapus Baris</b></a></div><div class="col-md-6"><label>Jumlah Rupiah *</label><input type="text" required name="gaji_value[]" class="form-control numeric" placeholder="Jumlah" onfocus="unformatRupiah(this)" onblur="formatRupiah(this);"></div></div>').appendTo(scntDiv);
			i++;

			return false;
		});

		$(document).on("click", ".remScnt_gaji", function() {
			if (i > 2) {
				$(this).parents('.row').remove();
				i--;
			}
			return false;
		});
	});
</script>
<?php $this->load->view('manage/rupiah'); ?>