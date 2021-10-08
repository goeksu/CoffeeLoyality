<?php
include('session.php');
?>
<html>

<head>
   <title>Anka Reklam Örnek Yönetici Paneli </title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>
<style>
   * {
      margin: 1px;
      padding: 1px;
   }

   #numara-ekle{
      text-decoration: underline;
   }

   .kisa-bilgi{
      float: right;
   }
   .navlinks{
      text-decoration: none;
      
      color:gray;
      margin-left: 10px;
   }
   .here{
      color:black;
   }
  
</style>

<body>

   <nav class="navbar navbar-light bg-light justify-content-between p-2">
      <a class="navbar-brand">Anka Reklam</a>
      <div class="navlinkc offset-md-6">
      <a href="#" class="navlinks here">Anasayfa</a>
      <a href="" class="navlinks">Müşteri İşlemleri</a>
      <a href="" class="navlinks">Yönetici İşlemleri</a></div>
      <form class="form-inline">
         <a href="logout.php">
            <div class="btn btn-outline-danger my-2 my-sm-0">Çıkış</div>
         </a>
      </form>
   </nav>

   <div class="card bg-light mx-auto m-5 col-md-10">
      <form class="p-5" method="POST">
         <label for="telefon">Kullanıcı Sorgula</label>
         <input type="hidden" name="action" value="sorgula">
         <div class="input-group">
            <input type="text" id="telefon" class="form-control" name="telefon" maxlength="11"placeholder="Telefon">
            <button type="submit" class="btn btn-primary">Sorgula</button>
         </div>
      </form>
      <div class="sonuc px-5">
      <?php
      if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['action'] == "sorgula") {
         
         
         $telefon = mysqli_real_escape_string($db,$_POST['telefon']);
         $telefonsorgu = "SELECT * FROM heroku_aa9d4e48d310743.musteriler WHERE telefon = '$telefon'";
         $telefonsonuc = mysqli_query($db,$telefonsorgu);
         $telefonrow = mysqli_fetch_array($telefonsonuc,MYSQLI_ASSOC);
         $telefonsay = mysqli_num_rows($telefonsonuc);
         if($telefonsay == 1) {
            
            echo '<div class="card mx-auto col-md-7" style="">
            
            <div class="card-body">
              <h5 class="card-title">'.$telefonrow['isim'].'</h5><button type="submit" class="btn btn-secondary btn-sm kisa-bilgi">Düzenle</button>
              <p class="card-text">'.$telefonrow['telefon'].'</p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item ">Ödül Hakkı: '.$telefonrow['odul'].'      <button type="submit" class="btn btn-warning btn-sm kisa-bilgi">Kullan</button></li>
              <li class="list-group-item">Toplam Alışveriş: '.$telefonrow['toplam'].'    <button type="submit" class="btn btn-warning btn-sm kisa-bilgi">+1</button></li>
              
            </ul>
            
          </div>';
            
          
         }else {
             echo '<div class="alert alert-danger" role="alert" id="alert">
             Böyle bir kayıt yok! <span id="numara-ekle" onclick="ekleformu()">Ekle?</span>
           </div>';
         }
      }

      if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['action'] == "ekle") {
         $isim = mysqli_real_escape_string($db,$_POST['isim']);
         $telefon = mysqli_real_escape_string($db,$_POST['telefon']);
         $eklesql = "INSERT INTO musteriler (isim, telefon) VALUES ('$isim', '$telefon')";
         if (mysqli_query($db, $eklesql)) {
            echo '<div class="alert alert-success" role="alert">
            '.$isim.' başarıyla eklendi
          </div>';
          } else {
            echo "Error: " . $eklesql . "<br>" . mysqli_error($db);
          }
      }
   ?>
   <div class="ekleme" style="display: none;" id="eklemeformu">
   <form class="" method="POST">
         <label for="isim">Kullanıcı Ekleme</label>
         <input type="hidden" name="action" value="ekle">
         <div class="input-group">
            <input type="text" id="isim" class="form-control" name="isim" placeholder="İsim">
            <input type="text" id="telefon" class="form-control" name="telefon" maxlength="11"placeholder="Telefon">
            <button type="submit" class="btn btn-primary">Ekle</button>
         </div>
      </form>
   </div>
   </div>
   </div>

  

   <div class="card bg-light mx-auto m-5 py-5 px-2 col-md-10">
      <label for="table">En İyi Müşteriler</label>
      <table class="table table-striped table-hover" id="table">
         <thead>
            <tr>
               <th scope="col">#</th>
               <th scope="col">Isım</th>
               <th scope="col">Telefon</th>
               <th scope="col">Toplam Alışveriş</th>
            </tr>
         </thead>
         <tbody>
            
            <?php
             $sira = 1;
            $musteriler = mysqli_query($db, "SELECT * FROM musteriler ORDER BY toplam desc limit 20");
            while ($musterilerrow = mysqli_fetch_array($musteriler)) {
               
               echo '<th scope="row">'.$sira++."</th>";
               echo "<td>" . $musterilerrow['isim'] . "</td>";
               echo "<td>" . $musterilerrow['telefon'] . "</td>";
               echo "<td>" . $musterilerrow['toplam'] . "</td>";
               echo "</tr>";
               
            }
            ?>
         </tbody>
      </table>
   </div>



<script>
function ekleformu() {
   var x = document.getElementById("eklemeformu");
  if (x.style.display === "none") {
   document.getElementById("alert").remove();
    x.style.display = "block";
    
  } 
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</body>

</html>