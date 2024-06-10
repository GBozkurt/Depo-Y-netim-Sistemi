<?php
    session_start();
    if(!isset($_SESSION["id"])){
        echo $_SESSION["id"];
        header('location:admin.php');
    
    }
    else{
        

    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'connect.php';
        $id=$_SESSION["id"];
        unset($_SESSION["id"]);
        if ($_FILES['pImage']['error'] == UPLOAD_ERR_OK && !empty($_FILES['pImage']['tmp_name'])){
            $pName= $_POST["pName"];
            $pCount=$_POST["pCount"];
            $pPrice=$_POST["pPrice"];
            $image = $_FILES['pImage']['tmp_name'];
            $imageData = file_get_contents($image);
            $sql="UPDATE `product`SET pName='$pName', pCount=$pCount,pPrice=$pPrice,pImage= ? WHERE id=$id";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $imageData);
            if ($stmt->execute()) {
                header('location:admin.php');}
            else{header('location:admin.php');}
            $stmt->close();
            $conn->close();
        }
        else{
            $pName= $_POST["pName"];
            $pCount=$_POST["pCount"];
            $pPrice=$_POST["pPrice"];
            $sql="UPDATE `product`SET pName='$pName', pCount=$pCount,pPrice=$pPrice WHERE id=$id";
            $result=mysqli_query($conn,$sql);
            if($result){
                header('location:admin.php');
            }
            else{header('location:admin.php');}
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

    <div class="container mt-5 w-50"  >
        <form action="edit.php" method="post" enctype="multipart/form-data">
                
            <?php
                session_start();
                $id=$_SESSION["id"];
                include 'connect.php';
                $sql = "SELECT * FROM `product` WHERE id=$id";
                $result= mysqli_query($conn,$sql);
                if($result){
                    $row = $result->fetch_assoc();
                    $pName= $row["pName"];
                    $pCount = $row["pCount"];
                    $pPrice = $row["pPrice"];
                    $pImage = $row["pImage"];
                    echo"<div class='mb-3'>
                            <label for='productName' class='form-label'>Ürün adı</label>
                            <input type='text' class='form-control' id='productName' value='$pName'  name='pName'>
                        </div>
                    
                        <div class='mb-3'>
                            <label for='productCount' class='form-label'>Ürün sayısı</label>
                            <input type='number' class='form-control' id='productCount' value='$pCount' name='pCount'>
                        </div>
        
                        <div class='mb-3'>
                            <label for='productPrice' class='form-labe'>Ürün fiyatı</label>
                            <input type='number' class='form-control' id='productPrice' value='$pPrice' name='pPrice'>
                        </div>
                        <div class='mb-3'>
                            <label for='productPicture' class='form-label'>Ürün resmi</label>
                            <img src='data:image/jpeg;base64,". base64_encode($pImage) ."' style='width: 300px; height: 200px;' alt='$pName'>
                            <input type='file' name='pImage' id='productPrice'  class='form-control'>
                        </div>";
                }
            ?>
            
    
            <button type="submit" class="btn btn-primary w-100" name="submit">Ürün Güncelle</button>
        </form>
    </div>

  <div class="container ">
    <a href="logout.php" class="btn btn-primary fixed-bottom-right">Çıkış</a>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>