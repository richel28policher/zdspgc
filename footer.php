
<footer class="footer">
    <div class="footer-header">
        <div class="footer-title">
            ZAMBOANGA DEL SUR PROVINCIAL GOVERNMENT COLLEGE – DIMATALING CAMPUS
        </div>
        <div class="social-icons">
            <a href="#" class="social-icon facebook">f</a>
            <a href="#" class="social-icon youtube">▶</a>
            <a href="#" class="social-icon instagram">○</a>
        </div>
    </div>

    <div class="footer-content">
        <div class="footer-section">
            <h3>Contact Us</h3>
        </div>
        <div class="footer-section">
            <h4>Phone</h4>
            <p>+639703276939</p>
        </div>
        <div class="footer-section">
            <h4>Address</h4>
            <p>Kagawasan, Dimataling, ZDS</p>
            <h4>Office Hours</h4>
            <p>Monday – Friday: 8am – 9pm</p>
        </div>
        <div class="footer-section">
            <h4>Email</h4>
            <p>zdspgcdimataling@gmail.com</p>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="copyright">
            © 2025 Zamboanga del Sur Provincial Government College – Dimataling Campus, All Rights Reserved
        </div>
        <div class="powered-by">Powered by Bsis.org</div>
    </div>
</footer>

<style>
.footer {
    background-color: #c41e3a;
    color: white;
    padding: 40px 20px 20px;
}

.footer-header {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid rgba(255,255,255,0.2);
}

.footer-title {
    font-size: 18px;
    font-weight: bold;
    text-transform: uppercase;
}

.social-icons {
    display: flex;
    gap: 15px;
}

.social-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    font-weight: bold;
    font-size: 18px;
    transition: transform 0.3s;
}

.social-icon:hover {
    transform: scale(1.1);
}

.facebook {
    background-color: #228B22;
    color: white;
}

.youtube {
    background-color: #228B22;
    color: white;
}

.instagram {
    background-color: #00CED1;
    color: white;
}

/* FIX: 4 column layout like the image */
.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 40px;
    margin-bottom: 30px;
}

.footer-section h3 {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 15px;
}

.footer-section h4 {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 8px;
    margin-top: 15px;
}

.footer-section:first-child h4 {
    margin-top: 0;
}

.footer-section p {
    font-size: 14px;
    line-height: 1.4;
    margin: 0;
}

.footer-bottom {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 20px;
    border-top: 1px solid rgba(255,255,255,0.2);
    font-size: 14px;
    flex-wrap: wrap;
    gap: 10px;
    text-align: center;
}

.copyright, .powered-by {
    color: rgba(255,255,255,0.9);
}

</style>