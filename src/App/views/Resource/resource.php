<?php include $this->resolve("partials/_header.php"); ?>

<head>
    <link rel="stylesheet" href="/assets/styles/Resource/resource.css">

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
                <a href="/resource/create" class="btn btn-primary">
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
            <a href="/resource/create" class="btn btn-primary">
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