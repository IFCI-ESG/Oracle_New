
@extends('layouts.master_march')

@section('title')
    ESG PRAKRIT
@endsection


@section('content')
        <!-- header end -->

        <!-- hero slider -->
        <section class="slider hero-slider mb-0">
            <div class="slide">
              <img src="{{asset('assets-v1/img/slider-img/slider-img1.jpg')}}" alt="" class="img-fluid" />
            </div>
            <div class="slide">
              <img src="{{asset('assets-v1/img/slider-img/slider-img2.jpg')}}" alt="" class="img-fluid" />
            </div>
            <div class="slide">
              <img src="{{asset('assets-v1/img/slider-img/slider-img3.jpg')}}" alt="" class="img-fluid" />
            </div>
            <div class="slide">
              <img src="{{asset('assets-v1/img/slider-img/slider-img4.jpg')}}" alt="" class="img-fluid" />
            </div>
        </section>
        <!-- hero slider end -->





        <!-- hero-sec-info -->
        <section class="hero-sec-info">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="hero-content">
                            <div class="hero-content-info">
                                <div class="logo-sec">
                                    <img src="assets-v1/img/logo/ESG-Prakrit.png" alt="">
                                </div>
                                <div class="info-sec">
                                    <h4>Through our Sustainability & ESG Solutions, IFCI endeavours to contribute significantly towards the Net Zero  Goals of the economy.</h4>
                                    <a href="{{ route('explore') }}" class="discover-btn">About Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="grid">
                            <ul id="hexGrid">
                                <li class="hex aos-init aos-animate" data-aos="fade-down" data-aos-delay="100">
                                    <div class="hexIn">
                                        <a class="hexLink" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal">
                                            <div class="img" style="background-image:url(assets-v1/img/services/Financed-Emissions2.jpg);">
                                            </div>
                                            <h1 id="demo1">Financed Emissions</h1>
                                        </a>
                                    </div>
                                </li>

                                <li class="hex aos-init aos-animate" data-aos="fade-down" data-aos-delay="300">
                                    <div class="hexIn">
                                        <a class="hexLink" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal-a">
                                            <div class="img" style="background-image:url(assets-v1/img/services/Carbon-Footprint2.jpg);">
                                            </div>
                                            <h1 id="demo1">Carbon Footprint </h1>
                                        </a>
                                    </div>
                                </li>

                                <li class="hex aos-init aos-animate" data-aos="fade-down" data-aos-delay="500">
                                    <div class="hexIn">
                                        <a class="hexLink" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal-b">
                                            <div class="img" style="background-image:url(assets-v1/img/services/ESG-Risk1.jpg);">
                                            </div>
                                            <h1 id="demo1">ESG Risk</h1>
                                        </a>
                                    </div>
                                </li>

                                <li class="hex aos-init aos-animate" data-aos="fade-down" data-aos-delay="700">
                                    <div class="hexIn">
                                        <a class="hexLink" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal-c">
                                            <div class="img" style="background-image:url(assets-v1/img/services/Climate-Risk.jpg);">
                                            </div>
                                            <h1 id="demo1">Climate Risk</h1>
                                        </a>
                                    </div>
                                </li>

                                <li class="hex aos-init aos-animate" data-aos="fade-down" data-aos-delay="500">
                                    <div class="hexIn">
                                        <a class="hexLink" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal-d">
                                            <div class="img" style="background-image:url(assets-v1/img/services/Environment-Impact.jpg);">
                                            </div>
                                            <h1 id="demo1">Environment Impact </h1>
                                        </a>
                                    </div>
                                </li>

                                <li class="hex aos-init aos-animate" data-aos="fade-down" data-aos-delay="300">
                                    <div class="hexIn">
                                        <a class="hexLink" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal-e">
                                            <div class="img" style="background-image:url(assets-v1/img/services/Social-Impact2.jpg);">
                                            </div>
                                            <h1 id="demo1">Social Impact</h1>
                                        </a>
                                    </div>
                                </li>

                                <li class="hex aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                                    <div class="hexIn">
                                        <a class="hexLink" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal-f">
                                            <div class="img" style="background-image:url(assets-v1/img/services/Governance-Matrix2.jpg);">
                                            </div>
                                            <h1 id="demo1">Governance Matrix</h1>
                                        </a>
                                    </div>
                                </li>

                                <li class="hex aos-init aos-animate" data-aos="fade-up" data-aos-delay="1300">
                                    <div class="hexIn">
                                        <a class="hexLink" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal-g">
                                            <div class="img" style="background-image:url(assets-v1/img/services/Regulatory-Reports2.jpg);">
                                            </div>
                                            <h1 id="demo1">Regulatory Reports</h1>
                                        </a>
                                    </div>
                                </li>

                                <li class="hex aos-init aos-animate" data-aos="fade-up" data-aos-delay="1100">
                                    <div class="hexIn">
                                        <a class="hexLink" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal-h">
                                            <div class="img" style="background-image:url(assets-v1/img/services/Sustainability-Report2.jpg);">
                                            </div>
                                            <h1 id="demo1">Sustainability Report</h1>
                                        </a>
                                    </div>
                                </li>

                                <li class="hex aos-init aos-animate" data-aos="fade-up" data-aos-delay="900">
                                    <div class="hexIn">
                                        <a class="hexLink" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal-i">
                                            <div class="img" style="background-image:url(assets-v1/img/services/ESG-Assurance2.jpg);">
                                            </div>
                                            <h1 id="demo1">ESG Assurance</h1>
                                        </a>
                                    </div>
                                </li>

                                <li class="hex aos-init aos-animate" data-aos="fade-up" data-aos-delay="700">
                                    <div class="hexIn">
                                        <a class="hexLink" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal-j">
                                            <div class="img" style="background-image:url(assets-v1/img/services/UN-SDG-Mapping.jpg);">
                                            </div>
                                            <h1 id="demo1">UN-SDG Mapping</h1>
                                        </a>
                                    </div>
                                </li>

                                <li class="hex aos-init aos-animate" data-aos="fade-up" data-aos-delay="500">
                                    <div class="hexIn">
                                        <a class="hexLink" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal-k">
                                            <div class="img" style="background-image:url(assets-v1/img/services/ESG-Strategy.jpg);">
                                            </div>
                                            <h1 id="demo1">ESG Strategy </h1>
                                        </a>
                                    </div>
                                </li>

                                <li class="hex aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                    <div class="hexIn">
                                        <a class="hexLink" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal-l">
                                            <div class="img" style="background-image:url(assets-v1/img/services/NetZero-Plan.jpg);">
                                            </div>
                                            <h1 id="demo1">Net Zero Plan</h1>
                                        </a>
                                    </div>
                                </li>

                                <li class="hex aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                                    <div class="hexIn">
                                        <a class="hexLink" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal-m">
                                            <div class="img" style="background-image:url(assets-v1/img/services/Carbon-Credits.jpg);">
                                            </div>
                                            <h1 id="demo1">Carbon Credits</h1>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- hero-sec-info end -->





       <!-- ESG PRAKRIT -->
        <section class="esg-prakrit">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="esg-prakrit-info">
                            <h2>ESG PRAKRIT - A Comprehensive Dashboard</h2>
                            <p>ESG PRAKRIT is a dynamic dashboard that supports Banks & Corporates in their Environmental, Social, and Governance (ESG) journey. Our comprehensive suite of services includes tools like the Financed Emissions GHG Calculator, ESG Strategy, ESG Risk, Climate Risk, Environmental Impact, Social Impact, Sustainability Reporting, Governance Matrix, Regulatory Reports, ESG Assurance, United Nations Sustainable Development Goals (UN SDG) Mapping, Net-Zero Plan, Carbon Credits, Carbon Footprint, and Carbon Sequestration. In the future, we will integrate ESG Scoring and Rating Services, enabling banks, corporates, and financial institutions to assess their sustainability performance.</p>
                            
                            <div class="read-more-content">
                                <p style="text-align:justify">         We aim to be a leading provider of ESG intelligence solutions in India, supporting the country's transition to a low-carbon economy and contributing to global climate goals. The tool aligns with the National Guidelines on Responsible Business Conduct (NGRBC’s), complies with the regulations set forth by the Reserve Bank of India (RBI) and the Securities & Exchange Board of India (SEBI). We will empower organizations to integrate responsible and sustainable practices into their operations, supply chain & navigate the complex ESG landscape. </p>
                                <p style="text-align:justify"> The platform's mission is to empower financial & other institutions to drive sustainable decision-making and manage their environmental impact. ESG PRAKRIT, rooted in the philosophy of “Sabka Saath, Sabka Vikas”, promotes socio-economic transformation and growth by integrating business practices. As India announced its commitment to achieve net-zero emissions by 2070 during the 26th session of the United Nations Framework Convention on Climate Change (COP 26) in November 2021. To support these ambitious targets, the ESG PRAKRIT a pioneering "Made in India" tool will contribute significantly to achieve India’s climate goals & enhancing its resilience against climate change impacts. The tool empowers organizations to integrate sustainability into their core operations, foster accountability, transparency & long-term value creation, moreover it quantifies their contribution towards Sustainable Development Goals. </p>
                                <p style="text-align:justify"> The tool is relevant as India is in a bright spot in the world economy. There is a visible shift in the world economic order. Over the past few years, India has witnessed a consistent GDP growth of 6-7% as against world GDP growth of 2-3%. India is now amongst the top 5 economies of the world.</p>
                                <p style="text-align:justify">Climate Risk is a major threat to world economic growth. As per a study by Carbon Brief, a 1.5 – 2.0 Degree Celsius temperature increase will erode 8% - 13% of global GDP by 2100. In view of the above, the financial sector must play a pivotal role in driving the ESG agenda for the economy. The flow of funds towards ESG and Sustainability is critical for India to lead the world economic growth. It is increasingly becoming important to measure and track the greenhouse gas (GHG) emissions of corporates. Accurately measuring and consistently monitoring greenhouse gas (GHG) emissions is essential for evaluating the overall carbon footprint generated by corporations-standalone, investment portfolios held by banks or financial institutions, and the entire banking sector.  </p>
                                <p style="text-align:justify">Additionally, the tool will assess the financed emissions by taking pre-emptive measures, as it is aligned with global benchmarks like Partnership for Carbon Accounting Financials (PCAF), Task Force on Climate-related Financial Disclosures (TCFD), Greenhouse Gas Protocol (GHG Protocol) and in line with the Reserve Bank of India (RBI’s) climate risk policies. The tool can further help develop Small and Medium Enterprises (SME)- specific guidelines as well as create an internal rating assessment model.  </p>

                            </div>

                            <a href="javascript:void(0);" class="read-more" title="Read More">Read More</a>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="esg-prakrit-info">
                            <h2>IFCI LTD.</h2>
                            <p>IFCI Ltd (Erstwhile Industrial Finance Corporation of India) was the first Development Finance Institution of independent India set up in 1948. Over the 75 years, IFCI (a Government of India Undertaking under the Ministry of Finance) has played a pivotal role as a term...</p>
                            <div class="read-more-content">
                                <p style="text-align:justify">
                                    lending institute for India’s economic growth by supporting industries and creating
                                    institutions.
                                </p>

                                <p style="text-align:justify">
                                    In recent years, IFCI has shifted focus to align
                                    itself with the requirements of the economy and has been supporting the Government of India as a Project Management Agency for various schemes, including PLIs, incentive schemes,
                                    social development schemes etc. Apart from Government Advisory, IFCI also provides holistic
                                    financial advisory services i.e., Financial Appraisal/ Due Diligence/ Investment Analysis/    Bid Advisory/ Business Valuation/ Transaction Advisory Services, etc. to various Public
                                    Sector Undertakings and Private Clients.
                                </p>

                                <p class="mt-2 mb-2"><strong>To learn more about IFCI Ltd</strong>  <a href="https://www.ifciltd.com" target="_blank" class="main-btn animation-btn mt-2"> Please Visit</a></p>

                            </div>

                            <a href="javascript:void(0);" class="read-more" title="Read More">Read More</a>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="esg-prakrit-info">
                            <h2>TERI-SAS</h2>
                            <p>TERI School of Advanced Studies is an internationally acclaimed research institute, renowned for its profound contributions to scientific and policy research in energy, environment, and sustainable development. Over the past 26 years, TERI SAS has...</p>
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
                                    specialized, bank focussed, and India specific carbon footprint calculator which is aligned
                                    to
                                    global frameworks and reporting standards.
                                </p>

                                <p class="mt-2 mb-2"><strong>To learn more about TERI-SAS</strong>  <a href="https://www.terisas.ac.in" target="_blank" class="main-btn animation-btn mt-2"> Please Visit</a></p>

                               
                            </div>

                            <a href="javascript:void(0);" class="read-more" title="Read More">Read More</a>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="esg-prakrit-info border-sec">
                            {{-- <h2></h2> --}}
                            <span>Validation by the Indian Institute of Technology Delhi ( <b>IIT Delhi </b>).</span>
                           
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- ESG PRAKRIT end -->



        {{-- autopopup-sec --}}
       
