<?php include $this->resolve("partials/_header.php"); ?>

<link rel="stylesheet" href="/assets/styles/Course/succsess.css">

<div class="success-container">
    <div class="success-card">
        <div class="success-icon">
            <i class="fa-solid fa-circle-check fa-bounce"></i>
        </div>
        <h1 class="success-title">Module Created Successfully!</h1>
        <p class="success-message">Your module has been created successfully.</p>

        <div class="success-actions">
            <button class="success-btn primary" onclick="window.location.href='/course/<?= e($courseId) ?>/module/create'">
                Create another Module
            </button>
            <button class="success-btn secondary" onclick="window.location.href='/courses/<?= e($courseId) ?>'">
                Go to course
            </button>
        </div>
    </div>
</div>
<?php include $this->resolve("partials/_footer.php"); ?>