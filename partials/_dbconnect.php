<?php
  
  // connecting database :

  $servername='localhost';
  $username='root';
  $password='';
  $database='users';

  $connect = mysqli_connect($servername,$username,$password,$database);

  if(!$connect){
      die("Failed to Connect Database ".mysqli_connect_error());
  }
?>