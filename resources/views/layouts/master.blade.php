<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="Content-Security-Policy" content="style-src 'self' 'unsafe-inline';">
    <title>ESG PRAKRIT</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png">
    <!--====== Slick css ======-->
    <link rel="stylesheet" href="{{asset('assets/layout_css/slick.css')}}">

    <!--====== Animate css ======-->
    <link rel="stylesheet" href="{{asset('assets/layout_css/animate.css')}}">

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="{{asset('assets/layout_css/bootstrap.min.css')}}">

    <link href="{{ asset('css/landing/bootstrap-select.min.css') }}" rel="stylesheet">

    <!--====== owl.carousel.min css ======-->
    <link rel="stylesheet" href="{{asset('assets/layout_css/owl.carousel.min.css')}}">

    <!--====== Nice Select css ======-->

    <!--====== Nice Number css ======-->
    <link rel="stylesheet" href="{{asset('assets/layout_css/jquery.nice-number.min.css')}}">

    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="{{asset('assets/layout_css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('assets/layout_css/aos.css')}}">
    <!--====== Default css ======-->
    <link rel="stylesheet" href="{{asset('assets/layout_css/default.css')}}">

    <!--====== Style css ======-->
    <link rel="stylesheet" href="{{asset('assets/layout_css/style.css')}}">

    <!--====== Custom css ======-->
    <link rel="stylesheet" href="{{asset('assets/layout_css/custom.css')}}">

    <!--====== Responsive css ======-->
    <link rel="stylesheet" href="{{asset('assets/layout_css/responsive.css')}}">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&display=swap" rel="stylesheet">



    <!-- font family NotoSansJP-VariableFont_wght -->
    <link href="{{ asset('assets/layout_css/NotoSansJP-VariableFont_wght.css') }}" rel="stylesheet">

    <!-- font family Rowdies -->
    <link href="{{ asset('assets/layout_css/Rowdies_fontfamily.css') }}" rel="stylesheet">
    <!-- font family Bodoni -->
    <link href="{{ asset('assets/layout_css/Bodoni_fontfamily.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/layout_css/familyPlay.css') }}" rel="stylesheet">



@stack('styles')
<style type="text/css">
    .login-dropdown{
        top: 37px;
        left: -90px;
        border-top: 2px solid #28a745;
        border-radius: 0;    
    }
    .topbar{
              background: #3e7544;

      }  
    </style>

</head>

