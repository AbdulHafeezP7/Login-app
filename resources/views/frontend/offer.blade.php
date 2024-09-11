
@extends('frontend.layouts.FrontendLayout')
@section('title', 'Dashborad')
@section('content')
<!-- BEGIN :: page header section -->
<div class="slider">
    <div class="swiper mm">
        <div class="swiper-wrapper">
            <div class="subSlider">
                    <div class="slider__image small-header">
                        <img src="{{ asset('frontend/frontend/images/slider/another_page-01.png')}}" draggable="false" alt="alt">
                    </div>
                    <div class="slider__text">
                        <div class="container">
                            <p class="lead font-weight-bold" data-aos="fade-up" data-aos-delay="100"> العروض</p>

                            <div class="breadcrumb">
                                <ul vocab="https://schema.org/" typeof="BreadcrumbList">
                                    <li property="itemListElement" typeof="ListItem" class="first">
                                        <a href="index.html" property="item" typeof="WebPage">
                                            <span property="name">الرئيسية</span>
                                        </a>
                                    </li>
                                    <li class="active last">
                                        <span> العروض</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
               
            </div>
        </div>
    </div>
</div>
<!-- END :: page header section -->

<!-- BEGIN :: page content -->
<div class="page-content offer-profile d-pad pb-0">
    <div class="container">
        <div class="row">
            {{-- <div class="col-12 about__text mb-5">
                <h2 class="title about__title mb-5" data-aos="fade-up" data-aos-delay="100"> العروض</h2>
              
            </div> --}}
            {{-- <div class="col-md-8 col-12">
            <nav id="services-nav" class="services-nav">
                            <span class="btn btn-white btn-tab active" id="all" >
                              <a href="#" onclick="nav('#all')">    كل الخدمات</a>
                            </span>
                        <span  class="btn btn-white btn-tab " id="dental" >
                        <a href="#" onclick="nav('#dental')"> قسم الاسنان</a> 
                       </span>
                        <span  class="btn btn-white btn-tab  "  id="dermatology">
                        <a href="#" onclick="nav('#dermatology')">       خدمات الجلدية</a>  </span>
                        </nav>
            </div> --}}

            {{-- <div class="col-md-4 col-12">
                <div class="search-block mb-5" data-aos="fade-up">
                    <form action="#">
                        <div class="form-group">
                            <label for="searchBlock" class="sr-only">البحث في العروض</label>

                            <input type="text"
                                   class="form-control white-input search-input"
                                   id="searchBlock"
                                   name="name"
                                   placeholder="هل تبحث عن عرض معين؟" />

                            
                            <button class="btn btn-search">
                                <img src="frontend/images/icons/search.svg" alt="search" draggable="false">
                            </button>
                        </div>
                    </form>
                </div>
            </div> --}}
            <div class="col-12">
                <div class="row">
@foreach ($offer as $item)
                <div class="col-md-6 col-lg-4 col-xl-4">
                                <div class="offer">
                                    <div class="img-overlay__icon pd">الجلدية</div>
                                    <div class="offer__image">
                                        <img src="{{asset('images').'/'.$item->image}}" alt="offer" draggable="false" />
                                    </div>
                                    <div class="offer__text">

                                        <!--<div class="d-flex justify-content-around mt-3 offers-book-btn-container">-->
                                        <!--    <button class="btn btn-brand-primary offer__button w-50 add_new_offer_cart_cart" data-offer_id="92">-->
                                        <!--        إحجز الآن                                                </button>-->

                                      
                                        <!--</div>-->
                                    </div>
                                </div>
                            </div>
@endforeach                                   

                 </div>
            </div>
        </div>
    </div>
</div>


@endsection