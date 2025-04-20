<?php include $this->resolve("components/delete_modal.php"); ?>

<div class="module-item">
    <div class="module-header">
        <div class="module-title">
            <h4><?php echo e($module['title']); ?></h4>
            <span class="module-duration">8 hours</span>
        </div>
        <div class="module-toggle">
            <i class="chevron-icon fa-solid fa-chevron-down"></i>
        </div>
    </div>

    <div class="module-content" id="module-<?php echo e($module['module_id']); ?>">
        <div class="module-description">
            <div class="desciption">
                <p><?php echo e($module['description']); ?></p>
            </div>
            <div class="module-action">
                <?php if (!empty($_SESSION['user']) && $course['tutor_id'] == $_SESSION['user']): ?>
                    <button class="module-delete-btn" onclick="showModal('/course/<?= $course['course_id'] ?>/module/<?= $module['module_id'] ?>');">
                        Delete
                    </button>
                <?php endif; ?>

            </div>
        </div>

        <div class="module-resources">
            <h5>Resources</h5>
            <ul>
                <?php foreach ($moduleResources[$module['module_id']] as $resource): ?>
                    <li>
                        <a href="/course/<?php echo e($course['course_id']) ?>/module/<?php echo e($module['module_id']) ?>/resource/<?php echo e($resource['resource_id']) ?>" class="resource-link">
                            <div class="resource-attachment">
                                <span class="resource-icon"><i class="fa-solid fa-file"></i></span>
                                <p>
                                    <?php echo e($resource['resource_path']) ?>
                                </p>
                            </div>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<!-- Examples -->
<!-- Module 1 -->
<!-- <div class="module-item">
    <div class="module-header" onclick="toggleModule(0)">
        <div class="module-title">
            <h4>Introduction to Python Programming</h4>
            <span class="module-duration">4 hours</span>
        </div>
        <div class="module-toggle">
            <svg class="chevron-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
        </div>
    </div>

    <div class="module-content" id="module-0">
        <div class="module-description">
            <p>Learn the fundamentals of Python programming including variables, data types, control structures, and basic syntax. This module provides a solid foundation for beginners.</p>
        </div>

        <div class="module-resources">
            <h5>Resources</h5>
            <ul>
                <li>
                    <a href="#" class="resource-link">
                        <span class="resource-icon">📄</span>
                        Python Basics Handbook
                    </a>
                </li>
                <li>
                    <a href="#" class="resource-link">
                        <span class="resource-icon">📄</span>
                        Practice Exercises PDF
                    </a>
                </li>
            </ul>
        </div>

        <div class="module-assignment">
            <h5>Assignment</h5>
            <div class="assignment-details">
                <p>Create a simple calculator program using Python that can perform basic arithmetic operations.</p>
                <div class="assignment-meta">
                    <span class="deadline">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        Deadline: December 31, 2024
                    </span>
                </div>
                <form class="assignment-upload" action="/submit-assignment" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="module_id" value="1">
                    <div class="file-upload">
                        <input type="file" name="assignment_file" id="assignment-1" required>
                        <label for="assignment-1" class="file-label">
                            Choose File
                        </label>
                    </div>
                    <button type="submit" class="submit-assignment">Submit Assignment</button>
                </form>
            </div>
        </div>
    </div>
</div> -->

<!-- Module 2 -->
<!-- <div class="module-item">
    <div class="module-header" onclick="toggleModule(1)">
        <div class="module-title">
            <h4>Object-Oriented Programming in Python</h4>
            <span class="module-duration">6 hours</span>
        </div>
        <div class="module-toggle">
            <svg class="chevron-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
        </div>
    </div>

    <div class="module-content" id="module-1">
        <div class="module-description">
            <p>Master object-oriented programming concepts including classes, objects, inheritance, and polymorphism in Python.</p>
        </div>

        <div class="module-resources">
            <h5>Resources</h5>
            <ul>
                <li>
                    <a href="#" class="resource-link">
                        <span class="resource-icon">📄</span>
                        OOP Concepts Guide
                    </a>
                </li>
                <li>
                    <a href="#" class="resource-link">
                        <span class="resource-icon">📄</span>
                        Code Examples
                    </a>
                </li>
            </ul>
        </div>

        <div class="module-assignment">
            <h5>Assignment</h5>
            <div class="assignment-details">
                <p>Design and implement a simple banking system using OOP principles.</p>
                <div class="assignment-meta">
                    <span class="deadline">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        Deadline: January 15, 2025
                    </span>
                </div>
                <div class="assignment-submitted">
                    <span class="success-message">✓ Assignment submitted</span>
                </div>
            </div>
        </div>
    </div>
</div> -->