<?php include $this->resolve("partials/_header.php"); ?>
<?php include $this->resolve("partials/_alert.php"); ?>

<link rel="stylesheet" href="/assets/styles/create-form.css">

<section class="create-container">
    <div class="create-header">
        <h1>Update Course Request</h1>
        <p>Share your course request with the community</p>
    </div>

    <form class="create-form" id="createCourseRequestForm" method="POST" action=<?= "/course/request/" . $oldRequestData["request_id"] ?>>
        <input type="hidden" name="_METHOD" value="PUT" />

        <div class="create-section">
            <h2>Course Request Details</h2>
            <div class="create-form-group">
                <label for="requestTitle">Course Request Title *</label>
                <input type="text" id="requestTitle" name="requestTitle" value=<?= $oldRequestData["title"] ?> required>
            </div>
            <div class="create-form-group">
                <label for="requestDescription">Course Request Description *</label>
                <textarea id="requestDescription" name="requestDescription" required><?= e($oldRequestData["description"]) ?></textarea>
            </div>
            <div class="create-course-form-group">
                <label for="subject_id">Subject *</label>
                <select id="subject_id" name="subject_id" required>
                    <?php foreach ($subjects as $subject): ?>
                        <option
                            value="<?= e($subject["subject_id"]); ?>"
                            <?php if (e($subject["subject_id"]) === e($oldRequestData["subject_id"] ?? "")): ?>
                            selected="selected"
                            <?php endif; ?>>
                            <?= e($subject["subject_title"]); ?>
                        </option>
                    <?php endforeach; ?>

                    <option
                        value="-1"
                        <?php if ($oldRequestData["subject_id"] == null): ?>
                        selected="selected"
                        <?php endif; ?>>
                        Other
                    </option>
                </select>
            </div>
        </div>

        <button type="submit" class="create-submit">Update Request</button>
    </form>
</section>