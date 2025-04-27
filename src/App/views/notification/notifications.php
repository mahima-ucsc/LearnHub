<?php include $this->resolve("partials/_header.php"); ?>

<link rel="stylesheet" href="/assets/styles/notification-view.css">

<div class="container">
    <div class="page-header">
        <h1>Your Notifications</h1>
        <div class="header-actions">
            <a href="/notifications" class="refresh-btn" title="Refresh notifications">
                <i class="fas fa-sync-alt"></i> Refresh
            </a>
            <a href="/notifications/mark-all-as-read" class="mark-all-btn">
                <i class="fas fa-check-double"></i> Mark all as read
            </a>
        </div>
    </div>
    <div class="notification-filters">
        <a href="/notifications" class="filter-link <?= ($isread === null || $isread === '') ? 'active' : '' ?>">All</a>
        <a href="/notifications?isread=0" class="filter-link <?= $isread === '0' ? 'active' : '' ?>">Unread</a>
        <a href="/notifications?isread=1" class="filter-link <?= $isread === '1' ? 'active' : '' ?>">Read</a>
    </div>

    <div class="notifications-list">
        <?php if (empty($notifications)): ?>
            <div class="empty-state">
                <i class="fas fa-bell-slash"></i>
                <h3>No notifications</h3>
                <p>You don't have any notifications at the moment.</p>
            </div>
        <?php else: ?>
            <?php foreach ($notifications as $notification): ?>
                <div class="notification-card <?= $notification['is_read'] ? 'read' : 'unread' ?>">
                    <div class="notification-main">
                        <?php if (!$notification['is_read']): ?>
                            <div class="unread-indicator"></div>
                        <?php endif; ?>
                        <div class="notification-content">
                            <p class="notification-message"><?= e($notification['message']) ?></p>
                            <span class="notification-time"><?= formatDate($notification['updated_at'], 'F j, Y \a\t g:i a') ?></span>
                        </div>
                    </div>
                    <div class="notification-actions">
                        <?php if (!$notification['is_read']): ?>
                            <a href="/notifications/<?= $notification['notification_id'] ?>/mark-as-read/" class="mark-read">
                                <i class="fas fa-check"></i> Mark as read
                            </a>
                        <?php endif; ?>
                        <a href="<?= e($notification['url']) ?>" class="view-details">
                            <i class="fas fa-external-link-alt"></i> View
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php include $this->resolve('components/pagination.php'); ?>
</div>

<?php include $this->resolve("partials/_footer.php"); ?>