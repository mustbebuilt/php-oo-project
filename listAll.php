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
          <title>>Class Based Site :: SELECT</title>
          <link href="css/bootstrap.min.css" rel="stylesheet">
          <link href="css/styles.css" rel="stylesheet">
</head>
<body>
<div class="container">
	<?php include('includes/header.inc.php'); ?>
    <div class="row">
    <div class="col-md-12">
    	<h1>SELECT</h1>
        <?php if($movies != ""){
	for($a=0;$a<count($movies);$a++){ ?>
          <p>
              <?php echo $a+1; ?>: 
              <?php echo $movies[$a]['filmName']; ?>
              <?php echo $movies[$a]['filmCertificate']; ?>
              <?php echo $movies[$a]['filmPrice']; ?>
          </p>
 		<?php
  			} // end for
 		} // end if
 		?>
    </div>
    </div>
</div>
<?php
include('includes/footer.inc.php');
?>
</body>
</html>