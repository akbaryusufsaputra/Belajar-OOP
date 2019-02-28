<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Coba OOP</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="dist/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="dist/css/style.css">


  <?php 

  require 'controller.php';
  $perintah = new oop();
  $table = "tb_siswa";

  $senbud = $perintah->tampil("tb_senbud");
  $upd = $perintah->tampil("tb_upd");
  $view = $perintah->tampil("siswa_view");

  if (isset($_GET['edit'])) {
    $edit = $perintah->selectWhere($table,"nis",$_GET['nis']);
  }

  if (isset($_GET['hapus'])) {
    $nis = $_GET['nis'];
    $perintah->delete($table,"nis",$nis,"index.php");
  }

  if (isset($_POST['simpan'])) {
      $nis = $_POST['nis'];
      $nama = $_POST['nama'];
      $rombel = $_POST['rombel'];
      $rayon = $_POST['rayon'];
      $id_senbud = $_POST['id_senbud'];
      $id_upd = $_POST['id_upd'];

      $values = "'','$nis','$nama','$rombel','$rayon','$id_senbud','$id_upd'";

      $cek = $perintah->countWhere("nis","nis",$table,"nis",$nis);

      if ($cek['nis'] > 0) {
        echo "<script>alert('Nis tidak boleh sama');document.location.href='index.php'</script>";
      }
      else{
        $perintah->simpan($table,$values,"index.php");
      }
  }

  if (isset($_POST['edit'])) {
      $nis = $_POST['unis'];
      $nama = $_POST['nama'];
      $rombel = $_POST['rombel'];
      $rayon = $_POST['rayon'];
      $id_senbud = $_POST['id_senbud'];
      $id_upd = $_POST['id_upd'];

      $isi = "nis='$nis',nama='$nama',rombel='$rombel',rayon='$rayon',id_sembud='$id_senbud',id_upd='$id_upd'";

      $perintah->ubah($table,$isi,"nis",$nis,"index.php");
  }

 ?>

</head>

<body>
  <div id="app">
    <div class="container-fluid mt-4">
      <div class="row">
        <div class="col-md-4">
        <div class="card">
          <form method="post">
            <div class="card-header">
              <h4>Senbud - UPD</h4>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label>Nis</label>
                <input type="text" name="nis" class="form-control" value="<?= @$edit['nis'] ?>" <?php if (isset($_GET['edit'])){echo "disabled";} ?> required="">
                <input type="hidden" name="unis" value="<?= @$edit['nis'] ?>">
              </div>
              <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="<?= @$edit['nama'] ?>" required="">
              </div>
              <div class="form-group">
                <label>Rombel</label>
                <input type="text" name="rombel" class="form-control" value="<?= @$edit['rombel'] ?>">
              </div>
              <div class="form-group mb-0">
                <label>Rayon</label>
                <input class="form-control" name="rayon" required="" value="<?= @$edit['rayon'] ?>">
              </div>
              <div class="row mt-4">
                <div class="col-md-6">
                  <div class="form-group mb-0">
                    <label>Senbud</label>
                    <select class="form-control" name="id_senbud">
                      <?php 
                        foreach ($senbud as $datas) { ?>
                          <option value="<?php echo $datas['id'] ?>"><?php echo $datas['senbud']." - ".$datas['hari'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group mb-0">
                    <label>UPD</label>
                    <select class="form-control" name="id_upd">
                      <?php 
                        foreach ($upd as $datas) { ?>
                          <option value="<?php echo $datas['id'] ?>"><?php echo $datas['upd']." - ".$datas['hari'] ?></option>
                          
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer text-right">
              <?php if (isset($_GET['edit'])) { ?>
                <button class="btn btn-success" name="edit">Edit</button>
                <a class="btn btn-danger" href="index.php">Cancel</a>
              <?php }else{ ?>
                <button class="btn btn-primary" name="simpan">Simpan</button>
              <?php } ?>
            </div>
          </form>
        </div>
      </div>

      <div class="col-md-8">
        
        <div class="card">
          <div class="card-header">
            <h4>Full Width</h4>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-striped table-md">
                <tbody><tr>
                  <th>#</th>
                  <th>Nis</th>
                  <th>Nama</th>
                  <th>Rombel</th>
                  <th>Rayon</th>
                  <th>Senbud</th>
                  <th>UPD</th>
                  <th>Opsi</th>
                </tr>
                <?php
                $no = 1; 
                foreach ($view as $data) { ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $data['nis'] ?></td>
                  <td><?= $data['nama'] ?></td>
                  <td><?= $data['rombel'] ?></td>
                  <td><?= $data['rayon'] ?></td>
                  <td><?= $data['senbud'] ?></td>
                  <td><?= $data['upd'] ?></td>
                  <td colspan="2">
                      <div class="btn-group">
                          <a href="?page=barang&edit&nis=<?= $data['nis'] ?>" class="btn btn-info">Edit</a>
                    <a onclick="return confirm('Yakin Ingin Menghapus?')" href="?page=barang&hapus&nis=<?= $data['nis'] ?>" class="btn btn-danger">Hapus</a>
                  </div>
                      </td>
                </tr>
              <?php } ?>
              </tbody></table>
            </div>
          </div>
          <div class="card-footer text-right">
          
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="dist/modules/jquery.min.js"></script>
  <script src="dist/modules/popper.js"></script>
  <script src="dist/modules/tooltip.js"></script>
  <script src="dist/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="dist/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="dist/modules/sweetalert/sweetalert.min.js"></script>
  <script src="dist/js/page/modules-sweetalert.js"></script>
  <script src="dist/modules/moment.min.js"></script>
  <script src="dist/js/stisla.js"></script>
  
  <!-- JS Libraies -->

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="dist/js/scripts.js"></script>
  <script src="dist/js/custom.js"></script>
</body>
</html>