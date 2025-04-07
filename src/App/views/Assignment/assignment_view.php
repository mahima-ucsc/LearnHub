<?php include $this->resolve("partials/_header.php"); ?>

<style>
    :root {
        --surface: #ffffff;
        --background: #f9fafb;
        --text-primary: #1f2937;
        --text-secondary: #6b7280;
        --text-light: #9ca3af;
        --border: #e5e7eb;
        --danger: #ef4444;
        --success: #10b981;
        --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
        --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }


    .assignment-container {
        max-width: 1000px;
        margin: 3rem auto;
        padding: 0 24px;
    }

    .assignment-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .assignment-header h1 {
        color: var(--text-primary);
        font-weight: 800;
        font-size: 2.25rem;
        letter-spacing: -0.025em;
        margin-bottom: 0.75rem;
    }

    .assignment-header p {
        color: var(--text-secondary);
        font-size: 1.125rem;
    }

    .assignment-card {
        background: var(--surface);
        border-radius: 16px;
        box-shadow: var(--shadow);
        margin-bottom: 1.5rem;
        transition: all 0.2s ease-in-out;
        border: 1px solid var(--border);
        overflow: hidden;
    }

    .assignment-card:hover {
        box-shadow: var(--shadow-lg);
    }

    .assignment-card-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
    }

    .assignment-card-body {
        padding: 1.5rem;
    }

    .assignment-card-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .assignment-card-title i {
        color: var(--primary);
    }

    .badge {
        font-size: 0.875rem;
        font-weight: 600;
        padding: 0.375rem 0.875rem;
        border-radius: 9999px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .badge-primary {
        color: var(--primary);
        background-color: rgba(239, 241, 99, 0.1);
    }

    .meta-group {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        margin: 1.5rem 0;
        padding: 1.25rem;
        background-color: var(--background);
        border-radius: 10px;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .meta-item i {
        color: var(--primary);
    }

    .meta-label {
        font-weight: 600;
        color: var(--text-secondary);
        margin-right: 4px;
    }

    .assignment-content h3 {
        color: var(--text-primary);
        font-weight: 700;
        margin-bottom: 1rem;
        font-size: 1.25rem;
    }

    .assignment-content p {
        color: var(--text-secondary);
        margin-bottom: 1.5rem;
    }

    .assignment-content h4 {
        color: var(--text-primary);
        font-weight: 600;
        margin: 1.5rem 0 0.75rem;
        font-size: 1.125rem;
    }

    .assignment-content ul {
        padding-left: 1.5rem;
        margin-bottom: 1.5rem;
        color: var(--text-secondary);
    }

    .assignment-content li {
        margin-bottom: 0.5rem;
    }

    .attachment-list {
        margin: 1.5rem 0;
    }

    .attachment-item {
        display: flex;
        align-items: center;
        padding: 0.875rem 1rem;
        margin-bottom: 0.75rem;
        border: 1px solid var(--border);
        border-radius: 10px;
        transition: all 0.2s ease;
    }

    .attachment-item:hover {
        background-color: rgba(99, 102, 241, 0.05);
        border-color: var(--primary-light);
    }

    .attachment-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background-color: rgba(239, 241, 99, 0.1);
        margin-right: 1rem;
    }

    .attachment-icon i {
        color: var(--primary);
        font-size: 1.25rem;
    }

    .attachment-details {
        flex: 1;
    }

    .attachment-name {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 2px;
    }

    .attachment-size {
        font-size: 0.875rem;
        color: var(--text-light);
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background-color: var(--primary);
        color: white;
        border: none;
        padding: 0.625rem 1.25rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9375rem;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 1px 3px rgba(99, 102, 241, 0.3);
    }

    .btn:hover {
        background-color: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(99, 102, 241, 0.25);
    }

    .btn:active {
        transform: translateY(0);
    }

    .btn-outline {
        background-color: transparent;
        color: var(--primary);
        border: 1px solid var(--primary);
        box-shadow: none;
    }

    .btn-outline:hover {
        background-color: rgba(99, 102, 241, 0.1);
        color: var(--primary-dark);
        border-color: var(--primary-dark);
        box-shadow: none;
    }

    .upload-zone {
        border: 2px dashed var(--primary-light);
        border-radius: 12px;
        padding: 2.5rem 1.5rem;
        text-align: center;
        transition: all 0.3s;
        margin: 1.5rem 0;
        cursor: pointer;
        background: var(--surface);
    }

    .upload-zone:hover,
    .upload-zone.dragover {
        background-color: rgba(99, 102, 241, 0.05);
        border-color: var(--primary);
    }

    .upload-icon {
        font-size: 3rem;
        color: var(--primary);
        margin-bottom: 1.25rem;
    }

    .upload-text {
        color: var(--text-secondary);
        margin-bottom: 0.75rem;
    }

    .upload-subtext {
        color: var(--text-light);
        font-size: 0.875rem;
        margin-bottom: 1.25rem;
    }

    .file-input {
        display: none;
    }

    .selected-file {
        margin-top: 1.25rem;
        padding: 1rem;
        background-color: rgba(99, 102, 241, 0.05);
        border-radius: 10px;
        border: 1px solid var(--primary-light);
        display: none;
    }

    .selected-file p {
        font-weight: 500;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .submit-section {
        margin-top: 1.25rem;
        text-align: center;
    }

    .grade-section {
        text-align: center;
        padding: 1.5rem;
    }

    .grade-display {
        font-size: 3.5rem;
        font-weight: 800;
        color: var(--primary);
        margin: 1.5rem 0;
    }

    .grade-total {
        color: var(--text-light);
        font-size: 1.5rem;
        font-weight: 500;
    }

    .feedback-box {
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 1.5rem;
        margin-top: 1.5rem;
        background-color: var(--surface);
        text-align: left;
        color: var(--text-secondary);
    }

    .no-grade {
        padding: 3rem 1.5rem;
        text-align: center;
        color: var(--text-light);
    }

    .no-grade i {
        font-size: 3rem;
        margin-bottom: 1rem;
        display: block;
        opacity: 0.5;
    }

    @media (max-width: 768px) {
        .assignment-card-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .meta-group {
            flex-direction: column;
            gap: 1rem;
        }
    }
</style>
<div class="assignment-container">
    <div class="assignment-header">
        <h1>Assignment Submission</h1>
        <p>Submit your work and track your progress</p>
    </div>

    <div class="assignment-card">
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

                <h4>Requirements:</h4>
                <ul>
                    <li>Include at least 3 sections (About, Projects, Contact)</li>
                    <li>Implement responsive design principles</li>
                    <li>Use semantic HTML elements</li>
                    <li>Include CSS animations or transitions</li>
                    <li>Ensure accessibility compliance</li>
                </ul>
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

            <!-- TODO: Assignment Submission-->
            <!-- Updated Assignment Submission Section -->
            <form id="assignmentForm" method="post" enctype="multipart/form-data" action="submit">
                <div class="upload-zone" id="dropZone">
                    <div class="upload-icon">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <h3 class="upload-text">Drag and drop your files here</h3>
                    <p class="upload-subtext">or click to browse files from your computer</p>
                    <input type="file" id="fileInput" class="file-input" name="files[]" multiple>
                    <button class="btn">
                        <i class="fas fa-upload"></i>
                        Select Files
                    </button>
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

    <div class="assignment-card">
        <div class="assignment-card-header">
            <div class="assignment-card-title">
                <i class="fas fa-chart-bar"></i>
                Grades & Feedback
            </div>
        </div>
        <div class="assignment-card-body">
            <div class="no-grade">
                <i class="fas fa-clipboard-list"></i>
                <h3>No Grades Yet</h3>
                <p>Your submission hasn't been graded yet. Check back later.</p>
            </div>

            <!-- This section will be displayed after grading -->

            <div class="grade-section">
                <h3>Your Score</h3>
                <div class="grade-display">
                    85 <span class="grade-total">/ 100</span>
                </div>
                <div class="feedback-box">
                    <h4>Instructor Feedback:</h4>
                    <p>Great work on your portfolio website! The design is clean and your projects are well-presented. You could improve the mobile responsiveness of the navigation menu and add more detailed project descriptions. Keep up the good work!</p>
                </div>
            </div>

        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('fileInput');
        const selectedFiles = document.getElementById('selectedFiles');
        const fileList = document.getElementById('fileList');
        const submitButton = document.getElementById('submitButton');

        // Use DataTransfer to maintain a mutable list of files
        let dataTransfer = new DataTransfer();

        // Handle file selection via button
        dropZone.addEventListener('click', function() {
            fileInput.click();
        });

        // Handle file selection
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                handleFiles(this.files);
            }
        });

        // Handle drag and drop
        dropZone.addEventListener('dragover', function(e) {
            e.preventDefault();
            dropZone.classList.add('dragover');
        });

        dropZone.addEventListener('dragleave', function() {
            dropZone.classList.remove('dragover');
        });

        dropZone.addEventListener('drop', function(e) {
            e.preventDefault();
            dropZone.classList.remove('dragover');

            if (e.dataTransfer.files.length > 0) {
                handleFiles(e.dataTransfer.files);
            }
        });

        function handleFiles(files) {
            for (let i = 0; i < files.length; i++) {
                dataTransfer.items.add(files[i]);
            }
            // Update the file input with our DataTransfer files
            fileInput.files = dataTransfer.files;
            updateFileList();
        }

        // Update file list display
        function updateFileList() {
            // Clear current list
            fileList.innerHTML = '';

            // Show selected files container if we have files
            if (dataTransfer.files.length > 0) {
                selectedFiles.style.display = 'block';

                // Create list items for each file
                Array.from(dataTransfer.files).forEach((file, index) => {
                    const li = document.createElement('li');
                    li.style.display = 'flex';
                    li.style.justifyContent = 'space-between';
                    li.style.alignItems = 'center';
                    li.style.padding = '0.75rem 1rem';
                    li.style.marginBottom = '0.5rem';
                    li.style.backgroundColor = 'rgba(99, 102, 241, 0.05)';
                    li.style.borderRadius = '8px';
                    li.style.border = '1px solid var(--primary-light)';

                    // File info
                    const fileInfo = document.createElement('div');
                    fileInfo.style.display = 'flex';
                    fileInfo.style.alignItems = 'center';
                    fileInfo.style.gap = '10px';

                    // File icon
                    const fileIcon = document.createElement('i');
                    fileIcon.className = 'fas fa-file';
                    fileIcon.style.color = 'var(--primary)';

                    // File name and size
                    const fileDetails = document.createElement('div');
                    const fileName = document.createElement('div');
                    fileName.textContent = file.name;
                    fileName.style.fontWeight = '500';
                    fileName.style.color = 'var(--text-primary)';

                    const fileSize = document.createElement('div');
                    fileSize.textContent = formatFileSize(file.size);
                    fileSize.style.fontSize = '0.75rem';
                    fileSize.style.color = 'var(--text-light)';

                    fileDetails.appendChild(fileName);
                    fileDetails.appendChild(fileSize);

                    fileInfo.appendChild(fileIcon);
                    fileInfo.appendChild(fileDetails);

                    // Remove button
                    const removeBtn = document.createElement('button');
                    removeBtn.innerHTML = '<i class="fas fa-times"></i>';
                    removeBtn.style.background = 'none';
                    removeBtn.style.border = 'none';
                    removeBtn.style.color = 'var(--danger)';
                    removeBtn.style.cursor = 'pointer';
                    removeBtn.style.fontSize = '1rem';
                    removeBtn.style.padding = '5px';
                    removeBtn.title = 'Remove file';

                    removeBtn.addEventListener('click', function() {
                        removeFile(index);
                    });

                    li.appendChild(fileInfo);
                    li.appendChild(removeBtn);
                    fileList.appendChild(li);
                });
            } else {
                selectedFiles.style.display = 'none';
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

        // Format file size to human-readable format
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';

            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(1024));

            return parseFloat((bytes / Math.pow(1024, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Handle form submission
        // submitButton.addEventListener('click', function() {
        //     if (dataTransfer.files.length > 0) {
        //         // Create FormData object
        //         const formData = new FormData();

        //         // Add all files
        //         Array.from(dataTransfer.files).forEach((file, index) => {
        //             formData.append(`file${index}`, file);
        //         });

        //         // Disable button and show loading state
        //         submitButton.disabled = true;
        //         submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';

        //         // Send POST request to server
        //         const courseId = <?php echo json_encode($course['id'] ?? $course['course_id']); ?>;
        //         const assignmentId = <?php echo json_encode($assignment['id'] ?? $assignment['assignment_id']); ?>;

        //         fetch(`/courses/${courseId}/assignment/${assignmentId}/submit`, {
        //                 method: 'POST',
        //                 body: formData,
        //             })
        //             .then(response => {
        //                 if (!response.ok) {
        //                     throw new Error('Network response was not ok');
        //                 }
        //                 return response.json();
        //             })
        //             .then(data => {
        //                 alert('Assignment submitted successfully!');
        //                 console.log('Submission response:', data.files);
        //                 // Optionally refresh the page or update UI to show submission status
        //                 // location.reload();
        //             })
        //             .catch(error => {
        //                 console.error('Error submitting assignment:', error);
        //                 alert('Error submitting assignment. Please try again.');
        //             })
        //             .finally(() => {
        //                 // Re-enable button and restore original text
        //                 submitButton.disabled = false;
        //                 submitButton.innerHTML = '<i class="fas fa-paper-plane"></i> Submit Assignment';
        //             });
        //     } else {
        //         alert('Please select at least one file to submit.');
        //     }
        // });
    });
</script>

<?php include $this->resolve("partials/_footer.php"); ?>