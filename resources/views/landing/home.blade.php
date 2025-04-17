@extends('layouts.master')

@section('title')
    ESG Prakrit
@endsection

@push('styles')
@endpush

@section('content')
    <!--====== CATEGORY PART START ======-->

    <section id="category-part" class="hero-slider hexagon-circle-gallery">
        <div class="container-fluid">
            <div class="category">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="category-text pt-40 col-md-12">
                            <h4 data-aos="fade-down" data-aos-delay="800">a <span> comprehensive</span> dashboard</h4>
                            <h2 data-aos="fade-right" data-aos-delay="1200">ESG <span data-aos="fade-left"
                                    data-aos-delay="1400"> Prakrit</span></h2>
                            <h3 class="capital-text-color" data-aos="fade-left" data-aos-delay="1800"> <span>PR</span>emier
                                <span>A</span>venue for <span>K</span>nowledge <span>R</span>epository & <span>I</span>mpact
                                <span>T</span>ool
                            </h3>
                        </div>


                        <div class="esg-prakrit-logo">
                            <div class="logo-esg">
                                <img src="assets/images/logo/ESG-Prakrit-logo4.png" class="logo-b"
                                    alt="Logo ESG-Prakrit-logo4">
                            </div>
                        </div>


                        {{-- <div class="login-btn animation-btn-css col-md-5">
                            @if (Route::has('login'))
                                @auth
                                    @if (Auth::user()->hasRole('Admin') or Auth::user()->hasRole('SuperAdmin'))
                                        <a href="{{ route('admin.index') }}" class="btn animation-btn">
                                            Dashboard</a>

                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn animation-btn"
                                        onclick="session1('Bank')">
                                        &nbsp;&nbsp; Bank Login &nbsp;&nbsp;</a>
                                @endauth
                            @endif

                            @if (Route::has('login'))
                                @auth
                                    @if (Auth::user()->hasRole('ActiveUser'))
                                        <a href="{{ route('home') }}" class="btn animation-btn">
                                            Dashboard</a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn animation-btn"
                                        onclick="session1('Company')">
                                        Company Login</a>
                                @endauth
                            @endif --}}
                        {{-- <a href="login.html" class="btn animation-btn" target="_blank">Bank Login</a>
                            <a href="login.html" class="btn animation-btn" target="_blank">Company Login</a> --}}
                        {{-- </div> --}}

                    </div>

                    <div class="col-lg-12 p-480-0">
                        <!-- <section class="hexagon-gallery">
                                        <div class="hex"><img src="images/plant-tree2.jpg" alt="img"></div>
                                        <div class="hex"><img src="images/plant-tree2.jpg" alt="img"></div>
                                        <div class="hex"><img src="images/plant-tree3.jpg" alt="img"></div>
                                        <div class="hex"><img src="images/plant-tree5.jpg" alt="img"></div>
                                        <div class="hex"><img src="images/plant-tree5.jpg" alt="img"></div>
                                        <div class="hex"><img src="images/plant-tree2.jpg" alt="img"></div>
                                        <div class="hex"><img src="images/plant-tree3.jpg" alt="img"></div>
                                        <div class="hex"><img src="images/plant-tree5.jpg" alt="img"></div>
                                        <div class="hex"><img src="images/plant-tree5.jpg" alt="img"></div>
                                        <div class="hex"><img src="images/plant-tree2.jpg" alt="img"></div>
                                        <div class="hex"><img src="images/plant-tree3.jpg" alt="img"></div>
                                        <div class="hex"><img src="images/plant-tree5.jpg" alt="img"></div>
                                        <div class="hex"><img src="images/plant-tree2.jpg" alt="img"></div>
                                      </section> -->

                        <div class="grid">
                            <ul id="hexGrid">

                                <li class="hex" data-aos="fade-down" data-aos-delay="100">
                                    <div class="hexIn">
                                        <a class="hexLink" href="javascript:void(0)" data-toggle="modal"
                                            data-target="#exampleModal">
                                            <div class='img'
                                                style='background-image:url(assets/images/services/Financed-Emissions2.jpg);'>
                                            </div>
                                            <h1 id="demo1">Financed Emissions</h1>
                                            <!-- <p id="demo2">Some sample text about the article this hexagon leads to</p> -->
                                        </a>
                                    </div>
                                </li>

                                <li class="hex" data-aos="fade-down" data-aos-delay="300">
                                    <div class="hexIn">
                                        <a class="hexLink" href="javascript:void(0)" data-toggle="modal"
                                            data-target="#exampleModal-a">
                                            <div class='img'
                                                style='background-image:url(assets/images/services/Carbon-Footprint2.jpg);'>
                                            </div>
                                            <h1 id="demo1">Carbon Footprint </h1>
                                            <!-- <p id="demo2">Some sample text about the article this hexagon leads to</p> -->
                                        </a>
                                    </div>
                                </li>

                                <li class="hex" data-aos="fade-down" data-aos-delay="500">
                                    <div class="hexIn">
                                        <a class="hexLink" href="javascript:void(0)" data-toggle="modal"
                                            data-target="#exampleModal-b">
                                            <div class='img'
                                                style='background-image:url(assets/images/services/ESG-Risk1.jpg);'>
                                            </div>
                                            <h1 id="demo1">ESG Risk</h1>
                                            <!-- <p id="demo2">Some sample text about the article this hexagon leads to</p> -->
                                        </a>
                                    </div>
                                </li>

                                <li class="hex" data-aos="fade-down" data-aos-delay="700">
                                    <div class="hexIn">
                                        <a class="hexLink" href="javascript:void(0)" data-toggle="modal"
                                            data-target="#exampleModal-c">
                                            <div class='img'
                                                style='background-image:url(assets/images/services/Climate-Risk.jpg);'>
                                            </div>
                                            <h1 id="demo1">Climate Risk</h1>
                                            <!-- <p id="demo2">Some sample text about the article this hexagon leads to</p> -->
                                        </a>
                                    </div>
                                </li>

                                <li class="hex" data-aos="fade-down" data-aos-delay="500">
                                    <div class="hexIn">
                                        <a class="hexLink" href="javascript:void(0)" data-toggle="modal"
                                            data-target="#exampleModal-d">
                                            <div class='img'
                                                style='background-image:url(assets/images/services/Environment-Impact.jpg);'>
                                            </div>
                                            <h1 id="demo1">Environment Impact </h1>
                                            <!-- <p id="demo2">Some sample text about the article this hexagon leads to</p> -->
                                        </a>
                                    </div>
                                </li>

                                <li class="hex" data-aos="fade-down" data-aos-delay="300">
                                    <div class="hexIn">
                                        <a class="hexLink" href="javascript:void(0)" data-toggle="modal"
                                            data-target="#exampleModal-e">
                                            <div class='img'
                                                style='background-image:url(assets/images/services/Social-Impact2.jpg);'>
                                            </div>
                                            <h1 id="demo1">Social Impact</h1>
                                            <!-- <p id="demo2">Some sample text about the article this hexagon leads to</p> -->
                                        </a>
                                    </div>
                                </li>

                                <li class="hex" data-aos="fade-up" data-aos-delay="100">
                                    <div class="hexIn">
                                        <a class="hexLink" href="javascript:void(0)" data-toggle="modal"
                                            data-target="#exampleModal-f">
                                            <div class='img'
                                                style='background-image:url(assets/images/services/Governance-Matrix2.jpg);'>
                                            </div>
                                            <h1 id="demo1">Governance Matrix</h1>
                                            <!-- <p id="demo2">Some sample text about the article this hexagon leads to</p> -->
                                        </a>
                                    </div>
                                </li>

                                <li class="hex" data-aos="fade-up" data-aos-delay="1300">
                                    <div class="hexIn">
                                        <a class="hexLink" href="javascript:void(0)" data-toggle="modal"
                                            data-target="#exampleModal-g">
                                            <div class='img'
                                                style='background-image:url(assets/images/services/Regulatory-Reports2.jpg);'>
                                            </div>
                                            <h1 id="demo1">Regulatory Reports</h1>
                                            <!-- <p id="demo2">Some sample text about the article this hexagon leads to</p> -->
                                        </a>
                                    </div>
                                </li>

                                <li class="hex" data-aos="fade-up" data-aos-delay="1100">
                                    <div class="hexIn">
                                        <a class="hexLink" href="javascript:void(0)" data-toggle="modal"
                                            data-target="#exampleModal-h">
                                            <div class='img'
                                                style='background-image:url(assets/images/services/Sustainability-Report2.jpg);'>
                                            </div>
                                            <h1 id="demo1">Sustainability Report</h1>
                                            <!-- <p id="demo2">Some sample text about the article this hexagon leads to</p> -->
                                        </a>
                                    </div>
                                </li>

                                <li class="hex" data-aos="fade-up" data-aos-delay="900">
                                    <div class="hexIn">
                                        <a class="hexLink" href="javascript:void(0)" data-toggle="modal"
                                            data-target="#exampleModal-i">
                                            <div class='img'
                                                style='background-image:url(assets/images/services/ESG-Assurance2.jpg);'>
                                            </div>
                                            <h1 id="demo1">ESG Assurance</h1>
                                            <!-- <p id="demo2">Some sample text about the article this hexagon leads to</p> -->
                                        </a>
                                    </div>
                                </li>

                                <li class="hex" data-aos="fade-up" data-aos-delay="700">
                                    <div class="hexIn">
                                        <a class="hexLink" href="javascript:void(0)" data-toggle="modal"
                                            data-target="#exampleModal-j">
                                            <div class='img'
                                                style='background-image:url(assets/images/services/UN-SDG-Mapping.jpg);'>
                                            </div>
                                            <h1 id="demo1">UN-SDG Mapping</h1>
                                            <!-- <p id="demo2">Some sample text about the article this hexagon leads to</p> -->
                                        </a>
                                    </div>
                                </li>

                                <li class="hex" data-aos="fade-up" data-aos-delay="500">
                                    <div class="hexIn">
                                        <a class="hexLink" href="javascript:void(0)" data-toggle="modal"
                                            data-target="#exampleModal-k">
                                            <div class='img'
                                                style='background-image:url(assets/images/services/ESG-Strategy.jpg);'>
                                            </div>
                                            <h1 id="demo1">ESG Strategy </h1>
                                            <!-- <p id="demo2">Some sample text about the article this hexagon leads to</p> -->
                                        </a>
                                    </div>
                                </li>

                                <li class="hex" data-aos="fade-up" data-aos-delay="300">
                                    <div class="hexIn">
                                        <a class="hexLink" href="javascript:void(0)" data-toggle="modal"
                                            data-target="#exampleModal-l">
                                            <div class='img'
                                                style='background-image:url(assets/images/services/NetZero-Plan.jpg);'>
                                            </div>
                                            <h1 id="demo1">Net Zero Plan</h1>
                                            <!-- <p id="demo2">Some sample text about the article this hexagon leads to</p> -->
                                        </a>
                                    </div>
                                </li>

                                <li class="hex" data-aos="fade-up" data-aos-delay="100">
                                    <div class="hexIn">
                                        <a class="hexLink" href="javascript:void(0)" data-toggle="modal"
                                            data-target="#exampleModal-m">
                                            <div class='img'
                                                style='background-image:url(assets/images/services/Carbon-Credits.jpg);'>
                                            </div>
                                            <h1 id="demo1">Carbon Credits</h1>
                                            <!-- <p id="demo2">Some sample text about the article this hexagon leads to</p> -->
                                        </a>
                                    </div>
                                </li>
                            </ul>
                            <h4>Through our Sustainability & ESG Solutions, IFCI endeavours to contribute <br> significantly
                                towards the Net Zero Target of the country.</h4>
                        </div>



                    </div>
                </div>
            </div>

            {{-- hexagon-circle services slider --}}
            <section class="hexagon-services-slider">
                <div class="container">
                    <div class="owl-carousel owl-theme">
                        <div class="item">
                            <div class="hex">
                                <div class="hexIn">
                                    <a class="hexLink" href="javascript:void(0)" data-toggle="modal"
                                        data-target="#exampleModal">
                                        <div class='img'
                                            style='background-image:url(assets/images/services/Financed-Emissions2.jpg);'>
                                        </div>
                                        <h1 id="demo1">Financed Emissions</h1>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="hex">
                                <div class="hexIn">
                                    <a class="hexLink" href="javascript:void(0)" data-toggle="modal"
                                        data-target="#exampleModal-a">
                                        <div class='img'
                                            style='background-image:url(assets/images/services/Carbon-Footprint2.jpg);'>
                                        </div>
                                        <h1 id="demo1">Carbon Footprint </h1>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="hex">
                                <div class="hexIn">
                                    <a class="hexLink" href="javascript:void(0)" data-toggle="modal"
                                        data-target="#exampleModal-b">
                                        <div class='img' style='background-image:url(assets/images/services/ESG-Risk1.jpg);'>
                                        </div>
                                        <h1 id="demo1">ESG Risk</h1>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="hex">
                                <div class="hexIn">
                                    <a class="hexLink" href="javascript:void(0)" data-toggle="modal"
                                        data-target="#exampleModal-c">
                                        <div class='img'
                                            style='background-image:url(assets/images/services/Climate-Risk.jpg);'>
                                        </div>
                                        <h1 id="demo1">Climate Risk</h1>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="hex">
                                <div class="hexIn">
                                    <a class="hexLink" href="javascript:void(0)" data-toggle="modal"
                                        data-target="#exampleModal-d">
                                        <div class='img'
                                            style='background-image:url(assets/images/services/Environment-Impact.jpg);'>
                                        </div>
                                        <h1 id="demo1">Environment Impact </h1>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="hex">
                                <div class="hexIn">
                                    <a class="hexLink" href="javascript:void(0)" data-toggle="modal"
                                        data-target="#exampleModal-e">
                                        <div class='img'
                                            style='background-image:url(assets/images/services/Social-Impact2.jpg);'>
                                        </div>
                                        <h1 id="demo1">Social Impact</h1>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="hex">
                                <div class="hexIn">
                                    <a class="hexLink" href="javascript:void(0)" data-toggle="modal"
                                        data-target="#exampleModal-f">
                                        <div class='img'
                                            style='background-image:url(assets/images/services/Governance-Matrix2.jpg);'>
                                        </div>
                                        <h1 id="demo1">Governance Matrix</h1>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="hex">
                                <div class="hexIn">
                                    <a class="hexLink" href="javascript:void(0)" data-toggle="modal"
                                        data-target="#exampleModal-g">
                                        <div class='img'
                                            style='background-image:url(assets/images/services/Regulatory-Reports2.jpg);'>
                                        </div>
                                        <h1 id="demo1">Regulatory Reports</h1>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="hex">
                                <div class="hexIn">
                                    <a class="hexLink" href="javascript:void(0)" data-toggle="modal"
                                        data-target="#exampleModal-h">
                                        <div class='img'
                                            style='background-image:url(assets/images/services/Sustainability-Report2.jpg);'>
                                        </div>
                                        <h1 id="demo1">Sustainability Report</h1>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="hex">
                                <div class="hexIn">
                                    <a class="hexLink" href="javascript:void(0)" data-toggle="modal"
                                        data-target="#exampleModal-i">
                                        <div class='img'
                                            style='background-image:url(assets/images/services/ESG-Assurance2.jpg);'>
                                        </div>
                                        <h1 id="demo1">ESG Assurance</h1>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="hex">
                                <div class="hexIn">
                                    <a class="hexLink" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal-j">
                                        <div class='img' style='background-image:url(assets/images/services/UN-SDG-Mapping.jpg);'>
                                        </div>
                                        <h1 id="demo1">UN-SDG Mapping</h1>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="hex">
                                <div class="hexIn">
                                    <a class="hexLink" href="javascript:void(0)" data-toggle="modal"
                                        data-target="#exampleModal-k">
                                        <div class='img'
                                            style='background-image:url(assets/images/services/ESG-Strategy.jpg);'>
                                        </div>
                                        <h1 id="demo1">ESG Strategy </h1>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="hex">
                                <div class="hexIn">
                                    <a class="hexLink" href="javascript:void(0)" data-toggle="modal"
                                        data-target="#exampleModal-l">
                                        <div class='img'
                                            style='background-image:url(assets/images/services/NetZero-Plan.jpg);'>
                                        </div>
                                        <h1 id="demo1">Net Zero Plan</h1>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="hex">
                                <div class="hexIn">
                                    <a class="hexLink" href="javascript:void(0)" data-toggle="modal"
                                        data-target="#exampleModal-m">
                                        <div class='img'
                                            style='background-image:url(assets/images/services/Carbon-Credits.jpg);'>
                                        </div>
                                        <h1 id="demo1">Carbon Credits</h1>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-12">
                        <h4>Through our Sustainability &amp; ESG Solutions, IFCI endeavours to contribute significantly
                            towards the Net Zero Targets of the country.</h4>
                    </div>
                </div>
            </section>
            {{-- hexagon-circle services slider end --}}

        </div>
    </section>












    {{-- <section id="category-part" class="hero-slider">
        <div class="container-fluid">
            <div class="category">
                <div class="row">


                    <div class="col-lg-12 col-md-12 text-center">
                        <div class="category-text pt-40 pl-40">
                            <h2>ESG Dashboard</h2>
                            <h3>An IFCI-TERI Initiative</h3>
                        </div>
                        <div class="login-btn animation-btn-css pl-40">
                            @if (Route::has('login'))
                                @auth
                                    @if (Auth::user()->hasRole('Admin') or Auth::user()->hasRole('SuperAdmin'))
                                        <a href="{{ route('admin.index') }}" class="btn animation-btn">
                                            Dashboard</a>

                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn animation-btn"
                                        onclick="session1('Bank')">
                                        &nbsp;&nbsp; Bank Login &nbsp;&nbsp;</a>
                                @endauth
                            @endif

                            @if (Route::has('login'))
                                @auth
                                    @if (Auth::user()->hasRole('ActiveUser'))
                                        <a href="{{ route('home') }}" class="btn animation-btn">
                                            Dashboard</a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn animation-btn"
                                        onclick="session1('Company')">
                                        Company Login</a>
                                @endauth
                            @endif
                        </div>

                    </div>


                </div> <!-- row -->
            </div> <!-- category -->
        </div> <!-- container -->
    </section> --}}

    <!--====== CATEGORY PART ENDS ======-->

    <!--====== ESG DASHBOARD PART START ======-->
    {{-- <section id="about-part section-a target1" class="ESG-dashboard-bg target">
        <div class="container">
            <div class="apply">
            <div class="row">
                <div class="col-lg-12 bg-color">
                    <div class="section-title apply-cont mt-10 animation-btn-css ESG-dashboard-info-bg">
                        <h3>ESG DASHBOARD</h3>
                        <div class="divider-div"></div>
                        <p>India is in a bright spot in the world economy. There is a visible shift in the world economic order. Over the past few years India is witnessing a consistent GDP growth of 6-7% as against world GDP growth of 2-3%. India is now amongst the top 5 economies of the world. Climate Risk is a major threat to world economic growth. As per a study by CarbonBrief, a 1.5 – 2.0 Degree Celsius temperature increase will erode 8% - 13% of global GDP by 2100. In view of the above, the financial sector must play a pivotal role to drive the ESG agenda for the economy. The flow of funds towards ESG and Sustainability is critical for India to lead the world economic growth. It is increasingly becoming important to measure and track the greenhouse gas (GHG) emissions of corporates. Appropriate measures and regular tracking of GHG emissions would be critical to assess the impact on the overall carbon footprint being generated by corporates – standalone and as a portfolio for a Bank or Financial Institution and also for whole Banking Sector.

                        ESG Prakrit is a dynamic dashboard capturing the footprint for each corporate client/borrower and aggregating the entire emissions to a macro-level. In its initial phase, the tool captures, measures and documents the six-greenhouse gas (GHG) emissions, as per IPCC and calculates the emissions as Scope1, 2 and 3, as per GHG protocol’s guidelines. This data has multipronged benefits, as it helps create a mega repository of industry wise GHG emission data base which helps in inventorization, sector specific analysis and policy developments. Additionally, ESG Prakrit will help Banks and FIs assess their financed emissions (Scope 3) by taking pre-emptive measures, as it is aligned with global benchmarks like PCAF and TCFD and in line with RBI’s climate risk polices. Furthermore, with the tool’s advanced technology and concept assessment, physical risk of investments can be highlighted through its dynamic dashboard, sectoral analysis and heat map. The tool can further help develop SME specific guidelines as well as create an internal rating assessment model.

                        </p>

                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!--====== ESG DASHBOARD PART ENDS ======-->










    <!--====== APPLY PART START ======-->

    <section id="apply-aprt section-a TeriSas target2" class="dashboard-bg target">
        <div class="container">
            <div class="apply">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-4">
                        <div class="apply-cont apply-color-1 animation-btn-css">
                            {{-- <h3>ESG DASHBOARD</h3> --}}
                            <h3>ESG PRAKRIT - A Comprehensive Dashboard</h3>
                            <div class="divider-div"></div>
                            <p style="text-align:justify"> IFCI Ltd has created a dynamic dashbord that captures the carbon
                                footprint for each corporate client/ borrower and aggregates the emissions to macro-level.
                                The dashboard is named as ESG PRAKRIT and in its initial phase, ESG Prakrit captures,
                                measures and documents the seven-greenhouse gas (GHG) emissions, as per Intergovernmental Panel on Climate Change (IPCC) and calculates
                                the emissions as Scope 1, 2 and 3, as per GHG protocol’s guidelines.

                                This captured data has multipronged benefits, as it helps create a mega repository of industry-wise GHG emission database which aids in inventorization, 
                                sector-specific analysis, and policy developments.
                            </p>


                            <div class="read-more-content">
                                <p style="text-align:justify">
                                    Additionally, ESG PRAKRIT will help Banks and FIs assess their financed emissions (Scope 3) 
                                    by taking pre-emptive measures, as it is aligned with global benchmarks like PCAF and
                                    TCFD and in line with RBI’s climate risk polices. Furthermore, with the tool’s advanced
                                    technology and concept assessment, physical risk of investments can be highlighted
                                    through its dynamic dashboard, sectoral analysis and heat map. The tool can further help
                                    develop Small and Medium Enterprises (SME) - specific guidelines as well as create an internal rating assessment model.

                                    The tool is relevant as India is in a bright spot in the world economy. There is a
                                    visible shift in the world economic order. Over the past few years India is witnessing a
                                    consistent GDP growth of 6-7% as against world GDP growth of 2-3%. India is now amongst
                                    the top 5 economies of the world. Climate Risk is a major threat to world economic
                                    growth. As per a study by Carbon Brief, a 1.5 – 2.0 Degree Celsius temperature increase
                                    will erode 8% - 13% of global GDP by 2100. In view of the above, the financial sector
                                    must play a pivotal role to drive the ESG agenda for the economy. The flow of funds
                                    towards ESG and Sustainability is critical for India to lead the world economic growth
                                    It is increasingly becoming important to measure and track the greenhouse gas (GHG)
                                    emissions of corporates. Accurately measuring and consistently monitoring 
                                    greenhouse gas (GHG) emissions is essential for evaluating the overall carbon footprint 
                                    generated by corporations-standalone, investment portfolios held by banks or financial 
                                    institutions, and the entire banking sector.
                                </p>

                                <p style="text-align:justify"> This data has multipronged benefits, as it helps create a
                                  comprehensive repository of industry wise GHG emission data base which helps in inventorization,
                                    sector specific analysis and policy developments. Additionally, ESG PRAKRIT will help
                                    Banks and financial institutions assess their financed emissions (Scope 3) by taking pre-emptive measures,
                                    as it is aligned with global benchmarks like PCAF and TCFD and in line with RBI’s
                                    climate risk polices. Furthermore, with the tool’s advanced technology and concept
                                    assessment, the physical risk of investments can be highlighted through its dynamic
                                    dashboard, sectoral analysis and heat map. The tool can further help develop SME
                                    specific guidelines as well as create an internal rating assessment model.
                                </p>
                            </div>

                            <a href="javascript:void(0);" class="read-more" title="Read More">Read More</a>

                            {{-- <p><strong>To learn more about TERI-SAS</strong></p>

                            <a href="https://www.terisas.ac.in" class="main-btn animation-btn mt-3"> Please Visit</a> --}}
                        </div>
                    </div>
                </div>



                <div class="row">


                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  mb-4">
                        <div class="apply-cont apply-color-2 animation-btn-css">
                            <h3>IFCI LTD.</h3>
                            <div class="divider-div"></div>
                            {{-- <h4>Industrial Finance Corporation of India.</h4> --}}
                            <p style="text-align:justify"> IFCI Ltd (Erstwhile Industrial Finance Corporation of India) was
                                the first Development Finance Institution of independent India set up in 1948. Over the 75
                                years, IFCI (a Government of India Undertaking under Ministry of Finance) has played a
                                pivotal role as a term...

                            </p>

                            <div class="read-more-content">
                                <p style="text-align:justify">
                                    lending institute for India’s economic growth by supporting industries and creating
                                    institutions.
                                </p>

                                <p style="text-align:justify">
                                    In recent years, IFCI has shifted focus to align
                                    itself with the requirements of the economy and has been supporting the Government of
                                    India
                                    as Project Management Agency for various schemes, including PLIs, incentive schemes,
                                    social
                                    development schemes etc. Apart from Government Advisory, IFCI also provides holistic
                                    financial advisory services i.e., Financial Appraisal/ Due Diligence/ Investment
                                    Analysis/
                                    Bid Advisory/ Business Valuation/ Transaction Advisory Services, etc. to various Public
                                    Sector Undertakings and Private Clients.
                                </p>
                            </div>

                            <a href="javascript:void(0);" class="read-more" title="Read More">Read More</a>


                            <p><strong>To learn more about IFCI Ltd</strong></p>

                            <a href="https://www.ifciltd.com" class="main-btn animation-btn mt-2"> Please Visit</a>
                        </div> <!-- apply cont -->
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  mb-4">
                        <div class="apply-cont apply-color-1 animation-btn-css">
                            <h3>TERI-SAS</h3>
                            <div class="divider-div"></div>
                            <p style="text-align:justify">TERI School of Advanced Studies is an internationally acclaimed
                                research institute, renowned for its profound contributions to scientific and policy
                                research in energy, environment, and sustainable development. Over the past 26 years, TERI
                                SAS has...
                            </p>

                            <div class="read-more-content">
                                <p style="text-align:justify">
                                    been instrumental in fostering intellectual growth and advancing sustainable practices
                                    globally.
                                </p>

                                <p style="text-align:justify">
                                    The University is not only nurturing sustainability leaders and strong
                                    professionals for a better tomorrow but also helping in strengthening the ESG
                                    architecture
                                    with stronger, effective and practical policies. TERI SAS has been pivotal in brain
                                    storming
                                    and developing strategies for PSUs, conglomerates and government bodies.
                                    IFCI and TERI-SAS have jointly developed ESG Dashboard as a research based, sector
                                    specialized, bank focussed and India specific carbon footprint calculator which is aligned
                                    to
                                    global frameworks and reporting standards.
                                </p>
                            </div>

                            <a href="javascript:void(0);" class="read-more" title="Read More">Read More</a>

                            <p><strong>To learn more about TERI-SAS</strong></p>

                            <a href="https://www.terisas.ac.in" class="main-btn animation-btn mt-2"> Please Visit</a>
                        </div> <!-- apply cont -->
                    </div>
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== APPLY PART ENDS ======-->

    <!--====== Individual Calculator PART START ======-->

    <section id="teachers-part section-b" class="pt-50 pb-70 individual-calculator-info">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="section-title">
                        <h2>Your Carbon Footprint </h2>
                        <div class="divider-div"></div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="teachers mt-20">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <div class="single-teachers">
                                    <div class="image">
                                        <img src="assets/images/individual-calculator-img/Household-img.jpg"
                                            alt="Teachers">
                                    </div>
                                    <div class="cont">
                                        <a href="#">
                                            <h6>Household</h6>
                                        </a>
                                        <p style="text-align:justify">Emissions are impacted by the size of an household.
                                            More members generally consume more energy. You need to enter the number of
                                            family members, in the relevant field of the calculator to know your footprints.
                                        </p>
                                        <a href="{{ route('calculator') }}" class="learn-more"
                                            href="individual-calculator.html" target="_blank">Learn More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <div class="single-teachers">
                                    <div class="image">
                                        <img src="assets/images/individual-calculator-img/travel-img7.jpg" alt="Teachers">
                                    </div>
                                    <div class="cont">
                                        <a href="#">
                                            <h6>Travel</h6>
                                        </a>
                                        <p style="text-align:justify">Fuel is a major source of carbon emissions, if you
                                            use carpool or public transport your emissions would be comparatively lower than
                                            a private vehicle. You need to enter mode of transport used and distance
                                            travelled to calculate your footprints.
                                        </p>
                                        <a href="{{ route('calculator') }}" class="learn-more"
                                            href="individual-calculator.html" target="_blank">Learn More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <div class="single-teachers">
                                    <div class="image">
                                        <img src="assets/images/individual-calculator-img/electricity-img3.jpg"
                                            alt="Teachers">
                                    </div>
                                    <div class="cont">
                                        <a href="#">
                                            <h6>Electricity</h6>
                                        </a>
                                        <p style="text-align:justify">Energy usage is increasing with rising temperatures,
                                            in turn raising the temperatures further. To know your carbon footprints through
                                            energy usage enter the amount spent monthly on your electricity bills.
                                        </p>
                                        <a href="{{ route('calculator') }}" class="learn-more"
                                            href="individual-calculator.html" target="_blank">Learn More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <div class="single-teachers">
                                    <div class="image">
                                        <img src="assets/images/individual-calculator-img/cooking-fuel-consumption-img.jpg"
                                            alt="Teachers">
                                    </div>
                                    <div class="cont">
                                        <a href="#">
                                            <h6>Cooking Fuel</h6>
                                        </a>
                                        <p style="text-align:justify">Food is another major source of carbon emissions.
                                            Fuel used for cooking impacts our carbon footprints. Enter the amount spent
                                            monthly on your LPG cylinders or the amount of gas pipeline bill for finding
                                            your carbon footprints.</p>
                                        <a href="{{ route('calculator') }}" class="learn-more"
                                            href="individual-calculator.html" target="_blank">Learn More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== Individual Calculator PART ENDS ======-->

    <!-- services Modal -->

    <!-- Button trigger modal -->


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
                    <p>Our financed emissions calculation measures the greenhouse gas emissions (GHG) linked to the investment and
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
                    <p>Carbon footprints are based on a calculated value that measures the total amount of greenhouse gases
                        (GHG) that an activity, product, company, or country emits into the atmosphere. It's reported in
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
                    <p>Regulatory reporting practices are used to disclose the sustainability and ethical performance of your
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
@endsection
@push('scripts')
    <script>
        function session1(name) {
            sessionStorage.setItem('my_session', name);
            var a = sessionStorage.getItem('my_session');
        }
    </script>


    <script>
        $('.read-more').click(function() {
            $(this).prev().slideToggle();
            if (($(this).text()) == "Read More") {
                $(this).text("Read Less");
            } else {
                $(this).text("Read More");
            }
        });
    </script>


    {{-- @include('landing.investIndia') --}}
@endpush
