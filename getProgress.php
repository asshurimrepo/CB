<?php
$user="";
$fileName="";
if(array_key_exists('user', $_GET)) $user=$_GET['user'];
if(array_key_exists('file', $_GET)) $fileName=$_GET['file'];
$fileName="data/".$user."/videos/".$fileName;
$reply="";
$prgrs="";
if(file_exists("data/".$user."/progress.log")) $prgrs=file_get_contents("data/".$user."/progress.log");
if($prgrs=="END") {
	$reply="Finished";
	file_put_contents("data/".$user."/progress.log", "");
} else if($prgrs=="Progress") {
	$images=scandir("data/".$user."/images");
	if($images!==false) {
		$is=count($images)-2;
		if($is>0) {
			$out=scandir("data/".$user."/out/");
			$os=count($out)-3;		// Also, exclude sound file
			if($os>0) {
				$p=$os/$is;
				if($p<1) $reply=number_format($p*100, 2)."%";
				else $reply="100%";
			  //$reply=$os."/".$is;
			} else $reply="Initializing processing...";
		} else $reply="No images";
	} else $reply="scandir failed";
} else $reply=$prgrs;
echo $reply;
?>
