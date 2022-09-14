<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['kullaniciadi']);
      $mypassword = mysqli_real_escape_string($db,$_POST['sifre']); 
      $mypassword = md5($mypassword);
      
      $sonuc = mysqli_query($db,$girissql);
      $sonucrow = mysqli_fetch_array($sonuc,MYSQLI_ASSOC);
      
      
      $sonucsay = mysqli_num_rows($sonuc);
      
    
		
      if($sonucsay == 1) {
         
         $_SESSION['kullanici'] = $myusername;
         
         header("location: welcome.php");
      }else {
          echo '<div class="alert alert-danger" role="alert">
          Giriş bilgileri hatalı!
        </div>';
      }
   }
?>

<html>
   
   <head>
      <title>Hagen Panel Girişi</title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    
      
   </head>
   <style>
      body{
         margin: 10px;
         padding: 10px;
      }
   </style>
   <body bgcolor = "#FFFFFF">
    
    <div class="card mx-auto bg-light pt-5 col-sm-10"style="">
    <center>
   <h1>Anka Reklam</h1>
   <h3>Sadakat Paneli Girişi</h3>
   </center>
   <form class="p-5" method="POST">
  
  <div class="list-group">
    <input type="text" class="form-control list-group-item" name="kullaniciadi" placeholder="Kullanıcı Adı">
    <input type="password" class="form-control list-group-item" name="sifre" placeholder="Şifre">
  </div><br>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="hatirla">
    <label class="form-check-label" for="hatirla">Beni Hatırla</label>
  </div>
  <button type="submit" class="btn btn-primary">Giriş</button>
</form>
</div>
               
              

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
   </body>

</html>
