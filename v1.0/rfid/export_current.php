<?php  
 if(isset($_POST["export_current"]))  
 {  
      $connect = mysqli_connect("localhost", "root", "", "rfid_data");  
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");
      fputcsv($output, array('NAME','REGD','ID'));  
      $query = "SELECT NAME,REGD,ID from attendance";  
      $result = mysqli_query($connect, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }  
 ?>  