<?php
session_start();

include("global.inc");	// Also, handles SESSION expiration

$user="";
$user_id=0;
if(isset($_SESSION['username'])) {
	$user=$_SESSION['username'];
	$user_id=$_SESSION['user_id'];
} else {
	$session_token = password_hash(uniqid('webcaster', true),PASSWORD_DEFAULT);
	$_SESSION['session_token'] = $session_token;
}

if($user!="") {
	if(!file_exists("data/".$user."/videos")) {
		mkdir("data/".$user);
		mkdir("data/".$user."/videos");
		mkdir("data/".$user."/images");
		mkdir("data/".$user."/out");
		mkdir("data/".$user."/done");
		mkdir("data/".$user."/tmp");
	}
	
	$act="";
	if(isset($_POST['act'])) $act=$_POST['act'];
	
	if($act=="logout") {
		session_unset();
		session_destroy();
		$user="";
		//echo "<script>window.location.href='';</script>";
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">

	    <!-- Bootstrap core CSS -->
	    <link href="css/bootstrap.min.css" rel="stylesheet">
	    <link href="css/bootstrap-reset.css" rel="stylesheet">
	    <!--external css-->
	    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
	    <link href="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
	    <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">

	    <!--right slidebar-->
	    <link href="css/slidebars.css" rel="stylesheet">

      	<!-- Custom styles for this template -->
	    <link href="css/style.css" rel="stylesheet">
	    <link href="css/style-responsive.css" rel="stylesheet" />

	    <!-- custom by rigz -->
	    <link href="css/custom.css" rel="stylesheet" />

	    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
	    <!--[if lt IE 9]>
	      <script src="js/html5shiv.js"></script>
	      <script src="js/respond.min.js"></script>
	    <![endif]-->
		<!-- <link rel="stylesheet" type="text/css" href="style.css"/> -->
		
		<script src="https://code.jquery.com/jquery.js"></script>
			
			<title>CasterBuddy</title>

				<script type="text/javascript">
				var xhr;
				var user='<?php echo $user; ?>';
				var targetWidth=400;

				function log(param){
				    setTimeout(function(){
				        throw new Error("Debug: "+param)
				    },0)
				}

				function logout() {
					document.getElementById("act").value="logout";
					document.getElementById("upldr").submit();
				}
				</script>
	</head>

<body class="full-width">
	<?php include("dbConnect.inc"); ?>
	<section id="container">
		<?php include('header.php'); ?>
		<section id="main-content">
          <section class="wrapper">
          	<?php include('myvideos.php'); ?>
          </section>
        </section>
	</section> 	
	<?php include('footer.php'); ?>

</body>


</html>