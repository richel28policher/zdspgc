   <?php

include ('admin/db_connection.php'); 


$heroData = ['main_content' => '', 'main_image_path' => '', 'visual_arts_content' => '', 'visual_arts_image_path' => '', 'dance_content' => '', 'dance_image_path' => '', 'music_content' => '', 'music_image_path' => ''];
$fetchSql = "SELECT * FROM arts_content LIMIT 1";
$fetchResult = $conn->query($fetchSql);

if ($fetchResult && $fetchResult->num_rows > 0) {
    $heroData = $fetchResult->fetch_assoc();
}

$conn->close();
?>
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
                url('admin/<?php echo !empty($heroData['main_image_path']) ? htmlspecialchars($heroData['main_image_path']) : ''; ?>') center/cover;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding-left: 50px;
        }

        .hero-title {
            color: white;
            font-size: 48px;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            background: rgba(0,0,0,0.3);
            padding: 20px 40px;
            border-radius: 10px;
        }

        /* Arts Programs Section */
        .arts-programs {
            background-color: white;
            padding: 60px 20px;
        }

        .arts-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .intro-section {
            text-align: center;
            margin-bottom: 60px;
        }

        .intro-description {
            font-size: 18px;
            line-height: 1.8;
            color: #555;
            max-width: 800px;
            margin: 0 auto;
        }

        .program-card {
            display: flex;
            margin-bottom: 50px;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .program-card:hover {
            transform: translateY(-5px);
        }

        .program-card:nth-child(even) {
            flex-direction: row-reverse;
        }

        .program-content {
            flex: 1;
            padding: 40px;
            background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
            color: white;
        }

        .program-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
            color: white;
        }

        .program-description {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .program-highlights {
            margin: 20px 0;
        }

        .program-highlights ul {
            list-style: none;
            padding: 0;
        }

        .program-highlights li {
            padding: 5px 0;
            font-weight: 500;
        }

        .program-highlights li:before {
            content: "•";
            color: white;
            font-weight: bold;
            margin-right: 10px;
        }

        .learn-more-btn {
            display: inline-block;
            background: rgba(255,255,255,0.2);
            color: white;
            padding: 12px 24px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 20px;
            transition: background 0.3s;
            border: 2px solid white;
        }

        .learn-more-btn:hover {
            background: white;
            color: #ff6b6b;
        }

        .program-image {
            flex: 1;
            min-height: 400px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .visual-arts-bg {
            background: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.1)),
                        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400"><rect fill="%23f0f0f0" width="400" height="400"/><circle fill="%23ff6b6b" cx="100" cy="100" r="30"/><circle fill="%2300bcd4" cx="300" cy="150" r="40"/><circle fill="%23ffeb3b" cx="200" cy="300" r="35"/><rect fill="%234caf50" x="50" y="250" width="60" height="40"/></svg>');
        }

        .dance-bg {
            background: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.1)),
                        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400"><rect fill="%23e8f5e8" width="400" height="400"/><path fill="%23ff6b6b" d="M50 200 Q200 100 350 200 Q200 300 50 200"/><circle fill="%2300bcd4" cx="200" cy="200" r="20"/></svg>');
        }

        .music-bg {
            background: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.1)),
                        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400"><rect fill="%23e8f8e8" width="400" height="400"/><path fill="%23ff6b6b" d="M100 100 L120 100 L120 250 Q120 270 140 270 Q160 270 160 250 Q160 230 140 230 Q120 230 120 250 L120 120 L300 80 L300 200 Q300 220 280 220 Q260 220 260 200 Q260 180 280 180 Q300 180 300 200 L300 100 L100 100"/></svg>');
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

            .program-card,
            .program-card:nth-child(even) {
                flex-direction: column;
            }

            .program-image {
                min-height: 200px;
            }

            .program-content {
                padding: 30px 20px;
            }

            .program-title {
                font-size: 24px;
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
        <h1 class="hero-title">Arts</h1>
    </section>

    <section class="arts-programs">
        <div class="arts-container">
            <div class="" style="text-align: justify;">
                <div class="intro-description">
                   <?php echo !empty($heroData['main_content']) ? $heroData['main_content'] : ''; ?>
                </div>
            </div>
<br>
            <!-- Visual Arts Program -->
            <div class="program-card">
                <div class="program-content">
                    <h2 class="program-title">Visual Arts</h2>
                    <div class="program-description">
                         <?php echo !empty($heroData['visual_arts_content']) ? $heroData['visual_arts_content'] : ''; ?>
                    </div>

                </div>
                <div class="program-image"><img src="admin/<?php echo !empty($heroData['visual_arts_image_path']) ? $heroData['visual_arts_image_path'] : ''; ?>" style="width: 100%;"></div>
            </div>

            <!-- Dance Program -->
            <div class="program-card">
                <div class="program-content">
                    <h2 class="program-title">Dance</h2>
                    <div class="program-description">
                        <?php echo !empty($heroData['dance_content']) ? $heroData['dance_content'] : ''; ?>
                    </div>
                    
                  
                </div>
                 <div class="program-image"><img src="admin/<?php echo !empty($heroData['dance_image_path']) ? $heroData['dance_image_path'] : ''; ?>" style="width: 100%;"></div>
            </div>

            <!-- Music Program -->
            <div class="program-card">
                <div class="program-content">
                    <h2 class="program-title">Music</h2>
                    <div class="program-description">
                       <?php echo !empty($heroData['music_content']) ? $heroData['music_content'] : ''; ?>
                    </div>
                    
           
                </div>
                <div class="program-image"><img src="admin/<?php echo !empty($heroData['music_image_path']) ? $heroData['music_image_path'] : ''; ?>" style="width: 100%;"></div>
            </div>
        </div>
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

        // Add smooth animations on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.program-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(50px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });
    </script>
</body>
</html>