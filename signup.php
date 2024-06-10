<?php
if($_SERVER['REQUEST_METHOD']=='POST'){


  $user=0;
  $success=0;
    include 'connect.php';
    $username=$_POST['username'];
    $password=$_POST['password'];
    $email=$_POST['email'];
    $name=$_POST['name'];
    $sql="SELECT * FROM `register`";
    $result= mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        $auth=0;
    }
    else{
        $auth=1;
    }
    $sql2="SELECT * FROM `register` WHERE username='$username'";
    $result2= mysqli_query($conn,$sql2);
    if($result2){
      if(mysqli_num_rows($result2)>0){
        $user=1;
      }
      else{
        $verification= rand(10000,99999);
        $to = "grkmbozkurt2003@gmail.com";
        $subject = "Doğrulama";
        $message = "Doğrulama Kodunuz: ";
        $headers = 'From: gorkem_bozkurt_2003@hotmail.com\r\n';
        $headers .= 'Reply-To: gorkem_bozkurt_2003@hotmail.com\r\n';
        $headers .= 'Content-type: text/html\r\n';

        if (mail($to, $subject, $message, $headers)) {
            echo "E-posta başarıyla gönderildi.";
        } else {
          echo "E-posta gönderilirken bir hata oluştu: " . error_get_last()['message'];
        }
        
        $sql3="INSERT INTO `register` (name , username, password, email, auth, verification) values('$name','$username','$password','$email','$auth','$verification')";
        $result3= mysqli_query($conn,$sql3);
        if($result3){
            $success=1;
        }
        else{
            die(mysqli_error($conn));
        }
      }
    }
    
  
}

    
?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kayıt sayfası</title>
    <link rel="stylesheet" href="resim.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body class="bgs">
    <?php
    if($user==1){
    echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Üzgünüz!</strong> Kullanıcı adı kullanılmaktadır.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';}

  if($success==1){
    echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Harika!</strong> Kaydınız başarıyla yapıldı.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';}
    ?>
  <div class="mx-auto " style="width: 300px;margin-top:70px;">
  <h1 class="header">Kayıt sayfası</h1>
</div>
    <div class="container mt-5 w-50" >
    <form action="signup.php" method="post">
    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Ad</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name">
    
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Kullanıcı adı</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username">
    
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email </label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
    
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Parola</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
  </div>
  <div class="mb-1">
    <a href="login.php" class="link">Zaten bir hesabınız var mı? </a>
  </div>
  <button type="submit" class="btn btn-primary w-100">Kayıt ol</button>
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>

