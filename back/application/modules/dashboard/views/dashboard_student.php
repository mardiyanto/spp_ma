<div class="content-wrapper">
  <section class="content-header">
    <h1>Dashboard</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-success">
          <div class="box-body bg-success">
            <div class="col-md-3 col-sm-6 col-xs-12" style="margin-top: 10px;">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-dollar"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text dash-text">Sisa Tagihan Bulanan</span>
                  <span class="info-box-number"><?php echo 'Rp. ' . number_format($total_bulan-$bebas_bulan, 0, ',', '.') ?></span>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12" style="margin-top: 10px;">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text dash-text">Sisa Tagihan Lainnya</span>
                  <span class="info-box-number"><?php echo 'Rp. ' . number_format($total_bebas - $total_bebas_pay, 0, ',', '.') ?></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Kalender</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div id="calendar"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script type="text/javascript">
  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'prevYear,nextYear',
    },

    events: "<?php echo site_url('manage/dashboard/get'); ?>",
    dayClick: function(date, jsEvent, view) {

      var tanggal = date.getDate();
      var bulan = date.getMonth() + 1;
      var tahun = date.getFullYear();
      var fullDate = tahun + '-' + bulan + '-' + tanggal;

      $('#addModal').modal('toggle');
      $('#addModal').modal('show');

      $("#inputDate").val(fullDate);
      $("#labelDate").text(fullDate);
      $("#inputYear").val(date.getFullYear());
      $("#labelYear").text(date.getFullYear());
    },

    eventClick: function(calEvent, jsEvent, view) {
      $("#delModal").modal('toggle');
      $("#delModal").modal('show');
      $("#idDel").val(calEvent.id);
      $("#showYear").text(calEvent.year);

      var tgl = calEvent.start.getDate();
      var bln = calEvent.start.getMonth() + 1;
      var thn = calEvent.start.getFullYear();

      $("#showDate").text(tgl + '-' + bln + '-' + thn);
      $("#showDesc").text(calEvent.title);
    }
  });

  $("#inputDesc").on('change keyup focus input propertychange', function() {
    var desc = $("#inputDesc").val();
    if (desc.trim().length > 0) {
      $("#btnSimpan").removeClass('disabled');
    } else {
      $("#btnSimpan").addClass('disabled');
    }
  })

  $("#closeModal").click(function() {
    $("#inputDesc").val('');
    $("#btnSimpan").addClass('disabled');
  });
</script>