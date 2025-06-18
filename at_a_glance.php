<?php
include('admin/db_connection.php');

// Fetch main section data
$glanceData = ['title' => '', 'content' => '', 'image_path' => ''];
$fetchSql = "SELECT title, content, image_path FROM at_a_glance LIMIT 1";
$fetchResult = $conn->query($fetchSql);

if ($fetchResult && $fetchResult->num_rows > 0) {
    $glanceData = $fetchResult->fetch_assoc();
}

// Fetch statistics data
$statsData = [
    'year_founded' => '',
    'alumni_on_staff' => '',
    'part_time_instructors' => '',
    'alumni' => '',
    'full_time_faculty' => '',
    'classrooms' => ''
];
$fetchStatsSql = "SELECT * FROM at_a_glance_stats LIMIT 1";
$fetchStatsResult = $conn->query($fetchStatsSql);

if ($fetchStatsResult && $fetchStatsResult->num_rows > 0) {
    $statsData = $fetchStatsResult->fetch_assoc();
}

// Fetch quick facts data
$quickFacts = [];
$fetchFactsSql = "SELECT * FROM at_a_glance_facts ORDER BY created_at DESC";
$fetchFactsResult = $conn->query($fetchFactsSql);

if ($fetchFactsResult && $fetchFactsResult->num_rows > 0) {
    while ($row = $fetchFactsResult->fetch_assoc()) {
        $quickFacts[] = $row;
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
            background: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.1)), 
                        url('admin/<?php echo !empty($glanceData['image_path']) ? htmlspecialchars($glanceData['image_path']) : 'images/image1.jpg'; ?>') center/cover;
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
            
             .instructors-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .instructor-card {
                flex-direction: column;
            }

            .instructor-photo {
                width: 100%;
                height: 120px;
            }
            
            
            .facilities-grid {
                grid-template-columns: 1fr;
                gap: 25px;
            }

            .stats-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 30px;
            }

            .stat-number {
                font-size: 36px;
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

 
    .stats-section {
            background-color: white;
            padding: 80px 20px;
        }

        .stats-container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .section-header {
            margin-bottom: 60px;
        }

        .section-title {
            font-size: 42px;
            color: #333;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .section-subtitle {
            font-size: 18px;
            color: #666;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
            margin-top: 50px;
        }

        .stat-card {
            background: linear-gradient(135deg, #f8f9ff, #e8f2ff);
            border: 2px solid #e1e8f5;
            border-radius: 20px;
            padding: 40px 30px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #c41e3a, #2c5aa0);
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(44, 90, 160, 0.15);
            border-color: #c41e3a;
        }

        .stat-number {
            font-size: 56px;
            font-weight: bold;
            color: #2c5aa0;
            margin-bottom: 10px;
            display: block;
        }

        .stat-label {
            font-size: 16px;
            color: #333;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stat-description {
            font-size: 14px;
            color: #666;
            margin-top: 8px;
            font-style: italic;
        }

        /* Quick Facts Section */
        .quick-facts-section {
            background: linear-gradient(135deg, #f8f9ff, #e8f2ff);
            padding: 80px 20px;
        }

        .quick-facts-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .quick-facts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            margin-top: 50px;
        }

        .fact-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }

        .fact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.12);
        }

        .fact-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #c41e3a, #a01729);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            color: white;
            font-size: 24px;
        }

        .fact-title {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .fact-content {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
        }

        /* Milestone Timeline */
        .timeline-section {
            background-color: white;
            padding: 80px 20px;
        }

        .timeline-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .timeline {
            position: relative;
            padding: 40px 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 3px;
            background: linear-gradient(to bottom, #c41e3a, #2c5aa0);
            transform: translateX(-50%);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 50px;
            width: 50%;
        }

        .timeline-item:nth-child(odd) {
            left: 0;
            padding-right: 40px;
            text-align: right;
        }

        .timeline-item:nth-child(even) {
            left: 50%;
            padding-left: 40px;
        }

        .timeline-dot {
            position: absolute;
            width: 20px;
            height: 20px;
            background: #c41e3a;
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
        }

        .timeline-item:nth-child(odd) .timeline-dot {
            right: -10px;
        }

        .timeline-item:nth-child(even) .timeline-dot {
            left: -10px;
        }

        .timeline-content {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .timeline-year {
            font-size: 24px;
            font-weight: bold;
            color: #c41e3a;
            margin-bottom: 10px;
        }

        .timeline-text {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
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
       <h1 class="hero-title">At a Glance</h1>
     
    </section>

    <!-- Main Content Section -->
    <section class="content-section">
        <h1 class="section-title"><?php echo !empty($glanceData['title']) ? htmlspecialchars($glanceData['title']) : ''; ?></h1>
        <div class="section-description">
            <?php echo !empty($glanceData['content']) ? $glanceData['content'] : ''; ?>
        </div>
    </section>

     <section class="stats-section">
        <div class="stats-container">

            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-number"><?php echo !empty($statsData['year_founded']) ? htmlspecialchars($statsData['year_founded']) : '2015'; ?></span>
                    <div class="stat-label">Year Founded</div>
                    <div class="stat-description">Established to serve the educational needs of Dimataling community</div>
                </div>

                <div class="stat-card">
                    <span class="stat-number"><?php echo !empty($statsData['alumni_on_staff']) ? htmlspecialchars($statsData['alumni_on_staff']) : '3'; ?></span>
                    <div class="stat-label">Alumni on Staff</div>
                    <div class="stat-description">Graduates who returned to serve their alma mater</div>
                </div>

                <div class="stat-card">
                    <span class="stat-number"><?php echo !empty($statsData['part_time_instructors']) ? htmlspecialchars($statsData['part_time_instructors']) : '12'; ?></span>
                    <div class="stat-label">Part-time Instructors</div>
                    <div class="stat-description">Dedicated educators supporting our academic programs</div>
                </div>

                <div class="stat-card">
                    <span class="stat-number"><?php echo !empty($statsData['alumni']) ? htmlspecialchars($statsData['alumni']) : '100'; ?></span>
                    <div class="stat-label">Alumni</div>
                    <div class="stat-description">Graduates making their mark in various fields</div>
                </div>

                <div class="stat-card">
                    <span class="stat-number"><?php echo !empty($statsData['full_time_faculty']) ? htmlspecialchars($statsData['full_time_faculty']) : '15'; ?></span>
                    <div class="stat-label">Full-time Faculty & Staff</div>
                    <div class="stat-description">Core team ensuring quality education delivery</div>
                </div>

                <div class="stat-card">
                    <span class="stat-number"><?php echo !empty($statsData['classrooms']) ? htmlspecialchars($statsData['classrooms']) : '20'; ?></span>
                    <div class="stat-label">Classrooms</div>
                    <div class="stat-description">Modern learning spaces for diverse academic programs</div>
                </div>
            </div>
        </div>
    </section>

    <section class="quick-facts-section">
        <div class="quick-facts-container">
            <div class="section-header">
                <h2 class="section-title">Quick Facts</h2>
               
            </div>

            <div class="quick-facts-grid">
                <?php if (!empty($quickFacts)): ?>
                    <?php foreach ($quickFacts as $fact): ?>
                        <div class="fact-card">
                            <div class="fact-icon">📌</div>
                            <h3 class="fact-title"><?php echo htmlspecialchars($fact['title']); ?></h3>
                            <p class="fact-content"><?php echo nl2br(htmlspecialchars($fact['description'])); ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="fact-card">
                        <div class="fact-icon">🎓</div>
                        <h3 class="fact-title">Academic Excellence</h3>
                        <p class="fact-content">Committed to providing quality higher education with a focus on practical skills and theoretical knowledge.</p>
                    </div>
                    <div class="fact-card">
                        <div class="fact-icon">🏛️</div>
                        <h3 class="fact-title">Campus Location</h3>
                        <p class="fact-content">Strategically located in Dimataling, serving the educational needs of Zamboanga del Sur.</p>
                    </div>
                <?php endif; ?>
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
    </script>
</body>
</html>