@extends('layouts.master_march')

@section('title')
    ESG Prakrit
@endsection

<style>
/* faq css */

.faq {
    padding: 50px 0 60px;
  background:#fff;
  padding-top: 150px;
}
.faq .faq-title h2 {
  margin-bottom: 18px;
  font-weight: 600;
  font-size: 26px;
  color: #5dc269;
  text-transform: capitalize;
  display: none;
}
.faq .accordion .card {
  border: none;
  /* margin-bottom: 30px; */
  margin-bottom: 17px;
}
.faq .btn-link {
  display: block;
  width: 100%;
  text-align: left;
  position: relative;
  /* background: #242c42; */
  background: linear-gradient(90deg, #067e4f 23%, #9cc959 100%);
  /* background: linear-gradient(90deg, #005936 23%, #9cc959 100%); */
  /* background: linear-gradient(90deg, #005936 -75%, #9cc959 100%); */
  color: #fff;
  border-radius: 0;
  padding: 7px 15px 12px;
  font-size: 16px;
  overflow: hidden;
  border: none;
  font-weight:600;
  font-weight: 400;
}
.faq .btn-link:hover, .faq .btn-link:focus {
  text-decoration: none;
  color: #fff;
}
.faq .btn-link:after {
  position: absolute;
  content: '-';
  /* right: 15px;
  top: 50%; */
  right: 28px;
  top: 42%;
  -webkit-transform: translateY(-50%);
  transform: translateY(-50%);
  font-family: fontawesome;
  font-weight: 700;
  font-size: 25px;
}
.faq .btn-link.collapsed:after {
  content: '\2b';
  top: 50%;
  font-size: 15px;
}
.faq .btn-link:before {
  position: absolute;
  content: '';
  /* background: #28a745; */
  background: #9cc959;
  -webkit-transform: skew(-35deg);
  transform: skew(-35deg);
  height: 100%;
  width: 50%;
  left: 90%;
  top: 0;
}
.faq .card-header {
  padding: 0;
  background: transparent;
  border-bottom: none;
}
.faq .card-body {
  position: relative;
  /* background-color: #f3f3f3; */

  background-image: url(/assets/images/login.jpg);
  background-size: cover;
  background-repeat: no-repeat;
  /* background-position: center center; */
  background-blend-mode: overlay;
  background-position: 100% 25%;
}
.faq .card-body p{
    text-align: justify;
    margin-bottom: 10px;
    font-size: 14px;
    line-height: 1.8;
    color: #000000;
    font-weight: 400;
}
.faq .card-body p strong{
  font-weight: 700;
}
.faq .card-body:after {
  position: absolute;
  content: '';
  height: 2px;
  width: 100%;
  left: 0;
  bottom: 0;
  /* background: #242c42; */
  background: linear-gradient(90deg, #005936 23%, #9cc959 100%);
}
.faq .card-body:before {
  position: absolute;
  content: '';
  height: 2px;
  width: 50%;
  left: 0;
  bottom: 0;
  /* background: #86bc42; */
  z-index: 1;
}
/* faq css end */
    </style>
@section('content')

    <!--====== PAGE BANNER PART start ======-->
    {{-- <section class="bg_cover contact-us-bg_cover faq-bg_cover" style="background-image: url(./assets/images/faq-img.jpg);background-repeat: no-repeat;background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    
                </div>
            </div>
        </div> 
    </section> --}}

    <!--====== PAGE BANNER PART ENDS ======-->




    <!--====== FAQ PART START ======-->

    <div class="faq">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="faq-title text-center pb-3">
                        {{-- <h2>FAQs for Financed Emission Calculation Dashboard</h2> --}}
                        <h2>FAQs</h2>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="faq-image pb-3">
                        <img src="assets/images/faq-bg-img.jpg" alt="">

                        {{-- <video width="100%" autoplay muted>
                            <source src="assets/images/video/Grey and White Clean Course FAQ Mobile Video.mp4" type="video/mp4">
                            <source src="mov_bbb.ogg" type="video/ogg">
                          </video> --}}
                    </div>
                </div>


                <div class="col-lg-8">
                    <div class="accordion" id="accordion">
                        <div class="card"><!-- faq questions 1 -->
                            <div class="card-header" id="heading1">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">What does
                                        the dashboard capture? </button>
                                </h5>
                            </div>

                            <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordion">
                                <div class="card-body">
                                    <p><strong>Financed Emission Calculation Dashboard</strong> is a tool designed to help
                                        organizations and financial institutions track, analyse, and manage the greenhouse
                                        gas emissions associated with their financial activities. This includes emissions
                                        linked to investments, loans, and other financial products.</p>
                                    <p>A Bank or an FI needs to calculate the financed emissions of its portfolio, meaning
                                        the emissions funded through bank’s financing. Financed emission calculations
                                        measures the climate impact of a bank's portfolio through the measurement of GHG
                                        emissions and is often part of broader environmental, social, and governance (ESG)
                                        reporting and risk management. </p>

                                    <p> An <strong>ESG Dashboard</strong> is a tool that allows organizations to monitor,
                                        measure, and report on their Environmental, Social, and Governance (ESG)
                                        performance. It aggregates data related to sustainability practices, social
                                        responsibility, and governance structures, providing insights and analytics to help
                                        manage and improve ESG outcomes.</p>

                                </div>
                            </div>
                        </div><!-- faq questions 1 end -->

                        <div class="card"><!-- faq questions 2 -->
                            <div class="card-header" id="heading2">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">Why is it
                                        important to calculate such data?</button>
                                </h5>
                            </div>
                            <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordion">
                                <div class="card-body">
                                    <p>Calculating <strong> portfolio emissions</strong> is crucial for understanding the
                                        environmental impact of financial portfolios and investments. It helps Banks, FIs,
                                        organizations manage their climate risks, comply with regulations, set
                                        sustainability goals, and enhance transparency for stakeholders.</p>
                                    <p>The tool helps in quantifying emissions, benchmarking, tracking changes, calculating
                                        emission intensities, setting science-based targets and measuring emission
                                        intensities.</p>
                                    <p>The benefits of using an<strong> ESG Dashboard</strong> include, enhanced visibility,
                                        improved reporting, data-driven decisions, stakeholder engagement, improved
                                        transparency and communication with investors, customers, and other stakeholders,
                                        risk management, identifies potential ESG-related risks and opportunities.</p>
                                </div>
                            </div>
                        </div> <!-- faq questions 2 end -->

                        <div class="card"><!-- faq questions 3 -->
                            <div class="card-header" id="heading3">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapse3" aria-expanded="false" aria-controls="collapse3"> What data
                                        will be required to be submitted in the portal? </button>
                                </h5>
                            </div>
                            <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordion">
                                <div class="card-body">
                                    <p> <strong> For portfolio emission calculation</strong>, the Bank’s clients need to
                                        submit the stationary emissions, process emissions and upstream scope 3 emissions.
                                        However, the dashboard is designed in simple, user friendly way to make the journey
                                        easy and quick for the users. </p>
                                    <p>The <strong> ESG Dashboard</strong> would require data to be input on environmental
                                        parameters including, Carbon emissions, energy consumption, waste management, water
                                        usage, and other environmental impacts; social parameters including employee
                                        diversity, community engagement, labor practices, health and safety metrics, and
                                        social impact initiatives and Governance parameters including Board diversity,
                                        executive compensation, ethical practices, compliance, and risk management.</p>
                                </div>
                            </div>
                        </div><!-- faq questions 3 end -->

                        <div class="card"><!-- faq questions 4 -->
                            <div class="card-header" id="heading4">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapse4" aria-expanded="false" aria-controls="collapse4"> How will
                                        the data be collected and used? </button>
                                </h5>
                            </div>
                            <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordion">
                                <div class="card-body">
                                    <p> <strong> Portfolio emission data</strong> will have to be input by a corporate
                                        /Bank’s client for their emission data. The data requested is simple and easily
                                        available with the customers, like total electricity consumption, total expenditure
                                        of transport and so on. This information is then used for reporting, risk
                                        assessment, and strategic decision-making. </p>
                                    <p> <strong> ESG data is collected</strong> from various internal and external sources,
                                        including operational reports, employee surveys, regulatory filings, and third-party
                                        assessments. The dashboard allows for manual data entry and can integrate with
                                        existing systems such as HR platforms, financial systems, and environmental
                                        management systems.</p>
                                </div>
                            </div>
                        </div><!-- faq questions 4 end -->

                        <div class="card"><!-- faq questions 5 -->
                            <div class="card-header" id="heading5">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapse5" aria-expanded="false" aria-controls="collapse5"> What
                                        methodologies are used for calculating financed emissions? </button>
                                </h5>
                            </div>
                            <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordion">
                                <div class="card-body">
                                    <p>The <strong> portfolio emission dashboard</strong> utilizes standard methodologies
                                        such as the Partnership for Carbon Accounting Financials (PCAF) and the Greenhouse
                                        Gas (GHG) Protocol's Financial Sector Standard. These methodologies help ensure
                                        consistency and accuracy in calculating emissions across different financial
                                        activities.</p>
                                    <p>The <strong> ESG Dashboard</strong> is designed to align with major ESG reporting
                                        standards and frameworks, such as the Global Reporting Initiative (GRI),
                                        Sustainability Accounting Standards Board (SASB), and Task Force on Climate-related
                                        Financial Disclosures (TCFD). Compliance ensures that the data and reports meet
                                        industry standards and regulatory requirements.</p>
                                </div>
                            </div>
                        </div><!-- faq questions 5 end -->

                        <div class="card"><!-- faq questions 6 -->
                            <div class="card-header" id="heading6">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapse6" aria-expanded="false" aria-controls="collapse6"> How can
                                        I customize the dashboard to fit my organization's needs? </button>
                                </h5>
                            </div>
                            <div id="collapse6" class="collapse" aria-labelledby="heading6" data-parent="#accordion2">
                                <div class="card-body">
                                    <p>Our technical team is available 24*7 to offer customization options, allowing you to
                                        configure settings, add specific data sources, and tailor reports to align you’re
                                        your organizational goals and reporting requirements. </p>
                                </div>
                            </div>
                        </div><!-- faq questions 6 end -->

                        <div class="accordion" id="accordion2">
                            <div class="card"><!-- faq questions 7 -->
                                <div class="card-header" id="heading7">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#collapse7" aria-expanded="false" aria-controls="collapse7"> How
                                            often is the emissions data updated? </button>
                                    </h5>
                                </div>
                                <div id="collapse7" class="collapse" aria-labelledby="heading7"
                                    data-parent="#accordion2">
                                    <div class="card-body">
                                        <p>Emissions data would be updated on a financial year end basis. </p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- faq questions 7 end -->

                        <div class="card"> <!-- faq questions 8 -->
                            <div class="card-header" id="heading8">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapse8" aria-expanded="false" aria-controls="collapse8"> What
                                        kind of reports can be generated from the dashboard? </button>
                                </h5>
                            </div>
                            <div id="collapse8" class="collapse" aria-labelledby="heading8" data-parent="#accordion2">
                                <div class="card-body">
                                    <p>The dashboard can generate a variety of reports, including detailed emissions
                                        breakdowns by investment type, geographical region, and sector. Customizable reports
                                        can also be created for specific stakeholders or regulatory requirements.</p>
                                    <p>ESG reports can be customized to align with a client’s goals and reporting needs.</p>
                                </div>
                            </div>
                        </div><!-- faq questions 8 end -->

                        <div class="card"><!-- faq questions 9 -->
                            <div class="card-header" id="heading9">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapse9" aria-expanded="false" aria-controls="collapse9"> How can
                                        I interpret the emissions data? </button>
                                </h5>
                            </div>
                            <div id="collapse9" class="collapse" aria-labelledby="heading9" data-parent="#accordion2">
                                <div class="card-body">
                                    <p>The dashboard provides visualizations and analytics to help interpret the data. Key
                                        metrics, such as total financed emissions, intensity ratios, and trend analysis, are
                                        displayed in charts and graphs. Detailed explanations and guidance are provided to
                                        help users understand the implications of the data.</p>
                                </div>
                            </div>
                        </div><!-- faq questions 9 end -->

                        <div class="card"><!-- faq questions 10 -->
                            <div class="card-header" id="heading10">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapse10" aria-expanded="false" aria-controls="collapse10"> Is the
                                        dashboard compliant with regulatory standards? </button>
                                </h5>
                            </div>
                            <div id="collapse10" class="collapse" aria-labelledby="heading10" data-parent="#accordion2">
                                <div class="card-body">
                                    <p>The portfolio carbon emission dashboard is designed to comply with major regulatory
                                        standards and frameworks related to emissions reporting and climate risk management.
                                        It helps users meet requirements from regulatory bodies and international
                                        initiatives such as the Task Force on Climate-related Financial Disclosures (TCFD),
                                        Partnership for Carbon Accounting Financials (PCAF).</p>
                                    <p>The ESG Dashboard is designed to align with major ESG reporting standards and
                                        frameworks, such as the Global Reporting Initiative (GRI), Sustainability Accounting
                                        Standards Board (SASB), and Task Force on Climate-related Financial Disclosures
                                        (TCFD). Compliance ensures that the data and reports meet industry standards and
                                        regulatory requirements.</p>
                                </div>
                            </div>
                        </div><!-- faq questions 10 end -->

                        <div class="card"><!-- faq questions 11 -->
                            <div class="card-header" id="heading11">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapse11" aria-expanded="false" aria-controls="collapse11"> What
                                        support is available if I encounter issues with the dashboard? </button>
                                </h5>
                            </div>
                            <div id="collapse11" class="collapse" aria-labelledby="heading11" data-parent="#accordion2">
                                <div class="card-body">
                                    <p>Support is available through a dedicated helpdesk or support team. Users can access a
                                        knowledge base, troubleshooting guides, and contact support directly for assistance
                                        with technical issues, data discrepancies, or other inquiries.</p>
                                </div>
                            </div>
                        </div><!-- faq questions 11 end -->

                    </div>

                </div>
            </div>


            {{-- <div class="col-lg-6">
              <div class="accordion" id="accordion2">
                <div class="card"><!-- faq questions 7 -->
                  <div class="card-header" id="heading6">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse6" aria-expanded="false" aria-controls="collapse6"> How often is the emissions data updated? </button>
                    </h5>
                  </div>
                  <div id="collapse6" class="collapse" aria-labelledby="heading6" data-parent="#accordion2">
                    <div class="card-body">
                        <p>Emissions data would be updated on a financial year end basis. </p>
                    </div>
                  </div>
                </div><!-- faq questions 7 end -->

                <div class="card"> <!-- faq questions 8 -->
                  <div class="card-header" id="heading7">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse7" aria-expanded="false" aria-controls="collapse5"> What kind of reports can be generated from the dashboard? </button>
                    </h5>
                  </div>
                  <div id="collapse7" class="collapse" aria-labelledby="heading7" data-parent="#accordion2">
                    <div class="card-body"> 
                        <p>The dashboard can generate a variety of reports, including detailed emissions breakdowns by investment type, geographical region, and sector. Customizable reports can also be created for specific stakeholders or regulatory requirements.</p>    
                        <p>ESG reports can be customized to align with a client’s goals and reporting needs.</p>
                    </div>
                  </div>
                </div><!-- faq questions 8 end -->

                <div class="card"><!-- faq questions 9 -->
                  <div class="card-header" id="heading8">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse8" aria-expanded="false" aria-controls="collapse6"> How can I interpret the emissions data? </button>
                    </h5>
                  </div>
                  <div id="collapse8" class="collapse" aria-labelledby="heading8" data-parent="#accordion2">
                    <div class="card-body"> 
                        <p>The dashboard provides visualizations and analytics to help interpret the data. Key metrics, such as total financed emissions, intensity ratios, and trend analyses, are displayed in charts and graphs. Detailed explanations and guidance are provided to help users understand the implications of the data.</p>
                    </div>
                  </div>
                </div><!-- faq questions 9 end -->

                <div class="card"><!-- faq questions 10 -->
                    <div class="card-header" id="heading9">
                      <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse9" aria-expanded="false" aria-controls="collapse9"> Is the dashboard compliant with regulatory standards? </button>
                      </h5>
                    </div>
                    <div id="collapse9" class="collapse" aria-labelledby="heading9" data-parent="#accordion2">
                      <div class="card-body"> 
                        <p>The portfolio carbon emission dashboard is designed to comply with major regulatory standards and frameworks related to emissions reporting and climate risk management. It helps users meet requirements from regulatory bodies and international initiatives such as the Task Force on Climate-related Financial Disclosures (TCFD), Partnership for Carbon Accounting Financials (PCAF).</p>   
                        <p>The ESG Dashboard is designed to align with major ESG reporting standards and frameworks, such as the Global Reporting Initiative (GRI), Sustainability Accounting Standards Board (SASB), and Task Force on Climate-related Financial Disclosures (TCFD). Compliance ensures that the data and reports meet industry standards and regulatory requirements.</p> 
                    </div>
                    </div>
                  </div><!-- faq questions 10 end -->

                  <div class="card"><!-- faq questions 11 -->
                    <div class="card-header" id="heading10">
                      <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse10" aria-expanded="false" aria-controls="collapse10"> What support is available if I encounter issues with the dashboard? </button>
                      </h5>
                    </div>
                    <div id="collapse10" class="collapse" aria-labelledby="heading10" data-parent="#accordion2">
                      <div class="card-body"> 
                        <p>Support is available through a dedicated helpdesk or support team. Users can access a knowledge base, troubleshooting guides, and contact support directly for assistance with technical issues, data discrepancies, or other inquiries.</p>    
                    </div>
                    </div>
                  </div><!-- faq questions 11 end -->

              </div>
            </div> --}}
        </div>
    </div>
    </div>


    <!--====== FAQ PART ENDS ======-->
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script> --}}
@endpush
