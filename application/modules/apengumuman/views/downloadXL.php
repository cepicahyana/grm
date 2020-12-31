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
</style>
<table>
<tr><td colspan="5" class='thead'><p style='text-align:center;'> DATA PENGUMUMAN </p></td> </tr>
<tr><td  colspan="5" class='thead'><p style='text-align:center;'> Dicetak <?php echo date('d-M-Y  H:i:s');?> </p></td> </tr> 
</table>
<table>
<tr><td colspan="5" class='thead'></td> </tr>
</table>

<table border="1">
<tr style="background-color:#e6e6e6;line-height: 14px;">
	<td class='thead' style="text-align:center" >NO</td>
	<td class='thead' style="text-align:center" >DIBUAT</td>
	<td class='thead' style="text-align:center;min-width:300px" >JUDUL</td>
	<td class='thead' style="text-align:center;min-width:100px" >STATUS</td>
	<td class='thead' style="text-align:center" >VIEWER</td>
</tr>
<?php $no=1;

foreach($data as $dataDB)
{			 
	$id=isset($dataDB->id)?($dataDB->id):'';
	$judul=isset($dataDB->judul)?($dataDB->judul):'';
	$sts=isset($dataDB->sts)?($dataDB->sts):'';
	$viewer=isset($dataDB->viewer)?($dataDB->viewer):'0';
	$arraysatu=explode(",",$viewer); //potong
	$d = "";
	foreach($arraysatu as $i=>$array_satu):
		$d .= ",'".$array_satu."'";
	endforeach;
	$arraysatu_d = substr($d,1); //convert
	
	$arraysatu1=$arraysatu[0]; //array awal
	if($viewer>0){
		$jmlrow=count($arraysatu); //jumlah row	
		$jmlrowsatu=$jmlrow-1;
	}else{
		$jmlrowsatu='0'; //jumlah row	
	}
	
	$_ctime=isset($dataDB->_ctime)?($dataDB->_ctime):'';
	if($_ctime!=''){$tanggal_=$this->tanggal->inddatetime($_ctime," ");}else{$tanggal_="";}
	

	echo "<tr>
	<td style='text-align:center'>".$no++."</td>
	<td style='text-align:center'>".$tanggal_."</td>
	<td style='text-align:center'>".$judul."</td>
	<td style='text-align:center'>".$sts."</td>
	<td style='text-align:center'>".$jmlrowsatu."</td>
	</tr>";	
	

}
?>						 
</table>


<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Data-pengumuman.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
?>