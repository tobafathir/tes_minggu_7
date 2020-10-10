<?php

try {
    $db = new PDO("mysql:host=localhost;dbname=tes_minggu_7","root","",[PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION]);

} catch (Exception $e) {
    echo $e->getMessage();
}

$siswa=$db->query("select * from siswa"); //prepare statment

$data_siswa=$siswa->fetchAll();  //execute and get data as array

// var_dump($data_siswa);