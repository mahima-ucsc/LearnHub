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
        --success: #28a745;
        --success-light: #e6f7e9;
    }

    .resource-container {
        max-width: 1280px;
        width: 100%;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Hero Section */
    .resource-hero {
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
        padding: 60px 0;
        margin-bottom: 50px;
        position: relative;
        overflow: hidden;
    }

    .resource-hero::before {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        top: -100px;
        right: -100px;
    }

    .resource-hero::after {
        content: '';
        position: absolute;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        bottom: -50px;
        left: -50px;
    }

    .resource-hero-content {
        position: relative;
        z-index: 1;
        text-align: center;
        max-width: 800px;
        margin: 0 auto;
    }

    .resource-hero h1 {
        font-size: 2.8rem;
        margin-bottom: 20px;
        color: var(--dark);
        font-weight: 700;
        line-height: 1.2;
    }

    .resource-hero p {
        font-size: 1.1rem;
        margin-bottom: 30px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .resource-hero-stats {
        display: flex;
        justify-content: center;
        gap: 30px;
        margin-top: 30px;
        flex-wrap: wrap;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 8px;
        background-color: rgba(255, 255, 255, 0.2);
        padding: 8px 16px;
        border-radius: 30px;
        font-weight: 500;
    }

    .stat-item i {
        color: var(--dark);
    }

    /* Search & Filter Section */
    .search-filter-section {
        margin-bottom: 40px;
    }

    .resource-search-container {
        display: flex;
        background: var(--white);
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow);
        margin-bottom: 20px;
    }

    .search-input {
        flex: 1;
        padding: 15px 20px;
        border: none;
        outline: none;
        font-size: 16px;
    }

    .search-btn {
        background-color: var(--primary);
        color: var(--dark);
        border: none;
        padding: 0 25px;
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
    }

    .search-btn:hover {
        background-color: var(--primary-dark);
    }

    .filters {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 20px;
    }

    .filter-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .filter-label {
        font-weight: 500;
        font-size: 14px;
    }

    .filter-select {
        padding: 8px 15px;
        border-radius: var(--radius-sm);
        border: 1px solid var(--gray);
        background-color: var(--white);
        outline: none;
        transition: var(--transition);
    }

    .filter-select:focus {
        border-color: var(--primary);
    }

    .tag-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 15px;
    }

    /* Resource Actions */
    .resource-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .action-btns {
        display: flex;
        gap: 15px;
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


    /* Resource Grid */
    .resources-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
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
        z-index: 1;
    }

    .resource-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background-color: var(--primary);
        color: var(--dark);
        font-size: 12px;
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 20px;
        z-index: 1;
    }

    .resource-content {
        padding: 25px;
        padding-top: 50px;
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
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .resource-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 15px;
    }

    .resource-tag {
        background-color: var(--gray-light);
        padding: 4px 10px;
        border-radius: 30px;
        font-size: 12px;
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

    .resource-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 25px;
        border-top: 1px solid var(--gray);
        background-color: var(--gray-light);
    }

    .resource-price {
        font-weight: 700;
        color: var(--primary-dark);
        font-size: 18px;
    }

    .resource-price.free {
        color: var(--success);
    }

    .resource-link {
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        color: var(--primary-dark);
        font-weight: 500;
        font-size: 14px;
        transition: var(--transition);
    }

    .resource-link:hover {
        color: var(--accent);
    }

    .resource-link i {
        transition: var(--transition);
    }

    .resource-link:hover i {
        transform: translateX(5px);
    }

    /* Share Resource CTA */
    .share-resource-cta {
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
        padding: 40px;
        border-radius: var(--radius);
        text-align: center;
        margin: 50px 0;
    }

    .share-resource-cta h2 {
        font-size: 28px;
        margin-bottom: 15px;
    }

    .share-resource-cta p {
        font-size: 16px;
        max-width: 700px;
        margin: 0 auto 25px;
    }

    /* Pagination */
    .pagination {
        display: flex;
        justify-content: center;
        gap: 5px;
        margin: 40px 0;
    }

    .pagination-item {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--radius-sm);
        cursor: pointer;
        transition: var(--transition);
        font-weight: 500;
        background-color: var(--white);
        box-shadow: var(--shadow);
    }

    .pagination-item.active {
        background-color: var(--primary);
        color: var(--dark);
    }

    .pagination-item:hover:not(.active) {
        background-color: var(--gray);
    }

    /* Resource Preview Modal Styles */
    .resource-preview-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1000;
        font-family: 'Poppins', sans-serif;
    }

    .resource-preview-modal.active {
        display: block;
    }

    .modal-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(5px);
    }

    .resource-modal-container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 90%;
        max-width: 800px;
        max-height: 90vh;
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .modal-header {
        padding: 20px;
        border-bottom: 1px solid #e9ecef;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-title {
        font-size: 20px;
        font-weight: 600;
        margin: 0;
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
        color: #6c757d;
        transition: color 0.3s;
    }

    .modal-close:hover {
        color: #ff7849;
    }

    .modal-content {
        padding: 20px;
        overflow-y: auto;
        max-height: calc(90vh - 140px);
    }

    .modal-footer {
        padding: 20px;
        border-top: 1px solid #e9ecef;
        display: flex;
        justify-content: flex-end;
        gap: 15px;
    }

    .preview-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .preview-type {
        background-color: #FFF0C2;
        color: #e6b000;
        font-size: 14px;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 20px;
        display: inline-block;
    }

    .preview-badge {
        background-color: #FFC400;
        color: #1A1A2E;
        font-size: 14px;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 20px;
    }

    .preview-badge.free {
        background-color: #e6f7e9;
        color: #28a745;
    }

    .preview-description {
        margin-bottom: 20px;
        line-height: 1.6;
    }

    .preview-details {
        margin-bottom: 25px;
    }

    .preview-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 15px;
    }

    .preview-tag {
        background-color: #f8f9fa;
        padding: 5px 12px;
        border-radius: 30px;
        font-size: 13px;
    }

    .preview-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .preview-author {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .preview-author img {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        object-fit: cover;
    }

    .preview-stats {
        display: flex;
        gap: 15px;
        font-size: 14px;
        color: #6c757d;
    }

    .preview-sample {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 20px;
    }

    .preview-sample h4 {
        margin-bottom: 15px;
        font-size: 18px;
    }

    .code-preview {
        background-color: #1A1A2E;
        color: #ffffff;
        padding: 15px;
        border-radius: 8px;
        font-family: monospace;
        white-space: pre;
        overflow-x: auto;
    }

    .video-preview,
    .document-preview,
    .generic-preview {
        background-color: #e9ecef;
        border-radius: 8px;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .video-placeholder,
    .document-page {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        color: #6c757d;
    }

    .video-placeholder i,
    .document-page i,
    .generic-preview i {
        font-size: 40px;
    }

    .preview-price {
        font-size: 18px;
        color: #1A1A2E;
    }

    /* Make resource cards have cursor pointer to indicate clickability */
    .resource-card {
        cursor: pointer;
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .resource-modal-container {
            width: 95%;
        }

        .modal-content {
            padding: 15px;
        }

        .modal-footer {
            flex-direction: column;
        }

        .modal-footer button,
        .modal-footer a {
            width: 100%;
        }

        .preview-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
    }

    /* Responsive Styles */
    @media (max-width: 992px) {
        .resource-hero h1 {
            font-size: 2.3rem;
        }

        .resources-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .filters {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    @media (max-width: 768px) {
        .resource-hero {
            padding: 40px 0;
        }

        .resource-hero h1 {
            font-size: 2rem;
        }

        .resource-hero-stats {
            gap: 15px;
        }

        .resource-actions {
            flex-direction: column;
            gap: 20px;
            align-items: flex-start;
        }

    }

    @media (max-width: 576px) {
        .resources-grid {
            grid-template-columns: 1fr;
        }

        .action-btns {
            width: 100%;
        }

        .btn {
            width: 100%;
        }

        .resource-footer {
            flex-direction: column;
            gap: 15px;
        }
    }
</style>
</head>

<body>
    <!-- Hero Section -->
    <section class="resource-hero">
        <div class="resource-container">
            <div class="resource-hero-content">
                <h1>Resource Hub</h1>
                <p>Discover high-quality learning resources shared by the community. Find tutorials, guides, templates, and tools to enhance your learning journey.</p>
                <div class="resource-hero-stats">
                    <div class="stat-item">
                        <i class="fas fa-book"></i>
                        <span>2,500+ Resources</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-users"></i>
                        <span>1,200+ Contributors</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-download"></i>
                        <span>350K+ Downloads</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="resource-container">
        <!-- Search & Filter Section -->
        <section class="search-filter-section">
            <div class="resource-search-container">
                <input type="text" class="search-input" placeholder="Search for resources...">
                <button class="search-btn">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
            <div class="filters">
                <div class="filter-group">
                    <span class="filter-label">Type:</span>
                    <select class="filter-select">
                        <option value="all">All Types</option>
                        <option value="pdf">PDF</option>
                        <option value="video">Video</option>
                        <option value="code">Code</option>
                        <option value="template">Template</option>
                        <option value="tutorial">Tutorial</option>
                        <option value="tool">Tool</option>
                    </select>
                </div>
                <div class="filter-group">
                    <span class="filter-label">Category:</span>
                    <select class="filter-select">
                        <option value="all">All Categories</option>
                        <option value="programming">Programming</option>
                        <option value="design">Design</option>
                        <option value="marketing">Marketing</option>
                        <option value="data-science">Data Science</option>
                        <option value="business">Business</option>
                    </select>
                </div>
                <div class="filter-group">
                    <span class="filter-label">Price:</span>
                    <select class="filter-select">
                        <option value="all">All Prices</option>
                        <option value="free">Free</option>
                        <option value="paid">Paid</option>
                    </select>
                </div>
                <div class="filter-group">
                    <span class="filter-label">Sort By:</span>
                    <select class="filter-select">
                        <option value="newest">Newest First</option>
                        <option value="popular">Most Popular</option>
                        <option value="rating">Highest Rated</option>
                        <option value="downloads">Most Downloads</option>
                    </select>
                </div>
            </div>
        </section>

        <!-- Resource Actions -->
        <section class="resource-actions">
            <div class="action-btns">
                <a href="#" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Share a Resource
                </a>
                <a href="#" class="btn btn-outline">
                    <i class="fas fa-bookmark"></i> My Bookmarks
                </a>
            </div>
        </section>

        <!-- Resources Grid -->
        <section class="resources-grid">
            <?php foreach ($resources as $resource): ?>
                <div class="resource-card">
                    <div class="resource-type">
                        <i class="fas fa-file-pdf"></i>
                        <span><?php echo e($resource['resource_type']); ?></span>
                    </div>
                    <div class="resource-badge">Trending</div>
                    <div class="resource-content">
                        <h4><?php echo e($resource['title']); ?></h4>
                        <p class="resource-description"><?php echo e($resource['description']); ?></p>
                        <div class="resource-tags">
                            <span class="resource-tag">JavaScript</span>
                            <span class="resource-tag">Web Dev</span>
                            <span class="resource-tag">Front-end</span>
                        </div>
                        <div class="resource-meta">
                            <div class="resource-author">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Alex Johnson">
                                <span><?php echo e($resource['username']); ?></span>
                            </div>
                            <div class="resource-stats">
                                <span><i class="fas fa-download"></i> 2.4k</span>
                                <span><i class="fas fa-star"></i> 4.8</span>
                            </div>
                        </div>
                    </div>
                    <div class="resource-footer">
                        <?php if ($resource['is_free'] == 1): ?>
                            <div class="resource-price free">Free</div>
                            <a href="#" class="resource-link">Download <i class="fas fa-arrow-right"></i></a>
                        <?php else: ?>
                            <div class="resource-price">Rs.<?php echo e($resource['price']); ?></div>
                            <a href="#" class="resource-link">Preview <i class="fas fa-arrow-right"></i></a>
                        <?php endif; ?>
                    </div>
                </div>

            <?php endforeach; ?>
        </section>

        <!-- Share Resource CTA -->
        <section class="share-resource-cta">
            <h2>Have knowledge to share?</h2>
            <p>Share your own learning resources with the community. Whether it's a tutorial, guide, template, or tool, your contribution can help others learn and grow.</p>
            <a href="#" class="btn btn-primary">
                <i class="fas fa-upload"></i> Share Your Resource
            </a>
        </section>

        <!-- Pagination -->
        <div class="pagination">
            <div class="pagination-item">
                <i class="fas fa-chevron-left"></i>
            </div>
            <div class="pagination-item active">1</div>
            <div class="pagination-item">2</div>
            <div class="pagination-item">3</div>
            <div class="pagination-item">4</div>
            <div class="pagination-item">
                <i class="fas fa-chevron-right"></i>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- ELEMENT SELECTIONS ---
            const resourceGrid = document.querySelector('.resources-grid');
            const searchInput = document.querySelector('.search-input');
            const searchBtn = document.querySelector('.search-btn');
            const filterSelects = document.querySelectorAll('.filter-select');
            const paginationItems = document.querySelectorAll('.pagination-item');
            const resourceCards = document.querySelectorAll('.resource-card');
            const previewLinks = document.querySelectorAll('.resource-link');


            // --- SEARCH FUNCTIONALITY ---
            searchBtn.addEventListener('click', performSearch);
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    performSearch();
                }
            });

            function performSearch() {
                const searchTerm = searchInput.value.toLowerCase().trim();

                if (searchTerm === '') {
                    // If search is empty, show all resources
                    resourceCards.forEach(card => {
                        card.style.display = 'flex';
                    });
                    return;
                }

                // Hide/show resources based on search term
                resourceCards.forEach(card => {
                    const title = card.querySelector('h4').textContent.toLowerCase();
                    const description = card.querySelector('.resource-description').textContent.toLowerCase();

                    if (title.includes(searchTerm) ||
                        description.includes(searchTerm)) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            // --- FILTERING FUNCTIONALITY ---
            filterSelects.forEach(select => {
                select.addEventListener('change', applyFilters);
            });

            function applyFilters() {
                // Get all filter values
                const typeFilter = document.querySelector('.filter-select[name="type"]').value;
                const categoryFilter = document.querySelector('.filter-select[name="category"]').value;
                const priceFilter = document.querySelector('.filter-select[name="price"]').value;
                const sortBy = document.querySelector('.filter-select[name="sort"]').value;

                // Filter and sort resources
                resourceCards.forEach(card => {
                    let showCard = true;

                    // Filter by type
                    if (typeFilter !== 'all') {
                        const cardType = card.querySelector('.resource-type span').textContent.toLowerCase();
                        if (!cardType.includes(typeFilter.toLowerCase())) {
                            showCard = false;
                        }
                    }

                    // Filter by category
                    if (categoryFilter !== 'all' && showCard) {
                        const cardTags = Array.from(card.querySelectorAll('.resource-tag')).map(tag => tag.textContent.toLowerCase());
                        if (!cardTags.some(tag => tag.includes(categoryFilter.toLowerCase()))) {
                            showCard = false;
                        }
                    }

                    // Filter by price
                    if (priceFilter !== 'all' && showCard) {
                        const isFree = card.querySelector('.resource-price').classList.contains('free');
                        if ((priceFilter === 'free' && !isFree) || (priceFilter === 'paid' && isFree)) {
                            showCard = false;
                        }
                    }

                    // Apply visibility
                    card.style.display = showCard ? 'flex' : 'none';
                });

                // Sort resources based on selection
                sortResources(sortBy);
            }

            function sortResources(sortBy) {
                const cardsArray = Array.from(resourceCards);

                cardsArray.sort((a, b) => {
                    switch (sortBy) {
                        case 'newest':
                            // You would need data attributes for date if implementing this properly
                            return 0; // Placeholder

                        case 'popular':
                            const downloadsA = parseInt(a.querySelector('.resource-stats span:first-child').textContent.match(/\d+(\.\d+)?k?/)[0].replace('k', '000'));
                            const downloadsB = parseInt(b.querySelector('.resource-stats span:first-child').textContent.match(/\d+(\.\d+)?k?/)[0].replace('k', '000'));
                            return downloadsB - downloadsA;

                        case 'rating':
                            const ratingA = parseFloat(a.querySelector('.resource-stats span:last-child').textContent.match(/\d+(\.\d+)?/)[0]);
                            const ratingB = parseFloat(b.querySelector('.resource-stats span:last-child').textContent.match(/\d+(\.\d+)?/)[0]);
                            return ratingB - ratingA;

                        default:
                            return 0;
                    }
                });

                // Reorder DOM elements
                const parent = resourceGrid;
                cardsArray.forEach(card => parent.appendChild(card));
            }

            // --- PAGINATION ---
            paginationItems.forEach(item => {
                item.addEventListener('click', function() {
                    // Don't process clicks on already active page
                    if (this.classList.contains('active')) return;

                    // Don't process navigation arrows for this simple implementation
                    if (this.innerHTML.includes('fa-chevron')) return;

                    // Update active pagination
                    document.querySelector('.pagination-item.active').classList.remove('active');
                    this.classList.add('active');

                    // In a real implementation, you would load the appropriate page of resources here
                    // For demonstration, we'll just scroll to top
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            });

            // --- RESOURCE PREVIEW FUNCTIONALITY ---
            // Create modal container for resource previews
            const previewModal = document.createElement('div');
            previewModal.classList.add('resource-preview-modal');
            previewModal.innerHTML = `
        <div class="modal-overlay"></div>
        <div class="resource-modal-container">
            <div class="modal-header">
                <h3 class="modal-title">Resource Preview</h3>
                <button class="modal-close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-content">
                <div class="resource-preview-content">
                    <div class="preview-loading">
                        <i class="fas fa-spinner fa-spin"></i> Loading preview...
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline modal-close-btn">Close</button>
                <a href="#" class="btn btn-primary modal-action-btn">Download/Purchase</a>
            </div>
        </div>
    `;
            document.body.appendChild(previewModal);

            // Add event listeners to preview links
            previewLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Get resource information from parent card
                    const card = this.closest('.resource-card');
                    const title = card.querySelector('h4').textContent;
                    const type = card.querySelector('.resource-type span').textContent;
                    const description = card.querySelector('.resource-description').textContent;
                    const tags = Array.from(card.querySelectorAll('.resource-tag')).map(tag => tag.textContent);
                    const author = card.querySelector('.resource-author span').textContent;
                    const authorImg = card.querySelector('.resource-author img').src;
                    const isFree = card.querySelector('.resource-price').classList.contains('free');
                    const price = card.querySelector('.resource-price').textContent;
                    const stats = Array.from(card.querySelectorAll('.resource-stats span')).map(stat => stat.textContent);

                    // Show the preview modal with resource details
                    openResourcePreview(
                        title,
                        type,
                        description,
                        tags,
                        author,
                        authorImg,
                        isFree,
                        price,
                        stats,
                        this.getAttribute('href')
                    );
                });
            });

            // Make entire card clickable for preview
            resourceCards.forEach(card => {
                card.addEventListener('click', function(e) {
                    // Only trigger if clicking on the card itself, not on links or buttons inside it
                    if (e.target.closest('a') || e.target.closest('button')) return;

                    const previewLink = this.querySelector('.resource-link');
                    if (previewLink) {
                        // Simulate click on the preview link
                        previewLink.click();
                    }
                });
            });

            // Function to open resource preview
            function openResourcePreview(title, type, description, tags, author, authorImg, isFree, price, stats, actionUrl) {
                // Update modal content
                const modal = document.querySelector('.resource-preview-modal');
                const modalTitle = modal.querySelector('.modal-title');
                const modalContent = modal.querySelector('.resource-preview-content');
                const actionBtn = modal.querySelector('.modal-action-btn');

                modalTitle.textContent = title;

                // Create preview content
                modalContent.innerHTML = `
            <div class="preview-header">
                <div class="preview-type">${type}</div>
                ${isFree ? '<div class="preview-badge free">Free</div>' : ''}
            </div>
            
            <div class="preview-body">
                <div class="preview-description">
                    <p>${description}</p>
                </div>
                
                <div class="preview-details">
                    <div class="preview-tags">
                        ${tags.map(tag => `<span class="preview-tag">${tag}</span>`).join('')}
                    </div>
                    
                    <div class="preview-meta">
                        <div class="preview-author">
                            <img src="${authorImg}" alt="${author}">
                            <span>${author}</span>
                        </div>
                        
                        <div class="preview-stats">
                            ${stats.map(stat => `<span>${stat}</span>`).join('')}
                        </div>
                    </div>
                </div>
                
                <div class="preview-sample">
                    <h4>Preview Content</h4>
                    <div class="preview-sample-content">
                        <p>This is a sample of the resource content. In a real implementation, this would show actual preview content based on the resource type.</p>
                        
                        ${type.toLowerCase().includes('code') ? 
                            `<pre class="code-preview"><code>function example() {\n  console.log("This is a code sample");\n  return "Preview of the actual code resource";\n}</code></pre>` : 
                            
                            type.toLowerCase().includes('video') ? 
                            `<div class="video-preview">
                                <div class="video-placeholder">
                                    <i class="fas fa-play-circle"></i>
                                    <span>Video Preview</span>
                                </div>
                            </div>` :
                            
                            type.toLowerCase().includes('pdf') || type.toLowerCase().includes('ebook') ?
                            `<div class="document-preview">
                                <div class="document-pages">
                                    <div class="document-page">
                                        <i class="fas fa-file-pdf"></i>
                                        <span>Page 1 (Preview)</span>
                                    </div>
                                </div>
                            </div>` :
                            
                            `<div class="generic-preview">
                                <i class="fas fa-eye"></i>
                                <span>Preview for ${type}</span>
                            </div>`
                        }
                    </div>
                </div>
            </div>
            
            <div class="preview-price">
                <strong>Price:</strong> ${price}
            </div>
        `;

                // Update action button
                actionBtn.textContent = isFree ? 'Download Now' : 'Purchase';
                actionBtn.href = actionUrl;

                // Show modal
                modal.classList.add('active');

                // Prevent body scrolling when modal is open
                document.body.style.overflow = 'hidden';
            }

            // Close modal functionality
            const closeButtons = document.querySelectorAll('.modal-close, .modal-close-btn, .modal-overlay');
            closeButtons.forEach(button => {
                button.addEventListener('click', closeModal);
            });

            // Close modal when Escape key is pressed
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeModal();
                }
            });

            function closeModal() {
                const modal = document.querySelector('.resource-preview-modal');
                modal.classList.remove('active');
                document.body.style.overflow = '';
            }

            // --- INITIALIZE THE PAGE ---
            // Add name attributes to filters for easier selection
            document.querySelectorAll('.filter-select').forEach(select => {
                const label = select.previousElementSibling.textContent.toLowerCase().replace(':', '');
                if (label.includes('type')) select.setAttribute('name', 'type');
                if (label.includes('category')) select.setAttribute('name', 'category');
                if (label.includes('price')) select.setAttribute('name', 'price');
                if (label.includes('sort')) select.setAttribute('name', 'sort');
            });
            document.head.appendChild(styleElement);
        });
    </script>

    <?php include $this->resolve("partials/_footer.php"); ?>