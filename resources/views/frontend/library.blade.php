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
                                            <h3 class="h6">{{$item->title}}</h3>
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
