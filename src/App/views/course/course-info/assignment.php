<div class="course-section">
    <h2 class="section-title">Assignments</h2>

    <?php foreach ($assignments as $item): ?>
        <div class="assignment-item">
            <div class="assignment-header" onclick="toggleAssignment(this)">
                <h5><?php echo e($item['title']); ?>
                    <span class="chevron-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </span>
                </h5>
            </div>

            <div class="assignment-content">
                <div class="assignment-details">
                    <p onclick="window.location.href='/courses/<?php echo e($course['course_id']); ?>/assignment/<?php echo e($item['assignment_id']); ?>'" style="cursor: pointer;"><?php echo e($item['instruction']); ?></p>
                    <div class="assignment-meta">
                        <span class="deadline">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <?php echo e($item['deadline']); ?>
                        </span>
                    </div>
                    <!-- <?php foreach ($assignmentsResources[$item['assignment_id']] as $resource): ?>
                                        <ul>
                                            <li>
                                                <a href="/assignment/<?php echo e($item['assignment_id']) ?>/resource/<?php echo e($resource['resource_id']) ?>" class="resource-link">
                                                    <span class="resource-icon">📄</span>
                                                    <?php echo e($resource['resource_path']) ?>
                                                </a>
                                            </li>
                                        </ul>
                                    <?php endforeach; ?>
                                    <form class="assignment-upload" action="/submit-assignment" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="module_id" value="1">
                                        <div class="file-upload">
                                            <input type="file" name="assignment_file" id="assignment-1" required>
                                            <label for="assignment-1" class="file-label">
                                                Choose File
                                            </label>
                                        </div>
                                        <button type="submit" class="submit-assignment" onclick="preventDefault();">Submit Assignment</button>
                                    </form> -->
                </div>
            </div>
            <!-- <?php foreach ($assignmentsResources[$item['assignment_id']] as $resource): ?>
                                    <ul>
                                        <li>
                                            <a href="/assignment/<?php echo e($item['assignment_id']) ?>/resource/<?php echo e($resource['resource_id']) ?>" class="resource-link">
                                                <span class="resource-icon">📄</span>
                                                <?php echo e($resource['resource_path']) ?>
                                            </a>
                                        </li>
                                    </ul>
                                <?php endforeach; ?> -->
        </div>
    <?php endforeach; ?>
</div>