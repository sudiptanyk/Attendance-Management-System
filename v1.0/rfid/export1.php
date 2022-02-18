<?php  
session_start();
 $connect = mysqli_connect("localhost", "root", "", "rfid_data");  
 if (!isset($_SESSION['username'])) { 
    $_SESSION['msg'] = "You have to log in first"; 
    header('location:start.php'); 
}
 $query ="SELECT * FROM status";  
 $result = mysqli_query($connect,$query);  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>EXPORT DATA</title>  
           <script type="text/javascript">
      history.pushState(null,null,location.href);
      window.onpopstate=function(){
        history.go(1);
      };
</script> 
      </head>  
      <style>
        p.big{
          line-height: 2.5;
        }
      </style>
      <body>  
        <center>
          <p>
                <h3 align="center">Employee Data</h3>
                <a href="http://localhost/rfid/options.php">Home Page</a> 
                </p>                  
                <br />  
                <form method="post" action="export.php" align="center">  
                     <input type="submit" name="export" value="Export" class="btn btn-success" />  
                </form>  
                <br />  
                <div class="table-responsive" id="employee_table">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th>SL No.</th>    
                               <th>ID</th>
                               <th>STATUS</th> 
                               <th>NAME</th>
                               <th>REGD</th>
                               <th>TIME</th> 
                               <th>DATE</th> 
                          </tr>  

                     <?php  
                     while($row = mysqli_fetch_array($result))  
                     {  
                     ?>  
                          <tr>  
                               <td><?php echo $row["SL No."]; ?></td>   
                               <td><?php echo $row["ID"]; ?></td>
                               <td><?php echo $row["STATUS"]; ?></td>
                               <td><?php echo $row["NAME"]; ?></td> 
                               <td><?php echo $row["REGD"]; ?></td> 
                               <td><?php echo $row["TIME"]; ?></td>
                               <td><?php echo $row["DATE"]; ?></td>
                          </tr>  
                     <?php       
                     }  
                     ?>  
                     </table>  
                </div>  
           </div>  
         </center>
      </body>  
 </html>  