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
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Transaksi Bulanan</h3>
                        <a href="<?php echo site_url('manage/payout?n=' . $payment['period_period_id'] . '&r=' . $student['student_nis']) ?>" class="btn btn-danger btn-xs pull-right"><i class="fa fa-random"></i> <b>&nbsp;KEMBALI</b></a>
                    </div>
                    <div class="box-body">
                        <table class="table table-hover table-striped table-bordered">
                        <tr >
								<th class="text-center">PEMBAYARAN</th>
								<th class="text-center">Jumlah Bayar</th>
								<th class="text-center">Kekurangan Bayar</th>
								<th class="text-center">Status</th>
								
							</tr>
                            <tbody>
                                <?php 
                                $i = 1; 
                                foreach ($bulan as $row) :
                                $mont = ($row['month_month_id'] <= 6) ? $row['period_start'] : $row['period_end'];
                                $p = $this->db->query("SELECT SUM(bulan_pay_bill) AS Total FROM bulan_pay where bulan_bulan_id = $row[bulan_id]")->row_array();
                                $sisa = $row['bulan_bill'] - $p['Total'];
                                $tt = $p['Total'];
                                    ?>
				
                                    <tr>
                                        <td class="text-left"><b><?php echo $row['month_name']; ?> <?php echo $mont ?></b></td>
                                        <input type="hidden" name="bulan_id[]" value="<?php echo $row['bulan_id'] ?>">
                                        <td class="<?php echo ($row['bulan_status'] == 1) ? 'danger' : 'success' ?> text-center">
                                            <a href="<?php echo ($row['bulan_status'] == 0) ? site_url('manage/payout/pay/' . $row['payment_payment_id'] . '/' . $row['student_student_id'] . '/' . $row['bulan_id']) : site_url('manage/payout/not_pay/' . $row['payment_payment_id'] . '/' . $row['student_student_id'] . '/' . $row['bulan_id']) ?>" onclick="return confirm('<?php echo ($row['bulan_status'] == 0) ? 'Anda Akan Melakukan Pembayaran bulan ' . $row['month_name'] . '?' : 'Anda Akan Menghapus Pembayaran bulan ' . $row['month_name'] . '?' ?>')" class="btn btn-xs btn-danger">
                                                <b><?php echo ($row['bulan_status'] == 1) ? '(' . pretty_date($row['bulan_date_pay'], 'd/m/y', false) . ')' : number_format($row['bulan_bill'], 0, ',', '.') ?></b></a>
                                        </td>
                                        <td class="<?php echo ($row['bulan_status'] == 1) ? 'success' : 'danger' ?> text-center">
                                            <a data-toggle="modal" data-target="#viewcicil<?php echo $row['bulan_id'] ?>"  class="btn btn-xs btn-success">Rp.<b><?php echo number_format($sisa, 0, ',', '.') ?></b></a>
                                        </td>
                                        <td class="<?php echo ($row['bulan_status'] == 1) ? 'success' : 'danger' ?> text-center">
                                            <a data-toggle="modal" data-target="#addDesc<?php echo $row['bulan_id'] ?>" class="btn btn-xs btn-success"><i class="fa fa-file-text-o margin-r-5"></i><b>Bayar Cicilan</b></a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="addDesc<?php echo $row['bulan_id'] ?>" role="dialog">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Tambah Pembayaran / Angsuran</h4>
                                                </div>
                                                <?php echo form_open('manage/payout/update_pay_desc/', array('method' => 'post')); ?>
                                                <div class="modal-body">
                                                    <input type="hidden" name="bulan_id" value="<?php echo $row['bulan_id'] ?>">
                                                    <input type="hidden" name="student_student_id" value="<?php echo $row['student_student_id'] ?>">
                                                    <input type="hidden" name="student_nis" value="<?php echo $row['student_nis'] ?>">
                                                    <input type="hidden" name="period_period_id" value="<?php echo $row['period_period_id'] ?>">
                                                    <input type="hidden" name="payment_payment_id" value="<?php echo $row['payment_payment_id'] ?>">
                                                    <div class="form-group">
													        <label>Nama Pembayaran</label>
													        <input class="form-control" readonly="" type="text" value="<?php echo $row['pos_name'] . ' - T.A ' . $row['period_start'] . '/' . $row['period_end'] ?>">
													</div>
                                                    <div class="form-group">
															<label>Tanggal</label>
															<input class="form-control" required="" type="date" name="bulan_pay_input_date" value="<?php echo pretty_date(date('Y-m-d'), 'd F Y', false) ?>">
													</div>
                                                    <div class="form-group">
															<label>Kekurangan Bayar</label>
															<input class="form-control" readonly="" type="text" value="<?php echo number_format($sisa, 0, ',', '.') ?>">
													</div>
                                                    <div class="row">
                                                       <div class="col-md-12">
                                                            <label>Cicilan *</label>
                                                            <input type="text" required="" name="bulan_pay_bill" value="<?php echo $sisa ?>" class="form-control numeric" placeholder="Jumlah Bayar">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>Keterangan *</label>
                                                            <input type="text" required="" name="bulan_pay_desc"  class="form-control" placeholder="Keterangan">
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-save margin-r-5"></i><b>SIMPAN DATA</b></button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i><b> TUTUP</b></button>
                                                </div>
                                            </div>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="viewcicil<?php echo $row['bulan_id'] ?>" role="dialog">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Lihat Cicilan</h4>
                                                </div>
                                              
                                                <div class="modal-body">
                                                <div class="container">
                                                    <div class="heading">
                                                        <div class="col">KETERANGAN</div>
                                                        <div class="col">TANGAL BAYAR</div>
                                                        <div class="col">CICILAN</div>
                                                    </div>
                                                    <?php $query = $this->db->query("SELECT * FROM bulan_pay where bulan_bulan_id =$row[bulan_id];");
                                                    foreach ($query->result_array() as $x)
                                                    { ?>
                                                    <div class="table-row">                                                       
                                                        <div class="col"><?php echo $x['bulan_pay_input_date'] ?></div>
                                                        <div class="col"><?php echo $x['keterangan'] ?></div>
                                                        <div class="col">Rp. <?php echo number_format($x['bulan_pay_bill'], 0, ',', '.') ?></div>
                                                    </div>
                                                    <?php
                                                    } 
                                                    ?> 
                                                    
                                                    <div class="table-row">
                                                        <div class="col"></div>
                                                        <div class="col">TOTAL BAYAR</div>
                                                        <div class="col">Rp. <?php echo number_format($tt, 0, ',', '.') ?></div>
                                                    </div>
                                                    <div class="table-row">
                                                        <div class="col"></div>
                                                        <div class="col">KURANG BAYAR</div>
                                                        <div class="col">Rp. <?php echo number_format($sisa, 0, ',', '.') ?></div>
                                                    </div>
                                                </div>
                                             
                                                </div>
                                                <div class="modal-footer">
                                                  
                                                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i><b> TUTUP</b></button>
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Detail Identitas</h3>
                        <?php if ($this->session->userdata('uroleid') == SUPERUSER) { ?>
                            <a href="<?php echo site_url('manage/payment/edit_payment_bulan/' . $row['payment_payment_id'] . '/' . $row['student_student_id']) ?>" class="btn btn-primary btn-xs pull-right"><i class="fa fa-edit"></i><b>&nbsp;Edit Tarif Pembayaran</b></a>
                        <?php } ?>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Jenis Pembayaran</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="<?php echo $payment['pos_name'] . ' - T.P ' . $payment['period_start'] . '/' . $payment['period_end'] ?>" readonly="">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Tahun Pelajaran</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="<?php echo $payment['period_start'] . '/' . $payment['period_end'] ?>" readonly="">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Tipe Pembayaran</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="<?php echo ($payment['payment_type'] == 'BULAN' ? 'Bulanan' : 'Bebas') ?>" readonly="">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">NIM</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" readonly="" value="<?php echo $student['student_nis'] ?>">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" readonly="" value="<?php echo $student['student_full_name'] ?>">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Kelas</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" readonly="" value="<?php echo $student['class_name'] ?>">
                            </div>
                        </div>
                        <br>
                        <?php if (majors() == 'senior') { ?>
                            <div class="form-group">
                                <label for="" class="col-sm-4 control-label">Program Jurusan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly="" value="<?php echo $student['majors_name'] ?>">
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
</section>
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