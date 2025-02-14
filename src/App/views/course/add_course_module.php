<?php include $this->resolve("partials/_header.php"); ?>

<head>
    <link rel="stylesheet" href="/assets/styles/Course/create-course.css">
    <style>
        .create-course-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .create-course-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .create-course-header h1 {
            color: #1a237e;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .create-course-header p {
            color: #666;
            font-size: 1.1rem;
        }

        .create-course-module {
            background: #fff;
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid #e0e0e0;
            position: relative;
            transition: all 0.3s ease;
        }


        .create-course-form-group {
            margin-bottom: 1.5rem;
        }

        .create-course-form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #2c3e50;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .create-course-form-group input,
        .create-course-form-group textarea,
        .create-course-form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .create-course-form-group input:focus,
        .create-course-form-group textarea:focus,
        .create-course-form-group select:focus {
            border-color: #FFC400;
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 196, 0, 0.2);
        }

        /* Publish Options Styling */
        .publish-options-container {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .publish-options-title {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .publish-options {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 1rem;
        }

        .publish-option-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 0.75rem 1.25rem;
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .publish-option-label:hover {
            border-color: #FFC400;
        }

        .publish-option-label.active {
            background: #FFF8E1;
            border-color: #FFC400;
        }

        .publish-option-label input[type="radio"] {
            margin-right: 0.75rem;
            width: 18px;
            height: 18px;
            accent-color: #FFC400;
        }

        /* Date Time Container Styling */
        .datetime-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            padding: 1.5rem;
            background: white;
            border-radius: 8px;
            border: 2px solid #e0e0e0;
            margin-top: 1rem;
            transition: all 0.3s ease;
        }


        .datetime-field {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .datetime-field label {
            font-size: 0.9rem;
            color: #2c3e50;
            font-weight: 500;
        }

        .datetime-field input {
            padding: 0.75rem;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .datetime-field input:focus {
            border-color: #FFC400;
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 196, 0, 0.1);
        }

        @media (max-width: 768px) {
            .datetime-container {
                grid-template-columns: 1fr;
            }

            .publish-options {
                flex-direction: column;
                gap: 1rem;
            }
        }

        .resource-container {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 1.5rem;
            margin-top: 1rem;
        }

        .resource-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .resource-type-selector {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .resource-type-button {
            padding: 0.5rem 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            background: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .resource-type-button.active {
            background: #FFC400;
            border-color: #FFC400;
            color: #000;
        }

        .create-course-add-button {
            background-color: #f8f9fa;
            color: #2c3e50;
            border: 2px dashed #ccc;
            padding: 1rem;
            width: 100%;
            margin: 1.5rem 0;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .create-course-add-button:hover {
            background-color: #f1f3f5;
            border-color: #FFC400;
        }

        .create-course-remove-button {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background-color: #fff;
            color: #dc3545;
            border: 2px solid #dc3545;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .create-course-module:hover .create-course-remove-button {
            opacity: 1;
        }

        .create-course-remove-button:hover {
            background-color: #dc3545;
            color: #fff;
        }

        .button-container {
            display: flex;
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .create-course-back,
        .create-course-submit {
            flex: 1;
            padding: 1rem;
            border-radius: 8px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .create-course-back {
            background-color: #f8f9fa;
            color: #2c3e50;
            border: 2px solid #e0e0e0;
        }

        .create-course-submit {
            background-color: #FFC400;
            border: none;
            color: #000;
        }

        .error {
            background-color: #fff3f3;
            color: #dc3545;
            padding: 1rem;
            border-radius: 8px;
            margin-top: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
        }

        .resource-preview-container {
            margin-top: 1rem;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }

        .resource-preview-item {
            background: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 1rem;
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .resource-preview-item .file-icon {
            color: #2c3e50;
            flex-shrink: 0;
        }

        .resource-preview-item .file-info {
            flex-grow: 1;
            overflow: hidden;
        }

        .resource-preview-item .file-name {
            font-size: 0.9rem;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .resource-preview-item .file-size {
            font-size: 0.8rem;
            color: #666;
        }

        .resource-preview-item .remove-resource {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .resource-preview-item .remove-resource:hover {
            transform: scale(1.1);
            background: #c82333;
        }

        .resource-dropzone {
            border: 2px dashed #ccc;
            border-radius: 8px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .resource-dropzone:hover,
        .resource-dropzone.dragover {
            border-color: #FFC400;
            background: #fff9e6;
        }

        .resource-dropzone-text {
            color: #666;
            margin-top: 0.5rem;
        }

        @media (max-width: 768px) {
            .create-course-container {
                padding: 1rem;
            }

            .button-container {
                flex-direction: column;
            }
        }
    </style>
</head>

<section class="create-course-container">
    <div class="create-course-header">
        <h1>Create Your Course Modules</h1>
        <p>Design your course structure and add learning resources</p>
    </div>

    <form class="create-course-form" id="addModulesForm" enctype="multipart/form-data" method="POST" action="/create-course">
        <div id="modulesContainer">
            <!-- Modules will be added here -->
        </div>

        <button type="button" class="create-course-add-button" onclick="addModule()">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 8px;">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Add New Module
        </button>

        <div class="button-container">
            <button type="button" class="create-course-back" onclick="window.history.back()">Back</button>
            <button type="submit" class="create-course-submit">Create Course</button>
        </div>

        <?php if ($errors['create_course']): ?>
            <div class="error">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12" y2="16"></line>
                </svg>
                <?php echo e($errors['create_course'][0]); ?>
            </div>
        <?php endif; ?>
    </form>

    <script>
        let moduleCount = 0;
        const moduleResources = new Map(); // Store resources for each module

        function addModule() {
            const container = document.getElementById('modulesContainer');
            const newModule = document.createElement('div');
            newModule.className = 'create-course-module';
            newModule.dataset.moduleId = moduleCount;

            newModule.innerHTML = `
        <button type="button" class="create-course-remove-button" onclick="removeModule(${moduleCount})">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 4px;">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
            Remove
        </button>
        <div class="create-course-form-group">
            <label for="module_title_${moduleCount}">Module Title *</label>
            <input type="text" id="module_title_${moduleCount}" name="modules[${moduleCount}][title]" required placeholder="Enter module title">
        </div>
        <div class="create-course-form-group">
            <label for="module_description_${moduleCount}">Module Description *</label>
            <textarea id="module_description_${moduleCount}" name="modules[${moduleCount}][description]" required placeholder="Describe what students will learn in this module" rows="4"></textarea>
        </div>
        <div class="publish-options-container">
            <h3 class="publish-options-title">Publish Course Module</h3>
            <div class="publish-options">
                <label class="publish-option-label active">
                    <input type="radio" name="modules[${moduleCount}][publish_type]" 
                        value="immediate" checked 
                        onclick="togglePublishDate(${moduleCount}, 'immediate')">
                    Publish Immediately
                </label>
                <label class="publish-option-label">
                    <input type="radio" name="modules[${moduleCount}][publish_type]" 
                        value="schedule" 
                        onclick="togglePublishDate(${moduleCount}, 'schedule')">
                    Schedule for Later
                </label>
            </div>
            
            <div class="datetime-container" id="publishDateContainer_${moduleCount}" style="display: none;">
                <div class="datetime-field">
                    <label for="module_start_date_${moduleCount}">Start Date and Time</label>
                    <input type="datetime-local" 
                        id="module_start_date_${moduleCount}" 
                        name="modules[${moduleCount}][start_date]">
                </div>
                <div class="datetime-field">
                    <label for="module_end_date_${moduleCount}">End Date and Time</label>
                    <input type="datetime-local" 
                        id="module_end_date_${moduleCount}" 
                        name="modules[${moduleCount}][end_date]">
                </div>
            </div>
        </div>
        <div class="resource-container">
            <div class="resource-header">
                <h3>Module Resources</h3>
            </div>
            <div class="resource-type-selector">
                <button type="button" class="resource-type-button active" onclick="selectResourceType(${moduleCount}, 'file')">File Upload</button>
                <button type="button" class="resource-type-button" onclick="selectResourceType(${moduleCount}, 'link')">External Link</button>
                <button type="button" class="resource-type-button" onclick="selectResourceType(${moduleCount}, 'text')">Text Content</button>
            </div>
            <div class="resource-content" id="resource_content_${moduleCount}">
                <div class="resource-dropzone" id="dropzone_${moduleCount}" 
                     ondrop="handleDrop(event, ${moduleCount})" 
                     ondragover="handleDragOver(event)"
                     ondragleave="handleDragLeave(event)"
                     onclick="triggerFileInput(${moduleCount})">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="17 8 12 3 7 8"></polyline>
                        <line x1="12" y1="3" x2="12" y2="15"></line>
                    </svg>
                    <p class="resource-dropzone-text">Drag & drop files here or click to browse</p>
                </div>
                <input type="file" 
                       id="module_resource_${moduleCount}" 
                       multiple 
                       style="display: none;"
                       onchange="handleFileSelect(event, ${moduleCount})">
                <div id="hidden_files_${moduleCount}"></div>
                <div class="resource-preview-container" id="preview_${moduleCount}"></div>
            </div>
            <input type="text" 
                   id="module_resource_link_${moduleCount}" 
                   name="modules[${moduleCount}][resource_link]" 
                   class="resource-input" 
                   style="display: none;" 
                   placeholder="Enter resource URL">
            <textarea id="module_resource_text_${moduleCount}" 
                    name="modules[${moduleCount}][resource_text]" 
                    class="resource-input" 
                    style="display: none;" 
                    placeholder="Enter text content"></textarea>
        </div>
    `;

            container.appendChild(newModule);
            moduleResources.set(moduleCount, new Set());
            moduleCount++;
            updateModuleIndexes();
        }

        function handleDragOver(event) {
            event.preventDefault();
            event.currentTarget.classList.add('dragover');
        }

        function handleDragLeave(event) {
            event.preventDefault();
            event.currentTarget.classList.remove('dragover');
        }

        function handleDrop(event, moduleId) {
            event.preventDefault();
            event.currentTarget.classList.remove('dragover');
            const files = event.dataTransfer.files;
            handleFiles(files, moduleId);
        }

        function triggerFileInput(moduleId) {
            document.getElementById(`module_resource_${moduleId}`).click();
        }

        function handleFileSelect(event, moduleId) {
            const files = event.target.files;
            handleFiles(files, moduleId);
        }

        function handleFiles(files, moduleId) {
            const resources = moduleResources.get(moduleId);
            const previewContainer = document.getElementById(`preview_${moduleId}`);
            const hiddenFilesContainer = document.getElementById(`hidden_files_${moduleId}`);

            Array.from(files).forEach((file, index) => {
                if (!resources.has(file.name)) {
                    resources.add(file.name);

                    // Create preview item
                    const previewItem = document.createElement('div');
                    previewItem.className = 'resource-preview-item';
                    previewItem.innerHTML = `
                <svg class="file-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                    <polyline points="13 2 13 9 20 9"></polyline>
                </svg>
                <div class="file-info">
                    <div class="file-name">${file.name}</div>
                    <div class="file-size">${formatFileSize(file.size)}</div>
                </div>
                <button type="button" class="remove-resource" onclick="removeResource('${file.name}', ${moduleId})">
                    ×
                </button>
            `;
                    previewContainer.appendChild(previewItem);

                    // Create hidden input for the file
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'file';
                    hiddenInput.name = `modules[${moduleId}][resources][]`;
                    hiddenInput.style.display = 'none';
                    hiddenInput.id = `hidden_file_${moduleId}_${file.name}`;

                    // Create a new FileList containing only this file
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    hiddenInput.files = dataTransfer.files;

                    hiddenFilesContainer.appendChild(hiddenInput);
                }
            });
        }

        function removeResource(fileName, moduleId) {
            const resources = moduleResources.get(moduleId);
            resources.delete(fileName);

            // Remove preview
            const previewContainer = document.getElementById(`preview_${moduleId}`);
            const items = previewContainer.getElementsByClassName('resource-preview-item');
            Array.from(items).forEach(item => {
                if (item.querySelector('.file-name').textContent === fileName) {
                    item.remove();
                }
            });

            // Remove hidden input
            const hiddenInput = document.getElementById(`hidden_file_${moduleId}_${fileName}`);
            if (hiddenInput) {
                hiddenInput.remove();
            }
        }

        function removeModule(moduleId) {
            const module = document.querySelector(`[data-module-id="${moduleId}"]`);
            if (module && document.querySelectorAll('.create-course-module').length > 1) {
                module.remove();
                moduleResources.delete(moduleId);
                updateModuleIndexes();
            } else {
                alert('You must have at least one module!');
            }
        }

        function selectResourceType(moduleId, type) {
            const module = document.querySelector(`[data-module-id="${moduleId}"]`);
            const buttons = module.querySelectorAll('.resource-type-button');
            const fileContent = module.querySelector(`#resource_content_${moduleId}`);
            const linkInput = module.querySelector(`#module_resource_link_${moduleId}`);
            const textInput = module.querySelector(`#module_resource_text_${moduleId}`);

            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            fileContent.style.display = 'none';
            linkInput.style.display = 'none';
            textInput.style.display = 'none';

            switch (type) {
                case 'file':
                    fileContent.style.display = 'block';
                    break;
                case 'link':
                    linkInput.style.display = 'block';
                    break;
                case 'text':
                    textInput.style.display = 'block';
                    break;
            }
        }

        function updateModuleIndexes() {
            const modules = document.querySelectorAll('.create-course-module');
            modules.forEach((module, index) => {
                // Update all input names except file inputs
                const inputs = module.querySelectorAll('input:not([type="file"]), textarea');
                inputs.forEach(input => {
                    const nameAttr = input.getAttribute('name');
                    if (nameAttr) {
                        input.setAttribute('name', nameAttr.replace(/\[\d+\]/, `[${index}]`));
                    }
                });

                // Update hidden file inputs
                const hiddenFiles = module.querySelectorAll('#hidden_files_' + module.dataset.moduleId + ' input[type="file"]');
                hiddenFiles.forEach(input => {
                    input.name = `modules[${index}][resources][]`;
                });

                // Update module ID dataset
                module.dataset.moduleId = index;
            });
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Initialize first module on page load
        document.addEventListener('DOMContentLoaded', function() {
            addModule();
        });

        function togglePublishDate(moduleId, type) {
            const container = document.getElementById(`publishDateContainer_${moduleId}`);
            const publishOptions = document.querySelectorAll(`[name="modules[${moduleId}][publish_type]"]`);
            const labels = document.querySelectorAll(`[name="modules[${moduleId}][publish_type]"]`).forEach(radio => {
                const label = radio.closest('.publish-option-label');
                if (radio.checked) {
                    label.classList.add('active');
                } else {
                    label.classList.remove('active');
                }
            });

            if (type === 'schedule') {
                container.style.display = 'grid';
                container.classList.add('active');

                // Set minimum date to today
                const today = new Date();
                const formattedDate = today.toISOString().slice(0, 16);

                const startDate = document.getElementById(`module_start_date_${moduleId}`);
                const endDate = document.getElementById(`module_end_date_${moduleId}`);

                startDate.min = formattedDate;
                endDate.min = formattedDate;

                // Add validation for end date must be after start date
                startDate.addEventListener('change', () => {
                    endDate.min = startDate.value;
                });
            } else {
                container.style.display = 'none';
                container.classList.remove('active');
            }
        }
    </script>
</section>