<html>

<head>
  <?php foreach ($siswa as $row) : ?>
    <title>Detail Rincian Tagihan - <?php echo $row['student_full_name'] ?></title>
  <?php endforeach ?>
  <style type="text/css">
    .upper {
      text-transform: uppercase;
    }

    .lower {
      text-transform: lowercase;
    }

    .cap {
      text-transform: capitalize;
    }

    .small {
      font-variant: small-caps;
    }
  </style>
  <style type="text/css">
    .style12 {
      font-size: 9px
    }

    .style13 {
      font-size: 14pt;
      font-weight: bold;
    }

    .title {
      font-size: 14pt;
      text-align: center;
      font-weight: bold;
      padding-bottom: -15px;
    }

    .tp {
      font-size: 14pt;
      text-align: center;
      font-weight: bold;
    }

    body {
      font-family: sans-serif;
    }

    table {
      border-collapse: collapse;
      font-size: 9pt;
      width: 100%;
      padding-left: 5px;
    }

    .ket {
      word-wrap: break-word
    }
  </style>
</head>

<body>
  <p class="title">RINCIAN PEMBAYARAN ADMINISTRASI</p>
  <p class="tp"> TAHUN PELAJARAN <?php foreach ($period as $row) : ?> <?php echo ($f['n'] == $row['period_id']) ? $row['period_start'] . '/' . $row['period_end'] : '' ?><?php endforeach; ?></p>

  <table width="100%" border="0">
    <tr>
      <td width="100"><?php echo $this->config->item('nisn') ?> </td>
      <td width="5">:</td>
      <?php foreach ($siswa as $row) : ?>
        <td width=""><?php echo $row['student_nisn'] ?></td>
      <?php endforeach; ?>
    </tr>
    <tr>
      <td>Nama Lengkap</td>
      <td>:</td>
      <?php foreach ($siswa as $row) : ?>
        <td><?php echo $row['student_full_name'] ?></td>
      <?php endforeach; ?>
    </tr>
    <tr>
      <td>Kelas</td>
      <td>:</td>
      <?php foreach ($siswa as $row) : ?>
        <td><?php echo $row['class_name'] ?></td>
      <?php endforeach; ?>
    </tr>
    <?php if (majors() == 'senior') { ?>
      <tr>
        <td><?php echo $this->config->item('jrr') ?></td>
        <td>:</td>
        <?php foreach ($siswa as $row) : ?>
          <td><?php echo $row['majors_name'] ?></td>
        <?php endforeach; ?>
      </tr>
    <?php } ?>
  </table><br>
  <?php if ($f['n'] and $f['r'] != NULL) { ?>
    <table width="100%" style="font-size: 10px;" border="1">
      <tr>
        <th style="height: 30px;">NO</th>
        <th>NAMA PEMBAYARAN</th>
        <th>TGL BAYAR</th>
        <th>TAGIHAN</th>
        <th>SISA TAGIHAN</th>
        <th>KETERANGAN</th>
      </tr>
      <?php
      $i = 1;
      $total = 0;
      $ttbulan =0;
      foreach ($bulan as $row) :
        // $namePay = $row['pos_name'] . ' - T.P ' . $row['period_start'] . '/' . $row['period_end'];
        $namePay = $row['pos_name'];
        $mont = ($row['month_month_id'] <= 6) ? $row['period_start'] : $row['period_end'];
        $tt=$row['bulan_bill']-$row['bulan_bill_total'];
        $ttbulan +=$row['bulan_bill'];
       $total +=$tt;
      ?>
        <tr>
          <td style="text-align: center;"><?php echo $i ?></td>
          <td style="white-space: nowrap; padding:0 5px;"><?php echo $namePay . ' - (' . $row['month_name'] . ' ' . $mont . ')' ?></td>
          <td style="padding:0 5px; text-align:left;"><?php echo ($row['bulan_bill_total'] > 0) ? pretty_date($row['bulan_date_pay'], 'd F Y', false) : '-'  ?></td>
          
          <td style="padding:0 5px; white-space: nowrap;"><?php echo 'Rp. '. number_format($row['bulan_bill'], 0, ',', '.') ?></td>
          <td style="padding:0 5px;"><?php echo ($row['bulan_bill'] - $row['bulan_bill_total'] != 0) ? 'Rp. ' . number_format($row['bulan_bill'] - $row['bulan_bill_total'], 0, ',', '.') : 'Rp. -' ?></td>
        
          <td style="padding:0 5px;"><?php echo ($row['bulan_bill'] == $row['bulan_bill_total']) ? 'Lunas' : 'Belum Lunas' ?></td>
        </tr>
      <?php
        $i++;
      endforeach
      ?>
      <?php
      $j = $i;
      $freetotol=0;
      $totalbyfee=0;
      foreach ($bebas as $row) :
         $frett=$row['bebas_bill']-$row['bebas_total_pay'];
         $totalbyfee +=$row['bebas_bill'];
         $freetotol +=$frett;
        // $namePayFree = $row['pos_name'] . ' - T.P ' . $row['period_start'] . '/' . $row['period_end'];
        $namePayFree = $row['pos_name'];
      ?>
        <tr>
          <td style="text-align: center;"><?php echo $j ?></td>
          <td style="padding:0 5px;"><?php echo $namePayFree ?></td>
          <td style="padding:0 5px; text-align: <?php echo ($row['bebas_total_pay'] > 0) ? 'left' : '' ?>"><?php echo ($row['bebas_total_pay'] > 0) ? pretty_date($row['bebas_input_date'], 'd F Y', false) : '-'  ?></td>
          
          <td style="padding:0 5px;"><?php echo ($row['bebas_bill']  != 0) ? 'Rp. ' . number_format($row['bebas_bill'], 0, ',', '.') : 'Rp. -' ?></td>
          <td style="padding:0 5px;"><?php echo ($row['bebas_bill'] - $row['bebas_total_pay'] != 0) ? 'Rp. ' . number_format($row['bebas_bill'] - $row['bebas_total_pay'], 0, ',', '.') : 'Rp. -' ?></td>
          <td style="word-break:break-all; word-wrap:break-word; padding:0 5px;">
            <?php echo ($row['bebas_bill'] == $row['bebas_total_pay']) ? 'Lunas' : 'Belum Lunas' ?>
            <?php if ($row['bebas_desc'] == NULL) { ?>
            <?php  } else { ?>
              <br>
              <b style="font-size: 9px;"><u>RINCIAN TAGIHAN: </u><br><i><?php echo $row['bebas_desc'] ?></i></b>
            <?php } ?>
          </td>
        </tr>
      <?php
        $j++;
      endforeach
      ?>
        <tr>
          <td colspan="3" style="text-align: center;">TOTAL TAGIHAN</td>
          <td style="padding:0 5px;">Rp. <?php echo number_format($ttbulan + $totalbyfee, 0, ',', '.') ?></td>
          <td style="padding:0 5px;">Rp. <?php echo number_format($total + $freetotol, 0, ',', '.') ?></td>
          <td style="word-break:break-all; word-wrap:break-word; padding:0 5px;">&nbsp;</td>
        </tr>
    </table>
  <?php } else redirect('manage/payout?n=' . $f['n'] . '&r=' . $f['r'])  ?>
  <table style="width:100%; margin-top: 25px; font-size: 10pt; ">
    <tr>
      <td><span class="cap">Sribasuki</span>, <?php echo pretty_date(date('Y-m-d'), 'd F Y', false) ?></td>
    </tr>
    <tr>
      <td>Petugas</td>
    </tr>

  </table>
  <br><br><br><br>
  <table width="100%" style="font-size: 10pt;">
    <tr>
      <td><strong><u><span class="upper">( <?php echo $this->session->userdata('ufullname'); ?> )</span></u></strong></td>
    </tr>
  </table>


</body>

</html>