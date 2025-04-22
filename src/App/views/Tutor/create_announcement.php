<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course Announcement</title>
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="/assets/styles/Tutor/create_announcement.css">
</head>

<body>
    <div class="container">
        <h1 class="page-title">
            <i class="fas fa-bullhorn"></i>
            Create Course Announcement
        </h1>

        <div id="alertMessage" class="alert"></div>

        <form id="announcementForm" action="/courses/<?php echo $course_id; ?>/announcements/create" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title"><i class="fas fa-heading"></i> Announcement Title</label>
                <input type="text" id="title" name="title" placeholder="Enter a clear title for your announcement" required>
            </div>

            <div class="form-group">
                <label for="content"><i class="fas fa-align-left"></i> Announcement Content</label>
                <textarea id="content" name="content" placeholder="Write your announcement here. Include all relevant details." required></textarea>
            </div>

            <div class="form-group">
                <label for="category"><i class="fas fa-exclamation-circle"></i> Category</label>
                <select id="category" name="category">
                    <option value="assignment">Assignments</option>
                    <option value="event">Event</option>
                    <option value="general">General</option>
                    <option value="reminder">Remainder</option>
                </select>
            </div>

            <div class="form-group">
                <label for="visibility"><i class="fas fa-eye"></i> Visibility</label>
                <select id="visibility" name="visibility">
                    <option value="all">All enrolled students</option>
                    <option value="specific">Specific users</option>
                </select>
            </div>

            <div id="userSelection" class="form-group" style="display: none;">
                <label><i class="fas fa-envelope"></i> Add Student Email Addresses</label>
                <div class="email-input-container">
                    <input type="email" id="emailInput" placeholder="Enter student email address" class="email-input">
                    <button type="button" id="addEmailBtn" class="btn btn-secondary add-email-btn">
                        <i class="fas fa-plus"></i> Add
                    </button>
                </div>
                <div id="emailList" class="email-list"></div>
                <div class="email-info">Added emails will receive this announcement</div>
            </div>

            <div class="form-group">
                <label for="attachments"><i class="fas fa-paperclip"></i> Attachments (Optional)</label>
                <div class="file-upload">
                    <span class="upload-btn"><i class="fas fa-upload"></i> Choose Files</span>
                    <input type="file" id="attachments" name="attachments[]" multiple>
                </div>
                <div id="fileInfo" class="file-info"></div>
            </div>

            <div class="form-group">
                <div class="checkbox-container">
                    <input type="checkbox" id="sendEmail" name="send_email" value="1">
                    <label for="sendEmail"><i class="fas fa-envelope"></i> Send email notification to students</label>
                </div>
            </div>

            <div class="form-actions">
                <button type="button" id="previewBtn" class="btn btn-secondary"><i class="fas fa-eye"></i> Preview</button>
                <button type="submit" class="btn"><i class="fas fa-paper-plane"></i> Publish Announcement</button>
            </div>
        </form>

        <div id="announcementPreview" class="announcement-preview">
            <h3><i class="fas fa-search"></i> Preview</h3>
            <div id="previewCategory"></div>
            <h4 id="previewTitle"></h4>
            <div class="preview-content" id="previewContent"></div>
            <div id="previewAttachments" class="preview-attachments">
                <h5>Attachments:</h5>
                <ul id="attachmentList"></ul>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // DOM Elements
            const form = document.getElementById('announcementForm');
            const titleInput = document.getElementById('title');
            const contentInput = document.getElementById('content');
            const categorySelect = document.getElementById('category');
            const visibilitySelect = document.getElementById('visibility');
            const fileInput = document.getElementById('attachments');
            const fileInfo = document.getElementById('fileInfo');
            const previewBtn = document.getElementById('previewBtn');
            const previewSection = document.getElementById('announcementPreview');
            const previewTitle = document.getElementById('previewTitle');
            const previewContent = document.getElementById('previewContent');
            const previewCategory = document.getElementById('previewCategory');
            const alertMessage = document.getElementById('alertMessage');
            const userSelection = document.getElementById('userSelection');
            const emailInput = document.getElementById('emailInput');
            const addEmailBtn = document.getElementById('addEmailBtn');
            const emailList = document.getElementById('emailList');
            const addedEmails = new Set();
            const attachmentList = document.getElementById('attachmentList');

            // Show/hide user selection based on visibility choice
            visibilitySelect.addEventListener('change', function() {
                if (this.value === 'specific') {
                    userSelection.style.display = 'block';
                } else {
                    userSelection.style.display = 'none';
                }
            });

            // Email input management
            addEmailBtn.addEventListener('click', function() {
                addEmail();
            });

            // Allow adding email with Enter key
            emailInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    addEmail();
                }
            });

            // Function to add email to the list
            function addEmail() {
                const email = emailInput.value.trim();

                // Validate email format
                if (!email) {
                    showAlert('Please enter an email address.', 'danger');
                    return;
                }

                if (!isValidEmail(email)) {
                    showAlert('Please enter a valid email address.', 'danger');
                    return;
                }

                // Check if email already exists in the list
                if (addedEmails.has(email)) {
                    showAlert('This email address is already added.', 'danger');
                    return;
                }

                // Add to Set and create UI element
                addedEmails.add(email);

                // Create email item element
                const emailItem = document.createElement('div');
                emailItem.className = 'email-item';
                emailItem.innerHTML = `
        <span>${email}</span>
        <button type="button" class="remove-email" data-email="${email}">
            <i class="fas fa-times"></i>
        </button>
    `;

                // Add to DOM
                emailList.appendChild(emailItem);

                // Clear input
                emailInput.value = '';
                emailInput.focus();
            }

            // Remove email when delete button is clicked
            emailList.addEventListener('click', function(e) {
                if (e.target.closest('.remove-email')) {
                    const button = e.target.closest('.remove-email');
                    const email = button.getAttribute('data-email');
                    // Add animation before removing
                    const emailItem = button.closest('.email-item');
                    emailItem.style.animation = 'fadeout 0.3s ease';

                    // Wait for animation to complete before removing
                    emailItem.addEventListener('animationend', function() {
                        emailItem.remove();
                    });

                    // Don't immediately remove - will be handled after animation
                    // Remove from Set
                    addedEmails.delete(email);

                    // Remove from DOM
                    button.closest('.email-item').remove();
                }
            });

            // Helper to validate email format
            function isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }


            // Display file information
            fileInput.addEventListener('change', function() {
                let fileList = '';
                if (this.files.length > 0) {
                    fileList = '<ul>';
                    for (let i = 0; i < this.files.length; i++) {
                        const file = this.files[i];
                        fileList += `<li><i class="fas fa-file"></i> ${file.name} (${formatFileSize(file.size)})</li>`;
                    }
                    fileList += '</ul>';
                    fileInfo.innerHTML = fileList;
                } else {
                    fileInfo.innerHTML = '';
                }
            });

            // Preview announcement
            previewBtn.addEventListener('click', function() {
                const title = titleInput.value.trim();
                const content = contentInput.value.trim();
                const category = categorySelect.value;

                if (!title || !content) {
                    showAlert('Please fill in both title and content fields for preview.', 'danger');
                    return;
                }

                previewTitle.textContent = title;
                previewContent.textContent = content;

                // Style based on category
                previewCategory.classList.add('category');
                let categoryIcon = '';
                switch (category) {
                    case 'Assignments':
                        categoryIcon = '<i class="fas fa-tasks"></i> ';
                        break;
                    case 'Event':
                        categoryIcon = '<i class="fas fa-calendar-alt"></i> ';
                        break;
                    case 'General':
                        categoryIcon = '<i class="fas fa-info-circle"></i> ';
                        break;
                    case 'Reminder':
                        categoryIcon = '<i class="fas fa-bell"></i> ';
                        break;
                    default:
                        categoryIcon = '<i class="fas fa-exclamation-triangle"></i> ';
                }

                previewCategory.innerHTML = categoryIcon + category;

                // Display attached files in preview
                attachmentList.innerHTML = '';
                if (fileInput.files.length > 0) {
                    for (let i = 0; i < fileInput.files.length; i++) {
                        const file = fileInput.files[i];
                        const listItem = document.createElement('li');
                        listItem.innerHTML = `<a href="#" onclick="return false;" title="Download ${file.name}"><i class="fas fa-download"></i> ${file.name}</a>`;
                        attachmentList.appendChild(listItem);
                    }
                    document.getElementById('previewAttachments').style.display = 'block';
                } else {
                    document.getElementById('previewAttachments').style.display = 'none';
                }

                previewSection.style.display = 'block';
                previewSection.scrollIntoView({
                    behavior: 'smooth'
                });
            });

            // Form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Validation
                if (!titleInput.value.trim()) {
                    showAlert('Please enter an announcement title.', 'danger');
                    titleInput.focus();
                    return;
                }

                if (!contentInput.value.trim()) {
                    showAlert('Please enter announcement content.', 'danger');
                    contentInput.focus();
                    return;
                }

                // Check if specific visibility is selected but no emails added
                if (visibilitySelect.value === 'specific' && addedEmails.size === 0) {
                    showAlert('Please add at least one email address for specific users.', 'danger');
                    emailInput.focus();
                    return;
                }

                // Add the collected emails if specific visibility is selected
                if (visibilitySelect.value === 'specific') {
                    const emailInputField = document.createElement('input');
                    emailInputField.type = 'hidden';
                    emailInputField.name = 'specific_emails';
                    emailInputField.value = JSON.stringify(Array.from(addedEmails));
                    form.appendChild(emailInputField);
                }

                // Submit the form
                form.submit();
            });

            // Helper functions
            function formatFileSize(bytes) {
                if (bytes < 1024) return bytes + ' bytes';
                else if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
                else return (bytes / 1048576).toFixed(1) + ' MB';
            }


            function showAlert(message, type) {
                let icon = type === 'success' ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-exclamation-circle"></i>';
                alertMessage.innerHTML = icon + message;
                alertMessage.className = 'alert';
                alertMessage.classList.add('alert-' + type);
                alertMessage.style.display = 'flex';

                setTimeout(function() {
                    alertMessage.style.display = 'none';
                }, 5000);
            }
        });
    </script>
</body>

</html>