<?php

$word_of_the = [
    "Carbon Management and Accounting System (CMAB)" => "A measure of the total greenhouse gas emissions produced by an individual, group, or  company over a set time period",
    "Climate Finance (Adaptation / Mitigation)" => "Local, national or transnational financing (drawn from public, private and alternative sources of financing) that seeks to support mitigation and adaptation actions or activities that will address climate change.",
    "Climate Funds" => "Climate funds are investment portfolios that seek to buy the equities or bonds of companies that are aligned with the goals of the Paris Agreement. They can also target the sovereign bonds of governments that are cutting greenhouse gas emissions, thereby reducing their contribution to global warming.",
    "Climate Risks" => "Physical risks: Damages to companies and assets because of the physical impact of volatile and extreme weather events, for example, heat waves, droughts, rising sea levels, storms or flooding (including secondary financial impacts of extreme weather, such as lower crop yields, borrowers defaulting on their loans, disruption to supply chains, political instability, insurance claims or losses, legal damages, or conflict).",
    "Adverse Impact" => "Impacts of investment decisions and advice that result in negative effects on ESG / sustainability components.",
    "Benchmarking" => "The practice of comparing environmental, social, and governance metrics with other companies with the same metrics.",
    "Blue Hydrogen" => "Hydrogen generation from fossil fuel coupled with capture and storage of the produced carbon. Although biomass, coal, and other hydrocarbon liquids can be gasified to generate H2 , natural gas can be formed from H2 using Steam-methane reforming (SMR) or autothermal reforming making capture of CO2 simpler than other methane combustion applications and easier to sequester.",
    "Carbon Capture and Storage" => "Carbon capture and storage (CCS) is the process of capturing waste CO2 and placing  it into a geological storage site in such a way that it will not enter the atmosphere and contribute to further global warming. CCS uses several technologies including absorption, chemical looping, and membrane gas separation.",
    "Carbon Footprint" => "A measure of the total greenhouse gas emissions produced by an individual, group, or company over a set time period. ",
    "Carbon Management and Accounting System (CMAB)" => "CMAB is a policy tool designed to address carbon leakage and ensure a level playing field for industries within the European Union (EU) that are subject to stringent carbon emission regulations. The CMAB aims to prevent companies from relocating production to countries with laxer environmental regulations and to encourage global reduction in carbon emissions.",
    "Climate Change" => "Climate change is a long-term change in the average weather patterns that have come to define Earth’s local, regional and global climates.",
    "CSR Report" => "A CSR report is a periodic (usually annual) report published by companies with the goal of sharing their corporate social responsibility actions and results.",
    "Environmental, Social, Governance (ESG)" => "Three central factors in measuring the sustainability and societal impact of an investment in a company or business. These criteria help to better determine the future financial performance of companies.",
    "Global Reporting Initiative (GRI)" => "The Global Reporting Initiative. GRI is the most widely used and most extensive voluntary reporting framework for ESG and sustainability topics. The latest version of its framework, the GRI Standards was published in 2016.",
    "Global Warming" => "Scientists define global warming as the human-produced temperature increase since the early 20th century due to fossil fuel burning, which increase heat-trapping greenhouse gas levels in Earth’s atmosphere, raising the average surface temperature."
];

