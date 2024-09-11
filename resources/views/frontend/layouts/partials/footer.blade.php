<!-- BEGIN :: footer section -->
<footer class="footer brd-top-rad">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="footer__logo aos-init aos-animate" data-aos="fade-up">
                    <a class="navbar-brand" href="index.php">
                        <img src="{{ asset('frontend/frontend/images/logo12.png')}}" alt="logo">
                    </a>
                </div>
            </div>


            <div class="col-md-9 align-items-center header position-relative col-12">
                <div class="top-bar__container align-items-center w-100">
                    <div class="top-bar__block social">
                        <ul class="list-inline d-flex flex-row-reverse">



                            <li class="list-inline-item">
                                <a href="https://www.instagram.com/dr.kalruhaimi/" target="_blank" title="Instagram">
                                    <div class="top-bar__icon">
                                        <img src="{{ asset('frontend/frontend/images/icons/social/instagram-svg.png')}}" draggable="false" alt="instagram" class="socialmedia-icon" loading="lazy">
                                    </div>
                                </a>
                            </li>




                            <li class="list-inline-item">
                                <a href="#" target="_blank" title="Tik Tok">
                                    <div class="top-bar__icon">
                                        <i class="fa-brands fa-tiktok"></i>
                                    </div>
                                </a>
                            </li>



                            <li class="list-inline-item">
                                <a href="https://t.snapchat.com/8jM6vxbU" target="_blank" title="snapchat">
                                    <div class="top-bar__icon">
                                        <img src="{{ asset('frontend/frontend/images/icons/social/snapchat.png')}}" draggable="false" alt="snapchat" class="socialmedia-icon" loading="lazy">
                                    </div>
                                </a>
                            </li>


                            <li class="list-inline-item">
                                <a href="https://twitter.com/drkalruhaimi" target="_blank" title="Twitter">
                                    <div class="top-bar__icon">
                                        <img src="{{ asset('frontend/frontend/images/icons/social/twitter-svg.png')}}" draggable="false" alt="Twitter" class="socialmedia-icon" loading="lazy">
                                    </div>
                                </a>
                            </li>




                            <li class="list-inline-item">
                                <a href="#" target="_blank" title="Youtube">
                                    <div class="top-bar__icon">
                                        <i class="fa-brands fa-youtube"></i>
                                    </div>
                                </a>
                            </li>





                        </ul>
                    </div>
                </div>
                <div class="top-bar__container align-items-center w-100">
                    <div class="top-bar__block social">
                        <div class="footer__logo aos-init aos-animate" data-aos="fade-up">
                            <h1 style="
    text-align: end;
"><a href="tel:+966920010436">+966920010436</a></h1>
                            <p>Location :4876 Imam Ali Bin Abi Taleb St. Al Rayan Dist, 32256 Dammam,Saudi Arabia</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-7 col-12">
                <div class="footer__list-container">
                    <div class="footer__list aos-init aos-animate" data-aos="fade-up">
                        <div class="footerHead">الوصول السريع :</div>
                        <ul class="list-unstyled">
                            <li><a href="{{route('home')}}">الرئيسية</a></li>
                            <li><a href="{{route('about')}}">نبذة عنا</a></li>
                            <li><a href="{{route('doctors')}}">الأطباء</a></li>

                        </ul>
                    </div>

                    <div class="footer__list aos-init aos-animate" data-aos="fade-up">
                        <div class="footerHead">الخدمات :</div>
                        <ul class="list-unstyled">
                            
                           
                        </ul>
                    </div>

                    <div class="footer__list aos-init aos-animate" data-aos="fade-up">
                        <div class="footerHead">الإتصال بنا :</div>
                        <ul class="list-unstyled">
                            <!--<li><a href="">الوظائف</a></li>-->
                            <li><a href="{{route('contact_us')}}">الإتصال بنا</a></li>
                            <li><a href="{{route('privacy_policy')}}">سياسة الخصوصية</a></li>
                        </ul>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <div class="footer__copyrights text-center">
        <div class="container">
            <div class="row">
                <div class="col-10 d-flex justify-content-start align-items-center">
                    <small>حقوق النشر محفوظة لمستشفى د. خالد الرحيمي 2024</small>

                </div>
                <div class="col-2">
                    <a href="#top" class="footer__icon top" aria-label="Move to Top"><img src="{{ asset('frontend/frontend/images/icons/arrow-top.svg')}}" alt="top" /></a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- END :: footer section -->
