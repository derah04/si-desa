<?php
    session_start();
    include '../connection.php';

    if(isset($_GET['id'])){

        $id = $_GET['id'];
        $sql="SELECT * FROM staf_desa WHERE id=" . $id;
        $stafDesaResult=mysqli_query($connection,$sql);
        $data=mysqli_fetch_array($stafDesaResult,MYSQLI_ASSOC);
        mysqli_close($connection);

        if($data == null){
            $_SESSION["action_code"] = 2;
            echo "<script>window.location.href='/SkripsiHera/staf-desa/index.php'</script>";
        }

    }else if(isset($_POST['updateStaf'])){
        include '../connection.php';

        $idStaf = $_POST['id_staf'];
        $gambarFile = $_FILES["gambar_staf"];

        if($gambarFile['size'] == 0){
            $gambarStruktur = $_POST['old_img'];
        }else{
            // 3 baris code untuk upload gambar
            $target_dir = $_SERVER['DOCUMENT_ROOT']."/SkripsiHera/img/staf-desa/";
            $target_file = $target_dir . basename($_FILES["gambar_staf"]["name"]);
            move_uploaded_file($_FILES["gambar_staf"]["tmp_name"], $target_file);
            $gambarStruktur = basename($_FILES["gambar_staf"]["name"]);
        }

        $updateQuery = "UPDATE staf_desa SET gambar_staf = '$gambarStruktur' WHERE id =" . $idStaf;

        if (!mysqli_query($connection, $updateQuery)) {
            echo "<script>
            $('#alertForm').show();
            $('#alertForm').html(\" " . mysqli_error($connection) . " \");
            </script>";
            mysqli_close($connection);

        }else{
            mysqli_close($connection);
            $_SESSION["action_code"] = 1;
            echo "<script>window.location.href='/SkripsiHera/staf-desa/index.php'</script>";

        }

    }else{
        $_SESSION["action_code"] = 2;
        echo "<script>window.location.href='/SkripsiHera/staf-desa/index.php'</script>";
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
                    <a class="navbar-brand" href="#">Ubah staf Desa</a>
                </nav>
                <br>
                <div class="alert alert-danger" role="alert" id="alertForm" style="display: none;">
                    message
                </div>
                <br>
                <form method="post" action="update.php" enctype="multipart/form-data">
                    <input type="hidden" required name="id_staf" value="<?= $data['id'] ?>">
                    <input type="hidden" required name="old_img" value="<?= $data['gambar_staf'] ?>">

                    <div class="form-group row">
                        <label for="gambar_staf" class="col-sm-2 col-form-label">Gambar Staf</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="gambar_staf" name="gambar_staf" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group text-center">
                        <input type="submit" class="btn btn-lg btn-primary" name="updateStaf" value="UBAH DATA" />
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<?php include '../footer.php' ?>