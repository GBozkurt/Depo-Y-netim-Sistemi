<?php
session_start();
if(!isset($_SESSION["username"])){
  header('location:login.php');
  
}
else{
  
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
          <a class="nav-link active" aria-current="page" href="index.php">Anasayfa</a>
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
      <form class="d-flex" method="post" action="index.php">
        <input class="form-control me-2" type="text" name="pName" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
    <!--NAVBAR BİTİŞ -->
  
  <h1 class="link" style="text-align: center; margin-top: 30px;">Hoşgeldin <?php
  echo $_SESSION["name"];
  ?></h1>

<div class="card-group">
<?php
  include 'connect.php';
  $sql = "SELECT * FROM `product`";
  $result= mysqli_query($conn,$sql);
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $pName=$_POST["pName"];
    $sql = "SELECT * FROM `product` WHERE pName='$pName'";
    $result= mysqli_query($conn,$sql);
  }
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
      $pName= $row["pName"];
      $pCount = $row["pCount"];
      $pPrice = $row["pPrice"];
      $pImage = $row["pImage"];
      
      echo"
      <div class='col'>
        <div class='card m-3' style='width: 18rem; '>
          <img src='data:image/jpeg;base64,". base64_encode($pImage) ."' class=card-img-top' alt='$pName'>
          <div class='card-body'>
            <h5 class='card-title'>Ürün Adı: $pName</h5>
            <h5 class='card-text'>Ürün Sayısı: $pCount</h5>
            <h5 class='card-text'>Ürün Fiyatı: $pPrice TL</h5>
          </div>
          </div></div>";
    }
    
  }

  
?>
</div>
  <div class="container ">
    <a href="logout.php" class="btn btn-primary fixed-bottom-right">Çıkış</a>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>