$keys = array_keys($word_of_the);
$randomKey = $keys[array_rand($keys)];
$finale_word=substr($word_of_the[$randomKey], 0, 100);
?>

        <div id="autopopup-sec">
            <div id="pop-up">
                <button id='close-btn'><i class="fa-solid fa-xmark"></i></button>
                <a href="{{ route('flash-card') }} ">
                    <h2>Word of the Day</h2>
                    <h3>{{$randomKey}}:</h3>
            </a>
                <div class="block-ellipsis ">
                        <p >
                             <a href="{{ route('flash-card') }}" class="para-sec">"{{$finale_word}}"</a> 
                            <a href="{{ route('flash-card') }}"> Read More </a> 
                        </p>
                </div>  
            </div>
        </div>

        {{-- autopopup-sec end --}}



        <!-- Your Carbon Footprint -->
        <section class="carbon-footprint">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Your Carbon Footprint</h2>
                    </div>
                    <div class="col-md-3">
                        <div class="carbon-footprint-card">
                            <div class="carbon-footprint-card-img">
                                <img src="assets-v1/img/card-img/card-img1.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="carbon-footprint-card-info">
                                <h4>Household</h4>
                                <p>Emissions are impacted by the size of an household. More members generally consume more energy. You need to enter the number of family members, in the relevant Field of the calculator to know your footprints.</p>
                                <a href="{{ route('calculator') }}" class="learn-more">Learn more</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="carbon-footprint-card">
                            <div class="carbon-footprint-card-img">
                                <img src="assets-v1/img/card-img/card-img2.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="carbon-footprint-card-info">
                                <h4>Travel</h4>
                                <p>Fuel is a major source of carbon emissions, if you
                                            use carpool or public transport your emissions would be comparatively lower than
                                            a private vehicle. You need to enter mode of transport used and distance
                                            travelled to calculate your footprints.</p>
                                <a href="{{ route('calculator') }}" class="learn-more">Learn more</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="carbon-footprint-card">
                            <div class="carbon-footprint-card-img">
                                <img src="assets-v1/img/card-img/card-img3.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="carbon-footprint-card-info">
                                <h4>Electricity</h4>
                                <p>Energy usage is increasing with rising temperatures,
                                            in turn raising the temperatures further. To know your carbon footprints through
                                            energy usage enter the amount spent monthly on your electricity bills.<p>
                                <a href="{{ route('calculator') }}" class="learn-more">Learn more</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="carbon-footprint-card">
                            <div class="carbon-footprint-card-img">
                                <img src="assets-v1/img/card-img/card-img4.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="carbon-footprint-card-info">
                                <h4>Cooking Fuel</h4>
                                <p>Food is another major source of carbon emissions.
                                            Fuel used for cooking impacts our carbon footprints. Enter the amount spent
                                            monthly on your LPG cylinders or the amount of gas pipeline bill for finding
                                            your carbon footprints.</p>
                                <a href="{{ route('calculator') }}" class="learn-more">Learn more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Your Carbon Footprint end -->






    <!-- OUR Partners section -->
    <section class="our-Partners-sec customer-logos">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mb-5">Standards & Alignments</h2>
                </div>
                <div class="col-md-12">
                    <div class="customer-logo logos-slider slider pb-4">
                        <div class="slide">
                            <img src="{{asset('assets-v1/img/partners-logo/partners-log12.jpg')}}">
                        </div>
                        <div class="slide">
                             <img src="{{asset('assets-v1/img/partners-logo/partners-log1.jpg')}}">
                        </div>
                        <div class="slide">
                              <img src="{{asset('assets-v1/img/partners-logo/partners-log2.jpg')}}">
                        </div>
                        <div class="slide">
                              <img src="{{asset('assets-v1/img/partners-logo/partners-log3.jpg')}}">
                        </div>
                         <div class="slide">
                              <img src="{{asset('assets-v1/img/partners-logo/partners-log4.png')}}">
                        </div>
                         <div class="slide">
                              <img src="{{asset('assets-v1/img/partners-logo/partners-log5.jpg')}}">
                        </div>
                        <div class="slide">
                              <img src="{{asset('assets-v1/img/partners-logo/partners-log7.jpg')}}">
                        </div>
                        <div class="slide">
                              <img src="{{asset('assets-v1/img/partners-logo/partners-log8.jpg')}}">
                        </div>
                           <div class="slide">
                              <img src="{{asset('assets-v1/img/partners-logo/partners-log9.jpg')}}">
                        </div>
                            <div class="slide">
                              <img src="{{asset('assets-v1/img/partners-logo/partners-log10.jpg')}}">
                        </div>
                            <div class="slide">
                              <img src="{{asset('assets-v1/img/partners-logo/partners-log11.jpg')}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- OUR Partners section END -->

        <!-- counter section -->
        <section class="counter-sec">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="mb-5 sec-heading">Prominent Features</h2>
                    </div>

                    <div class="col-md-3">
                        <div class="counter-info bg-color1">
                            <h4>User-Friendly Platform</h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="counter-info bg-color2">
                            <h4>Uniformity in Assessments</h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="counter-info bg-color1">
                            <h4>Holistic ESG Services</h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="counter-info bg-color2">
                            <h4>Aligned to National & Global Standards</h4>
                        </div>
                    </div>
                           <div class="col-md-3">
                        <div class="counter-info bg-color1">
                            <h4>Team of Experienced Experts</h4>
                        </div>
                    </div>
                           <div class="col-md-3">
                        <div class="counter-info bg-color2">
                            <h4>Robust IT Infrastructure</h4>
                        </div>
                    </div>
                           <div class="col-md-3">
                        <div class="counter-info bg-color1">
                            <h4>Continuous Evolution & Upgradation</h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="counter-info bg-color2">
                            <h4>Regular Support to the Clients</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- counter section end -->



   {{-- environmental-social-governance-sec --}}
   <section class="card-sec environmental-social-governance-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="sec-heading2"></h3>
                </div>

                <div class="col-md-4">
                    <div class="pillar pillar-bg-sec1">
                        <div class="triangle-sec1"></div>
                        <div class="header">
                            <div class="icon-sec">
                                <img src="assets-v1/img/icon/Environmental-icon.png" alt="Environmental Icon" class="icon">
                            </div>
                            <h2 class="head1">Environmental</h2>
                        </div>
                        
                        <ul>
                            <li><i class="fa-regular fa-circle-dot"></i>GHG Emissions </li>
                            <li><i class="fa-regular fa-circle-dot"></i>Climate & Energy </li>
                            <li><i class="fa-regular fa-circle-dot"></i>Biodiversity</li>
                            <li><i class="fa-regular fa-circle-dot"></i>Materials & Waste</li>
                            <li><i class="fa-regular fa-circle-dot"></i>Water</li>
                            <li><i class="fa-regular fa-circle-dot"></i>Air Emissions </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="pillar pillar-bg-sec2">
                        <div class="triangle-sec2"></div>
                        <div class="header">
                            <div class="icon-sec">
                                <img src="assets-v1/img/icon/Social-icon.png" alt="Environmental Icon" class="icon">
                            </div>
                            <h2 class="head2">Social</h2>
                        </div>
                        <ul>
                            <li><i class="fa-regular fa-circle-dot"></i>Diversity, Equity & Inclusion</li>
                            <li><i class="fa-regular fa-circle-dot"></i>Communities</li>
                            <li><i class="fa-regular fa-circle-dot"></i>Health & Safety</li>
                            <li><i class="fa-regular fa-circle-dot"></i>Product Marketing & Labeling</li>
                            <li><i class="fa-regular fa-circle-dot"></i>Labor</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="pillar pillar-bg-sec3">
                        <div class="triangle-sec3"></div>
                        <div class="header">
                            <div class="icon-sec">
                                <img src="assets-v1/img/icon/Governance-icon.png" alt="Environmental Icon" class="icon">
                            </div>
                            <h2 class="head3">Governance</h2>
                        </div>
                        <ul>
                            <li><i class="fa-regular fa-circle-dot"></i>Corporate Governance</li>
                            <li><i class="fa-regular fa-circle-dot"></i>Board Diversity</li>
                            <li><i class="fa-regular fa-circle-dot"></i>Ethics & Code of Conduct</li>
                            <li><i class="fa-regular fa-circle-dot"></i>Anti-Corruption Practices</li>
                            <li><i class="fa-regular fa-circle-dot"></i>Risk Management</li>
                            <li><i class="fa-regular fa-circle-dot"></i>Supplier Performance</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- environmental-social-governance-sec end --}}

       


         <!--====== Environmental Social Governance START ======-->
         {{-- <section class="Environmental-Social-Governance">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="info-sec color-1">
                            <div class="heading divider1">
                                <div class="icons">
                                    <img src="assets-v1/img/icon/Environmental-icon.gif" alt="Environmental">
                                </div>
                                <h2>Environmental</h2>
                            </div>
                            <ul>
                                <li><i class="fa-regular fa-circle-dot"></i>Climate & Energy</li>
                                <li><i class="fa-regular fa-circle-dot"></i>GHG Emissions</li>
                                <li><i class="fa-regular fa-circle-dot"></i>Water</li>
                                <li><i class="fa-regular fa-circle-dot"></i>Materials & Waste</li>
                                <li><i class="fa-regular fa-circle-dot"></i>Biodiversity</li>
                                <li><i class="fa-regular fa-circle-dot"></i>Air Emissions</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="info-sec color-2">
                            <div class="heading divider2">
                                <div class="icons">
                                    <img src="assets-v1/img/icon/Social-icon.gif" alt="Social">
                                </div>
                                <h2>Social</h2>
                            </div>
                            <ul>
                                <li><i class="fa-regular fa-circle-dot"></i>Health & Safety</li>
                                <li><i class="fa-regular fa-circle-dot"></i>Diversity, Equity & Inclusion</li>
                                <li><i class="fa-regular fa-circle-dot"></i>Communities</li>
                                <li><i class="fa-regular fa-circle-dot"></i>Labor</li>
                                <li><i class="fa-regular fa-circle-dot"></i>Product Marketing & Labeling</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="info-sec color-3">
                            <div class="heading divider3">
                                <div class="icons">
                                    <img src="assets-v1/img/icon/Governance-icon.gif" alt="Governance">
                                </div>
                                <h2>Governance</h2>
                            </div>
                            <ul>
                                <li><i class="fa-regular fa-circle-dot"></i>Corporate Governance</li>
                                <li><i class="fa-regular fa-circle-dot"></i>Risk Management</li>
                                <li><i class="fa-regular fa-circle-dot"></i>Supplier Performance</li>
                                <li><i class="fa-regular fa-circle-dot"></i>Board Diversity</li>
                                <li><i class="fa-regular fa-circle-dot"></i>Ethics & Code of Conduct</li>
                                <li><i class="fa-regular fa-circle-dot"></i>Anti-Corruption Practices</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
         </section>   --}}
        <!--====== Environmental Social Governance ENDS ======-->




         <!-- testimonials -->
