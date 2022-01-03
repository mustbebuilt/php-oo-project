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
          <title>Class Based Site :: DELETE</title>
          <link href="css/bootstrap.min.css" rel="stylesheet">
          <link href="css/styles.css" rel="stylesheet">
</head>
<body>
<div class="container">
	<?php include('includes/header.inc.php'); ?>
    <div class="row">
    <div class="col-md-12">
   	<h1>DELETE</h1>
    	
<form name="form1" method="post" action="deleteRecord.php">
<input name="filmID" type="hidden" value="<?php echo $movies[0]['filmID']; ?>">
<p>Are you sure you wish to delete <?php echo $movies[0]['filmName']; ?>?</p>
   <p>
    <input type="submit" name="del" id="del" value="Delete">
  </p>
</form>
<form name="form2" method="" action="listall.php" id="saveForm">
    <input type="submit" name="save" id="save" value="Save">
</form>
        
    </div>
</div>
<?php
include('includes/footer.inc.php');
?>
</body>
</html>