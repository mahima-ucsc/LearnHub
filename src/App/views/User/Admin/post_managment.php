<section class="posts-page">
    <div class="main-container">
        <div class="main-title">
            <h1>Post Management</h1>
        </div>
        <table class="posts-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Request ID</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Subject</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                    <th>Author</th>
                    <th>Comments Count</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($courseRequests as $request): ?>
                    <tr>
                        <td><?= e($request["title"]) ?></td>
                        <td><?= e($request["request_id"]) ?></td>
                        <td><?= e($request["description"]) ?></td>
                        <td><?= e($request["status"]) ?></td>
                        <td><?= e($request["subject"]) ?></td>
                        <td><?= e($request["created_date"]) ?></td>
                        <td><?= e($request["updated_date"]) ?></td>
                        <td><?= e($request["author"]) ?></td>
                        <td><?= e($request["comments_count"]) ?></td>
                        <td>
                            <?php if ($request["status"] === "approved"): ?>
                                <form action="/course/request/disapprove" method="POST" style="display:inline;">
                                    <input type="hidden" name="request_id" value="<?= e($request["request_id"]) ?>">
                                    <button type="submit">Disapprove</button>
                                </form>
                            <?php else: ?>
                                <form action="/course/request/approve" method="POST" style="display:inline;">
                                    <input type="hidden" name="request_id" value="<?= e($request["request_id"]) ?>">
                                    <button type="submit">Approve</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>