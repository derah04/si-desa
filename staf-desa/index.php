<?php
    session_start();

    include '../connection.php';

    $sql="SELECT * FROM staf_desa";
    $OrganisasiDesaCollection=mysqli_query($connection,$sql);
    mysqli_close($connection);

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
                    <div class="alert alert-success alert-dismissible" role="alert" id="alertForm" style="display: none;">
                        <p>message</p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <br>
                    <a href="/SkripsiHera/staf-desa/create.php" class="btn btn-primary float-right">Tambah Staf Desa</a>
                    <br>
                    <br>
                    <table class="table">
                        <thead class="thead-dark primary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Gambar Staf</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $index = 1;
                            while ($row=mysqli_fetch_array($OrganisasiDesaCollection,MYSQLI_ASSOC)){
                        ?>
                            <tr>
                                <th scope="row"> <?= $index ?></th>
                                <td><img src="/SkripsiHera/img/staf-desa/<?= $row['gambar_staf'] ?>" alt="" width="200px"><br>
                                    <a href="/SkripsiHera/img/staf-desa/<?= $row['gambar_staf'] ?>" target="_blank">LARGE VIEW</a> </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="/SkripsiHera/staf-desa/detail.php?id=<?= $row['id'] ?>" class="btn btn-secondary">detail</a>
                                        <a href="/SkripsiHera/staf-desa/update.php?id=<?= $row['id'] ?>" class="btn btn-primary">edit</a>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal_<?= $row['id'] ?>" >delete</button>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="confirmModal_<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmModalLabel">Konfirmasi</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Anda yakin akan menghapus staf ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                    <form action="index.php" method="post">
                                                        <input type="hidden" name="staf_id" value="<?= $row['id'] ?>">
                                                        <input type="submit" class="btn btn-danger" value="Ya" name="deleteStaf">
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            <?php $index++; } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>

<?php include '../footer.php' ?>

<?php
    if(isset($_SESSION["action_code"])){

        $result = $_SESSION["action_code"];
        if($result == 1){
            echo "<script>
            $('#alertForm').show();
            $('#alertForm p').html('Data berhasil disimpan');
            </script>";
        }else if($result == 2){
            echo "<script>
            $('#alertForm').show();
            $('#alertForm p').html('Data tidak ditemukan');
            </script>";
        }else if($result == 3){
            echo "<script>
            $('#alertForm').show();
            $('#alertForm p').html('Data berhasil dihapus');
            </script>";
        }
        unset($_SESSION["action_code"]);

    }else if(isset($_POST['deleteStaf'])){

        include '../connection.php';

        $insertQuery = "DELETE FROM staf_desa where id = " . $_POST['staf_id'];

        if (!mysqli_query($connection, $insertQuery)) {
            echo "<script>
            $('#alertForm').show();
            $('#alertForm').html(\" " . mysqli_error($connection) . " \");
            </script>";
            mysqli_close($connection);

        }else{
            mysqli_close($connection);
            $_SESSION["action_code"] = 3;
            echo "<script>window.location.href='/SkripsiHera/staf-desa/index.php'</script>";

        }

    }
?>
