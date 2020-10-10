<?php

include "connection.php";



$input=$db->exec("insert into siswa(nama_siswa,sekolah,maotivasi) values('".$_POST['nama_siswa']."','".$_POST['sekolah']."','".$_POST['maotivasi']."')");
$input=$db->exec("insert into tim(nama_tim) values('".$_POST["nama_tim"]."')");
if($input)
{
    header("Location:index.php");
}

