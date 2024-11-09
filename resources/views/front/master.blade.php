<!doctype html>
<html lang="en" dir="rtl">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
    <!--google fonts css-->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <!--font awesome css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="{{asset('front/imgs/Icon.png')}}">

    <!-- custom CSS -->
    <link rel="stylesheet" href="{{asset('front/css/owl.carousel.min.css')}}">
    <link rel=stylesheet href="{{asset('front/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/hover-min.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/style.css')}}">


    <title>بنك الدم الرئيسية </title>

</head>
<body>

<div class="upper-bar">
    <div class="container">
        <div class="row">

            {{-- Check for client name message --}}

            <!-- not a member-->

            <div class="col-lg-4">
                <div class="col-lg-4 col-md-6">
                    <div class="language">
                        <a href="{{url(route('HomePage'))}}" class="ar active">عربى</a>
                        <a href="{{url(route('HomePage'))}}" class="en inactive">EN</a>
                    </div>
                </div>
                @auth('client')
                    {{-- I'm a member--}}
                    <div class="member">
                        <p class="welcome">مرحباً بك</p>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::guard('client')->user()->name }}
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{url(route('HomePage'))}}">
                                    <i class="fas fa-home"></i> الرئيسية
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="far fa-user"></i> معلوماتى
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="far fa-bell"></i> اعدادات الاشعارات
                                </a>
                                <a class="dropdown-item" href="{{url(route('myFavourites'))}}">
                                    <i class="far fa-heart"></i> المفضلة
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="far fa-comments"></i> ابلاغ
                                </a>
                                <a class="dropdown-item" href="{{url(route('contact-us'))}}">
                                    <i class="fas fa-phone-alt"></i> تواصل معنا
                                </a>
                                <a class="dropdown-item" href="#"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> تسجيل الخروج
                                </a>
                                <form id="logout-form" action="{{ route('clientLogout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth

            </div>

            <div class="col-lg-4 col-md-6">
                <div class="social">
                    <div class="icons">
                        <a href="{{$settings->fb_link}}" class="facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{$settings->ins_link}}" class="instagram"><i class="fab fa-instagram -f"></i></a>
                        <a href="{{$settings->tw_link}}" class="twitter"><i class="fab fa-twitter -f"></i></a>
                        <a href="{{$settings->yt_link}}" class="whatsapp"><i class="fab fa-youtube -f"></i></a>
                    </div>
                </div>
            </div>
            <div class="info" dir="ltr">
                <div class="phone">
                    <i class="fas fa-phone-alt"></i>
                    <p>{{$settings->phone}}</p>
                </div>
                <div class="e-mail">
                    <i class="far fa-envelope"></i>
                    <p>{{$settings->email}}</p>
                </div>
            </div>

        </div>
    </div>
</div>
<!--nav-->
<div class="nav-bar">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{asset('front/imgs/logo.png')}}" class="d-inline-block align-top" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url(route('HomePage')) }}">الرئيسية <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item" {{ Request::is('#') ? 'active' : '' }}>
                        <a class="nav-link" href="#">عن بنك الدم</a>
                    </li>
                    <li class="nav-item" {{ Request::is('articles') ? 'active' : '' }}>
                        <a class="nav-link" href="{{ route('articles') }}">المقالات</a>
                    </li>
                    <li class="nav-item"{{ Request::is('/donation-requests') ? 'active' : '' }}>
                        <a class="nav-link" href="{{ url(route('donation-requests')) }}">طلبات التبرع</a>
                    </li>
                    <li class="nav-item {{ Request::is('/who-are-us') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('who-are-us') }}">من نحن</a>
                    </li>
                    <li class="nav-item {{ Request::is('/contact-us') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url(route('contact-us')) }}">اتصل بنا</a>
                    </li>
                </ul>
                @auth('client')
                    <a href="{{url(route('register'))}}" class="donate">
                        <img src="{{asset('front/imgs/transfusion.svg')}}" alt="">
                        <p>طلب تبرع</p>
                    </a>
                @else
                    <!--not a member-->
                    <div class="accounts">
                        <a href="{{url(route('register'))}}" class="create">إنشاء حساب جديد</a>
                        <a href="{{url(route('clientLogin'))}}" class="signin">الدخول</a>
                    </div>
                @endauth


            </div>
        </div>
    </nav>
</div>

{{--  Start Content --}}
@yield('content')
{{-- End Content --}}


