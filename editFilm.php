<?php 
ini_set('display_errors', 1);
require('db/database.php');
require('includes/functions.inc.php');
// first validate data
$sFilmName = safeString($_POST['filmName']);
$sFilmDesc = safeString($_POST['filmDescription']);
$sFilmImage = safeString($_POST['filmImage']);
$sFilmPrice = safeFloat($_POST['filmPrice']);
$sFilmReview = safeFloat($_POST['filmReview']);
$sFilmID= safeInt($_POST['filmID']);
// must set where first
$db->whereEq("filmID", $sFilmID, 'i');
$success = $db->update("movies", array('filmName', 'filmDescription', 'filmImage', 'filmPrice', 'filmReview'), array($sFilmName, $sFilmDesc, $sFilmImage, $sFilmPrice, $sFilmReview),array('s','s','s','s','i'));
// then redirect
header('Location: '.$_SERVER['HTTP_REFERER'].'?s='.$success);
?>
