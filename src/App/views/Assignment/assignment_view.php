<?php include $this->resolve("partials/_header.php"); ?>
<?php include $this->resolve("components/delete_modal.php"); ?>
<link rel="stylesheet" href="/assets/styles/components/toast.css">
<link rel="stylesheet" href="/assets/styles/Assignment/assignment_view.css">

<div class="assignment-container">
    <div class="assignment-header">
        <h1>Assignment Submission</h1>
        <p>Submit your work and track your progress</p>
    </div>

    <div class="assignment-card">
        <?php if (!empty($_SESSION['user']) && $_SESSION['user'] === $assignment['tutor_id']): ?>
            <div class="teacher-actions">
                <a href="#" onclick="showModal('/courses/<?php echo e($course['course_id']); ?>/assignment/<?php echo e($assignment['assignment_id']); ?>/delete')" class="teacher-action-btn delete-btn">
                    <i class="fa-solid fa-trash-alt"></i>
                    Remove Assignment
                </a>
                <a href="/courses/<?php echo e($course['course_id']); ?>/assignment/<?php echo e($assignment['assignment_id']); ?>/edit" class="teacher-action-btn edit-btn">
                    <i class="fa-solid fa-pen-to-square"></i>
                    Edit Assignment
                </a>
                <a href="/courses/<?php echo e($course['course_id']); ?>/assignment/<?php echo e($assignment['assignment_id']); ?>/review" class="teacher-action-btn review-btn">
                    <i class="fa-solid fa-clipboard-check"></i>
                    Review Submissions
                </a>
            </div>
        <?php endif; ?>
        <div class="assignment-card-header">
            <div class="assignment-card-title">
                <i class="fas fa-file-alt"></i>
                Assignment Details
            </div>
            <div class="badge badge-primary">
                <i class="fas fa-calendar-alt"></i>
                Due: <?php echo e(formatDate($assignment['deadline'])); ?>
            </div>
        </div>

        <div class="assignment-card-body">
            <div class="meta-group">
                <div class="meta-item">
                    <i class="fas fa-book"></i>
                    <span class="meta-label">Course:</span>
                    <span><?php echo e($course['title']); ?></span>
                </div>
            </div>

            <div class="assignment-content">
                <h3><?php echo e($assignment['title']); ?></h3>
                <p><?php echo e($assignment['instruction']); ?></p>

            </div>

            <div class="attachment-list">
                <h3>Attachments</h3>
                <?php foreach ($resources as $resource): ?>
                    <div class="attachment-item">
                        <div class="attachment-icon">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                        <div class="attachment-details">
                            <div class="attachment-name"><?php echo e($resource['resource_path']); ?></div>
                        </div>
                        <button class="btn btn-outline" onclick="window.location.href='/assignment/<?php echo e($resource['assignment_id']) ?>/resource/<?php echo e($resource['resource_id']) ?>'">
                            <i class="fas fa-download"></i>
                            Download
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Assignment Submission Section -->
            <form id="assignmentForm" method="post" enctype="multipart/form-data" action="/courses/<?php echo e($course['course_id']); ?>/assignment/<?php echo e($assignment['assignment_id']); ?>/submit">
                <div class="upload-zone" id="dropZone">
                    <div class="upload-icon">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <h3 class="upload-text">Drag and drop your files here</h3>
                    <p class="upload-subtext">or click to browse files from your computer</p>
                    <input type="file" id="fileInput" class="file-input" name="files[]" multiple>
                    <!-- <button class="btn">
                        <i class="fas fa-upload"></i>
                        Select Files
                    </button> -->
                </div>

                <div class="selected-files" id="selectedFiles" style="margin-top: 1.5rem; display: none;">
                    <h4 style="margin-bottom: 1rem; color: var(--text-primary);">Selected Files</h4>
                    <ul id="fileList" style="list-style: none; padding: 0;"></ul>
                </div>

                <div class="submit-section">
                    <button type="submit" class="btn" id="submitButton">
                        <i class="fas fa-paper-plane"></i>
                        Submit Assignment
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- New Submitted Files Section -->
    <div class="assignment-card">
        <div class="assignment-card-header">
            <div class="assignment-card-title">
                <i class="fas fa-file-upload"></i>
                Your Submissions
            </div>
        </div>
        <div class="assignment-card-body">
            <?php if (empty($submission)): ?>
                <div class="no-submissions">
                    <i class="fas fa-folder-open"></i>
                    <h3>No Files Submitted</h3>
                    <p>You haven't submitted any files for this assignment yet.</p>
                </div>
            <?php else: ?>
                <div class="submission-info">
                    <div class="meta-item">
                        <i class="fas fa-calendar-check"></i>
                        <span class="meta-label">Submitted on:</span>
                        <span><?php echo e(formatDate($submission['upload_date'])); ?></span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-check-circle"></i>
                        <span class="meta-label">Status:</span>
                        <span><?php echo e(ucfirst($submission['status'])); ?></span>
                    </div>

                    <div class="submission-files">
                        <h4>Submitted Files</h4>
                        <ul class="file-list">
                            <?php
                            $attachments = json_decode($submission['attachments'], true);
                            foreach ($attachments as $file):
                            ?>
                                <li class="submitted-file-item">
                                    <div class="file-info">
                                        <i class="fas fa-file"></i>
                                        <div class="file-details">
                                            <div class="file-name"><?php echo e($file['name']); ?></div>
                                        </div>
                                    </div>
                                    <div class="file-actions">
                                        <button class="btn btn-outline btn-sm" onclick="window.location.href='/assignment/<?php echo e($assignment['assignment_id']); ?>/submission/<?php echo e($submission['submission_id']); ?>/attachment/<?php echo e($file['attachment_id']); ?>'">
                                            <i class="fas fa-download"></i>
                                            Download
                                        </button>
                                        <button class="btn btn-danger btn-sm" id="remove-attachment" data-submission-id='<?php echo e($submission['submission_id']); ?>' data-attachment-id="<?php echo e($file['attachment_id']); ?>">
                                            <i class="fas fa-trash"></i>
                                            Remove
                                        </button>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <div class="submission-actions">
                            <button class="btn btn-outline" id="replaceSubmissionBtn">
                                <i class="fas fa-sync-alt"></i>
                                Replace Submission
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="assignment-card">
        <div class="assignment-card-header">
            <div class="assignment-card-title">
                <i class="fas fa-chart-bar"></i>
                Grades & Feedback
            </div>
        </div>
        <div class="assignment-card-body">
            <?php if (empty($submission) || $submission['status'] !== 'graded'): ?>
                <div class="no-grade">
                    <i class="fas fa-clipboard-list"></i>
                    <h3>No Grades Yet</h3>
                    <p>Your submission hasn't been graded yet. Check back later.</p>
                </div>
            <?php else: ?>
                <!-- This section will be displayed after grading -->
                <div class="grade-section">
                    <h3>Your Score</h3>
                    <div class="grade-display">
                        <?php echo e($submission['grade']); ?><span class="grade-total">/ 100</span>
                    </div>
                    <div class="feedback-box">
                        <h4>Teacher Feedback:</h4>
                        <p><?php echo e($submission['feedback']); ?></p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="/assets/js/components/toast.js"></script>
<script src="/assets/js/Assignment/assignment_view.js"></script>

<?php include $this->resolve("partials/_footer.php"); ?>