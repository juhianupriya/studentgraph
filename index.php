<?php
	$conn = mysqli_connect("localhost", "root", "", "csv");
	
	if(isset($_POST["submit"]))
	{
        
        $filename=$_FILES["file"]["tmp_name"];    
         if($_FILES["file"]["size"] > 0)
         {
            $file = fopen($filename, "r");
                fgetcsv($file);
			
              while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
               {
                 $sql = "INSERT into test (year,pass,total) 
                       values ('".$getData[0]."','".$getData[1]."','".$getData[2]."')";
                       $result = mysqli_query($conn, $sql);
            if(!isset($result))
            {
              echo "<script type=\"text/javascript\">
                  alert(\"Invalid File:Please Upload CSV File.\");
                  window.location = \"index.php\"
                  </script>";    
            }
            else {
                echo "<script type=\"text/javascript\">
                alert(\"CSV File has been successfully Imported.\");
                window.location = \"index.php\"
              </script>";
            }
               }
          
               fclose($file);  
         }
      }   
      ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
  <p align="center" style="font-size:30px;">upload csv file</p>
	<div style="margin:50px; border: 2px solid red;background: green;">
		<form method="post" action="index.php" enctype="multipart/form-data">
		<p align="center">	<input type="file" name="file">
			
			<input type="submit" name="submit" value="upload"></p>
      <br/>
      <p align="center"><button><a href="graph.php" style="text-decoration: none;">data show in graph</a></button></p>
		</form>
	</div>

</body>
</html>