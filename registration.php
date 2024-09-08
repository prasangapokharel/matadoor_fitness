<?php include 'includes/cookies.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'includes/site.php'; ?>

    <link rel="stylesheet" href="css/registration.css">
    <link rel="stylesheet" href="css/footer.css">
    <link href="./css/tailwind/tailwind.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMI/IFGURTr5eof4y5boF5JeLv5st4/+Ppddz6" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <!-- Registration Form -->
    <div class="registration-form">
        <span class="heading">Gym Registration</span>
        <form action="register.php" method="post">
            <!-- Personal Information -->
            <fieldset>
                <legend>Personal Information</legend>
                <label for="full-name">Full Name:</label>
                <input type="text" id="full-name" name="full-name" required>

                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" required>

                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>

                <label for="contact-number">Contact Number:</label>
                <input type="tel" id="contact-number" name="contact-number" required>

                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required>

                <label for="address">Address:</label>
                <textarea id="address" name="address" rows="3" required></textarea>
            </fieldset>

            <!-- Health and Fitness Information -->
            <fieldset>
                <legend>Health and Fitness Information</legend>
                <label for="fitness-level">Current Fitness Level:</label>
                <select id="fitness-level" name="fitness-level" required>
                    <option value="beginner">Beginner</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="advanced">Advanced</option>
                </select>

                <label for="health-conditions">Health Conditions or Medical History:</label>
                <textarea id="health-conditions" name="health-conditions" rows="3" required></textarea>

                <label for="fitness-goals">Fitness Goals:</label>
                <textarea id="fitness-goals" name="fitness-goals" rows="3" required></textarea>
            </fieldset>

            <!-- Membership Details -->
            <fieldset>
                <legend>Membership Details</legend>
                <label for="membership-type">Preferred Membership Type:</label>
                <select id="membership-type" name="membership-type" required>
                    <option value="monthly">Monthly</option>
                    <option value="yearly">Yearly</option>
                    <option value="family">Family</option>
                </select>

                <label for="training-sessions">Preferred Training Sessions:</label>
                <select id="training-sessions" name="training-sessions" required>
                    <option value="personal">Personal Training</option>
                    <option value="group">Group Classes</option>
                </select>

                <label for="referral-source">Referral Source:</label>
                <input type="text" id="referral-source" name="referral-source" required>
            </fieldset>

            <button type="submit">Apply Now</button>

        </form>
    </div>
    <div id="toast" class="toast"></div>

    <?php include 'includes/footer.php'; ?>
    <script src="js/toast.js"></script>

</body>
</html>
