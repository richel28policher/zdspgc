<?php
include('admin/db_connection.php');

// Fetch hero image for news & events page
$heroData = ['image_path' => ''];
$fetchHeroSql = "SELECT image_path FROM news_events_hero LIMIT 1";
$fetchHeroResult = $conn->query($fetchHeroSql);

if ($fetchHeroResult && $fetchHeroResult->num_rows > 0) {
    $heroData = $fetchHeroResult->fetch_assoc();
}

// Fetch news items
$newsItems = [];
$fetchNewsSql = "SELECT * FROM news ORDER BY date DESC";
$fetchNewsResult = $conn->query($fetchNewsSql);

if ($fetchNewsResult && $fetchNewsResult->num_rows > 0) {
    while ($row = $fetchNewsResult->fetch_assoc()) {
        $newsItems[] = $row;
    }
}

// Fetch upcoming events
$events = [];
$fetchEventsSql = "SELECT * FROM events ORDER BY date ASC";
$fetchEventsResult = $conn->query($fetchEventsSql);

if ($fetchEventsResult && $fetchEventsResult->num_rows > 0) {
    while ($row = $fetchEventsResult->fetch_assoc()) {
        $events[] = $row;
    }
}

// Fetch announcements
$announcements = [];
$fetchAnnouncementsSql = "SELECT * FROM announcements ORDER BY created_at DESC";
$fetchAnnouncementsResult = $conn->query($fetchAnnouncementsSql);

if ($fetchAnnouncementsResult && $fetchAnnouncementsResult->num_rows > 0) {
    while ($row = $fetchAnnouncementsResult->fetch_assoc()) {
        $announcements[] = $row;
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
                        url('admin/<?php echo !empty($heroData['image_path']) ? htmlspecialchars($heroData['image_path']) : 'images/image1.jpg'; ?>') center/cover;
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
			
			 .filter-tabs {
                flex-wrap: wrap;
                justify-content: center;
            }

            .news-section,
            .sidebar-section {
                padding: 20px;
            }

            .section-title {
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
.main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 60px 20px;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 40px;
        }
 
     /* News Section */
        .news-section {
            background-color: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .section-title {
            font-size: 28px;
            color: #333;
            margin-bottom: 30px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .section-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #c41e3a, #a01729);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
        }

        .news-grid {
            display: grid;
            gap: 30px;
        }

        .news-card {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 20px;
            padding: 25px;
            background: #f8f9ff;
            border-radius: 12px;
            transition: all 0.3s ease;
            border-left: 4px solid #c41e3a;
        }

        .news-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(196, 30, 58, 0.15);
        }

        .news-image {
            width: 100%;
            height: 120px;
            background: linear-gradient(135deg, #e8f2ff, #c1d9f5);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: #2c5aa0;
        }

        .news-content {
            display: flex;
            flex-direction: column;
        }

        .news-meta {
            display: flex;
            gap: 15px;
            margin-bottom: 10px;
            font-size: 12px;
            color: #666;
        }

        .news-date {
            background-color: #c41e3a;
            color: white;
            padding: 4px 12px;
            border-radius: 15px;
            font-weight: 500;
        }

        .news-category {
            background-color: #2c5aa0;
            color: white;
            padding: 4px 12px;
            border-radius: 15px;
            font-weight: 500;
        }

        .news-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
            line-height: 1.4;
        }

        .news-excerpt {
            font-size: 14px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .read-more {
            color: #c41e3a;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            align-self: flex-start;
            transition: color 0.3s;
        }

        .read-more:hover {
            color: #a01729;
        }

        /* Sidebar */
        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .sidebar-section {
            background-color: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .sidebar-title {
            font-size: 20px;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .event-item {
            padding: 20px;
            background: linear-gradient(135deg, #f8f9ff, #e8f2ff);
            border-radius: 10px;
            margin-bottom: 15px;
            border-left: 4px solid #2c5aa0;
            transition: all 0.3s ease;
        }

        .event-item:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(44, 90, 160, 0.15);
        }

        .event-date {
            font-size: 12px;
            color: #666;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .event-title {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .event-time {
            font-size: 12px;
            color: #777;
        }

        .announcement-item {
            padding: 15px;
            background: linear-gradient(135deg, #fff8f0, #ffecd6);
            border-radius: 8px;
            margin-bottom: 12px;
            border-top: 3px solid #ff9800;
        }

        .announcement-text {
            font-size: 14px;
            color: #555;
            line-height: 1.5;
        }

        /* Calendar Widget */
        .calendar-widget {
            text-align: center;
        }

        .calendar-month {
            font-size: 18px;
            font-weight: bold;
            color: #c41e3a;
            margin-bottom: 15px;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 2px;
            margin-bottom: 10px;
        }

        .calendar-day {
            padding: 8px 4px;
            font-size: 12px;
            text-align: center;
        }

        .calendar-header {
            background-color: #2c5aa0;
            color: white;
            font-weight: bold;
        }

        .calendar-date {
            background-color: #f8f9fa;
            color: #333;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .calendar-date:hover {
            background-color: #e8f2ff;
        }

        .calendar-date.today {
            background-color: #c41e3a;
            color: white;
        }

        .calendar-date.event {
            background-color: #2c5aa0;
            color: white;
        }

        /* Load More Button */
        .load-more-section {
            text-align: center;
            margin-top: 40px;
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
       <h1 class="hero-title">News & Events</h1>
     
    </section>

    <div class="main-content">
        <section class="news-section">
            <h2 class="section-title">
                <div class="section-icon">📰</div>
                Latest News & Updates
            </h2>
            
            <div class="news-grid">
                <?php if (empty($newsItems)): ?>
                    <p>No news items found.</p>
                <?php else: ?>
                    <?php foreach ($newsItems as $news): ?>
                        <article class="news-card">
                            <div class="news-image">
                                <?php if (!empty($news['image_path'])): ?>
                                    <img src="admin/<?php echo htmlspecialchars($news['image_path']); ?>" alt="News Image" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                                <?php else: ?>
                                    🎓
                                <?php endif; ?>
                            </div>
                            <div class="news-content">
                                <div class="news-meta">
                                    <span class="news-date"><?php echo date('M j, Y', strtotime($news['date'])); ?></span>
                                </div>
                                <h3 class="news-title"><?php echo htmlspecialchars($news['title']); ?></h3>
                                <p class="news-excerpt"><?php echo nl2br(htmlspecialchars($news['description'])); ?></p>
                              
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>

        <aside class="sidebar">
            <div class="sidebar-section">
                <h3 class="sidebar-title">
                    <span class="section-icon">📅</span>
                    Upcoming Events
                </h3>
                <?php if (empty($events)): ?>
                    <p>No upcoming events.</p>
                <?php else: ?>
                    <?php foreach ($events as $event): ?>
                        <div class="event-item">
                            <div class="event-date"><?php echo date('F j, Y', strtotime($event['date'])); ?></div>
                            <div class="event-title"><?php echo htmlspecialchars($event['title']); ?></div>
                            <div class="event-time"><?php echo date('g:i A', strtotime($event['time'])); ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="sidebar-section">
                <h3 class="sidebar-title">
                    <span class="section-icon">📋</span>
                    Quick Announcements
                </h3>
                <?php if (empty($announcements)): ?>
                    <p>No announcements.</p>
                <?php else: ?>
                    <?php foreach ($announcements as $announcement): ?>
                        <div class="announcement-item">
                            <p class="announcement-text"><?php echo htmlspecialchars($announcement['content']); ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </aside>
    </div>
   
   <br>
   <br>
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