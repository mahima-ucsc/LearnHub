<?php
// use App\views\components\Alert;

// $alert = new Alert('Course request approved successfully', 'success');

?>

<section class="posts-page">
    <div class="main-container">
        <div class="main-title">
            <h1>Post Management</h1>
        </div>
        <?php if (!$courseRequests): ?>
            <div class="empty">
                <h2>No pending course requests</h2>
            </div>
        <?php else: ?>
            <?php foreach ($courseRequests as $request): ?>
                <!-- Request Feed -->
                <div class="request-feed" id="post-<?= $request["request_id"] ?>">
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
                        </div>
                        <!-- buttons  -->
                        <div class="button-container">
                            <form action="/approve-post" method="POST" class="approve-form">
                                <input type="hidden" name="requestId" value="<?= e($request['request_id']) ?>">
                                <button type="submit" class="btn approve">Approve</button>
                            </form>
                            <form action="/admin-dashboard/course-managment/reject" method="POST" class="reject-form" onsubmit="return confirm('Are you sure you want to reject this request?')">
                                <input type="hidden" name="requestId" value="<?= e($request['request_id']) ?>">
                                <button class="btn move-trash">Reject</button>
                            </form>
                            <button class="btn view">View</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<div class="modal" id="modal-<?= $request['request_id'] ?>" style="display: none;">
    <div class="modal-container">
        <span class="close" onclick="closeModal(<?= $request['request_id'] ?>)">&times;</span>
        <img src="/assets/images/user.jpeg" alt="User Avatar" class="avatar">
        <h2><?= e($request["title"]) ?></h2>
        <p><strong>Author:</strong> <?= e($request["author"]) ?></p>
        <p><strong>Subject:</strong> <?= e($request["subject"] ?? "Other") ?></p>
        <p><strong>Posted on:</strong> <?= formatDate($request["created_date"], 'F j, Y') ?></p>
        <?php if ($request["updated_date"] !== $request["created_date"]): ?>
            <p><strong>Edited on:</strong> <?= formatDate($request["updated_date"], 'F j, Y') ?></p>
        <?php endif; ?>
        <p><?= e($request["description"]) ?></p>
    </div>
</div>


<script>
    document.querySelector('.btn.view').addEventListener('click', function() {
        document.getElementById('modal-<?= $request['request_id'] ?>').style.display = 'block';
    });

    document.querySelectorAll('.close').forEach(function(closeBtn) {
        closeBtn.addEventListener('click', function() {
            closeModal(<?= $request['request_id'] ?>);
        });
    });

    function closeModal(requestId) {
        document.getElementById('modal-' + requestId).style.display = 'none';
    }
</script>