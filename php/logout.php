<?php
  require_once 'auth.php';
  
  setcookie("PHPSESSID" , '', 1, '/') ; 
  session_destroy() ; 
    
  header("Location: login.php") ;
  