<!--         <section class="testimonials testimonial-sec">
            <div class="container">
                <div class="title">
                    <h2>Testimonial</h2>
                </div>
                <div class="owl-carousel owl-theme testi">
                 
                    <div class="item">
                      <div class="profile">
                          <img src="assets-v1/img/profile-pic/profile-pic.png" alt="testimonials profile-pic">
                          <div class="information">
                              <p>Furkan Giray</p>
                              <span>Web Developer</span>
                          </div>
                        </div>
                          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Expedita velit labore suscipit distinctio, officiis deserunt rem blanditiis ducimus. Voluptate quaerat assumenda qui veniam facilis doloribus maiores impedit ducimus cum accusamus.</p>
                          <div class="stars">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                          </div>
                    </div>
                
                    <div class="item">
                      <div class="profile">
                        <img src="assets-v1/img/profile-pic/profile-pic.png" alt="testimonials profile-pic">
                          <div class="information">
                              <p>Furkan Giray</p>
                              <span>Web Developer</span>
                          </div>
                        </div>
                          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Expedita velit labore suscipit distinctio, officiis deserunt rem blanditiis ducimus. Voluptate quaerat assumenda qui veniam facilis doloribus maiores impedit ducimus cum accusamus.</p>
                          <div class="stars">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                          </div>
                    </div>
                    <div class="item">
                      <div class="profile">
                        <img src="assets-v1/img/profile-pic/profile-pic.png" alt="testimonials profile-pic">
                          <div class="information">
                              <p>Furkan Giray</p>
                              <span>Web Developer</span>
                          </div>
                        </div>
                          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Expedita velit labore suscipit distinctio, officiis deserunt rem blanditiis ducimus. Voluptate quaerat assumenda qui veniam facilis doloribus maiores impedit ducimus cum accusamus.</p>
                          <div class="stars">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                          </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- testimonials end -->





        <!-- OUR Team -->
<!--         <section class="our-team-sec">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="title">
                            <h2>OUR Team</h2>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                        <div class="team-card">
                            <img src="assets-v1/img/profile-pic/profile-pic.png" alt="our-team img">
                            <h4>Name</h4>
                            <p>Name</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                        <div class="team-card">
                            <img src="assets-v1/img/profile-pic/profile-pic.png" alt="our-team img">
                            <h4>Name</h4>
                            <p>Name</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                        <div class="team-card">
                            <img src="assets-v1/img/profile-pic/profile-pic.png" alt="our-team img">
                            <h4>Name</h4>
                            <p>Name</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                        <div class="team-card">
                            <img src="assets-v1/img/profile-pic/profile-pic.png" alt="our-team img">
                            <h4>Name</h4>
                            <p>Name</p>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->

        <!-- OUR Team end -->




@endsection
