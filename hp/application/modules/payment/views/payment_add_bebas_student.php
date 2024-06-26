<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('manage') ?>"><i class="fa fa-th"></i> Home</a></li>
			<li class="active"><?php echo isset($title) ? '' . $title : null; ?></li>
		</ol>
	</section>
	<div ng-controller="studentCtrl">
		<section class="content">
			<div class="row">
				<div class="box-body">
					<?php echo form_open_multipart(current_url(), array('class' => 'form-horizontal')); ?>
					<?php echo validation_errors(); ?>

					<div class="col-md-6">
						<div class="box box-danger">
							<div class="box-header">
								<h3 class="box-title">Informasi Pembayaran</h3>
							</div>
							<div class="box-body">
								<div class="form-group">
									<label for="" class="col-sm-4 control-label">Jenis Pembayaran</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" value="<?php echo $payment['pos_name'] . ' - T.A ' . $payment['period_start'] . '/' . $payment['period_end'] ?>" readonly="">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-4 control-label">Tahun Pelajaran</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" value="<?php echo $payment['period_start'] . '/' . $payment['period_end'] ?>" readonly="">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-4 control-label">Tipe Pembayaran</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" value="<?php echo ($payment['payment_type'] == 'BULAN' ? 'Bulanan' : 'Bebas') ?>" readonly="">
									</div>
								</div>

							</div>
						</div>

					</div>
					<div class="col-md-6">
						<div class="box box-success">
							<div class="box-success">
								<div class="box-header">
									<h3 class="box-title">Tarif Tagihan Per Siswa</h3>
								</div>
							</div>
							<div class="box-body table-responsive">
								<table class="table">
									<tbody>
										<tr>
											<td><strong>Kelas</strong></td>
											<td>
												<select id="selector" name="class_id" class="form-control select2" style="width: 100%;" ng-model="class_id" ng-change="getStudent(class_id)">
													<option value="">-- Pilih Kelas --</option>
													<option ng-repeat="class in classes" ng-value="class.class_class_id">{{class.class_name}}</option>
												</select>
											</td>
										</tr>
										<tr id="selTask">
											<td><strong>Nama Siswa</strong></td>
											<td>
												<select name="student_id" class="form-control select2" style="width: 100%;">
													<option value="">-- Pilih Siswa --</option>
													<option ng-repeat="student in students" ng-selected="student_data.index == student.student_id" value="{{student.student_id}}">{{student.student_full_name}}</option>
												</select>
											</td>
										</tr>
										<tr>
											<td><strong>Tarif (Rp.)</strong></td>
											<td><input autofocus="" type="text" name="bebas_bill" placeholder="Masukan Tarif" required="" class="form-control">
											</td>
										</tr>
										<tr>
											<td><strong>Keterangan (Rincian)</strong></td>
											<td><textarea name="bebas_desc" id="" class="form-control"></textarea></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="box-footer">
								<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
								<a href="<?php echo site_url('manage/payment/view_bebas/' . $payment['payment_id']) ?>" class="btn btn-default"><i class="fa fa-repeat"></i> Cancel</a>
							</div>
						</div>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</section>
	</div>
</div>

<script>
	var studentApp = angular.module("studentApp", []);
	var SITEURL = "<?php echo site_url() ?>";

	studentApp.controller('studentCtrl', function($scope, $http) {
		$scope.classes = [];
		$scope.students = [];


		$scope.getClass = function() {

			var url = SITEURL + 'api/get_class2/';
			$http.get(url).then(function(response) {

				$scope.classes = response.data;
			});

		};

		$scope.getStudent = function(id) {
			var url = SITEURL + 'api/get_student_by_class/' + id;
			$http.get(url).then(function(response) {
				$scope.students = response.data;
			});

		};

		angular.element(document).ready(function() {
			$scope.getClass();
		});

	});

	$(document).ready(function() {
		$('#selector').bind('change', function(e) {
			if ($('#selector').val() == '') {
				$('#selTask').hide();

			} else {
				$('#selTask').show();
			}
		}).trigger('change');

	});
</script>