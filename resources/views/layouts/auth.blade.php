<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="CasterBuddy">
    <meta name="author" content="Kodecept">
    <meta name="keyword" content="CasterBuddy">
    <link rel="shortcut icon" href="/img/favicon.png">

    <title>@yield('title', 'CasterBuddy')</title>

    <link rel="stylesheet" href="/css/auth.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-body">

    <div class="container">
        @yield('content')
    </div>



    <!-- js placed at the end of the document so the pages load faster -->
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.min.js"></script>

  </body>
</html>