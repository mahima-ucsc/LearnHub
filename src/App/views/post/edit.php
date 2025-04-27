<?php include $this->resolve("partials/_header.php"); ?>
<style>
    :root {
        --primary: #FFC400;
        --primary-dark: #e6b000;
        --primary-rgb: 255, 196, 0;
        --gray-light: #f8f9fa;
        --gray: #e9ecef;
        --gray-dark: #6c757d;
        --white: #ffffff;
        --shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
        --radius-sm: 8px;
        --radius-md: 8px;
        --radius-lg: 12px;
        --color-text: #333333;
        --color-text-secondary: var(--gray-dark);
        --color-heading: #222222;
        --color-bg: var(--white);
        --color-bg-secondary: var(--gray-light);
        --color-border: var(--gray);
        --color-success: #28a745;
        --color-success-bg: #d4edda;
        --color-error: #dc3545;
    }

    .post-container {
        max-width: 900px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .post-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .post-title {
        font-size: 2rem;
        color: var(--primary);
        margin-bottom: 0.5rem;
    }

    .post-subtitle {
        color: var(--color-text-secondary);
        font-size: 1rem;
    }

    .success-message {
        background-color: var(--color-success-bg);
        color: var(--color-success);
        padding: 1rem;
        border-radius: var(--radius-md);
        margin-bottom: 1.5rem;
        display: none;
        text-align: center;
    }

    .post-form-container {
        background-color: var(--color-bg);
        border-radius: var(--radius-lg);
        padding: 2rem;
        box-shadow: var(--shadow-md);
    }

    .form-section {
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid var(--color-border);
    }

    .section-title {
        color: var(--color-heading);
        margin-bottom: 1.5rem;
        font-size: 1.25rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: var(--color-text);
    }

    .form-control {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid var(--color-border);
        border-radius: var(--radius-md);
        font-size: 1rem;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(var(--primary-rgb), 0.1);
    }

    .form-control.error {
        border-color: var(--color-error);
    }

    .textarea-control {
        min-height: 100px;
        resize: vertical;
    }

    .hint-text {
        font-size: 0.85rem;
        color: var(--color-text-secondary);
        margin-top: 0.5rem;
    }

    .error-message {
        color: var(--color-error);
        font-size: 0.85rem;
        margin-top: 0.5rem;
        display: none;
    }

    .toggle-container {
        display: flex;
        align-items: center;
    }

    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 52px;
        height: 26px;
        margin-right: 10px;
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
        background-color: #ccc;
        transition: .4s;
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
        transition: .4s;
        border-radius: 50%;
    }

    input:checked+.toggle-slider {
        background-color: var(--primary);
    }

    input:checked+.toggle-slider:before {
        transform: translateX(26px);
    }

    .toggle-label {
        font-size: 0.95rem;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: var(--radius-md);
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary {
        background-color: var(--primary);
        color: white;
        border: none;
    }

    .btn-primary:hover {
        background-color: var(--primary-dark);
    }

    .btn-outline {
        background-color: transparent;
        color: var(--color-text);
        border: 1px solid var(--color-border);
    }

    .btn-outline:hover {
        background-color: var(--color-bg-secondary);
    }

    @media (max-width: 768px) {
        .post-form-container {
            padding: 1.5rem;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }
    }
</style>
<div class="post-container">
    <div class="post-header">

        <h1 class="post-title">Edit Your Post</h1>
        </p>
    </div>

    <div class="success-message" id="successMessage">
        Your post has been successfully created and published.
    </div>

    <div class="post-form-container">
        <form id="postForm" method="POST">
            <!-- Basic Post Information -->
            <div class="form-section">
                <h3 class="section-title">Post Information</h3>

                <div class="form-group">
                    <label for="postTitle" class="form-label">Title *</label>
                    <input type="text" id="postTitle" name="title" class="form-control"
                        placeholder="Enter a descriptive title" required maxlength="100"
                        value="<?php echo e($request['title']); ?>">
                    <div class="error-message" id="postTitleError">Please enter a title</div>
                </div>

                <div class="form-group">
                    <label for="postDescription" class="form-label">Description *</label>
                    <textarea id="postDescription" name="description" class="form-control textarea-control"
                        placeholder="Provide a detailed description of your post" required rows="6"><?php echo e($request['description']); ?></textarea>
                    <div class="error-message" id="postDescriptionError">Please enter a description</div>
                </div>

                <div class="form-group">
                    <label for="subject" class="form-label">Subject *</label>
                    <select id="subject" name="subject" class="form-control" required>
                        <option value="">Select a subject</option>
                        <?php foreach ($subjects as $subject): ?>
                            <option value="<?php echo e($subject['subject_id']); ?>" <?php echo e($request['subject_id']) == e($subject['subject_id']) ? 'selected' : ''; ?>>
                                <?php echo e($subject['subject_title']); ?>
                            </option>
                        <?php endforeach; ?>
                        <option value="-1">Other</option>
                    </select>
                    <div class="error-message" id="subjectError">Please select a subject</div>
                </div>

                <div class="form-group">
                    <label for="grade" class="form-label">Grade/Level *</label>
                    <select id="grade" name="grade" class="form-control" required>
                        <option value="">Select a grade</option>
                        <?php foreach ($grades as $grade): ?>
                            <option value="<?php echo e($grade['grade_id']); ?>" <?php echo e($request['grade_id']) == e($grade['grade_id']) ? 'selected' : ''; ?>>
                                <?php echo e($grade['grade_name']); ?>
                            </option>
                        <?php endforeach; ?>
                        <option value="-1">All Levels</option>
                    </select>
                    <div class="error-message" id="gradeError">Please select a grade level</div>
                </div>
                <div class="form-group">
                    <label for="postTitle" class="form-label">Location *</label>
                    <input type="text" id="location" name="location" class="form-control"
                        placeholder="Enter a location" required
                        value="<?php echo e($request['location']); ?>">
                    <div class="error-message" id="locationError">Please enter a location</div>
                </div>
            </div>


            <!-- Submit Section -->
            <div class="form-actions">
                <input type="hidden" name="_METHOD" value="PUT" />
                <button type="submit" class="btn btn-primary" id="submitPost">
                    <i class="fas fa-paper-plane"></i> Update Post
                </button>
            </div>
        </form>
    </div>
</div>

<script>
</script>

<?php include $this->resolve("partials/_footer.php"); ?>