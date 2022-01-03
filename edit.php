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
          <title>Class Based Site :: EDIT</title>
          <link href="css/bootstrap.min.css" rel="stylesheet">
          <link href="css/styles.css" rel="stylesheet">
</head>
<body>
<div class="container">
	<?php include('includes/header.inc.php'); ?>
    <div class="row">
        <div class="col-md-12">
        <h1>EDIT</h1>
        </div>
    </div>
    
    <form name="form1" method="post" action="insertFilm.php">
    <input name="filmID" type="hidden" value="<?php echo $movies[0]['filmID']; ?>">
    <div class="row">
    <div class="col-md-4">   	
  <div class="form-group">
    <label for="filmName">Film Title</label>
    <input type="text" name="filmName" id="filmName" value="<?php echo $movies[0]['filmName']; ?>" class="form-control">
  </div>
  </div>
  <div class="col-md-4">   
  <div class="form-group">
    <label for="filmImage">Film Image</label>
    <input type="text" name="filmImage" id="filmImage" value="<?php echo $movies[0]['filmImage']; ?>" class="form-control">
  </div>
  </div>
 <div class="col-md-4">  
 <div class="form-group">
    <label for="filmPrice">Film Price</label>
    <input type="text" name="filmPrice" id="filmPrice" value="<?php echo $movies[0]['filmPrice']; ?>" class="form-control">
  </div>
  </div>
    </div>
  <div class="row">
  <div class="col-md-6">  
  <div class="form-group">
    <label for="filmDescription">Film Description</label>
    <textarea name="filmDescription" id="filmDescription" cols="45" rows="5" class="form-control"><?php echo $movies[0]['filmDescription']; ?></textarea>
  </div>
  </div>
  <div class="col-md-6">  
  <div class="form-group">
  <p style="font-weight:bold">Star Rating</p>
  
  <label class="radio-inline"><input type="radio" name="filmReview" value="1" <?php if($movies[0]['filmReview'] == 1){echo "checked";}?>>1</label>
  <label class="radio-inline"><input type="radio" name="filmReview" value="2" <?php if($movies[0]['filmReview'] == 2){echo "checked";}?>>2</label>
  <label class="radio-inline"><input type="radio" name="filmReview" value="3" <?php if($movies[0]['filmReview'] == 3){echo "checked";}?>>3</label>
  <label class="radio-inline"><input type="radio" name="filmReview" value="4" <?php if($movies[0]['filmReview'] == 4){echo "checked";}?>>4</label>
  <label class="radio-inline"><input type="radio" name="filmReview" value="5" <?php if($movies[0]['filmReview'] == 5){echo "checked";}?>>5</label>
  
    
    </div>
      </div>
      </div>
        <div class="row">
  <div class="col-md-12">  
  <div class="form-group">
     <input type="submit" value="Add Film" class="btn btn-default">
  </div>


        
        </div>
    </div>
    </form>    

    </div>
</div>
<?php
include('includes/footer.inc.php');
?>
</body>
</html>