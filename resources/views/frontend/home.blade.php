@extends('frontend.layouts.FrontendLayout')
@section('title', 'Dashborad')
@section('content')
<!-- BEGIN :: slider section -->
<div class="slider">
    <div class="swiper mainSlider">
        <div class="swiper-wrapper">

            <div class="swiper-slide">
                <div class="slider__slide">
                    <div class="slider__image">
                        <img class="bannerImageSize" src="{{ asset('frontend/frontend/images/model0123.jpg')}}" draggable="false" alt="رمز الثقة في الرعاية الطبية" loading="eager">
                    </div>
                    <div class="slider__text main_slider_text">
                        <div class="container pull-center">
                            <p class="lead font-weight-bold bannerImage" data-aos="fade-up" data-aos-delay="100">
                                نعتني بعنايتك الطبية بمعيار عالمي </p>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="slider__slide">
                    <div class="slider__image">
                        <img class="bannerImageSize" src="{{ asset('01.webp')}}" draggable="false" alt="نوفر لكم أفضل خدمات الأسنان الجلدية و الطبية" loading="eager">
                    </div>
                    <div class="slider__text">
                        <div class="container">
                            <h1 class="color font-weight-bold bannerImage" data-aos="fade-up"> إنتشار واسع فً المنطقة الشرقٌة</h1>
                            <p class="lead font-weight-bold bannerImage" data-aos="fade-up" data-aos-delay="100">
                                نسعد بالوصول إلٌكم من خالل 6 فروع بالدمام والخبر واألحساء، نقدم من خاللها رعاٌة طبٌة متكاملة
                            </p>
                            <center>
                                <div class="slider__actions" data-aos="fade-up" data-aos-delay="200">
                                    <a data-toggle="modal" data-target="#booking" class="btn btn-brand-primary" href="#">
                                        إحجز الآن </a>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="slider__slide">
                    <div class="slider__image">
                        <img class="bannerImageSize" src="{{ asset('frontend/page/website3.webp')}}" draggable="false" alt="نخبة من افضل االستشارٌٌن واالخصائٌٌن فً المنطقة الشرقٌة." loading="eager">
                    </div>
                    <div class="slider__text">
                        <div class="container">
                            <h1 class="color font-weight-bold bannerImage" data-aos="fade-up">نخبة من افضل االستشارٌٌن واالخصائٌٌن فً المنطقة الشرقٌة.</h1>
                            <p class="lead font-weight-bold bannerImage" data-aos="fade-up" data-aos-delay="100">
                                ٌقدمون الخدمات فً كافة التخصصات الطبٌة بإستخدام افضل االجهزة والتقنٌات الحدٌثة لضمان أفضل النتائج.
                            </p>
                            <center>
                                <div class="slider__actions" data-aos="fade-up" data-aos-delay="200">
                                    <a data-toggle="modal" data-target="#booking" class="btn btn-brand-primary" href="#">
                                        إحجز الآن </a>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>

            <div class="swiper-slide">
                <div class="slider__slide">
                    <div class="slider__image">
                        <img class="bannerImageSize" src="{{ asset('frontend/page/website4.webp')}}" draggable="false" alt="رعاٌة طبٌة بالجودة العالٌة تحت إشراف طاقم طبً متكامل" loading="eager">
                    </div>
                    <div class="slider__text">
                        <div class="container">
                            <h1 class="color font-weight-bold bannerImage" data-aos="fade-up">رعاٌة طبٌة بالجودة العالٌة تحت إشراف طاقم طبً متكامل</h1>
                            <p class="lead font-weight-bold bannerImage" data-aos="fade-up" data-aos-delay="100">
                                نفخر بحصولنا على اعتماد المركز السعودي إلعتماد المنشآت الصحٌة )CBAHI)
                            </p>


                            <center>
                                <div class="slider__actions" data-aos="fade-up" data-aos-delay="200">
                                    <a data-toggle="modal" data-target="#booking" class="btn btn-brand-primary" href="#">
                                        إحجز الآن </a>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>



        </div>
        <div class="section-pagination">
            <div class="slider-pagination"></div>
        </div>
        <div class="slider-controls main-slider">
            <div class="swiper-button-next slider-next"></div>
            <div class="swiper-button-prev slider-prev"></div>
        </div>
    </div>



    <!-- BEGIN :: services section -->
    <section class="services d-pad brd-top-rad mt-50">
        <div class="container book-now d-pad">
            <div class="container">

                <div class="col-12 statistics d-pad px-0">
                    <div class="w-100 d-flex justify-content-between home-statistic-container">
                        <div class="statistic" data-aos="fade-up">
                            <div class="statistic__icon">
                                <img src="{{ asset('frontend/frontend/images/icons/feature-1.svg')}}" alt="نخبة النخبة" alt="doctors" draggable="false" loading="lazy">
                            </div>
                            <div class="statistic__text">
                                <div class="color-text-secondary">
                                    <strong>سنوات من الخبرة</strong>
                                    <p class="mb-0 mt-2">
                                        + 20
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="statistic" data-aos="fade-up">
                            <div class="statistic__icon">
                                <img src="{{ asset('frontend/frontend/images/icons/feature-2.svg')}}" alt="أفضل الخدمات" alt="doctors" draggable="false" loading="lazy">
                            </div>
                            <div class="statistic__text">
                                <div class="color-text-secondary">
                                    <strong>فروع بالمنطقة الشرقٌة</strong>
                                    <p class="mb-0 mt-2">
                                        6
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="statistic" data-aos="fade-up">
                            <div class="statistic__icon">
                                <img src="{{ asset('frontend/frontend/images/icons/feature-3.svg')}}" alt="walaa" alt="doctors" draggable="false" loading="lazy">
                            </div>
                            <div class="statistic__text">
                                <div class="color-text-secondary">
                                    <strong>طبٌب بفروعنا</strong>
                                    <p class="mb-0 mt-3">
                                        + 150
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="statistic" data-aos="fade-up">
                            <div class="statistic__icon">
                                <img src="{{ asset('frontend/frontend/images/icons/feature-3.svg')}}" alt="مرافق متكاملة" alt="doctors" draggable="false" loading="lazy">
                            </div>
                            <div class="statistic__text">
                                <div class="color-text-secondary">
                                    <strong>مرٌض</strong>
                                    <p class="mb-0 mt-2">
                                        + 20000000
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>



        <section class="about d-pad brd-top-rad">
            <div class="container about__container home-about-section">
                <img class="about__container_img" src="{{ asset('01.webp')}}" alt="Dr Khalid Service" alt="about" draggable="false" loading="lazy">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-6">
                        <div class="about__text">
                            <h2 class="title about__title mb-5" data-aos="fade-up" data-aos-delay="100">نخبة من أمهر الاستشاريين والأخصائيين على مستوى المملكة العربية السعودية</h2>
                            <p class=" mb-5 color-text-secondary about__" data-aos="fade-up" data-aos-delay="200">
                                في مجمعات د. خالد الرحيمي الطبية، نؤمن أن الطبيب هو العنصر الأبرز في نجاح الخدمة الطبية، لذلك نفخر باستقطاب استشاريين وأخصائيين مؤهلين في كافة التخصصات الطبية
                            </p>
                            <a href="abouts.php" class="btn btn-link" data-aos="fade-up" data-aos-delay="300">
                                المزيد عن مجمعاتنا.. </a>
                        </div>
                    </div>
                    <div class="col-12 statistics d-pad px-0">
                        <div class="w-100 d-flex justify-content-between home-statistic-container">
                            <div class="statistic" data-aos="fade-up">
                                <div class="statistic__icon">
                                    <img src="{{ asset('frontend/frontend/images/icons/feature-1.svg')}}" alt="نخبة النخبة" alt="doctors" draggable="false" loading="lazy">
                                </div>
                                <div class="statistic__text">
                                    <div class="color-text-secondary">
                                        <strong>نخبة النخبة</strong>
                                        <p class="mb-0 mt-2">
                                            نفخر بتواجد أطباء وطواقم تمريض على مستوى عالي وعالمي
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="statistic" data-aos="fade-up">
                                <div class="statistic__icon">
                                    <img src="{{ asset('frontend/frontend/images/icons/feature-2.svg')}}" alt="أفضل الخدمات" alt="doctors" draggable="false" loading="lazy">
                                </div>
                                <div class="statistic__text">
                                    <div class="color-text-secondary">
                                        <strong>أفضل الخدمات</strong>
                                        <p class="mb-0 mt-2">
                                            تقديم رعاية صحية متميزة للعملاء والمجتمع تواكب أفضل المعايير الطبية.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="statistic" data-aos="fade-up">
                                <div class="statistic__icon">
                                    <img src="{{ asset('frontend/frontend/images/icons/feature-3.svg')}}" alt="walaa" alt="doctors" draggable="false" loading="lazy">
                                </div>
                                <div class="statistic__text">
                                    <div class="color-text-secondary">
                                        <strong>سعودية عالمية</strong>
                                        <p class="mb-0 mt-3">
                                            نقدم خدماتنا الطبية بمعيار سعودي عالمي
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="statistic" data-aos="fade-up">
                                <div class="statistic__icon">
                                    <img src="{{ asset('frontend/frontend/images/icons/feature-4.svg')}}" alt="مرافق متكاملة" alt="doctors" draggable="false" loading="lazy">
                                </div>
                                <div class="statistic__text">
                                    <div class="color-text-secondary">
                                        <strong>مرافق متكاملة</strong>
                                        <p class="mb-0 mt-2">
                                            أجهزة طبية بصناعات عالمية من أكبر وأشهر مصانع الأجهزة الطبية على مستوى العالم
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="container mt-50">
            <div class="section-title align-items-stretch mb-0">
                <h2 class="title" data-aos="fade-up">والنصائح االسئلة اه</h2>

            </div>
          <style>
        .features-one__box {
            width: 140px;
            height: 140px;
            background-color: var(--cleenhearts-white, #fff);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            margin: 0 0 46px;
            border-radius: 12px;
            flex-direction: column;
            gap: 10px;
            cursor: pointer;
            transition: all 0.7s ease;
        }

        .features-one__box:hover {
            transform: translate3D(0, -1px, 0) scale(1.1);
            background: transparent linear-gradient(261deg, #8e264b 0%, #f7f7f7 100%);
            border-radius: 8px;
        }

        .features-one_box_image img {
            width: 60px;
            height: 60px;
        }

        .features-one_box_title {
            font-size: 15px;
            color: var(--cleenhearts-base, #351C42);
            font-family: "DM Sans", sans-serif;
            font-weight: 700;
            margin: 0;
        }

        .features-one__grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 12px;
        }

        /* Responsive adjustments */
        @media only screen and (max-width: 995px) {
            .features-one__grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media only screen and (max-width: 768px) {
            .features-one__grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media only screen and (max-width: 480px) {
            .features-one__grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .modals {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modals-contents {
            background: transparent linear-gradient(261deg, #8e264b 0%, #f7f7f7 100%);
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 30%;
            height: 20%;
            display: flex;
            flex-direction: column;
            border-radius: 12px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

.doctors-more {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 12px;
}


@media only screen and (max-width: 995px) {
    .doctors-more {
        flex-direction: column; 
        align-items: center;
        gap: 12px;
    }
}
    </style>
            </style>




            <section class="features-one text">
                <div class="container">
                    <div class="features-one__grid">









                        @php
                        $countPOPUpModel=0;
                        @endphp
                        @foreach($department as $row)
                         @php
                         $countPOPUpModel++;
                        @endphp
                            <div class="features-one__box" data-modals="modals-{{$countPOPUpModel}}">
                                <div class="features-one_box_image">
                                    <img width="60" height="60" src="{{asset('images').'/'.$row->image}}" alt="{{$row->department_ar}}">
                                </div>
                                <h3 class="features-one_box_title">{{$row->department_ar}}</h3>
                            </div>
            
                            <div id="modals-{{$countPOPUpModel}}" class="modals">
                                <div class="modals-contents">
                                    <span class="close" data-modals="modals-{{$countPOPUpModel}}">×</span>
                                    <p>{{$row->department_details}}</p>
                                </div>
                            </div>
                        @endforeach





                    </div><!-- /.features-one__grid -->
                </div><!-- /.container -->
            </section>

        </div>
    </section>
    <!-- END :: services section -->







    <div class="container mt-50">
        <div class="section-title align-items-stretch mb-0">
            <h2 class="title" data-aos="fade-up">الخدمات</h2>
            <div>
                <ul class="nav nav-tabs" id="servicesTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="btn btn-link-secondary active" id="all_services" data-toggle="tab" href="#all_services" role="tab">كل الخدمات</a>
                    </li>


                </ul>
            </div>
        </div>



        <div class="services__tabs" data-aos="fade-up">
            <div class="tab-content" id="servicesTabContent">
                <div class="tab-pane fade show active" role="tabpanel">
                    <div class="swiper servicesSlider">
                        <div class="swiper-wrapper">

                            @foreach ($article as $item)
                            <div class="swiper-slide">
                                <a class="service" href="{{route('articleDetails', ['surl' => '1'])}}">
                                    <div class="service__image">
                                        <img src="{{asset('images').'/'.$item->image}}" alt="{{$item->title}}" draggable="false" loading="lazy" />
                                    </div>
                                    <div class="service__title">
                                        <div class="d-flex justify-content-between mt-3 color-text-secondary">
                                            <h3 class="h6">{{$item->title_ar}}</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach






                        </div>
                        <div class="section-pagination">
                            <div class="service-pagination"></div>
                        </div>
                        <div class="slider-controls">
                            <div class="swiper-button-next service-next"></div>
                            <div class="swiper-button-prev service-prev"></div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>








    <!-- BEGIN :: doctors section -->
    <!-- BEGIN :: doctors section -->
    <section class="doctors d-pad brd-top-rad">
        <div class="container  doctors-more">
            <div class="container position-relative">
                <div class="overlay-background w-50"></div>
                <div class="overlay-background-logo">
                    <img src="frontend/images/logo-shape.svg" alt="doctor" draggable="false" />
                </div>
                <div class="section-title align-items-stretch mb-0">
                    <h2 class="title" data-aos="fade-up">الأطباء</h2>

                </div>
                <div class="services__tabs" data-aos="fade-up">
                    <div class="tab-content" id="doctorsTabContent">
                        <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="dental-tab">
                            <div class="swiper doctorsSlider">
                                <div class="swiper-wrapper">

                                    @foreach ($doctors as $item)

                                    <div class="swiper-slide">
                                        <div class="doctor">

                                            <div class="doctor__image">
                                                <img src="{{asset('images').'/'.$item->image}}" alt="دنيا _ اخصائية الجلدية و التجميل. الليزر " draggable="false" loading="lazy">
                                            </div>
                                            <div class="doctor__text">
                                                <h3 class="h6">{{$item->department_name}}</h3>
                                                <p>{{$item->name_ar}}</p>

                                            </div>
                                        </div>
                                    </div>
                                    @endforeach


                                </div>
                                <div class="section-pagination">
                                    <div class="doctors-pagination"></div>
                                </div>
                                <div class="slider-controls">
                                    <div class="swiper-button-next doctors-next"></div>
                                    <div class="swiper-button-prev doctors-prev"></div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>


            </div>
            <button type="submit" class="btn btn-primary"><a href="{{route('doctors')}}">أكثر</a> </button>
        </div>
    </section>




    <div class="container mt-50 mb-50">
        <div class="section-title align-items-stretch mb-0">
            <h2 class="title" data-aos="fade-up">الشكاوى وتقييم الزيارة</h2>
            <!-- <h1></h1> -->
        </div>
        <form action="submit_complaint.php" method="post">
            <div class="form-group">
                <label for="name">اسم:</label>
                <input type="text" id="name" placeholder="اسم" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="number">رقم:</label>
                <input type="text" id="number" name="number" placeholder="رقم" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="branch">فرع:</label>
                <input type="text" id="branch" name="branch" placeholder="فرع" class="form-control">
            </div>
            <div class="form-group">
                <label for="message">رسالة:</label>
                <textarea id="message" name="message" placeholder="رسالة" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary"> يُقدِّم</button>
        </form>


        <div class="banner text-center">
            <h1 class="banner-h1">Installment Service</h1>
            <!-- <p>Take advantage of our installment service to make your purchases more manageable.</p> -->
            <button type="submit" class="btn btn-primary"> كتامدخ طسق</button>
        </div>
    </div>


    <!-- BEGIN :: insurance section -->
    <section class="insurance d-pad pt-0">
        <div class="container position-relative">
            <div class="overlay-background"></div>
            <div class="section-title mb-0">
                <h2 class="title" data-aos="fade-up">شركات التؤمٌن</h2>
            </div>
            <div class="swiper insuranceSlider" data-aos="fade-up">
                <div class="swiper-wrapper">
                @foreach ($insurance as $item)
                    <div class="swiper-slide">
                        <div class="company">
                            <img src="{{asset('images').'/'.$item->image}}" draggable="false" alt="{{$item->insurance_ar}}" loading="lazy">
                        </div>
                    </div>
                @endforeach
                </div>
                <div class="section-pagination">
                    <div class="insurance-pagination"></div>
                </div>
                <div class="slider-controls">
                    <div class="swiper-button-next insurance-next"></div>
                    <div class="swiper-button-prev insurance-prev"></div>
                </div>
            </div>
        </div>
    </section>



    <!-- BEGIN :: insurance section -->
    <section class="insurance d-pad pt-0">
        <div class="container position-relative">
            <div class="overlay-background"></div>
            <div class="section-title mb-0">
                <h2 class="title" data-aos="fade-up">شركاءنا</h2>
            </div>
            <div class="swiper insuranceSlider" data-aos="fade-up">
                <div class="swiper-wrapper">
                   @foreach ($partner as $item)
                    <div class="swiper-slide">
                        <div class="company">
                            <img src="{{asset('images').'/'.$item->image}}"  draggable="false" alt="nextcare" loading="lazy">
                        </div>
                    </div>
                   @endforeach

                </div>
                <div class="section-pagination">
                    <div class="insurance-pagination"></div>
                </div>
                <div class="slider-controls">
                    <div class="swiper-button-next insurance-next"></div>
                    <div class="swiper-button-prev insurance-prev"></div>
                </div>
            </div>
        </div>
    </section>
    @endsection