<?php include('header.php'); ?>
<body>
    <div class="slideshow">
        <div class="mySlides">
            <img src="images/slide_1.jpg" width="100%" height="100%">
            <div class="caption_text">Eat Healthy, Stay Healthy</div>
        </div>
        <div class="mySlides">
            <img src="images/slide_2.jpg" width="100%" height="100%">
            <div class="caption_text">Eat healthy with us</div>
        </div>
        <div class="mySlides">
            <img src="images/slide_3.jpg" width="100%" height="100%">
            <div class="caption_text">Share a bowl</div>
        </div>
        <a class="previous" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>    
    <br>
    <div style="text-align:center;">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>
    <div class="postings">
        <div class="post1">
            <div class="post_img">
                <img src="images/home1.jpg">
            </div>
            <div class="post_desc">
                <h2>We are open for suggestions!</h2>
                <p>Do you have any favourite toppings you would like to have? Tell us more about it! Your favourite toppings may appear in our healthy bowl!</p>
                <button onclick="contactPage()">Tell us about it</button>
            </div>
        </div>
    </div>
    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }
            
        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";  
            dots[slideIndex-1].className += " active";
        }

        function contactPage() {
            window.location="contactUs.php";
        }
    </script>
</body>