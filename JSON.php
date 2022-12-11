<?php
include 'connection/connection.php';
    $srcode=$_POST['srcode'];
    $fullname=$_POST['fullname'];
    $status = "ONLINE";
    // $timestamp = $_POST['timestamp'];
    
    $search = "SELECT * FROM `libraryvisitors` WHERE `SR_Code` = '$srcode'";
    $result = mysqli_query($conn, $search);
    if (mysqli_num_rows($result) > 0) {
        // echo json_encode(array("statusCode"=>200));
        $Stat = "SELECT * FROM `libraryvisitors` WHERE `SR_Code` = '$srcode'";

        if($row = mysqli_fetch_assoc(mysqli_query($conn, $Stat))) {
            $getStatus = $row['Status'];
            echo $getStatus;
           if($getStatus == "ONLINE"){
            $insertLog = "INSERT INTO `logs`(`StudentID`, `Status`) VALUES ('$srcode','Time-Out')";
             $update = "UPDATE `libraryvisitors` SET `status`='OFFLINE' WHERE  `SR_Code`= '$srcode'";
             mysqli_query($conn, $insertLog);
             mysqli_query($conn, $update);
             // echo json_encode(array("statusCode"=>200));
             // echo "okay";
            }
         
         else{
            // $update = "UPDATE `logs` SET `status`='Time-In' WHERE  `StudentID`= '$srcode'";
            // mysqli_query($conn, $update);
            // echo "time-in";
            $sql2 = "INSERT INTO `logs`(`StudentID`, `Status`) VALUES ('$srcode','Time-In')";
        mysqli_query($conn, $sql2);
         $update = "UPDATE `libraryvisitors` SET `status`='ONLINE' WHERE  `SR_Code`= '$srcode'";
             mysqli_query($conn, $update);
            // echo json_encode(array("statusCode"=>200));

         }
            } 
        // }
        // $update = "UPDATE `logs` SET `In`='$timestamp',`Out`='' WHERE  `StudentID`= '$srcode'";
        // $results=mysqli_query($conn, $update);
        // if($result){
        //     echo json_encode(array("statusCode"=>200));
        // }
        // else{
        //     echo json_encode(array("statusCode"=>201));
        // }

    }

    else{
        $insert = "INSERT INTO `libraryvisitors`(`SR_Code`, `Fullname`, `Status`) VALUES ('$srcode','$fullname','$status')";
        mysqli_query($conn, $insert);
        $sql2 = "INSERT INTO `logs`(`StudentID`, `Status`) VALUES ('$srcode','Time-In')";
        mysqli_query($conn, $sql2);
        // echo "not existed";
        echo "insert";
        echo json_encode(array("statusCode"=>201));

    }
    // $sql1 = "INSERT INTO `logs`(`SR_Code`, `Fullname`, `Status`) VALUES ('$srcode','$fullname','$status')";
    // $sql2 = "INSERT INTO `logs`(`StudentID`, `In`, `Out`) VALUES ('$srcode','','')"
    // $sql3 = "UPDATE `libraryvisitors` SET `SR_Code`='[value-1]',`Fullname`='[value-2]',`Status`='[value-3]' WHERE 1"
    // if (mysqli_query($conn, $sql)) {
    //     // echo json_encode(array("statusCode"=>200));
    // } 
    // else {
    //     // echo json_encode(array("statusCode"=>201));
    // }
    // mysqli_close($conn);
?>
