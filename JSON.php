<?php
include 'connection/connection.php';
    $srcode=$_POST['srcode'];
    $fullname=$_POST['fullname'];
    $status = "ONLINE";
    $limitsql = "SELECT * FROM `libraryinfo`";
    $limit= mysqli_query($conn, $limitsql);
    $search = "SELECT * FROM `libraryvisitors` WHERE `SR_Code` = '$srcode'";
    $result = mysqli_query($conn, $search);
    if (mysqli_num_rows($result) > 0) {
        $Stat = "SELECT * FROM `libraryvisitors` WHERE `SR_Code` = '$srcode'";
        $row = mysqli_fetch_assoc(mysqli_query($conn, $Stat))
        $limitval = mysqli_fetch_assoc(mysqli_query($limit));
        $getOcc = $limitval['OccupiedSlots'];
        $getUnocc = $limitval['UnoccupiedSlots'];
        $getMax = $limitval['MaxSlots'];
        echo $getOcc;
        if($row) {
            $getStatus = $row['Status'];
            echo $getStatus;
            if($getStatus == "OFFLINE" && $getOcc < $getMax){
    $insertLog = "INSERT INTO `logs`(`StudentID`, `Status`) VALUES ('$srcode','Time-In')";
    mysqli_query($conn, $insertLog);
    $update = "UPDATE `libraryvisitors` SET `status`='ONLINE' WHERE  `SR_Code`= '$srcode'";
    mysqli_query($conn, $update);
    $getCount = "SELECT COUNT(*) FROM `libraryvisitors` WHERE `Status` = 'ONLINE'";
    $Count = mysqli_fetch_assoc(mysqli_query($conn, $getCount));
    $occ = $Count[0];
     $updateSlots = "UPDATE `libraryinfo` SET `OccupiedSlots`='$occ'";
    mysqli_query($conn, $updateSlots);
            }
         
         else{
    $insertLog = "INSERT INTO `logs`(`StudentID`, `Status`) VALUES ('$srcode','Time-Out')";
    mysqli_query($conn, $insertLog);
    $update = "UPDATE `libraryvisitors` SET `status`='OFFLINE' WHERE  `SR_Code`= '$srcode'";
    mysqli_query($conn, $update);
         }
            } 
        

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

    // mysqli_close($conn);
?>
