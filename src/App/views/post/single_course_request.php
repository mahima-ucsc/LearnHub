<?php include $this->resolve("partials/_header.php"); ?>

<link rel="stylesheet" href="/assets/styles/Post/action-menu.css">
<link rel="stylesheet" href="/assets/styles/Post/course-request-details.css">
<link rel="stylesheet" href="/assets/styles/Post/single-post.css">
<style>
    .request-card:hover {
        transform: none !important;
        box-shadow: none !important;
    }
</style>
<section class="course-request-detail">
    <div class="back-button">
        <a href="/course/request">← Back to Course Requests</a>
    </div>

    <!-- Main Post Content -->
    <div class="request-card">
        <div class="request-header">
            <div class="requester">
                <img src="/assets/images/user_placeholder.jpg" alt="Requester">
                <span><?php echo e($request['author']); ?></span>
            </div>
            <div class="request-status">
                <span class="time-posted">
                    <?= e(
                        $request["updated_date"] === $request["created_date"] ?
                            "Posted on " . formatDate($request["created_date"], 'F j, Y') :
                            "Edited on " . formatDate($request["updated_date"], 'F j, Y')
                    ) ?>
                </span>

            </div>
        </div>
        <h4 class="request-title"><?php echo e($request['title']); ?></h4>
        <div class="request-details">
            <?php if (isset($request['grade'])): ?>
                <div class="detail-item">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Grade <?php echo e($request['grade']); ?></span>
                </div>
            <?php endif; ?>
            <?php if (isset($request['subject'])): ?>
                <div class="detail-item">
                    <i class="fas fa-book"></i>
                    <span><?php echo e($request['subject']); ?></span>
                </div>
            <?php endif; ?>
            <div class="detail-item">
                <i class="fa-solid fa-location-dot"></i>
                <span>
                    <?php echo e($request['location']); ?>
                </span>
            </div>
        </div>
        <p class="request-brief">
            <?php echo e($request['description']); ?>
        </p>
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