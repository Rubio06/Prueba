<?php
function Conectarse(){
  $server = "localhost";
  $user = "root";
  $pass = "";
  $bd = "prueba";

  $cn = mysqli_connect($server, $user, $pass) or die("No se pudo conectar con la base de datos");
  mysqli_select_db($cn, $bd) or die("La conexion es fallida");
  return $cn;
  
}