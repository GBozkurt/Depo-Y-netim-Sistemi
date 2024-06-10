<?php
session_start();
if($_SESSION["auth"]!=1){
  header('location:index.php');
}
else{ 
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    $user=0;
    $success=0;
    include 'connect.php';
    $image = $_FILES['pImage']['tmp_name'];
    $imageData = file_get_contents($image);
    $pName = $_POST['pName'];
    $pCount = $_POST['pCount'];
    $pPrice = $_POST['pPrice'];
    $sqlC="SELECT * FROM `product` WHERE pName='$pName'";
    $result=mysqli_query($conn,$sqlC);
    if($result){
        if(mysqli_num_rows($result)>0){
            $user=1;
        }
        else{
            
            $sql="INSERT INTO `product` (pCount,pImage,pName,pPrice) values(?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "issi", $pCount, $imageData, $pName, $pPrice);
            if (mysqli_stmt_execute($stmt)) {
                $success=1;
                header('location:index.php');
            } else {
                echo "Hata: " . mysqli_error($conn);
            }
            mysqli_close($conn);
            
        }
    }
    
    
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Anasayfa</title>
    <link rel="stylesheet" href="resim.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>

  <body class="bgh">
    <!--NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-dark "  data-bs-theme="dark">
        <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">Depo</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">Anasayfa</a>
            </li>
            <li class="nav-item"> 
            <?php
                session_start();
                if($_SESSION["auth"]==1){
                echo'<a class="nav-link active" aria-current="page" href="admin.php">Yönetici</a>';
                }
            ?>
            </li>
            
            
            
        </ul>
       
        </div>
        </div>
    </nav>
    <!--NAVBAR BİTİŞ -->
    <?php
    if($user==1){
    echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Üzgünüz!</strong> Ürün bulunmaktadır.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';}
  if($success==1){
    echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Harika!</strong> Ürün başarıyla keydedildi.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';}
    ?>
    <div class="container mt-5 w-50"  >
        <form action="add.php" method="post" enctype="multipart/form-data">
        
            <div class="mb-3">
                <label for="productName" class="form-label">Ürün adı</label>
                <input type="text" class="form-control" id="productName"  name="pName">
            </div>
            
            <div class="mb-3">
                <label for="productCount" class="form-label">Ürün sayısı</label>
                <input type="number" class="form-control" id="productCount" name="pCount">
            </div>

            <div class="mb-3">
                <label for="productPrice" class="form-labe">Ürün fiyatı</label>
                <input type="number" class="form-control" id="productPrice" name="pPrice">
            </div>
            <div class="mb-3">
                <label for="productPicture" class="form-label">Ürün resmi</label>
                <input type="file" name="pImage" id="productPrice" class="form-control">
            </div>
    
            <button type="submit" class="btn btn-primary w-100" name="submit">Ürün Ekle</button>
        </form>
    </div>

  <div class="container ">
    <a href="logout.php" class="btn btn-primary fixed-bottom-right">Çıkış</a>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>