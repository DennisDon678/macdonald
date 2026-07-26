<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport"
        content="initial-scale=1, width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <title>{{ env('APP_TITLE') }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/vendors/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="/vendors/css/vendor.bundle.base.css">
    <meta name="theme-color" content="#063372">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="/vendors/datatables.net-bs4/dataTables.bootstrap4.html">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="/css/horizontal-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="/img/logo-icon-color.png">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='/icon?family=Material+Icons'>
    <link rel="stylesheet" href="/style.css">
    <style>
        .thatwhat {/
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
    
    <!-- Premium Auth UI Overhaul -->
    <style>
        body {
            background-color: #f4f7f9 !important;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }
        .auth-form-light {
            background: #ffffff !important;
            border-radius: 16px !important;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08), 0 1px 3px rgba(0, 0, 0, 0.05) !important;
            border: 1px solid #e9ecef !important;
            padding: 3rem 2.5rem !important;
        }
        .auth-form-light h4 {
            font-size: 1.75rem !important;
            font-weight: 800 !important;
            color: #1a1d20 !important;
            margin-bottom: 0.5rem !important;
            text-align: center;
        }
        .auth-form-light h6 {
            font-size: 1rem !important;
            color: #6c757d !important;
            margin-bottom: 2rem !important;
            text-align: center;
        }
        .brand-logo {
            margin-bottom: 2rem !important;
            text-align: center !important;
        }
        .brand-logo img {
            max-width: 100% !important;
            height: 90px !important;
            object-fit: contain !important;
        }
        .form-group {
            margin-bottom: 1.25rem !important;
        }
        .form-control {
            background-color: #f8fafc !important;
            border: 1.5px solid #cbd5e1 !important;
            border-radius: 8px !important;
            padding: 0.85rem 1.25rem !important;
            font-size: 1rem !important;
            color: #334155 !important;
            transition: all 0.2s ease-in-out !important;
            height: auto !important;
        }
        .form-control:focus {
            background-color: #ffffff !important;
            border-color: #2154cf !important;
            box-shadow: 0 0 0 4px rgba(33, 84, 207, 0.15) !important;
            outline: none !important;
        }
        .form-control::placeholder {
            color: #94a3b8 !important;
            font-weight: 400 !important;
        }
        .btn-primary.auth-form-btn {
            background: linear-gradient(135deg, #2154cf 0%, #173b90 100%) !important;
            border: none !important;
            border-radius: 8px !important;
            font-weight: 600 !important;
            letter-spacing: 0.5px !important;
            padding: 1rem !important;
            text-transform: uppercase !important;
            box-shadow: 0 4px 10px rgba(33, 84, 207, 0.25) !important;
            width: 100%;
        }
        .btn-primary.auth-form-btn:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 15px rgba(33, 84, 207, 0.35) !important;
            background: linear-gradient(135deg, #2a63f0 0%, #1d4ac0 100%) !important;
        }
        .text-danger {
            color: #e3342f !important;
            font-size: 0.875rem !important;
            font-weight: 500 !important;
        }
    </style>
    
    <script type="text/javascript">
        function hide_loader() {
            document.getElementById("xxloader").style.display = "none";
        }

        window.onload = hide_loader;
    </script>
</head>

<body>

    <div id="xxloader" class="text-center xcon"
        style="position: fixed; left: 0; right: 0; top: 0; bottom: 0; z-index: 9999; width: 100%; height: 100%; background-color: #fff; opacity: 1; overflow: hidden;">
        <div class="xloader"></div>
    </div>

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper @yield('body-class')">
            <div class="main-panel" style="padding-top: 0px;">
                <div class="content-wrapper d-flex align-items-center auth px-0">
                    <div class="row w-100 mx-0">
                        <div class="col-lg-4 mx-auto">
                            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                                <div class="brand-logo">
                                    <a href="/"><img src="/img/logo.png" alt="logo"></a>
                                </div>
                                <div>
                                    @yield('main')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- plugins:js -->
    <script src="/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="/vendors/chart.js/Chart.min.js"></script>
    <script src="/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="/js/off-canvas.js"></script>
    <script src="/js/hoverable-collapse.js"></script>
    <script src="/js/template.js"></script>
    <script src="/js/settings.js"></script>
    <script src="/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="/js/dashboard.js"></script>
    <script src="/js/todolist.js"></script>
    <script src="/js/data-table.js"></script>
    <!-- End custom js for this page -->

    <script src="/lib/jquery/js/jquery.js"></script>
    <script src="/lib/popper.js/js/popper.js"></script>
    <script src="/lib/bootstrap/js/bootstrap.js"></script>
    <script src="/lib/jquery.cookie/js/jquery.cookie.js"></script>
    <script src="/lib/select2/js/select2.min.js"></script>

    <script src="/lib/datatables/js/jquery.dataTables.js"></script>
    <script src="/lib/datatables-responsive/js/dataTables.responsive.js"></script>
    <script>
        $(function() {
            'use strict';

            $('#datatable1').DataTable({
                responsive: true,
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page',
                }
            });

            $('#datatable2').DataTable({
                bLengthChange: false,
                searching: false,
                responsive: true
            });

            // Select2
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity
            });

        });

        function hide_element(x) {
            document.querySelector(x).style.display = 'none';
        }

        function show_element(x) {
            document.querySelector(x).style.display = 'block';
        }

        function get_options(y, val, x) {
            show_element('#loader');
            $.ajax({
                type: "POST",
                url: 'includes/ajax.php',
                data: y + '=' + val,
                success: function(data) {
                    $(x).html(data);
                    hide_element('#loader');
                }
            });
        }

        function copy_ref(data, btn) {
            var copyText = document.getElementById(data);
            copyText.select();
            document.execCommand("copy");
            $(btn).addClass('btn-success');
            $(btn).html('Copied <i class="fa fa-check"></i>');

        }
    </script>
    <script>
        // WORK IN PROGRESS BELOW

        $('document').ready(function() {


            // RESTYLE THE DROPDOWN MENU
            $('#google_translate_element').on("click", function() {

                // Change font family and color
                $("iframe").contents().find(
                        ".goog-te-menu2-item div, .goog-te-menu2-item:link div, .goog-te-menu2-item:visited div, .goog-te-menu2-item:active div, .goog-te-menu2 *"
                        )
                    .css({
                        'color': '#544F4B',
                        'font-family': 'Roboto',
                        'width': '100%'
                    });
                // Change menu's padding
                $("iframe").contents().find('.goog-te-menu2-item-selected').css('display', 'none');

                // Change menu's padding
                $("iframe").contents().find('.goog-te-menu2').css('padding', '0px');

                // Change the padding of the languages
                $("iframe").contents().find('.goog-te-menu2-item div').css('padding', '20px');

                // Change the width of the languages
                $("iframe").contents().find('.goog-te-menu2-item').css('width', '100%');
                $("iframe").contents().find('td').css('width', '100%');

                // Change hover effects
                $("iframe").contents().find(".goog-te-menu2-item div").hover(function() {
                    $(this).css('background-color', '#4385F5').find('span.text').css('color',
                        'white');
                }, function() {
                    $(this).css('background-color', 'white').find('span.text').css('color',
                        '#544F4B');
                });

                // Change Google's default blue border
                $("iframe").contents().find('.goog-te-menu2').css('border', 'none');

                // Change the iframe's box shadow
                $(".goog-te-menu-frame").css('box-shadow',
                    '0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.3)'
                    );



                // Change the iframe's size and position?
                $(".goog-te-menu-frame").css({
                    'height': '100%',
                    'width': '100%',
                    'top': '0px'
                });
                // Change iframes's size
                $("iframe").contents().find('.goog-te-menu2').css({
                    'height': '100%',
                    'overflow': 'scroll',
                    'width': '100%'
                });
            });
        });
    </script>

    @if(App\Models\Setting::get("tawk_to_embed_url"))
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='{{App\Models\Setting::get("tawk_to_embed_url")}}';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
    @endif
</body>

</html>
