<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="usermail" content="{{ auth()->user()->email }}" />

        {{-- Core Css --}}
        <link rel="stylesheet" href="/css/app.css" />

        <!--external css-->
        <link href="/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="/assets/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet"/>
        <link href="/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="/assets/bootstrap-colorpicker/css/colorpicker.css" />

        {{-- Sweet Alert --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" />

        @yield('styles')

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="/js/html5shiv.js"></script>
          <script src="/js/respond.min.js"></script>
        <![endif]-->
<!--         <link rel="stylesheet" type="text/css" href="style.css"/> -->

        <!-- Video.js file -->
		<link href="http://vjs.zencdn.net/5.10.8/video-js.css" rel="stylesheet">

		<!-- If you'd like to support IE8 -->
		<script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>

        <title>
            @yield('title', 'CasterBuddy')
        </title>

    </head>

<body id="caster-app" class="full-width">
	<div class="loader"></div>
	<header class="header white-bg">
	        <div class="navbar-header">
	            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	                <span class="fa fa-bars"></span>
	            </button>

	            <!--logo start-->
	            <a href="/" class="logo hidden-xs">Caster<span>Buddy</span></a>
	            <!--logo end-->
	            <div class="horizontal-menu navbar-collapse collapse ">
	                <ul class="nav nav-caster navbar-nav">
                        <li class="{{ Request::is('admin') ? 'active' : '' }}"><a href="/">Home</a></li>
                        <li class="{{ Request::is('admin/categories') ? 'active' : '' }}"><a href="/admin/categories">Categories</a></li>
	                    <li class="visible-xs">
	                        {{-- <a href="/admin/upload" class="btn btn-danger navbar-btn btn-sm upload-hover"><i class="fa fa-upload"></i> Upload New Premade Casters</a> --}}
	                    </li>
	                </ul>
	            </div>

	            <div class="top-nav hidden-xs">
	                <ul class="nav pull-left top-menu">
	                    <li class="popovers" data-content="Upload your green screen video here!" data-placement="bottom" data-trigger="hover" data-delay="500">
	                        {{-- <span><a href="/admin/upload" class="btn btn-danger navbar-btn btn-sm upload-hover"><i class="fa fa-upload"></i> Upload New Premade Casters</a></span> --}}
	                    </li>
	                </ul>
	            </div>

	            <div class="top-nav">
	                <ul class="nav pull-right top-menu">
	                    <!-- user login dropdown start-->
	                    <li class="dropdown">
	                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
	                            <img alt="" src="/img/avatar1_small.jpg">
	                            <span class="username">{{ auth()->user()->name }}</span>
	                            <b class="caret"></b>
	                        </a>
	                        <ul class="dropdown-menu extended logout">
	                            <li><a href="/logout"><i class="fa fa-key"></i> Log Out</a></li>
	                        </ul>
	                    </li>
	                    <!-- user login dropdown end -->
	                </ul>
	            </div>
	        </div>
	</header>

	<section id="container">
	    <section id="main-content">
	      <section class="wrapper">

	         @yield('content')

	      </section>
	    </section>
	</section>

	<!--footer start-->
	<footer class="site-footer always-bottom">
	    <div class="text-center">
	       You are logged in as admin.
	        <a href="#" class="go-top">
	            <i class="fa fa-angle-up"></i>
	        </a>
	    </div>
	</footer>
	<!--footer end-->

    <!-- <script src="/js/jquery.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="/assets/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="/js/jquery.scrollTo.min.js"></script>
    <script src="/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="/js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="/js/owl.carousel.js" ></script>
    <script src="/js/jquery.customSelect.min.js" ></script>
    <script src="/js/jquery.pulsate.min.js" type="text/javascript"></script>
    <script src="/js/respond.min.js" ></script>

    <script type="text/javascript" src="/assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <!--custom switch-->
    <script src="/js/bootstrap-switch.js"></script>

    <!--right slidebar-->
    <script src="/js/slidebars.min.js"></script>

    <!--common script for all pages-->
    <script src="/js/common-scripts.js"></script>

    <script type="text/javascript" src="/assets/fuelux/js/spinner.js"></script>
    <!--tweaks added by rigz-->

    <!--video.js-->
	<script src="http://vjs.zencdn.net/5.10.8/video.js"></script>

    {{-- Sweet Alert --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(window).on("load", function() {
                $(".loader").fadeOut();
            });

            $("#propertyDisplayAutomatically").change(function() {
                if(this.checked) {
                    $('.aftersec').show();
                }else{
                    $('.aftersec').hide();
                }
            });

            $('.upload-hover').pulsate({
                color: "#ec6459",
                repeat: false,
                onHover: true
            });
            $('.premade-hover').pulsate({
                color: "#269abc",
                repeat: false,
                onHover: true
            });
        });
    </script>

    <!-- seriously.js -->
    <script src="/js/seriously.js" type="text/javascript"></script>
    <script src="/js/seriously.chroma.js" type="text/javascript"></script>

    <!-- clipboard -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.12/clipboard.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var clipboard = new Clipboard('.copy-btn');
            clipboard.on('success', function(e) {
                console.log(e);
            });
        });
    </script>
    @yield('scripts')

    </body>
    </html>