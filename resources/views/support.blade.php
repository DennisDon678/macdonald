@extends('layouts.homeLayout')

@section('main')
    <!-- START SECTION BANNER -->
    <div class="banner-area" id="banner-area" style="background-image:url(images/banner/banner1.jpg);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="banner-heading">
                        <h1 class="banner-title">Get Support</h1>
                    </div>
                </div>
                <!-- Col end-->
            </div>
            <!-- Row end-->
        </div>
        <!-- Container end-->
    </div>
    <section class="main-container" id="main-container" style="margin-bottom: 180px;">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-12">
                    <h2 class="section-title"><span>Send Us Message</span>Contact Us</h2>
                </div>
            </div>
            <!-- Title row end-->
        </div>
        <!-- container end-->
        <div class="ts-form form-boxed" id="ts-form">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="contact-wrapper">
                            <div class="contact-box form-box">

                                <script language="javascript">
                                    function checkform() {
                                        if (document.mainform.name.value == '') {
                                            alert("Please type your full name!");
                                            document.mainform.name.focus();
                                            return false;
                                        }
                                        if (document.mainform.email.value == '') {
                                            alert("Please enter your e-mail address!");
                                            document.mainform.email.focus();
                                            return false;
                                        }
                                        if (document.mainform.message.value == '') {
                                            alert("Please type your message!");
                                            document.mainform.message.focus();
                                            return false;
                                        }
                                        return true;
                                    }
                                </script>

                                <form method="post" name="mainform" onsubmit="return checkform()" class="contact-form">
                                    <input type="hidden" name="form_id" value="17435585025714"><input type="hidden"
                                        name="form_token" value="ceea63d0b66c4fce0e80bf0f7b42ea7d">
                                    <input type="hidden" name="a" value="support">
                                    <input type="hidden" name="action" value="send">

                                    <div class="error-container"></div>
                                    <div class="row">
                                        <!-- Col end-->
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input class="form-control form-email" type="text" name="name"
                                                    value="" placeholder="Enter Name *">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input class="form-control form-name" type="text" name="email"
                                                    value="" placeholder="Enter Email">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <textarea class="form-control form-message required-field" placeholder="Message *" name="message" class="inpts"
                                                    cols="45" rows="8"></textarea>
                                            </div>
                                        </div>
                                        <!-- Col 12 end-->
                                    </div>

                                    <!-- Form row end-->
                                    <div class="text-right">
                                        <button class="btn btn-primary tw-mt-30" name="send" type="submit">Contact
                                            US</button>
                                    </div>
                                </form>
                            </div>
                            <div class="contact-box info-box">
                                <div class="contact-info-right">
                                    <h3>Contact Us</h3>
                                    <div class="ts-contact-info"><span class="ts-contact-icon float-left"><i
                                                class="icon icon-map-marker2"></i></span>
                                        <div class="ts-contact-content">
                                            <h3 class="ts-contact-title">Visit Us</h3>
                                            <p>
                                                {{App\Models\Setting::get('contact_address')}}
                                            </p>
                                        </div>
                                        <!-- Contact content end-->
                                    </div>

                                    <div class="ts-contact-info last"><span class="ts-contact-icon float-left"><i
                                                class="icon icon-envelope"></i></span>
                                        <div class="ts-contact-content">
                                            <h3 class="ts-contact-title">Mail Us</h3>
                                            <p>{{App\Models\Setting::get('contact_email')}}</p>
                                        </div>
                                        <!-- Contact content end-->
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
