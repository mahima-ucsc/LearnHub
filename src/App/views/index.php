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

    /* Hero Section */
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

    .hero-features {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
        margin-top: 30px;
        animation: fadeInUp 1s ease 0.6s;
        animation-fill-mode: both;
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

    .hero-feature a {
        text-decoration: none;
        color: var(--dark);
    }

    .hero-feature i {
        color: var(--dark);
    }

    /* Section Titles */
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

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
    }

    /* Advertisement */
    .premium-ad {
        margin: 50px 0 80px;
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        background: linear-gradient(45deg, rgba(255, 196, 0, 0.05) 0%, rgba(255, 196, 0, 0.1) 100%);
        border: 1px solid rgba(255, 196, 0, 0.2);
        position: relative;
        transition: var(--transition);
        margin: 0 auto;
    }

    .premium-ad:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
    }

    .ad-header {
        display: flex;
        justify-content: space-between;
        padding: 12px 20px;
        background-color: rgba(255, 196, 0, 0.15);
        align-items: center;
    }

    .ad-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 600;
        color: var(--primary-dark);
    }

    .ad-info-link {
        font-size: 12px;
        color: var(--gray-dark);
        text-decoration: none;
    }

    .ad-info-link:hover {
        text-decoration: underline;
        color: var(--primary-dark);
    }

    .ad-content {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 30px;
        padding: 30px;
    }

    .ad-media {
        position: relative;
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow);
    }

    .ad-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.8s ease;
    }

    .premium-ad:hover .ad-media img {
        transform: scale(1.05);
    }

    .ad-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background-color: var(--accent);
        color: var(--white);
        padding: 8px 15px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 14px;
        z-index: 2;
    }

    .ad-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 20px;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
    }

    .timer-container {
        color: var(--white);
        text-align: center;
    }

    .timer-label {
        font-size: 14px;
        margin-bottom: 5px;
    }

    .countdown-timer {
        font-size: 22px;
        font-weight: 700;
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .countdown-timer span {
        background-color: rgba(0, 0, 0, 0.5);
        padding: 5px 10px;
        border-radius: var(--radius-sm);
        color: var(--primary);
    }

    .ad-details {
        display: flex;
        flex-direction: column;
    }

    .partner-info {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }

    .partner-logo {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .partner-name {
        font-weight: 600;
        color: var(--primary-dark);
    }

    .ad-title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 15px;
        line-height: 1.3;
    }

    .ad-description {
        font-size: 16px;
        color: var(--gray-dark);
        margin-bottom: 20px;
        line-height: 1.6;
    }

    .ad-features {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 25px;
    }

    .ad-feature {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 15px;
        color: var(--dark);
    }

    .ad-feature i {
        color: var(--primary-dark);
    }

    .ad-footer {
        margin-top: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 20px;
        border-top: 1px solid rgba(255, 196, 0, 0.3);
    }

    .ad-pricing {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .ad-price {
        font-size: 32px;
        font-weight: 700;
        color: var(--primary-dark);
    }

    .ad-original-price {
        font-size: 18px;
        text-decoration: line-through;
        color: var(--gray-dark);
    }

    .ad-discount {
        background-color: var(--accent);
        color: white;
        padding: 5px 10px;
        border-radius: var(--radius-sm);
        font-size: 14px;
        font-weight: 600;
    }

    .ad-actions {
        display: flex;
        gap: 15px;
    }

    .btn-ad {
        padding: 12px 25px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        animation: pulse 2s infinite;
    }

    .btn-ad-secondary {
        border-color: var(--primary-dark);
    }

    /* Carousel Styles */
    .ad-carousel {
        margin: 50px 0 80px;
        position: relative;
    }

    .carousel-container {
        position: relative;
        overflow: hidden;
        border-radius: var(--radius);
    }

    .carousel-track {
        display: flex;
        transition: transform 0.5s ease;
    }

    .carousel-slide {
        min-width: 100%;
        transition: opacity 0.3s ease;
    }

    .carousel-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.8);
        border: none;
        font-size: 20px;
        color: var(--primary-dark);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .carousel-btn:hover {
        background-color: var(--primary);
        color: var(--dark);
        transform: translateY(-50%) scale(1.1);
    }

    .carousel-btn-prev {
        left: 20px;
    }

    .carousel-btn-next {
        right: 20px;
    }

    .carousel-indicators {
        display: flex;
        justify-content: center;
        gap: 10px;
        position: absolute;
        bottom: 15px;
        left: 0;
        right: 0;
        margin: 0 auto;
    }

    .carousel-indicator {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        border: none;
        background-color: rgba(255, 255, 255, 0.5);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .carousel-indicator.active {
        background-color: var(--primary);
        transform: scale(1.2);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .carousel-btn {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }

        .carousel-btn-prev {
            left: 10px;
        }

        .carousel-btn-next {
            right: 10px;
        }
    }


    /* subjects Section */
    .subjects-section {
        margin-bottom: 80px;
    }

    .subject-cards {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 25px;
    }

    .subject-cards a {
        text-decoration: none;
        color: var(--dark);
    }

    .subject-card {
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

    .subject-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-hover);
    }

    .subject-icon {
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

    .subject-card:hover .subject-icon {
        background-color: var(--primary);
        transform: scale(1.1);
    }

    .subject-name {
        font-weight: 600;
        font-size: 17px;
        margin-bottom: 5px;
    }

    .subject-count {
        color: var(--gray-dark);
        font-size: 14px;
    }

    /* Popular Tutors */
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
        background-color: var(--primary-light);
        color: var(--primary-dark);
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

    /* Testimonials Section */
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

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(255, 196, 0, 0.7);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(255, 196, 0, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(255, 196, 0, 0);
        }
    }

    /* Media Queries */
    @media (max-width: 1200px) {
        .ad-content {
            grid-template-columns: 1fr 2fr;
        }

        .resources-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 992px) {
        .hero h1 {
            font-size: 2.8rem;
        }

        .ad-content {
            grid-template-columns: 1fr;
        }

        .ad-media {
            height: 300px;
        }

        .resources-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .hub-features {
            grid-template-columns: repeat(2, 1fr);
        }

        .request-process {
            flex-direction: column;
        }

        .resource-hub-info {
            flex-direction: column;
        }

        .resource-cta {
            padding: 30px;
        }
    }

    @media (max-width: 768px) {
        .hero h1 {
            font-size: 2.3rem;
        }

        .hero p {
            font-size: 1rem;
        }

        .section-title {
            font-size: 1.8rem;
        }

        .ad-footer {
            flex-direction: column;
            gap: 20px;
            align-items: flex-start;
        }

        .resources-grid {
            grid-template-columns: 1fr;
        }

        .hub-features {
            grid-template-columns: 1fr;
        }

        .request-cards {
            grid-template-columns: 1fr;
        }

        .testimonial-cards {
            grid-template-columns: 1fr;
        }

        .course-footer {
            flex-direction: column;
            gap: 15px;
        }
    }

    @media (max-width: 576px) {
        .hero {
            padding: 50px 0;
        }

        .hero h1 {
            font-size: 2rem;
        }

        .search-bar {
            flex-direction: column;
        }

        .search-btn {
            width: 100%;
            padding: 15px;
        }

        .course-tutor {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .request-details {
            gap: 10px;
        }

        .detail-item {
            padding: 4px 8px;
            font-size: 12px;
        }
    }
</style>
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h1>Discover, Learn, Share & Grow Together</h1>
            <p>Explore courses, share valuable resources, and request custom courses tailored to your specific learning journey.</p>
            <form action="/courses" method="get" onsubmit="showLoader();">
                <div class="search-container">
                    <div class="search-bar">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" name="s" placeholder="Search for a course...">
                        <button class="search-btn">Search</button>
                    </div>
                </div>
            </form>
            <div class="hero-features">
                <div class="hero-feature">
                    <a href="/courses">
                        <i class="fas fa-graduation-cap"></i>
                        <span><?= e($roundedCourseCount); ?>+ Courses</span>

                    </a>
                </div>
                <div class="hero-feature">
                    <a href="/resource">
                        <i class="fas fa-file-alt"></i>
                        <span>Resource Hub</span>
                    </a>
                </div>
                <div class="hero-feature">
                    <a href="/course/request">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Custom Course Requests</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Advertisement Section -->
<?php if (!empty($advertisements)): ?>
    <section class="container">
        <div class="section-header">
            <div>
                <h2 class="section-title">Premium Offers</h2>
                <p class="section-description">Exclusive limited-time deals</p>
            </div>
        </div>
        <div class="ad-carousel">
            <div class="carousel-container">
                <div class="carousel-track">
                    <?php foreach ($advertisements as $ad): ?>
                        <div class="carousel-slide">
                            <div class="premium-ad">
                                <div class="ad-header">
                                    <div class="ad-label">
                                        <i class="fas fa-ad"></i> <span>Advertisement</span>
                                    </div>
                                </div>
                                <div class="ad-content">
                                    <div class="ad-media">
                                        <div class="ad-badge">Limited Time Offer</div>
                                        <img src="/storage/uploads/advertisement/thumbnail/<?php echo e($ad['thumbnail_url']); ?>" alt="Premium Course">
                                        <!-- <div class="ad-overlay">
                                            <div class="timer-container">
                                                <div class="timer-label">Offer ends in:</div>
                                                <div class="countdown-timer" data-expires="2025-05-15">
                                                    <span class="days">28</span>d
                                                    <span class="hours">14</span>h
                                                    <span class="minutes">22</span>m
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="ad-details">
                                        <div class="partner-info">
                                            <img src="/assets/images/user_placeholder.jpg" alt="Partner Logo" class="partner-logo">
                                            <span class="partner-name"><?php echo e($ad['user_name']); ?></span>
                                        </div>
                                        <h3 class="ad-title"><?php echo e($ad['title']); ?></h3>
                                        <p class="ad-description"><?php echo e($ad['description']); ?></p>
                                        <?php if (!empty($ad['features'])): ?>
                                            <div class="ad-features">
                                                <?php
                                                $features = $ad['features'];
                                                foreach ($features as $feature): ?>
                                                    <div class="ad-feature"><i class="fas fa-certificate"></i> <?php echo e($feature); ?></div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="ad-footer">
                                            <div class="ad-pricing">
                                                <div class="ad-price">Rs. <?php echo e($ad['price']) - e($ad['price']) * (e($ad['discount']) / 100); ?></div>
                                                <div class="ad-original-price">Rs. <?php echo e($ad['price']); ?></div>
                                                <div class="ad-discount"><?php echo e($ad['discount']); ?>% OFF</div>
                                            </div>
                                            <div class="ad-actions">
                                                <a href="#" class="btn btn-primary btn-ad">Claim Offer</a>
                                                <a href="#" class="btn btn-outline btn-ad-secondary">Learn More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Carousel Controls -->
                <button class="carousel-btn carousel-btn-prev"><i class="fas fa-chevron-left"></i></button>
                <button class="carousel-btn carousel-btn-next"><i class="fas fa-chevron-right"></i></button>

                <div class="carousel-indicators">
                    <?php
                    $slideCount = count($advertisements);
                    for ($i = 0; $i < $slideCount; $i++): ?>
                        <button class="carousel-indicator <?php echo $i === 0 ? 'active' : ''; ?>" data-slide="<?php echo $i; ?>"></button>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="container subjects-section">
    <h2 class="section-title">Popular Subjects</h2>
    <p class="section-description">Browse our subjects and find the right course for you</p>

    <div class="subject-cards">
        <?php foreach ($subjectCounts as $sc): ?>
            <a href="/courses?subject=<?= e($sc['subject_id']) ?>" onclick="showLoader();">
                <div class="subject-card">
                    <div class="subject-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <h3 class="subject-name"><?= e($sc['subject']); ?></h3>
                    <p class="subject-count"><?= e($sc['course_count']); ?> courses</p>
                </div>
            </a>
        <?php endforeach; ?>

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
                <a href="/resource" class="btn btn-primary">Explore Resources</a>
                <a href="/resource/create" class="btn btn-outline">Share a Resource</a>
            </div>
        </div>
    </div>

    <div class="featured-resources">
        <h3 class="subsection-title">Recent Resources</h3>
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
                    <p>Specify the subject, grade, learning objectives, and preferred teaching style etc. in your request.</p>
                </div>
            </div>

            <div class="process-step">
                <div class="step-number">2</div>
                <div class="step-content">
                    <h3>Get Matched With Tutors</h3>
                    <p>Qualified tutors will respond.</p>
                </div>
            </div>

            <div class="process-step">
                <div class="step-number">3</div>
                <div class="step-content">
                    <h3>Choose Your Perfect Course</h3>
                    <p>Review responses and select the course that best matches your needs and budget.</p>
                </div>
            </div>
        </div>

        <div class="request-examples">
            <h3 class="subsection-title">Recent Course Requests</h3>
            <div class="request-cards">
                <?php foreach ($recentCourseRequests as $request): ?>
                    <div class="request-card">
                        <div class="request-header">
                            <div class="requester">
                                <img src="/assets/images/user_placeholder.jpg" alt="Requester">
                                <span><?php echo e($request['author']); ?></span>
                            </div>
                            <div class="request-status">
                                <!-- <span class="time-posted">Posted 2 days ago</span> -->
                                <span class="time-posted">
                                    <?= e(
                                        $request["updated_date"] === $request["created_date"] ?
                                            "Posted on " . formatDate($request["created_date"], 'F j, Y') :
                                            "Edited on " . formatDate($request["updated_date"], 'F j, Y')
                                    ) ?>
                                </span>

                            </div>
                        </div>
                        <h4 class="request-title"><?php echo e($request['title']); ?></h4>
                        <div class="request-details">
                            <div class="detail-item">
                                <i class="fas fa-graduation-cap"></i>
                                <span>Grade <?php echo e($request['grade']); ?></span>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-book"></i>
                                <span>
                                    <?php echo e($request['subject']); ?>
                                </span>
                            </div>
                            <div class="detail-item">
                                <i class="fa-solid fa-location-dot"></i>
                                <span>
                                    <?php echo e($request['location']); ?>
                                </span>
                            </div>
                        </div>
                        <p class="request-brief">
                            <?php echo e(substr($request['description'], 0, 100) . (strlen($request['description']) > 100 ? '...' : '')); ?>
                        </p>
                        <div class="request-footer">
                            <span class="proposals-count"><i class="fas fa-user-tie"></i> <?php echo e($request['comments_count']); ?> comments</span>
                            <a href="/course/request/<?php echo e($request['request_id']); ?>" class="view-details">View Details</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="create-request-cta">
                <h3>Have a specific learning need?</h3>
                <p>Create a course request and get custom proposals from our expert tutors</p>
                <a href="/course/request/create" class="btn btn-primary">Create Course Request</a>
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
<script>
    // Carousel functionality
    document.addEventListener('DOMContentLoaded', function() {
        const track = document.querySelector('.carousel-track');
        const slides = Array.from(track.querySelectorAll('.carousel-slide'));
        const nextButton = document.querySelector('.carousel-btn-next');
        const prevButton = document.querySelector('.carousel-btn-prev');
        const indicators = Array.from(document.querySelectorAll('.carousel-indicator'));

        let currentIndex = 0;
        const slideWidth = 100; // 100%

        // Function to move the slide
        function moveToSlide(index) {
            if (index < 0) index = slides.length - 1;
            if (index >= slides.length) index = 0;

            track.style.transform = `translateX(-${index * slideWidth}%)`;
            currentIndex = index;

            // Update indicators
            indicators.forEach((indicator, i) => {
                indicator.classList.toggle('active', i === currentIndex);
            });
        }

        // Event listeners for buttons
        nextButton.addEventListener('click', () => moveToSlide(currentIndex + 1));
        prevButton.addEventListener('click', () => moveToSlide(currentIndex - 1));

        // Event listeners for indicators
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => moveToSlide(index));
        });

        // Auto-advance slides every 5 seconds
        let slideshowInterval = setInterval(() => moveToSlide(currentIndex + 1), 5000);

        // Pause auto-advance on hover
        const carouselContainer = document.querySelector('.carousel-container');
        carouselContainer.addEventListener('mouseenter', () => clearInterval(slideshowInterval));
        carouselContainer.addEventListener('mouseleave', () => {
            slideshowInterval = setInterval(() => moveToSlide(currentIndex + 1), 5000);
        });

        // Update countdown timers
        function updateCountdowns() {
            const countdowns = document.querySelectorAll('.countdown-timer');
            countdowns.forEach(countdown => {
                const expiresDate = new Date(countdown.dataset.expires);
                const now = new Date();
                const diff = expiresDate - now;

                if (diff > 0) {
                    const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));

                    countdown.querySelector('.days').textContent = days;
                    countdown.querySelector('.hours').textContent = hours.toString().padStart(2, '0');
                    countdown.querySelector('.minutes').textContent = minutes.toString().padStart(2, '0');
                }
            });
        }

        // Update countdown timers initially and then every minute
        updateCountdowns();
        setInterval(updateCountdowns, 60000);
    });
</script>
<?php include $this->resolve("partials/_footer.php"); ?>