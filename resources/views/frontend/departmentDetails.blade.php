@extends('frontend.layouts.FrontendLayout')
@section('title', 'Dashborad')
@section('content')
<!-- BEGIN :: slider section -->

<!-- BEGIN :: page header section -->
<div class="slider">
    <div class="swiper mm">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="subSlider">
                    <div class="slider__image small-header">
                        <img src="{{ asset('frontend/frontend/images/slider/another_page-01.png')}}" draggable="false" alt="اتصل بنا" />
                    </div>
                    <div class="slider__text">
                        <div class="container">
                            <p class="lead font-weight-bold" data-aos="fade-up" data-aos-delay="100">اتصل بنا</p>

                            <div class="breadcrumb">
                                <ul vocab="https://schema.org/" typeof="BreadcrumbList">
                                    <li property="itemListElement" typeof="ListItem" class="first">
                                        <a href="index.php" property="item" typeof="WebPage">
                                            <span property="name">الرئيسية</span>
                                        </a>
                                    </li>
                                    <li class="active last">
                                        <span>اتصل بنا</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- END :: page header section -->
<!-- BEGIN :: page content section -->
<div class="page-content services main-services-page d-pad pb-0">
    <div class="container">
        <div class="about__text mb-5">
            <h2 class="title about__title mb-5" data-aos="fade-up" data-aos-delay="100">{{$details->department_ar}}</h2>
            <div class=" mb-0 color-text-secondary about__" data-aos="fade-up" data-aos-delay="200">
                {!! $details->content_ar !!}
            </div>
        </div>
    </div>
</div>
<!-- END :: page content section -->

<!-- BEGIN :: book now section -->
<section class="container d-pad pb-0">
    <div class="container book-now d-pad m-0">
        <div class="container">
            <div class="d-flex book-now__wrapper">
                <div class="col-lg-6 d-flex align-items-center">
                    <h2 class="h3" data-aos="fade-up">
                        إحجز موعدك الآن <br> واستمتع بتجربة علاج فريدة من نوعها </h2>
                </div>
                <div class="col-lg-6 d-flex align-items-center justify-content-lg-end justify-content-center">
                    <a href="" class="btn btn-white" data-aos="fade-up">
                        إحجز موعدك الآن </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END :: book now section -->




@endsection