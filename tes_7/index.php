<?php
include 'connection.php';

$siswa=$db->query("select * from siswa");
$data_siswa=$siswa->fetchAll();

if(isset($_POST['search']))
{
    $filter=$_POST['search'];
    $search=$db->prepare("select * from siswa where nama_siswa=? or sekolah=? or maotivasi=?"); // PDO statement
    $search->bindValue(1,$filter,PDO::PARAM_STR);
    $search->bindValue(2,$filter,pdo::PARAM_STR);
    $search->bindValue(3,$filter,pdo::PARAM_STR);
    $search->execute();     //Execution of PDO statement

    $tampil_data=$search->fetchAll(); //Result from PDO statement
    $row=$search->rowCount(); //Result from PDO statement
    
}

$temp_arr=[];

foreach ($siswa as $key) {
//    var_dump($key[0]);
   $temp_arr[]=$key[0];
}
$pilihan=array_unique($temp_arr);
// var_dump($pilihan);

// End pilihan

// Blok filter
$tampilkan_nama=[];
if(isset($_POST['filter']))
{
    // echo "tes";
    // var_dump($_POST['filter']);
    $filter=$_POST['filter'];
    if($filter == "")
    {
        $tampilkan_siswa=$merk;
    }else{
        foreach($nama as $key)
        {
            if($key[0] == $filter){
                $tampilkan_siswa[]=[$key[0],$key[1],$key[2]];
            }
        }
    }
}else{
    $tampilkan_siswa=$siswa;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Nama Siswa</title>
    <!-- <link rel="shortcut icon" href="gaming.png" type="image/x-icon"> -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
  </head>
  
  <body>
    <div class="d-flex">
        <h2 class="mx-auto">~Daftar Siswa~</h2>
    </div>
    <br>
    <br>

<div class="container">
    <div class="row">
        <div class="col">
            <table class="table table-striped">
                <thead class="bg-secondary">
                    <tr>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col">Sekolah</th>
                        <th scope="col">Motivasi</th>
                        <th scope="col">Ubah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data_siswa as $key):?>
                        <tr>
                            <td><?php echo $key['nama_siswa'];?></td>
                            <td><?php echo $key['sekolah'];?></td>
                            <td><?php echo $key['maotivasi'];?></td>
                            <td><a class="btn btn-danger" data-toggle="modal" data-target="#oop"><i class="fas fa-user-times"></i>
                            </a> <a class="btn btn-warning" href="edit.php?id_siswa=<?php echo $key['id_siswa']; ?>"><i class="fas fa-users-cog"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

      
<br>
<br>
<br>
  <!-- pencarian -->

  <!-- <div class="d-flex"> -->
<div class="container">
    <div class="row">
            <div class="col mx-auto">
                <h3 class="text-info">Cari Data Siswa</h3>
                <?php if(isset($row)):?>
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <p class="lead"><?php echo $row;?> Data Di Temukan</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php endif ;?>
                <form class="from-inline" action="index.php" method="POST">
                        <input type="text" class="from-control" name="search" placeholder="nama atau pekerjaan">
                        <button type="submit" class="btn btn-secondary">
                        <i class="fas fa-search"></i>
                        </button>
                </form>
            </div>
        </div>  
    </div>  
</div>

<br>
<br>
  <!-- from input daftar -->

  

  <!-- pop up -->
<div class="modal" id="oop" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>warning if deleted, the data you choose will be lost !!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-window-close"></i></button>
        <a type="button" class="btn btn-primary " href="delete.php?id_siswa=<?php echo $key['id_siswa']; ?>"><i class="fas fa-trash-alt"></i></a>
      </div>
    </div>
  </div>
</div>

<!-- launch demo  -->
<!-- Button trigger modal -->
<div class="container">
    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-primary mx-auto" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-user-plus"></i>
            </button>
        </div>
    </div>
</div>
<br>
<br>
<br>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Masukan Nama Siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="container">
      <div class="row">
          <div class="col">
          <form action="input.php" method="POST">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Nama Siswa</label>
                      <input type="text" name="nama_siswa" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Sekolah</label>
                      <input type="text" name="sekolah" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Motivasi</label>
                      <input type="text" name="maotivasi" class="form-control">
                  </div>

                  <button type="submit" class="btn btn-success"><i class="fas fa-save"></i></button>
              </form>
          </div>
      </div>
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close"></i></button>
      </div>
    </div>
  </div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>