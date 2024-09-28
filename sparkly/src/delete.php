<?php
include "db_conn.php";
$no_nota = $_GET["id"];
$sql = "DELETE FROM `penerimaan` WHERE no_nota = $no_nota";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: index.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}