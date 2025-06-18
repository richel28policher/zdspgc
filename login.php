<?php
session_start();

// Hardcoded admin credentials
$valid_username = "admin";
$valid_password = "admin123";

// Handle login submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION["admin_id"] = bin2hex(random_bytes(8)); // Random session ID
        $_SESSION["username"] = $username;
        header("Location: admin/");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZDSPGC Admin Portal - Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #8B0000 0%, #A0522D 50%, #8B0000 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" patternUnits="userSpaceOnUse" width="100" height="100"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.02)"/><circle cx="75" cy="25" r="1" fill="rgba(255,255,255,0.02)"/><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.02)"/><circle cx="25" cy="75" r="1" fill="rgba(255,255,255,0.02)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.02)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 
                0 20px 60px rgba(139, 0, 0, 0.3),
                0 0 0 1px rgba(255, 255, 255, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            width: 100%;
            max-width: 620px;
            position: relative;
            animation: slideUp 0.8s ease-out;
            border: 2px solid rgba(139, 0, 0, 0.1);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-section {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #8B0000, #A0522D);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 10px 30px rgba(139, 0, 0, 0.3);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .logo::before {
            content: '⚡';
            font-size: 2rem;
            color: white;
        }

        .system-title {
            color: #8B0000;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            letter-spacing: -0.5px;
        }

        .admin-label {
            color: #666;
            font-size: 0.9rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            background: linear-gradient(135deg, #8B0000, #A0522D);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            display: block;
            color: #333;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-input {
            width: 100%;
            padding: 1rem 1.2rem;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
            position: relative;
        }

        .form-input:focus {
            outline: none;
            border-color: #8B0000;
            box-shadow: 0 0 0 3px rgba(139, 0, 0, 0.1);
            background: white;
            transform: translateY(-2px);
        }

        .form-input:focus + .input-icon {
            color: #8B0000;
            transform: scale(1.1);
        }

        .input-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            transition: all 0.3s ease;
            font-size: 1.2rem;
        }

        .password-toggle {
            cursor: pointer;
            user-select: none;
        }

        .password-toggle:hover {
            color: #8B0000;
        }

        .login-button {
            width: 100%;
            padding: 1.2rem;
            background: linear-gradient(135deg, #8B0000, #A0522D);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 1rem;
        }

        .login-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(139, 0, 0, 0.4);
        }

        .login-button:hover::before {
            left: 100%;
        }

        .login-button:active {
            transform: translateY(0);
        }

        .forgot-password {
            text-align: center;
            margin-top: 1.5rem;
        }

        .forgot-password a {
            color: #8B0000;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .forgot-password a:hover {
            text-decoration: underline;
            color: #A0522D;
        }

        .security-notice {
            background: rgba(139, 0, 0, 0.05);
            border: 1px solid rgba(139, 0, 0, 0.1);
            border-radius: 8px;
            padding: 1rem;
            margin-top: 1.5rem;
            text-align: center;
        }

        .security-notice .icon {
            color: #8B0000;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .security-notice p {
            color: #666;
            font-size: 0.85rem;
            line-height: 1.4;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 2rem;
                margin: 1rem;
            }
            
            .system-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-section">
            <div class="logo"></div>
            <h1 class="system-title">ZDSPGC WEBSITE</h1>
            <p class="admin-label">Admin Portal</p>
        </div>

        <form id="loginForm" method="POST" action="">
            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input 
                    type="text" 
                    id="username" 
                    name="username" 
                    class="form-input" 
                    placeholder="Enter your username"
                    required
                >
                <span class="input-icon">👤</span>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-input" 
                    placeholder="Enter your password"
                    required
                >
                <span class="input-icon password-toggle" onclick="togglePassword()">👁️</span>
            </div>

            <button type="submit" class="login-button">
                 Login
            </button>
			<br>
			<br>
			<center>
			<a href="index.php" style="text-decoration: none;">Main Page</a>
			
            <?php if (!empty($error)): ?>
                <p style="color: red; text-align: center; margin-top: 1rem;">
                    <?= htmlspecialchars($error) ?>
                </p>
            <?php endif; ?>
        </form>

      
    </div>

    <script>
        let passwordVisible = false;

        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.password-toggle');
            
            if (passwordVisible) {
                passwordInput.type = 'password';
                toggleIcon.textContent = '👁️';
                passwordVisible = false;
            } else {
                passwordInput.type = 'text';
                toggleIcon.textContent = '🙈';
                passwordVisible = true;
            }
        }

        function handleForgotPassword() {
            alert('Please contact your system administrator to reset your password.');
        }
    </script>
</body>
</html>