<?php 
ini_set('display_errors', 1);
require('db/database.php');
$db->select("movies");
$db->orderBy("filmName","ASC");
$movies = $db->fetchData();
//var_dump($movies);
?>
<!DOCTYPE html>
<html lang="en">
<head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <title>Class Based Site :: CMS List</title>
          <link href="css/bootstrap.min.css" rel="stylesheet">
          <link href="css/styles.css" rel="stylesheet">
</head>
<body>
<div class="container">
	<?php include('includes/header.inc.php'); ?>
    <div class="row">
    <div class="col-md-12">
   	<h1>CMS List</h1>
    	
    <p><a href="insert.php">Insert</a></p>

<table class="table">
<tr>
	<th>Film Name</th>
	<th></th>
    <th></th>
    <th></th>
</tr>
<?php if($movies != ""){
	for($i=0;$i<count($movies);$i++){ ?>
          <tr>
              <td><?php echo $movies[$i]['filmName']; ?></td>
              <td><a href="details.php?filmID=<?php echo $movies[$i]['filmID']; ?>">View</a></td>
              <td><a href="edit.php?filmID=<?php echo $movies[$i]['filmID']; ?>">Edit</a></td>
              <td><a href="delete.php?filmID=<?php echo $movies[$i]['filmID']; ?>">Delete</a></td>
          </tr>
 <?php
  }
 } 
 ?>
 </table>
        
        
    </div>
</div>
<?php
include('includes/footer.inc.php');
?>
</body>
</html>