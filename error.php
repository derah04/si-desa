<?php

// cek jika ada parameter ?code=xxx pada url web
if(isset($_GET['code'])){

    //mengambil nilai parameter code dan menyimpan nilanya kedalam variable $errorCode;
    $errorCode = $_GET['code'];

    if($errorCode == 1){
        echo "Koneksi Gagal ke database";
    }

}else{
    echo "No error detected";
}
