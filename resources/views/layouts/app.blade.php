<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        {{-- Core Css --}}
        <link rel="stylesheet" href="/css/app.css" />

        <!--external css-->
        <link href="/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="/assets/bootstrap-colorpicker/css/colorpicker.css" />

        {{-- Sweet Alert --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" />
      

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="/js/html5shiv.js"></script>
          <script src="/js/respond.min.js"></script>
        <![endif]-->
        <!-- <link rel="stylesheet" type="text/css" href="style.css"/> -->
                    
        <title>
            @yield('title', 'CasterBuddy')
        </title>
               
    </head>

<body id="caster-app" class="full-width">
<header class="header white-bg">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="fa fa-bars"></span>
            </button>

            <!--logo start-->
            <a href="/" class="logo">Caster<span>Buddy</span></a>
            <!--logo end-->
            <div class="horizontal-menu navbar-collapse collapse ">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="/">Home</a></li>
                    <li><a href="#">Work</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
    
            <div class="top-nav">
                <ul class="nav pull-left top-menu">
                    <li>
                        <span><a href="/upload" class="btn btn-danger navbar-btn btn-sm" id="upload-hover"><i class="fa fa-upload"></i> Upload</a></span>
                    </li>
                    <li>
                        <span><a href="#" class="btn btn-warning navbar-btn btn-sm" id="premade-hover"><i class="fa fa-plus"></i> Premade Video</a></span>
                    </li>
                </ul>
            </div>

            <div class="top-nav ">
                <ul class="nav pull-right top-menu">
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="img/avatar1_small.jpg">
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
        2016 &copy; Casterbuddy. All Rights Reserved.
        <a href="#" class="go-top">
            <i class="fa fa-angle-up"></i>
        </a>
    </div>
</footer>
<!--footer end--> 
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="/js/jquery.scrollTo.min.js"></script>
    <script src="/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="/js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="/js/owl.carousel.js" ></script>
    <script src="/js/jquery.customSelect.min.js" ></script>
    <script src="/js/respond.min.js" ></script>

    <script type="text/javascript" src="/assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <!--custom switch-->
    <script src="/js/bootstrap-switch.js"></script>

    <!--right slidebar-->
    <script src="/js/slidebars.min.js"></script>

    <!--common script for all pages-->
    <script src="/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="/assets/fuelux/js/spinner.js"></script>
    <!-- tweaks added by rigz -->

    {{-- Sweet Alert --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('.colorpicker-rgba').colorpicker();
            $('.modal').on('show.bs.modal', function () {
                if ($(document).height() > $(window).height()) {
                    // no-scroll
                    $('body').addClass("modal-open-noscroll");
                }
                else {
                    $('body').removeClass("modal-open-noscroll");
                }
                if($('#propertyDisplayAutomatically').is(':checked')){
                    $('.aftersec').show();
                }
            })
            $('.modal').on('hide.bs.modal', function () {
                $('body').removeClass("modal-open-noscroll");
            })
            $("#propertyDisplayAutomatically").change(function() {
                if(this.checked) {
                    $('.aftersec').show();
                }else{
                    $('.aftersec').hide();
                }
            });                
        });
    </script>

    {{-- Main Core Script --}}
    <script src="/js/main.js"></script>
    </body>
    </html>