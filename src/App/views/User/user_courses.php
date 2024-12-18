<?php include $this->resolve('partials/_header.php') ?>

<link rel="stylesheet" href="/assets/styles/User/user_courses.css">
<link rel="stylesheet" href="/assets/styles/components/course-card.css">

<section class="user-course">
    <h3>My Courses</h3>
    <hr>

    <div class="results">

        <?php foreach ($courses as $course): ?>
            <div class="search-course-card">
                <div class="course-card-header">
                    <img src="/assets/images/dm.jpg" alt="Web Development" class="course-image">
                    <h4 class="course-title"><?php echo ($course['title']); ?></h4>
                    <hr class="course-card-line" />
                </div>
                <div class="course-description">

                    <p><?php echo ($course['description']); ?></p>
                </div>
                <div class="course-info">
                    <div class="course-stat">
                        <p>
                            <i class="fa fa-star icon"></i> 4.5
                        </p>
                        <p>
                            <i class="fa fa-map-marker icon"></i>
                            <?php echo ($course['location']); ?>
                        </p>
                        <p class="price">
                            Rs. <?php echo ($course['price']); ?>/<?php echo ($course['pricing_period']); ?>
                        </p>
                    </div>
                    <div class="course-meta">
                        <div class="course-teacher">
                            <img src="/assets/images/user.jpeg" alt="teacher" />
                            <p><?php echo ($course['first_name']); ?> <?php echo ($course['last_name']); ?></p>
                        </div>
                        <div>
                            <a href="/courses/<?php echo ($course['course_id']); ?>"> See More</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</section>
<?php include $this->resolve('partials/_footer.php') ?>