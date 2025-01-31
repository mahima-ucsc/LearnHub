<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Assignment</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            min-height: 100vh;
            padding: 1rem;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 3px solid #ffc400;
            font-size: clamp(1.5rem, 4vw, 2rem);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-weight: 500;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #ffc400;
            box-shadow: 0 0 0 2px rgba(255, 196, 0, 0.2);
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .col {
            flex: 1;
            min-width: 250px;
        }

        .tabs {
            display: flex;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #ddd;
        }

        .tab {
            padding: 1rem 2rem;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            margin-bottom: -2px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .tab.active {
            border-bottom-color: #ffc400;
            color: #333;
        }

        .tab:hover {
            background-color: #f5f5f5;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .preview-container {
            background: #f9f9f9;
            padding: 2rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .preview-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .preview-title {
            font-size: 1.5rem;
            color: #333;
        }

        .preview-meta {
            color: #666;
            font-size: 0.9rem;
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

        .button-group {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .secondary-button {
            background-color: #f5f5f5;
            border: 1px solid #ddd;
        }

        .points-input {
            max-width: 150px;
        }

        #attachments {
            border: 2px dashed #ddd;
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            margin-bottom: 1rem;
        }

        #attachments:hover {
            border-color: #ffc400;
        }

        #attachmentsList,
        .preview-attachments {
            list-style: none;
        }

        #attachmentsList li,
        .preview-attachments li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem;
            background: #f5f5f5;
            margin-bottom: 0.5rem;
            border-radius: 4px;
        }

        .remove-file {
            color: #ff4444;
            cursor: pointer;
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 1rem;
            background: #4CAF50;
            color: white;
            border-radius: 5px;
            display: none;
            animation: slideIn 0.3s ease;
            z-index: 1000;
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

            .preview-container {
                padding: 1rem;
            }

            .tab {
                padding: 0.8rem 1.2rem;
                font-size: 0.9rem;
            }

            button {
                padding: 0.8rem 1.5rem;
                width: 100%;
            }

            .preview-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 0.5rem;
            }

            .container {
                padding: 0.8rem;
            }

            h1 {
                font-size: 1.5rem;
            }

            .tab {
                padding: 0.6rem 1rem;
                font-size: 0.85rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Create New Assignment</h1>

        <div class="tabs">
            <div class="tab active" data-tab="edit">Edit</div>
            <div class="tab" data-tab="preview">Preview</div>
        </div>

        <div class="tab-content active" id="edit">
            <form id="assignmentForm">
                <div class="form-group">
                    <label for="title">Assignment Title</label>
                    <input type="text" id="title" required placeholder="Enter assignment title">
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="dueDate">Due Date</label>
                            <input type="datetime-local" id="dueDate" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="points">Points</label>
                            <input type="number" id="points" class="points-input" required min="0" placeholder="100">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Instructions</label>
                    <textarea id="description" rows="6" required placeholder="Enter detailed instructions for the assignment"></textarea>
                </div>

                <div class="form-group">
                    <label for="attachments">Attachments</label>
                    <div id="attachments">
                        <p>Drop files here or click to upload</p>
                        <input type="file" id="fileInput" multiple style="display: none;">
                    </div>
                    <ul id="attachmentsList"></ul>
                </div>

                <div class="button-group">
                    <button type="button" onclick="previewAssignment()">Preview</button>
                    <button type="submit">Publish Assignment</button>
                </div>
            </form>
        </div>

        <div class="tab-content" id="preview">
            <div class="preview-container">
                <div class="preview-header">
                    <h2 class="preview-title">Loading...</h2>
                    <div class="preview-meta">
                        <p>Due: <span id="previewDueDate">Loading...</span></p>
                        <p>Points: <span id="previewPoints">Loading...</span></p>
                    </div>
                </div>
                <div class="preview-description">Loading...</div>
                <div class="form-group">
                    <h3>Attachments</h3>
                    <ul class="preview-attachments"></ul>
                </div>
            </div>
            <div class="button-group">
                <button type="button" class="secondary-button" onclick="switchTab('edit')">Edit</button>
                <button type="button" onclick="publishAssignment()">Publish Assignment</button>
            </div>
        </div>
    </div>

    <div class="notification" id="notification">Assignment created successfully!</div>

    <script>
        const form = document.getElementById('assignmentForm');
        const attachmentsDiv = document.getElementById('attachments');
        const fileInput = document.getElementById('fileInput');
        const attachmentsList = document.getElementById('attachmentsList');
        const notification = document.getElementById('notification');
        const tabs = document.querySelectorAll('.tab');
        const tabContents = document.querySelectorAll('.tab-content');

        // Set minimum date to today
        const today = new Date();
        const formattedDate = today.toISOString().slice(0, 16);
        document.getElementById('dueDate').min = formattedDate;

        // Tab switching
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                switchTab(tab.dataset.tab);
            });
        });

        function switchTab(tabId) {
            tabs.forEach(tab => {
                tab.classList.toggle('active', tab.dataset.tab === tabId);
            });
            tabContents.forEach(content => {
                content.classList.toggle('active', content.id === tabId);
            });
            if (tabId === 'preview') {
                previewAssignment();
            }
        }

        // Handle file uploads
        attachmentsDiv.addEventListener('click', () => fileInput.click());
        attachmentsDiv.addEventListener('dragover', (e) => {
            e.preventDefault();
            attachmentsDiv.style.borderColor = '#ffc400';
        });
        attachmentsDiv.addEventListener('dragleave', () => {
            attachmentsDiv.style.borderColor = '#ddd';
        });
        attachmentsDiv.addEventListener('drop', (e) => {
            e.preventDefault();
            attachmentsDiv.style.borderColor = '#ddd';
            handleFiles(e.dataTransfer.files);
        });

        fileInput.addEventListener('change', (e) => {
            handleFiles(e.target.files);
        });

        function handleFiles(files) {
            Array.from(files).forEach(file => {
                const li = document.createElement('li');
                li.innerHTML = `
                    ${file.name}
                    <span class="remove-file">×</span>
                `;
                li.querySelector('.remove-file').addEventListener('click', () => {
                    li.remove();
                });
                attachmentsList.appendChild(li);
            });
        }

        // Preview functionality
        function previewAssignment() {
            const title = document.getElementById('title').value || 'Untitled Assignment';
            const dueDate = document.getElementById('dueDate').value;
            const points = document.getElementById('points').value || '0';
            const description = document.getElementById('description').value || 'No description provided.';
            const attachments = Array.from(attachmentsList.children).map(li => li.textContent.trim().slice(0, -1));

            document.querySelector('.preview-title').textContent = title;
            document.getElementById('previewDueDate').textContent = formatDate(dueDate);
            document.getElementById('previewPoints').textContent = `${points} points`;
            document.querySelector('.preview-description').innerHTML = description.replace(/\n/g, '<br>');

            const previewAttachments = document.querySelector('.preview-attachments');
            previewAttachments.innerHTML = attachments.map(file => `
                <li>
                    <span>📎 ${file}</span>
                </li>
            `).join('');
        }

        function formatDate(dateString) {
            if (!dateString) return 'No due date';
            const date = new Date(dateString);
            return date.toLocaleString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: 'numeric',
                minute: 'numeric'
            });
        }

        // Form submission
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            publishAssignment();
        });

        function publishAssignment() {
            const formData = {
                title: document.getElementById('title').value,
                dueDate: document.getElementById('dueDate').value,
                points: document.getElementById('points').value,
                description: document.getElementById('description').value,
                attachments: Array.from(attachmentsList.children).map(li => li.textContent.trim().slice(0, -1))
            };

            // Show notification
            notification.style.display = 'block';
            setTimeout(() => {
                notification.style.display = 'none';
            }, 3000);

            // Reset form and switch to edit tab
            form.reset();
            attachmentsList.innerHTML = '';
            switchTab('edit');

            // Log the collected data (replace with your API call)
            console.log('Assignment Data:', formData);
        }
    </script>
</body>

</html>