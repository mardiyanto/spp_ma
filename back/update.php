<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php

$host="localhost"; /* Host name */
$username="miua2886_spp"; /* Mysql username */
$password="m4rd1best"; /* Mysql password */
$db_name="miua2886_spp"; /* Database name */
$tbl_name="student"; /* Table name */

/* Connect to server and select databse. */
mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");

$sql="SELECT * FROM $tbl_name WHERE majors_majors_id='1'";
$result=mysql_query($sql);

/* Count table rows */
$count=mysql_num_rows($result);
?>
<?php

/* Check if button name "Submit" is active, do this */
if(isset($_POST['Submit']))
{
	$count=count($_POST["student_id"]);
	
for($i=0;$i<$count;$i++){
$sql1="UPDATE $tbl_name SET student_nis='" . $_POST['student_nis'][$i] . "', student_nisn='" . $_POST['student_nisn'][$i] . "', student_full_name='" . $_POST['student_full_name'][$i] . "' WHERE  student_id='" . $_POST['student_id'][$i] . "'";
$result1=mysql_query($sql1);
 echo '
				   <div class="alert alert-success" role="alert">
				   Data berhasil disimpan ke dalam basis data.
				   </div>
				   <script>
					   setTimeout(function() {
						   window.location.href = "update.php";
					   }, 3000); // Delay 3 detik sebelum mengalihkan
				   </script>';
}
}

echo $count;
mysql_close();
?>
<table class="table" width="500" border="0" cellspacing="1" cellpadding="0">
<form name="form1" method="post" action="">
<tr>
<td>
<table width="500" border="0" cellspacing="1" cellpadding="0">

<tr>
<td align="center"><strong>Id</strong></td>
<td align="center"><strong>NIS</strong></td>
<td align="center"><strong>NISN</strong></td>
<td align="center"><strong>NAMA</strong></td>
<td align="center"><strong>KELAS</strong></td>
</tr>

<?php
while($rows=mysql_fetch_array($result)){
?>

<tr>
<td align="center">
<input  class="input-group-text" name="student_id[]" type="text" id="student_id" value="<?php echo $rows['student_id']; ?>">

</td>
<td align="center">
<input  class="input-group-text" name="student_nis[]" type="text" id="student_nis" value="<?php echo $rows['student_nis']; ?>">
</td>
<td align="center">
<input  class="input-group-text" name="student_nisn[]" type="text" id="student_nisn" value="<?php echo $rows['student_nisn']; ?>">
</td>
<td align="center">
<input  class="input-group-text" name="student_full_name[]" type="text" id="student_full_name" value="<?php echo $rows['student_full_name']; ?>">
</td>
<td align="center">
<?php echo $rows['class_class_id']; ?>
</td>
</tr>

<?php
}
?>

<tr>
<td colspan="4" align="center"><input type="submit" class="btn btn-primary btn-lg" name="Submit" value="Submit"></td>
</tr>
</table>
</td>
</tr>
</form>
</table>