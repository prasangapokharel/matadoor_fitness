<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMI/IFGURTr5eof4y5boF5JeLv5st4/+Ppddz6" crossorigin="anonymous">
    <title>Matadoor Fitness</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Navbar Styling */
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #ffffff;
            padding: 15px 30px;
            border-bottom: 2px solid #e0e0e0;
            flex-wrap: wrap; /* Allows the navbar items to wrap on smaller screens */
        }

        .navbar-logo img {
            height: 50px;
        }

        .navbar-menu {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .navbar-menu li {
            margin: 0 10px;
        }

        .navbar-menu li a {
            text-decoration: none;
            color: #333;
            font-size: 12.63px;
        }

        .navbar-menu li a:hover {
            color: #fc9003; /* Highlight color on hover */
        }

        .navbar-buttons {
            display: flex;
            align-items: center;
        }

        .call-now-btn {
            background-color: #fc9003;
            color: #ffffff;
            padding: 16px 32px;
            border: none;
            text-decoration: none;
            border-radius: 30px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
a.call-now-btn{
    font-weight: 500;
}
        .call-now-btn:hover {
            background-color: #000000;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .navbar-menu {
                flex-direction: column;
                width: 100%;
                text-align: center;
                display: none; /* Hidden by default */
            }

            .navbar-menu.active {
                display: flex; /* Display menu when activated */
            }

            .navbar-menu li {
                margin: 10px 0;
            }

            .navbar-buttons {
                margin-top: 10px;
            }

            .menu-toggle {
                display: block;
                background: none;
                border: none;
                font-size: 24px;
                color: #333;
                cursor: pointer;
                margin-left: auto;
            }

            /* Move call-now-btn inside mobile menu */
            .navbar-menu .call-now-btn {
                display: block;
                margin-top: 20px;
            }
        }

        /* Hide menu-toggle on larger screens */
        @media (min-width: 769px) {
            .menu-toggle {
                display: none;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-logo">
            <img src="images/logo.png" alt="Matadoor Fitness Logo">
        </div>
        <button class="menu-toggle" onclick="toggleMenu()"><i class="fa fa-bars"></i></button>
        <ul class="navbar-menu">
            <li><a href="index">Home</a></li>
            <li><a href="registration">Registration</a></li>
            <li><a href="event">Events</a></li>

            <li><a href="faqs">FAQ</a></li>
            <li><a href="contact">Contact Us</a></li>
            <li><a href="tel:+9811388848" class="call-now-btn">Call Now <i class="fa-solid fa-phone fa-shake"></i></a></li>
        </ul>
       
    </nav>

    <script>
        function toggleMenu() {
            var menu = document.querySelector('.navbar-menu');
            menu.classList.toggle('active');
        }
    </script>
</body>
</html>
