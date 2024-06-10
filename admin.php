<?php
session_start();
if($_SESSION["auth"]!=1){
  header('location:index.php');
  
}
else{
  
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["submitButton"])) {
      $submitButtonValue = $_POST["submitButton"];
      $id=$_POST["id"];
      echo$id;  
      session_start();
      $_SESSION["id"] = $id;
      echo $_SESSION["id"];
      if ($submitButtonValue == "submitButton1") {
          header('location:edit.php');
      } elseif ($submitButtonValue == "submitButton2") {
          header('location:delete.php');
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
  

    <table class="table m-3">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Ürün adı</th>
      <th scope="col">Ürün sayısı</th>
      <th scope="col">Ürün Fiyatı</th>
      <th scope="col">İşlemler</th>
    </tr>
    
  </thead>
  <tbody>
  <?php
  include 'connect.php';
  $sql = "SELECT * FROM `product`";
  $result= mysqli_query($conn,$sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
      $id=$row["id"];
      $pName= $row["pName"];
      $pCount = $row["pCount"];
      $pPrice = $row["pPrice"];
      $pImage = $row["pImage"];
      
     echo"<tr>
     <th scope='row'>$id</th>
     <td>$pName</td>
     <td>$pCount</td>
     <td>$pPrice</td>
     <td><form method='post' action='admin.php'>
     <input type='hidden' name='id' value='$id'>
     <button type='submit' class='btn btn-success' name='submitButton' value='submitButton1'>Düzenle</button>
     <button type='submit' class='btn btn-danger' name='submitButton' value='submitButton2'>Sil</button>
 </form>
   </tr>";
    }
  }
?>
  </tbody>
</table>
    <div class="container ">
    <a href="add.php" class="btn btn-primary fixed-bottom-admin">Ekle</a>
  </div>
  
  <div class="container ">
    <a href="logout.php" class="btn btn-primary fixed-bottom-right">Çıkış</a>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>