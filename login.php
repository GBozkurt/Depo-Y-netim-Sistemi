<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
  
  
  echo $_SESSION["username"];
  $login=0;
  $fail=0;
  include 'connect.php';
  $username=$_POST['username'];
  $password=$_POST['password'];
  
  $sql="SELECT auth,name FROM `register` WHERE username='$username' AND password='$password'";
  $result= mysqli_query($conn,$sql);
  if($result){
    if(mysqli_num_rows($result)>0){
      
      $row = $result->fetch_row();
      $data = $row[0];
      $name= $row[1];
      session_start();
      $_SESSION["username"] = $username;
      $_SESSION["name"] = $name;
      $_SESSION["auth"] = $data;
      $login=1;
      echo $_SESSION["username"];
      header('location:index.php');

    }
    else{
          $fail=1;
    }
    
  }
    
  
}

    
?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Giriş sayfası</title>
    <link rel="stylesheet" href="resim.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body class="bgs">
  <?php
    if($fail==1){
    echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Üzgünüz!</strong> Yanlış kullanıcı adı veya şifre.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';}

  if($login==1){
    echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Harika!</strong> Giriş başarıyla yapıldı.
    <button type="button" class="btn-close" data-bs-dismiss="al ert" aria-label="Close"></button>
  </div>';}
    ?>
  <div class="mx-auto" style="width: 300px;margin-top:120px;">
  <h1 class="header">Giriş sayfası</h1>
</div>
    <div class="container mt-5 w-50"  >
    <form action="login.php" method="post">
    
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label" >Kullanıcı adı</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username">
    
  </div>
 
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Parola</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
  </div>
  
  <a href="signup.php"  class="link">Hesabınız yok mu? Oluşturalım. </a>
  
  <button type="submit" class="btn btn-primary w-100">Giriş yap</button>
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>

