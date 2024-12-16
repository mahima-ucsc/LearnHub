<?php include $this->resolve("partials/_header.php"); ?>

<link rel="stylesheet" href="/assets/styles/Post/course-requests.css">
<link rel="stylesheet" href="/assets/styles/Post/action-menu.css">

<section class="course-requests-container">
    <h1 class="course-requests-title">Course Requests</h1>

    <?php foreach ($courseRequests as $request): ?>
        <!-- Request Feed -->
        <div class="request-feed">
            <div class="post-link">
                <!-- Course Request -->
                <div class="request-post">
                    <div class="request-header">
                        <div class="user-info">
                            <img src="/assets/images/user.jpeg" alt="User Avatar" class="avatar">
                            <div class="user-details">
                                <h4><?= e($request["author"]) ?></h4>
                                <span class="post-time">
                                    <?= e(
                                        $request["updated_date"] === $request["created_date"] ?
                                            "Posted on " . formatDate($request["created_date"], 'F j, Y') :
                                            "Edited on " . formatDate($request["updated_date"], 'F j, Y')
                                    ) ?>
                                </span>
                            </div>
                        </div>
                        <div class="action-menu">
                            <button class="menu-button">⋮</button>
                            <div class="menu-dropdown">
                                <a href="<?= "/course/request/" . $request["request_id"] ?>">View</a>
                                <?php if ($request["author_id"] == $_SESSION["user"]): ?>
                                    <a href="<?= "/course/request/edit/" . $request["request_id"] ?>">Edit</a>
                                    <form action="<?= "/course/request/" . $request["request_id"] ?>" method="POST">
                                        <input type="hidden" name="_METHOD" value="DELETE" />
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this request?')">Delete</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="request-title">
                        <h3><?= e($request["title"]) ?></h3>
                    </div>
                    <div class="request-content">
                        <p><?= e($request["description"]) ?></p>
                        <div class="request-metadata">
                            <span class="subject"><?= e($request["subject"]  ?? "Other") ?></span>
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <a class="comments-section" href=<?= "/course/request/" . $request["request_id"] ?>>
                        <span class="comments-count">
                            <?= e($request["comments_count"] ?? 0) ?>
                            <?= $request["comments_count"] == 1 ? "Comment" : "Comments" ?>
                        </span>
                    </a>

                </div>
            </div>
            <!-- Action Menu -->

        </div>
    <?php endforeach; ?>

</section>

<script src="/assets/js/course-requests/course-requests-action-menu.js" defer></script>
<?php include $this->resolve("partials/_footer.php"); ?>