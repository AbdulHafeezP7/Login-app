@extends('frontend.layouts.FrontendLayout')
@section('title', 'Dashborad')
@section('content')
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
                                            <a href="{{route('home')}}" property="item" typeof="WebPage">
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



    <option value="جذعية + تنظيف بشره يدوي 594 ريال">جذعية + تنظيف بشره يدوي 594 ريال</option>
    <option value="ديرما بن + ميوز ثيرابي 294 ريال">ديرما بن + ميوز ثيرابي 294 ريال</option>
    <option value="تشقير الوجهه 125 ريال">تشقير الوجهه 125 ريال</option>
    <option value="تشقير الوجهه وليزر كربوني 250 ريال">تشقير الوجهه وليزر كربوني 250 ريال</option>
    <option value="تبيض الاسنان 450 ريال">تبيض الاسنان 450 ريال</option>
    <option value="بلازما + ميزوثيرابي 1194 ريال ( وجه او شعر )">بلازما + ميزوثيرابي 1194 ريال ( وجه او شعر )</option>
    <option value="فيلر جزلين مع ميزو 1194 ريال">فيلر جزلين مع ميزو 1194 ريال</option>
    <option value="بروفايلو + ديرما بن 994 ريال">بروفايلو + ديرما بن 994 ريال</option>
    <option value="نضارة ملكية + ميزو 1694 ريال">نضارة ملكية + ميزو 1694 ريال</option>
    <option value="ابرة النضارة بلوريال بوستر 794 ريال">ابرة النضارة بلوريال بوستر 794 ريال</option>
    <option value="3 جلسات ليزر فل بدي مع رتوش + تشقير وجهه مجانا 894 ريال">3 جلسات ليزر فل بدي مع رتوش + تشقير وجهه مجانا 894 ريال</option>
    <option value="تنظيف بشرة مع الماسك + تنظيف اسنان وإزالة الرواسب الجيرية 394 ريال">تنظيف بشرة مع الماسك + تنظيف اسنان وإزالة الرواسب الجيرية 394 ريال</option>
    <option value="تشقير وجهه + تشقير حواجب + ديرما بن وميزو نظارة 494 ريال">تشقير وجهه + تشقير حواجب + ديرما بن وميزو نظارة 494 ريال</option>
    <option value="انوفيال + ميزوثيرابي 494 ريال">انوفيال + ميزوثيرابي 494 ريال</option>

    <!-- عروض د. عذاري -->
    <optgroup label="عروض د. عذاري">
    <option value="عرض القلو اند شاين 1794 ريال">عرض القلو اند شاين 1794 ريال</option>
    <option value="عرض كولاجين شاور 3694 ريال">عرض كولاجين شاور 3694 ريال</option>
    <option value="عرض التعرق 1794 ريال">عرض التعرق 1794 ريال</option>
    <option value="ابرة الجوري 1 مل 1594 ريال">ابرة الجوري 1 مل 1594 ريال</option>
    <option value="عرض خلها تبرق وترعد 794 ريال">عرض خلها تبرق وترعد 794 ريال</option>
</optgroup>
    <!-- عروض الدكتور محمد درويش -->
    <optgroup label="عروض الدكتور محمد درويش">
    <option value="التركيبة عليك والمعالجة علينا">التركيبة عليك والمعالجة علينا</option>
    <option value="الابتسامة عليك والمعالجة علينا">الابتسامة عليك والمعالجة علينا</option>
</optgroup>
    <!-- عروض الدكتورة نوف -->
    <optgroup label="عروض الدكتورة نوف">
    <option value="حشوات الاسنان لسن واحد 194 ريال">حشوات الاسنان لسن واحد 194 ريال</option>
    <option value="حشوتين 300 ريال">حشوتين 300 ريال</option>
    <option value="التبييض الامن بدون ليزر 199 ريال">التبييض الامن بدون ليزر 199 ريال</option>
    </optgroup>
    <!-- عروض الرجال -->

    <optgroup label="عروض الرجال ">
    <option value="12 جلسه ليزر لمنطقة واحدة لمدة سنة واحدة 894 ريال">12 جلسه ليزر لمنطقة واحدة لمدة سنة واحدة 894 ريال</option>
    <option value="2 جلسة ليزر لمنطقتين مع رتوش 394 ريال">2 جلسة ليزر لمنطقتين مع رتوش 394 ريال</option>
    <option value="3 جلسات بكيني رجال مع رتوش 300 ريال">3 جلسات بكيني رجال مع رتوش 300 ريال</option>
    </optgroup>


    <!-- BEGIN :: page content section -->
    <div class="page-content contact d-pad pb-0">
        <div class="container">


        <div class="row">
                    <div class="col-12">
                        <h2 class="title about__title mb-5" data-aos="fade-up" data-aos-delay="100">مواقع التواصل الاجتماعي</h2>
                    </div>

                    <div class="col-md-4 col-12 mb-5">
                        <div class="contact__blocks">
                          
                        
                            <div class="contact__info mb-4">
                            <ul class="list-inline d-flex flex-row-reverse">
                                                                            <li class="list-inline-item">
                                            <!-- <a href="https://web.facebook.com/saswisscc" target="_blank" title="Facebook">
                                                <div class="top-bar__icon">
                                                    <img src="frontend/images/icons/social/facebook-svg.svg" draggable="false" alt="facebook">
                                                </div>
                                            </a>
                                        </li>
-->
                                        <li class="list-inline-item"  style="
    border-style: solid;
    border-radius: 48px;
    border-color: #b27087;
