<?php include $this->resolve("partials/_header.php"); ?>

<head>
    <link rel="stylesheet" href="/assets/styles/Resource/my_resources.css">
</head>

<section class="resource-container">
    <div class="my-resource-header">
        <h1>My Resources</h1>
        <p>Share your resources with the world</p>
    </div>
    <div class="resource-result-container">
        <div class="right-resource-container">
            <div class="resource-add-btn">
                <a href="/resource/create" class="resource-add-link">
                    <button>Add Resources</button>
                </a>
            </div>

            <div class="resource-accordion">
                <?php if (!empty($resources)): ?>
                    <?php foreach ($resources as $resource): ?>
                        <div class="accordion-item">
                            <!-- Resource Thumbnail -->
                            <div class="resource-thumbnail">
                                <?php if (!empty($resource['thumbnail'])): ?>
                                    <img src="<?php echo e($resource['thumbnail']); ?>" alt="<?php echo e($resource['title']); ?>">
                                <?php else: ?>
                                    <img src="/assets/images/work-flow.jpeg" alt="Default resource image">
                                <?php endif; ?>

                                <?php if (isset($resource['featured']) && $resource['featured']): ?>
                                    <div class="resource-ribbon">Featured</div>
                                <?php endif; ?>
                            </div>

                            <div class="accordion-header">
                                <div class="resource-title-container">
                                    <h4 class="resource-title"><?php echo e($resource['title']); ?></h4>
                                </div>
                                <div class="resource-price-container">
                                    <?php if (!empty($resource['price']) && $resource['price'] > 0): ?>
                                        <span class="resource-price">Rs. <?php echo e($resource['price']); ?></span>
                                    <?php else: ?>
                                        <span class="resource-price-free">Free</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="accordion-content">
                                <!-- <div class="resource-description">
                                    <p><?php echo e($resource['description']); ?></p>
                                </div> -->
                                <div class="resource-meta">
                                    <div class="resource-owner">
                                        <img src="/assets/images/user.jpeg" alt="owner">
                                        <span><?php echo e($resource['first_name'] . ' ' . $resource['last_name']); ?></span>
                                    </div>
                                    <div class="resource-actions">
                                        <div class="resource-edit-btn">
                                            <a href="/resource/edit/<?php echo e($resource['resource_id']); ?>" class="resource-edit-link">
                                                <button>Edit</button>
                                            </a>
                                        </div>
                                        <div class="resource-delete-btn">
                                            <button onclick="event.stopPropagation();showModal('/resource/delete/<?php echo e($resource['resource_id']); ?>')">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p><b>
                            <center>No resources found</center>
                        </b></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include $this->resolve('components/delete_modal.php'); ?>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>