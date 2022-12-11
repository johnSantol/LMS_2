<?php 
include 'connection/connection.php';
if(isset($_GET['s_id']) && isset($_GET['s_id']) > 0){
$sr = $_GET['s_id'];
 $gID = $sr;  

// $sql = "UPDATE `libraryvisitors` SET `Status`='OFFLINE' WHERE `SR_Code` = $sr_id";
// $sql = "UPDATE `libraryvisitors` SET `Status`='OFFLINE' WHERE `SR_Code` = '$sr_id'";
$sql = "UPDATE `libraryvisitors` SET `Status`='OFFLINE' WHERE `SR_Code` = '$gID'";
 mysqli_query($conn,$sql);

if(($sql)){
header("location:ShowStudents.php");	
}
}
 ?>