<?php
session_start(); // Start the session if not already started

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $buttonText = "Logout";
    $buttonLink = "logout.php"; 
} else {
    $buttonText = "Register";
    // Check if refer_code is set in the URL
    if (isset($_GET['refer_code'])) {
        $buttonLink = "register.php?refer_code=" . $_GET['refer_code'];
    } else {
        $buttonLink = "register.php";
    }
}
?>

 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXTGEN COURSES</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <style>
        /* Hide the spinner */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
          -webkit-appearance: none;
          margin: 0;
        }
       
        body {
            margin: 0;
            padding: 0;
        }
        
        .dropdown-menu {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    top: 20%;
}

        .dropdown-menu a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-menu a:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
<!---home--> 
<section id="home" class="py-5">
    <div class="container">
        <div class="text-center">
            <h4>NextGen</h4>
            <p>Building Your Future</p>
            <p1>With career Building Course</p1>
        </div>
        <p4><a href="information.php" style="color: black; text-decoration: none;">FAQ</a></p4>
        <h3><a href="<?php echo $buttonLink; ?>" style="color: black; text-decoration: none;"><?php echo $buttonText; ?></a></h3>
        <h5><a href="profile.php" style="color: black; text-decoration: none;">Profile</a></h5>

        
        <img src="profile.jpeg" data-aos="fade-up" class="img-fluid">
        <div class="paragraph">
        <h1>About us</h1> 
        <p1> Welcome to NextGen, your trusted partner in career building and online earning opportunities! For four years, we've been dedicated to empowering individuals to kickstart their online journey and unleash their potential in the digital realm.

            At NextGen, we understand the evolving landscape  of career development and the increasing demand for diverse skill sets. That's why we offer a range of cutting-edge courses designed to equip you with the knowledge and skills needed to thrive in the digital age.<a href="about.html"><button type="button" class="btn btn-primary">More Info</button></a></p1>
    </div>
</div>
</section>
<!---home-end--> 
<!---course--> 
<section id="course" class="py-5">
    <div class="container">
        <div class="text-center" style="text-decoration: underline;">
            <h4>Course Details</h4>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="container-fluid" style="background: linear-gradient(to right, #fef3b1, #fed5cf, #ffb1f2);">
            <div class="row justify-content-center">
                <div class="col-md-4 mb-3">
                    <div class="card text-center" style="background: none;">
                        <img class="card-img-top mx-auto" src="https://png.pngtree.com/png-vector/20230318/ourmid/pngtree-book-clipart-vector-png-image_6653535.png" alt="Card image cap" style="width: 80%; height: auto;">
                        <div class="card-body">
                            <h3 class="card-title" style="font-weight: bold;">Ecommerce Business</h3><p>(Free Website)</p>
                            <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                            <button class="text-black p-2 " style="margin-bottom: 0; font-weight:bold; font-size:18px;  background-color:#424dfd; color:white; border-radius:10px;">₹ 9999/-</button>
                            <?php
                        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                            // User is logged in
                           
                            echo "<a href='https://slveenterprises.org/product/30879586/--ZERO-INVESTMENT--E-Commerce-Business-Course-With-Free-Website' class='btn btn-success' style='border-radius:10px;  font-size:20px;'>Pay</a>";
                        } else {
                            // User is not logged in
                            echo "<button class='btn btn-secondary' disabled style='border-radius:10px;  font-size:20px;'>Pay</button>";
                        }
                        ?>
                        </div>
                        <br>
                            <a href="register.php"  class="btn btn-success" style="border-radius:18px;">Enroll</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!--<section id="demand" class="py-5">
    <div class="container">
        <div class="row">
            <div class="text-center">
                <h4>Print on Demand</h4>
                <p>What You Learn - How You Earn</p>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <img src="https://png.pngtree.com/png-vector/20220707/ourmid/pngtree-t-shirt-print-on-demand-services-png-image_5741452.png" data-aos="fade-up"  class="img-fluid">
              </div>
            <div class="col-lg-6">
            <br>
<p1 style="color: white;"><strong>*Course Title : </strong>*Print On Demand Course</p1>
<br>
<p1 style="color: white;"><strong>*Course Fee : </strong>* Rs 1999</p1>
<br>
<p1 style="color: white;"><strong>*Duration : </strong>*2 Days</p1>
<br><br>
<p1 style="color: white;"><strong>*Course content* :</strong></p1>
<br><br>
<p1 style="color: white;"><strong>1.*How To Design T-Shirts*</strong></p1>
<ul>
    <li style="color: white;">Learn fundamental design principles</li>
    <li style="color: white;">Hands-on practice with design tools</li>
</ul>
<p1 style="color: white;"><strong>2.*Market Trends and Attractive Designing Skills*</strong></p1>
<ul>
    <li style="color: white;">Explore current market trends</li>
    <li style="color: white;">Develop eye-catching design techniques</li>
