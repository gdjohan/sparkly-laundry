<?php
include "db_conn.php";
$no_nota = $_GET["no_nota"];
$kd_layanan = $_GET['kd_layanan'];
$kd_barang = $_GET['kd_barang'];
$jumlah = $_GET['jumlah'];
$harga_barang_sql = "SELECT harga FROM barang WHERE kd_barang = '$kd_barang'";
$harga_layanan_sql = "SELECT multiplier_harga FROM layanan WHERE kd_layanan = '$kd_layanan'";

$harga_barang = mysqli_fetch_assoc(mysqli_query($conn, $harga_barang_sql))['harga'];
$harga_layanan = mysqli_fetch_assoc(mysqli_query($conn, $harga_layanan_sql))['multiplier_harga'];

$total = $jumlah * $harga_barang * $harga_layanan;


if (isset($_POST["submit"])) {
    if (empty($_POST['tgl_keluar'])) {
        echo "<div class='alert alert-danger' role='alert'>Lengkapi tanggal pengambilan!</div>";
    } else {
        $tgl_keluar = $_POST['tgl_keluar'];

        $sql = "INSERT INTO `pengambilan`(`no_nota`, `tgl_ambil`, `total`) VALUES ('$no_nota', '$tgl_keluar', '$total')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: index.php?msg=New transaction created successfully");
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
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
            <h3>Pengambilan Cucian</h3>
            <p class="text-muted">Lengkapi formulir di bawah ini untuk pengambilan cucian.</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width:50vw; min-width:300px;">
                <div class="mb-3">
                    <label class="form-label">Tanggal ambil:</label>
                    <input type="date" class="form-control" name="tgl_keluar" placeholder="dd/mm/yyyy">
                </div>

                <div class="mb-3">
                    <label class="form-label">Total Harga:</label>
                    <input type="text" class="form-control" name="total" value="Rp<?php echo $total ?>" disabled>
                </div>

                <div>
                    <button type="submit" class="btn btn-success my-5" name="submit">Save</button>
                    <a href="index.php" class="btn btn-danger mx-2 my-5">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>