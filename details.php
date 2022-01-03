<?php 
ini_set('display_errors', 1);
require('db/database.php');
include('includes/functions.inc.php');
if(isset($_GET['filmID'])){
	$sFilmID = safeString($_GET['filmID']);
	$db->select("movies");
	$db->whereEq("filmID",$sFilmID, 'i');
	$movies = $db->fetchData();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <title>Class Based Site :: VIEW DETAILS</title>
          <link href="css/bootstrap.min.css" rel="stylesheet">
          <link href="css/styles.css" rel="stylesheet">
</head>
<body>
<div class="container">
	<?php include('includes/header.inc.php'); ?>
    <div class="row">
    <div class="col-md-12">
   	<h1>CMS List</h1>
    	
    <h1><?php echo $movies[0]['filmName']; ?> (<?php echo $movies[0]['filmID']; ?>)</h1>
<p><?php echo $movies[0]['filmImage']; ?></p>
<p><?php echo $movies[0]['filmDescription']; ?></p>
<p><?php echo $movies[0]['filmPrice']; ?></p>
<p><?php echo $movies[0]['filmReview']?></p>
        
        
    </div>
</div>
<?php
include('includes/footer.inc.php');
?>
</body>
</html>