</ul>
<p1 style="color: white;"><strong>3.*Product Placement and Commission Earnings*</strong></p1>
<ul>
    <li style="color: white;">Post your designed products on our website</li>
    <li style="color: white;">Earn commission for each successful sale</li>
</ul>
<p1 style="color: white;"><strong>4.*Universal Platforms for Design Posting*</strong></p1>
<ul>
    <li style="color: white;">Identify popular platforms to showcase your designs</li>
    <li style="color: white;">Maximize exposure and sales opportunities</li>
</ul>
<p1 style="color: white;"><strong>5.*Referral Bonus Opportunities*</strong></p1>
<ul>
    <li style="color: white;">Earn up to 40% referral bonus on course charges</li>
    <li style="color: white;">Encourage others to enroll and benefit from your referral</li>
</ul>

                    <h5><a href="demand.html"><button type="button" class="btn btn-primary">More Info</button></a></h5>
            </div>
        </div>
    </div>
</section>
<section id="Marketing" class="py-5">
    <div class="container">
        <div class="row">
            <div class="text-center">
                <h4>Digital Marketing</h4>
                <p>What You Learn - How You Earn</p>
            </div>
            <div class="col-lg-6">
                <br>
            <p1 style="color: white;"><strong>*Course Title : </strong>*NextGen Digital Marketing Course</p1>
<br>
<p1 style="color: white;"><strong>*Course Fee : </strong>*Rs 4999</p1>
<br>
<p1 style="color: white;"><strong>*Duration : </strong>*4 Days</p1>
<br><br>
<p1 style="color: white;"><strong>*Course Details:*:</strong></p1>
<br><br>
<p1 style="color: white;"><strong>1.*Digital Marketing Fundamentals*</strong></p1>
<ul>
    <li style="color: white;">Explore core concepts of digital marketing</li>
    <li style="color: white;">Understand the digital landscape and its components</li>
</ul>
<p1 style="color: white;"><strong>2.*Social Media Marketing*</strong></p1>
<ul>
    <li style="color: white;">Strategies for effective social media campaigns</li>
    <li style="color: white;">Utilize major social platforms for marketing</li>
</ul>
<p1 style="color: white;"><strong>3.*Search Engine Optimization (SEO)*</strong></p1>
<ul>
    <li style="color: white;">Learn SEO techniques for better website visibility</li>
    <li style="color: white;">Understand keyword optimization and on-page SEO</li>
</ul>
<p1 style="color: white;"><strong>4.*Email Marketing*</strong></p1>
<ul>
    <li style="color: white;">Create engaging email campaigns</li>
    <li style="color: white;">Utilize email marketing tools and analytics</li>
</ul>
<p1 style="color: white;"><strong>5.*Refer Bonus Incentives*</strong></p1>
<ul>
    <li style="color: white;">Earn up to 40% referral bonus for course recommendations</li>
    <li style="color: white;">Encourage others to join and benefit from the course</li>
</ul>

                <h5> <a href="digital.html"><button type="button" class="btn btn-primary">More Info</button></a></h5>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <img src="https://freepngimg.com/save/24871-marketing-transparent-image/501x393" data-aos="fade-up"  class="img-fluid">
          </div>
        </div>
    </div>
</section>-->
<section id="Business" class="py-5">
    <div class="container">
        <div class="row">
            <div class="text-center">
                <h4>Own Business - Ecommerce</h4>
                <p>What You Learn - How You Earn</p>
            </div>
              <div class="col-lg-6 col-md-6 col-12">
                <img src="https://freepngimg.com/save/15307-online-marketing-transparent/500x408" data-aos="fade-up"  class="img-fluid">
              </div>
            <div class="col-lg-6">
                <br>
            <strong> 🌟 Welcome to Nextgen 🌟</strong>
            <br>
    <p>Start your <strong> Zero Investment</strong>  E-commerce Business With NextGen.</p>
    <strong>Get six courses which make your e-commerce business successful:</strong>
    <ol>
        <li>E-commerce Course</li>
        <li>Dropshipping Course</li>
        <li>Reselling Course</li>
        <li>Print on Demand</li>
        <li>Affiliate Marketing</li>
        <li>Digital Marketing</li>
    </ol>
    <p>These 6 courses provide opportunities for multiple earning ways.</p>
    <strong>Get a Free Website To Start Your Business, Immediately After Learning The Insights Of E-commerce Business.</strong>
    <br>
    <br>
    <p>Unmatchable features provided in the website, which competitors charge ₹25,000 and above.</p>
    <strong>Our Website Features:</strong>
    <ol>
        <li>Free Business Domain</li>
        <li>Free Hosting</li>
        <li>Themes</li>
        <li>Add Unlimited Categories</li>
        <li>Add Unlimited Products</li>
        <li>WhatsApp Integration to Chat with Your Customers</li>
        <li>Payment Gateway Integration with <strong>Zero Service Charges & Instant Settlement </strong></li>
    </ol>
    <p><strong>Get this complete package at just ₹9,999 </strong>(Originally priced at ₹21,999).</p>
    <p>The competitor's price for this package is ₹35,000 and above.</p>
    <p><strong>Kickstart your E-commerce business with NextGen. Achieve financial freedom!</strong></p>
            </div>
        </div>
    </div>
    <br>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3"> <!-- Offset added to center the column -->
                    <div class="text-center">
                        <h4>Own Business - Ecommerce</h4>
                        <p1 style="color:red;">What You Learn - How You Earn</p1>
                    </div>
                    <div class="embed-responsive embed-responsive-16by9" data-aos="fade-up">
                        <iframe class="embed-responsive-item" width="100%" height="315" src="https://www.youtube.com/embed/ZqChUO_NMtI?si=hesYzc3_9vKzHioW" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
