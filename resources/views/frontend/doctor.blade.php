@extends('frontend.layouts.FrontendLayout')
@section('title', 'Dashborad')
@section('content')
<!--<div class="slider">-->
<!--    <div class="swiper mm">-->
<!--        <div class="swiper-wrapper">-->
<!--            <div class="subSlider">-->
                    <!--<div class="slider__image small-header">-->
                    <!--    <img src="frontend/images/slider/another_page-01.png" draggable="false" alt="alt">-->
                    <!--</div>-->
<!--                    <div class="slider__text">-->
<!--                        <div class="container">-->
<!--                            <p class="lead font-weight-bold" data-aos="fade-up" data-aos-delay="100"> العروض</p>-->

<!--                            <div class="breadcrumb">-->
<!--                                <ul vocab="https://schema.org/" typeof="BreadcrumbList">-->
<!--                                    <li property="itemListElement" typeof="ListItem" class="first">-->
<!--                                        <a href="index.html" property="item" typeof="WebPage">-->
<!--                                            <span property="name">الرئيسية</span>-->
<!--                                        </a>-->
<!--                                    </li>-->
<!--                                    <li class="active last">-->
<!--                                        <span> العروض</span>-->
<!--                                    </li>-->
<!--                                </ul>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
               
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!-- END :: page header section -->
 <div class="page-content services main-services-page d-pad pb-20">
        <div class="container">
            <div class="about__text mb-5">
                <h2 class="title about__title mb-5" data-aos="fade-up" data-aos-delay="100">الأطباء</h2>
                <p class=" mb-0 color-text-secondary about__" data-aos="fade-up" data-aos-delay="200">
                    نخبة من الإستشاريين والأخصائيين في كافة التخصصات الطبية
                </p>
            </div>
            <div class="col-md-12 col-12">
                <nav id="services-nav" class="services-nav">
                <a  onclick="nav('.all','#all')"> <span class="btn btn-white btn-tab active" id="all" >
                                     عرض جميع أطباء
                                </span></a>
                         
                          @foreach($department as $row)
                                <a  onclick="nav('.c_{{$row->id}}','#c_{{$row->id}}')"><span  class="btn btn-white btn-tab " id="c_{{$row->id}}" >
                                    {{$row->department_ar}}
                           </span></a>
                           @endforeach

                         

                            
                 

                            </nav>
                </div>


                <div class="row">
                   

                    @foreach ($doctors as $item)
                    <div class="col-md-6 col-lg-4 col-xl-3 c_{{$item->department}}">
                        <div class="doctorList">
                            <div class="img-overlay__icon">{{$item->department_name}}</div>
                            <div class="doctor__image">
                                <img src="{{asset('images').'/'.$item->image}}" alt="doctor" draggable="false" loading="lazy">
                            </div>
                            <div class="doctor__text">
                                <h3 class="h6">{{$item->name_ar}}</h3>
                               
                            </div>
                        </div>
                    </div>
                    @endforeach

               





                
                <div class="col-lg-12">
                    <div class="page-pagination" data-aos="fade-up">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
   
    function nav(div,id){
        if(id=='#all'){
            @foreach($department as $row)
            $('.c_{{$row->id}}').show();
            @endforeach
        }else{
            @foreach($department as $row)
            $('.c_{{$row->id}}').hide();
            @endforeach
            $(div).show();
        }
        @foreach($department as $row)
            $('#c_{{$row->id}}').removeClass('active');
        @endforeach
          $('#all').removeClass('active');
        $(id).addClass('active');

        
    }
</script>