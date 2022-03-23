<?php 
$conn = mysqli_connect('localhost','root','Nestarypong003','yellowcard');

if(!$conn){
    echo "Error: Unable to Connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
 ?>