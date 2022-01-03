<?php 
ini_set('display_errors', 1);
require('db/database.php');
include('includes/functions.inc.php');


if(isset($_GET['priceOne'])){
	$sPriceOne= safeInt($_GET['priceOne']);
	$sPriceTwo= safeInt($_GET['priceTwo']);
	// optional array of field names
	$db->select("movies", array('filmName', 'filmPrice', 'filmDescription'));
	$db->whereBetween("filmPrice",$sPriceOne,'i',$sPriceTwo,'i');
	$movies = $db->fetchData();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1">
           <title>Class Based Site :: Search with WHERE BETWEEN</title>
          <link href="css/bootstrap.min.css" rel="stylesheet">
          <link href="css/styles.css" rel="stylesheet">
</head>
<body>
<div class="container">
	<?php include('includes/header.inc.php'); ?>
    <div class="row">
    <div class="col-md-12">
    		<h1>Search with WHERE BETWEEN</h1>
        		<form method="get" class="form-inline">
        					<div class="form-group">
                           <label>Price One: 
   <input type="text" name="priceOne" value="<?php echo $sPriceOne;?>" class="form-control">
   </label>
   <label>Price Two:
   <input type="text" name="priceTwo" value="<?php echo $sPriceTwo;?>" class="form-control">
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