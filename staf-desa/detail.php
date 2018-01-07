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
                        <a class="navbar-brand" href="#">Detail Staf Desa</a>
                    </nav>
                    <br>
                        <div class="form-group row">
                            <label for="gambar_staf" class="col-sm-2 col-form-label">Gambar staf</label>
                            <div class="col-sm-10">
                                <img src="/SkripsiHera/img/staf-desa/<?= $data['gambar_staf'] ?>" class="img-fluid" alt="">
                            </div>
                        </div>
                </div>
            </div>
        </div>

    </div>

<?php include '../footer.php' ?>