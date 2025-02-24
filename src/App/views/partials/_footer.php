<style>
    footer {
        background-color: #1A1A1A;
        color: #e2e8f0;
        padding: 5rem 5% 2rem;
    }

    .footer-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 3rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .footer-col h3 {
        font-size: 1.3rem;
        margin-bottom: 1.8rem;
        color: white;
        position: relative;
        display: inline-block;
        padding-bottom: 0.8rem;
    }

    .footer-col h3::after {
        content: '';
        position: absolute;
        width: 40px;
        height: 3px;
        background-color: #FFC400;
        bottom: 0;
        left: 0;
        border-radius: 2px;
    }

    .footer-col ul {
        list-style: none;
    }

    .footer-col ul li {
        margin-bottom: 1rem;
    }

    .footer-col ul li a {
        text-decoration: none;
        color: #cbd5e1;
        transition: all 0.3s;
        display: inline-block;
        position: relative;
        padding-left: 1.2rem;
    }

    .footer-col ul li a::before {
        content: '›';
        position: absolute;
        left: 0;
        color: #FFC400;
        font-size: 1.2rem;
        transition: transform 0.3s;
    }

    .footer-col ul li a:hover {
        color: #FFC400;
        transform: translateX(5px);
    }

    .footer-col ul li a:hover::before {
        transform: translateX(3px);
    }

    .footer-col p {
        color: #cbd5e1;
        line-height: 1.8;
    }

    .footer-social {
        display: flex;
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .footer-social a {
        color: #FFC400;
        background-color: rgba(255, 255, 255, 0.1);
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s;
    }

    .footer-social a:hover {
        background-color: #FFC400;
        color: #1A1A1A;
        transform: translateY(-5px);
    }

    .footer-bottom {
        text-align: center;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        margin-top: 4rem;
        padding-top: 2rem;
        color: #94a3b8;
    }

    @media (max-width: 992px) {
        .footer-container {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .footer-container {
            grid-template-columns: 1fr;
        }
    }
</style>

<footer>
    <div class="footer-container">
        <div class="footer-col">
            <h3>LEARN<span style="color: #FFC400;">HUB</span></h3>
            <p>A global community where passionate educators and eager students come together to transform education.</p>
            <div class="footer-social">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
        <div class="footer-col">
            <h3>Explore</h3>
            <ul>
                <li><a href="#">Courses</a></li>
                <li><a href="#">Teachers</a></li>
                <li><a href="#">Pricing</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Blog</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h3>Resources</h3>
            <ul>
                <li><a href="#">Help Center</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms of Service</a></li>
                <li><a href="#">FAQs</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h3>Contact</h3>
            <ul>
                <li><a href="#"><i class="fas fa-envelope"></i> info@learnhub.com</a></li>
                <li><a href="#"><i class="fas fa-phone"></i> +94 76 764 3457</a></li>
                <li><a href="#"><i class="fas fa-map-marker-alt"></i> 123 Education St, Colombo</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2025 LearnConnect. All rights reserved.</p>
    </div>
</footer>
</body>

</html>