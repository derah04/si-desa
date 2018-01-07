<?php

$connection = mysqli_connect("localhost","root","","heradb");

// Cek jika koneksi gagal
if (mysqli_connect_errno())
{
    //echo "Failed to connect to MySQL: " . mysqli_connect_error();

    // redirect ke error.php dengan mengirim parameter code dengan method GET
    header('location: error.php?code=1');
}