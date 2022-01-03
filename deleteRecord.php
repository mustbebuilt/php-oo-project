<?php 
ini_set('display_errors', 1);
require('db/database.php');
require('includes/functions.inc.php');
// first validate data
$sFilmID= safeInt($_POST['filmID']);
// must set where first
$db->whereEq("filmID", $sFilmID, 'i');
$success = $db->delete("movies");
// then redirect
header('Location: '.$_SERVER['HTTP_REFERER'].'?s='.$success);
?>
