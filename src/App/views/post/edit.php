<?php include $this->resolve("partials/_header.php"); ?>
<link rel="stylesheet" href="/assets/styles/Post/edit-course-request.css">
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
                        placeholder="Enter a descriptive title"
                        value="<?php echo e($request['title']); ?>">
                    <div class="error-message" id="postTitleError">
                        <?php if (array_key_exists('title', $errors)): ?>
                            <?php echo e($errors['title'][0]); ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="postDescription" class="form-label">Description *</label>
                    <textarea id="postDescription" name="description" class="form-control textarea-control"
                        placeholder="Provide a detailed description of your post" rows="6"><?php echo e($request['description']); ?></textarea>
                    <div class="error-message" id="postDescriptionError">
                        <?php if (array_key_exists('description', $errors)): ?>
                            <?php echo e($errors['description'][0]); ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="subject" class="form-label">Subject *</label>
                    <select id="subject" name="subject" class="form-control">
                        <option value="">Select a subject</option>
                        <?php foreach ($subjects as $subject): ?>
                            <option value="<?php echo e($subject['subject_id']); ?>" <?php echo e($request['subject_id']) == e($subject['subject_id']) ? 'selected' : ''; ?>>
                                <?php echo e($subject['subject_title']); ?>
                            </option>
                        <?php endforeach; ?>
                        <option value="-1">Other</option>
                    </select>
                    <div class="error-message" id="subjectError">
                        <?php if (array_key_exists('subject', $errors)): ?>
                            <?php echo e($errors['subject'][0]); ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="grade" class="form-label">Grade/Level *</label>
                    <select id="grade" name="grade" class="form-control">
                        <option value="">Select a grade</option>
                        <?php foreach ($grades as $grade): ?>
                            <option value="<?php echo e($grade['grade_id']); ?>" <?php echo e($request['grade_id']) == e($grade['grade_id']) ? 'selected' : ''; ?>>
                                <?php echo e($grade['grade_name']); ?>
                            </option>
                        <?php endforeach; ?>
                        <option value="-1">All Levels</option>
                    </select>
                    <div class="error-message" id="gradeError">
                        <?php if (array_key_exists('grade', $errors)): ?>
                            <?php echo e($errors['grade'][0]); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="postTitle" class="form-label">Location *</label>
                    <input type="text" id="location" name="location" class="form-control"
                        placeholder="Enter a location"
                        value="<?php echo e($request['location']); ?>">
                    <div class="error-message" id="locationError">
                        <?php if (array_key_exists('location', $errors)): ?>
                            <?php echo e($errors['location'][0]); ?>
                        <?php endif; ?>
                    </div>
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