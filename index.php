<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matadoor Fitness</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMI/IFGURTr5eof4y5boF5JeLv5st4/+Ppddz6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/footer.css">

    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <!-- Welcome Banner -->
    <div class="welcome-banner">
        <h1>WELCOME TO THE MATADOOR FITNESS </h1>
        <h2>+7Years Till Now </h2>

    </div>

    <!-- Membership Section -->
    <div class="membership-section">
        <h2>Memberships</h2>
        <p>We offer the PF Black Card® Membership and Classic Membership. Both get you access to The Judgement Free Zone®, and tons of cardio and strength equipment.</p>
        <div class="membership-cards">
            
            <div class="card">
                <h3>Monthly</h3>
                <p>Starting at</p>
                <div class="price">Rs 1,500 </div>
                <p>plus taxes & fees</p>
                <p>Our standard membership, with unlimited access to your home club.</p>
                <a href="registration.php">
                <button>Join Now</button>
                </a>
            </div>
            <div class="card highlight">
                <div class="best-value"><i class="fa-solid fa-star" style="color: #FFD43B;"></i></div>
                <h3>6 Months®</h3>
                <p>Most Popular</p>
                <div class="price">Rs 6,000</div>
                <p>plus taxes & fees</p>
                <p>Access to any club, bring a guest anytime, PF+ premium digital workouts, and so much more!</p>
                <a href="registration.php">
                <button>Join Now</button>
                </a>
            </div>
            <div class="card">
                <h3>Yearly</h3>
                <p>1 Year</p>
                <div class="price">Rs 10,000</div>
                <p>plus taxes & fees</p>
                <p>Our standard membership, with unlimited access to your home club.</p>
                <a href="registration.php">
                <button>Join Now</button>
                </a>
            </div>
        </div>
    </div>

   <!-- Showcase Section -->
   <div class="showcase-section">
        <h2>Showcase Gallery</h2>
        <p>Explore our gym facilities and see where you will transform your body and mind.</p>
        <div class="showcase-gallery">
            <div class="showcase-card">
                <img src="images/dumbell.png" alt="Gym Photo 1">
                <p>More than 40+ Dumbells</p>
            </div>
            <div class="showcase-card">
                <img src="images/tredmil.png" alt="Gym Photo 2">
                <p>Spacious Workout Area</p>
            </div>
            <div class="showcase-card">
                <img src="images/pullup.png" alt="Gym Photo 3">
                <p>Weighted Pullup Machine</p>
            </div>
            <div class="showcase-card">
                <img src="images/diet.png" alt="Gym Photo 4">
                <p>Customized Diet Plan Provided</p>
            </div>
        </div>
    </div>


 <!-- Team Section -->
 <div class="team-section">
        <h2>Meet Our Team</h2>
        <div class="team-cards">
            <div class="team-card">
                <img src="images/founder.jpg" alt="Founder" class="team-image">
                <div class="team-info">
                    <h3>Prashant Yadav</h3>
                    <p>Founder</p>
                    <p>Age: 45</p>
                </div>
            </div>
            <div class="team-card">
                <img src="images/partner.png" alt="Manager" class="team-image">
                <div class="team-info">
                    <h3>Suresh Uraw</h3>
                    <p>Manager</p>
                    <p>Age: 38</p>
                </div>
            </div>
            <!-- Add more team members as needed -->
        </div>
    </div>
<!-- Location Section -->
<div class="location-section">
    <h2>Our Location</h2>
    <div class="map-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13792.181559967237!2d87.2288597!3d26.7930666!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39b1f6f7e3a054cb%3A0x663f1e06740bdf78!2sMatador%20Fitness%20%26%20Gym%20Center!5e0!3m2!1sen!2sin!4v1633149429551!5m2!1sen!2sin"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
    <a href="https://www.google.com/maps/dir//J42W%2BHQQ,+Inaruwa+56710/@26.6014352,87.0645837,12z/data=!4m8!4m7!1m0!1m5!1m1!1s0x39ef13772751da17:0xffd09ba1f8cbf5cf!2m2!1d87.1469758!2d26.6014619?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D"
       class="direction-button" target="_blank">Start Directions</a>
</div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
