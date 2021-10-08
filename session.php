<?php
   include('config.php');
   session_start();
   
  
   
   if(!isset($_SESSION['kullanici'])){
      header("location:index.php");
      die();
   }
?>