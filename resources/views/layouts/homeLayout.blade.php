<!DOCTYPE html>
<!-- Smartsupp Live Chat script -->
<script type="text/javascript">
    var _smartsupp = _smartsupp || {};
    _smartsupp.key = '{{App\Models\Setting::get("smartsup_api_key")}}';
    window.smartsupp || (function(d) {
        var s, c, o = smartsupp = function() {
            o._.push(arguments)
        };
        o._ = [];
        s = d.getElementsByTagName('script')[0];
        c = d.createElement('script');
        c.type = 'text/javascript';
        c.charset = 'utf-8';
        c.async = true;
        c.src = 'https://www.smartsuppchat.com/loader.js?';
        s.parentNode.insertBefore(c, s);
    })(document);
</script>
<html lang="en">


<head>
    <meta charset="utf-8">
    <title>{{ env('APP_NAME') }} - your go to for investment management</title>


    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="initial-scale=1, width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <!--
    CSS
    ==================================================
    -->
    <!-- Bootstrap-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Animation-->
    <link rel="stylesheet" href="css/animate.css">
    <!-- Template styles-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/morris.css">
    <!-- Responsive styles-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- FontAwesome-->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Icon font-->
    <link rel="stylesheet" href="css/icon-font.css">
    <!-- Owl Carousel-->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- Colorbox-->
    <link rel="stylesheet" href="css/colorbox.css">

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='icon?family=Material+Icons'>

    <style>
        .lead {
            font-size: 1rem;
            font-weight: 300;
        }

        span {}

        .btn-custom {
            color: #bdc3c7;
            font-size: 18px;
            border: 1px solid #bdc3c7;
        }

        .btn-custom:hover {
            color: #ffffff;
            border: 1px solid #ffffff;
        }

        .rounded-lg {
            border-radius: 1rem !important;
        }

        .text-small {
            font-size: 0.9rem !important;
        }

        .custom-separator {
            width: 5rem;
            height: 6px;
            border-radius: 1rem;
        }




        .cah2 {
            color: #0998ec;
            font-size: 20px;
            font-weight: 800;
            text-align: center;
            text-transform: uppercase;
            position: relative;
        }

        .cah2::after {
            content: "";
            width: 100px;
            position: absolute;
            margin: 0 auto;
            height: 4px;
            border-radius: 1px;
            background: #0998ec;
            left: 0;
            right: 0;
            bottom: -20px;
        }

        .carousel_test {
            margin: 50px auto;
            padding: 0 10px;
        }

        .carousel_test .item {
            color: #ffffff;
            overflow: hidden;
            min-height: 120px;
            font-size: 13px;
        }

        .carousel_test .media img {
            width: 40px;
            height: 40px;
            display: block;
            border-radius: 50%;
        }

        .carousel_test .testimonial {
            padding: 0 10px 0 10px;
            position: relative;
        }

        .carousel_test .overview b {
            text-transform: uppercase;
            color: #0998ec;
        }

        @media screen and (max-width: 992px) {
            .me_table::-webkit-scrollbar {
                display: none !important;
                overflow-x: scroll;
            }

            .rem-home {
                padding: 9rem 0 5rem 0;
            }

            @media screen and (max-width: 992px) {
                .rem-home {
                    padding: 6rem 0 5rem 0;
                }
            }

            /* Hide scrollbar for IE and Edge */
            .me-table {
                -ms-overflow-style: none !important;
                overflow-x: scroll;
            }
        }

        .me_icon {
            margin-top: 10px;
            color: #fff;
        }

        .token_rtinfo {
            color: #fff;
            border-radius: 10px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2);
            margin-top: -80px;
            padding: 40px 15px;
            background-color: rgba(255, 255, 255, 0.10);
            box-shadow: none !important;
        }

        .token_rt_value {
            padding: 0 25px;
        }

        .me_big {
            font-size: !important;
            line-height: normal !important;
        }

        .tradingview-widget-copyright {
            display: none !important;
        }

        .badge {
            border-radius: 50px;
            padding: 0.2rem 1rem;
            color: #fff;
            text-align: center;
        }

        .pricing-rate sup {
            font-size: 24px;
            position: relative;
            left: -20px;
            top: -30px;
        }

        .pricing-rate span {
            font-size: 12px;
            color: #707070;
            text-transform: uppercase;
            right: -600px;
        }

        .pricing-rate {
            font-size: 70px;
            font-weight: 700;
            color: #1a2c79;
            position: relative;
            text-align: center;
        }


        .thatwhat {
            z-index: 99999;
            position: fixed;
            bottom: 0;
            left: 0;
            padding-left: 20px;
            padding-bottom: 20px;
        }

        .thatwhat img {
            height: 60px;
            width: 60px;
        }
    </style>

    <style>
        * {
            box-sizing: border-box;
        }

        #google_translate_element {
            z-index: 9999999;
            position: fixed;
            bottom: 25px;
            left: 15px;
        }

        .goog-te-gadget {
            font-family: Roboto, "Open Sans", sans-serif !important;
            text-transform: uppercase;
        }

        .goog-te-gadget-simple {
            background-color: rgba(0, 0, 0, 0.5) !important;
            border: 1px solid rgba(255, 255, 255, 0.5) !important;
            padding: 3px !important;
            border-radius: 4px !important;
            font-size: 0.8rem !important;
            line-height: 2rem !important;
            display: inline-block;
            cursor: pointer;
            zoom: 1;
            margin-bottom: 4px;
        }

        .goog-te-menu2 {
            max-width: 100%;
        }

        .goog-te-menu-value {
            color: #fff !important;
        }

        .goog-te-menu-value:before {
            font-family: 'Material Icons';
            content: "\E927";
            margin-right: 16px;
            font-size: 2rem;
            vertical-align: -10px;
        }

        .goog-te-menu-value span:nth-child(5) {
            display: none;
        }

        .goog-te-menu-value span:nth-child(3) {
            border: none !important;
            font-family: 'Material Icons';
        }

        .goog-te-menu-value span:nth-child(3):after {
            font-family: 'Material Icons';
            content: "\E5C5";
            font-size: 1.5rem;
            vertical-align: -6px;
        }

        .goog-te-gadget-icon {
            background-position: 0px 0px;
            height: 32px !important;
            width: 32px !important;
            margin-right: 8px !important;
            display: none;
        }

        .goog-te-banner-frame.skiptranslate {
            display: none !important;
        }


        body {
            top: 0px !important;
        }

        /* ================================== *\
    Mediaqueries
\* ================================== */
        @media (max-width: 667px) {
            #google_translate_element {}

            #google_translate_element goog-te-gadget {}

            #google_translate_element .skiptranslate {}

            #google_translate_element .goog-te-gadget-simple {
                text-align: center;
            }
        }
    </style>

    <style>
        .xp {
            top: 60%;
            width: 100%;
            vertical-align: middle;
            position: absolute;
        }

        .xloader {
            position: absolute;
            top: 50%;
            left: 50%;
            bottom: 0;
            margin-top: -35px;
            margin-left: -35px;
            border: 5px solid #2154cf;
            border-radius: 50%;
            border-top: 5px solid #fec107;
            width: 70px;
            height: 70px;
            -webkit-animation: spin 2s linear infinite;
            /* Safari */
            animation: spin 2s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <script type="text/javascript">
        function hide_loader() {
            document.getElementById("loader").style.display = "none";
        }

        window.onload = hide_loader;
    </script>
</head>

<body>

    <div class="body-inner">
        <div id="loader">

        </div>

        <div class="site-top">
            <header class="header nav-down header-solid" id="header-2">
                <div class="container">
                    <div class="row">
                        <div class="logo-area clearfix logo-wrapper logo-absolute">
                            <div class="logo col-lg-3 col-md-12" style="text-align: left;">
                                <a href="/" style="z-index: 999999999;">
                                    <img src="img/logo.png" alt="" style="width: 120px;  margin-top: -10px;">
                                </a>
                            </div>
                            <!-- logo end-->
                            <div class="col-lg-9 col-md-12 pull-right">
                                <ul class="top-info top-info-wrraper">

                                    <li><span class="info-icon"><i class="icon icon-envelope"></i></span>
                                        <div class="info-wrapper">
                                            <p class="info-title">{{App\Models\Setting::get('contact_email')}}</p>
                                            <p class="info-subtitle">Send us mail</p>
                                        </div>
                                    </li>
                                    <li class="header-get-a-quote">
                                        <a class="btn btn-primary" href="/auth/login">Login</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Col End-->
                        </div>
                        <!-- Logo Area End-->
                    </div>
                </div>
                <!-- Container end-->
                <div class="site-nav-inner site-navigation navdown nav-transparent">
                    <div class="container">
                        <nav class="navbar navbar-expand-lg justify-content-end">
                            <a class="btn btn-primary d-md-none"
                                style='padding: 6px 10px; border-radius: 5px; margin-right: 3px;'
                                href="/auth/login"><i class='fa fa-sign-in'></i> Login</a>
                            <a class="btn btn-success d-md-none" style='padding: 6px 10px; border-radius: 5px;'
                                href="index-2.htm?a=signup"><i class='fa fa-user-plus'></i></a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"><i class="icon icon-menu"></i></span>
                            </button>
                            <!-- End of Navbar toggler-->
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a href="/">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/about">About Us</a>
                                    </li>

                                    {{-- <li class="nav-item dropdown"><a class="nav-link" href="#"
                                            data-toggle="dropdown">Investments<i class="fa fa-angle-down"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="index-4.htm?a=plans1">Bitcoin</a></li>


                                            <li><a href="index-5.htm?a=oil">Oil And Gas</a></li>
                                            <li><a href="index-6.htm?a=loan">Loan</a></li>
                                            <li><a href="index-7.htm?a=nfp">NFP</a></li>
                                        </ul>
                                    </li> --}}

                                    <li class="nav-item">
                                        <a href="/faq">FAQs</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="/support">Support</a>
                                    </li>

                                    <!-- li end-->
                                    <li class="nav-item">
                                        <a href="/privacy">Policy</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="cert.pdf">Legal</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="/buy-btc">Buy Digital Currency</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="/auth/signup">Sign Up</a>
                                    </li>
                                </ul>
                                <!--Nav ul end-->
                            </div>
                        </nav>
                    </div>
                </div>
                <!-- Site nav inner end-->
            </header>
            <!-- Header end-->
        </div>

        <div>
            @yield('main')
        </div>

        <footer class="footer" id="footer">
            <div class="footer-top">
                <div class="container">

                    <!-- Content row end-->
                </div>
                <!-- Container end-->
            </div>
            <!-- Footer top end-->
            <div class="footer-main bg-overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-md-12 footer-widget footer-about">
                            <div class="footer-logo">
                                <img src="img/logo.png" alt="" style="width: 120px;">
                            </div>
                            <p>We are everything a traditional financial institution is not.
                                We set out to give investors better, simpler and more profitable ways to become
                                financially successful and secure.</p>
                            <div class="footer-social">

                            </div>
                            <!-- Footer social end-->
                        </div>
                        <!-- About us end-->
                        <div class="col-lg-5 col-md-12 footer-widget">
                            <h3 class="widget-title">Useful Links</h3>
                            <ul class="list-dash">
                                <li><a href="index.htm">Home</a></li>
                                <li><a href="index-3.htm?a=about">About Us</a></li>
                                <li><a href="index-2.htm?a=signup">Sign Up</a></li>
                                <li><a href="index-1.htm?a=login">Login</a></li>

                                <li><a href="index-9.htm?a=support">Get Support</a></li>
                                <li><a href="cert.pdf">Legal</a></li>
                                <li><a href="index-10.htm?a=privacy">Privacy</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <!-- About us end-->

                        <div class="col-lg-12 footer-widget">
                            <h3 class="widget-title">RISK DISCLAIMER</h3>
                            <div class="newsletter-introtext">

                                Nothing contained in this website should be construed as a solicitation or offer, or
                                recommendation, to
                                acquire or dispose of any investment or to engage in any other transaction. The
                                information
                                provided herein
                                is not intended for distribution to, or use by, any person or entity in any jurisdiction
                                or
                                country where
                                such distribution or use would be contrary to law or regulation. Some services may not
                                be
                                available to
                                certain investors due to regulatory or other constraints either in UK, the United States
                                or
                                elsewhere.
                                It is advised that most services are only available following completion of the Customer
                                Agreement and/or any
                                other relevant documentation as required. Investments in securities or financial
                                instruments
                                (including digital
                                currencies, futures, options, contracts for differences, spot and forward foreign
                                exchange
                                contracts) can fluctuate
                                in value. Accordingly, you should be aware that you might not realise the initial amount
                                invested and indeed may
                                incur additional liabilities as investments in securities or financial instruments may
                                entail above average risk.
                                You must therefore carefully consider whether your financial circumstances permit you to
                                invest.
                                {{env('APP_NAME')}} Limited strongly suggests that you seek the advice of an independent
                                financial
                                advisor in this regard.
                            </div>

                        </div>
                    </div>


                    <div class="row">
                        <!-- About us end-->

                        <div class="col-lg-12 footer-widget">
                            <img src="images/tfc-icon.png" alt="">
                            <div class="newsletter-introtext"><br>
                                {{env('APP_NAME')}} Limited is a member of The Financial Commission, an international
                                organization
                                engaged in
                                the resolution of disputes within the financial services industry in the Forex market.
                            </div>

                        </div>
                        <div class="col-lg-12 footer-widget">
                            <img src="images/sec-logo.png" alt=""><br>
                            <div class="newsletter-introtext"><br>
                                {{env('APP_NAME')}} Limited is regulated by the US Securities and Exchange Commission. The
                                mission
                                of the SEC is to protect
                                investors; maintain fair,
                                orderly, and efficient markets; and facilitate capital formation.

                                {{env('APP_NAME')}} Limited is an investment company that . Direct access to over 50 financial
                                markets
                                through one account. Any information contained on this website is provided to you for
                                informational
                                purposes only and should not be regarded as an offer or solicitation of an offer to buy
                                or
                                sell any
                                investments or related services that may be referenced here. Investing in certain
                                instruments,
                                including stocks, options, futures, foreign currencies, and bonds involve a high level
                                of
                                risk.
                                Trading on margin comes with substantial risk as well. You must be aware of these risks
                                before
                                opening an account to trade. The income you may get from online investing may go down as
                                well
                                as up.


                                {{env('APP_NAME')}} Limited is a registered investment dealer, a member of the
                                United States Securities and Exchange Commission (SEC), the Investment Industry
                                Regulatory
                                Organization of Canada
                                (IIROC) and a member of the Canadian Investor Protection Fund (CIPF), the benefits of
                                which
                                are limited to the
                                activities undertaken by {{env('APP_NAME')}} Limited.


                            </div>

                        </div>
                    </div>


                    <!-- Content row end-->
                </div>
                <!-- Container end-->
            </div>
            <!-- Footer Main-->
            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="copyright-info"><span>Copyright © 2021 {{env('APP_NAME')}} Limited. All Rights
                                    Reserved.</span></div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="footer-menu">
                                <ul class="nav unstyled">
                                    <li><a href="index-3.htm?a=about">About</a></li>
                                    <li><a href="index-10.htm?a=privacy">Privacy Policy</a></li>
                                    <li><a href="index-11.htm?a=buy-btc">Buy Digital Currency</a></li>
                                    <li><a href="cert.pdf">Legals</a></li>
                                    <li><a href="index-12.htm?a=contact">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Row end-->
                </div>
                <!-- Container end-->
            </div>
            <!-- Copyright end-->
        </footer>
        <!--footer section end-->

        <!--bottom to top button end-->
        <div id="google_translate_element"></div>
        <script type="text/javascript">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({
                    pageLanguage: 'en',

                    autoDisplay: false
                }, 'google_translate_element');
            }
        </script>
        <script type="text/javascript" src="translate_a/element.js?cb=googleTranslateElementInit"></script>
        <script type="text/javascript" src="js/jquery.js"></script>
        <!-- Popper-->
        <script type="text/javascript" src="js/popper.min.js"></script>
        <!-- Bootstrap jQuery-->
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <!-- Owl Carousel-->
        <script type="text/javascript" src="js/owl.carousel.min.js"></script>
        <!-- Counter-->
        <script type="text/javascript" src="js/jquery.counterup.min.js"></script>
        <!-- Waypoints-->
        <script type="text/javascript" src="js/waypoints.min.js"></script>
        <!-- Color box-->
        <script type="text/javascript" src="js/jquery.colorbox.js"></script>
        <!-- Smoothscroll-->
        <script type="text/javascript" src="js/smoothscroll.js"></script>
        <!-- Google Map API Key-->
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCsa2Mi2HqyEcEnM1urFSIGEpvualYjwwM">
        </script>
        <!-- Google Map Plugin-->
        <script type="text/javascript" src="js/gmap3.js"></script>
        <!-- Template custom-->
        <script type="text/javascript" src="js/custom.js"></script>

</body>

</html>