<body>

    <!--====== PRELOADER PART START ======-->

    <div class="preloader">
        <div class="loader rubix-cube">
            <div class="layer layer-1"></div>
            <div class="layer layer-2"></div>
            <div class="layer layer-3 color-1"></div>
            <div class="layer layer-4"></div>
            <div class="layer layer-5"></div>
            <div class="layer layer-6"></div>
            <div class="layer layer-7"></div>
            <div class="layer layer-8"></div>
        </div>
    </div>

    <!--====== HEADER PART START ======-->
    <header id="header-part" class="menu-logo">
        <div class="navigation">
            <div class="topbar">
                <div class="container">
                    <div class="row">
                            <div class="col-lg-12 text-right">
                                <div class="h-100 d-inline-flex align-items-center me-4" style="color: white; margin-right: 15vh;">
                                   
                                </div>
                                <div class="h-100 d-inline-flex align-items-center" style="color: white; margin-right: 15vh;">

                                </div>
                            </div>  

                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg" id="navbar">
                            <a class="navbar-brand" href="#">
                                <img src="{{asset('assets/images/logo/logo-a.png')}}" class="logo-a" alt="Logo">
                                <img src="{{asset('assets/images/logo/logo-b.png')}}" class="logo-b" alt="Logo">
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item">
                                        <a class="scrollto active" href="{{ route('landing') }}">Home</a>
                                    </li>

                                    <li class="nav-item dropdown" >
                                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Explore</a>
                                        <div class="dropdown-menu">
                                            <a href="{{ route('calculator') }}" class="dropdown-item">Your Carbon Footprint</a>
                                            <a href="{{ route('tool') }}" class="dropdown-item">Experience the Tool</a>
                                            <a href="{{ route('faq') }}" class="dropdown-item">FAQ</a>
                                        </div>
                                    </li>

                                    <li class="nav-item" class="scrollto">
                                        <a href="{{ route('contact') }}">Connect With Us</a>
                                    </li>

                                    <li class="nav-item" class="scrollto animation-btn-css" data-aos="fade-left" data-aos-delay="800">
                                        <a class="btn animation-btn company-login" href="{{ route('admin.login') }}">Login</a>
                                    </li>
                                    <li class="nav-item" class="scrollto"style="padding: 33px 20px;">

                                    </li>
                                </ul>
                            </div>
                        </nav> <!-- nav -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div>
    </header>

    <!--====== HEADER PART ENDS ======-->


    <!-- ======= Header ======= -->


    <!-- End Header -->

    <main id="main">
        <main>
            @yield('content')
        </main>
    </main><!-- End #main -->


    <!--====== FOOTER PART START ======-->
    <footer id="footer-part">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 d-flex align-items-start">
                        <div class="footer-about">
                            <div class="logo">
                                <!-- {{-- <img src="{{asset('assets/images/logo/logo-a.png')}}" class="logo-a" alt="Logo" style="width: 132px; background: #fff;padding: 15px;border-radius: 4px;"> --}} -->
                                <img src="{{asset('assets/images/logo/ESG-Prakrit-logo4.png')}}" >
                            </div>
                            <p> The Engine Driving Your Carbon Footprint Management. Navigate your ESG jpurney with Our Cutting-Edge ESG Solutions Tool! Embark on your ESG Journey, with Our Transformative Solutions. </p>
                            {{-- <ul class="mt-20">
                                <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul> --}}
                        </div> <!-- footer about -->
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="footer-link f-left">
                            <div class="footer-title pb-1">
                                <h6>Our Services</h6>
                            </div>
                            <div class="row">
                                <!-- First Column -->
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <ul>
                                        <li><a  href="javascript:void(0)" data-toggle="modal"
                                            data-target="#exampleModal">
                                            <i class="fa fa-angle-right"></i> Financed Emissions </a></li>
                                            <li><a href="javascript:void(0)" data-toggle="modal"
                                                data-target="#exampleModal-a"><i class="fa fa-angle-right"></i> Carbon Footprint </a></li>
                                                <li><a href="javascript:void(0)" data-toggle="modal"
                                                    data-target="#exampleModal-b"><i class="fa fa-angle-right"></i> ESG Risk</a></li>
                                                    <li><a href="javascript:void(0)" data-toggle="modal"
                                                        data-target="#exampleModal-c"><i class="fa fa-angle-right"></i> Climate Risk</a></li>
                                                        <li><a href="javascript:void(0)" data-toggle="modal"
                                                            data-target="#exampleModal-d"><i class="fa fa-angle-right"></i> Environment Impact </a></li>
                                                            <li><a href="javascript:void(0)" data-toggle="modal"
                                                                data-target="#exampleModal-e"><i class="fa fa-angle-right"></i> Social Impact</a></li>
                                                                <li><a href="javascript:void(0)" data-toggle="modal"
                                                                    data-target="#exampleModal-f"><i class="fa fa-angle-right"></i> Governance Matrix</a></li>
                                                                </ul>
                                                            </div>
                                                            <!-- Second Column -->
                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                <ul>
                                                                    <li><a href="javascript:void(0)" data-toggle="modal"
                                                                        data-target="#exampleModal-g"><i class="fa fa-angle-right"></i> Regulatory Reports</a></li>
                                                                        <li><a href="javascript:void(0)" data-toggle="modal"
                                                                            data-target="#exampleModal-h"><i class="fa fa-angle-right"></i> Sustainability Report</a></li>
                                                                            <li><a href="javascript:void(0)" data-toggle="modal"
                                                                                data-target="#exampleModal-i"><i class="fa fa-angle-right"></i> ESG Assurance</a></li>
                                                                                <li><a href="javascript:void(0)" data-toggle="modal"
                                                                                    data-target="#exampleModal-j"><i class="fa fa-angle-right"></i> UN-SDG Mapping</a></li>
                                                                                    <li><a href="javascript:void(0)" data-toggle="modal"
                                                                                        data-target="#exampleModal-k"><i class="fa fa-angle-right"></i> ESG Strategy </a></li>
                                                                                        <li><a href="javascript:void(0)" data-toggle="modal"
                                                                                            data-target="#exampleModal-l"><i class="fa fa-angle-right"></i> Net Zero Plan </a></li>
                                                                                            <li><a href="javascript:void(0)" data-toggle="modal"
                                                                                                data-target="#exampleModal-m"><i class="fa fa-angle-right"></i> Carbon Credits </a></li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-lg-2 col-md-3 col-sm-3 width-50">
                                                                                <div class="footer-link">
                                                                                    <div class="footer-title pb-1">
                                                                                        <h6>Support</h6>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <ul>
                                                                                                <li><a href="{{ route('calculator') }}"><i class="fa fa-angle-right"></i> Your Carbon Footprint</a></li>
                                                                                                <li><a href="{{ route('tool') }}"><i class="fa fa-angle-right"></i> Experience the Tool</a></li>
                                                                                                <li><a href="{{ route('faq') }}"><i class="fa fa-angle-right"></i> FAQ</a></li>
                                                                                                <li><a href="{{ route('contact') }}"><i class="fa fa-angle-right"></i> Connect With Us</a></li>

                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                             <div class="col-lg-3 col-md-2 col-sm-3 width-50">
                                                                                <div class="footer-address">
                                                                                    <div class="footer-title pb-1">
                                                                                        <h6>Contact Us</h6>
                                                                                    </div>
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="icon">
                                                                                                <i class="fa fa-home"></i>
                                                                                            </div>
                                                                                            <div class="cont">
                                                                                                <p>IFCI Tower, 61, Nehru Place, New Delhi, 110019</p>
                                                                                            </div>
                                                                                        </li>
                                                                                        {{-- <li>
                                                                                            <div class="icon">
                                                                                                <i class="fa fa-home"></i>
                                                                                            </div>
                                                                                            <div class="cont">
                                                                                                <p>Plot No. 10, Sankar Rd, Vasant Kunj Institutional Area, Vasant Kunj, Institutional Area, New Delhi, 110070</p>
                                                                                            </div>
                                                                                        </li> --}}
                                                                                        <li>
                                                                                            <div class="icon">
                                                                                                <i class="fa fa-phone"></i>
                                                                                            </div>
                                                                                            {{-- <div class="cont">
                                                                                                <p>+91 8826009544</p> <p>+91 9990725902</p>
                                                                                            </div> --}}
                                                                                            <div class="cont">
                                                                                                <p>+91 9560969186</p>
                                                                                            </div>
                                                                                        </li>
                                                                                        <li>
                                                                                            <div class="icon">
                                                                                                <i class="fa fa-envelope"></i>
                                                                                            </div>
                                                                                            <div class="cont">
                                                                                                <p>esg@ifciltd.com</p>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div> <!-- footer address -->
                                                                            </div>
                                                                        </div> <!-- row -->
                                                                    </div> <!-- container -->
                                                                </div> <!-- footer top -->

                                                                <div class="footer-copyright">
                                                                    <div class="container">
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                <div class="copyright text-center">
                                                                                    <p>&copy; Copyright  2025. All Rights Reserved by <a href="https://www.ifciltd.com/" target="_blank">IFCI Ltd.</a></p>
                                                                                </div>
                                                                            </div>
                                                                        </div> <!-- row -->
                                                                    </div> <!-- container -->
                                                                </div> <!-- footer copyright -->
    </footer>

                                                            <!--====== FOOTER PART ENDS ======-->

                                                            <!--====== BACK TO TP PART START ======-->

                                                            <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

                                                            <!--====== BACK TO TP PART ENDS ======-->




                                                            <!-- services Modal -->

                                                            <!-- Modal services 1 -->
                                                            <div class="modal fade services-popup" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Financed Emissions</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>

                                                                    <div class="modal-body services-modal">
                                                                        <img src="assets/images/services/Financed-Emissions2.jpg" alt="">
                                                                        <p>Our financed emissions calculation measure the greenhouse gas emissions linked to the investment and
                                                                            lending activities of a Bank / Financial Institution, for the emissions produced by the companies in
                                                                        which a bank/ Financial Institution has an investment or loan.</p>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Modal services 1 end -->


                                                        <!-- Modal services 2 -->
                                                        <div class="modal fade services-popup" id="exampleModal-a" tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Carbon Footprints</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body services-modal">
                                                                    <img src="assets/images/services/Carbon-Footprint2.jpg" alt="">
                                                                    <p>Carbon footprints are based a calculated value that measures the total amount of greenhouse gases
                                                                        (GG) that an activity, product, company, or country emits into the atmosphere. It's reported in
                                                                        tonnes of emissions per unit of comparison, and can be readily assessed by our carbon footprints
                                                                    emission tool.</p>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal services 2 end -->


                                                    <!-- Modal services 3 -->
                                                    <div class="modal fade services-popup" id="exampleModal-b" tabindex="-1" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">ESG Risk</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body services-modal">
                                                                <img src="assets/images/services/ESG-Risk1.jpg" alt="">
                                                                <p>Our ESG Risk Assessment services identify and evaluate environmental, social, and governance risks
                                                                    that could impact your business. We offer strategies to mitigate these risks and enhance your
                                                                overall resilience.</p>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal services 3 end -->


                                                <!-- Modal services 4 -->
                                                <div class="modal fade services-popup" id="exampleModal-c" tabindex="-1" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Climate Risk</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body services-modal">
                                                            <img src="assets/images/services/Climate-Risk.jpg" alt="">
                                                            <p>Climate risk is the potential for climate change to negatively impact ecosystems and societies. It
                                                                can be assessed by analysing the likelihood, consequences, and responses to these impacts, which
                                                                helps in prioritising climate action. Our customized services can help identify and mitigate these
                                                            risks.</p>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal services 4 end -->

                                            <!-- Modal services 5 -->
                                            <div class="modal fade services-popup" id="exampleModal-d" tabindex="-1" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Environment Impact</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body services-modal">
                                                        <img src="assets/images/services/Environment-Impact.jpg" alt="">
                                                        <p>Our Environment Assessment services evaluate the environmental impact of your operations, identifying
                                                            areas for improvement and ensuring compliance with regulatory standards. We provide detailed reports
                                                        and actionable insights to help reduce your environmental footprint.</p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal services 5 end -->

                                        <!-- Modal services 6 -->
                                        <div class="modal fade services-popup" id="exampleModal-e" tabindex="-1" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Social Impact</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body services-modal">
                                                    <img src="assets/images/services/Social-Impact2.jpg" alt="">
                                                    <p>Our Social Assessment services analyze the social impact of your business activities, focusing on
                                                        community engagement, employee welfare, and ethical practices. We help you foster positive
                                                    relationships and enhance your social responsibility initiatives.</p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal services 6 end -->


                                    <!-- Modal services 7 -->
                                    <div class="modal fade services-popup" id="exampleModal-f" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Governance Matrix</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body services-modal">
                                                <img src="assets/images/services/Governance-Matrix2.jpg" alt="">
                                                <p>Our Governance Assessment services review your corporate governance practices, ensuring transparency,
                                                    accountability, and ethical conduct. We provide recommendations to strengthen your governance
                                                framework and enhance stakeholder trust.</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Modal services 7 end -->

                                <!-- Modal services 8 -->
                                <div class="modal fade services-popup" id="exampleModal-g" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Regulatory Reports</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body services-modal">
                                            <img src="assets/images/services/Regulatory-Reports2.jpg" alt="">
                                            <p>Regulatory reporting are practices to disclose the sustainability and ethical performance of your
                                                entity. These reports help your investors understand the ESG strategy and performance, which can
                                                help them make informed investment decisions. We provide assistance for preparing regulatory reports
                                            as per national and international standards.</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- Modal services 8 end -->

                            <!-- Modal services 9 -->
                            <div class="modal fade services-popup" id="exampleModal-h" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Sustainability Reports</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body services-modal">
                                        <img src="assets/images/services/Sustainability-Report2.jpg" alt="">
                                        <p>Our Sustainability Reporting services help you communicate your ESG initiatives and achievements to
                                            stakeholders. We create clear, comprehensive, and engaging reports that highlight your commitment to
                                        sustainability and responsible business practices.</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Modal services 9 end -->

                        <!-- Modal services 10 -->
                        <div class="modal fade services-popup" id="exampleModal-i" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">ESG Assurance</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body services-modal">
                                    <img src="assets/images/services/ESG-Assurance2.jpg" alt="">
                                    <p>SEBI has mandated assurance for the reported data in BRSRs of top 150 companies in FY2024 with
                                        incremental companies in the assurance purview from FY2024-25 onwards. We provide limited and
                                    reasonable assurance as per SEBI guidelines. </p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Modal services 10 end -->

                    <!-- Modal services 11 -->
                    <div class="modal fade services-popup" id="exampleModal-j" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">UN SDG Mapping</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body services-modal">
                                <img src="assets/images/services/UN-SDG-Mapping.jpg" alt="">
                                <p>Our UN SDG Mapping services align your business activities with the United Nations Sustainable
                                    Development Goals (SDGs). We help you identify key areas of impact and integrate SDG targets into
                                your strategic planning.</p>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Modal services 11 end -->

                <!-- Modal services 12 -->
                <div class="modal fade services-popup" id="exampleModal-k" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ESG Strategy</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body services-modal">
                            <img src="assets/images/services/ESG-Strategy.jpg" alt="">
                            <p>Our ESG Strategy services develop and implement comprehensive strategies to integrate environmental,
                                social, and governance principles into your business operations. We help you achieve sustainable
                            growth and long-term value creation.</p>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Modal services 12 end -->

            <!-- Modal services 13 -->
            <div class="modal fade services-popup" id="exampleModal-l" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Net Zero Plan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body services-modal">
                        <img src="assets/images/services/NetZero-Plan.jpg" alt="">
                        <p>Our Net Zero Plan services assist you in developing and implementing strategies to achieve net zero
                            carbon emissions. We provide tailored solutions to help you minimize your carbon footprint and
                        contribute to global climate goals.</p>
                    </div>

                </div>
            </div>
        </div>
        <!-- Modal services 13 end -->

        <!-- Modal services 14 -->
        <div class="modal fade services-popup" id="exampleModal-m" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Carbon Credits</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body services-modal">
                    <img src="assets/images/services/Carbon-Credits.jpg" alt="">
                    <p>Carbon credits are a unit of measurement that represent a reduction of one metric ton in greenhouse
                        gas emissions. They are also known as carbon offsets or carbon allowances. We are qualified and
                    seasoned in carbon credit measurement and facilitate carbon credit development and supply. </p>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal services 14 end -->

    <!-- services Modal end -->

    <!-- Vendor JS Files -->

    <!--====== jquery js ======-->
    <script src="{{asset('assets/layout_js/vendor/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('assets/layout_js/vendor/modernizr-3.6.0.min.js')}}"></script>


    <!--====== Bootstrap js ======-->
    <script src="{{asset('assets/layout_js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/landing/jquery-3.5.1.min.js') }}"></script>





    <!--====== owl.carousel.min js ======-->
    <script src="{{asset('assets/layout_js/owl.carousel.min.js')}}"></script>

    <script src="{{ asset('js/landing/bootstrap-select.min.js') }}"></script>

    <script src="{{asset('assets/layout_js/all.js')}}"></script>

    <!--====== Slick js ======-->
    <script src="{{asset('assets/layout_js/slick.min.js')}}"></script>

    <!--====== Magnific Popup js ======-->
    <script src="{{asset('assets/layout_js/jquery.magnific-popup.min.js')}}"></script>

    <!--====== Nice Select js ======-->


    <!--====== Counter Up js ======-->
    <script src="{{asset('assets/layout_js/waypoints.min.js')}}"></script>
    <script src="{{asset('assets/layout_js/jquery.counterup.min.js')}}"></script>

    <!--====== Nice Number js ======-->
    <script src="{{asset('assets/layout_js/jquery.nice-number.min.js')}}"></script>


    <script src="{{asset('assets/layout_js/aos.js')}}"></script>


    <!--====== Main js ======-->
    <script src="{{asset('assets/layout_js/main.js')}}"></script>



    @stack('scripts')

    <script>
        function session1(name) {
            sessionStorage.setItem('my_session', name);
            var a = sessionStorage.getItem('my_session');
        }
    </script>

    <script>
        AOS.init({
            duration: 1200,
        })
    </script>
</body>

</html>




