<section class="posts-page">
    <div class="main-container">
        <div class="main-title">
            <h1>Post Management</h1>
        </div>

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
                            <!-- <div class="action-menu">
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
                            </div> -->
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
                        <button class="btn approve">Approve</button>
                        <button class="btn move-trash">Move Trash</button>
                        <button class="btn view">View</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
