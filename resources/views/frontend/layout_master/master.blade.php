<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{URL::asset('')}}css/bootstrap.min.css" rel="stylesheet">
    <link href="{{URL::asset('')}}css/font-awesome.min.css" rel="stylesheet">
    <link href="{{URL::asset('')}}fonts/fonts.min.css" rel="stylesheet">
    <link href="{{URL::asset('')}}css/frontend/slick-theme.css" rel="stylesheet">
    <link href="{{URL::asset('')}}css/frontend/slick.css" rel="stylesheet">


    <!-- Custom CSS -->
    <link href="{{URL::asset('')}}css/frontend/shop-homepage.css" rel="stylesheet">
    <link href="{{URL::asset('')}}css/frontend/library.css" rel="stylesheet">
    <link href="{{URL::asset('')}}css/frontend/main.css" rel="stylesheet">
    <link href="{{URL::asset('')}}css/frontend/responsive.css" rel="stylesheet">



</head>

<body>
<main>
    <header>
        <nav class="ed-navbar navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header ed-toggle-right">
                <button type="button" id="btn-navbar-toggle" class="navbar-toggle">
                    <span class="icon-bar top-bar"></span>
                    <span class="icon-bar middle-bar"></span>
                    <span class="icon-bar bottom-bar"></span>
                </button>
                <a class="navbar-brand" href="{{URL::asset('/')}}"><img src="{{URL::asset('')}}img/frontend/logo.png"></a>
            </div>
            <div class="navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{URL::asset('')}}project.html">Project</a>
                    </li>
                    <li class="">
                        <a href="{{URL::asset('')}}office.html">Office</a>
                    </li>
                    <li>
                        <a href="{{URL::asset('')}}expertise.html">Expertise</a>
                    </li>
                    <li class="active">
                        <a href="{{URL::asset('')}}news.html">News</a>
                    </li>
                    <li>
                        <a href="{{URL::asset('')}}contact.html">Contact</a>
                    </li>
                </ul>

            </div>
        </nav>
    </header>


    <!-- Slider -->

    <section class="regular3 slider">
        <div>
            <img src="{{URL::asset('')}}img/frontend/bg-111.jpg" alt="">
        </div>
        <div>
            <img src="{{URL::asset('')}}img/frontend/bg-112.jpg" alt="">
        </div>
        <div>
            <img src="{{URL::asset('')}}img/frontend/bg-113.jpg" alt="">
        </div>
        <div>
            <img src="{{URL::asset('')}}img/frontend/bg-114.jpg" alt="">
        </div>
        <div>
            <img src="{{URL::asset('')}}img/frontend/bg-115.jpg" alt="">
        </div>
    </section>

    <!-- End Slider -->



    <!-- Video -->

    <!-- <video autoplay muted loop id="myVideo">
        <source src="images/rain.mp4" type="video/mp4">
    </video> -->

    <!-- End video -->




    <div class="dropup dropup-indext">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-globe"></i> English <span class="fa fa-angle-down"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <li><a href="#">English</a></li>
            <li><a href="#">Việt Nam</a></li>

        </ul>
    </div>

</main>


<!-- jQuery -->
<script src="{{URL::asset('')}}js/frontend/jquery.js"></script>
<script src="{{URL::asset('')}}js/frontend/bootstrap.min.js"></script>
<script src="{{URL::asset('')}}js/frontend/slick.min.js"></script>
<script src="{{URL::asset('')}}js/frontend/custom_slick.js"></script>
<script src="{{URL::asset('')}}js/frontend/custom.js"></script>

</body>

</html>
