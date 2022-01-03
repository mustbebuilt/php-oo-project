<?php 
ini_set('display_errors', 1);
require('db/database.php');
include('includes/functions.inc.php');


if(isset($_GET['filmName'])){
	$sFilmName= safeString($_GET['filmName']);
	$sFilmPrice = safeString($_GET['filmPrice']);
	// optional array of field names
	$db->select("movies", array('filmName', 'filmPrice', 'filmDescription'));
	$db->whereLike("filmName",$sFilmName);
	$db->orEq("filmPrice",$sFilmPrice);
	$movies = $db->fetchData();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <title>Class Based Site :: Search with WHERE LIKE OR EQUAL</title>
          <link href="css/bootstrap.min.css" rel="stylesheet">
          <link href="css/styles.css" rel="stylesheet">
</head>
<body>
<div class="container">
	<?php include('includes/header.inc.php'); ?>
    <div class="row">
    <div class="col-md-12">
   	<h1>Search with WHERE LIKE OR EQUAL</h1>
    	
<form method="get" class="form-inline">
   <div class="form-group">
<label>Film Name: 
   <input type="text" name="filmName" value="<?php echo $sFilmName;?>" class="form-control">
   </label>
   <label>Film Price:
   <input type="text" name="filmPrice" value="<?php echo $sFilmPrice;?>" class="form-control">
   </label>
  <input type="submit" class="btn btn-default">
                           </div>
   </form>    
      </div>
</div> 
                       
    <div class="row">
    <div class="col-md-12" style="margin-top:30px;">                           
<?php if($movies != ""){ for($a=0;$a<count($movies);$a++){ ?>
          <ul>
              <li>
		  <span><?php echo $a+1; ?></span>
		  <span><?php echo $movies[$a]['filmName']; ?></span>
		  <span><?php echo $movies[$a]['filmCertificate']; ?></span>
		  <span><?php echo $movies[$a]['filmPrice']; ?></span>
          <p><?php echo $movies[$a]['filmDescription']; ?></p>
	   </li>
          </ul> 
  <?php }} ?>
        
        
    </div>
</div>
</div>
<?php
include('includes/footer.inc.php');
?>
</body>
</html>