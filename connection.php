<?php
    function dbConnect(){
    $server = "localhost";
    $username = "root"; //both XXAMPP and MAMP use root
    $password = "root"; //XXAMPP => use "" ,MAMP => "root"
    $db_name = "minimart_catalog";

    $conn = new mysqli($server, $username, $password, $db_name);
    // the new mysqli($server, $username, $password, $db_name) make a connection to the database
    // $conn is assign to $conn

    if($conn->connect_error) //check if this is an error in th connection 
    {
      die("Failed to connect to the database: ".$conn->connect_error);
    } else
    {
      // echo "Conecction Successful";
      return $conn;
    }
  }
?>