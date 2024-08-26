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
            <button type="submit" class="btn btn-primary"><a href="offer.php">أكثر</a> </button>
        </div>
    </section>
    @endsection