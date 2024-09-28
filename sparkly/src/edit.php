<?php
include "db_conn.php";
$no_nota = $_GET["id"];

if (isset($_POST["submit"])) {
  $tgl_masuk = $_POST['tgl_masuk'];
  $nm_pelanggan = $_POST['nm_pelanggan'];
  $alamat = $_POST['alamat'];
  $no_telp = $_POST['no_telp'];
  $kd_barang = $_POST['kd_barang'];
  $kd_layanan = $_POST['kd_layanan'];
  $jumlah = $_POST['jumlah'];
  $keterangan = $_POST['keterangan'];

  $sql = "UPDATE `penerimaan` SET `tgl_masuk`='$tgl_masuk',`nm_pelanggan`='$nm_pelanggan',`alamat`='$alamat',`no_telp`='$no_telp',
  `kd_barang`='$kd_barang',`kd_layanan`='$kd_layanan',`jumlah`='$jumlah',`keterangan`='$keterangan' WHERE no_nota = '$no_nota'";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location: index.php?msg=Data updated successfully");
  } else {
    echo "Failed: " . mysqli_error($conn);
  }
}

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
      <div class="text-center mb-4">
         <h3>Edit Data Penerimaan Cucian</h3>
         <p class="text-muted">Lengkapi formulir di bawah untuk mengedit data cucian masuk. tekan "update" untuk menyimpan perubahan.</p>
      </div>

    <?php
    $sql = "SELECT * FROM `penerimaan` WHERE no_nota = '$no_nota' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

<div class="container d-flex justify-content-center">
         <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="mb-3">
               <label class="form-label">Tanggal Masuk:</label>
               <input type="date" class="form-control" name="tgl_masuk" placeholder="dd/mm/yyyy" value="<?php echo $row['tgl_masuk'] ?>">
            </div>

            <div class="mb-3">
               <label class="form-label">Nama Pelanggan:</label>
               <input type="text" class="form-control" name="nm_pelanggan" placeholder="Input nama pelanggan" value="<?php echo $row['nm_pelanggan'] ?>">
            </div>

            <div class="mb-3">
               <label class="form-label">Alamat:</label>
               <input type="text" class="form-control" name="alamat" placeholder="Input alamat pelanggan" value="<?php echo $row['alamat'] ?>">
            </div>

            <div class="mb-3">
               <label class="form-label">Nomor Telepon:</label>
               <input type="tgl_masuk" class="form-control" name="no_telp" placeholder="Input nomor telepon pelanggan" value="<?php echo $row['no_telp'] ?>">
            </div>

            <?php
            $selected_barang = $row['kd_barang'];
            $selected_layanan = $row['kd_layanan'];
            $selected_keterangan = $row['keterangan'];
            ?>

            <div class="mb-3">
               <label class="form-label" for="kd_barang">Jenis Barang</label>
               <select class="form-select" name="kd_barang" id="kd_barang">
                  <option <?php if($selected_barang == 'CLOTHES'){echo("selected");}?> value="CLOTHES">Pakaian</option>
                  <option <?php if($selected_barang == 'BEDDING'){echo("selected");}?> value="BEDDING">Selimut</option>
                  <option <?php if($selected_barang == 'DOLL'){echo("selected");}?> value="DOLL">Boneka</option>
               </select>
            </div>

            <div class="mb-3">
               <label class="form-label" for="kd_layanan">Jenis Layanan</label>
               <select class="form-select" name="kd_layanan" id="kd_layanan">
                  <option <?php if($selected_layanan == 'STD'){echo("selected");}?> value="STD">Standard</option>
                  <option <?php if($selected_layanan == 'EXP'){echo("selected");}?> value="EXP">Express</option>
               </select>
            </div>

            <div class="mb-3">
               <label class="form-label">Jumlah:</label>
               <input type="text" class="form-control" name="jumlah" placeholder="Input jumlah" value="<?php echo $row['jumlah'] ?>">
               <p><small>Pakaian dan selimut (kg). Boneka (pcs).</small></p>
               <p><small>Satuan kilogram dapat berupa desimal.</small></p>
            </div>

            <input type="hidden" name="keterangan" value="Diproses">

            <div>
               <button type="submit" class="btn btn-success my-5" name="submit">Save</button>
               <a href="index.php" class="btn btn-danger mx-2 my-5">Cancel</a>
            </div>
         </form>
      </div>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>