<?php include $this->resolve("partials/_header.php"); ?>

<link rel="stylesheet" href="/assets/styles/Course/create_course.css">

<div class="page-header">
    <h1 class="page-title">Edit Course</h1>
</div>
<!-- Basic Course Information Card -->
<section class="container">
    <form method="POST" enctype="multipart/form-data">
        <div class="card">
            <h2 class="section-title">Course Information</h2>

            <div class="form-group">
                <label for="courseTitle" class="form-label">Course Title*</label>
                <input type="text" name="courseTitle" id="courseTitle" class="form-control"
                    placeholder="e.g., Advanced Web Development with React"
                    value="<?= e($course['title']); ?>"
                    required>
                <div class="error-message" id="courseTitleError">Please enter a course title</div>
            </div>

            <div class="form-group">
                <label for="courseDescription" class="form-label">Course Description*</label>
                <textarea name="courseDescription" id="courseDescription" class="form-control textarea-control" placeholder="Describe what students will learn in your course..." required><?= e($course['description']); ?></textarea>
                <div class="error-message" id="courseDescriptionError">Please enter a course description</div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="courseSubject" class="form-label">Subject*</label>
                    <select id="courseSubject" name="subject" class="form-control" required>
                        <option value="">Select Subject</option>
                        <?php foreach ($subjects as $subject): ?>
                            <option value="<?php echo e($subject['subject_id']); ?>" <?= e($course['subject_id']) == $subject['subject_id'] ? 'selected' : '' ?>><?php echo e($subject['subject_title']); ?></option>
                        <?php endforeach; ?>
                        <option value="-1">Other</option>
                    </select>
                    <div class="error-message" id="courseSubjectError">Please select a subject</div>
                </div>

                <div class="form-group">
                    <label for="courseGrade" class="form-label">Grade*</label>
                    <select id="courseGrade" name="grade" class="form-control" required>
                        <option value="">Select Grade</option>
                        <?php foreach ($grades as $grade): ?>
                            <option value="<?php echo e($grade['grade_id']); ?>" <?= e($course['grade_id']) == $grade['grade_id'] ? 'selected' : '' ?>>Grade <?php echo e($grade['grade_name']); ?></option>
                        <?php endforeach; ?>
                        <option value="-1">Other</option>
                    </select>
                    <div class="error-message" id="courseGradeError">Please select a grade</div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="courseStartTime" class="form-label">Start Time*</label>
                    <input type="time" name="courseStartTime" id="courseStartTime" class="form-control" value="<?= e($course['end_time']); ?>">
                    <div class="error-message" id="courseStartTimeError">Please enter a start time</div>
                </div>
                <div class="form-group">
                    <label for="courseEndTime" class="form-label">End Time*</label>
                    <input type="time" name="courseEndTime" id="courseEndTime" class="form-control" value="<?= e($course['end_time']); ?>">
                    <div class="error-message" id="courseEndTimeError">Please enter a end time</div>
                </div>
                <div class="form-group">
                    <label for="courseDay" class="form-label">Day*</label>
                    <select id="courseDay" name="courseday" class="form-control" required>
                        <option value="">Select Day</option>
                        <option value="Sunday" <?= e($course['day']) == "Sunday" ? 'selected' : '' ?>>Sunday</option>
                        <option value="Monday" <?= e($course['day']) == "Monday" ? 'selected' : '' ?>>Monday</option>
                        <option value="Tuesday" <?= e($course['day']) == "Monday" ? 'selected' : '' ?>>Monday</option>
                        <option value="Wednsday"> <?= e($course['day']) == "Wednsday" ? 'selected' : '' ?>Wednsday</option>
                        <option value="Thursday" <?= e($course['day']) == "Thursday" ? 'selected' : '' ?>>Thursday</option>
                        <option value="Friday" <?= e($course['day']) == "Friday" ? 'selected' : '' ?>>Friday</option>
                        <option value="Saturday" <?= e($course['day']) == "Saturday" ? 'selected' : '' ?>>Saturday</option>
                    </select>
                    <div class="error-message" id="courseDayError">Please enter a day</div>
                </div>
            </div>
            <div class="form-group">
                <label for="location" class="form-label">Location*</label>
                <input type="text" name="location" id="location" class="form-control" value="<?= e($course['location']); ?>">
                <div class="error-message" id="locationError">Please enter a location</div>
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
                <p class="hint-text">Upload a high-quality image to attract students. Recommended size: 1280x720px</p>
                <div class="error-message" id="courseThumbnailError">Please upload a course thumbnail</div>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Form validation for Basic Course Information
        function validateBasicInfo() {
            let isValid = true;

            // Validate basic course info
            const requiredFields = [
                'courseTitle',
                'courseDescription',
                'courseSubject',
                'courseGrade',
                'courseStartTime',
                'courseEndTime',
                'courseDay',
                'location',
                'courseThumbnail'
            ];

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

            return isValid;
        }

        // You can call this function as part of a larger form validation
        // For example, inside a form submit event listener:

        const form = document.getElementById('createCourseForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                if (!validateBasicInfo()) {
                    e.preventDefault();
                    // Scroll to first error
                    const firstError = document.querySelector('.form-control.error');
                    if (firstError) {
                        firstError.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }
                }
            });
        }
    });
</script>