</div>


<div class="modal fade" id="booking" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="post.php" method="post">
        <div class="modal-dialog" role="document">
            <!-- <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">   احجز الآن </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
        
      <div class="modal-body">
          <div class="form-group">
            <label for="name" class="col-form-label">الاسم  :</label>
            <input type="text" class="form-control" name="name">
          </div>
          <div class="form-group">
            <label for="Service" class="col-form-label">   نوع الخدمة   :</label>
           <select class="form-control show-tick" id="service" name="service" tabindex="-98">
           <option value="قسم الجراحة العامة">قسم الجراحة العامة</option>
    <option value="قسم جراحة التجميل">قسم جراحة التجميل</option>
    <option value="قسم جراحة اليد">قسم جراحة اليد</option>
    <option value="قسم الجلدية والليزر">قسم الجلدية والليزر</option>
    <option value="قسم الأسنان">قسم الأسنان</option>
    <option value="قسم العيون">قسم العيون</option>
    <option value="قسم النساء والولادة">قسم النساء والولادة</option>
    <option value="قسم الطوارئ">قسم الطوارئ</option>
    <option value="قسم الأشعة">قسم الأشعة</option>
    <option value="قسم المختبرات">قسم المختبرات</option>
    <option value="قسم المسالك البولية">قسم المسالك البولية</option>
    <option value="قسم اضطرابات نوم">قسم اضطرابات نوم</option>
    <option value="قسم التخدير">قسم التخدير</option>
    <option value="قسم جراحة ترميم الثدي">قسم جراحة ترميم الثدي</option>
    <option value="قسم العلاج الطبيعي">قسم العلاج الطبيعي</option>
    <option value="قسم الرعاية المنزلية">قسم الرعاية المنزلية</option>
    <option value="قسم الأطفال">قسم الأطفال</option>
                                                                          </select>
          </div>
          <div class="form-group">
            <label for="mobile" class="col-form-label">   رقم الجوال  :</label>
            <input type="text" class="form-control" name="mobile">
          </div>
       
      </div>
      <div class="modal-footer" style="
    display: contents;
">
         <center>     <input type="submit" class="btn btn-primary" value="احجز الآن" >   </center>
      </div>
      
    </div> -->

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">احجز الآن</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="col-form-label">الاسم :</label>
                        <input type="text" class="form-control" name="name">
                    </div>

                    <div class="form-group">
                        <label for="branch" class="col-form-label">بسانملا عرفلا رتخا :</label>
                        <select class="form-control show-tick" id="branch" name="branch" tabindex="-98">
                            <option value="فرع 1">فرع 1</option>
                            <option value="فرع 2">فرع 2</option>
                            <option value="فرع 3">فرع 3</option>
                            <option value="فرع 4">فرع 4</option>
                            <option value="فرع 5">فرع 5</option>
                            <option value="فرع 6">فرع 6</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="service" class="col-form-label">نوع الخدمة :</label>
                        <select class="form-control show-tick" id="service" name="service" tabindex="-98">
                            <option value="قسم الجراحة العامة">قسم الجراحة العامة</option>
                            <option value="قسم جراحة التجميل">قسم جراحة التجميل</option>
                            <option value="قسم جراحة اليد">قسم جراحة اليد</option>
                            <option value="قسم الجلدية والليزر">قسم الجلدية والليزر</option>
                            <option value="قسم الأسنان">قسم الأسنان</option>
                            <option value="قسم العيون">قسم العيون</option>
                            <option value="قسم النساء والولادة">قسم النساء والولادة</option>
                            <option value="قسم الطوارئ">قسم الطوارئ</option>
                            <option value="قسم الأشعة">قسم الأشعة</option>
                            <option value="قسم المختبرات">قسم المختبرات</option>
                            <option value="قسم المسالك البولية">قسم المسالك البولية</option>
                            <option value="قسم اضطرابات نوم">قسم اضطرابات نوم</option>
                            <option value="قسم التخدير">قسم التخدير</option>
                            <option value="قسم جراحة ترميم الثدي">قسم جراحة ترميم الثدي</option>
                            <option value="قسم العلاج الطبيعي">قسم العلاج الطبيعي</option>
                            <option value="قسم الرعاية المنزلية">قسم الرعاية المنزلية</option>
                            <option value="قسم الأطفال">قسم الأطفال</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="mobile" class="col-form-label">رقم الجوال :</label>
                        <input type="text" class="form-control" name="mobile">
                    </div>
                </div>

                <div class="modal-footer" style="display: contents;">
                    <center>
                        <input type="submit" class="btn btn-primary" value="احجز الآن">
                    </center>
                </div>
            </div>

        </div>
    </form>
