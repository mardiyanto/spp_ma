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
					<div class="box-header">
						<?php echo form_open(current_url(), array('method' => 'get')) ?>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Tahun Pelajaran</label>
									<select class="form-control select2" style="width: 100%;" name="p">

										<?php foreach ($period as $row) : ?>
											<option <?php echo (isset($q['p']) and $q['p'] == $row['period_id']) ? 'selected' : '' ?> value="<?php echo $row['period_id'] ?>"><?php echo $row['period_start'] . '/' . $row['period_end'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Kelas</label>
									<select class="form-control select2" style="width: 100%;" name="c">

										<?php foreach ($class as $row) : ?>
											<option <?php echo (isset($q['c']) and $q['c'] == $row['class_id']) ? 'selected' : '' ?> value="<?php echo $row['class_id'] ?>"><?php echo $row['class_name'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<?php if (majors() == 'senior') { ?>
								<div class="col-md-3">
									<div class="form-group">
										<label><?php echo $this->config->item('jrr') ?></label>
										<select class="form-control select2" style="width: 100%;" name="k">
											<?php foreach ($majors as $row) : ?>
												<option <?php echo (isset($q['k']) and $q['k'] == $row['majors_id']) ? 'selected' : '' ?> value="<?php echo $row['majors_id'] ?>"><?php echo $row['majors_name'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							<?php } ?>
							<div class="col-md-3">
								<div style="margin-top:25px;">
									<button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filter Data</button>
									<?php if ($q and !empty($py)) { ?>
										<a class="btn btn-success" href="<?php echo site_url('manage/report/report_bill_detail' . '/?' . http_build_query($q)) ?>"><i class="fa fa-file-excel-o"></i> Export Excel</a>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<?php $p = $this->db->query("SELECT * FROM period where period_status = 1")->row_array();
				if ($q and !empty($py)) { ?>
					<div class="box box-success">
						<div class="box-body table-responsive">
							<table class="table table-responsive table-hover table-bordered" style="white-space: nowrap;">
								<tr>
									<th rowspan="2">Kelas</th>
									<th rowspan="2">Nama</th>
									<?php foreach ($py as $row) : ?>
										<th colspan="<?php echo count($month) ?>">
											<center><?php echo $row['pos_name'] . ' - T.P ' . $row['period_start'] . '/' . $row['period_end']; ?></center>
										</th>
									<?php endforeach ?>
									<?php foreach ($bebas as $key) : ?>
										<th rowspan="2">
											<center><?php echo $key['pos_name'] . ' - T.P ' . $key['period_start'] . '/' . $key['period_end']; ?></center>
										</th>
									<?php endforeach ?>
								</tr>
								<tr>
									<?php foreach ($month as $key) : ?>
										<th><?php echo $key['month_name'] ?></th>
									<?php endforeach ?>
								</tr>

								<?php foreach ($student as $row) : ?>
									<tr>
										<td><?php echo $row['class_name'] ?></td>
										<td><?php
if ($this->session->userdata('uroleid') == SUPERUSER) { ?>
   <a href="<?php echo site_url('manage/payout?n='.$p['period_id'].'&r=' . $row['student_nis']) ?>"><?php echo $row['student_full_name'] ?></a>
<?php } else { ?>
    <?php echo $row['student_full_name'] ?>
<?php }
?>
 </td>
										<?php foreach ($bulan as $key) : ?>
											<?php if ($key['student_student_id'] == $row['student_student_id']) { ?>
												<td style="color:<?php echo ($key['bulan_bill'] - $key['bulan_bill_total'] == 0) ? '#00E640' : 'red' ?>"><?php echo ($key['bulan_bill'] - $key['bulan_bill_total'] == 0) ? 'Lunas' : number_format($key['bulan_bill'] - $key['bulan_bill_total'], 0, ',', '.') ?></td>
											<?php } ?>
										<?php endforeach ?>
										<?php foreach ($free as $key) : ?>
											<?php if ($key['student_student_id'] == $row['student_student_id']) { ?>
												<td style="text-align:center;color:<?php echo ($key['bebas_bill'] == $key['bebas_total_pay']) ? '#00E640' : 'red' ?> "><?php echo ($key['bebas_bill'] == $key['bebas_total_pay']) ? 'Lunas' : number_format($key['bebas_bill'] - $key['bebas_total_pay'], 0, ',', '.') ?></td>
											<?php } ?>
										<?php endforeach ?>
									</tr>
								<?php endforeach ?>
							</table>
						</div>
						<!-- /.box-body -->
					</div>
				<?php } ?>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>