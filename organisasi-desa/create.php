<?php
session_start();
?>

<?php include '../header.php' ?>
    <br>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
                <?php include '../sidemenu.php' ?>
            </div>
            <div class="col-sm-10">
                <div class="container-fluid">
                    <nav class="navbar navbar-light bg-light">
                        <a class="navbar-brand" href="#">Kelola Organisasi Desa</a>
                    </nav>
                    <br>
                    <div class="alert alert-danger" role="alert" id="alertForm" style="display: none;">
                        This is a danger alert—check it out!
                    </div>
                    <br>
                    <form method="post" action="create.php" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="nama_org" class="col-sm-2 col-form-label">Nama Organisasi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_org" name="nama_org" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_ketua" class="col-sm-2 col-form-label">Nama Ketua</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_ketua" name="nama_ketua" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_telp" class="col-sm-2 col-form-label">No. Telp Ketua</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="no_telp" name="no_telp" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" id="deskripsi" name="deskripsi" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gambar_struktur" class="col-sm-2 col-form-label">Gambar Struktur Organisasi</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="gambar_struktur" name="gambar_struktur" required>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-lg btn-primary" name="simpanOrg" value="SIMPAN" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

<?php include '../footer.php' ?>

<?php
    if(isset($_POST['simpanOrg'])){

        include '../connection.php';

        $namaOrg = $_POST['nama_org'];
        $namaKetua = $_POST['nama_ketua'];
        $noTelp = $_POST['no_telp'];
        $deskripsi = $_POST['deskripsi'];
        $gambarStruktur = basename($_FILES["gambar_struktur"]["name"]);

        // 3 baris code untuk upload gambar
        $target_dir = $_SERVER['DOCUMENT_ROOT']."/SkripsiHera/img/org-desa/";
        $target_file = $target_dir . basename($_FILES["gambar_struktur"]["name"]);
        move_uploaded_file($_FILES["gambar_struktur"]["tmp_name"], $target_file);

        $insertQuery = "INSERT INTO organisasi_desa (nama_org, nama_ketua, no_telp, deskripsi, gambar_struktur) VALUES ('$namaOrg', '$namaKetua', '$noTelp', '$deskripsi', '$gambarStruktur')";

        if (!mysqli_query($connection, $insertQuery)) {
            echo "<script>
            $('#alertForm').show();
            $('#alertForm').html(\" " . mysqli_error($connection) . " \");
            </script>";
            mysqli_close($connection);

        }else{
            mysqli_close($connection);
            $_SESSION["action_code"] = 1;
            echo "<script>window.location.href='/SkripsiHera/organisasi-desa/index.php'</script>";

        }

    }
?>
