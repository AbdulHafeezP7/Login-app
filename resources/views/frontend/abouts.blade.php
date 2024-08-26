
@extends('frontend.layouts.FrontendLayout')
@section('title', 'Dashborad')
@section('content')
 <!-- BEGIN :: page header -->
 <div class="slider">
    <div class="swiper mm">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="subSlider">
                    <div class="slider__image small-header">
                        <img src="{{asset('frontend/assets/images/slider/another_page-01.png')}}" draggable="false" alt="نبذة عنا" />
                    </div>
                    <div class="slider__text">
                        <div class="container">
                            <p class="lead font-weight-bold" data-aos="fade-up" data-aos-delay="100">نبذة عنا</p>

                            <div class="breadcrumb">
                                <ul vocab="https://schema.org/" typeof="BreadcrumbList">
                                    <li property="itemListElement" typeof="ListItem" class="first">
                                        <a href="index.php" property="item" typeof="WebPage">
                                            <span property="name">الرئيسية</span>
                                        </a>
                                    </li>

                                    <li class="active last">
                                        <span>نبذة عنا</span>
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

<!-- BEGIN :: services content -->
<section class="d-pad brd-top-rad mb-150">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                <img  src="{{asset('frontend/assets/images/About us_Mesa_de_trabajo_1-05.jpg')}}" width="100%" height="100%" />
            </div>
       
        </div>
    </div>
</section>
<!-- END ::  services content -->

  <!-- BEGIN :: services content -->
  <section class="d-pad brd-top-rad mb-150">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                <img  src="{{asset('frontend/assets/images/our_value_mesa_de_trabajo_1-04.png')}}" width="100%" height="100%" />
            </div>
       
        </div>
    </div>
</section>
<!-- END ::  services content -->

  <!-- BEGIN :: services content -->
  <section class="d-pad brd-top-rad mb-150">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                <img  src="{{asset('frontend/assets/images/vision_messsage_mesa_de_trabajo_1-03.png')}}" width="100%" height="100%" />
            </div>
       
        </div>
    </div>
</section>
