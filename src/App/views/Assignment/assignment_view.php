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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const dropZone = document.getElementById("dropZone");
        const fileInput = document.getElementById("fileInput");
        const selectedFiles = document.getElementById("selectedFiles");
        const fileList = document.getElementById("fileList");
        const submitButton = document.getElementById("submitButton");
        const removeButtons = document.querySelectorAll(
            '.btn-danger[id="remove-attachment"]'
        );

        let dataTransfer = new DataTransfer();

        dropZone.addEventListener("click", function() {
            fileInput.click();
        });

        fileInput.addEventListener("change", function() {
            if (this.files.length > 0) {
                handleFiles(this.files);
            }
        });

        dropZone.addEventListener("dragover", function(e) {
            e.preventDefault();
            dropZone.classList.add("dragover");
        });

        dropZone.addEventListener("dragleave", function() {
            dropZone.classList.remove("dragover");
        });

        dropZone.addEventListener("drop", function(e) {
            e.preventDefault();
            dropZone.classList.remove("dragover");

            if (e.dataTransfer.files.length > 0) {
                handleFiles(e.dataTransfer.files);
            }
        });

        function handleFiles(files) {
            for (let i = 0; i < files.length; i++) {
                dataTransfer.items.add(files[i]);
            }
            fileInput.files = dataTransfer.files;
            updateFileList();
        }

        function updateFileList() {
            fileList.innerHTML = "";

            if (dataTransfer.files.length > 0) {
                selectedFiles.style.display = "block";

                Array.from(dataTransfer.files).forEach((file, index) => {
                    const li = document.createElement("li");
                    li.style.display = "flex";
                    li.style.justifyContent = "space-between";
                    li.style.alignItems = "center";
                    li.style.padding = "0.75rem 1rem";
                    li.style.marginBottom = "0.5rem";
                    li.style.backgroundColor = "rgba(99, 102, 241, 0.05)";
                    li.style.borderRadius = "8px";
                    li.style.border = "1px solid var(--primary-light)";

                    const fileInfo = document.createElement("div");
                    fileInfo.style.display = "flex";
                    fileInfo.style.alignItems = "center";
                    fileInfo.style.gap = "10px";

                    const fileIcon = document.createElement("i");
                    fileIcon.className = "fas fa-file";
                    fileIcon.style.color = "var(--primary)";

                    // File name and size
                    const fileDetails = document.createElement("div");
                    const fileName = document.createElement("div");
                    fileName.textContent = file.name;
                    fileName.style.fontWeight = "500";
                    fileName.style.color = "var(--text-primary)";

                    const fileSize = document.createElement("div");
                    fileSize.style.fontSize = "0.75rem";
                    fileSize.style.color = "var(--text-light)";

                    fileDetails.appendChild(fileName);
                    fileDetails.appendChild(fileSize);

                    fileInfo.appendChild(fileIcon);
                    fileInfo.appendChild(fileDetails);

                    const removeBtn = document.createElement("button");
                    removeBtn.innerHTML = '<i class="fas fa-times"></i>';
                    removeBtn.style.background = "none";
                    removeBtn.style.border = "none";
                    removeBtn.style.color = "var(--danger)";
                    removeBtn.style.cursor = "pointer";
                    removeBtn.style.fontSize = "1rem";
                    removeBtn.style.padding = "5px";
                    removeBtn.title = "Remove file";

                    removeBtn.addEventListener("click", function() {
                        removeFile(index);
                    });

                    li.appendChild(fileInfo);
                    li.appendChild(removeBtn);
                    fileList.appendChild(li);
                });
            } else {
                selectedFiles.style.display = "none";
            }
        }

        // Remove a file from the DataTransfer list
        function removeFile(index) {
            // Create a new DataTransfer object and add back every file except the one to remove
            const newDataTransfer = new DataTransfer();
            Array.from(dataTransfer.files).forEach((file, i) => {
                if (i !== index) {
                    newDataTransfer.items.add(file);
                }
            });
            // Update our global DataTransfer and file input
            dataTransfer = newDataTransfer;
            fileInput.files = dataTransfer.files;
            updateFileList();
        }

        removeButtons.forEach((button) => {
            button.addEventListener("click", function(e) {
                // Prevent default navigation
                e.preventDefault();

                // Get the attachment ID and submission ID from the button's data or the URL
                const attachmentId = this.getAttribute("data-attachment-id");
                const submissionId = this.getAttribute("data-submission-id") || "";

                if (!submissionId || !attachmentId) {
                    console.error("Missing submission ID or attachment ID");
                    return;
                }

                // Create and send the POST request
                fetch(`/submission/${submissionId}/attachment/${attachmentId}/remove`, {
                        method: "POST",
                    })
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.text();
                    })
                    .then((data) => {
                        console.log(data);
                        showToast(
                            "File removed",
                            "The file has been removed successfully.",
                            "success"
                        );

                        // Reload page to reflect changes
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    })
                    .catch((error) => {
                        console.error("Error removing file:", error);
                        showToast(
                            "Error removing file",
                            "There was a problem removing file. Please try again.",
                            "error"
                        );
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    });
            });
        });
    });
</script>

<?php include $this->resolve("partials/_footer.php"); ?>