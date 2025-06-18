<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zamboanga del Sur Provincial Government College</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        /* Combined Header and Top Navigation */
        .header-top {
            background-color: #f8f8f8;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
            position: relative;
        }

        .header-container {
         
            margin: 0 auto;
            display: flex;
            align-items: center;
            padding: 0 20px;
        }

        .logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, #2c5aa0, #1e3d72);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            position: relative;
        }

        .logo::before {
         
            font-size: 24px;
            color: white;
        }

        .college-title {
            flex: 1;
        }

        .college-name {
            color: #c41e3a;
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .campus-name {
            color: #333;
            font-size: 14px;
            margin-top: 2px;
        }

        /* Top navigation bar - now positioned absolutely within header */
        .top-nav {
            position: absolute;
            top: 0;
            right: 0;
            background-color: #c41e3a;
            height: 100%;
            display: flex;
            align-items: center;
            padding: 0 20px;
			border-top-left-radius: 20px;
			border-bottom-left-radius: 20px;
			width: 750px;

        }

        .top-nav-container {
            display: flex;
            align-items: center;
            gap: 50px;
        }

        .top-nav-links {
            display: flex;
            list-style: none;
            gap: 60px;
            margin: 0;
        }

        .top-nav-links a {
            color: white;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: opacity 0.3s;
        }

        .top-nav-links a:hover {
            opacity: 0.8;
			
        }

        .zdspgc-network {
            color: white;
            font-size: 14px;
            font-weight: 500;
        }

        /* Main navigation */
        .main-nav {
			margin-left: 50%;
            background-color: white;
           
            position: sticky;
            top: 0;
            z-index: 100;
			
        }

        .main-nav-container {
			
            max-width: 800px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .main-nav-links {
            display: flex;
            list-style: none;
            gap: 40px;
        }
		.main-nav-links li {
    position: relative;
}

        .main-nav-links a {
            color: #333;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            padding: 20px 0;
            transition: color 0.3s;
        }

        .main-nav-links a:hover,
        .main-nav-links a.active {
            color: #c41e3a;
        }

        .contact-btn {
            background-color: #c41e3a;
            color: white;
            padding: 10px 20px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .contact-btn:hover {
            background-color: #a01729;
        }

        /* Hero section with campus image */
        .hero-section {
            position: relative;
            height: 400px;
            background: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.1)), 
                        url('images/image1.jpg') center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Content section */
        .content-section {
            max-width: 1000px;
            margin: 60px auto;
            padding: 0 20px;
            text-align: center;
        }

        .section-title {
            font-size: 36px;
            color: #333;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .section-description {
            font-size: 16px;
            line-height: 1.8;
            color: #555;
            text-align: justify;
        }

        /* Scroll indicator */
        .scroll-indicator {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background-color: #2c5aa0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            animation: bounce 2s infinite;
        }

        .scroll-indicator:hover {
            background-color: #1e3d72;
            transform: scale(1.1);
        }

        .scroll-indicator::after {
            content: "↑";
            color: white;
            font-size: 20px;
            font-weight: bold;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }

            .top-nav-container {
                flex-direction: column;
                gap: 15px;
            }

            .top-nav-links {
                gap: 15px;
            }

            .main-nav-container {
                flex-direction: column;
                gap: 15px;
            }

            .main-nav-links {
                gap: 20px;
                flex-wrap: wrap;
                justify-content: center;
            }

            .hero-section {
                height: 300px;
            }

            .section-title {
                font-size: 28px;
            }

            .section-description {
                text-align: left;
            }
        }
		.dropdown-menu {
    display: none;
    position: absolute;
    background: radial-gradient(circle, red 2%, white 100%);
    list-style: none;
    padding: 0;
    margin: 0;
    top: 100%;
    left: 0;
    min-width: 180px;
    border: 1px solid #ccc;
    z-index: 1000;
}

.dropdown-menu li a {
    display: block;
    padding: 10px 15px;
    text-decoration: none;
    color: black;
    white-space: nowrap;
}

.dropdown:hover .dropdown-menu {
    display: block;
	
}
    </style>
</head>
<body style="background-color: white;">
    
    <header class="header-top">
        <div class="header-container">
            <div class="logo"> <img src="images/zdspgc_logo.png" style="width: 70px; border-radius: 100px;"></div>

            <div class="college-title">
                <div class="college-name">Zamboanga del Sur Provincial Government College</div>
                <div class="campus-name">DIMATALING CAMPUS</div>
            </div>
        </div>
      
        <nav class="top-nav">
            <div class="top-nav-container">
                <ul class="top-nav-links">
                    <li><a href="quick-links.php">Quick Links</a></li>
                    <li><a href="parents.php">Parents</a></li>
                    <li><a href="alumni.php">Alumni</a></li>
                    <li><a href="calendar.php">Master Calendar</a></li>
                    <li><a href="zdspgc-network.php">ZDSPGC Network</a></li>
                </ul>
                
            </div>
        </nav>
    </header>

  <?php include('main-nav.php'); ?>


 
    <section class="hero-section">
     
    </section>

    <!-- Main content -->
    <section class="content-section">
        <h1 class="section-title">Get Ready for a Bright Future</h1>
        <p class="section-description">
            Zamboanga del Sur Provincial Government College – Dimataling Campus is a dynamic higher education institution offering quality education with free tuition, making college accessible to all deserving students. We are committed to empowering learners through excellent academic programs, values formation, and active community involvement – preparing graduates to thrive in their careers and contribute meaningfully to society.

        </p>
    </section>

    <!-- Scroll indicator -->
    <div class="scroll-indicator" onclick="scrollToTop()"></div>

   <?php include('footer.php'); ?>
    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Scroll to top function
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Change scroll indicator based on scroll position
        window.addEventListener('scroll', function() {
            const scrollIndicator = document.querySelector('.scroll-indicator');
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > 200) {
                scrollIndicator.style.transform = 'rotate(180deg)';
                scrollIndicator.setAttribute('onclick', 'scrollToTop()');
            } else {
                scrollIndicator.style.transform = 'rotate(0deg)';
            }
        });

        // Add active state to navigation based on scroll
        window.addEventListener('scroll', function() {
            const sections = document.querySelectorAll('section');
            const navLinks = document.querySelectorAll('.main-nav-links a');
            
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (scrollY >= (sectionTop - 200)) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>