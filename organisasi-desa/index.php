<?php
    session_start();

    include '../connection.php';

    $sql="SELECT * FROM organisasi_desa";
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
                        <a class="navbar-brand" href="#">Kelola Organisasi Desa</a>
                    </nav>
                    <br>
                    <div class="alert alert-success alert-dismissible" role="alert" id="alertForm" style="display: none;">
                        <p>message</p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <br>
                    <a href="/SkripsiHera/organisasi-desa/create.php" class="btn btn-primary float-right">Tambah Organisasi</a>
                    <br>
                    <br>
                    <table class="table">
                        <thead class="thead-dark primary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Organisasi</th>
                            <th scope="col">Nama Ketua</th>
                            <th scope="col">No. Telp</th>
                            <th scope="col">Struktur</th>
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
                                <td><?= $row['nama_org'] ?></td>
                                <td><?= $row['nama_ketua'] ?></td>
                                <td><?= $row['no_telp'] ?></td>
                                <td><a href="/SkripsiHera/img/org-desa/<?= $row['gambar_struktur'] ?>" target="_blank">lihat</a></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="/SkripsiHera/organisasi-desa/detail.php?id=<?= $row['id'] ?>" class="btn btn-secondary">detail</a>
                                        <a href="/SkripsiHera/organisasi-desa/update.php?id=<?= $row['id'] ?>" class="btn btn-primary">edit</a>
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
                                                    Anda yakin akan menghapus <b><?= $row['nama_org'] ?></b>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                    <form action="index.php" method="post">
                                                        <input type="hidden" name="org_id" value="<?= $row['id'] ?>">
                                                        <input type="submit" class="btn btn-danger" value="Ya" name="deleteOrg">
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

    }else if(isset($_POST['deleteOrg'])){

        include '../connection.php';

        $insertQuery = "DELETE FROM organisasi_desa where id = " . $_POST['org_id'];

        if (!mysqli_query($connection, $insertQuery)) {
            echo "<script>
            $('#alertForm').show();
            $('#alertForm').html(\" " . mysqli_error($connection) . " \");
            </script>";
            mysqli_close($connection);

        }else{
            mysqli_close($connection);
            $_SESSION["action_code"] = 3;
            echo "<script>window.location.href='/SkripsiHera/organisasi-desa/index.php'</script>";

        }

    }
?>