<!--footer-->
<div class="footer">
    <div class="inside-footer">
        <div class="container">
            <div class="row">
                <div class="details col-md-4">
                    <img src={{asset('front/imgs/logo.png')}} alt="">
                    <h4>بنك الدم</h4>
                    <p>
                        هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى،
                        حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى.
                    </p>
                </div>
                <div class="pages col-md-4">
                    <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-home-list" href="index.html"
                           role="tab" aria-controls="home">الرئيسية</a>
                        <a class="list-group-item list-group-item-action" id="list-profile-list" href="#" role="tab"
                           aria-controls="profile">عن بنك الدم</a>
                        <a class="list-group-item list-group-item-action" id="list-messages-list" href="#" role="tab"
                           aria-controls="messages">المقالات</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list"
                           href="donation-requests.html" role="tab" aria-controls="settings">طلبات التبرع</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list" href="who-are-us.html"
                           role="tab" aria-controls="settings">من نحن</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list" href="contact-us.html"
                           role="tab" aria-controls="settings">اتصل بنا</a>
                    </div>
                </div>
                <div class="stores col-md-4">
                    <div class="availabe">
                        <p>متوفر على</p>
                        <a href="#">
                            <img src={{asset('front/imgs/google1.png')}}>
                        </a>
                        <a href="#">
                            <img src={{asset('front/imgs/ios1.png')}}>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="other">
        <div class="container">
            <div class="row">
                <div class="social col-md-4">
                    <div class="icons">
                        <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="rights col-md-8">
                    <p>جميع الحقوق محفوظة لـ <span>بنك الدم</span> &copy; 2019</p>
                    <p><br>Made with <i class="fas fa-heart"></i> by Taha Mahmoud</p>
                </div>
            </div>


        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
{{--<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>--}}


<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"></script>
<script src="{{asset('front/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('front/js/main.js')}}"></script>
<script src="{{ asset('front/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>

<script type="text/javascript">
    var scrolltotop = {
        setting: {
            startline: 100,
            scrollto: 0,
            scrollduration: 1e3,
            fadeduration: [500, 100]
        },
        controlHTML: '<img src="https://i1155.photobucket.com/albums/p559/scrolltotop/arrow92.png" />',
        controlattrs: {offsetx: 5, offsety: 5},
        anchorkeyword: "#top",
        state: {isvisible: !1, shouldvisible: !1},
        scrollup: function () {
            this.cssfixedsupport || this.$control.css({opacity: 0});
            var t = isNaN(this.setting.scrollto) ? this.setting.scrollto : parseInt(this.setting.scrollto);
            t = "string" == typeof t && 1 == jQuery("#" + t).length ? jQuery("#" + t).offset().top : 0, this.$body.animate({scrollTop: t}, this.setting.scrollduration)
        },
        keepfixed: function () {
            var t = jQuery(window), o = t.scrollLeft() + t.width() - this.$control.width() - this.controlattrs.offsetx,
                s = t.scrollTop() + t.height() - this.$control.height() - this.controlattrs.offsety;
            this.$control.css({left: o + "px", top: s + "px"})
        },
        togglecontrol: function () {
            var t = jQuery(window).scrollTop();
            this.cssfixedsupport || this.keepfixed(), this.state.shouldvisible = t >= this.setting.startline ? !0 : !1, this.state.shouldvisible && !this.state.isvisible ? (this.$control.stop().animate({opacity: 1}, this.setting.fadeduration[0]), this.state.isvisible = !0) : 0 == this.state.shouldvisible && this.state.isvisible && (this.$control.stop().animate({opacity: 0}, this.setting.fadeduration[1]), this.state.isvisible = !1)
        },
        init: function () {
            jQuery(document).ready(function (t) {
                var o = scrolltotop, s = document.all;
                o.cssfixedsupport = !s || s && "CSS1Compat" == document.compatMode && window.XMLHttpRequest, o.$body = t(window.opera ? "CSS1Compat" == document.compatMode ? "html" : "body" : "html,body"), o.$control = t('<div id="topcontrol">' + o.controlHTML + "</div>").css({
                    position: o.cssfixedsupport ? "fixed" : "absolute",
                    bottom: o.controlattrs.offsety,
                    right: o.controlattrs.offsetx,
                    opacity: 0,
                    cursor: "pointer"
                }).attr({title: "Scroll to Top"}).click(function () {
                    return o.scrollup(), !1
                }).appendTo("body"), document.all && !window.XMLHttpRequest && "" != o.$control.text() && o.$control.css({width: o.$control.width()}), o.togglecontrol(), t('a[href="' + o.anchorkeyword + '"]').click(function () {
                    return o.scrollup(), !1
                }), t(window).bind("scroll resize", function (t) {
                    o.togglecontrol()
                })
            })
        }
    };
    scrolltotop.init();</script>

@stack('scripts')
</body>
</html>


{{--@dd(Auth::guard('client'))--}}
