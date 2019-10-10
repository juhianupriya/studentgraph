<?php
$connect = mysqli_connect("localhost", "root", "", "student");
$message = '';

if(isset($_POST["upload"]))
{
 if($_FILES['file']['name'])
 {
  $filename = explode(".", $_FILES['file']['name']);
  if(end($filename) == "csv")
  {
   $handle = fopen($_FILES['file']['tmp_name'], "r");
   while($data = fgetcsv($handle))
   {
    $exam_id = mysqli_real_escape_string($connect, $data[0]);
    $year = mysqli_real_escape_string($connect, $data[1]);  
                $pass = mysqli_real_escape_string($connect, $data[2]);
    $total = mysqli_real_escape_string($connect, $data[3]);
    $query = "
     UPDATE test 
     SET year = '$year', 
     pass = '$pass', 
     total = '$total' 
     WHERE exam_id = '$exam_id' ";
    mysqli_query($connect, $query);
   }
       fclose($handle);
        header("location: exam.php?updation=1");
  }
  else
  {
   $message = '<label class="text-danger">Please Select CSV File only</label>';
  }
 }
 else
 {
  $message = '<label class="text-danger">Please Select File</label>';
 }
}

if(isset($_GET["updation"]))
{
 $message = '<label class="text-success">Product Upload Done</label>';
}



?>
<!DOCTYPE html>
<html>
 <head>
  <title> Upload CSV File using PHP</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
   <body>
     <br />
        <div class="container">
         <h2 align="center">Upload CSV File using PHP</a></h2>
          <br />
           <form method="post" enctype='multipart/form-data'>
           <p><label>Please Select File(Only CSV Formate)</label>
           <input type="file" name="file" /></p>
           <br />
           <input type="submit" name="upload" class="btn btn-info" value="Upload" />
           <a href="graph.php" class="btn btn-primary" role="button">view in graph</a>
   </form>
   <br />
   <?php echo $message; ?>
   
  </div>
 </body>
</html>

