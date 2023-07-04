<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
			<small>Detail</small>
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
						<h3 class="box-title">Tarif - <?php echo $payment['pos_name'] . ' - T.A ' . $payment['period_start'] . '/' . $payment['period_end'] ?></h3>
					</div><!-- /.box-header -->
					<div class="box-body">
						<?php echo form_open(current_url(), array('class' => 'form-horizontal', 'method' => 'get')) ?>
						<div class="form-group">
							<label for="" class="col-sm-1 control-label">Tahun</label>
							<div class="col-sm-2">
								<input type="text" class="form-control" value="<?php echo $payment['period_start'] . '/' . $payment['period_end'] ?>" readonly="">
							</div>
							<label for="" class="col-sm-1 control-label">Kelas</label>
							<div class="col-sm-2">
								<select class="form-control select2" style="width: 100%;" name="pr">
									<option value="">-- Semua Kelas --</option>
									<?php foreach ($class as $row) : ?>
										<option <?php echo (isset($q['pr']) and $q['pr'] == $row['class_id']) ? 'selected' : '' ?> value="<?php echo $row['class_id'] ?>"><?php echo $row['class_name'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<?php if (majors() == 'senior') { ?>
								<label for="" class="col-sm-2 control-label"><?php echo $this->config->item('jrr') ?></label>
								<div class="col-sm-2">
									<select class="form-control select2" style="width: 100%;" name="k">
										<option value="">-- Semua <?php echo $this->config->item('jrr') ?> --</option>
										<?php foreach ($majors as $row) : ?>
											<option <?php echo (isset($q['k']) and $q['k'] == $row['majors_id']) ? 'selected' : '' ?> value="<?php echo $row['majors_id'] ?>"><?php echo $row['majors_name'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							<?php } ?>
							<div class="col-sm-2">
								<button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Tampilkan Data</button>
							</div>
						</div>
						</form>
						<hr>
						<label for="" class="col-sm-2">Setting Tarif</label>
						<div class="col-sm-10">
							<a class="btn btn-primary btn-sm" href="<?php echo site_url('manage/payment/add_payment_bulan/' . $payment['payment_id']) ?>"><span class="glyphicon glyphicon-plus"></span> Berdasarkan Kelas</a>
							<?php if (majors() == 'senior') { ?>
								<a class="btn btn-warning btn-sm" href="<?php echo site_url('manage/payment/add_payment_bulan_majors/' . $payment['payment_id']) ?>"><span class="glyphicon glyphicon-plus"></span> Berdasarkan <?php echo $this->config->item('jrr') ?></a>
							<?php } ?>
							<a class="btn btn-info btn-sm" href="<?php echo site_url('manage/payment/add_payment_bulan_student/' . $payment['payment_id']) ?>"><span class="glyphicon glyphicon-plus"></span> Berdasarkan Siswa</a>

							<a class="btn btn-default btn-sm" href="<?php echo site_url('manage/payment') ?>"><span class="glyphicon glyphicon-repeat"></span> Kembali</a>
						</div>
					</div><!-- /.box-body -->
				</div><!-- /.box -->

				<?php if ($q) { ?>
					<div class="box box-success">
						<div class="box-body table-responsive">
						<?php echo form_open('manage/payment/delete_all_bulan/', array('method' => 'post')); ?>
						<table id="example1" class="table table-hover table-striped table-bordered">
							<thead>
								<tr><th><input type="checkbox" id="check-all"></th>
									<th>No</th>
									<th>NIM</th>
									<th>Nama</th>
									<th>Kelas</th>
									<?php if (majors() == 'senior') : ?>
										<th><?php echo $this->config->item('jrr') ?></th>
									<?php endif ?>
									<th>Aksi</th>
								</tr></thead>
								<tbody>
									<?php
									$p = $this->db->query("SELECT * FROM period where period_status = 1")->row_array();
									$i = 1;
									foreach ($student as $row) :
									?>
										<tr><td><input type='checkbox' class='check-item' name='del_all[]' value='<?php echo $row['student_student_id']; ?>'> <input type='checkbox' class='check-item' name='del_pay[]' value='<?php echo $row['payment_payment_id']; ?>'></td>
										<input type='hidden' name='id' value='<?php echo $row['payment_payment_id']; ?>'>
											<td><?php echo $i; ?> </td>
											<td><a href="<?php echo site_url('manage/payout?n='.$p['period_id'].'&r=' . $row['student_nis']) ?>"> <?=$row['student_nis']?></a></td>
											<td><?php echo $row['student_full_name'] ; ?></td>
											<td><?php echo $row['class_name']; ?></td>
											<?php if (majors() == 'senior') : ?>
												<td><?php echo $row['majors_name']; ?></td>
											<?php endif ?>
											<td>
												<a href="<?php echo site_url('manage/payment/edit_payment_bulan/' . $row['payment_payment_id'] . '/' . $row['student_student_id']) ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Ubah Tarif"><i class="fa fa-edit"></i></a>
												</td>
										</tr>
								<?php
										$i++;
									endforeach;
								} ?>

								</tbody>
								
        <button type="submit" class="btn btn btn-warning" id="btn-delete">DELETE</button><hr>
		<?php echo form_close(); ?>
							</table>
							
						</div>
					</div>
			</div>
		</div>
	</section>
</div>
<script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    $("#check-all").click(function(){ // Ketika user men-cek checkbox all
      if($(this).is(":checked")) // Jika checkbox all diceklis
        $(".check-item").prop("checked", true); // ceklis semua checkbox siswa dengan class "check-item"
      else // Jika checkbox all tidak diceklis
        $(".check-item").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"
    });
    
    $("#btn-delete").click(function(){ // Ketika user mengklik tombol delete
      var confirm = window.confirm("Apakah Anda yakin ingin menghapus data-data ini?"); // Buat sebuah alert konfirmasi
      
      if(confirm) // Jika user mengklik tombol "Ok"
        $("#form-delete").submit(); // Submit form
    });
  });
  </script>