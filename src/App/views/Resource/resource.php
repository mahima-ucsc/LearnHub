<?php include $this->resolve("partials/_header.php"); ?>

<head>
    <link rel="stylesheet" href="/assets/styles/Resource/resource.css">
</head>

<section class="resource-container">
    <div class="search-container">
        <input type="text" class="resource-search-bar" placeholder="Search for resource...">
        <button class="resource-search-button"><i class="fas fa-search"></i></button>
        <select name="search-by" class="search-by">
            <option value="">Search By</option>
            <option value="resource">Resource</option>
            <option value="tutor">Subject</option>
            <option value="tutor">User</option>
            <option value="tutor">Grade</option>
        </select>
    </div>
    <div class="resource-result-container">
        <div class="right-resource-container">
            <div class="resource-section">
                <div class="resource-add-btn">
                    <a href="resource/create" class="resource-add-link">
                        <button>Add Resources</button>
                    </a>
                </div>
                <!-- Resource Items -->
                <!-- Replace hardcoded resources with dynamic data -->
                <?php if (!empty($resources)): ?>
                    <?php foreach ($resources as $resource): ?>
                        <div class="resource-item">
                            <div class="resource-header">
                                <div class="resource-title-container">
                                    <h4 class="resource-title"><?php echo e($resource['title']); ?></h4>
                                    <span class="resource-type"><?php echo e($resource['type']); ?></span>
                                </div>
                                <div class="resource-price-container">
                                    <?php if ($resource['price']): ?>
                                        <span class="resource-price">Rs. <?php echo e($resource['price']); ?></span>
                                    <?php else: ?>
                                        <span class="resource-price-free">Free</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="resource-content">
                                <div class="resource-details">
                                    <div class="resource-description">
                                        <p><?php echo e($resource['description']); ?></p>
                                        <div class="resource-meta">
                                            <div class="resource-owner">
                                                <img src="/assets/images/user.jpeg" alt="owner">
                                                <span><?php echo e($resource['first_name'] . ' ' . $resource['last_name']); ?></span>
                                            </div>
                                            <a href="/resource/<?php echo e($resource['resource_id']); ?>" class="see-more-btn">See More Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No resources found</p>
                <?php endif; ?>



            </div>
        </div>
    </div>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>