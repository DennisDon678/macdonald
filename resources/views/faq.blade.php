@extends('layouts.homeLayout')

@section('main')
<!-- START SECTION BANNER -->
<div class="banner-area" id="banner-area" style="background-image:url(images/banner/banner1.jpg);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="banner-heading">
                    <h1 class="banner-title">FAQs</h1>
                </div>
            </div>
            <!-- Col end-->
        </div>
        <!-- Row end-->
    </div>
    <!-- Container end-->
</div>
<!-- END SECTION TEAM -->
<section class="main-container" id="main-container">

    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="accordion-title">
                    <h3 class="column-title"><span>Our FAQ</span> Frequently Asked Questions</h3>
                </div>
                <div class="gap-40"></div>
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="heading1">
                            <h5 class="mb-0">
                                <button class="btn btn-link " data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                    <p>What is Asset Digital Limited?</p>
                                </button>
                            </h5>
                        </div>
                        <div class="collapse show" id="collapse1" aria-labelledby="heading1" data-parent="#accordion">
                            <div class="card-body">
                                <p>Asset Digital Limited our company provides a full investment service focused on the bitcoin and cryptocurrency market We are among the best platforms to invest and grow your bitcoin and other cryptocurrency</p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="heading2">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                    <p>How do I create my account?</p>
                                </button>
                            </h5>
                        </div>
                        <div class="collapse " id="collapse2" aria-labelledby="heading2" data-parent="#accordion">
                            <div class="card-body">
                                <p>Registration process is very easy and will take a few moments to complete Simply click CREATE ACCOUNT button and fill in all the required fields</p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="heading3">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                    <p>How do I make a deposit?</p>
                                </button>
                            </h5>
                        </div>
                        <div class="collapse " id="collapse3" aria-labelledby="heading3" data-parent="#accordion">
                            <div class="card-body">
                                <p>To deposit funds in your trading account is quick and simple For your convenience you may choose one of the several available deposit methods To make a successful deposit please follow the steps below Login to your account Click on the DEPOSITS button in the DASHBOARD section Choose the deposit option And follow the steps to complete your transaction</p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="heading4">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                    <p>How long does my deposit take before it can reflect on my Investments account dashboard?</p>
                                </button>
                            </h5>
                        </div>
                        <div class="collapse " id="collapse4" aria-labelledby="heading4" data-parent="#accordion">
                            <div class="card-body">
                                <p>Your deposit will be reflected immediately once it is confirmed on the blockchain network</p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="heading5">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                    <p>How do I make a withdrawal?</p>
                                </button>
                            </h5>
                        </div>
                        <div class="collapse " id="collapse5" aria-labelledby="heading5" data-parent="#accordion">
                            <div class="card-body">
                                <p>To make a withdrawal request click the WITHDRAW button at the top center of your account dashboard and input the required details to withdraw</p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="heading6">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                    <p>How long does it take to process my withdrawal?</p>
                                </button>
                            </h5>
                        </div>
                        <div class="collapse " id="collapse6" aria-labelledby="heading6" data-parent="#accordion">
                            <div class="card-body">
                                <p>Once we receive your withdrawal request we process immediately and send to your bitcoin wallet</p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="heading7">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                                    <p>Can I have more than one account?</p>
                                </button>
                            </h5>
                        </div>
                        <div class="collapse " id="collapse7" aria-labelledby="heading7" data-parent="#accordion">
                            <div class="card-body">
                                <p>No you cannot have more than one account.</p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="heading8">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
                                    <p>Is this company properly registered?</p>
                                </button>
                            </h5>
                        </div>
                        <div class="collapse " id="collapse8" aria-labelledby="heading8" data-parent="#accordion">
                            <div class="card-body">
                                <p>Yes we are officially and properly registered with the UK company house, our company registration number is #11694133</p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="heading9">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                                    <p>Can I have more than two accounts?</p>
                                </button>
                            </h5>
                        </div>
                        <div class="collapse " id="collapse9" aria-labelledby="heading9" data-parent="#accordion">
                            <div class="card-body">
                                <p>We do not allow multiple accounts.</p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="heading10">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse10" aria-expanded="false" aria-controls="collapse10">
                                    <p>how many times can i make a deposit?</p>
                                </button>
                            </h5>
                        </div>
                        <div class="collapse " id="collapse10" aria-labelledby="heading10" data-parent="#accordion">
                            <div class="card-body">
                                <p>Yes you can make as many deposit as you want on any of our investment plans.</p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <!-- col end-->
            <div class="col-lg-4">
                <div class="help-box">
                    <div class="help mrb-40">
                        <h2>Need any help!</h2>
                        <p>
                            Find answers to frequently asked questions about Asset Digital Limited </p><a class="btn btn-primary" href="index-9.htm?a=support">Contact us</a>
                    </div>
                    <!-- Quote item end-->
                </div>
            </div>
            <!-- Col end-->
        </div>
        <!-- Row end-->
    </div>
</section>

@endsection