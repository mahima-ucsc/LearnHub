<?php include $this->resolve("partials/_header.php"); ?>

<link rel="stylesheet" href="/assets/styles/Resource/resource.css">


<!-- Hero Section -->
<section class="resource-hero">
    <div class="resource-container">
        <div class="resource-hero-content">
            <h1>Resource Hub</h1>
            <p>Discover high-quality learning resources shared by the community to enhance your learning journey.</p>
        </div>
    </div>
</section>

<!-- Main Content -->
<div class="resource-container">
    <!-- Search & Filter Section -->
    <section class="search-filter-section">
        <form method="GET" onsubmit="showLoader()">
            <div class="resource-search-container">
                <input type="text" name="s" class="search-input" placeholder="Search for resources..." value="<?php echo isset($_GET['s']) ? e($_GET['s']) : ''; ?>">
                <button type="submit" class="search-btn">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </form>
        <form method="GET" onsubmit="showLoader()">
            <input type="hidden" name="s" value="<?php echo isset($_GET['s']) ? e($_GET['s']) : ''; ?>">
            <input type="hidden" name="p" value="1">

            <div class="filters">
                <div class="filter-group">
                    <span class="filter-label">Type:</span>
                    <select class="filter-select" name="type">
                        <option value="all">All Types</option>
                        <option value="PDF" <?= isset($_GET['type']) && $_GET['type'] === 'PDF' ? 'selected' : '' ?>>PDF</option>
                        <option value="Video" <?= isset($_GET['type']) && $_GET['type'] === 'Video' ? 'selected' : '' ?>>Video</option>
                        <option value="Code" <?= isset($_GET['type']) && $_GET['type'] === 'Code' ? 'selected' : '' ?>>Code</option>
                        <option value="Template" <?= isset($_GET['type']) && $_GET['type'] === 'Template' ? 'selected' : '' ?>>Template</option>
                        <option value="Ebook" <?= isset($_GET['type']) && $_GET['type'] === 'Ebook' ? 'selected' : '' ?>>Ebook</option>
                        <option value="Tool" <?= isset($_GET['type']) && $_GET['type'] === 'Tool' ? 'selected' : '' ?>>Tool</option>
                    </select>
                </div>
                <div class="filter-group">
                    <span class="filter-label">Category:</span>
                    <select class="filter-select" name="category">
                        <option value="all">All Categories</option>
                        <option value="Programming" <?= isset($_GET['category']) && $_GET['category'] === 'Programming' ? 'selected' : '' ?>>Programming</option>
                        <option value="Design" <?= isset($_GET['category']) && $_GET['category'] === 'Design' ? 'selected' : '' ?>>Design</option>
                        <option value="Marketing" <?= isset($_GET['category']) && $_GET['category'] === 'Marketing' ? 'selected' : '' ?>>Marketing</option>
                        <option value="Data Science" <?= isset($_GET['category']) && $_GET['category'] === 'Data Science' ? 'selected' : '' ?>>Data Science</option>
                        <option value="Business" <?= isset($_GET['category']) && $_GET['category'] === 'Business' ? 'selected' : '' ?>>Business</option>
                        <option value="Academic" <?= isset($_GET['category']) && $_GET['category'] === 'Academic' ? 'selected' : '' ?>>Academic</option>

                    </select>
                </div>
                <div class="filter-group">
                    <span class="filter-label">Price:</span>
                    <select class="filter-select" name="price">
                        <option value="all">All Prices</option>
                        <option value="1" <?= isset($_GET['price']) && $_GET['price'] === '1' ? 'selected' : '' ?>>Free</option>
                        <option value="0" <?= isset($_GET['price']) && $_GET['price'] === '0' ? 'selected' : '' ?>>Paid</option>
                    </select>
                </div>

                <div class="filter-group">
                    <button type="submit" class="apply-filter-btn">Apply Filters</button>
                    <a href="/resource" class="clear-btn" onclick="showLoader()">Clear All Filters</a>
                </div>
            </div>
        </form>
    </section>

    <!-- Resource Actions -->
    <section class="resource-actions">
        <div class="action-btns">
            <a href="/resource/create" class="btn btn-primary">
                <i class="fas fa-plus"></i> Share a Resource
            </a>
        </div>
    </section>
    <div class="results-summary">
        <p><span id="courseCount"><?= $resourceCount; ?></span> Resources found</p>
    </div>

    <!-- Resources Grid -->
    <section class="resources-grid">
        <?php foreach ($resources as $resource): ?>
            <div class="resource-card">
                <div class="resource-type">
                    <i class="fas fa-file-pdf"></i>
                    <span><?php echo e($resource['resource_type']); ?></span>
                </div>
                <div class="resource-badge">
                    <span><?php echo e($resource['category']); ?></span>
                </div>
                <div class="resource-content">
                    <h4><?php echo e($resource['title']); ?></h4>
                    <p class="resource-description"><?php echo e($resource['description']); ?></p>
                    <div class="resource-meta">
                        <div class="resource-author">
                            <img src="/assets/images/user.jpeg" alt="User Avatar" alt="Alex Johnson">
                            <span><?php echo e($resource['username']); ?></span>
                        </div>
                    </div>
                </div>
                <div class="resource-footer">
                    <?php if ($resource['is_free'] == 1): ?>
                        <div class="resource-price free">Rs.<?php echo e($resource['price']); ?></div>
                        <a href="/resource/download/<?php echo e($resource['resource_id']); ?>" class="resource-link">Download <i class="fas fa-arrow-right"></i></a>
                    <?php else: ?>
                        <div class="resource-price">Rs.<?php echo e($resource['price']); ?></div>
                        <a href="/resource/download/<?php echo e($resource['resource_id']); ?>" class="resource-link">Preview <i class="fas fa-arrow-right"></i></a>
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
    <!-- <div class="pagination">
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
    </div> -->
    <?php include $this->resolve('components/pagination.php'); ?>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const resourceGrid = document.querySelector('.resources-grid');
        const searchInput = document.querySelector('.search-input');
        const searchBtn = document.querySelector('.search-btn');
        const filterSelects = document.querySelectorAll('.filter-select');
        const paginationItems = document.querySelectorAll('.pagination-item');
        const resourceCards = document.querySelectorAll('.resource-card');
        const previewLinks = document.querySelectorAll('.resource-link');



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
            </div>
            
            <div class="preview-price">
                <strong>Price:</strong> ${price}
            </div>
        `;

            // Update action button
            actionBtn.textContent = isFree ? 'Download Now' : 'Download Preview';
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