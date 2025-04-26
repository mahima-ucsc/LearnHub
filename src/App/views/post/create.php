<?php include $this->resolve("partials/_header.php"); ?>
<link rel="stylesheet" href="/assets/styles/Post/create-course-request.css">

<div class="post-container">
    <div class="post-header">

        <h1 class="post-title">Post Your Course Requirements</h1>
        <p class="post-subtitle"> Can't find the course you need? Let our teachers know what you're looking for.
        </p>
    </div>

    <div class="success-message" id="successMessage">
        Your post has been successfully created and published.
    </div>

    <div class="post-form-container">
        <form id="postForm" method="POST">
            <!-- Basic Post Information -->
            <div class="form-section">
                <h3 class="section-title">Course Request Information</h3>

                <div class="form-group">
                    <label for="postTitle" class="form-label">Title *</label>
                    <input type="text" id="postTitle" name="title" class="form-control"
                        placeholder="Enter a descriptive title"
                        value="<?= (array_key_exists('title', $oldFormData)) ? $oldFormData['title'] : '' ?>"
                        required>
                    <?php if (array_key_exists('title', $errors)): ?>
                        <div class="error-message" id="postTitleError">
                            <?= e($errors['title'][0]); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="postDescription" class="form-label">Description *</label>
                    <textarea
                        id="postDescription"
                        name="description"
                        class="form-control textarea-control"
                        placeholder="Provide a detailed description of your post"
                        rows="6"
                        required><?= (array_key_exists('description', $oldFormData)) ? $oldFormData['description'] : '' ?></textarea>

                    <?php if (array_key_exists('description', $errors)): ?>
                        <div class="error-message" id="postDescriptionError">
                            <?= e($errors['description'][0]); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="subject" class="form-label">Subject *</label>
                    <select id="subject" name="subject" class="form-control" required>
                        <option value="">Select a subject</option>
                        <?php foreach ($subjects as $subject): ?>
                            <option
                                value="<?php echo e($subject['subject_id']); ?>"
                                <?=
                                (array_key_exists('subject', $oldFormData)
                                    && e($subject['subject_id']) === $oldFormData['subject']) ? 'selected' : ''; ?>>
                                <?php echo e($subject['subject_title']); ?>
                            </option>
                        <?php endforeach; ?>
                        <option value="-1">Other</option>
                    </select>
                    <?php if (array_key_exists('subject', $errors)): ?>
                        <div class="error-message" id="subjectError">
                            <?= e($errors['subject'][0]); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="grade" class="form-label">Grade/Level *</label>
                    <select id="grade" name="grade" class="form-control" required>
                        <option value="">Select a grade</option>
                        <?php foreach ($grades as $grade): ?>
                            <option
                                value="<?php echo e($grade['grade_id']); ?>"
                                <?=
                                (array_key_exists('grade', $oldFormData)
                                    && e($grade['grade_id']) === $oldFormData['grade']) ? 'selected' : ''; ?>>
                                <?php echo e($grade['grade_name']); ?>
                            </option>
                        <?php endforeach; ?>
                        <option value="-1">All Levels</option>
                    </select>
                    <?php if (array_key_exists('grade', $errors)): ?>
                        <div class="error-message" id="gradeError">
                            <?= e($errors['grade'][0]); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="postTitle" class="form-label">Location *</label>
                    <input type="text" id="location" name="location" class="form-control"
                        placeholder="Enter a location"
                        value="<?= (array_key_exists('location', $oldFormData)) ? $oldFormData['location'] : '' ?>"
                        required>
                    <?php if (array_key_exists('location', $errors)): ?>
                        <div class="error-message" id="locationError">
                            <?= e($errors['location'][0]); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>


            <!-- Submit Section -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary" id="submitPost">
                    <i class="fas fa-paper-plane"></i> Publish Post
                </button>
            </div>
        </form>
    </div>
</div>

<?php include $this->resolve("partials/_footer.php"); ?>