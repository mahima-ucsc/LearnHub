<?php include $this->resolve("partials/_header.php"); ?>




<style>
    :root {
        --primary: #FFC400;
        --primary-dark: #e6b000;
        --primary-light: #fff0c2;
        --accent: #FF7849;
        --dark: #1A1A2E;
        --dark-2: #16213E;
        --gray-light: #f8f9fa;
        --gray: #e9ecef;
        --gray-dark: #6c757d;
        --white: #ffffff;
        --shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        --shadow-hover: 0 15px 35px rgba(0, 0, 0, 0.1);
        --radius: 12px;
        --radius-sm: 8px;
        --transition: all 0.3s ease;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        background-color: var(--gray-light);
        color: var(--dark);
        line-height: 1.6;
        overflow-x: hidden;
    }

    .container {
        max-width: 1280px;
        width: 100%;
        margin: 0 auto;
        padding: 0 20px;
    }

    .user-actions {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .btn {
        padding: 12px 24px;
        border-radius: var(--radius-sm);
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        border: none;
        font-size: 15px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-primary {
        background-color: var(--primary);
        color: var(--dark);
        box-shadow: 0 5px 15px rgba(255, 196, 0, 0.3);
    }

    .btn-primary:hover {
        background-color: var(--primary-dark);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(255, 196, 0, 0.4);
    }

    .btn-outline {
        background-color: transparent;
        border: 2px solid var(--gray);
        color: var(--dark);
    }

    .btn-outline:hover {
        border-color: var(--primary);
        color: var(--primary);
        transform: translateY(-3px);
    }

    .hero {
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
        padding: 80px 0;
        margin-bottom: 60px;
        position: relative;
        overflow: hidden;
    }

    .hero::before {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        top: -100px;
        right: -100px;
    }

    .hero::after {
        content: '';
        position: absolute;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        bottom: -50px;
        left: -50px;
    }

    .hero-content {
        position: relative;
        z-index: 1;
        text-align: center;
        max-width: 800px;
        margin: 0 auto;
    }

    .hero h1 {
        font-size: 3.5rem;
        margin-bottom: 20px;
        color: var(--dark);
        font-weight: 700;
        line-height: 1.2;
        transition: var(--transition);
        animation: fadeInUp 1s ease;
    }

    .hero p {
        font-size: 1.2rem;
        margin-bottom: 40px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        animation: fadeInUp 1s ease 0.2s;
        animation-fill-mode: both;
    }

    .search-container {
        position: relative;
        max-width: 650px;
        margin: 0 auto;
        animation: fadeInUp 1s ease 0.4s;
        animation-fill-mode: both;
    }

    .search-bar {
        position: relative;
        display: flex;
        width: 100%;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        border-radius: var(--radius);
        overflow: hidden;
        background: var(--white);
    }

    .search-bar input {
        flex: 1;
        padding: 18px 20px 18px 55px;
        border: none;
        font-size: 16px;
        outline: none;
        transition: var(--transition);
    }

    .search-bar input:focus {
        box-shadow: 0 0 0 2px var(--primary);
    }

    .search-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--primary);
        font-size: 20px;
    }

    .search-btn {
        background-color: var(--primary);
        color: var(--dark);
        border: none;
        padding: 0 30px;
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
    }

    .search-btn:hover {
        background-color: var(--primary-dark);
    }

    .search-suggestions {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background: var(--white);
        border-radius: 0 0 var(--radius) var(--radius);
        box-shadow: var(--shadow);
        margin-top: 5px;
        z-index: 10;
        padding: 15px;
        display: none;
    }

    .suggestion-title {
        font-size: 14px;
        color: var(--gray-dark);
        margin-bottom: 10px;
    }

    .suggestions-list {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .suggestion-tag {
        padding: 8px 15px;
        background: var(--gray);
        border-radius: 50px;
        font-size: 14px;
        transition: var(--transition);
        cursor: pointer;
    }

    .suggestion-tag:hover {
        background: var(--primary-light);
        color: var(--dark);
    }

    .section-title {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 20px;
        color: var(--dark);
        position: relative;
        display: inline-block;
    }

    .section-title:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -10px;
        width: 60px;
        height: 3px;
        background: var(--primary);
        border-radius: 3px;
    }

    .section-description {
        color: var(--gray-dark);
        margin-bottom: 40px;
        max-width: 600px;
    }

    .courses-section {
        margin-bottom: 80px;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
    }

    .view-options {
        display: flex;
        gap: 15px;
        background: var(--white);
        padding: 5px;
        border-radius: var(--radius-sm);
        box-shadow: var(--shadow);
    }

    .view-option {
        padding: 10px 15px;
        border-radius: var(--radius-sm);
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 14px;
        font-weight: 500;
    }

    .view-option.active {
        background-color: var(--primary);
        color: var(--dark);
    }

    .view-option:not(.active):hover {
        background-color: var(--gray);
    }

    .course-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 30px;
    }

    .feature-course-card {
        background-color: var(--white);
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .feature-course-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-hover);
    }

    .course-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background-color: var(--primary);
        color: var(--dark);
        padding: 5px 12px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: bold;
        z-index: 10;
        transition: var(--transition);
    }

    .feature-course-card:hover .course-badge {
        transform: scale(1.05);
    }

    .wishlist-btn {
        position: absolute;
        top: 15px;
        left: 15px;
        z-index: 10;
        width: 35px;
        height: 35px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
        border: none;
        font-size: 16px;
        color: var(--gray-dark);
    }

    .wishlist-btn:hover {
        background: var(--white);
        color: var(--accent);
        transform: scale(1.1);
    }

    .course-image {
        height: 200px;
        overflow: hidden;
        position: relative;
    }

    .course-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.8s ease;
    }

    .feature-course-card:hover .course-image img {
        transform: scale(1.05);
    }

    .course-content {
        padding: 25px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .course-tutor {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .tutor-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 12px;
        border: 2px solid var(--primary);
    }

    .tutor-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .tutor-info {
        display: flex;
        flex-direction: column;
    }

    .tutor-name {
        font-size: 15px;
        font-weight: 500;
        color: var(--dark);
    }

    .tutor-role {
        font-size: 13px;
        color: var(--gray-dark);
    }

    .course-title {
        font-size: 19px;
        margin-bottom: 15px;
        line-height: 1.4;
        font-weight: 600;
        color: var(--dark);
        transition: var(--transition);
    }

    .feature-course-card:hover .course-title {
        color: var(--primary);
    }

    .course-description {
        font-size: 14px;
        color: var(--gray-dark);
        margin-bottom: 20px;
        line-height: 1.6;
    }

    .course-meta {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 20px;
        font-size: 14px;
        color: var(--gray-dark);
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .meta-icon {
        color: var(--primary);
    }

    .course-stats {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
    }

    .course-stat {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: var(--gray-dark);
    }

    .course-stat i {
        color: var(--primary);
    }

    .price-container {
        margin-top: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .course-price {
        font-size: 22px;
        font-weight: bold;
        color: var(--primary-dark);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .original-price {
        font-size: 16px;
        color: var(--gray-dark);
        text-decoration: line-through;
        font-weight: normal;
    }

    .discount-badge {
        padding: 4px 8px;
        background-color: var(--accent);
        color: var(--white);
        border-radius: 4px;
        font-size: 12px;
    }

    .add-to-cart {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--primary-light);
        color: var(--primary-dark);
        transition: var(--transition);
        border: none;
        cursor: pointer;
        font-size: 16px;
    }

    .add-to-cart:hover {
        background-color: var(--primary);
        color: var(--dark);
        transform: scale(1.1);
    }

    .course-footer {
        padding: 15px 25px;
        border-top: 1px solid var(--gray);
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: var(--gray-light);
    }

    .rating {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .rating-value {
        font-weight: 600;
        color: var(--dark);
    }

    .rating-stars {
        color: var(--primary);
    }

    .rating-count {
        font-size: 13px;
        color: var(--gray-dark);
    }

    .enroll-now {
        font-size: 14px;
        font-weight: 500;
        color: var(--primary-dark);
        text-decoration: none;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .enroll-now:hover {
        color: var(--accent);
    }

    .enroll-now i {
        transition: var(--transition);
    }

    .enroll-now:hover i {
        transform: translateX(5px);
    }

    .categories-section {
        margin-bottom: 80px;
    }

    .category-cards {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 25px;
    }

    .category-card {
        background-color: var(--white);
        border-radius: var(--radius);
        padding: 30px 20px;
        text-align: center;
        box-shadow: var(--shadow);
        transition: var(--transition);
        cursor: pointer;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
        position: relative;
        overflow: hidden;
    }

    .category-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: var(--primary);
        transform: scaleX(0);
        transform-origin: right;
        transition: transform 0.5s ease;
    }

    .category-card:hover::before {
        transform: scaleX(1);
        transform-origin: left;
    }

    .category-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-hover);
    }

    .category-icon {
        width: 60px;
        height: 60px;
        background-color: var(--primary-light);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: var(--primary-dark);
        transition: var(--transition);
    }

    .category-card:hover .category-icon {
        background-color: var(--primary);
        transform: scale(1.1);
    }

    .category-name {
        font-weight: 600;
        font-size: 17px;
        margin-bottom: 5px;
    }

    .category-count {
        color: var(--gray-dark);
        font-size: 14px;
    }

    .popular-tutors {
        margin-bottom: 80px;
    }

    .popular-tutor-cards {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 30px;
    }

    .popular-tutor-card {
        background-color: var(--white);
        border-radius: var(--radius);
        padding: 30px 20px;
        text-align: center;
        box-shadow: var(--shadow);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .popular-tutor-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-hover);
    }

    .popular-tutor-card::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(60deg, transparent, rgba(255, 196, 0, 0.1), transparent);
        transform: rotate(45deg);
        transition: var(--transition);
        opacity: 0;
    }

    .popular-tutor-card:hover::after {
        animation: shine 1.5s ease;
    }

    @keyframes shine {
        0% {
            opacity: 0;
            transform: translateX(-100%) rotate(45deg);
        }

        50% {
            opacity: 1;
        }

        100% {
            opacity: 0;
            transform: translateX(100%) rotate(45deg);
        }
    }

    .tutor-profile {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto 20px;
        border: 3px solid var(--primary);
        box-shadow: 0 5px 15px rgba(255, 196, 0, 0.3);
        transition: var(--transition);
    }

    .popular-tutor-card:hover .tutor-profile {
        transform: scale(1.05);
        box-shadow: 0 8px 25px rgba(255, 196, 0, 0.4);
    }

    .tutor-profile img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
    }

    .popular-tutor-card:hover .tutor-profile img {
        transform: scale(1.1);
    }

    .popular-tutor-card h3 {
        margin-bottom: 8px;
        font-size: 20px;
        font-weight: 600;
        color: var(--dark);
    }

    .tutor-specialty {
        color: var(--primary-dark);
        margin-bottom: 15px;
        font-weight: 500;
    }

    .tutor-bio {
        font-size: 14px;
        color: var(--gray-dark);
        margin-bottom: 20px;
        line-height: 1.6;
    }

    .tutor-stats {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-bottom: 20px;
    }

    .stat {
        text-align: center;
    }

    .stat-value {
        font-weight: 700;
        color: var(--primary-dark);
        font-size: 18px;
    }

    .stat-label {
        font-size: 13px;
        color: var(--gray-dark);
    }

    .social-links {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .social-link {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background-color: var(--gray-light);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
        color: var(--gray-dark);
    }

    .social-link:hover {
        background-color: var(--primary);
        color: var(--dark);
        transform: translateY(-3px);
    }

    .testimonials-section {
        margin-bottom: 80px;
        position: relative;
        padding: 60px 0;
    }

    .testimonials-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: var(--primary-light);
        clip-path: polygon(0 15%, 100% 0, 100% 85%, 0 100%);
        z-index: -1;
    }

    .testimonial-cards {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 30px;
    }

    .testimonial-card {
        background-color: var(--white);
        border-radius: var(--radius);
        padding: 30px;
        box-shadow: var(--shadow);
        transition: var(--transition);
    }

    .testimonial-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-hover);
    }

    .testimonial-header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .testimonial-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 15px;
    }

    .testimonial-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .testimonial-info {
        flex: 1;
    }

    .testimonial-name {
        font-weight: 600;
        margin-bottom: 5px;
        font-size: 16px;
    }

    .testimonial-course {
        color: var(--gray-dark);
        font-size: 14px;
    }

    .testimonial-rating {
        color: var(--primary);
        font-size: 14px;
        margin-bottom: 5px;
    }

    .testimonial-quote {
        position: relative;
        padding-left: 25px;
        font-size: 15px;
        line-height: 1.7;
        color: var(--gray-dark);
        margin-bottom: 15px;
    }

    .testimonial-quote::before {
        content: '\f10d';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        left: 0;
        top: 0;
        color: var(--primary);
        font-size: 16px;
    }

    .testimonial-date {
        font-size: 13px;
        color: var(--gray-dark);
        text-align: right;
    }

    /* New Styles */
    /* Navigation Styles */
    .site-header {
        background-color: var(--white);
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
        position: sticky;
        top: 0;
        z-index: 100;
        padding: 15px 0;
    }

    .main-nav {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .logo {
        width: 160px;
    }

    .logo img {
        width: 100%;
        height: auto;
    }

    .nav-links {
        display: flex;
        gap: 30px;
        list-style: none;
    }

    .nav-links a {
        text-decoration: none;
        color: var(--dark);
        font-weight: 500;
        transition: var(--transition);
        position: relative;
        padding: 5px 0;
    }

    .nav-links a::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background-color: var(--primary);
        transition: var(--transition);
    }

    .nav-links a:hover::after,
    .nav-links a.active::after {
        width: 100%;
    }

    .nav-links a:hover,
    .nav-links a.active {
        color: var(--primary-dark);
    }

    .mobile-menu-toggle {
        display: none;
        cursor: pointer;
        font-size: 22px;
    }

    /* Hero Features */
    .hero-features {
        display: flex;
        justify-content: center;
        gap: 30px;
        margin-top: 40px;
        flex-wrap: wrap;
    }

    .hero-feature {
        display: flex;
        align-items: center;
        gap: 8px;
        background-color: rgba(255, 255, 255, 0.2);
        padding: 8px 16px;
        border-radius: 30px;
        font-weight: 500;
    }

    .hero-feature i {
        color: var(--dark);
    }

    /* Resource Hub Section */
    .resource-hub-section {
        margin-bottom: 80px;
    }

    .resource-hub-info {
        display: flex;
        gap: 40px;
        margin-bottom: 50px;
    }

    .hub-features {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
        flex: 2;
    }

    .feature-card {
        background-color: var(--white);
        border-radius: var(--radius);
        padding: 30px 25px;
        text-align: center;
        box-shadow: var(--shadow);
        transition: var(--transition);
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-hover);
    }

    .feature-icon {
        width: 70px;
        height: 70px;
        background-color: var(--primary-light);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: var(--primary-dark);
        margin: 0 auto 20px;
        transition: var(--transition);
    }

    .feature-card:hover .feature-icon {
        background-color: var(--primary);
        transform: scale(1.1);
    }

    .feature-card h3 {
        font-size: 18px;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .feature-card p {
        font-size: 14px;
        color: var(--gray-dark);
        line-height: 1.6;
    }

    .resource-cta {
        flex: 1;
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
        border-radius: var(--radius);
        padding: 40px 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .resource-cta h3 {
        font-size: 24px;
        margin-bottom: 20px;
        line-height: 1.4;
    }

    .cta-buttons {
        display: flex;
        gap: 15px;
    }

    .resources-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
        margin-top: 30px;
    }

    .resource-card {
        background-color: var(--white);
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
        position: relative;
        display: flex;
        flex-direction: column;
        border-left: 5px solid var(--primary);
    }

    .resource-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-hover);
    }

    .resource-type {
        position: absolute;
        top: 15px;
        right: 15px;
        background-color: var(--primary-light);
        color: var(--primary-dark);
        font-size: 12px;
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .resource-content {
        padding: 25px;
        flex-grow: 1;
    }

    .resource-content h4 {
        font-size: 18px;
        margin-bottom: 12px;
        line-height: 1.4;
        font-weight: 600;
        padding-right: 40px;
    }

    .resource-description {
        font-size: 14px;
        color: var(--gray-dark);
        margin-bottom: 15px;
        line-height: 1.6;
    }

    .resource-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
    }

    .resource-author {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .resource-author img {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        object-fit: cover;
    }

    .resource-author span {
        font-size: 14px;
        font-weight: 500;
    }

    .resource-stats {
        display: flex;
        gap: 15px;
        font-size: 13px;
        color: var(--gray-dark);
    }

    .resource-link {
        padding: 15px 25px;
        border-top: 1px solid var(--gray);
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        background-color: var(--gray-light);
        text-decoration: none;
        color: var(--primary-dark);
        font-weight: 500;
        transition: var(--transition);
    }

    .resource-link:hover {
        background-color: var(--primary-light);
        color: var(--primary-dark);
    }

    .resource-link i {
        transition: var(--transition);
    }

    .resource-link:hover i {
        transform: translateX(5px);
    }

    .subsection-title {
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 25px;
        position: relative;
        display: inline-block;
    }

    .subsection-title:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -8px;
        width: 40px;
        height: 3px;
        background: var(--primary);
        border-radius: 3px;
    }

    /* Course Request Section */
    .course-request-section {
        margin-bottom: 80px;
        background-color: var(--gray-light);
        padding: 60px 0;
        border-radius: var(--radius);
    }

    .request-content {
        display: flex;
        flex-direction: column;
        gap: 50px;
    }

    .request-process {
        display: flex;
        gap: 30px;
    }

    .process-step {
        flex: 1;
        background-color: var(--white);
        border-radius: var(--radius);
        padding: 30px;
        box-shadow: var(--shadow);
        transition: var(--transition);
        position: relative;
    }

    .process-step:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-hover);
    }

    .step-number {
        width: 40px;
        height: 40px;
        background-color: var(--primary);
        color: var(--white);
        font-weight: 700;
        font-size: 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    .step-content h3 {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 12px;
    }

    .step-content p {
        font-size: 14px;
        color: var(--gray-dark);
        line-height: 1.6;
    }

    .request-examples {
        margin-top: 50px;
    }

    .request-cards {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
        margin-bottom: 40px;
    }

    .request-card {
        background-color: var(--white);
        border-radius: var(--radius);
        padding: 25px;
        box-shadow: var(--shadow);
        transition: var(--transition);
    }

    .request-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-hover);
    }

    .request-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .requester {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .requester img {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        object-fit: cover;
    }

    .requester span {
        font-weight: 500;
    }

    .request-status {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .status-open {
        background-color: var(--success-light);
        color: var(--success);
        font-size: 12px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 20px;
        margin-bottom: 5px;
    }

    .time-posted {
        font-size: 12px;
        color: var(--gray-dark);
    }

    .request-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
        line-height: 1.4;
    }

    .request-details {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 15px;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 6px;
        background-color: var(--gray-light);
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 13px;
    }

    .detail-item i {
        color: var(--primary);
    }

    .request-brief {
        font-size: 14px;
        color: var(--gray-dark);
        line-height: 1.6;
        margin-bottom: 20px;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
        overflow: hidden;
    }

    .request-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid var(--gray);
        padding-top: 15px;
    }

    .proposals-count {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        color: var(--gray-dark);
    }

    .proposals-count i {
        color: var(--primary);
    }

    .view-details {
        font-size: 14px;
        font-weight: 500;
        color: var(--primary);
        text-decoration: none;
        transition: var(--transition);
    }

    .view-details:hover {
        color: var(--primary-dark);
        text-decoration: underline;
    }

    .create-request-cta {
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
        border-radius: var(--radius);
        padding: 40px;
        text-align: center;
    }

    .create-request-cta h3 {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 15px;
        color: var(--dark);
    }

    .create-request-cta p {
        font-size: 16px;
        margin-bottom: 25px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .btn-primary {
        background-color: var(--dark);
        color: var(--white);
        padding: 12px 30px;
        border-radius: 30px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: var(--transition);
        border: none;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: var(--dark-hover);
        transform: translateY(-3px);
    }

    /* Media Queries for Course Request Section */
    @media (max-width: 992px) {
        .request-process {
            flex-direction: column;
            gap: 20px;
        }

        .request-cards {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .course-request-section {
            padding: 40px 0;
        }

        .create-request-cta {
            padding: 30px 20px;
        }

        .create-request-cta h3 {
            font-size: 20px;
        }
    }

    @media (max-width: 576px) {
        .request-details {
            gap: 10px;
        }

        .detail-item {
            padding: 4px 8px;
            font-size: 12px;
        }

        .request-title {
            font-size: 16px;
        }

        .btn-primary {
            padding: 10px 25px;
        }
    }

    /* Membership Section */
    .membership-section {
        margin-bottom: 80px;
    }

    .membership-cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin-top: 50px;
    }

    .membership-card {
        background-color: var(--white);
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
        position: relative;
        display: flex;
        flex-direction: column;
        padding: 40px 30px;
    }

    .membership-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-hover);
    }

    .membership-card.free {
        border-top: 5px solid var(--gray-dark);
    }

    .membership-card.pro {
        border-top: 5px solid var(--primary);
        z-index: 2;
        transform: scale(1.05);
    }

    .membership-card.pro:hover {
        transform: scale(1.05) translateY(-10px);
    }

    .membership-card.premium {
        border-top: 5px solid var(--dark);
    }

    .popular-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background-color: var(--primary);
        color: var(--white);
        font-size: 12px;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 20px;
    }

    .membership-header {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 25px;
        border-bottom: 1px solid var(--gray);
    }

    .membership-title {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 15px;
        color: var(--dark);
    }

    .membership-price {
        font-size: 42px;
        font-weight: 700;
        color: var(--primary-dark);
        margin-bottom: 5px;
    }

    .membership-card.free .membership-price {
        color: var(--gray-dark);
    }

    .membership-card.premium .membership-price {
        color: var(--dark);
    }

    .price-period {
        font-size: 14px;
        color: var(--gray-dark);
    }

    .membership-features {
        display: flex;
        flex-direction: column;
        gap: 15px;
        flex-grow: 1;
        margin-bottom: 30px;
    }

    .membership-feature {
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }

    .membership-feature i {
        color: var(--success);
        font-size: 16px;
        margin-top: 2px;
    }

    .membership-feature.disabled i {
        color: var(--gray-dark);
    }

    .membership-feature span {
        font-size: 15px;
        line-height: 1.5;
    }

    .membership-feature.disabled span {
        color: var(--gray-dark);
        text-decoration: line-through;
        opacity: 0.7;
    }

    .btn-outline {
        background-color: transparent;
        color: var(--primary-dark);
        border: 2px solid var(--primary);
        padding: 12px 30px;
        border-radius: 30px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        transition: var(--transition);
        cursor: pointer;
    }

    .btn-outline:hover {
        background-color: var(--primary-light);
        transform: translateY(-3px);
    }

    .membership-card.free .btn-outline {
        color: var(--gray-dark);
        border-color: var(--gray-dark);
    }

    .membership-card.free .btn-outline:hover {
        background-color: var(--gray-light);
    }

    .membership-card.premium .btn-outline {
        color: var(--dark);
        border-color: var(--dark);
    }

    .membership-card.premium .btn-outline:hover {
        background-color: rgba(33, 37, 41, 0.1);
    }

    .btn-block {
        display: block;
        width: 100%;
    }

    /* Media Queries for Membership Section */
    @media (max-width: 1200px) {
        .membership-cards {
            gap: 20px;
        }

        .membership-card {
            padding: 30px 20px;
        }
    }

    @media (max-width: 992px) {
        .membership-cards {
            grid-template-columns: repeat(2, 1fr);
        }

        .membership-card.pro {
            grid-column: 1 / 3;
            grid-row: 1;
            margin-bottom: 20px;
        }

        .membership-card {
            transform: none;
        }

        .membership-card.pro:hover {
            transform: translateY(-10px);
        }
    }

    @media (max-width: 768px) {
        .membership-cards {
            grid-template-columns: 1fr;
        }

        .membership-card.pro {
            grid-column: auto;
            order: -1;
        }

        .membership-card {
            padding: 30px 25px;
        }
    }

    @media (max-width: 576px) {
        .membership-price {
            font-size: 36px;
        }

        .membership-title {
            font-size: 20px;
        }

        .membership-feature span {
            font-size: 14px;
        }
    }



    /* Media Queries */
    @media (max-width: 1024px) {
        .hero h1 {
            font-size: 2.8rem;
        }

        .course-grid,
        .popular-tutor-cards {
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .nav-links {
            display: none;
        }

        .hero h1 {
            font-size: 2.3rem;
        }

        .hero p {
            font-size: 1rem;
        }

        .search-bar {
            flex-direction: column;
        }

        .search-btn {
            width: 100%;
            padding: 15px;
        }



        .section-title {
            font-size: 1.8rem;
        }

        .course-grid,
        .category-cards,
        .popular-tutor-cards,
        .testimonial-cards {
            grid-template-columns: 1fr;
        }

        .testimonials-section {
            padding: 30px 20px;
        }
    }

    @media (max-width: 480px) {
        .hero {
            padding: 50px 0;
        }

        .hero h1 {
            font-size: 2rem;
        }

        .user-actions {
            display: none;
        }

        .course-tutor {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .course-footer {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }

    }
</style>
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h1>Discover, Learn, Share & Grow Together</h1>
            <p>Explore thousands of courses, share valuable resources, and request custom courses tailored to your specific learning journey.</p>
            <div class="search-container">
                <div class="search-bar">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" placeholder="Search for courses, resources, tutors, or skills...">
                    <button class="search-btn">Search</button>
                </div>
                <div class="search-suggestions">
                    <p class="suggestion-title">Popular Searches:</p>
                    <div class="suggestions-list">
                        <div class="suggestion-tag">Web Development</div>
                        <div class="suggestion-tag">Data Science</div>
                        <div class="suggestion-tag">Mobile Apps</div>
                        <div class="suggestion-tag">Digital Marketing</div>
                        <div class="suggestion-tag">UI/UX Design</div>
                    </div>
                </div>
            </div>
            <div class="hero-features">
                <div class="hero-feature">
                    <i class="fas fa-graduation-cap"></i>
                    <span>2,500+ Courses</span>
                </div>
                <div class="hero-feature">
                    <i class="fas fa-file-alt"></i>
                    <span>Resource Hub</span>
                </div>
                <div class="hero-feature">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Custom Course Requests</span>
                </div>
                <div class="hero-feature">
                    <i class="fas fa-users"></i>
                    <span>Community Support</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container courses-section">
    <div class="section-header">
        <div>
            <h2 class="section-title">Featured Courses</h2>
            <p class="section-description">Explore our most popular courses with highest ratings and enrollments</p>
        </div>
        <div class="view-options">
            <div class="view-option active">
                <i class="fas fa-th"></i> Grid
            </div>
            <div class="view-option">
                <i class="fas fa-list"></i> List
            </div>
        </div>
    </div>

    <div class="course-grid">
        <!-- Course 1 -->
        <div class="feature-course-card">
            <div class="course-badge">Bestseller</div>
            <button class="wishlist-btn">
                <i class="far fa-heart"></i>
            </button>
            <div class="course-image">
                <img src="/assets/images/intro-to-web.jpg" alt="Web Development">
            </div>
            <div class="course-content">
                <div class="course-tutor">
                    <div class="tutor-avatar">
                        <img src="/assets/images/user_placeholder.jpg" alt="John Doe">
                    </div>
                    <div class="tutor-info">
                        <div class="tutor-name">John Doe</div>
                        <div class="tutor-role">Lead Developer</div>
                    </div>
                </div>
                <h3 class="course-title">Complete Web Development Bootcamp 2023</h3>
                <p class="course-description">Learn web development from scratch with HTML, CSS, JavaScript, Node.js and more. Build real-world projects.</p>
                <div class="course-meta">
                    <div class="meta-item">
                        <i class="fas fa-clock meta-icon"></i> 52 hours
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-video meta-icon"></i> 75 lectures
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-signal meta-icon"></i> All levels
                    </div>
                </div>
                <div class="course-stats">
                    <div class="course-stat">
                        <i class="fas fa-user-graduate"></i>
                        <span>8,240 students</span>
                    </div>
                    <div class="course-stat">
                        <i class="fas fa-certificate"></i>
                        <span>Certificate</span>
                    </div>
                </div>
                <div class="price-container">
                    <div class="course-price">
                        $49.99
                        <span class="original-price">$199.99</span>
                        <span class="discount-badge">75% OFF</span>
                    </div>
                    <button class="add-to-cart">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                </div>
            </div>
            <div class="course-footer">
                <div class="rating">
                    <span class="rating-value">4.8</span>
                    <div class="rating-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="rating-count">(1,245)</span>
                </div>
                <a href="#" class="enroll-now">
                    View Course <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Course 2 -->
        <div class="feature-course-card">
            <div class="course-badge">Bestseller</div>
            <button class="wishlist-btn">
                <i class="far fa-heart"></i>
            </button>
            <div class="course-image">
                <img src="/assets/images/intro-to-web.jpg" alt="Web Development">
            </div>
            <div class="course-content">
                <div class="course-tutor">
                    <div class="tutor-avatar">
                        <img src="/assets/images/user_placeholder.jpg" alt="John Doe">
                    </div>
                    <div class="tutor-info">
                        <div class="tutor-name">John Doe</div>
                        <div class="tutor-role">Lead Developer</div>
                    </div>
                </div>
                <h3 class="course-title">Complete Web Development Bootcamp 2023</h3>
                <p class="course-description">Learn web development from scratch with HTML, CSS, JavaScript, Node.js and more. Build real-world projects.</p>
                <div class="course-meta">
                    <div class="meta-item">
                        <i class="fas fa-clock meta-icon"></i> 52 hours
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-video meta-icon"></i> 75 lectures
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-signal meta-icon"></i> All levels
                    </div>
                </div>
                <div class="course-stats">
                    <div class="course-stat">
                        <i class="fas fa-user-graduate"></i>
                        <span>8,240 students</span>
                    </div>
                    <div class="course-stat">
                        <i class="fas fa-certificate"></i>
                        <span>Certificate</span>
                    </div>
                </div>
                <div class="price-container">
                    <div class="course-price">
                        $49.99
                        <span class="original-price">$199.99</span>
                        <span class="discount-badge">75% OFF</span>
                    </div>
                    <button class="add-to-cart">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                </div>
            </div>
            <div class="course-footer">
                <div class="rating">
                    <span class="rating-value">4.8</span>
                    <div class="rating-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="rating-count">(1,245)</span>
                </div>
                <a href="#" class="enroll-now">
                    View Course <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Course 3 -->
        <div class="feature-course-card">
            <div class="course-badge">Bestseller</div>
            <button class="wishlist-btn">
                <i class="far fa-heart"></i>
            </button>
            <div class="course-image">
                <img src="/assets/images/intro-to-web.jpg" alt="Web Development">
            </div>
            <div class="course-content">
                <div class="course-tutor">
                    <div class="tutor-avatar">
                        <img src="/assets/images/user_placeholder.jpg" alt="John Doe">
                    </div>
                    <div class="tutor-info">
                        <div class="tutor-name">John Doe</div>
                        <div class="tutor-role">Lead Developer</div>
                    </div>
                </div>
                <h3 class="course-title">Complete Web Development Bootcamp 2023</h3>
                <p class="course-description">Learn web development from scratch with HTML, CSS, JavaScript, Node.js and more. Build real-world projects.</p>
                <div class="course-meta">
                    <div class="meta-item">
                        <i class="fas fa-clock meta-icon"></i> 52 hours
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-video meta-icon"></i> 75 lectures
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-signal meta-icon"></i> All levels
                    </div>
                </div>
                <div class="course-stats">
                    <div class="course-stat">
                        <i class="fas fa-user-graduate"></i>
                        <span>8,240 students</span>
                    </div>
                    <div class="course-stat">
                        <i class="fas fa-certificate"></i>
                        <span>Certificate</span>
                    </div>
                </div>
                <div class="price-container">
                    <div class="course-price">
                        $49.99
                        <span class="original-price">$199.99</span>
                        <span class="discount-badge">75% OFF</span>
                    </div>
                    <button class="add-to-cart">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                </div>
            </div>
            <div class="course-footer">
                <div class="rating">
                    <span class="rating-value">4.8</span>
                    <div class="rating-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="rating-count">(1,245)</span>
                </div>
                <a href="#" class="enroll-now">
                    View Course <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="container categories-section">
    <h2 class="section-title">Popular Categories</h2>
    <p class="section-description">Browse our top categories and find the right course for you</p>

    <div class="category-cards">
        <div class="category-card">
            <div class="category-icon">
                <i class="fas fa-code"></i>
            </div>
            <h3 class="category-name">Development</h3>
            <p class="category-count">1,240 courses</p>
        </div>

        <div class="category-card">
            <div class="category-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <h3 class="category-name">Business</h3>
            <p class="category-count">840 courses</p>
        </div>

        <div class="category-card">
            <div class="category-icon">
                <i class="fas fa-palette"></i>
            </div>
            <h3 class="category-name">Design</h3>
            <p class="category-count">760 courses</p>
        </div>

        <div class="category-card">
            <div class="category-icon">
                <i class="fas fa-bullhorn"></i>
            </div>
            <h3 class="category-name">Marketing</h3>
            <p class="category-count">620 courses</p>
        </div>

        <div class="category-card">
            <div class="category-icon">
                <i class="fas fa-camera"></i>
            </div>
            <h3 class="category-name">Photography</h3>
            <p class="category-count">420 courses</p>
        </div>

        <div class="category-card">
            <div class="category-icon">
                <i class="fas fa-music"></i>
            </div>
            <h3 class="category-name">Music</h3>
            <p class="category-count">380 courses</p>
        </div>
    </div>
</section>

<section class="container popular-tutors">
    <h2 class="section-title">Popular Tutors</h2>
    <p class="section-description">Learn from the best experts in their fields</p>

    <div class="popular-tutor-cards">
        <div class="popular-tutor-card">
            <div class="tutor-profile">
                <img src="/assets/images/user_placeholder.jpg" alt="John Doe">
            </div>
            <h3>John Doe</h3>
            <p class="tutor-specialty">Web Development Expert</p>
            <p class="tutor-bio">10+ years of experience in full-stack web development and teaching thousands of students worldwide.</p>
            <div class="tutor-stats">
                <div class="stat">
                    <div class="stat-value">12</div>
                    <div class="stat-label">Courses</div>
                </div>
                <div class="stat">
                    <div class="stat-value">15k+</div>
                    <div class="stat-label">Students</div>
                </div>
                <div class="stat">
                    <div class="stat-value">4.9</div>
                    <div class="stat-label">Rating</div>
                </div>
            </div>
            <div class="social-links">
                <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                <a href="#" class="social-link"><i class="fas fa-globe"></i></a>
            </div>
            <a href="#" class="btn btn-outline">View Profile</a>
        </div>

        <div class="popular-tutor-card">
            <div class="tutor-profile">
                <img src="/assets/images/user_placeholder.jpg" alt="Jane Smith">
            </div>
            <h3>Jane Smith</h3>
            <p class="tutor-specialty">Data Science Expert</p>
            <p class="tutor-bio">PhD in Computer Science with expertise in machine learning and artificial intelligence. Former Google Research Scientist.</p>
            <div class="tutor-stats">
                <div class="stat">
                    <div class="stat-value">8</div>
                    <div class="stat-label">Courses</div>
                </div>
                <div class="stat">
                    <div class="stat-value">12k+</div>
                    <div class="stat-label">Students</div>
                </div>
                <div class="stat">
                    <div class="stat-value">4.8</div>
                    <div class="stat-label">Rating</div>
                </div>
            </div>
            <div class="social-links">
                <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                <a href="#" class="social-link"><i class="fas fa-globe"></i></a>
            </div>
            <a href="#" class="btn btn-outline">View Profile</a>
        </div>
        <!-- Add more tutor cards if needed -->
    </div>
</section>
<section class="container resource-hub-section">
    <h2 class="section-title">Resource Hub</h2>
    <p class="section-description">Share and discover learning resources with our growing community</p>

    <div class="resource-hub-info">
        <div class="hub-features">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-share-alt"></i>
                </div>
                <h3>Share Your Knowledge</h3>
                <p>Upload articles, tutorials, tools, and materials to help fellow learners.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-download"></i>
                </div>
                <h3>Access Quality Resources</h3>
                <p>Browse curated educational content from experts and peers.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-comments"></i>
                </div>
                <h3>Engage & Collaborate</h3>
                <p>Discuss resources, provide feedback, and connect with contributors.</p>
            </div>
        </div>

        <div class="resource-cta">
            <h3>Ready to share or discover resources?</h3>
            <div class="cta-buttons">
                <a href="#" class="btn btn-primary">Explore Resources</a>
                <a href="#" class="btn btn-outline">Share a Resource</a>
            </div>
        </div>
    </div>

    <div class="featured-resources">
        <h3 class="subsection-title">Top Resources This Week</h3>
        <div class="resources-grid">
            <!-- Resource Card 1 -->
            <div class="resource-card">
                <div class="resource-type">
                    <i class="fas fa-file-pdf"></i>
                    <span>PDF</span>
                </div>
                <div class="resource-content">
                    <h4>Complete JavaScript Cheat Sheet</h4>
                    <p class="resource-description">A comprehensive reference guide covering all JavaScript fundamentals and advanced concepts.</p>
                    <div class="resource-meta">
                        <div class="resource-author">
                            <img src="/assets/images/user_placeholder.jpg" alt="User">
                            <span>Alex Johnson</span>
                        </div>
                        <div class="resource-stats">
                            <span><i class="fas fa-download"></i> 2.4k</span>
                            <span><i class="fas fa-star"></i> 4.8</span>
                        </div>
                    </div>
                </div>
                <a href="#" class="resource-link">Download <i class="fas fa-arrow-right"></i></a>
            </div>

            <!-- Resource Card 2 -->
            <div class="resource-card">
                <div class="resource-type">
                    <i class="fas fa-video"></i>
                    <span>Video</span>
                </div>
                <div class="resource-content">
                    <h4>React Hooks Deep Dive Tutorial</h4>
                    <p class="resource-description">Master React Hooks with this in-depth tutorial showing practical use cases and best practices.</p>
                    <div class="resource-meta">
                        <div class="resource-author">
                            <img src="/assets/images/user_placeholder.jpg" alt="User">
                            <span>Maria Garcia</span>
                        </div>
                        <div class="resource-stats">
                            <span><i class="fas fa-eye"></i> 3.1k</span>
                            <span><i class="fas fa-star"></i> 4.9</span>
                        </div>
                    </div>
                </div>
                <a href="#" class="resource-link">Watch <i class="fas fa-arrow-right"></i></a>
            </div>

            <!-- Resource Card 3 -->
            <div class="resource-card">
                <div class="resource-type">
                    <i class="fas fa-link"></i>
                    <span>Tool</span>
                </div>
                <div class="resource-content">
                    <h4>UI/UX Design Resources Bundle</h4>
                    <p class="resource-description">Collection of premium design assets, templates, and tools for modern UI/UX designers.</p>
                    <div class="resource-meta">
                        <div class="resource-author">
                            <img src="/assets/images/user_placeholder.jpg" alt="User">
                            <span>David Kim</span>
                        </div>
                        <div class="resource-stats">
                            <span><i class="fas fa-download"></i> 1.8k</span>
                            <span><i class="fas fa-star"></i> 4.7</span>
                        </div>
                    </div>
                </div>
                <a href="#" class="resource-link">Access <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<section class="container course-request-section">
    <div class="section-header">
        <div>
            <h2 class="section-title">Request a Course</h2>
            <p class="section-description">Can't find what you're looking for? Request a specific course and get matched with expert tutors</p>
        </div>
    </div>

    <div class="request-content">
        <div class="request-process">
            <div class="process-step">
                <div class="step-number">1</div>
                <div class="step-content">
                    <h3>Define Your Learning Needs</h3>
                    <p>Specify the subject, skill level, learning objectives, and preferred teaching style in your request.</p>
                </div>
            </div>

            <div class="process-step">
                <div class="step-number">2</div>
                <div class="step-content">
                    <h3>Get Matched With Tutors</h3>
                    <p>Qualified tutors will respond with customized course proposals tailored to your requirements.</p>
                </div>
            </div>

            <div class="process-step">
                <div class="step-number">3</div>
                <div class="step-content">
                    <h3>Choose Your Perfect Course</h3>
                    <p>Review proposals, chat with tutors, and select the course that best matches your needs and budget.</p>
                </div>
            </div>
        </div>

        <div class="request-examples">
            <h3 class="subsection-title">Recent Course Requests</h3>
            <div class="request-cards">
                <div class="request-card">
                    <div class="request-header">
                        <div class="requester">
                            <img src="/assets/images/user_placeholder.jpg" alt="Requester">
                            <span>Thomas W.</span>
                        </div>
                        <div class="request-status">
                            <span class="status-open">Open</span>
                            <span class="time-posted">Posted 2 days ago</span>
                        </div>
                    </div>
                    <h4 class="request-title">Advanced Machine Learning for Financial Analysis</h4>
                    <div class="request-details">
                        <div class="detail-item">
                            <i class="fas fa-graduation-cap"></i>
                            <span>Advanced Level</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-clock"></i>
                            <span>30-40 hours</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-dollar-sign"></i>
                            <span>Budget: $300-500</span>
                        </div>
                    </div>
                    <p class="request-brief">Looking for a comprehensive course on applying ML algorithms for financial data analysis, risk assessment, and predictive modeling. Need practical projects with real-world datasets...</p>
                    <div class="request-footer">
                        <span class="proposals-count"><i class="fas fa-user-tie"></i> 6 Tutor Proposals</span>
                        <a href="#" class="view-details">View Details</a>
                    </div>
                </div>

                <div class="request-card">
                    <div class="request-header">
                        <div class="requester">
                            <img src="/assets/images/user_placeholder.jpg" alt="Requester">
                            <span>Priya M.</span>
                        </div>
                        <div class="request-status">
                            <span class="status-open">Open</span>
                            <span class="time-posted">Posted 1 week ago</span>
                        </div>
                    </div>
                    <h4 class="request-title">UX Research Methods for Product Teams</h4>
                    <div class="request-details">
                        <div class="detail-item">
                            <i class="fas fa-graduation-cap"></i>
                            <span>Intermediate Level</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-clock"></i>
                            <span>20-25 hours</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-dollar-sign"></i>
                            <span>Budget: $200-350</span>
                        </div>
                    </div>
                    <p class="request-brief">Seeking a practical course on UX research methods suitable for product managers and designers. Should cover user interviews, usability testing, data analysis...</p>
                    <div class="request-footer">
                        <span class="proposals-count"><i class="fas fa-user-tie"></i> 12 Tutor Proposals</span>
                        <a href="#" class="view-details">View Details</a>
                    </div>
                </div>
            </div>

            <div class="create-request-cta">
                <h3>Have a specific learning need?</h3>
                <p>Create a course request and get custom proposals from our expert tutors</p>
                <a href="#" class="btn btn-primary">Create Course Request</a>
            </div>
        </div>
    </div>
</section>



<!-- Testimonials Section -->
<section class="container testimonials-section">
    <div class="testimonials-bg"></div>
    <h2 class="section-title">What Our Students Say</h2>
    <p class="section-description">Hear from our satisfied learners who have transformed their careers</p>
    <div class="testimonial-cards">
        <div class="testimonial-card">
            <div class="testimonial-header">
                <div class="testimonial-avatar">
                    <img src="/assets/images/user_placeholder.jpg" alt="Emily Johnson">
                </div>
                <div class="testimonial-info">
                    <div class="testimonial-name">Emily Johnson</div>
                    <div class="testimonial-course">Web Development Bootcamp</div>
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
            <p class="testimonial-quote">"This course changed my life! I went from knowing nothing about coding to landing a job as a junior developer in just 6 months. The instructors are amazing!"</p>
            <div class="testimonial-date">2 weeks ago</div>
        </div>
        <div class="testimonial-card">
            <div class="testimonial-header">
                <div class="testimonial-avatar">
                    <img src="/assets/images/user_placeholder.jpg" alt="Michael Chen">
                </div>
                <div class="testimonial-info">
                    <div class="testimonial-name">Michael Chen</div>
                    <div class="testimonial-course">Data Science Masterclass</div>
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
            <p class="testimonial-quote">"The depth of knowledge and practical examples in this course are unparalleled. I've applied what I learned directly to my work projects."</p>
            <div class="testimonial-date">1 month ago</div>
        </div>
        <div class="testimonial-card">
            <div class="testimonial-header">
                <div class="testimonial-avatar">
                    <img src="/assets/images/user_placeholder.jpg" alt="Sarah Williams">
                </div>
                <div class="testimonial-info">
                    <div class="testimonial-name">Sarah Williams</div>
                    <div class="testimonial-course">UI/UX Design</div>
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
            <p class="testimonial-quote">"I loved the hands-on approach and the real-world projects. The feedback from the tutors was invaluable in improving my design skills."</p>
            <div class="testimonial-date">3 weeks ago</div>
        </div>
    </div>
</section>
<?php include $this->resolve("partials/_footer.php"); ?>