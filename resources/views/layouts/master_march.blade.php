
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ESG PRAKRIT</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="/images/favicon.png">
    @stack('styles')
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->

     <link rel="stylesheet" href="{{asset('assets-v1/css/bootstrap.min.css')}}">
     <link rel="stylesheet" href="{{asset('assets-v1/css/style.css')}}">

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">

     <link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.slick/1.5.0/slick.css">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.slick/1.5.0/slick-theme.css">

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets-v1/owl.carousel.min.css">

</head>

<body>
       <!--====== PRELOADER PART START ======-->
       <div class="preloader">
            <div class="loader rubix-cube">
                <img src="assets-v1/img/logo/loader-logo.gif" alt="loader-logo">
            </div>
        </div>
        <!--====== PRELOADER PART START ======-->

    <!-- header start -->
        <div class="navigation-wrap bg-light start-header start-style">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-md navbar-light">
                            <a class="navbar-brand" href="#" target="_blank"><img src="{{asset('assets-v1/img/logo/logo-a.png')}}" alt=""></a>
                            <a class="navbar-brand" href="#" target="_blank"><img src="{{asset('assets-v1/img/logo/logo-b.png')}}" alt=""></a>		
                            
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto py-4 py-md-0">
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link active" href="{{ route('landing') }}">Home</a>
                                    </li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Explore</a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('calculator') }}">Your Carbon Footprint</a>
                                            <a class="dropdown-item" href="{{ route('tool') }}">Experience the Tool</a>
                                            <a class="dropdown-item" href="{{ route('faq') }}">FAQs</a>
                                        </div>
                                    </li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link" href="{{ route('contact') }}">Contact Us</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="collapse navbar-collapse login-sec" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto py-4 py-md-0">
                                    
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link login-btn" href="{{ route('admin.login') }}">Login</a>
                                    </li>



                                </ul>
                            </div>
                        </nav>		
                    </div>
                </div>
            </div>
        </div>

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
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 d-flex align-items-start">
                        <div class="footer-about">
                            <div class="logo">
                                
                                <img src="{{asset('assets-v1/img/logo/ESG-Prakrit.png')}}" class="logo-b" alt="Logo">
                            </div>
                            <!-- <p>An industry friendly comprehensive ESG solutions tool with updated and latest Environment, Social, Governance parameters mapped to sectors. </p> -->
                            
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="footer-link f-left">
                            <div class="footer-title pb-2">
                                <h6>Our Services</h6>
                            </div>
                            <div class="row">
                               
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <ul>
                                        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-angle-right"></i> Financed Emissions</a></li>
                                        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal-a"><i class="fa fa-angle-right"></i> Carbon Footprint </a></li>
                                        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal-b"><i class="fa fa-angle-right"></i> ESG Risk</a></li>
                                        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal-c"><i class="fa fa-angle-right"></i> Climate Risk</a></li>
                                        <li><a href="javascript:void(0)"  data-toggle="modal" data-target="#exampleModal-d"><i class="fa fa-angle-right"></i> Environment Impact </a></li>
                                        <li><a href="javascript:void(0)"  data-toggle="modal" data-target="#exampleModal-e"><i class="fa fa-angle-right"></i> Social Impact</a></li>
                                        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal-f"><i class="fa fa-angle-right"></i> Governance Matrix</a></li>
                                    </ul>
                                </div>
                                <!-- Second Column -->
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <ul>
                                        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal-g"><i class="fa fa-angle-right"></i> Regulatory Reports</a></li>
                                        <li><a href="javascript:void(0)"  data-toggle="modal" data-target="#exampleModal-h"><i class="fa fa-angle-right"></i> Sustainability Report</a></li>
                                        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal-i"><i class="fa fa-angle-right"></i> ESG Assurance</a></li>
                                        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal-j"><i class="fa fa-angle-right"></i> UN-SDG Mapping</a></li>
                                        <li><a href="javascript:void(0)"  data-toggle="modal" data-target="#exampleModal-k"><i class="fa fa-angle-right"></i> ESG Strategy </a></li>
                                        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal-l"><i class="fa fa-angle-right"></i> Net Zero Plan </a></li>
                                        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal-m"><i class="fa fa-angle-right"></i> Carbon Credits </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 width-50">
                        <div class="footer-link">
                            <div class="footer-title pb-2">
                                <h6>Support</h6>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul>
                                        <li><a href="{{ route('calculator') }}"><i class="fa fa-angle-right"></i> Your Carbon Footprint</a></li>
                                        <li><a href="{{ route('tool') }}"><i class="fa fa-angle-right"></i> Experience the Tool</a></li>
                                        <li><a href="{{ route('faq') }}"><i class="fa fa-angle-right"></i> FAQs</a></li>
                                        <li><a href="{{ route('contact') }}"><i class="fa fa-angle-right"></i> Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-2 col-sm-3 width-50">
                        <div class="footer-address">
                            <div class="footer-title pb-2">
                                <h6>Contact Us</h6>
                            </div>
                            <ul>
                                <li>
                                    <div class="icon">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                    <div class="cont">
                                        <p>IFCI Tower, 61, Nehru Place, New Delhi, 110019</p>
                                    </div>
                                </li>
                                
                                <li>
                                    <div class="icon">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </div>
                                    
                                    <div class="cont">
                                        <p>+91 9560969186</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <i class="fa-regular fa-envelope"></i>
                                    </div>
                                    <div class="cont">
                                        <p>esg@ifciltd.com</p>
                                    </div>
                                </li>
                                <li class="follow-us-sec">
                                    <div class="follow-us-head">
                                        <h2>Follow Us</h2>
                                    </div>
                                    <div class="icon follow-us">
                                        <i class="fa-brands fa-linkedin"></i>
                                        <i class="fa-brands fa-whatsapp"></i>
                                        <i class="fa-brands fa-facebook"></i>
                                        <i class="fa-brands fa-x-twitter"></i>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> 
            </div> 
        </div> 

        <div class="footer-copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="copyright text-center">
                            <p>&copy; Copyright 2025. All Rights Reserved by <a href="https://www.ifciltd.com/" target="_blank">IFCI Ltd.</a></p>
                        </div>
                    </div>
                </div> 
            </div> 
        </div> 
    </footer>
    <!--====== FOOTER PART ENDS ======-->









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
                    <img src="{{asset('assets-v1/img/services/Financed-Emissions2.jpg')}}" alt="">
                    <p>Our Financed Emissions Calculation measures the greenhouse gas emissions linked to the investment and lending activities of a Bank / Financial Institution, for the emissions produced by the companies in which a bank/ Financial Institution has an investment or loan. It is aligned with the Partnership for Carbon Accounting Financials (PCAF) and Greenhouse Gas Protocol (GHG Protocol) framework, enables banks and financial entities to measure these emissions effectively. By aligning with global climate initiatives like the Paris Agreement, these frameworks provide a standardized methodology for calculating and reporting financed emissions, this alignment ensures compliance with regulatory requirements and facilitates consistent reporting across the financial sector. This tool is essential for evaluating climate risks, establishing reduction targets, and ensuring that investment portfolios align with sustainability goals, ultimately supporting the transition to a low-carbon economy.</p>
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
                    <img src="{{asset('assets-v1/img/services/Carbon-Footprint2.jpg')}}" alt="">
                    <p>Our India-specific carbon footprint service measures the total greenhouse gas (GHG) emissions generated by an activity, product, companies, and other institutions, expressed in tonnes of emissions per unit. The service is designed to provide accurate assessments of greenhouse gas emissions associated with various activities, utilizing reputable sources such as the United Nations Framework Convention on Climate Change (UNFCCC), Intergovernmental Panel on Climate Change (IPCC), Greenhouse Gas Protocol (GHG Protocol), Carbon Disclosure Project (CDP) and UK Department for Environment, Food and Rural Affairs (DEFRA).  Understanding and measuring this footprint is vital for effective reduction strategies. ESG PRAKRIT specializes in assessing and measuring Scope 1, 2, and 3 emissions. Our carbon footprint emission tool allows Organizations, Corporates and other Financial Institutions (FI’s) to evaluate their environmental impact accurately, enabling them to implement targeted strategies for sustainability and Net-Zero goals. By measuring their carbon footprint, entity can take meaningful steps toward reducing emissions and promoting a greener future.</p>
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
                    <img src="{{asset('assets-v1/img/services/ESG-Risk1.jpg')}}" alt="">
                    <p>Our ESG Risk service is designed to help organizations identify, assess, and manage the multifaceted risks associated with Environmental, Social, and Governance factors. We work closely with businesses to develop a robust ESG strategy that aligns with their overall objectives while addressing potential vulnerabilities. By conducting comprehensive ESG assessments, we pinpoint critical risks related to climate change, resource management, labor practices, and governance structures. Our experts provide actionable insights and tailored solutions to mitigate these risks, ensuring compliance with regulatory requirements and enhancing stakeholder trust. Through effective governance frameworks and continuous monitoring, we empower organizations to integrate ESG considerations into their operational strategies, ultimately fostering resilience and sustainable growth in an increasingly complex business landscape</p>
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
                    <img src="{{asset('assets-v1/img/services/Climate-Risk.jpg')}}" alt="">
                    <p>Our Climate Risk services offer banks, corporates, and financial institutions a structured approach to identifying, assessing, and mitigating climate-related risks.  we help organizations navigate both physical risks such drought, rainfall, fog, wind, lightning, Dust storm, hailstorm, cyclone and thunderstorm. Also, the transition risks, including regulatory shifts, and evolving investor expectations, we analyze climate vulnerabilities across financial portfolios, corporate operations, and investment strategies, ensuring resilience against environmental disruptions. By proactively managing climate risks, organizations & institutions can safeguard their assets, strengthen regulatory compliance, and drive long-term sustainable growth.</p>
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
                    <img src="{{asset('assets-v1/img/services/Environment-Impact.jpg')}}" alt="">
                    <p>Our Environmental Impact services offer a structured approach to assessing and mitigating the environmental footprint of their operations, investments, and supply chains. We provide in-depth evaluations to identify areas for improvement, ensure compliance with environmental regulations, and integrate sustainability into core business strategies. We analyze organization’s resource consumption, emissions, waste management, and biodiversity impact.</p>
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
                    <img src="{{asset('assets-v1/img/services/Social-Impact2.jpg')}}" alt="">
                    <p>Our Social Impact Assessment services analyze the social impact of your business activities, emphasizing community engagement, employee welfare, and ethical practices.  We assist in cultivating positive relationships and enhancing your social responsibility initiatives. Through our services, we measure social impact by focusing on key areas such as employee well-being, community involvement, human rights, and diversity, ensuring alignment with international standards.  By identifying potential social consequences, both positive and negative, we enable your organization to mitigate risks, foster corporate citizenship, and maximize social values. This comprehensive approach ensures sustainable and responsible business practices.   </p>
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
                    <img src="{{asset('assets-v1/img/services/Governance-Matrix2.jpg')}}" alt="">
                    <p>Our Governance Assessment services critically evaluate your corporate governance practices to ensure transparency, accountability, and ethical conduct. We provide tailored recommendations to enhance your governance framework, fostering greater stakeholder trust and confidence. Strong governance is essential for sustainable business practices, ESG PRAKRIT offers comprehensive governance matrix solutions, including board evaluations and compliance audits, to strengthen policies and ethical guidelines. By identifying areas for improvement, we empower organizations to align with best practices and regulatory requirements, ultimately enhancing decision-making processes and promoting a culture of integrity within your organization, strengthening governance is key to long-term success and resilience. </p>
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
                    <img src="{{asset('assets-v1/img/services/Regulatory-Reports2.jpg')}}" alt="">
                    <p>Our comprehensive regulatory reporting services are designed to help Financial Institutions and Corporates to navigate the complex landscape of Environmental, Social, and Governance (ESG) regulations. Our expertise ensures that your entity's sustainability and ethical performance are disclosed in compliance with both National and International standards, aligning with frameworks such as SEBI’s Business Responsibility and Sustainability Reporting (BRSR), Reserve Bank of India (RBI’s) Climate-related Financial Disclosure, and Partnership for Carbon Accounting Financials (PCAF). By leveraging our services, organizations can maintain high levels of transparency and accountability, which are essential for building trust with stakeholders and investors.</p>
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
                    <img src="{{asset('assets-v1/img/services/Sustainability-Report2.jpg')}}" alt="">
                    <p>Our Sustainability Reporting services offer businesses a structured and transparent way to communicate their ESG initiatives, progress, and impact to stakeholders. We align your sustainability reports with leading frameworks such as Business Responsibility and Sustainability Reporting (BRSR), RBI’s Norms on Disclosure framework on Climate-related Financial Risks, Global Reporting Initiative (GRI), Sustainability Accounting Standards Board (SASB), Task Force on Climate-related Financial Disclosure (TCFD) , and Corporate Sustainability Reporting Directive (CSRD) to meet regulatory requirements and industry best practices. By enhancing the clarity and credibility of your reporting, we help you demonstrate leadership in environmental stewardship, social responsibility, and corporate governance.</p>
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
                    <img src="{{asset('assets-v1/img/services/ESG-Assurance2.jpg')}}" alt="">
                    <p>ESG assurance services ensures organizations meet the growing regulatory requirements for sustainability reporting. With the Securities and Exchange Board of India (SEBI) mandating assurance for the reported data in Business Responsibility and Sustainability Reports (BRSRs) of the top 500 companies starting in FY2025, and expanding to additional companies in subsequent years, our services are crucial for ensuring compliance and enhancing credibility. As regulatory bodies like SEBI introduce stringent requirements for ESG disclosures, obtaining assurance becomes essential for companies to demonstrate adherence to the evolving standards, for that our ESG Assurance services will help build trust among stakeholders, including investors, customers, and employees. </p>
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
                    <img src="{{asset('assets-v1/img/services/UN-SDG-Mapping.jpg')}}" alt="">
                    <p>Our UN SDG Mapping services offer businesses a structured approach to aligning their sustainability efforts with the United Nations Sustainable Development Goals (SDGs). We help organizations identify, measure, and integrate SDG-aligned strategies into their operations, ensuring a meaningful contribution to global sustainability targets. By embedding UN SDG Mapping into your corporate sustainability strategy, we enables you to drive measurable impact, enhance ESG compliance. We support seamless integration of SDG-related disclosures into ESG frameworks, sustainability reports, and regulatory filings.</p>
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
                    <img src="{{asset('assets-v1/img/services/ESG-Strategy.jpg')}}" alt="">
                    <p>Our Environmental, Social, Governance (ESG) Strategy services empower Banks, Corporates, and other Institutions to seamlessly embed ESG principles into their core business framework. We conduct comprehensive materiality assessments to identify ESG factors that are most relevant to your business and stakeholders. Our strategies align with Business Responsibility and Sustainability Reporting (BRSR), RBI’s Norms on Disclosure framework on Climate-related Financial Risks, Global Reporting Initiative (GRI), Sustainability Accounting Standards Board (SASB), Task Force on Climate-related Financial Disclosure (TCFD), and Corporate Sustainability Reporting Directive (CSRD. We help identify and mitigate ESG risks, ensuring businesses are well-prepared for evolving regulations, climate challenges, and social expectations. Moreover, it can drive meaningful impact, build stakeholder trust, and future-proof their business in an increasingly responsible and competitive marketplace.</p>
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
                    <img src="{{asset('assets-v1/img/services/NetZero-Plan.jpg')}}" alt="">
                    <p>Our Net Zero Plan services assist you in developing and implementing strategies to achieve net-zero carbon emissions, by creating detailed net-zero roadmaps. We provide tailored solutions to help you minimize your carbon footprint and contribute to global climate goals. This service is designed to help businesses navigate the complexities of decarbonization, leveraging the Science-Based Targets initiative (SBTi) to ensure that your sustainability goals are grounded in climate science. By committing to Net-Zero, organizations & Institutions can significantly enhance their reputation and brand value. Through our solutions organisations can minimize their carbon footprint and contribute to global climate objectives. Transitioning to net-zero emissions requires a structured approach that includes emissions reduction and offsetting.</p>
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
                    <img src="{{asset('assets-v1/img/services/Carbon-Credits.jpg')}}" alt="">
                    <p>Carbon credits are a unit of measurement that represents a reduction of one metric ton in greenhouse gas emissions. They are also known as carbon offsets or carbon allowances. We are qualified and seasoned in carbon credit measurement and facilitate carbon credit development and supply. As it is essential for organizations aiming to offset their carbon footprint. Our Carbon Credit service, specializes in carbon credit measurement, development, and supply, facilitating participation in both voluntary and compliance carbon markets. Our services include assisting financial and other institutions in investing in high-quality carbon offset projects, ensuring adherence to rigorous verification and certification standards. By providing expertise in carbon credit verification and integration into broader ESG and decarbonization strategies, we help enhance their sustainability initiatives.  </p>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal services 14 end -->

    <!-- services Modal end -->

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="{{asset('assets-v1/js/jquery-1.12.4.min.js')}}"></script>
    
    <script src="{{asset('assets-v1/js/bootstrap.min.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/jquery.slick/1.5.0/slick.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script src="{{asset('assets-v1/js/main.js')}}"></script>

    <!-- <script src="assets-v1/js/main.js"></script> -->


    <script>
    //===== Prealoder js
        $(window).on('load', function(event) {
            $('.preloader').delay(500).fadeOut(500);
        });
    //===== Prealoder js end
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
    {{-- Alignment to standard js --}}
    <script>
    $(document).ready(function(){
        $('.logos-slider').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        prevArrow: '<i class="slick-prev fas fa-angle-left"></i>',
        nextArrow: '<i class="slick-next fas fa-angle-right"></i>',
        responsive: [{
        breakpoint: 768,
        settings: {
            slidesToShow: 3
        }
        }, {
        breakpoint: 520,
        settings: {
            slidesToShow: 2
        }
        }]
        });
    });
    </script>

    @stack('scripts')

