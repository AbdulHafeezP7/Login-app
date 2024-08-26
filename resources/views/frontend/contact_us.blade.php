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