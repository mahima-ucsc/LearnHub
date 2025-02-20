<?php include $this->resolve("partials/_header.php"); ?>

<style>
    .container {
        max-width: 1000px;
        margin: 0 auto;
        background: white;
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .assignment-header {
        border-bottom: 3px solid #ffc400;
        padding-bottom: 1rem;
        margin-bottom: 1.5rem;
    }

    .title {
        font-size: clamp(1.5rem, 4vw, 2rem);
        color: #333;
        margin-bottom: 0.5rem;
    }

    .meta-info {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        color: #666;
        font-size: 0.9rem;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .status {
        padding: 0.3rem 0.8rem;
        border-radius: 15px;
        font-weight: 500;
        font-size: 0.85rem;
    }

    .status.pending {
        background-color: #fff3cd;
        color: #856404;
    }

    .status.submitted {
        background-color: #d4edda;
        color: #155724;
    }

    .status.late {
        background-color: #f8d7da;
        color: #721c24;
    }

    .section {
        margin-bottom: 2rem;
        padding: 1.5rem;
        background: #f9f9f9;
        border-radius: 8px;
    }

    .section-title {
        font-size: 1.2rem;
        color: #333;
        margin-bottom: 1rem;
    }

    .description {
        line-height: 1.6;
        color: #444;
    }

    .attachments-list {
        list-style: none;
    }

    .attachments-list li {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.8rem;
        background: white;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 0.5rem;
    }

    .attachments-list a {
        text-decoration: none;
        color: #000;
    }

    .attachment-icon {
        color: #ffc400;
        font-size: 1.2rem;
    }

    .upload-area {
        border: 2px dashed #ddd;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .upload-area:hover {
        border-color: #ffc400;
        background: #fff9e6;
    }

    .upload-area p {
        color: #666;
        margin-top: 0.5rem;
    }

    #submissionsList {
        margin-top: 1rem;
    }

    .submission-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.8rem;
        background: white;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 0.5rem;
    }

    .submission-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .submission-meta {
        font-size: 0.85rem;
        color: #666;
    }

    button {
        background-color: #ffc400;
        color: #000;
        border: none;
        padding: 1rem 2rem;
        border-radius: 5px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    button:hover {
        background-color: #ffb300;
        transform: translateY(-2px);
    }

    button:disabled {
        background-color: #ddd;
        cursor: not-allowed;
        transform: none;
    }

    .button-group {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }

    .remove-submission {
        color: #ff4444;
        cursor: pointer;
        padding: 0.3rem 0.6rem;
        border-radius: 3px;
    }

    .remove-submission:hover {
        background-color: #fff5f5;
    }

    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 1rem;
        border-radius: 5px;
        color: white;
        display: none;
        animation: slideIn 0.3s ease;
        z-index: 1000;
    }

    .notification.success {
        background-color: #4CAF50;
    }

    .notification.error {
        background-color: #f44336;
    }

    /* Edit feature */
    .edit-icon {
        cursor: pointer;
        margin-left: 10px;
        color: #ffc400;
    }

    .edit-field {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .hidden {
        display: none;
    }

    @keyframes slideIn {
        from {
            transform: translateX(100%);
        }

        to {
            transform: translateX(0);
        }
    }

    @media (max-width: 768px) {
        .container {
            padding: 1rem;
        }

        .section {
            padding: 1rem;
        }

        .meta-info {
            gap: 1rem;
        }

        .button-group {
            flex-direction: column;
        }

        button {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        body {
            padding: 0.5rem;
        }

        .meta-info {
            flex-direction: column;
            gap: 0.5rem;
        }
    }
</style>
</head>

<div class="container">
    <div class="assignment-header">
        <h1 class="title"><?php echo e($assignment['title']); ?></h1>
        <div class="meta-info">
            <div class="meta-item">
                <span>📅 Due:</span>
                <span><?php echo e($assignment['deadline']); ?></span>
            </div>
            <div class="meta-item">
                <span>Status:</span>
                <span class="status pending">Not Submitted</span>
            </div>


        </div>

        <div class="section">
            <h2 class="section-title">Instructions</h2>
            <div class="description">
                <?php echo e($assignment['instruction']); ?>
            </div>
        </div>

        <div class="section">
            <h2 class="section-title">Assignment Files</h2>
            <ul class="attachments-list">
                <li>
                    <span class="attachment-icon">📎</span>
                    <span>assignment_instructions.pdf</span>
                </li>
                <li>
                    <span class="attachment-icon">📎</span>
                    <span>template.docx</span>
                </li>
            </ul>
        </div>

        <div class="section">
            <h2 class="section-title">Your Submission</h2>
            <div class="upload-area" id="uploadArea">
                <span style="font-size: 2rem;">📤</span>
                <p>Drop your files here or click to upload</p>
                <input type="file" id="fileInput" multiple style="display: none;">
            </div>
            <div id="submissionsList"></div>
            <div class="button-group">
                <button id="submitBtn" disabled>Submit Assignment</button>
            </div>
        </div>
    </div>

    <div class="notification" id="notification"></div>
</div>
<script>
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('fileInput');
    const submissionsList = document.getElementById('submissionsList');
    const submitBtn = document.getElementById('submitBtn');
    const notification = document.getElementById('notification');
    const maxFileSize = 10 * 1024 * 1024; // 10MB
    let files = [];

    // Handle file upload area
    uploadArea.addEventListener('click', () => fileInput.click());
    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.style.borderColor = '#ffc400';
        uploadArea.style.background = '#fff9e6';
    });
    uploadArea.addEventListener('dragleave', () => {
        uploadArea.style.borderColor = '#ddd';
        uploadArea.style.background = 'white';
    });
    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.style.borderColor = '#ddd';
        uploadArea.style.background = 'white';
        handleFiles(e.dataTransfer.files);
    });

    fileInput.addEventListener('change', (e) => {
        handleFiles(e.target.files);
    });

    function handleFiles(newFiles) {
        Array.from(newFiles).forEach(file => {
            if (file.size > maxFileSize) {
                showNotification('File size exceeds 10MB limit', 'error');
                return;
            }
            files.push(file);
            addFileToList(file);
        });
        updateSubmitButton();
    }

    function addFileToList(file) {
        const li = document.createElement('div');
        li.className = 'submission-item';

        const fileSize = (file.size / 1024 / 1024).toFixed(2);
        li.innerHTML = `
                <div class="submission-info">
                    <span class="attachment-icon">📄</span>
                    <div>
                        <div>${file.name}</div>
                        <div class="submission-meta">${fileSize} MB</div>
                    </div>
                </div>
                <span class="remove-submission">×</span>
            `;

        li.querySelector('.remove-submission').addEventListener('click', () => {
            files = files.filter(f => f !== file);
            li.remove();
            updateSubmitButton();
        });

        submissionsList.appendChild(li);
    }

    function updateSubmitButton() {
        submitBtn.disabled = files.length === 0;
    }

    function showNotification(message, type = 'success') {
        notification.textContent = message;
        notification.className = `notification ${type}`;
        notification.style.display = 'block';
        setTimeout(() => {
            notification.style.display = 'none';
        }, 3000);
    }

    submitBtn.addEventListener('click', () => {
        // Here you would typically upload the files to your server
        // For demo purposes, we'll just show a success message
        showNotification('Assignment submitted successfully!');

        // Update status
        document.querySelector('.status').className = 'status submitted';
        document.querySelector('.status').textContent = 'Submitted';

        // Clear files
        files = [];
        submissionsList.innerHTML = '';
        updateSubmitButton();
    });

    ////////////////////////////////////////////////////////////////////

    // Fetch course data after the page is loaded
    fetch("/courses/48/assignment/7/test") // Update this to match the correct endpoint URL
        .then(response => response.json()) // Convert response to JSON
        .then(data => {
            console.log(data);

        })
        .catch(error => {
            console.error("Error fetching courses:", error);
            document.getElementById("loading").innerText = "Failed to load courses!";
        });
</script>

<?php include $this->resolve("partials/_footer.php"); ?>