</body>



<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script> -->




{{-- autopopup js --}}
<script>
    $(document).ready(function(){
    var stopAutohide;

    function showWindow(){
    $('#autopopup-sec').show();
    // stop scroll
    $('html body').css('overflow','auto');
    // auto hide fter 5s
    stopAutohide = setTimeout(hideWindow,5000);

    }
    //showWindow()

    function hideWindow(){
    $('#autopopup-sec').hide();
    // on scroll
    $('html body').css('overflow','auto');
    }
    //hideWindow()

    // auto open after 2s
    setTimeout(showWindow,2000);
    // close after click 
    $("#close-btn").click(function(){

    hideWindow();
    celarTimeout(stopAutohide);

    })


    })
</script>
{{-- autopopup js end --}}



{{-- <script>

    $('.logos-slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: false,
            responsive: [{
            breakpoint: 768,
            settings: {
            slidesToShow: 3
        }
        }, {
            breakpoint: 520,
            settings: {
            slidesToShow: 2
            }
        }]
    });
</script> --}}



{{-- Alignment to standard js --}}
<script>
  $(document).ready(function(){
    $('.logos-slider').slick({
    slidesToShow: 7,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 1500,
    arrows: false,
    dots: false,
    pauseOnHover: false,
    prevArrow: '<i class="slick-prev fas fa-angle-left"></i>',
    nextArrow: '<i class="slick-next fas fa-angle-right"></i>',
    responsive: [{
      breakpoint: 768,
      settings: {
        slidesToShow: 3
      }
    }, {
      breakpoint: 520,
      settings: {
        slidesToShow: 2
      }
    }]
    });
  });
</script>

{{-- Alignment to standard js end --}}


</html>