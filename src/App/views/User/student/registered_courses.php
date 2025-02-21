<?php include $this->resolve('partials/_header.php') ?>

<link rel="stylesheet" href="/assets/styles/components/course-card.css">
<link rel="stylesheet" href="/assets/styles/User/registered_courses.css">
<link rel="stylesheet" href="/assets/styles/modals/menu_dropdown.css">

<style>
    .no-course-message {
        text-align: center;
        background-color: #f9f9f9;
        padding: 20px;
        margin-top: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    .no-course-message h3 {
        color: #333;
        font-size: 24px;
        margin-bottom: 10px;
    }

    .no-course-message p {
        color: #555;
        font-size: 16px;
        margin-bottom: 20px;
    }

    .no-course-message .explore-link {
        display: inline-block;
        background-color: #FFC400;
        padding: 10px 20px;
        font-size: 16px;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .no-course-message .explore-link:hover {
        background-color: rgb(255, 217, 92);
    }

    .card-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 350px));
        gap: 20px;
        margin-top: 16px;
    }

    .pinned-course-menu {
        display: flex;
        justify-content: space-between;
    }

    /* Search bar */
    .search-container {
        /* margin-top: 22px; */
        display: flex;
        justify-content: start;
        align-items: center;
        align-self: center;
        text-align: center;
        width: 100%;
        background-color: #ffffff;
        padding: 24px;
        z-index: 1;
    }

    .course-search-bar {
        display: flex;
        justify-content: center;
        align-self: center;
        width: 50%;
        padding: 14px 20px;
        font-size: 18px;
        color: #171A1F;
        background-color: #f8f9fa;
        border: 1px solid #e0e0e0;
        border-radius: 20px;
        transition: all 0.3s ease;
    }

    .course-search-bar:focus {
        outline: none;
        border-color: #FFC400;
        background-color: #ffffff;
    }

    .course-search-button {
        display: block;
        margin-left: 8px;
        padding: 14px 22px;
        background-color: #FFC400;
        border: none;
        border-radius: 20px;
        cursor: pointer;
    }

    .course-search-button:hover {
        background-color: #ffe07a;
    }

    .course-search-button i {
        color: #f8f9fa;
    }

    .search-by {
        margin-left: 22px;
        padding: 8px 18px;
        border: 2px solid #FFC400;
        border-radius: 20px;
        background-color: #fff;
        cursor: pointer;

    }

    /* Filter Section */
    .filters h3 {
        font-family: 'Archivo', sans-serif;
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 20px;
        color: #1a1a1a;
    }

    .filter-section {
        margin-bottom: 20px;
    }

    .filter-section h4 {
        font-size: 16px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .filters .filter-btn button {
        display: block;
        padding: 10px 15px;
        background-color: #FFC400;
        border: none;
        border-radius: 15px;
        font-size: 14px;
        cursor: pointer;
    }

    .filters .filter-btn button:hover {
        background-color: #ffe07a;
    }
</style>

<section class="user-course">
    <h3>My Courses</h3>
    <hr>
    <div class="search-container">
        <input name="s" type="text" class="course-search-bar" placeholder="Search courses..." value="<?php echo e((string)$searchTerm); ?>">
        <button class="course-search-button" type="submit"><i class="fas fa-search"></i>
        </button>
        <select name="f" class="search-by">
            <option value="">Search By</option>
            <option value="course" <?php echo e((string)$searchBy === 'course' ? 'selected' : ''); ?>>Course</option>
            <option value="tutor" <?php echo e((string)$searchBy === 'tutor' ? 'selected' : ''); ?>>Tutor</option>
        </select>
    </div>

    <div class="card-container">
        <?php if (empty($pinnedCourses) && empty($courses)): ?>
            <div class="no-course-message">
                <h3>No Courses Found</h3>
                <p>You are not registered for any courses yet. Explore and register for exciting courses below:</p>
                <a href="/courses" class="explore-link">Explore Courses</a>
            </div>
        <?php endif; ?>
        <?php if (!empty($pinnedCourses)): ?>
            <?php foreach ($pinnedCourses as $course): ?>
                <div class="search-course-card">
                    <div class="pinned-course-menu">
                        <i class="fa-solid fa-thumbtack"></i>
                        <i class="fa fa-ellipsis-v"></i>
                        <div class="menu-dropdown">
                            <ul>
                                <li onclick="event.preventDefault(); pinCourse(<?php echo ($course['course_id']); ?>)">Pin Course</li>
                                <li>Other Option</li>
                            </ul>
                        </div>
                    </div>
                    <div class="course-card-header">
                        <img src="/assets/images/dm.jpg" alt="Web Development" class="course-image">
                        <h4 class="course-title"><?php echo ($course['title']); ?></h4>
                        <hr class="course-card-line" />
                    </div>
                    <!-- <div class="course-description">
                    <p><?php echo ($course['description']); ?></p>
                </div> -->
                    <div class="course-info">
                        <div class="course-stat">
                            <!-- <p>
                            <i class="fa fa-star icon"></i> 4.5
                        </p> -->
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
            <br />
        <?php endif; ?>
        <?php foreach ($courses as $course): ?>
            <div class="search-course-card">
                <div class="course-menu">
                    <i class="fa fa-ellipsis-v"></i>
                    <div class="menu-dropdown">
                        <ul>
                            <li onclick="event.preventDefault(); pinCourse(<?php echo ($course['course_id']); ?>)">Pin Course</li>
                            <li>Other Option</li>
                        </ul>
                    </div>
                </div>
                <div class="course-card-header">
                    <img src="/assets/images/dm.jpg" alt="Web Development" class="course-image">
                    <h4 class="course-title"><?php echo ($course['title']); ?></h4>
                    <hr class="course-card-line" />
                </div>
                <!-- <div class="course-description">
                    <p><?php echo ($course['description']); ?></p>
                </div> -->
                <div class="course-info">
                    <div class="course-stat">
                        <!-- <p>
                            <i class="fa fa-star icon"></i> 4.5
                        </p> -->
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

<script src="/assets/js/modals/menu_dropdown.js"></script>
<script>
    function pinCourse(courseId) {
        // Make an AJAX request to pin the course
        fetch('/courses/pin-course', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    course_id: courseId
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update the pinned courses section dynamically
                    const pinnedCoursesContainer = document.getElementById('pinned-courses-container');
                    pinnedCoursesContainer.innerHTML = '';

                    data.pinnedCourses.forEach(course => {
                        const courseCard = document.createElement('div');
                        courseCard.className = 'search-course-card';
                        courseCard.innerHTML = `
                        <div class="course-card-header">
                            <img src="/assets/images/dm.jpg" alt="${course.title}" class="course-image">
                            <h4 class="course-title">${course.title}</h4>
                            <hr class="course-card-line" />
                        </div>
                        <div class="course-description">
                            <p>${course.description}</p>
                        </div>
                        <div class="course-info">
                            <div class="course-stat">
                                <p>
                                    <i class="fa fa-star icon"></i> 4.5
                                </p>
                                <p>
                                    <i class="fa fa-map-marker icon"></i>
                                    ${course.location}
                                </p>
                                <p class="price">
                                    Rs. ${course.price}/${course.pricing_period}
                                </p>
                            </div>
                            <div class="course-meta">
                                <div class="course-teacher">
                                    <img src="/assets/images/user.jpeg" alt="teacher" />
                                    <p>${course.first_name} ${course.last_name}</p>
                                </div>
                                <div>
                                    <a href="/courses/${course.course_id}"> See More</a>
                                </div>
                            </div>
                        </div>`;

                        pinnedCoursesContainer.appendChild(courseCard);
                    });
                } else {
                    console.error('Failed to pin the course');
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>

<?php include $this->resolve('partials/_footer.php') ?>