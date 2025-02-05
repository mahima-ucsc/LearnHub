<?php include $this->resolve("partials/_header.php"); ?>


<head>
    <link rel="stylesheet" href="/assets/styles/Resource/my_resources.css">
    <!-- <link rel="stylesheet" href="/assets/styles/User/Admin/admin_dashboard.css">
    <link rel="stylesheet" href="/assets/styles/User/Admin/user_managment.css">
    <link rel="stylesheet" href="/assets/styles/User/Admin/course_managment.css">
    <link rel="stylesheet" href="/assets/styles/User/my-courses.css"> -->
</head>

<section class="resource-container">
    <div class="my-resource-header">
        <h1>My Resources</h1>
        <p>Share your resources with the world</p>
    </div>
    <div class="resource-result-container">
        <div class="right-resource-container">

            <div class="resource-accordion">
                <div class="resource-add-btn">
                    <a href="/resource/create" class="resource-add-link">
                        <button>Add Resources</button>
                    </a>
                </div>
                <!-- Accordion Resource Items -->
                <?php if (!empty($resources)): ?>
                    <?php foreach ($resources as $resource): ?>
                        <div class="accordion-item">
                            <div class="accordion-header">
                                <div class="resource-title-container">
                                    <h4 class="resource-title"><?php echo e($resource['title']); ?></h4>
                                </div>
                                <div class="resource-price-container">
                                    <?php if ($resource['price']): ?>
                                        <span class="resource-price">Rs. <?php echo e($resource['price']); ?></span>
                                    <?php else: ?>
                                        <span class="resource-price-free">Free</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="accordion-content">
                                <div class="accordion-details">
                                    <div class="resource-description">
                                        <p><?php echo e($resource['description']); ?></p>
                                        <div class="resource-meta">
                                            <div class="resource-owner">
                                                <img src="/assets/images/user.jpeg" alt="owner">
                                                <span><?php echo e($resource['first_name'] . ' ' . $resource['last_name']); ?></span>
                                            </div>
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