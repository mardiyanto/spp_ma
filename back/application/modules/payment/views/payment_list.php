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
					<div class="box-header with-border">
						<a href="<?php echo site_url('manage/payment/add') ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Data</a>

						<div class="box-tools">
							<?php echo form_open(current_url(), array('class' => 'form-horizontal', 'method' => 'get')) ?>
							<div class="input-group input-group-sm" style="width: 250px;">
									<select name="j" class="form-control select2" style="width: 100%;" onchange="this.form.submit()">
												<option selected="">---Pilih Tahun---</option>
												<?php $query = $this->db->query("SELECT * FROM period");
                                                    foreach ($query->result_array() as $row)
                                                    { ?>
													<option value="<?php echo $row['period_id']; ?>"><?php echo $row['period_start'] . '/' . $row['period_end']; ?></option>
												    <?php
                                                    } 
                                                    ?> 
									</select>
							</div>
							<?php echo form_close(); ?>

							
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body table-responsive">
						<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr class="bg-success">
							<th class="text-center">No</th>
								<th>Nama Pembayaran</th>
								<th>Jenis Pembayaran</th>
								<th>Tipe</th>
								<th>Tahun</th>
								<th>Tarif Pembayaran</th>
								<th>Aksi</th>
							</tr>
							 </thead>
							<tbody>
								<?php
								if (!empty($payment)) {
									$i = 1;
									foreach ($payment as $row) :
								?>
										<tr>
										<td class="text-center"><?php echo $i; ?></td>
											<td><?php echo $row['pos_name']; ?></td>
											<td><?php echo $row['pos_name'] . ' - T.P ' . $row['period_start'] . '/' . $row['period_end']; ?></td>
											<td><?php echo ($row['payment_type'] == 'BULAN') ? 'Bulanan' : 'Bebas' ?></td>
											<td><?php echo $row['period_start'] . '/' . $row['period_end']; ?></td>
											<td>
												<?php if ($row['payment_type'] == 'BULAN') { ?>
													<a data-toggle="tooltip" data-placement="top" title="Ubah" class="btn btn-primary btn-xs" href="<?php echo site_url('manage/payment/view_bulan/' . $row['payment_id']) ?>">
														Atur Tarif Pembayaran
													</a>
												<?php } else { ?>
													<a data-toggle="tooltip" data-placement="top" title="Ubah" class="btn btn-primary btn-xs" href="<?php echo site_url('manage/payment/view_bebas/' . $row['payment_id']) ?>">
														Atur Tarif Pembayaran
													</a>
												<?php } ?>
											</td>
											<td>
												<a href="<?php echo site_url('manage/payment/edit/' . $row['payment_id']) ?>" class="btn btn-xs btn-success" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>

											</td>
										</tr>
									<?php
									$i++;
									endforeach;
								} else {
									?>
									<tr id="row">
										<td colspan="6" align="center">Data Kosong</td>
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