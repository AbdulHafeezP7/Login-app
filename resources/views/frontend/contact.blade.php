@extends('frontend.layouts.FrontendLayout')
@section('title', 'Dashborad')
@section('content')
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

<div class="container mt-50 mb-50">
    <div class="section-title align-items-stretch mb-0">
        <h2 class="title" data-aos="fade-up">طلب تواصل</h2>
        <!-- <h1></h1> -->
    </div>
    <form action="submit_complaint.php" method="post">
        
           <div class="form-group">
               
                        <label for="service" class="col-form-label">اختر الفرع:</label>
                        <select class="form-control show-tick" id="service" name="service" tabindex="-98">
                           @foreach($branch as $row)
                                 <option value="{{ $row->branchname_ar }}">{{ $row->branchname_ar }}</option>
                            @endforeach
                        </select>
                    </div>
        <div class="form-group">
            <label for="name">الاسم:</label>
            <input type="text" id="name" placeholder="الاسم" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="number">رقم الجوال:</label>
            <input type="text" id="number" name="number" placeholder="رقم الجوال" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="message">الرسالة:</label>
            <textarea id="message" name="message" placeholder="الرسالة" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary"> تم</button>
    </form>
</div>
    </div>
</div>
@endsection