">
                                            <a href="https://twitter.com/drkalruhaimi" target="_blank" title="Twitter">
                                                <div class="top-bar__icon">
                                                    <img src="{{ asset('frontend/frontend/images/icons/social/twitter-svg.png')}}" draggable="false" alt="Twitter" class="socialmedia-icon">
                                                </div>
                                            </a>
                                        </li> 
                                    
                                                                            <li class="list-inline-item" style="
    border-style: solid;
    border-radius: 48px;
    border-color: #b27087;
">
                                            <a href="https://www.instagram.com/dr.kalruhaimi/" target="_blank" title="Instagram" >
                                                <div class="top-bar__icon">
                                                    <img src="{{ asset('frontend/frontend/images/icons/social/instagram-svg.png')}}" draggable="false" alt="instagram" class="socialmedia-icon">
                                                </div>
                                            </a>
                                        </li>
                                    
                                    

                                                                            <li class="list-inline-item" style="
    border-style: solid;
    border-radius: 48px;
    border-color: #b27087;
">
                                            <a href="https://wa.me/+966920010436" target="_blank" title="Whasapp">
                                                <div class="top-bar__icon">
                                                    <img src="{{ asset('frontend/frontend/images/icons/social/whatsapp-svg.png')}}" draggable="false" alt="Whasapp" class="socialmedia-icon" >
                                                </div>
                                            </a>
                                        </li>

                                        
                                        <li class="list-inline-item" style="
    border-style: solid;
    border-radius: 48px;
    border-color: #b27087;
">
                                            <a href="https://t.snapchat.com/8jM6vxbU" target="_blank" title="snapchat">
                                                <div class="top-bar__icon">
                                                    <img src="{{ asset('frontend/frontend/images/icons/social/snapchat.png')}}" draggable="false" alt="snapchat" class="socialmedia-icon" >
                                                </div>
                                            </a>
                                        </li>
                                    
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
             
                <div class="row">
                    <div class="col-12">
                        <h2 class="title about__title mb-5" data-aos="fade-up" data-aos-delay="100">فروعنا </h2>
                    </div>
              
                    <div class="col-md-4 col-12 mb-5">
                        <div class="contact__blocks">
                            <div class="form-group row d-flex align-items-center">
                                <label for="bookName" class="col-lg-6 col-form-label">مدير الفرع</label>
                                <div class="col-lg-6">
                               
                                    {{$branchDetails->branchmanager_name}}
                                                                    </div>
                            </div>

                            <div class="form-group row d-flex align-items-center">
                                <label for="bookName" class="col-lg-6 col-form-label">رقم مدير الفرع</label>
                                <div class="col-lg-6">
                               
                                    {{$branchDetails->branchmanager_number}}
                                                                    </div>
                            </div>
                          
                            <div class="contact__info mb-4">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="{{$branchDetails->branch_location}}" class="d-flex align-items-center">
                                            <div>
                                                <img src="{{ asset('frontend/frontend/images/icons/location-svg.svg')}}" draggable="false" alt="alt">
                                            </div>
                                            <div class="mx-3">{{$branchDetails->branchname_ar}}</div>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </div>
                          
                            
                        </div>
                    </div>
                
                   

            
                    
                    

                    <div class="col-12 mb-5">
                        <h5 class="h5 mb-4" data-aos="fade-up" data-aos-delay="100">البيانات الشخصية</h5>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="book__block aos-init aos-animate" data-aos="fade-up">
                            <div class="form-group row d-flex align-items-center">
                                <label for="contactName" class="col-lg-3 col-form-label">الاسم بالكامل</label>
                                <div class="col-lg-9">
                                    <input type="text"
                                           class="form-control form-control-secondary"
                                           id="contactName"
                                           name="name"
                                           value=""
                                           placeholder="الاسم بالكامل" />

                                                                    </div>
                            </div>

                            <div class="form-group row d-flex align-items-center">
                                <label for="contactPhone" class="col-lg-3 col-form-label">رقم الجوال</label>
                                <div class="col-lg-9">
                                    <input type="tel"
                                           class="form-control form-control-secondary"
                                           name="phone"
                                           value=""
                                           id="contactPhone"
                                           placeholder="رقم الجوال" />

                                                                    </div>
                            </div>

                            <div class="form-group row d-flex align-items-center">
                                <label for="contactMail" class="col-lg-3 col-form-label">البريد الإلكتروني</label>
                                <div class="col-lg-9">
                                    <input type="email"
                                           name="email"
                                           value=""
                                           class="form-control form-control-secondary"
                                           id="contactMail"
                                           placeholder="البريد الإلكتروني" />

                                                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="book__block aos-init aos-animate" data-aos="fade-up">
                            <div class="form-group row d-flex align-items-center">
                                <label for="contactSubject" class="col-lg-3 col-form-label">الموضوع</label>
                                <div class="col-lg-9">
                                    <input type="text"
                                           name="subject"
                                           value=""
                                           class="form-control form-control-secondary"
                                           id="contactSubject"
                                           placeholder="الموضوع" />

                                                                    </div>
                            </div>

                            <div class="form-group row d-flex align-items-center">
                                <label for="bookName" class="col-lg-3 col-form-label">رسالتك</label>
                                <div class="col-lg-9">
                                    <textarea class="form-control form-control-secondary"
                                              name="content"
                                              id="contactMessage"
                                              placeholder="محتوى الرسالة"></textarea>

                                                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 my-5">
                        <center>
                        <button class="btn btn-brand-primary btn-mobile-full" data-aos="fade-up">
                            أرسل رسالتك                        </button>
                             </center>
                    </div>

                  
                </div>
            </form>
        </div>
    </div>
    <!-- END ::  page content section -->
@endsection
