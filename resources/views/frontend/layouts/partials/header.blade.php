<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('frontend/uploads/settings/2022/03/10/20220310174130725093682_settings.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('frontend/uploads/settings/2022/03/10/20220310174130725093682_settings.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('frontend/uploads/settings/2022/03/10/20220310174130725093682_settings.png')}}">
    <meta name="title" content=" مستشفى د. خالد الرحيمي" />
    <meta name="description" content="مستشفى د. خالد الرحيمي" />
    <meta name="keywords" content="" />
    <link rel="canonical" href="https://www.dralruhaimi.com/" />
    <link rel="stylesheet" href="{{ asset('frontend/frontend/css/build.css')}}" rel="preload" />
    <link rel="preload" href="{{ asset('frontend/frontend/css/build.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="{{ asset('frontend/frontend/css/build.css')}}">
    </noscript>

    <title>مستشفى د. خالد الرحيمي</title>
    <meta name="google-site-verification" content="8ckLqlAuob_Jy79p5FNtLc3s0y7IzYYgk2BHO4Ra3Ho" />
</head>

<body>
    <!-- BEGIN :: header section -->

    <!-- BEGIN :: header section -->
    <header class="header" id="header">
        <div class="header__nav container" data-aos="fade-up" data-aos-delay="100">
            <nav class="navbar navbar-expand-xl navbar-light d-flex flex-row w-100">
                <div class="brand-container">
                    <a class="navbar-brand" href="{{route('home')}}">
                        <img src="{{ asset('frontend/frontend/images/logo12.png')}}" alt="logo">
                    </a>
                    <div class="mobile-icons">
                        <button class="btn navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarElm" aria-controls="navbarElm"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                </div>
                <div class="nav-bar-wrapper">
                    <div class="top-bar" data-aos="fade-up">
                        <div class="container p-0">
                            <div class="top-bar__container">
                                <div class="top-bar__block social">
                                    <ul class="list-inline d-flex flex-row-reverse" style="
    min-height: 27px;
">

                                        <a href="#" class="btn-brand-primary article-btn" data-toggle="modal" data-target="#booking" style="
    margin: 2px;
    height: 28px;
">
                                            احجز الآن </a>

                                        <li class="list-inline-item">
                                            <a href="https://wa.me/+966920010436" target="_blank" title="Whasapp">
                                                <div class="top-bar__icon">
                                                    <img src="{{ asset('frontend/frontend/images/icons/social/whatsapp-svg.png')}}" draggable="false" alt="Whasapp" class="socialmedia-icon" />
                                                </div>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="tel:+966920010436" >
                                                <div class="top-bar__icon">
                                                    <img src="{{ asset('frontend/frontend/images/icons/phone-svg.png')}}" draggable="false" alt="snapchat" class="socialmedia-icon" style="
    width: 60%;
" />
                                                </div>
                                            </a>
                                        </li>

                                        <!-- <li class="list-inline-item">
                                            <a href="https://twitter.com/drkalruhaimi" target="_blank" title="Twitter">
                                                <div class="top-bar__icon">
                                                    <img src="frontend/images/icons/social/twitter-svg.png" draggable="false" alt="Twitter" class="socialmedia-icon"/>
                                                </div>
                                            </a>
                                        </li> 
                                        <li class="list-inline-item">
                                            <a href="https://www.instagram.com/dr.kalruhaimi/" target="_blank" title="Instagram">
                                                <div class="top-bar__icon">
                                                    <img src="frontend/images/icons/social/instagram-svg.png" draggable="false" alt="instagram" class="socialmedia-icon"/>
                                                </div>
                                            </a>
                                        </li>
                                     <li class="list-inline-item">
                                            <a href="https://wa.me/+966920010436" target="_blank" title="Whasapp">
                                                <div class="top-bar__icon">
                                                    <img src="frontend/images/icons/social/whatsapp-svg.png" draggable="false" alt="Whasapp" class="socialmedia-icon"/>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://t.snapchat.com/8jM6vxbU" target="_blank" title="snapchat">
                                                <div class="top-bar__icon">
                                                    <img src="frontend/images/icons/social/snapchat.png" draggable="false" alt="snapchat" class="socialmedia-icon"/>
                                                </div>
                                            </a>
                                        </li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="collapse navbar-collapse" id="navbarElm">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('home')}}">
                                    الرئيسية </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('about')}}">
                                    من نحن </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="blogDropdown" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                الأقسام </a>
                                <div class="dropdown-menu " aria-labelledby="blogDropdown">
                                    @foreach($departments as $department)
                                    <a class="dropdown-item" href="{{route('departmentDetails',['surl'=>$department->slug])}}">{{ $department->department_ar }}</a>
                                    @endforeach
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="blogDropdown" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    الفروع </a>

                                <div class="dropdown-menu " aria-labelledby="blogDropdown">
                                    @foreach($branch as $row)
                                     <a class="dropdown-item" href="{{route('branch_location',['clinicId'=>$row->id])}}">{{ $row->branchname_ar }}</a>
                                    @endforeach
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('doctors')}}">
                                   الأطباء </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('offer')}}">
                                   العروض </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('contact_us')}}">
                                    تواصل معنا </a>
                            </li>


                        </ul>

                        <div class="my-2 my-lg-0 d-xl-inline-block">
                            <a href="#" class="btn btn-white" data-toggle="modal" data-target="#booking">
                                اتصل بنا </a>

                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!-- END :: header section -->