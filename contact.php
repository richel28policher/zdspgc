<?php
// Include database connection
include('admin/db_connection.php');

// Initialize variables
$name = $email = $phone = $message = '';
$notification = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs
    $name = $conn->real_escape_string(trim($_POST['name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $phone = $conn->real_escape_string(trim($_POST['phone']));
    $message = $conn->real_escape_string(trim($_POST['message']));
    
    // Basic validation
    $errors = [];
    
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    if (empty($message)) {
        $errors[] = "Message is required";
    }
    
    // If no errors, insert into database
    if (empty($errors)) {
        $sql = "INSERT INTO contact_messages (name, email, phone, message, created_at) 
                VALUES (?, ?, ?, ?, NOW())";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $phone, $message);
        
        if ($stmt->execute()) {
         
            // Set success notification
            $notification = [
                'type' => 'success',
                'message' => 'Thank you for your message! We will get back to you soon.'
            ];
            
            // Clear form fields
            $name = $email = $phone = $message = '';
        } else {
            $notification = [
                'type' => 'danger',
                'message' => 'Error submitting your message. Please try again later.'
            ];
        }
        
        $stmt->close();
    } else {
        $notification = [
            'type' => 'danger',
            'message' => implode('<br>', $errors)
        ];
    }
    
    // Store notification in session if you want to display after redirect
    $_SESSION['notification'] = $notification;
}

// Close connection
$conn->close();
?>


   <?php

include ('admin/db_connection.php'); 


$heroData = ['title' => '', 'content' => '', 'image_path' => ''];
$fetchSql = "SELECT * FROM contact_info LIMIT 1";
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
                        url('images/image1.jpg') center/cover;
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
 .contact-section {
            background: linear-gradient(135deg, #800000 0%, #b22222 100%);

            padding: 80px 20px;
            position: relative;
            overflow: hidden;
        }

        .contact-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="white" opacity="0.1"><polygon points="0,0 1000,100 1000,100 0,100"/></svg>');
            background-size: cover;
        }

        .contact-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: start;
            position: relative;
            z-index: 2;
        }

        /* Contact Info */
        .contact-info {
            color: white;
        }

        .contact-info h2 {
            font-size: 36px;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .contact-details {
            space-y: 20px;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 30px;
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            backdrop-filter: blur(10px);
        }

        .contact-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            font-size: 20px;
            flex-shrink: 0;
        }

        .contact-text h3 {
            font-size: 18px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .contact-text p {
            font-size: 14px;
            opacity: 0.9;
            line-height: 1.5;
        }

        /* Get In Touch Form */
        .get-in-touch {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .get-in-touch h2 {
            font-size: 32px;
            color: #333;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            position: relative;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-input:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 10px rgba(102, 126, 234, 0.1);
        }

        .form-input::placeholder {
            color: #aaa;
            font-size: 16px;
        }

        textarea.form-input {
            height: 120px;
            resize: vertical;
        }

        .submit-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            float: right;
            margin-top: 10px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        /* Map section */
        .map-section {
            background: white;
            padding: 60px 20px;
        }

        .map-container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .map-container h2 {
            font-size: 32px;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .map-container p {
            font-size: 16px;
            color: #666;
            margin-bottom: 40px;
        }

        .map-placeholder {
            width: 100%;
            height: 400px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #666;
            border: 2px dashed #ddd;
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

 
   .instructors-section {
            background-color: white;
            padding: 60px 20px;
        }

        .instructors-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .instructors-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }

        .instructor-card {
            display: flex;
            background-color: #f8f9fa;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .instructor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.15);
        }

        .instructor-photo {
            width: 150px;
            height: 150px;
            background: linear-gradient(135deg, #4a90e2, #357abd);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .instructor-info {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .instructor-name {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .instructor-details {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
        }

        .instructor-details p {
            margin-bottom: 5px;
        }

        .instructor-email {
            color: #4a90e2;
            font-weight: 500;
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

 
 

  <section class="contact-section">
        <div class="contact-container">
            <!-- Contact Information -->
            <div class="contact-info">
                <h2>Contact Us</h2>
                
                <div class="contact-item">
                    <div class="contact-icon">📍</div>
                    <div class="contact-text">
                        <h3>Address</h3>
                        <p><?php echo !empty($heroData['address']) ? htmlspecialchars($heroData['address']) : ''; ?></p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">📧</div>
                    <div class="contact-text">
                        <h3>Email</h3>
                        <p><?php echo !empty($heroData['email']) ? htmlspecialchars($heroData['email']) : ''; ?></p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">📞</div>
                    <div class="contact-text">
                        <h3>Phone</h3>
                        <p><?php echo !empty($heroData['phone']) ? htmlspecialchars($heroData['phone']) : ''; ?></p>
                    </div>
                </div>
            </div>

            <!-- Get In Touch Form -->
            <div class="get-in-touch">
                <h2>Get In Touch</h2>
                
                

              <?php if (isset($_SESSION['notification'])): ?>
    <div class="notification alert alert-<?= $_SESSION['notification']['type'] ?>">
        <?= $_SESSION['notification']['message'] ?>
    </div>
    <?php unset($_SESSION['notification']); ?>
<?php endif; ?>

<!-- Update your form to include PHP processing -->
<form id="contactForm" method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <div class="form-grid">
        <div class="form-group full-width">
            <input type="text" class="form-input" name="name" placeholder="Name" 
                   value="<?= htmlspecialchars($name) ?>" required>
        </div>
        <div class="form-group">
            <input type="email" class="form-input" name="email" placeholder="Email Address" 
                   value="<?= htmlspecialchars($email) ?>" required>
        </div>
        <div class="form-group">
            <input type="tel" class="form-input" name="phone" placeholder="Phone" 
                   value="<?= htmlspecialchars($phone) ?>">
        </div>
    </div>
    
    <div class="form-group full-width">
        <textarea class="form-input" name="message" placeholder="Message" required><?= htmlspecialchars($message) ?></textarea>
    </div>
    
    <button type="submit" class="submit-btn">Submit</button>
</form>
            </div>
        </div>
    </section>

    <section class="map-section">
        <div class="map-container">
            <h2>Find Us</h2>
            <p>Visit our campus located in the heart of Dimataling, Zamboanga del Sur</p>
            <div class="map-placeholder">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30285.517560337565!2d123.32310284118574!3d7.502785069140881!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3256bb8672a77ac5%3A0x99aa480ab3fa0ff5!2sKagawasan%2C%20Dimataling%2C%20Zamboanga%20del%20Sur!5e1!3m2!1sen!2sph!4v1749976658961!5m2!1sen!2sph" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

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