</div>

<a href="tel:+966920010436" style="position:fixed;bottom:16px;left:16px;height: 56px;width: 56px;background-color:#2ecc71;border-radius:50%;padding: 16px;box-shadow: 0 0 40px #d7d7d7;z-index:9999999;">
    <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 100 125" x="0px" y="0px" fill="#fff">
        <title>Call Us</title>
        <path d="M99.76,78.85a7.18,7.18,0,0,1-.81,2A59,59,0,0,1,88.68,93.38,34.07,34.07,0,0,1,84.93,96l-3,.19c-1.45-.19-2.91-.32-4.35-.58a59.42,59.42,0,0,1-18.22-7C49.67,83.17,41,76.39,32.69,69.08A155.55,155.55,0,0,1,11.9,47.4C7.63,41.84,3.87,36,1.59,29.3c-.56-1.65-.94-3.36-1.4-5l-.19-3c1.27-3.79,3.83-6.71,6.52-9.52,2-2.06,4.05-4,6.16-5.92A7.34,7.34,0,0,1,19.22,4,5.16,5.16,0,0,1,22.58,6c4.3,5.7,8.55,11.44,13,17.05a7.61,7.61,0,0,1,1.1,8c-.54,1.43-1.25,2.8-1.91,4.19-.76,1.61-1.51,3.23-2.34,4.8a1.15,1.15,0,0,0,.18,1.56c3,3.07,5.86,6.28,9,9.23A140.55,140.55,0,0,0,60.29,66.09a1.57,1.57,0,0,0,2.06,0c2.43-1.66,4.9-3.25,7.4-4.81a8.44,8.44,0,0,1,6-1.48,5.52,5.52,0,0,1,1.84.64q9.91,5.65,19.8,11.36C99.51,73,100.5,76,99.76,78.85Z" />
    </svg>
</a>

<script async src='https://d2mpatx37cqexb.cloudfront.net/delightchat-whatsapp-widget/embeds/embed.min.js'></script>
<script>
    var wa_btnSetting = {
        "btnColor": "#16BE45",
        "ctaText": "",
        "cornerRadius": 40,
        "marginBottom": 20,
        "marginLeft": 20,
        "marginRight": 20,
        "btnPosition": "right",
        "whatsAppNumber": "966920010436",
        "welcomeMessage": "Hello",
        "zIndex": 999999,
        "btnColorScheme": "light"
    };
    window.onload = () => {
        _waEmbed(wa_btnSetting);
    };
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script src="{{ asset('frontend/frontend/js/buildHome.js')}}"></script>
<script type='text/javascript'>
    function validateSubContact(tel) {
        var xyz = document.getElementById('subscribeForm').value.trim();
        var phoneno = /^\d{10}$/;
        if ((tel.value.match(phoneno)) && tel.value.length == 10 && xyz.substr(0, 2) === '05' && $.isNumeric(xyz)) {
            $(tel).removeClass('is-invalid');
            $(tel).addClass('is-valid');
        } else {
            $("#subscribeForm").val('');
            $(tel).removeClass('is-valid');
            $(tel).addClass('is-invalid');
        }
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const boxes = document.querySelectorAll('.features-one__box');
        const modals = document.querySelectorAll('.modals');
        const closeButtons = document.querySelectorAll('.close');

        // Open modal when a box is clicked
        boxes.forEach((box) => {
            box.addEventListener('click', () => {
                const modalsId = box.getAttribute('data-modals');
                const modals = document.getElementById(modalsId);
                if (modals) {
                    modals.style.display = 'block';
                }
            });
        });

        // Close modal when the close button is clicked
        closeButtons.forEach((button) => {
            button.addEventListener('click', () => {
                const modalsId = button.getAttribute('data-modals');
                const modals = document.getElementById(modalsId);
                if (modals) {
                    modals.style.display = 'none';
                }
            });
        });

        // Close modal when clicking outside of the modal content
        window.addEventListener('click', (event) => {
            if (event.target.classList.contains('modals')) {
                event.target.style.display = 'none';
            }
        });
    });
</script>
</body>

</html>