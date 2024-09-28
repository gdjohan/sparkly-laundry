<?php
include "db_conn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>Sparkly Laundry</title>
</head>

<body>
  <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
    Sparkly
  </nav>

  <div class="container">
    <?php
    if (isset($_GET["msg"])) {
      $msg = $_GET["msg"];
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>

    <a href="index.php" class="btn btn-light mb-3">Home</a>
    <a href="cuci.php" class="btn btn-light mb-3 mx-1">Cuci</a>
    <a href="ambil.php" class="btn btn-dark mb-3">Ambil</a>
    <a href="riwayat.php" class="btn btn-light mb-3 mx" style="float: right;">Riwayat</a>


    <div class="text-center mb-4">
      <h3>Pengambilan Cucian</h3>
      <p class="text-muted">Transaksi</p>
    </div>
    
    <table class="table table-hover text-center">
      <thead class="table-dark">
        <tr>
          <th scope="col">Nota no.</th>
          <th scope="col">Tanggal Masuk</th>
          <th scope="col">Nama Pelanggan</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      
      <tbody>
        <?php
        $sql = "SELECT * FROM `penerimaan` WHERE keterangan = 1";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr>
            <td><?php echo $row["no_nota"] ?></td>
            <td><?php echo $row["tgl_masuk"] ?></td>
            <td><?php echo $row["nm_pelanggan"] ?></td>
            <td>
              <a href="transaksi.php?no_nota=<?php echo $row['no_nota'] ?>&kd_layanan=<?php echo $row['kd_layanan'] ?>&kd_barang=<?php echo $row['kd_barang'] ?>&jumlah=<?php echo $row['jumlah'] ?>"class="link-dark"><i class = "fa-solid fa-square-check fs-5"></i></a>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html


