<!--

=========================================================
* Gaia Bootstrap Template - v1.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/gaia-bootstrap-template
* Licensed under MIT (https://github.com/creativetimofficial/gaia-bootstrap-template/blob/master/LICENSE.md)
* Copyright 2019 Creative Tim (http://www.creative-tim.com)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Inventory</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link href="{{asset('css/layouts/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{asset('css/layouts/gaia.css')}}" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href='https://fonts.googleapis.com/css?family=Cambo|Poppins:400,600' rel='stylesheet' type='text/css'>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-default navbar-transparent navbar-fixed-top" color-on-scroll="200">
        <!-- if you want to keep the navbar hidden you can add this class to the navbar "navbar-burger"-->
        <div class="container">
            <div class="navbar-header">
                <button id="menu-toggle" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar bar1"></span>
                    <span class="icon-bar bar2"></span>
                    <span class="icon-bar bar3"></span>
                </button>
                <p class="navbar-brand">
                    Inventory
                </p>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right navbar-uppercase">
                    <li>
                        <a href="{{ URL::route('login') }}">LOG-IN</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
    </nav>


    <div class="section section-header">
        <div class="parallax filter filter-color-blue">
            <div class="image"
                style="background-image: url('{{asset('images/inventory.jpg')}}')">
            </div>
            <div class="container">
                <div class="content">
                    <div class="title-area">
                        <p>Voltes V</p>
                        <h1 class="title-modern">HJM</h1>
                        <h3>Simplifying Tech, Simplifying you</h2>
                        <div class="separator line-separator">♦</div>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <div class="section">
        <div class="container">
            <div class="row">
                <div class="title-area">
                    <h2>Our Services</h2>
                    <div class="separator separator-danger">✻</div>
                    <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure nesciunt temporibus voluptas soluta totam impedit?</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="info-icon">
                        <div class="icon text-danger">
                            <i class="pe-7s-graph1"></i>
                        </div>
                        <h3>Sales</h3>
                        <p class="description">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Necessitatibus, eum!</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-icon">
                        <div class="icon text-danger">
                            <i class="pe-7s-note2"></i>
                        </div>
                        <h3>Content</h3>
                        <p class="description">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Excepturi, expedita?</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-icon">
                        <div class="icon text-danger">
                            <i class="pe-7s-music"></i>
                        </div>
                        <h3>Passion</h3>
                        <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste, doloribus?</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

<!--   core js files    -->
<script src="{{asset('js/layouts/bootstrap.js')}}" type="text/javascript"></script>
<script src="{{asset('js/layouts/jquery-3.5.1.min.js')}}" type="text/javascript"></script>

<!--  js library for devices recognition -->
<script type="text/javascript" src="{{asset('js/layouts/modernizr.js')}}"></script>
<!--  script for google maps   -->

<!--   file where we handle all the script from the Gaia - Bootstrap Template   -->
<script type="text/javascript" src="{{asset('js/layouts/gaia.js')}}"></script>

</html>
