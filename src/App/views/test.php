<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Course Promotion</title>
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

        .promotion-form-container {
            background-color: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 40px;
            margin-top: 20px;
            animation: fadeInUp 1s ease;
        }

        .form-section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--gray);
            color: var(--dark);
        }

        .form-group {
            margin-bottom: 25px;
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
            box-shadow: 0 0 0 3px rgba(255, 196, 0, 0.25);
        }

        .form-control.error {
            border-color: #dc3545;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 8px;
            display: none;
        }

        .input-group {
            display: flex;
            gap: 15px;
        }

        .input-group .form-group {
            flex: 1;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .textarea-control {
            height: 120px;
            resize: vertical;
        }

        .hint-text {
            font-size: 0.875rem;
            color: var(--gray-dark);
            margin-top: 8px;
        }

        .file-upload {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 30px;
            border: 2px dashed var(--gray);
            border-radius: var(--radius-sm);
            background-color: var(--gray-light);
            transition: var(--transition);
            cursor: pointer;
            margin-bottom: 15px;
        }

        .file-upload:hover {
            border-color: var(--primary);
            background-color: var(--primary-light);
        }

        .file-upload.active {
            border-color: var(--primary-dark);
            background-color: var(--primary-light);
        }

        .file-upload input[type="file"] {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }

        .upload-icon {
            font-size: 2rem;
            color: var(--primary-dark);
            margin-bottom: 15px;
        }

        .upload-text {
            font-weight: 500;
            color: var(--dark);
            margin-bottom: 5px;
        }

        .upload-hint {
            font-size: 0.875rem;
            color: var(--gray-dark);
        }

        .preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 15px;
        }

        .preview-image {
            width: 100px;
            height: 100px;
            border-radius: var(--radius-sm);
            object-fit: cover;
            border: 2px solid var(--primary-light);
            position: relative;
        }

        .remove-image {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: var(--white);
            color: var(--dark);
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            font-size: 0.75rem;
            transition: var(--transition);
        }

        .remove-image:hover {
            background-color: #dc3545;
            color: var(--white);
        }

        .feature-list {
            margin-top: 20px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            animation: fadeIn 0.3s ease;
        }

        .feature-input {
            flex: 1;
        }

        .remove-feature {
            background-color: var(--gray);
            color: var(--gray-dark);
            width: 36px;
            height: 36px;
            border: none;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px;
            cursor: pointer;
            transition: var(--transition);
        }

        .remove-feature:hover {
            background-color: #dc3545;
            color: var(--white);
        }

        .add-feature {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            background-color: var(--gray-light);
            border: 1px dashed var(--gray-dark);
            border-radius: var(--radius-sm);
            color: var(--dark);
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
        }

        .add-feature:hover {
            background-color: var(--primary-light);
            border-color: var(--primary);
        }

        .add-feature i {
            margin-right: 8px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 40px;
        }

        .btn {
            padding: 14px 28px;
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

        /* Success message */
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: var(--radius-sm);
            margin-bottom: 30px;
            display: none;
            animation: fadeIn 0.5s ease;
        }

        /* Toggle switch */
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

        .toggle-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .toggle-label {
            font-weight: 500;
        }

        /* Package selection styles */
        .package-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }

        .package-card {
            background-color: var(--white);
            border: 2px solid var(--gray);
            border-radius: var(--radius);
            padding: 30px;
            transition: var(--transition);
            position: relative;
            cursor: pointer;
        }

        .package-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
            border-color: var(--primary-light);
        }

        .package-card.selected {
            border-color: var(--primary);
            box-shadow: 0 5px 25px rgba(255, 196, 0, 0.25);
        }

        .package-badge {
            position: absolute;
            top: -10px;
            right: 20px;
            background-color: var(--accent);
            color: white;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 5px 15px;
            border-radius: 20px;
        }

        .package-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--dark);
        }

        .package-price {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--primary-dark);
        }

        .package-price .period {
            font-size: 1rem;
            color: var(--gray-dark);
            font-weight: 400;
        }

        .package-features {
            list-style-type: none;
            margin-bottom: 25px;
        }

        .package-features li {
            margin-bottom: 12px;
            position: relative;
            padding-left: 28px;
        }

        .package-features li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: var(--primary-dark);
            font-weight: bold;
        }

        .package-select-btn {
            width: 100%;
            padding: 12px;
            border: 2px solid var(--primary);
            background-color: transparent;
            color: var(--primary-dark);
            font-weight: 600;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: var(--transition);
        }

        .package-select-btn:hover,
        .selected .package-select-btn {
            background-color: var(--primary);
            color: var(--dark);
        }

        /* Animations */
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

        /* Progress Steps */
        .progress-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
            position: relative;
        }

        .progress-steps:before {
            content: '';
            position: absolute;
            top: 15px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: var(--gray);
            z-index: 1;
        }

        .step {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
        }

        .step-number {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--gray);
            border-radius: 50%;
            color: var(--gray-dark);
            font-weight: 600;
            margin-bottom: 10px;
            transition: var(--transition);
        }

        .step.active .step-number {
            background-color: var(--primary);
            color: var(--dark);
            box-shadow: 0 0 0 4px rgba(255, 196, 0, 0.25);
        }

        .step.completed .step-number {
            background-color: var(--primary-dark);
            color: var(--white);
        }

        .step-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--gray-dark);
            transition: var(--transition);
        }

        .step.active .step-label {
            color: var(--dark);
            font-weight: 600;
        }

        /* Form sections for multi-step */
        .form-step {
            display: none;
        }

        .form-step.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        /* Media queries */
        @media (max-width: 768px) {
            .container {
                padding: 30px 15px;
            }

            .promotion-form-container {
                padding: 30px 20px;
            }

            .page-title {
                font-size: 2rem;
            }

            .input-group {
                flex-direction: column;
                gap: 0;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .page-title {
                font-size: 1.8rem;
            }

            .progress-steps {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .progress-steps:before {
                display: none;
            }

            .step {
                flex-direction: row;
                gap: 10px;
            }

            .step-label {
                margin-bottom: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Course Promotion Submission</h1>
            <p class="page-subtitle">Submit your course promotion for admin approval. Promotions that meet our quality standards will be featured on the homepage.</p>
        </div>

        <div class="success-message" id="successMessage">
            Your promotion has been successfully submitted for review. You will be notified once it is approved.
        </div>

        <div class="promotion-form-container">
            <div class="progress-steps">
                <div class="step active" data-step="1">
                    <div class="step-number">1</div>
                    <div class="step-label">Course Details</div>
                </div>
                <div class="step" data-step="2">
                    <div class="step-number">2</div>
                    <div class="step-label">Select Package</div>
                </div>
                <div class="step" data-step="3">
                    <div class="step-number">3</div>
                    <div class="step-label">Media & Features</div>
                </div>
                <div class="step" data-step="4">
                    <div class="step-number">4</div>
                    <div class="step-label">Review & Submit</div>
                </div>
            </div>

            <form id="promotionForm">
                <!-- Step 1: Course Details -->
                <div class="form-step active" id="step1">
                    <div class="form-section">
                        <h3 class="section-title">Basic Course Information</h3>
                        <div class="form-group">
                            <label for="courseTitle" class="form-label">Course Title *</label>
                            <input type="text" id="courseTitle" name="courseTitle" class="form-control" placeholder="Enter course title" required>
                            <div class="error-message" id="courseTitleError">Course title is required</div>
                        </div>

                        <div class="form-group">
                            <label for="courseDescription" class="form-label">Course Description *</label>
                            <textarea id="courseDescription" name="courseDescription" class="form-control textarea-control" placeholder="Describe your course in detail" required></textarea>
                            <div class="error-message" id="courseDescriptionError">Course description is required</div>
                            <p class="hint-text">Provide a compelling description highlighting the value of your course (200-500 characters recommended)</p>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="courseCategory" class="form-label">Category *</label>
                                <select id="courseCategory" name="courseCategory" class="form-control" required>
                                    <option value="">Select category</option>
                                    <option value="development">Development</option>
                                    <option value="design">Design</option>
                                    <option value="business">Business</option>
                                    <option value="marketing">Marketing</option>
                                    <option value="photography">Photography</option>
                                    <option value="music">Music</option>
                                    <option value="health">Health & Fitness</option>
                                    <option value="language">Language Learning</option>
                                    <option value="other">Other</option>
                                </select>
                                <div class="error-message" id="courseCategoryError">Please select a category</div>
                            </div>

                            <div class="form-group">
                                <label for="courseDifficulty" class="form-label">Difficulty Level *</label>
                                <select id="courseDifficulty" name="courseDifficulty" class="form-control" required>
                                    <option value="">Select difficulty</option>
                                    <option value="beginner">Beginner</option>
                                    <option value="intermediate">Intermediate</option>
                                    <option value="advanced">Advanced</option>
                                    <option value="all">All Levels</option>
                                </select>
                                <div class="error-message" id="courseDifficultyError">Please select difficulty level</div>
                            </div>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="courseLanguage" class="form-label">Language *</label>
                                <select id="courseLanguage" name="courseLanguage" class="form-control" required>
                                    <option value="">Select language</option>
                                    <option value="english">English</option>
                                    <option value="spanish">Spanish</option>
                                    <option value="french">French</option>
                                    <option value="german">German</option>
                                    <option value="chinese">Chinese</option>
                                    <option value="japanese">Japanese</option>
                                    <option value="other">Other</option>
                                </select>
                                <div class="error-message" id="courseLanguageError">Please select a language</div>
                            </div>

                            <div class="form-group">
                                <label for="courseDuration" class="form-label">Total Course Duration (hours) *</label>
                                <input type="number" id="courseDuration" name="courseDuration" class="form-control" placeholder="e.g., 12" min="1" step="0.5" required>
                                <div class="error-message" id="courseDurationError">Please enter valid course duration</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn btn-primary" id="nextToStep2">Continue <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

                <!-- Step 2: Package Selection -->
                <!-- Step 2: Package Selection -->
                <div class="form-step" id="step2">
                    <div class="form-section">
                        <h3 class="section-title">Select Promotion Package</h3>
                        <p class="hint-text">Choose the best promotion package to showcase your course to potential students.</p>

                        <div class="form-group">
                            <label for="selectedPackage" class="form-label">Promotion Package *</label>
                            <select id="selectedPackage" name="selectedPackage" class="form-control" required>
                                <option value="">Select a package</option>
                                <option value="basic">Basic - $49.99/week (Homepage feature for 1 week)</option>
                                <option value="standard">Standard - $99.99/month (Homepage feature for 30 days)</option>
                                <option value="gold">Gold - $199.99/month (Homepage feature for 60 days)</option>
                            </select>
                            <div class="error-message" id="selectedPackageError">Please select a promotion package</div>
                        </div>

                        <div class="package-details" id="packageDetails" style="margin-top: 25px; padding: 20px; background-color: var(--primary-light); border-radius: var(--radius-sm); display: none;">
                            <h4 id="packageTitle" style="margin-bottom: 15px; color: var(--dark);"></h4>
                            <div id="packagePrice" style="font-size: 1.5rem; font-weight: 700; color: var(--primary-dark); margin-bottom: 15px;"></div>
                            <div style="font-weight: 600; margin-bottom: 10px;">Package includes:</div>
                            <ul id="packageFeatures" style="padding-left: 25px;"></ul>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn btn-outline" id="backToStep1"><i class="fas fa-arrow-left"></i> Back</button>
                        <button type="button" class="btn btn-primary" id="nextToStep3">Continue <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

                <!-- Step 3: Media & Features -->
                <div class="form-step" id="step3">
                    <div class="form-section">
                        <h3 class="section-title">Course Media</h3>

                        <div class="form-group">
                            <label class="form-label">Course Thumbnail Image *</label>
                            <div class="file-upload" id="thumbnailUpload">
                                <input type="file" id="courseThumbnail" name="courseThumbnail" accept="image/*" required>
                                <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                <p class="upload-text">Drag and drop or click to upload</p>
                                <p class="upload-hint">Recommended size: 1280x720 pixels (16:9 ratio)</p>
                            </div>
                            <div class="preview-container" id="thumbnailPreview"></div>
                            <div class="error-message" id="courseThumbnailError">Course thumbnail is required</div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Additional Images (Optional)</label>
                            <div class="file-upload" id="additionalImagesUpload">
                                <input type="file" id="additionalImages" name="additionalImages" accept="image/*" multiple>
                                <i class="fas fa-images upload-icon"></i>
                                <p class="upload-text">Upload additional screenshots or images</p>
                                <p class="upload-hint">You can select multiple files (up to 5)</p>
                            </div>
                            <div class="preview-container" id="additionalImagesPreview"></div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3 class="section-title">Course Features</h3>
                        <p class="hint-text">Add key features or benefits of your course to highlight in the promotion</p>

                        <div id="featuresList" class="feature-list">
                            <div class="feature-item">
                                <input type="text" class="form-control feature-input" name="features[]" placeholder="e.g., '50+ hours of video content'">
                                <button type="button" class="remove-feature"><i class="fas fa-times"></i></button>
                            </div>
                            <div class="feature-item">
                                <input type="text" class="form-control feature-input" name="features[]" placeholder="e.g., 'Downloadable resources'">
                                <button type="button" class="remove-feature"><i class="fas fa-times"></i></button>
                            </div>
                        </div>

                        <button type="button" id="addFeature" class="add-feature">
                            <i class="fas fa-plus"></i> Add Another Feature
                        </button>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn btn-outline" id="backToStep2"><i class="fas fa-arrow-left"></i> Back</button>
                        <button type="button" class="btn btn-primary" id="nextToStep4">Review <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

                <!-- Step 4: Review & Submit -->
                <div class="form-step" id="step4">
                    <div class="form-section">
                        <h3 class="section-title">Review Your Promotion</h3>
                        <p class="hint-text">Please review all details before submitting. You can go back to edit any section.</p>

                        <div class="review-content" id="reviewContent">
                            <!-- Content will be dynamically generated by JavaScript -->
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="toggle-container">
                            <label class="toggle-switch">
                                <input type="checkbox" id="termsAgreed" name="termsAgreed" required>
                                <span class="toggle-slider"></span>
                            </label>
                            <span class="toggle-label">I agree to the promotion guidelines and terms</span>
                        </div>
                        <div class="error-message" id="termsAgreedError">You must agree to the terms</div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn btn-outline" id="backToStep3"><i class="fas fa-arrow-left"></i> Back</button>
                        <button type="submit" class="btn btn-primary" id="submitPromotion"><i class="fas fa-paper-plane"></i> Submit Promotion</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Variables
            const form = document.getElementById('promotionForm');
            const steps = document.querySelectorAll('.form-step');
            const progressSteps = document.querySelectorAll('.step');

            // Package selection handling
            const packageCards = document.querySelectorAll('.package-card');
            const selectedPackageInput = document.getElementById('selectedPackage');

            // Select package when clicking on a card
            packageCards.forEach(card => {
                card.addEventListener('click', function() {
                    // Remove selection from all cards
                    packageCards.forEach(c => c.classList.remove('selected'));

                    // Add selection to clicked card
                    this.classList.add('selected');

                    // Store the selected package value
                    selectedPackageInput.value = this.dataset.package;

                    // Hide error if shown
                    document.getElementById('selectedPackageError').style.display = 'none';
                });
            });

            // File upload handling
            const thumbnailUpload = document.getElementById('thumbnailUpload');
            const courseThumbnail = document.getElementById('courseThumbnail');
            const thumbnailPreview = document.getElementById('thumbnailPreview');

            const additionalImagesUpload = document.getElementById('additionalImagesUpload');
            const additionalImages = document.getElementById('additionalImages');
            const additionalImagesPreview = document.getElementById('additionalImagesPreview');

            // Thumbnail upload
            thumbnailUpload.addEventListener('dragover', (e) => {
                e.preventDefault();
                thumbnailUpload.classList.add('active');
            });

            thumbnailUpload.addEventListener('dragleave', () => {
                thumbnailUpload.classList.remove('active');
            });

            thumbnailUpload.addEventListener('drop', (e) => {
                e.preventDefault();
                thumbnailUpload.classList.remove('active');

                if (e.dataTransfer.files.length) {
                    courseThumbnail.files = e.dataTransfer.files;
                    showThumbnailPreview();
                }
            });

            courseThumbnail.addEventListener('change', showThumbnailPreview);

            function showThumbnailPreview() {
                thumbnailPreview.innerHTML = '';

                if (courseThumbnail.files && courseThumbnail.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const preview = document.createElement('div');
                        preview.className = 'preview-image';
                        preview.style.backgroundImage = `url(${e.target.result})`;
                        preview.style.backgroundSize = 'cover';
                        preview.style.backgroundPosition = 'center';

                        const removeButton = document.createElement('span');
                        removeButton.className = 'remove-image';
                        removeButton.innerHTML = '<i class="fas fa-times"></i>';
                        removeButton.addEventListener('click', () => {
                            courseThumbnail.value = '';
                            thumbnailPreview.innerHTML = '';
                        });

                        preview.appendChild(removeButton);
                        thumbnailPreview.appendChild(preview);
                    };

                    reader.readAsDataURL(courseThumbnail.files[0]);
                }
            }

            // Additional images upload
            additionalImagesUpload.addEventListener('dragover', (e) => {
                e.preventDefault();
                additionalImagesUpload.classList.add('active');
            });

            additionalImagesUpload.addEventListener('dragleave', () => {
                additionalImagesUpload.classList.remove('active');
            });

            additionalImagesUpload.addEventListener('drop', (e) => {
                e.preventDefault();
                additionalImagesUpload.classList.remove('active');

                if (e.dataTransfer.files.length) {
                    additionalImages.files = e.dataTransfer.files;
                    showAdditionalImagesPreview();
                }
            });

            additionalImages.addEventListener('change', showAdditionalImagesPreview);

            function showAdditionalImagesPreview() {
                additionalImagesPreview.innerHTML = '';

                if (additionalImages.files && additionalImages.files.length) {
                    // Limit to max 5 images
                    const maxImages = Math.min(additionalImages.files.length, 5);

                    for (let i = 0; i < maxImages; i++) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            const preview = document.createElement('div');
                            preview.className = 'preview-image';
                            preview.style.backgroundImage = `url(${e.target.result})`;
                            preview.style.backgroundSize = 'cover';
                            preview.style.backgroundPosition = 'center';

                            const removeButton = document.createElement('span');
                            removeButton.className = 'remove-image';
                            removeButton.innerHTML = '<i class="fas fa-times"></i>';
                            removeButton.dataset.index = i;

                            removeButton.addEventListener('click', () => {
                                preview.remove();
                                // Note: In a real application, you would need to use FormData to properly
                                // handle file removals or a more sophisticated file upload handling
                            });

                            preview.appendChild(removeButton);
                            additionalImagesPreview.appendChild(preview);
                        };

                        reader.readAsDataURL(additionalImages.files[i]);
                    }
                }
            }

            // Course features
            const featuresList = document.getElementById('featuresList');
            const addFeatureBtn = document.getElementById('addFeature');

            addFeatureBtn.addEventListener('click', addFeature);

            function addFeature() {
                const featureItems = document.querySelectorAll('.feature-item');

                // Limit to max 10 features
                if (featureItems.length >= 10) {
                    alert('Maximum 10 features allowed');
                    return;
                }

                const newFeature = document.createElement('div');
                newFeature.className = 'feature-item';
                newFeature.style.opacity = '0';

                newFeature.innerHTML = `
                    <input type="text" class="form-control feature-input" name="features[]" placeholder="Enter course feature">
                    <button type="button" class="remove-feature"><i class="fas fa-times"></i></button>
                `;

                featuresList.appendChild(newFeature);

                // Animate the new feature
                setTimeout(() => {
                    newFeature.style.opacity = '1';
                }, 10);

                // Add event listener to the new remove button
                const removeBtn = newFeature.querySelector('.remove-feature');
                removeBtn.addEventListener('click', function() {
                    removeFeature(this);
                });
            }

            // Remove feature
            document.querySelectorAll('.remove-feature').forEach(btn => {
                btn.addEventListener('click', function() {
                    removeFeature(this);
                });
            });

            function removeFeature(button) {
                const featureItem = button.closest('.feature-item');

                // Animate removal
                featureItem.style.opacity = '0';

                setTimeout(() => {
                    featureItem.remove();
                }, 300);
            }

            // Multi-step form navigation
            const nextToStep2 = document.getElementById('nextToStep2');
            const nextToStep3 = document.getElementById('nextToStep3');
            const nextToStep4 = document.getElementById('nextToStep4');

            const backToStep1 = document.getElementById('backToStep1');
            const backToStep2 = document.getElementById('backToStep2');
            const backToStep3 = document.getElementById('backToStep3');

            const submitPromotion = document.getElementById('submitPromotion');

            // Step navigation
            nextToStep2.addEventListener('click', () => {
                if (validateStep(1)) {
                    goToStep(2);
                }
            });

            nextToStep3.addEventListener('click', () => {
                if (validateStep(2)) {
                    goToStep(3);
                }
            });

            nextToStep4.addEventListener('click', () => {
                if (validateStep(3)) {
                    populateReviewContent();
                    goToStep(4);
                }
            });

            backToStep1.addEventListener('click', () => goToStep(1));
            backToStep2.addEventListener('click', () => goToStep(2));
            backToStep3.addEventListener('click', () => goToStep(3));

            function goToStep(step) {
                steps.forEach(s => s.classList.remove('active'));
                progressSteps.forEach(s => {
                    s.classList.remove('active');
                    s.classList.remove('completed');
                });

                document.getElementById(`step${step}`).classList.add('active');

                for (let i = 1; i <= progressSteps.length; i++) {
                    const stepEl = document.querySelector(`.step[data-step="${i}"]`);
                    if (i < step) {
                        stepEl.classList.add('completed');
                    } else if (i === step) {
                        stepEl.classList.add('active');
                    }
                }

                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }

            // Form validation
            function validateStep(step) {
                let isValid = true;

                switch (step) {
                    case 1:
                        // Validate course details
                        const requiredFieldsStep1 = ['courseTitle', 'courseDescription', 'courseCategory', 'courseDifficulty', 'courseLanguage', 'courseDuration'];
                        requiredFieldsStep1.forEach(field => {
                            if (!validateField(field)) {
                                isValid = false;
                            }
                        });
                        break;

                    case 2:
                        // Validate package selection
                        if (!selectedPackageInput.value) {
                            document.getElementById('selectedPackageError').style.display = 'block';
                            isValid = false;
                        }
                        break;

                    case 3:
                        // Validate media & features
                        if (!validateField('courseThumbnail')) {
                            isValid = false;
                        }

                        // Validate that at least one feature is entered
                        const features = document.querySelectorAll('input[name="features[]"]');
                        let hasFeature = false;

                        features.forEach(feature => {
                            if (feature.value.trim() !== '') {
                                hasFeature = true;
                            }
                        });

                        if (!hasFeature) {
                            alert('Please add at least one course feature');
                            isValid = false;
                        }
                        break;

                    case 4:
                        // Validate terms agreement
                        if (!validateField('termsAgreed')) {
                            isValid = false;
                        }
                        break;
                }

                return isValid;
            }

            function validateField(fieldId) {
                const field = document.getElementById(fieldId);
                const errorElement = document.getElementById(`${fieldId}Error`);

                let isValid = true;

                if (field.required && !field.value) {
                    isValid = false;
                    if (errorElement) {
                        errorElement.style.display = 'block';
                    }
                    if (field.classList) {
                        field.classList.add('error');
                    }
                } else if (field.type === 'checkbox' && field.required && !field.checked) {
                    isValid = false;
                    if (errorElement) {
                        errorElement.style.display = 'block';
                    }
                } else if (field.type === 'file' && field.required && (!field.files || field.files.length === 0)) {
                    isValid = false;
                    if (errorElement) {
                        errorElement.style.display = 'block';
                    }
                } else {
                    if (errorElement) {
                        errorElement.style.display = 'none';
                    }
                    if (field.classList) {
                        field.classList.remove('error');
                    }
                }

                return isValid;
            }

            // Get package details for display
            function getPackageDetails(packageType) {
                const packages = {
                    'basic': {
                        name: 'Basic',
                        price: '$49.99',
                        period: 'week',
                        features: [
                            'Feature on homepage for 1 week',
                            'Basic search visibility',
                            'Basic analytics dashboard',
                            'Email promotion to 500 users'
                        ]
                    },
                    'standard': {
                        name: 'Standard',
                        price: '$99.99',
                        period: 'month',
                        features: [
                            'Feature on homepage for 1 month',
                            'Feature in category page for 1 week',
                            'Advanced search visibility',
                            'Detailed analytics dashboard',
                            'Email promotion to 2,000 users',
                            'Social media promotion'
                        ]
                    },
                    'gold': {
                        name: 'Gold',
                        price: '$199.99',
                        period: 'month',
                        features: [
                            'Feature on homepage for 1 month',
                            'Feature in category page for 1 month',
                            'Priority search visibility',
                            'Premium analytics dashboard',
                            'Email promotion to 5,000 users',
                            'Social media promotion campaign',
                            'Featured in newsletter',
                            'Dedicated promotion banner'
                        ]
                    }
                };

                return packages[packageType] || packages['basic'];
            }

            // Populate review content
            function populateReviewContent() {
                const reviewContent = document.getElementById('reviewContent');

                const courseTitle = document.getElementById('courseTitle').value;
                const courseCategory = document.getElementById('courseCategory').options[document.getElementById('courseCategory').selectedIndex].text;
                const courseDifficulty = document.getElementById('courseDifficulty').options[document.getElementById('courseDifficulty').selectedIndex].text;
                const selectedPackage = selectedPackageInput.value;
                const packageDetails = getPackageDetails(selectedPackage);

                // Get all features
                const features = [];
                document.querySelectorAll('input[name="features[]"]').forEach(feature => {
                    if (feature.value.trim() !== '') {
                        features.push(feature.value);
                    }
                });

                // Build HTML for review
                let reviewHTML = `
                    <div style="background-color: #f8f9fa; border-radius: 10px; padding: 25px; margin-bottom: 30px;">
                        <h4 style="font-size: 1.5rem; margin-bottom: 20px; color: var(--dark);">${courseTitle}</h4>
                        
                        <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 20px;">
                            <div style="flex: 1; min-width: 250px;">
                                <div style="font-weight: 600; margin-bottom: 5px;">Course Title:</div>
                                <div>${courseTitle}</div>
                            </div>
                            
                            <div style="flex: 1; min-width: 250px;">
                                <div style="font-weight: 600; margin-bottom: 5px;">Category:</div>
                                <div>${courseCategory}</div>
                            </div>
                        </div>
                        
                        <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 20px;">
                            <div style="flex: 1; min-width: 250px;">
                                <div style="font-weight: 600; margin-bottom: 5px;">Difficulty Level:</div>
                                <div>${courseDifficulty}</div>
                            </div>
                            
                            <div style="flex: 1; min-width: 250px;">
                                <div style="font-weight: 600; margin-bottom: 5px;">Duration:</div>
                                <div>${document.getElementById('courseDuration').value} hours</div>
                            </div>
                        </div>
                        
                        <div style="background-color: var(--primary-light); padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                <div style="font-size: 1.1rem; font-weight: 600;">Selected Promotion Package</div>
                                <div style="color: var(--primary-dark); font-weight: 700; font-size: 1.2rem;">${packageDetails.name}</div>
                            </div>
                            
                            <div style="display: flex; flex-wrap: wrap; gap: 15px;">
                                <div style="flex: 1; min-width: 120px;">
                                    <div style="font-size: 0.9rem; color: var(--gray-dark);">Package Price</div>
                                    <div style="font-weight: 700; color: var(--primary-dark);">${packageDetails.price}/${packageDetails.period}</div>
                                </div>
                                
                                <div style="flex: 2; min-width: 250px;">
                                    <div style="font-size: 0.9rem; color: var(--gray-dark);">Package Features</div>
                                    <ul style="margin-top: 5px; padding-left: 20px;">
                `;

                packageDetails.features.forEach(feature => {
                    reviewHTML += `<li style="line-height: 1.5; font-size: 0.9rem;">${feature}</li>`;
                });

                reviewHTML += `
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div style="margin-bottom: 20px;">
                            <div style="font-weight: 600; margin-bottom: 10px;">Course Description:</div>
                            <div style="line-height: 1.6;">${document.getElementById('courseDescription').value}</div>
                        </div>
                        
                        <div style="margin-bottom: 20px;">
                            <div style="font-weight: 600; margin-bottom: 10px;">Course Features:</div>
                            <ul style="padding-left: 20px; display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 10px;">
                `;

                features.forEach(feature => {
                    reviewHTML += `<li style="line-height: 1.5;">${feature}</li>`;
                });

                reviewHTML += `
                            </ul>
                        </div>
                    </div>
                `;

                // Display thumbnail preview in review
                if (courseThumbnail.files && courseThumbnail.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const imagePreview = document.createElement('div');
                        imagePreview.innerHTML = `
                            <div style="margin-bottom: 30px;">
                                <div style="font-weight: 600; margin-bottom: 10px;">Course Thumbnail:</div>
                                <img src="${e.target.result}" style="max-width: 100%; height: auto; border-radius: 8px; max-height: 300px; object-fit: contain; border: 2px solid var(--primary-light);">
                            </div>
                        `;

                        // Insert after the main review content
                        reviewContent.appendChild(imagePreview);
                    };

                    reader.readAsDataURL(courseThumbnail.files[0]);
                }

                reviewContent.innerHTML = reviewHTML;
            }

            // Form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                if (validateStep(4)) {
                    // Simulate form submission
                    const submitButton = document.getElementById('submitPromotion');
                    submitButton.disabled = true;
                    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';

                    setTimeout(() => {
                        // Show success message
                        const successMessage = document.getElementById('successMessage');
                        successMessage.style.display = 'block';

                        // Reset button
                        submitButton.disabled = false;
                        submitButton.innerHTML = '<i class="fas fa-paper-plane"></i> Submit Promotion';

                        // Scroll to top to see message
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });

                        // Reset form (in a real app, you'd likely redirect after successful submission)
                        setTimeout(() => {
                            form.reset();
                            thumbnailPreview.innerHTML = '';
                            additionalImagesPreview.innerHTML = '';
                            packageCards.forEach(c => c.classList.remove('selected'));

                            // Reset to first step after a short delay
                            setTimeout(() => {
                                goToStep(1);
                                successMessage.style.display = 'none';
                            }, 1000);
                        }, 3000);
                    }, 2000);
                }
            });

            // Initialize form field validations on blur
            const allInputs = document.querySelectorAll('.form-control, input[type="checkbox"], input[type="file"]');
            allInputs.forEach(input => {
                input.addEventListener('blur', function() {
                    validateField(this.id);
                });
            });
        });
    </script>
</body>

</html>