<style type="text/css">
.thead{
font-weight:bold;
padding:5px;
}
.col-blue{
color:blue;
}
.col-red{
color:red;
}

<table>
<tr><td colspan="6" class='thead'><p style='text-align:center;'> IKATAN DOKTER INDONESIA </p></td> </tr>
<tr><td  colspan="6" class='thead'><p style='text-align:center;'> KABUPATEN SUBANG</p></td> </tr> 
<tr><td  colspan="6" class='thead'><p style='text-align:center;'> Dicetak <?php echo date('d-M-Y  H:i:s');?> </p></td> </tr> 
</table>
<table>
<tr><td colspan="6" class='thead'></td> </tr>
</table>

<table border="1">
<tr style="background-color:#e6e6e6;line-height: 14px;">
	<td class='thead' style="text-align:center" >NO</td>
	<td class='thead' style="text-align:center" >NPA</td>
	<td class='thead' style="text-align:center" >NAMA</td>
	<td class='thead' style="text-align:center" >WILAYAH</td>
	<td class='thead' style="text-align:center" >CABANG</td>
	<td class='thead' style="text-align:center" >STATUS AKUN</td>
</tr>
<?php $no=1;

foreach($data as $dataDB)
{			 
	$id=isset($dataDB->id_admin)?($dataDB->id_admin):'';
	$npa=isset($dataDB->npa)?($dataDB->npa):'';
	$profilename=isset($dataDB->profilename)?($dataDB->profilename):'';
	$profileimg=isset($dataDB->profileimg)?($dataDB->profileimg):'';
	$profileaddress=isset($dataDB->profileaddress)?($dataDB->profileaddress):'';
	$status=isset($dataDB->sts_aktif)?($dataDB->sts_aktif):'';
	
	/*$tgl_lahir=isset($dataDB->tanggal_lahir)?($dataDB->tanggal_lahir):'';
	if($tgl_lahir!=''){$tanggal_lahir=$this->tanggal->ind($tgl_lahir,0);}else{$tanggal_lahir="";}*/
	
	$from_provincy=isset($dataDB->from_provincy)?($dataDB->from_provincy):'';
	$from_branch=isset($dataDB->from_branch)?($dataDB->from_branch):'';

	/*$kelasDB=$this->db->where("kode",$kd_kelas);
	$kelasDB=$this->db->get("tm_kelas")->row();
	$kelas=isset($kelasDB->kelas)?($kelasDB->kelas):'';*/
	
	if($status=='1'){
		$sts='Aktif';
	}else{
		$sts='Tidak Aktif';
	}
	
	
	echo "<tr>
	<td style='text-align:center'>".$no++."</td>
	<td style='text-align:center'>".$npa."</td>
	<td style='text-align:center'>".$profilename."</td>
	<td style='text-align:center'>".$from_provincy."</td>
	<td style='text-align:center'>".$from_branch."</td>
	<td style='text-align:center'>".$sts."</td>
	</tr>";	
	

}
?>						 
</table>


<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Report-data-member-idisubang.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
?>