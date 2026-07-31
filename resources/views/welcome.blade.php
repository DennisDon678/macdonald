@extends('layouts.homeLayout')

@section('main')
    <style>
        .box-slider-text {
            background: rgba(0, 0, 0, 0.45);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            padding: 40px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            display: inline-block;
        }
        .box-slider-text h2, .box-slider-text h3, .box-slider-text p {
            color: #ffffff !important;
            text-shadow: 0 2px 4px rgba(0,0,0,0.4);
        }
        .slider.btn {
            transition: all 0.3s ease;
        }
        .slider.btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.25);
        }
    </style>
    <div id="box-slide" class="owl-carousel owl-theme page-slider mrt-110">
        <div class="item" style="background-image:url(images/slider/bg4.jpg)">
            <div class="container">
                <div class="box-slider-content">
                    <div class="box-slider-text animated">
                        <h2 class="box-slide-title">Take A Bold Step</h2>
                        <h3 class="box-slide-sub-title">To Change Your World</h3>
                        <p class="box-slide-description">You have dreams. We have a culturally diverse, forward thinking team
                            ready to help you achieve your dreams.

                        </p>
                        <p>
                            <a href="{{ route('register') }}" class="slider btn btn-success">Get Started</a>
                            <a href="{{ route('about') }}" class="slider btn btn-border">Know More</a>
                        </p>
                    </div>
                </div>
            </div>

        </div>
        <!-- Item 1 end -->

        <div class="item" style="background-image:url(images/slider/bg5.jpg)">
            <div class="container">
                <div class="box-slider-content">
                    <div class="box-slider-text animated">
                        <h2 class="box-slide-title">We are the Leaders</h2>
                        <h3 class="box-slide-sub-title">In Global Investments</h3>
                        <p class="box-slide-description">
                            We help our investors make the best out of modern financial markets through our team of expert
                            traders.
                        </p>
                        <p>
                            <a href="{{ route('register') }}" class="slider btn btn-warning">Get Started</a>
                            <a href="#0" class="slider btn btn-border">Know More</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Item 2 end -->


        <!-- Item 3 end -->
    </div>

    <!-- removed crypto widget -->


    <section class="ts-features-col" style='padding-bottom: 2px;'>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="feature-text-box">
                        <h2 class="column-title"><span>{{ env('APP_NAME') }} Limited</span>We are the best in Finance
                        </h2>
                    </div>
                    <p>
                        We are everything a traditional financial institution is not.
                        We set out to give investors better, simpler and more profitable ways to become
                        financially successful and secure.
                    </p>
                    <a href="{{ route('about') }}" class="btn btn-primary">Read More</a>
                </div>
                <!-- Col end-->
                <div class="col-lg-4">
                    <div class="ts-feature text-center box-primary">
                        <div class="ts-feature-info"><i class="icon icon-chart2"></i>
                            <h3 class="ts-feature-title">Trade An Asset</h3>
                            <p>We offer various assets ranging from stocks, to forex, commodities,
                                indexes, ETFs, and the all new Pre-IPOs.</p>
                        </div>
                    </div>
                    <!-- feature 2 end-->
                </div>
                <!-- Col end-->
                <div class="col-lg-4">
                    <div class="ts-feature text-center box-secondary">
                        <div class="ts-feature-info"><i class="icon icon-layers"></i>
                            <h3 class="ts-feature-title">Build A Portfolio</h3>
                            <p>We also offer portfolios which allow you to invest in more than
                                one asset class at a time. Portfolios are a great options if you want more.</p>
                        </div>
                    </div>
                    <!-- feature 3 end-->
                </div>
                <!-- Col end-->
            </div>
            <!-- Row end-->
        </div>
        <!-- Container end-->
    </section>

    <section id="about-us" class="about-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="column-title title-small"><span>About us</span>We have been known to give investors the
                        better choice.</h2>
                    <p>With over 153,000 investments under our management, $5 billion+ in assets under our administration,
                        over 11 industry awards,
                        we have made {{ env('APP_NAME') }} Limited the safe haven for investors who want to trust their
                        financial partner to be capable of
                        helping them reach their financial goals, and in due time, without the fear of disappointments.</p>
                    <div class="gap-15"></div>
                    <div class="row">
                        <div class="col-12">
                            <div class="ts-feature-box">
                                <div class="ts-feature-info icon-left">
                                    <span class="feature-icon">
                                        <i class="icon icon-business"></i>
                                    </span>
                                    <div class="feature-content">
                                        <h3 class="ts-feature-title">49,666+</h3>

                                        <p>Investors</p>
                                    </div>
                                    <!-- feature content end -->
                                </div>
                            </div>
                            <!-- feature box end-->
                            <div class="ts-feature-box">
                                <div class="ts-feature-info icon-left">
                                    <span class="feature-icon">
                                        <i class="icon icon-chart22"></i>
                                    </span>
                                    <div class="feature-content">
                                        <h3 class="ts-feature-title">7.2 M+</h3>

                                        <p>Transactions</p>
                                    </div>
                                    <!-- feature content end -->
                                </div>
                            </div>
                            <!-- feature box end-->
                            <div class="ts-feature-box">
                                <div class="ts-feature-info icon-left">
                                    <span class="feature-icon">
                                        <i class="icon icon-deal"></i>
                                    </span>
                                    <div class="feature-content">
                                        <h3 class="ts-feature-title">32+</h3>

                                        <p>Partners</p>
                                    </div>
                                    <!-- feature content end -->
                                </div>
                            </div>
                            <!-- feature box end-->
                        </div>
                    </div>
                    <!-- container row end-->
                </div>
                <!-- Col end-->
                <div class="col-lg-6 align-self-center">
                    <img class="img-fluid" src="images/pages/about_2.png" alt="">
                </div>

                <div class="col-md-12 align-self-center">
                    <a class="btn btn-primary" href="{{ route('about') }}"> Read More</a>
                </div>
                <!-- Col end-->
            </div>
            <!-- Main row end-->
        </div>
    </section>






    <section class="main-container" id="main-container" style="padding-top: 0px;">

        <div class="ts-price-box solid-bg" style="margin-top: 0px;">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-12">
                        <h2 class="section-title"><span>Investment</span>Plans</h2>
                    </div>
                    <!-- Col End -->
                </div>

                <style>
                    .pricingTable {
                        color: #666;
                        background: #fff;
                        font-family: 'Poppins', sans-serif;
                        text-align: center;
                        padding: 25px;
                        margin: 0 15px;
                        border-radius: 40px;
                        box-shadow: 5px 5px rgba(0, 0, 0, 0.1), 0 2px 20px rgba(0, 0, 0, 0.1) inset;
                        position: relative;
                    }

                    .pricingTable .pricingTable-header {
                        margin: 0 0 20px;
                    }

                    .pricingTable .price-value {
                        margin: 0 0 20px;
                    }

                    .pricingTable .price-value .amount {
                        font-size: 75px;
                        line-height: 70px;
                        font-weight: 400;
                        margin: 0 0 8px;
                        display: block;
                    }

                    .pricingTable .price-value .duration {
                        font-size: 20px;
                        line-height: 20px;
                        text-transform: capitalize;
                        font-weight: 400;
                        display: block;
                    }

                    .pricingTable .title {
                        color: #fff;
                        background-color: #E96134;
                        font-size: 28px;
                        font-weight: 600;
                        text-transform: uppercase;
                        letter-spacing: 2px;
                        padding: 10px;
                        margin: 0;
                        border-radius: 50px;
                        box-shadow: 0 -5px 7px rgba(0, 0, 0, 0.25) inset, 0 0 10px rgba(0, 0, 0, 0.2);
                    }

                    .pricingTable .pricing-content {
                        background-color: #E6E8EA;
                        padding: 20px;
                        margin: 0 0 20px;
                        list-style: none;
                        border-radius: 20px;
                        box-shadow: 0 -5px 7px rgba(0, 0, 0, 0.15) inset, 0 0 10px rgba(0, 0, 0, 0.15);
                    }

                    .pricingTable .pricing-content li {
                        font-size: 16px;
                        font-weight: 500;
                        line-height: 25px;
                        padding: 0;
                        margin: 0 0 13px;
                        position: relative;
                    }

                    .pricingTable .pricing-content li:last-child {
                        margin-bottom: 0;
                    }

                    .pricingTable .pricing-content li i {
                        margin-right: 5px;
                    }

                    .pricingTable .pricingTable-signup a {
                        color: #fff;
                        background-color: #E96134;
                        font-size: 18px;
                        font-weight: 400;
                        text-transform: uppercase;
                        padding: 6px 22px;
                        margin: 0 auto;
                        border: none;
                        border-radius: 20px;
                        display: inline-block;
                        transition: all 0.3s ease 0s;
                    }

                    .pricingTable .pricingTable-signup a:hover {
                        color: #fff;
                        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.2), 0 0 0 6px rgba(0, 0, 0, 0.15);
                    }

                    .pricingTable.blue .title,
                    .pricingTable.blue .pricingTable-signup a {
                        background-color: #2AB9CB;
                    }

                    .pricingTable.green .title,
                    .pricingTable.green .pricingTable-signup a {
                        background-color: #3DA592;
                    }

                    @media only screen and (max-width: 990px) {
                        .pricingTable {
                            margin: 0 15px 40px;
                        }
                    }
                </style>
                <div class="demo">
                    <div class="container">
                        <div class="row">
                            @php
                                $plans = \App\Models\Plan::all();
                            @endphp
                            @foreach ($plans as $plan)
                                <div class="col-md-4 col-sm-6">
                                    <div
                                        class="pricingTable {{ $loop->iteration == 1 ? '' : ($loop->iteration == 2 ? 'blue' : 'green') }}">

                                        <div class="pricingTable-header">
                                            <div class="price-value">
                                                <span class="amount">{{ $plan->interest_rate }}%</span>
                                                <span class="duration">Daily for {{ $plan->duration }} Days</span>
                                            </div>
                                            <h3 class="title">{{ explode(' ', $plan->name)[0] }}</h3>
                                        </div>
                                        <ul class="pricing-content">
                                            <li>MIN: ${{ number_format($plan->min_investment, 2) }}</li>
                                            <li>MAX: ${{ number_format($plan->max_investment, 2) }}</li>

                                            <li>Instant Withdrawal</li>
                                            <li>10% Referral Bonus </li>
                                        </ul>
                                        <div class="pricingTable-signup">
                                            <a href="#">Sign Up</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{-- <div class="col-md-4 col-sm-6">
                                <div class="pricingTable blue">
                                    <div class="pricingTable-header">
                                        <div class="price-value">
                                            <span class="amount">15%</span>
                                            <span class="duration">Weekly for 1 Month</span>
                                        </div>
                                        <h3 class="title">Advanced</h3>
                                    </div>
                                    <ul class="pricing-content">
                                        <li>MIN: $10,000</li>
                                        <li>MAX: $39,999</li>
                                        <li>Instant Withdrawal</li>
                                        <li>10% Referral Bonus </li>
                                    </ul>
                                    <div class="pricingTable-signup">
                                        <a href="#">Sign Up</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="pricingTable green">
                                    <div class="pricingTable-header">
                                        <div class="price-value">
                                            <span class="amount">18%</span>
                                            <span class="duration">Weekly for 1 Month</span>
                                        </div>
                                        <h3 class="title">Premium</h3>
                                    </div>
                                    <ul class="pricing-content">
                                        <li>MIN: $40,000</li>
                                        <li>MAX: Unlimited</li>

                                        <li>Instant Withdrawal</li>
                                        <li>10% Referral Bonus </li>
                                    </ul>
                                    <div class="pricingTable-signup">
                                        <a href="#">Sign Up</a>
                                    </div>
                                </div>
                            </div> --}}

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Section Features -->



    <section class="ts-features no-padding">
        <div class="container-fluid">
            <div class='row'>
                <div class="col-md-12">
                    <h2 class="column-title title-small text-center">3 Simple Steps</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 feature-box1">
                    <div class="ts-feature text-center">
                        <div class="ts-feature-info"><i class="icon icon-users"></i>
                            <h3 class="ts-feature-title">Create An Account</h3>
                            <p><a href='{{ route('register') }}' class="text-warning">Sign up</a> for an account with us
                                to get started, it is easy and simple.</p>
                        </div>
                    </div>
                    <!-- feature 1 end-->
                </div>
                <!-- Col end-->
                <div class="col-lg-4 feature-box2">
                    <div class="ts-feature text-center">
                        <div class="ts-feature-info"><i class="icon icon-upload"></i>
                            <h3 class="ts-feature-title">Make Deposit</h3>
                            <p>Deposit into any of our investment plans of your choice.</p>
                        </div>
                    </div>
                    <!-- feature 2 end-->
                </div>
                <!-- Col end-->
                <div class="col-lg-4 feature-box3">
                    <div class="ts-feature text-center">
                        <div class="ts-feature-info"><i class="icon icon-wallet"></i>
                            <h3 class="ts-feature-title">Make Withdrawal</h3>
                            <p>You can withdraw as soon as your investment duration is completed.</p>
                        </div>
                    </div>
                    <!-- feature 3 end-->
                </div>
                <!-- Col end-->
            </div>
            <!-- Row end-->
        </div>
        <!-- Container end-->
    </section>



    <!-- Section Features -->
    <section class="ts-featured-cases">
        <div class="container">
            <div class="section-title-vertical">
                <h2 class="section-title">Featured Services</h2>
            </div>
            <!-- Title row end-->
            <div class="row">
                <div class="owl-carousel owl-theme featured-cases-slide" id="featured-cases-slide">
                    <div class="item">
                        <div class="featured-projects-content">
                            <div class="featured-projects-text float-left">
                                <h2 class="column-title"><span>{{ env('APP_NAME') }} Limited</span> The Non-farm
                                    Payrolls(NFP)</h2>
                                <p class="intro-desc">The Non-farm payrolls report is one of the most anticipated economic
                                    news reports in the
                                    forex markets. It is published the first Friday of the month at 8:30AM Eastern time by
                                    the U.S. Bureau of labor statistics.

                                    The data release actually includes a number of statistics, and not just the NFP(which is
                                    the change in the number of employees
                                    in the country, not including farm, government, private and non- profit employees.).
                                    Another metric included in the data
                                    release is the unemployment rate.

                                    As one of the most anticipated economic news events of the months, Integrated Binary
                                    Options Services focus mainly on currency pairs(especially those
                                    involving the U.S. Dollar) and typically see big price movements in the minutes and
                                    hours after the data is released.
                                    This makes it a great opportunity for our traders with a sound strategy to take
                                    advantage of the volatility.</p>
                            </div>
                            <div class="features-slider-img float-right">
                                <img class="img-fluid" src="images/slider-small/featured-slider1.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <!-- Item 1 end-->
                    <div class="item">
                        <div class="featured-projects-content">
                            <div class="featured-projects-text pull-left">
                                <h2 class="column-title"><span>{{ env('APP_NAME') }} Limited</span>Get A Loan</h2>
                                <p class="intro-desc">Getting a loan doesn’t have to be intimidating, with the right lender
                                    it can be
                                    a simple process. You only need a lender committed to taking the mystery out of the
                                    mortgage loan
                                    process! At {{ env('APP_NAME') }} Limited, DGS we understand! Our investors want simple
                                    facts, honest answers
                                    and competitive products.

                                    DGS automatically offers loan services to investors with over $50,000 investment either
                                    in our normal {{ env('APP_NAME') }} Limited financial

                                    Services packages or the NFP plans. Investors over $50,000 are entitled to loans of
                                    $200,000-1millon dollars yearly with 5%
                                    paid monthly, or the investor could wish to compound the interest till the time limit,
                                    provided all required information and
                                    identity of the investor are duly confirmed by the {{ env('APP_NAME') }} Limited loan
                                    board.

                                    Every investor above $50,000 is provided with a personal account manager and the
                                    investor has a direct communication with
                                    the manager in order to see that our loan offers are secured.

                                    GREAT INVESTING WITH THE {{ env('APP_NAME') }} Limited FAMILY</p>
                            </div>
                            <div class="features-slider-img pull-right">
                                <img src="images/slider-small/featured-slider2.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <!-- Item 3 end-->
                </div>
                <!-- Featured Projects slider end-->
            </div>
            <!-- Content row end-->
        </div>
        <!-- Container end-->
    </section>
    <section class="bg-overlay ts-chart">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h2 class="column-title title-white"><span>Welcome to {{ env('APP_NAME') }} Limited</span> You can
                        trust us to help make your financial dream come true</h2>
                    <p class="intro-desc">We are your trustworthy financial partner. We're trusted by over 49,666
                        successful investors from
                        across the world.
                        We want you to be on that list.</p>
                </div>

                <div class="col-md-4">
                    <img class="img-center img-fluid" src="images/hs/md.jpeg" alt="">
                </div>

                <div class="col-md-4">
                    <img class="img-center img-fluid" src="images/hs/md2.jpeg" alt="">
                </div>


            </div>
            <!-- col end-->
            <!-- Col end-->
            <!-- Content row end-->
        </div>
        <!-- Container end-->
    </section>

    <section id="call-to-action" class="call-to-action solid-bg" style="padding-bottom: 0px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 align-self-center">
                    <h3 class="call-to-action-title">We Offer Financial Strategies &amp; Superior Services</h3>
                    <p>
                        Our mission is to provide quality guidance, build relationships of
                        <br> trust, and develop innovative solutions
                    </p>
                </div>
                <div class="col-lg-4 text-right">
                    <a class="btn btn-primary" href="{{ route('register') }}">Open Account</a>
                </div>
            </div>
        </div>
    </section>


    <section class="ts-team">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-12">
                    <h2 class="section-title"><span>Our People</span>Best Team</h2>
                </div>
            </div>
            <!-- Title row end-->
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="ts-team-wrapper">
                        <div class="team-img-wrapper">
                            <img class="img-fluid" alt="" src="images/team/team1.jpg">
                        </div>
                        <div class="ts-team-content">
                            <h3 class="team-name">Jimmy Wong.</h3>
                            <p class="team-designation">CEO</p>
                        </div>
                        <!-- Team content end--
                             <div class="team-social-icons"><a target="_blank" href="#"><i class="fa fa-facebook"></i></a><a target="_blank" href="#"><i class="fa fa-twitter"></i></a>
                                <a target="_blank" href="#"><i class="fa fa-google-plus"></i></a><a target="_blank" href="#"><i class="fa fa-linkedin"></i></a></div>
                              social-icons-->
                    </div>
                    <!-- Team wrapper 1 end-->
                </div>
                <!-- Col end-->
                <div class="col-lg-4 col-md-12">
                    <div class="ts-team-wrapper">
                        <div class="team-img-wrapper">
                            <img class="img-fluid" alt="" src="images/team/team2.jpg">
                        </div>
                        <div class="ts-team-content">
                            <h3 class="team-name">Jane Eberhardt.</h3>
                            <p class="team-designation">Financial Manager</p>
                        </div>
                        <!-- Team content end--
                             <div class="team-social-icons"><a target="_blank" href="#"><i class="fa fa-facebook"></i></a><a target="_blank" href="#"><i class="fa fa-twitter"></i></a>
                                <a target="_blank" href="#"><i class="fa fa-google-plus"></i></a><a target="_blank" href="#"><i class="fa fa-linkedin"></i></a></div>
                              social-icons-->
                    </div>
                    <!-- Team wrapper 1 end-->
                </div>
                <!-- Col end-->
                <div class="col-lg-4 col-md-12">
                    <div class="ts-team-wrapper">
                        <div class="team-img-wrapper">
                            <img class="img-fluid" alt="" src="images/team/team3.jpg">
                        </div>
                        <div class="ts-team-content">
                            <h3 class="team-name">Gofrey Lee Hamilton</h3>
                            <p class="team-designation">Associate Division Director</p>
                        </div>
                        <!-- Team content end-->

                        <!-- social-icons-->
                    </div>
                    <!-- Team wrapper 1 end-->
                </div>
                <!-- Col end-->
                <!-- Col end-->
            </div>
            <!-- Content row end-->
        </div>
        <!-- Container end-->
    </section>
    <!-- Section Team end-->
@endsection
