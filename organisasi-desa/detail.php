<?php
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

}else{
    echo "<script>window.location.href='/SkripsiHera/organisasi-desa/index.php?action=2'</script>";
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
                        <a class="navbar-brand" href="#">Detail Organisasi Desa</a>
                    </nav>
                    <br>
                        <div class="form-group row">
                            <label for="nama_org" class="col-sm-2 col-form-label">Nama Organisasi</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="nama_org" name="nama_org" required value="<?= $data['nama_org'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_ketua" class="col-sm-2 col-form-label">Nama Ketua</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="nama_ketua" name="nama_ketua" required value="<?= $data['nama_ketua'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_telp" class="col-sm-2 col-form-label">No. Telp Ketua</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="no_telp" name="no_telp" required value="<?= $data['no_telp'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <textarea class="form-control-plaintext" readonly rows="5" id="deskripsi" name="deskripsi" required><?= $data['deskripsi'] ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gambar_struktur" class="col-sm-2 col-form-label">Gambar Struktur Organisasi</label>
                            <div class="col-sm-10">
                                <img src="/SkripsiHera/img/org-desa/<?= $data['gambar_struktur'] ?>" class="img-fluid" alt="">
                            </div>
                        </div>
                </div>
            </div>
        </div>

    </div>

<?php include '../footer.php' ?>