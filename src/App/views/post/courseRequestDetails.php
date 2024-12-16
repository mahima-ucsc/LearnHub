<?php include $this->resolve("partials/_header.php"); ?>

<link rel="stylesheet" href="/assets/styles/Post/action-menu.css">
<link rel="stylesheet" href="/assets/styles/Post/course-request-details.css">

<section class="course-request-detail">
    <div class="back-button">
        <a href="/course/request">← Back to Course Requests</a>
    </div>

    <!-- Main Post Content -->
    <div class="request-post-detail">
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

        <div class="request-content">
            <div class="request-title">
                <h3><?= e($request["title"]) ?></h3>
            </div>
            <p><?= e($request["description"]) ?></p>
            <div class="request-metadata">
                <span class="subject"><?= e($request["subject"]  ?? "Other") ?></span>
            </div>
        </div>
        <!-- Comments Section -->
        <div class="comments-container">
            <h3>Comments</h3>

            <!-- Existing Comments -->
            <div class="comments-list">
                <?php foreach ($comments as $comment): ?>
                    <div class="comment">
                        <div class="comment-header">
                            <div class="comment-user-info">
                                <img src="/assets/images/user.jpeg" alt="Commenter Avatar" class="comment-avatar">
                                <div class="comment-user-details">
                                    <h5><?= e($comment["author"]) ?> </h5>
                                    <span class="comment-time">
                                        <?= e(
                                            $comment["updated_date"] === $comment["created_date"] ?
                                                formatDate(e($comment["created_date"], 'F j, Y')) :
                                                formatDate(e($comment["updated_date"], 'F j, Y'))
                                        ) ?>
                                    </span>
                                    <?php if (e($comment["created_date"]) !== e($comment["updated_date"])): ?>
                                        <span class="comment-edited">(edited)</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if (e($comment["author_id"]) == $_SESSION["user"]): ?>
                                <div class="action-menu">
                                    <button class="menu-button">⋮</button>
                                    <div class="menu-dropdown">
                                        <a class="edit-comment-button" data-comment-id="<?= e($comment["comment_id"]) ?>">Edit</a>
                                        <form action="<?= "/course/request/" . $request["request_id"] . "/comments/" . $comment["comment_id"] ?>" method="POST">
                                            <input type="hidden" name="_METHOD" value="DELETE" />
                                            <button type="submit" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- Comment Text or Edit Form -->
                        <div class="comment-content" id="comment-<?= e($comment["comment_id"]) ?>">
                            <p class="comment-text"><?= e($comment["comment"]) ?></p>
                            <form class="edit-comment-form hidden comment-form" action="<?= "/course/request/" . $request["request_id"] . "/comments/" . $comment["comment_id"] ?>" method="POST">
                                <input type="hidden" name="_METHOD" value="PUT" />
                                <textarea name="comment" data-comment=<?= e($comment["comment"]) ?> required><?= e($comment["comment"]) ?></textarea>
                                <button type="submit">Save</button>
                                <button type="button" class="cancel-edit">Cancel</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- New Comment Form -->
            <form class="comment-form" action=<?= "/course/request/$requestId/comments/create" ?> method="POST">
                <textarea name="comment" placeholder="Write a comment..." required></textarea>
                <button type="submit">Post Comment</button>
            </form>
        </div>
    </div>

</section>

<script src="/assets/js/course-requests/course-requests-action-menu.js" defer></script>
<script src="/assets/js/course-requests/edit-comment.js" defer></script>
<?php include $this->resolve("partials/_footer.php"); ?>