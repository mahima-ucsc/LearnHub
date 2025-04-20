<link rel="stylesheet" href="/assets/styles/components/toast.css">


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
        <!-- Student Attendance Section - Only visible to students -->
        <?php if (!empty($_SESSION['user']) && $isParticipant): ?>
            <div class="module-complete-toggle">
                <input
                    type="checkbox"
                    id="attendance-<?php echo e($module['module_id']); ?>"
                    class="module-complete-checkbox"
                    data-module-id="<?php echo e($module['module_id']); ?>"
                    data-course-id="<?php echo e($course['course_id']); ?>"
                    <?php echo $attendanceData[$module['module_id']] ? 'checked' : ''; ?>>
                <label for="attendance-<?php echo e($module['module_id']); ?>" class="module-complete-label">
                    Mark as attended
                </label>
            </div>
        <?php endif; ?>
    </div>
</div>