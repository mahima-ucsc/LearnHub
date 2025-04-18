<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LearnHub - Create Course</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #FFC400;
            --primary-dark: #e6b000;
            --primary-light: #fff0c2;
            --accent: #FF7849;
            --dark: #1A1A2E;
            --gray-light: #f8f9fa;
            --gray: #e9ecef;
            --gray-dark: #6c757d;
            --white: #ffffff;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 15px 35px rgba(0, 0, 0, 0.1);
            --radius: 12px;
            --radius-sm: 8px;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--gray-light);
            color: var(--dark);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
            animation: fadeInDown 0.8s ease;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--dark);
            position: relative;
            display: inline-block;
        }

        .page-title:after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: -10px;
            width: 60px;
            height: 4px;
            background: var(--primary);
            border-radius: 2px;
            transform: translateX(-50%);
        }

        .page-subtitle {
            font-size: 1.1rem;
            color: var(--gray-dark);
            max-width: 700px;
            margin: 0 auto;
            margin-top: 20px;
        }

        .card {
            background-color: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 40px;
            margin-bottom: 30px;
            animation: fadeInUp 1s ease;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--gray);
            color: var(--dark);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }

        .form-control {
            width: 100%;
            padding: 14px 16px;
            font-size: 1rem;
            border: 2px solid var(--gray);
            border-radius: var(--radius-sm);
            background-color: var(--white);
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(255, 196, 0, 0.05);
        }

        .form-control.error {
            border-color: #dc3545;
        }

        .textarea-control {
            height: 120px;
            resize: vertical;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 8px;
            display: none;
        }

        .hint-text {
            font-size: 0.875rem;
            color: var(--gray-dark);
            margin-top: 8px;
        }

        .course-type-selector {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }

        .course-type-option {
            flex: 1;
            padding: 20px;
            border: 2px solid var(--gray);
            border-radius: var(--radius);
            cursor: pointer;
            text-align: center;
            transition: var(--transition);
        }

        .course-type-option:hover {
            border-color: var(--primary-light);
            background-color: var(--primary-light);
            transform: translateY(-5px);
        }

        .course-type-option.selected {
            border-color: var(--primary);
            background-color: var(--primary-light);
        }

        .course-type-option i {
            font-size: 2rem;
            color: var(--primary-dark);
            margin-bottom: 15px;
        }

        .course-type-option h3 {
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .course-type-option p {
            font-size: 0.9rem;
            color: var(--gray-dark);
        }

        .module-list {
            margin-top: 20px;
        }

        .module-item {
            background: var(--gray-light);
            padding: 20px;
            border-radius: var(--radius);
            margin-bottom: 20px;
            animation: fadeIn 0.5s ease;
        }

        .module-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .module-title {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .module-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn i {
            margin-right: 8px;
        }

        .btn-sm {
            padding: 8px 16px;
            font-size: 0.9rem;
        }

        .btn-primary {
            background-color: var(--primary);
            color: var(--dark);
            box-shadow: 0 4px 15px rgba(255, 196, 0, 0.3);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(255, 196, 0, 0.4);
        }

        .btn-outline {
            background-color: transparent;
            border: 2px solid var(--gray);
            color: var(--gray-dark);
        }

        .btn-outline:hover {
            border-color: var(--primary);
            color: var(--primary-dark);
            transform: translateY(-3px);
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
            transform: translateY(-3px);
        }

        .btn-flat {
            background: transparent;
            padding: 8px;
            color: var(--gray-dark);
        }

        .btn-flat:hover {
            color: var(--primary-dark);
        }

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-row .form-group {
            flex: 1;
            margin-bottom: 0;
        }

        .toggle-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 26px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: var(--gray);
            transition: var(--transition);
            border-radius: 34px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: var(--transition);
            border-radius: 50%;
        }

        input:checked+.toggle-slider {
            background-color: var(--primary);
        }

        input:checked+.toggle-slider:before {
            transform: translateX(24px);
        }

        .toggle-label {
            font-weight: 500;
        }

        .collapse-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .collapse-content.show {
            max-height: 1000px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 40px;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: var(--radius-sm);
            margin-bottom: 30px;
            display: none;
            animation: fadeIn 0.5s ease;
        }

        /* Attachment */
        .drop-zone {
            border: 2px dashed var(--gray);
            padding: 20px;
            text-align: center;
            cursor: pointer;
            margin-bottom: 15px;
            border-radius: var(--radius-sm);
            transition: var(--transition);
        }

        .drop-zone:hover {
            border-color: var(--primary);
            background-color: var(--primary-light);
        }

        .drop-zone i {
            font-size: 1.5rem;
            color: var(--primary-dark);
            margin-bottom: 10px;
            display: block;
        }

        .module-attachments-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .module-attachments-list li {
            display: flex;
            align-items: center;
            background: var(--gray-light);
            padding: 10px 15px;
            margin-bottom: 8px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--gray);
        }

        .file-icon {
            margin-right: 10px;
            color: var(--primary-dark);
        }

        .file-name {
            flex: 1;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .file-size {
            margin: 0 15px;
            color: var(--gray-dark);
            font-size: 0.85rem;
        }

        .remove-file {
            background: transparent;
            border: none;
            color: var(--gray-dark);
            cursor: pointer;
            transition: var(--transition);
        }

        .remove-file:hover {
            color: #dc3545;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Media queries */
        @media (max-width: 768px) {
            .container {
                padding: 30px 15px;
            }

            .card {
                padding: 30px 20px;
            }

            .page-title {
                font-size: 2rem;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }

            .course-type-selector {
                flex-direction: column;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Create New Course</h1>
            <p class="page-subtitle">Share your knowledge with the world by creating an engaging course. Choose your course format and start building your content.</p>
        </div>

        <div id="successMessage" class="success-message">
            Your course has been created successfully! You can now add more content or publish it.
        </div>

        <form id="createCourseForm">
            <!-- Basic Course Information Card -->
            <div class="card">
                <h2 class="section-title">Course Information</h2>

                <div class="form-group">
                    <label for="courseTitle" class="form-label">Course Title*</label>
                    <input type="text" id="courseTitle" class="form-control" placeholder="e.g., Advanced Web Development with React" required>
                    <div class="error-message" id="courseTitleError">Please enter a course title</div>
                </div>

                <div class="form-group">
                    <label for="courseDescription" class="form-label">Course Description*</label>
                    <textarea id="courseDescription" class="form-control textarea-control" placeholder="Describe what students will learn in your course..." required></textarea>
                    <div class="error-message" id="courseDescriptionError">Please enter a course description</div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="courseCategory" class="form-label">Category*</label>
                        <select id="courseCategory" class="form-control" required>
                            <option value="">Select Category</option>
                            <option value="programming">Programming & Development</option>
                            <option value="business">Business & Entrepreneurship</option>
                            <option value="design">Design & Creativity</option>
                            <option value="marketing">Marketing & Communications</option>
                            <option value="personal">Personal Development</option>
                            <option value="health">Health & Fitness</option>
                            <option value="academics">Academics</option>
                        </select>
                        <div class="error-message" id="courseCategoryError">Please select a category</div>
                    </div>

                    <div class="form-group">
                        <label for="courseLevel" class="form-label">Difficulty Level*</label>
                        <select id="courseLevel" class="form-control" required>
                            <option value="">Select Level</option>
                            <option value="beginner">Beginner</option>
                            <option value="intermediate">Intermediate</option>
                            <option value="advanced">Advanced</option>
                            <option value="all">All Levels</option>
                        </select>
                        <div class="error-message" id="courseLevelError">Please select a difficulty level</div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="courseThumbnail" class="form-label">Course Thumbnail Image*</label>
                    <input type="file" id="courseThumbnail" class="form-control" accept="image/*" required>
                    <p class="hint-text">Upload a high-quality image to attract students. Recommended size: 1280x720px</p>
                    <div class="error-message" id="courseThumbnailError">Please upload a course thumbnail</div>
                </div>
            </div>

            <!-- Course Type Card -->
            <div class="card">
                <h2 class="section-title">Course Type & Pricing</h2>

                <div class="course-type-selector">
                    <div class="course-type-option" id="fullCourseOption">
                        <i class="fas fa-box"></i>
                        <h3>Complete Course</h3>
                        <p>Create all modules upfront and set a price for the entire course.</p>
                    </div>

                    <div class="course-type-option" id="monthlyCourseOption">
                        <i class="fas fa-calendar-alt"></i>
                        <h3>Monthly Course</h3>
                        <p>Add modules over time and set individual prices for each module.</p>
                    </div>
                </div>

                <input type="hidden" id="courseType" name="courseType" value="">
                <div class="error-message" id="courseTypeError">Please select a course type</div>

                <!-- Full Course Pricing (shown when full course selected) -->
                <div id="fullCoursePricing" class="collapse-content">
                    <div class="form-group">
                        <label for="fullCoursePrice" class="form-label">Course Price*</label>
                        <input type="number" id="fullCoursePrice" class="form-control" placeholder="Enter price (in $)" step="0.01" min="0">
                        <div class="error-message" id="fullCoursePriceError">Please enter a valid price</div>
                    </div>

                    <div class="toggle-container">
                        <label class="toggle-switch">
                            <input type="checkbox" id="hasFreeTrialPeriod">
                            <span class="toggle-slider"></span>
                        </label>
                        <span class="toggle-label">Enable free trial period</span>
                    </div>

                    <div id="freeTrialPeriodInput" class="collapse-content">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="freeTrialDays" class="form-label">Free Trial Period (days)*</label>
                                <input type="number" id="freeTrialDays" class="form-control" placeholder="e.g., 7" min="1">
                                <div class="error-message" id="freeTrialDaysError">Please enter a valid number of days</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modules Card -->
            <div class="card">
                <h2 class="section-title">Course Modules</h2>

                <div id="modulesList" class="module-list">
                    <!-- Modules will be added here dynamically -->
                </div>

                <button type="button" id="addModuleBtn" class="btn btn-outline">
                    <i class="fas fa-plus"></i> Add New Module
                </button>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="button" class="btn btn-outline" id="saveAsDraftBtn">
                    <i class="fas fa-save"></i> Save as Draft
                </button>
                <button type="submit" class="btn btn-primary" id="createCourseBtn">
                    <i class="fas fa-check"></i> Create Course
                </button>
            </div>
        </form>
    </div>

    <!-- Module Template (hidden, used for JavaScript cloning) -->
    <template id="moduleTemplate">
        <div class="module-item">
            <div class="module-header">
                <h3 class="module-title">Module <span class="module-number"></span></h3>
                <div class="module-actions">
                    <button type="button" class="btn btn-flat toggle-module-content">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <button type="button" class="btn btn-flat remove-module">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>

            <div class="module-content collapse-content show">
                <div class="form-group">
                    <label class="form-label">Module Title*</label>
                    <input type="text" class="form-control module-title-input" placeholder="e.g., Introduction to React Hooks" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Module Description</label>
                    <textarea class="form-control textarea-control module-description-input" placeholder="What will students learn in this module?"></textarea>
                </div>

                <div class="monthly-module-pricing">
                    <div class="form-group">
                        <label class="form-label">Module Price*</label>
                        <input type="number" class="form-control module-price-input" placeholder="Enter price (in $)" step="0.01" min="0">
                    </div>

                    <div class="toggle-container">
                        <label class="toggle-switch">
                            <input type="checkbox" class="module-free-trial-checkbox">
                            <span class="toggle-slider"></span>
                        </label>
                        <span class="toggle-label">Enable free trial period</span>
                    </div>

                    <div class="module-free-trial-input collapse-content">
                        <div class="form-group">
                            <label class="form-label">Free Trial Period (days)*</label>
                            <input type="number" class="form-control module-free-trial-days" placeholder="e.g., 7" min="1">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Estimated Completion Time</label>
                    <div class="form-row">
                        <div class="form-group">
                            <input type="number" class="form-control module-hours" placeholder="Hours" min="0">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control module-minutes" placeholder="Minutes" min="0" max="59">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Module Attachments</label>
                    <div class="module-attachments drop-zone">
                        <p><i class="fas fa-cloud-upload-alt"></i> Drag files here or click to upload</p>
                        <input type="file" class="module-file-input" multiple style="display: none;">
                    </div>
                    <ul class="module-attachments-list"></ul>
                    <p class="hint-text">Upload any supporting materials for this module (PDFs, presentations, code samples, etc.)</p>
                </div>
            </div>
        </div>
    </template>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const form = document.getElementById('createCourseForm');
            const fullCourseOption = document.getElementById('fullCourseOption');
            const monthlyCourseOption = document.getElementById('monthlyCourseOption');
            const courseTypeInput = document.getElementById('courseType');
            const fullCoursePricing = document.getElementById('fullCoursePricing');
            const hasFreeTrialPeriod = document.getElementById('hasFreeTrialPeriod');
            const freeTrialPeriodInput = document.getElementById('freeTrialPeriodInput');
            const addModuleBtn = document.getElementById('addModuleBtn');
            const modulesList = document.getElementById('modulesList');
            const successMessage = document.getElementById('successMessage');
            const saveAsDraftBtn = document.getElementById('saveAsDraftBtn');
            const createCourseBtn = document.getElementById('createCourseBtn');

            let moduleCounter = 0;

            // Course Type Selection
            fullCourseOption.addEventListener('click', function() {
                selectCourseType('full');
            });

            monthlyCourseOption.addEventListener('click', function() {
                selectCourseType('monthly');
            });

            function selectCourseType(type) {
                fullCourseOption.classList.remove('selected');
                monthlyCourseOption.classList.remove('selected');

                if (type === 'full') {
                    fullCourseOption.classList.add('selected');
                    fullCoursePricing.classList.add('show');
                    courseTypeInput.value = 'full';

                    // Hide pricing in modules for full course
                    document.querySelectorAll('.monthly-module-pricing').forEach(el => {
                        el.style.display = 'none';
                    });
                } else {
                    monthlyCourseOption.classList.add('selected');
                    fullCoursePricing.classList.remove('show');
                    courseTypeInput.value = 'monthly';

                    // Show pricing in modules for monthly course
                    document.querySelectorAll('.monthly-module-pricing').forEach(el => {
                        el.style.display = 'block';
                    });
                }

                document.getElementById('courseTypeError').style.display = 'none';

                // Add at least one module if none exists
                if (modulesList.children.length === 0) {
                    addModule();
                }
            }

            // Toggle Free Trial Period
            hasFreeTrialPeriod.addEventListener('change', function() {
                if (this.checked) {
                    freeTrialPeriodInput.classList.add('show');
                } else {
                    freeTrialPeriodInput.classList.remove('show');
                }
            });

            // Add New Module
            addModuleBtn.addEventListener('click', addModule);

            function addModule() {
                moduleCounter++;

                // Clone the module template
                const template = document.getElementById('moduleTemplate');
                const moduleNode = document.importNode(template.content, true);

                // Update module number
                moduleNode.querySelector('.module-number').textContent = moduleCounter;

                // Add event listeners
                const toggleBtn = moduleNode.querySelector('.toggle-module-content');
                const removeBtn = moduleNode.querySelector('.remove-module');
                const moduleContent = moduleNode.querySelector('.module-content');
                const freeTrialCheckbox = moduleNode.querySelector('.module-free-trial-checkbox');
                const freeTrialInput = moduleNode.querySelector('.module-free-trial-input');

                toggleBtn.addEventListener('click', function() {
                    moduleContent.classList.toggle('show');
                    const icon = this.querySelector('i');
                    icon.classList.toggle('fa-chevron-down');
                    icon.classList.toggle('fa-chevron-up');
                });

                removeBtn.addEventListener('click', function() {
                    if (confirm('Are you sure you want to remove this module?')) {
                        this.closest('.module-item').remove();
                        updateModuleNumbers();
                    }
                });

                freeTrialCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        freeTrialInput.classList.add('show');
                    } else {
                        freeTrialInput.classList.remove('show');
                    }
                });

                // Set display state for pricing based on course type
                if (courseTypeInput.value === 'full') {
                    moduleNode.querySelector('.monthly-module-pricing').style.display = 'none';
                }

                // Append the new module
                modulesList.appendChild(moduleNode);

                // Initialize file attachments for this new module
                initializeModuleAttachments(modulesList.lastElementChild);
            }

            // Update module numbers after deletion
            function updateModuleNumbers() {
                const modules = modulesList.querySelectorAll('.module-item');
                modules.forEach((module, index) => {
                    module.querySelector('.module-number').textContent = index + 1;
                });
                moduleCounter = modules.length;
            }

            // Handle module attachments
            function initializeModuleAttachments(moduleNode) {
                const dropZone = moduleNode.querySelector('.module-attachments');
                const fileInput = moduleNode.querySelector('.module-file-input');
                const attachmentsList = moduleNode.querySelector('.module-attachments-list');

                // Create DataTransfer object to manage files
                const dataTransfer = new DataTransfer();

                // Click on drop zone to trigger file input
                dropZone.addEventListener('click', () => {
                    fileInput.click();
                });

                // Handle drag & drop events
                dropZone.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    dropZone.style.borderColor = 'var(--primary)';
                });

                dropZone.addEventListener('dragleave', (e) => {
                    e.preventDefault();
                    dropZone.style.borderColor = 'var(--gray)';
                });

                dropZone.addEventListener('drop', (e) => {
                    e.preventDefault();
                    dropZone.style.borderColor = 'var(--gray)';
                    handleFiles(e.dataTransfer.files);
                });

                // When files are selected via the file input
                fileInput.addEventListener('change', (e) => {
                    handleFiles(e.target.files);
                });

                // Add files to DataTransfer and update the preview
                function handleFiles(files) {
                    for (let i = 0; i < files.length; i++) {
                        dataTransfer.items.add(files[i]);
                    }
                    // Update the file input with our DataTransfer files
                    fileInput.files = dataTransfer.files;
                    renderPreview();
                }

                // Format file size in a readable way
                function formatFileSize(bytes) {
                    if (bytes === 0) return '0 Bytes';
                    const k = 1024;
                    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
                    const i = Math.floor(Math.log(bytes) / Math.log(k));
                    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
                }

                // Get appropriate icon for file type
                function getFileIcon(fileName) {
                    const extension = fileName.split('.').pop().toLowerCase();
                    const iconMap = {
                        pdf: 'fa-file-pdf',
                        doc: 'fa-file-word',
                        docx: 'fa-file-word',
                        xls: 'fa-file-excel',
                        xlsx: 'fa-file-excel',
                        ppt: 'fa-file-powerpoint',
                        pptx: 'fa-file-powerpoint',
                        jpg: 'fa-file-image',
                        jpeg: 'fa-file-image',
                        png: 'fa-file-image',
                        gif: 'fa-file-image',
                        svg: 'fa-file-image',
                        zip: 'fa-file-archive',
                        rar: 'fa-file-archive',
                        txt: 'fa-file-alt',
                        mp4: 'fa-file-video',
                        mov: 'fa-file-video',
                        avi: 'fa-file-video',
                        mp3: 'fa-file-audio',
                        wav: 'fa-file-audio',
                        html: 'fa-file-code',
                        css: 'fa-file-code',
                        js: 'fa-file-code'
                    };

                    return iconMap[extension] || 'fa-file';
                }

                // Render the attachments preview
                function renderPreview() {
                    // Clear the current list
                    attachmentsList.innerHTML = '';

                    // Create a preview for each file
                    Array.from(fileInput.files).forEach((file, index) => {
                        const listItem = document.createElement('li');

                        // Add file icon
                        const icon = document.createElement('i');
                        icon.className = `fas ${getFileIcon(file.name)} file-icon`;
                        listItem.appendChild(icon);

                        // Add file name
                        const fileName = document.createElement('span');
                        fileName.textContent = file.name;
                        fileName.className = 'file-name';
                        listItem.appendChild(fileName);

                        // Add file size
                        const fileSize = document.createElement('span');
                        fileSize.textContent = formatFileSize(file.size);
                        fileSize.className = 'file-size';
                        listItem.appendChild(fileSize);

                        // Create a remove button for each file
                        const removeBtn = document.createElement('button');
                        removeBtn.innerHTML = '<i class="fas fa-times"></i>';
                        removeBtn.className = 'remove-file';
                        removeBtn.type = 'button';
                        removeBtn.addEventListener('click', () => removeFile(index));
                        listItem.appendChild(removeBtn);

                        attachmentsList.appendChild(listItem);
                    });
                }

                // Remove a file from the DataTransfer list
                function removeFile(index) {
                    // Create a new DataTransfer object and add back every file except the one to remove
                    const newDataTransfer = new DataTransfer();
                    Array.from(fileInput.files).forEach((file, i) => {
                        if (i !== index) {
                            newDataTransfer.items.add(file);
                        }
                    });
                    // Update our DataTransfer and file input
                    fileInput.files = newDataTransfer.files;
                    renderPreview();
                }
            }

            // Form validation
            function validateForm() {
                let isValid = true;

                // Validate basic course info
                const requiredFields = ['courseTitle', 'courseDescription', 'courseCategory', 'courseLevel', 'courseThumbnail'];

                requiredFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    const errorElement = document.getElementById(fieldId + 'Error');

                    if (!field.value) {
                        errorElement.style.display = 'block';
                        field.classList.add('error');
                        isValid = false;
                    } else {
                        errorElement.style.display = 'none';
                        field.classList.remove('error');
                    }
                });

                // Validate course type
                if (!courseTypeInput.value) {
                    document.getElementById('courseTypeError').style.display = 'block';
                    isValid = false;
                }

                // Validate pricing based on course type
                if (courseTypeInput.value === 'full') {
                    const priceField = document.getElementById('fullCoursePrice');
                    const priceError = document.getElementById('fullCoursePriceError');

                    if (!priceField.value || parseFloat(priceField.value) < 0) {
                        priceError.style.display = 'block';
                        priceField.classList.add('error');
                        isValid = false;
                    } else {
                        priceError.style.display = 'none';
                        priceField.classList.remove('error');
                    }

                    // Validate free trial period if enabled
                    if (hasFreeTrialPeriod.checked) {
                        const daysField = document.getElementById('freeTrialDays');
                        const daysError = document.getElementById('freeTrialDaysError');

                        if (!daysField.value || parseInt(daysField.value) < 1) {
                            daysError.style.display = 'block';
                            daysField.classList.add('error');
                            isValid = false;
                        } else {
                            daysError.style.display = 'none';
                            daysField.classList.remove('error');
                        }
                    }
                }

                // Validate modules
                const modules = modulesList.querySelectorAll('.module-item');
                if (modules.length === 0) {
                    alert('Please add at least one module to your course');
                    isValid = false;
                } else {
                    modules.forEach((module, index) => {
                        const titleInput = module.querySelector('.module-title-input');

                        if (!titleInput.value) {
                            titleInput.classList.add('error');
                            isValid = false;
                        } else {
                            titleInput.classList.remove('error');
                        }

                        // Validate module price if monthly course
                        if (courseTypeInput.value === 'monthly') {
                            const priceInput = module.querySelector('.module-price-input');

                            if (!priceInput.value || parseFloat(priceInput.value) < 0) {
                                priceInput.classList.add('error');
                                isValid = false;
                            } else {
                                priceInput.classList.remove('error');
                            }

                            // Validate free trial period if enabled for this module
                            const freeTrialCheckbox = module.querySelector('.module-free-trial-checkbox');
                            if (freeTrialCheckbox.checked) {
                                const daysInput = module.querySelector('.module-free-trial-days');

                                if (!daysInput.value || parseInt(daysInput.value) < 1) {
                                    daysInput.classList.add('error');
                                    isValid = false;
                                } else {
                                    daysInput.classList.remove('error');
                                }
                            }
                        }
                    });
                }

                return isValid;
            }

            // Form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                if (validateForm()) {
                    // Disable buttons and show loading state
                    createCourseBtn.disabled = true;
                    saveAsDraftBtn.disabled = true;
                    createCourseBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating...';

                    // Collect all form data
                    const formData = new FormData();

                    // Add basic course info
                    formData.append('courseTitle', document.getElementById('courseTitle').value);
                    formData.append('courseDescription', document.getElementById('courseDescription').value);
                    formData.append('courseCategory', document.getElementById('courseCategory').value);
                    formData.append('courseLevel', document.getElementById('courseLevel').value);
                    formData.append('courseType', courseTypeInput.value);

                    // Add course thumbnail
                    const thumbnailFile = document.getElementById('courseThumbnail').files[0];
                    if (thumbnailFile) {
                        formData.append('courseThumbnail', thumbnailFile);
                    }

                    // Add pricing info for full courses
                    if (courseTypeInput.value === 'full') {
                        formData.append('coursePrice', document.getElementById('fullCoursePrice').value);
                        formData.append('hasFreeTrial', hasFreeTrialPeriod.checked);

                        if (hasFreeTrialPeriod.checked) {
                            formData.append('freeTrialDays', document.getElementById('freeTrialDays').value);
                        }
                    }

                    // Collect and add modules data
                    const modules = modulesList.querySelectorAll('.module-item');

                    modules.forEach((module, index) => {
                        const prefix = `modules[${index}]`;

                        // Add basic module info
                        formData.append(`${prefix}[title]`, module.querySelector('.module-title-input').value);
                        formData.append(`${prefix}[description]`, module.querySelector('.module-description-input').value);
                        formData.append(`${prefix}[order]`, index + 1);
                        formData.append(`${prefix}[hours]`, module.querySelector('.module-hours').value || 0);
                        formData.append(`${prefix}[minutes]`, module.querySelector('.module-minutes').value || 0);

                        // Add pricing for monthly courses
                        if (courseTypeInput.value === 'monthly') {
                            formData.append(`${prefix}[price]`, module.querySelector('.module-price-input').value);

                            const hasFreeTrial = module.querySelector('.module-free-trial-checkbox').checked;
                            formData.append(`${prefix}[hasFreeTrial]`, hasFreeTrial);

                            if (hasFreeTrial) {
                                formData.append(`${prefix}[freeTrialDays]`, module.querySelector('.module-free-trial-days').value);
                            }
                        }

                        // Add module attachments
                        const fileInput = module.querySelector('.module-file-input');
                        if (fileInput && fileInput.files.length > 0) {
                            for (let i = 0; i < fileInput.files.length; i++) {
                                formData.append(`${prefix}[attachments][${i}]`, fileInput.files[i]);
                            }
                        }
                    });

                    // In a real application, you would send this data to your server using AJAX
                    // For this example, we'll simulate a successful submission
                    setTimeout(() => {
                        // Show success message
                        successMessage.style.display = 'block';

                        // Reset form
                        createCourseBtn.disabled = false;
                        saveAsDraftBtn.disabled = false;
                        createCourseBtn.innerHTML = '<i class="fas fa-check"></i> Create Course';

                        // Scroll to top to see success message
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });

                        // Reset form after showing the message
                        setTimeout(() => {
                            form.reset();
                            modulesList.innerHTML = '';
                            moduleCounter = 0;
                            fullCourseOption.classList.remove('selected');
                            monthlyCourseOption.classList.remove('selected');
                            fullCoursePricing.classList.remove('show');
                            courseTypeInput.value = '';
                            successMessage.style.display = 'none';
                        }, 3000);
                    }, 1500);
                }
            });

            // Save as draft button
            saveAsDraftBtn.addEventListener('click', function() {
                alert('Course saved as draft! You can come back and complete it later.');
            });
        });
    </script>
</body>

</html>