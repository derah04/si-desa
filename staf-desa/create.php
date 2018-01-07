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
                        <a class="navbar-brand" href="#">Kelola Staf Desa</a>
                    </nav>
                    <br>
                    <div class="alert alert-danger" role="alert" id="alertForm" style="display: none;">
                        This is a danger alert—check it out!
                    </div>
                    <br>
                    <form method="post" action="create.php" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="gambar_staf" class="col-sm-2 col-form-label">Gambar Staf</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="gambar_staf" name="gambar_staf" required>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-lg btn-primary" name="simpanStaf" value="SIMPAN" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

<?php include '../footer.php' ?>

<?php
    if(isset($_POST['simpanStaf'])){

        include '../connection.php';
        $gambarStaf = basename($_FILES["gambar_staf"]["name"]);

        // 3 baris code untuk upload gambar
        $target_dir = $_SERVER['DOCUMENT_ROOT']."/SkripsiHera/img/staf-desa/";
        $target_file = $target_dir . basename($_FILES["gambar_staf"]["name"]);
        move_uploaded_file($_FILES["gambar_staf"]["tmp_name"], $target_file);

        $insertQuery = "INSERT INTO staf_desa (gambar_staf) VALUES ('$gambarStaf')";

        if (!mysqli_query($connection, $insertQuery)) {
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

    }
?>
