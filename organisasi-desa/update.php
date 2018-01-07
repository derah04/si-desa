<?php
    session_start();
    include '../connection.php';

    if(isset($_GET['id'])){

        $id = $_GET['id'];
        $sql="SELECT * FROM organisasi_desa WHERE id=" . $id;
        $OrgDesaResult=mysqli_query($connection,$sql);
        $data=mysqli_fetch_array($OrgDesaResult,MYSQLI_ASSOC);
        mysqli_close($connection);

        if($data == null){
            echo "<script>window.location.href='/SkripsiHera/organisasi-desa/index.php?action=2'</script>";
        }

    }else if(isset($_POST['updateOrg'])){
        include '../connection.php';

        $idOrg = $_POST['id_org'];
        $namaOrg = $_POST['nama_org'];
        $namaKetua = $_POST['nama_ketua'];
        $noTelp = $_POST['no_telp'];
        $deskripsi = $_POST['deskripsi'];
        $gambarStruktur = '';
        $gambarFile = $_FILES["gambar_struktur"];

        if($gambarFile['size'] == 0){
            $gambarStruktur = $_POST['old_img'];
        }else{
            // 3 baris code untuk upload gambar
            $target_dir = $_SERVER['DOCUMENT_ROOT']."/SkripsiHera/img/org-desa/";
            $target_file = $target_dir . basename($_FILES["gambar_struktur"]["name"]);
            move_uploaded_file($_FILES["gambar_struktur"]["tmp_name"], $target_file);
            $gambarStruktur = basename($_FILES["gambar_struktur"]["name"]);
        }

        $updateQuery = "UPDATE organisasi_desa SET nama_org = '$namaOrg', nama_ketua = '$namaKetua', no_telp = '$noTelp', deskripsi = '$deskripsi', gambar_struktur = '$gambarStruktur' WHERE id =" . $idOrg;

        if (!mysqli_query($connection, $updateQuery)) {
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

    }else{
        $_SESSION["action_code"] = 2;
        echo "<script>window.location.href='/SkripsiHera/organisasi-desa/index.php'</script>";
    }

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
                    <a class="navbar-brand" href="#">Ubah Organisasi Desa</a>
                </nav>
                <br>
                <div class="alert alert-danger" role="alert" id="alertForm" style="display: none;">
                    This is a danger alert—check it out!
                </div>
                <br>
                <form method="post" action="update.php" enctype="multipart/form-data">
                    <input type="hidden" required name="id_org" value="<?= $data['id'] ?>">
                    <input type="hidden" required name="old_img" value="<?= $data['gambar_struktur'] ?>">

                    <div class="form-group row">
                        <label for="nama_org" class="col-sm-2 col-form-label">Nama Organisasi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_org" name="nama_org" required value="<?= $data['nama_org'] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_ketua" class="col-sm-2 col-form-label">Nama Ketua</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_ketua" name="nama_ketua" required value="<?= $data['nama_ketua'] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_telp" class="col-sm-2 col-form-label">No. Telp Ketua</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="no_telp" name="no_telp" required value="<?= $data['no_telp'] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5" id="deskripsi" name="deskripsi" required><?= $data['deskripsi'] ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="gambar_struktur" class="col-sm-2 col-form-label">Gambar Struktur Organisasi</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="gambar_struktur" name="gambar_struktur">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group text-center">
                        <input type="submit" class="btn btn-lg btn-primary" name="updateOrg" value="UBAH DATA" />
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<?php include '../footer.php' ?>