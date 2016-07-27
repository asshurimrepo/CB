<?php
$_ROOT_="/";

$_MAX_INACTIVE_=3600;		// Session destroied after this ammount of inactivity
$_PLAN_=array("Free", "Basic", "Professional");
$_POSITION_=array("Centered", "Top left", "Top right", "Bottom right", "Bottom left");	// Video position on screen

date_default_timezone_set('Europe/Athens');

// Force SESSION to expire after _MAX_INACTIVE_ seconds of inactivity
if(isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $_MAX_INACTIVE_)) {
    session_unset();
    session_destroy();
}
$_SESSION['LAST_ACTIVITY'] = time();

$_VALIDATION_PREFIX="CasterBuddy_valid_a1b2c3_";