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
          <title>Class Based Site :: INSERT</title>
          <link href="css/bootstrap.min.css" rel="stylesheet">
          <link href="css/styles.css" rel="stylesheet">
</head>
<body>
<div class="container">
	<?php include('includes/header.inc.php'); ?>
    <div class="row">
    <div class="col-md-12">
   	<h1>INSERT</h1>
    </div>
    </div>
    
    
    <form name="form1" method="post" action="insertFilm.php">
    <div class="row">
    <div class="col-md-4">   	
  <div class="form-group">
    <label for="filmName">Film Title</label>
    <input type="text" name="filmName" id="filmName" value="" class="form-control">
  </div>
  </div>
  <div class="col-md-4">   
  <div class="form-group">
    <label for="filmImage">Film Image</label>
    <input type="text" name="filmImage" id="filmImage" value="" class="form-control">
  </div>
  </div>
 <div class="col-md-4">  
 <div class="form-group">
    <label for="filmPrice">Film Price</label>
    <input type="text" name="filmPrice" id="filmPrice" value="" class="form-control">
  </div>
  </div>
    </div>
  <div class="row">
  <div class="col-md-6">  
  <div class="form-group">
    <label for="filmDescription">Film Description</label>
    <textarea name="filmDescription" id="filmDescription" cols="45" rows="5" class="form-control"></textarea>
  </div>
  </div>
  <div class="col-md-6">  
  <div class="form-group">
  <p style="font-weight:bold">Star Rating</p>
  
  <label class="radio-inline"><input type="radio" name="filmReview" value="1">1</label>
  <label class="radio-inline"><input type="radio" name="filmReview" value="2">2</label>
  <label class="radio-inline"><input type="radio" name="filmReview" value="3">3</label>
  <label class="radio-inline"><input type="radio" name="filmReview" value="4">4</label>
  <label class="radio-inline"><input type="radio" name="filmReview" value="5">5</label>
  
    
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
<?php
include('includes/footer.inc.php');
?>
</body>
</html>