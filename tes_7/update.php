<?php

include 'connection.php';

$update=$db->exec("update siswa set nama_siswa='".$_POST['nama_siswa']."',sekolah='".$_POST['sekolah']."',maotivasi='".$_POST['maotivasi']."' where id_siswa=".$_POST['id_siswa']);

if($update)
{
    header("Location:index.php");
}


// var_dump($_POST);

?>