<?php include $this->resolve("partials/_header.php"); ?>

<link rel="stylesheet" href="/assets/styles/Course/create_course.css">

<div class="page-header">
    <h1 class="page-title">Edit Course</h1>
</div>
<!-- Basic Course Information Card -->
<section class="container">
    <div class="back-button">
        <a href="/courses/<?= $course['course_id'] ?>">
            <i class="fa-solid fa-arrow-left"></i> Go Back To Course</a>
    </div>
    <form method="POST" enctype="multipart/form-data">
        <div class="card">
            <h2 class="section-title">Course Information</h2>

            <div class="form-group">
                <label for="courseTitle" class="form-label">Course Title*</label>
                <input type="text" name="courseTitle" id="courseTitle" class="form-control"
                    placeholder="e.g., Advanced Web Development with React"
                    value="<?= e($course['title']); ?>">
                <?php if (array_key_exists('courseTitle', $errors)) : ?>
                    <div class="error-message" id="courseTitleError" style="display: block;">
                        Please enter a course title
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="courseDescription" class="form-label">Course Description*</label>
                <textarea name="courseDescription" id="courseDescription" class="form-control textarea-control" placeholder="Describe what students will learn in your course..."><?= e($course['description']); ?></textarea>
                <?php if (array_key_exists('courseDescription', $errors)) : ?>
                    <div class="error-message" id="courseDescriptionError">Please enter a course description</div>
                <?php endif; ?>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="courseSubject" class="form-label">Subject*</label>
                    <select id="courseSubject" name="subject" class="form-control">
                        <option value="">Select Subject</option>
                        <?php foreach ($subjects as $subject): ?>
                            <option value="<?php echo e($subject['subject_id']); ?>" <?= e($course['subject_id']) == $subject['subject_id'] ? 'selected' : '' ?>><?php echo e($subject['subject_title']); ?></option>
                        <?php endforeach; ?>
                        <option value="-1">Other</option>
                    </select>
                    <?php if (array_key_exists('subject', $errors)) : ?>
                        <div class="error-message" id="courseSubjectError">Please select a subject</div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="courseGrade" class="form-label">Grade*</label>
                    <select id="courseGrade" name="grade" class="form-control">
                        <option value="">Select Grade</option>
                        <?php foreach ($grades as $grade): ?>
                            <option value="<?php echo e($grade['grade_id']); ?>" <?= e($course['grade_id']) == $grade['grade_id'] ? 'selected' : '' ?>>Grade <?php echo e($grade['grade_name']); ?></option>
                        <?php endforeach; ?>
                        <option value="-1">Other</option>
                    </select>
                    <?php if (array_key_exists('grade', $errors)) : ?>
                        <div class="error-message" id="courseGradeError">Please select a grade</div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="courseStartTime" class="form-label">Start Time*</label>
                    <input type="time" name="courseStartTime" id="courseStartTime" class="form-control" value="<?= e($course['end_time']); ?>">
                    <?php if (array_key_exists('courseStartTime', $errors)) : ?>
                        <div class="error-message">
                            <?php echo e($errors['courseStartTime'][0]); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="courseEndTime" class="form-label">End Time*</label>
                    <input type="time" name="courseEndTime" id="courseEndTime" class="form-control" value="<?= e($course['end_time']); ?>">
                    <?php if (array_key_exists('courseEndTime', $errors)) : ?>
                        <div class="error-message">
                            <?php echo e($errors['courseEndTime'][0]); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="courseDay" class="form-label">Day*</label>
                    <select id="courseDay" name="courseday" class="form-control">
                        <option value="">Select Day</option>
                        <option value="Sunday" <?= e($course['day']) == "Sunday" ? 'selected' : '' ?>>Sunday</option>
                        <option value="Monday" <?= e($course['day']) == "Monday" ? 'selected' : '' ?>>Monday</option>
                        <option value="Tuesday" <?= e($course['day']) == "Monday" ? 'selected' : '' ?>>Monday</option>
                        <option value="Wednsday"> <?= e($course['day']) == "Wednsday" ? 'selected' : '' ?>Wednsday</option>
                        <option value="Thursday" <?= e($course['day']) == "Thursday" ? 'selected' : '' ?>>Thursday</option>
                        <option value="Friday" <?= e($course['day']) == "Friday" ? 'selected' : '' ?>>Friday</option>
                        <option value="Saturday" <?= e($course['day']) == "Saturday" ? 'selected' : '' ?>>Saturday</option>
                    </select>
                    <?php if (array_key_exists('courseday', $errors)) : ?>

                        <div class="error-message" id="courseDayError">
                            <?php echo e($errors['courseEndTime'][0]); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="location" class="form-label">Location*</label>
                <input type="text" name="location" id="location" class="form-control" value="<?= e($course['location']); ?>">
                <?php if (array_key_exists('courseStartTime', $errors)) : ?>

                    <div class="error-message" id="locationError">Please enter a location</div>
                <?php endif; ?>
            </div>
            <?php if ($course['billing_type'] == 'onetime'): ?>
                <div class="form-group">
                    <label for="price" class="form-label">Price*</label>
                    <input type="text" name="price" id="price" class="form-control" value="<?= e($course['price']); ?>">
                    <div class="error-message" id="locationError">Please enter a location</div>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="courseThumbnail" class="form-label">Change Course Thumbnail Image*</label>
                <input type="file" id="courseThumbnail" name="courseThumbnail" class="form-control" accept="image/*">
                <p class="hint-text">Upload a high-quality image to attract students.</p>

                <?php if (array_key_exists('img', $errors)) : ?>

                    <div class="error-message" id="courseThumbnailError">
                        <?php echo e($errors['img'][0]); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="form-actions">
                <input type="hidden" name="_METHOD" value="PUT" />
                <button type="submit" class="btn btn-primary" id="createCourseBtn">
                    <i class="fas fa-check"></i> Update Course
                </button>
            </div>

        </div>
    </form>
</section>