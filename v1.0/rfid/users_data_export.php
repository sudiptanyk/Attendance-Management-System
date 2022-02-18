<?php  
session_start();
 $connect = mysqli_connect("localhost", "root", "", "rfid_data"); 
 $username= $_SESSION['username'];
 if (!isset($_SESSION['username'])) { 
    $_SESSION['msg'] = "You have to log in first"; 
    header('location:start.php'); 
}
 if(isset($_POST["export"]))  
 {  
      $connect = mysqli_connect("localhost", "root", "", "rfid_data");  
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");
      fputcsv($output, array('SL No.', 'ID', 'STATUS','NAME','REGD','TIME','DATE'));  
      $query = "SELECT * from status where NAME='$username'";  
      $result = mysqli_query($connect, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }  
 ?>  