</section>
<section id="ready" class="py-5">
    <div class="container box">
        <div class="row">
        <h2 class="my-5" style="color:black; font-weight:bold;" data-aos="fade-up">Decided To Start Your Zero Investment E-commerce Business??</h2>
                <div class="col-lg-6 col-md-6 col-12">
                  <img src="https://cdn3d.iconscout.com/3d/premium/thumb/man-raising-his-hand-to-show-something-6559357-5559663.png" data-aos="fade-up"  class="img-fluid">
                </div>
    <div class="col-lg-6 col-md-6 col-12">
        <h1 style="color:black; font-size: 2em; margin-top:50px;" data-aos="fade-up">Register Now</h1>
        <a href="register.php" class="btn signin">Enroll Now</a>
        </div>
   </div>
   </div>
    </section>
    <section id="contact" class="py-5">
    <div class="container">
        <div class="text-center" style="text-decoration: underline;">
            <h4 style="font-weight: bold;">Contact Us</h4>
        </div>
        <br> <!-- Add vertical space -->
        <br>
        <br>
        <div class="text-center">
            <div class="row">
                <div class="col">
                    <p style="font-weight: bold;">Email ID:</p>
                </div>
                <br>
               <br>
               <br>
                <br>
                <div class="col">
                    <p class="font customss-font" style="color:blue; font-weight: bold;">support@slveenterprises.org.</p>
                </div>
            </div>
            <div class="my-4"></div> <!-- Decrease space between rows -->
            <div class="row">
                <div class="col">
                    <p class="font customs-font" style="font-weight: bold;">Address:</p>
                </div>
                <div class="col">
    <p class="font custom-font" style="color:blue; font-weight: bold;">
        #9, 2nd Floor, A3, NBA Tower, Thillainagar, 11th Cross W, Tennur, <br>Tiruchirappalli, Tamil Nadu 620018
    </p>
</div>

            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <!-- Privacy, Terms & Refund Policies -->
        <div class="text-center">
    <div class="row">
        <div class="col-md-4 text">
            <p><a href="privacy_policy.html">Privacy Policy</a></p>
        </div>
        <div class="col-md-4 text">
            <p><a href="terms_conditions.html">Terms & Conditions</a></p>
        </div>
        <div class="col-md-4 text">
            <p><a href="refund_policy.html">Refund Policy</a></p>
        </div>
    </div>
</div>

<style>
    /* Media Query for Small Devices */
    @media (max-width: 767.98px) {
        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .text {
            flex: 0 0 50%; /* Two columns per row on small screens */
            max-width: 50%;
            text-align: center;
        }
    }
</style>

        <br> <!-- Add vertical space -->
        <br>
        <br>
        <!-- Copyright -->
        <div class="row">
            <div class="col-md-12">
                <p class="text-center">Copyright 2024. Powered by SLVE Enterprise APP</p>
            </div>
        </div>
    </div>
</section>



    <!-- Bootstrap JS (optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<!---home--> 
<script>
    document.getElementById("dropdown-icon").addEventListener("click", function() {
        document.getElementById("myDropdown").classList.toggle("show");
    });

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('#dropdown-icon')) {
            var dropdowns = document.getElementsByClassName("dropdown-menu");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>
<script type="text/javascript" id="zsiqchat">
var $zoho=$zoho || {};$zoho.salesiq = $zoho.salesiq || {widgetcode: "siq425913971693ca4255dc9c35cb51432f15813484c97ce9ca187d35832cb9c9f4", values:{},ready:function(){}};var d=document;s=d.createElement("script");s.type="text/javascript";s.id="zsiqscript";s.defer=true;s.src="https://salesiq.zohopublic.in/widget";t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);
</script>
</body>
</html>