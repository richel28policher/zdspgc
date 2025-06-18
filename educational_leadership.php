<?php
session_start();
include('admin/db_connection.php');

// Fetch leadership content
$leadershipContent = ['title' => 'Our Leadership Team', 'content' => '', 'image_path' => ''];
$contentSql = "SELECT title, content, image_path FROM leadership_content LIMIT 1";
$contentResult = $conn->query($contentSql);
if ($contentResult && $contentResult->num_rows > 0) {
    $leadershipContent = $contentResult->fetch_assoc();
}

// Fetch leadership members
$leaders = [];
$leadersSql = "SELECT id, name, designation, details, education, image_path FROM leadership_members ORDER BY name ASC";
$leadersResult = $conn->query($leadersSql);
if ($leadersResult && $leadersResult->num_rows > 0) {
    while ($row = $leadersResult->fetch_assoc()) {
        $leaders[] = $row;
    }
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
            background: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.1))<?= !empty($leadershipContent['image_path']) ? ", url('admin/" . htmlspecialchars($leadershipContent['image_path']) . "') center/cover" : "" ?>;
            display: flex;
            align-items: center;
            justify-content: left;
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

 .leadership-container {
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 20px;
        }

        .section-intro {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-intro h2 {
            font-size: 32px;
            color: #333;
            margin-bottom: 15px;
        }

        .section-intro p {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto;
        }

        /* Leadership grid */
        .leadership-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        .leader-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            text-align: center;
        }

        .leader-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .leader-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(45deg, #c41e3a, #2c5aa0);
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 36px;
            font-weight: bold;
            overflow: hidden;
        }

        .leader-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .leader-name {
            font-size: 22px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .leader-title {
            font-size: 16px;
            color: #c41e3a;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .leader-bio {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
            text-align: left;
        }

        .leader-credentials {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
        }

        .leader-credentials h4 {
            font-size: 14px;
            color: #333;
            margin-bottom: 8px;
        }

        .leader-credentials ul {
            list-style: none;
            font-size: 13px;
            color: #666;
        }

        .leader-credentials li {
            margin-bottom: 3px;
            padding-left: 15px;
            position: relative;
        }

        .leader-credentials li::before {
            content: "•";
            color: #c41e3a;
            position: absolute;
            left: 0;
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
       <h1 class="hero-title">Educational Leadership</h1>
    </section>

    <!-- Main content -->
    <div class="leadership-container">
        <div class="section-intro">
            <h2><?= htmlspecialchars($leadershipContent['title'] ?? 'Our Leadership Team') ?></h2>
            <p><?= !empty($leadershipContent['content']) ? $leadershipContent['content'] : 'The Zamboanga del Sur Provincial Government College - Dimataling Campus is led by a team of experienced educators and administrators committed to providing quality higher education and fostering academic excellence in our community.' ?></p>
        </div>

        <div class="leadership-grid">
            <?php if (!empty($leaders)): ?>
                <?php foreach ($leaders as $leader): ?>
                    <div class="leader-card">
                        <div class="leader-photo">
                            <?php if (!empty($leader['image_path'])): ?>
                                <img src="admin/<?= htmlspecialchars($leader['image_path']) ?>" alt="<?= htmlspecialchars($leader['name']) ?>">
                            <?php else: ?>
                                <?= substr(htmlspecialchars($leader['name']), 0, 1) ?>
                            <?php endif; ?>
                        </div>
                        <h3 class="leader-name"><?= htmlspecialchars($leader['name']) ?></h3>
                        <p class="leader-title"><?= htmlspecialchars($leader['designation']) ?></p>
                        <div class="leader-bio" style="text-align: justify;">
                            <?= htmlspecialchars($leader['details']) ?>
                        </div>
                        <div class="leader-credentials">
                            <h4>Education & Experience:</h4>
                          <ul>
    <?php 
    
    $educationData = str_replace(['\\r\\n', '\\n', '\\r'], "\n", $leader['education']);
    $educationItems = explode("\n", $educationData);

    foreach ($educationItems as $item): 
        if (!empty(trim($item))): ?>
            <li><?= htmlspecialchars(trim($item)) ?></li>
        <?php endif;
    endforeach; ?>
</ul>


                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">
                    <p>No leadership records found. Please check back later.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

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