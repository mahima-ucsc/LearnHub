<?php include $this->resolve("partials/_header.php"); ?>
<?php include $this->resolve("course/sidebar/sidebar.php"); ?>

<link rel="stylesheet" href="/assets/styles/Course/announcement.css">

<!-- array(13) {
    ["id"]=>
    int(1)
    ["course_id"]=>
    int(11)
    ["title"]=>
    string(10) "demo title"
    ["content"]=>
    string(16) "demo description"
    ["tags"]=>
    string(3) "assignment"
    ["visibility"]=>
    string(3) "all"
    ["specific_emails"]=>
    NULL
    ["attachments"]=>
    NULL
    ["send_email"]=>
    int(0)
    ["created_at"]=>
    string(19) "2025-04-15 08:47:46"
    ["updated_at"]=>
    string(19) "2025-04-15 08:47:46"
    ["course_title"]=>
    string(15) "සිංහල"
    ["tutor_name"]=>
    string(11) "admin admin"
  } -->



<section>
    <div class="container">
        <div class="announcements-container">
            <div class="announcements-header">
                <div class="announcements-title">
                    Announcements <span class="notification-badge"></span>
                </div>
                <div class="filter-controls">
                    <button class="filter-button active" data-filter="all">All</button>
                    <button class="filter-button" data-filter="assignments">Assignments</button>
                    <button class="filter-button" data-filter="events">Events</button>
                    <button class="filter-button" data-filter="updates">System Updates</button>
                    <button class="filter-button" data-filter="unread">Unread</button>
                </div>
            </div>

            <div class="announcement-list">
                <?php foreach ($announcements as $announcement) { ?>
                    <div class="announcement-item" id="<?php echo ("announcement-" . $announcement['id']); ?>" data-type="<?php echo htmlspecialchars($announcement["category"]) ?>" data-read="false">
                        <div class="announcement-header">
                            <div class="announcement-source">
                                <div class="unread-indicator"></div>
                                <div class="source-icon source-tutor">T</div>
                                <div class="source-name"><?php echo htmlspecialchars($announcement['tutor_name']); ?></div>
                            </div>
                            <div class="announcement-time"><?php echo date("F j, Y, g:i A", strtotime($announcement['created_at'])); ?></div>
                        </div>
                        <div class="announcement-title">
                            <?php echo htmlspecialchars($announcement['title']); ?>
                        </div>
                        <div class="announcement-content">
                            <?php echo htmlspecialchars($announcement['content']); ?>
                        </div>
                        <div class="announcement-footer">
                            <div class="announcement-tags">
                                <?php
                                foreach ($announcement as $key => $value) {
                                    if ($key == 'category') {
                                        echo '<span class="tag ' . htmlspecialchars($value) . '">' . htmlspecialchars($value) . '</span>';
                                    }
                                }
                                ?>
                            </div>
                            <div class="announcement-actions">
                                <button class="mark-read-btn">Mark as read</button>
                            </div>
                        </div>
                    </div>
            </div>
        <?php } ?>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Filter functionality
            const filterButtons = document.querySelectorAll(".filter-button");
            const announcementItems =
                document.querySelectorAll(".announcement-item");

            filterButtons.forEach((button) => {
                button.addEventListener("click", function() {
                    // Remove active class from all buttons
                    filterButtons.forEach((btn) => btn.classList.remove("active"));
                    // Add active class to clicked button
                    this.classList.add("active");

                    const filter = this.getAttribute("data-filter");

                    // Show/hide announcements based on filter
                    announcementItems.forEach((item) => {
                        if (filter === "all") {
                            item.style.display = "block";
                        } else if (filter === "unread") {
                            item.style.display =
                                item.getAttribute("data-read") === "false" ? "block" : "none";
                        } else {
                            item.style.display =
                                item.getAttribute("data-type") === filter ? "block" : "none";
                        }
                    });

                    // Check if there are any visible announcements
                    checkEmptyState();
                });
            });

            // Mark as read/unread functionality
            const markReadButtons = document.querySelectorAll(".mark-read-btn");
            const markUnreadButtons = document.querySelectorAll(".mark-unread-btn");

            markReadButtons.forEach((button) => {
                button.addEventListener("click", function() {
                    const announcementItem = this.closest(".announcement-item");
                    announcementItem.classList.add("read");
                    announcementItem.setAttribute("data-read", "true");

                    // Remove unread indicator
                    const unreadIndicator =
                        announcementItem.querySelector(".unread-indicator");
                    if (unreadIndicator) {
                        unreadIndicator.remove();
                    }

                    // Change button text
                    this.textContent = "Mark as unread";
                    this.className = "mark-unread-btn";

                    // Update unread count
                    updateUnreadCount();

                    // If we're in unread filter, this item should disappear
                    if (
                        document.querySelector(
                            '.filter-button[data-filter="unread"].active'
                        )
                    ) {
                        announcementItem.style.display = "none";
                        checkEmptyState();
                    }
                });
            });

            // Delegate event for dynamically changed buttons
            document.addEventListener("click", function(e) {
                if (e.target && e.target.classList.contains("mark-unread-btn")) {
                    const announcementItem = e.target.closest(".announcement-item");
                    announcementItem.classList.remove("read");
                    announcementItem.setAttribute("data-read", "false");

                    // Add unread indicator
                    const sourceDiv = announcementItem.querySelector(
                        ".announcement-source"
                    );
                    const unreadIndicator = document.createElement("div");
                    unreadIndicator.className = "unread-indicator";
                    sourceDiv.prepend(unreadIndicator);

                    // Change button text
                    e.target.textContent = "Mark as read";
                    e.target.className = "mark-read-btn";

                    // Update unread count
                    updateUnreadCount();
                }
            });

            // Function to update unread count badge
            function updateUnreadCount() {
                const unreadItems = document.querySelectorAll(
                    '.announcement-item[data-read="false"]'
                );
                const notificationBadge = document.querySelector(
                    ".notification-badge"
                );

                if (unreadItems.length > 0) {
                    notificationBadge.textContent = unreadItems.length;
                    notificationBadge.style.display = "inline";
                } else {
                    notificationBadge.style.display = "none";
                }
            }

            // Function to check and show empty state if needed
            function checkEmptyState() {
                const visibleItems = Array.from(announcementItems).filter(
                    (item) => item.style.display !== "none"
                );
                const announcementList = document.querySelector(".announcement-list");

                // Remove existing empty state if any
                const existingEmptyState = document.querySelector(".empty-state");
                if (existingEmptyState) {
                    existingEmptyState.remove();
                }

                if (visibleItems.length === 0) {
                    const emptyState = document.createElement("div");
                    emptyState.className = "empty-state";
                    emptyState.innerHTML = `
                    <div class="empty-state-icon">📪</div>
                    <h3>No announcements found</h3>
                    <p>There are no announcements matching your current filter.</p>
                `;
                    announcementList.appendChild(emptyState);
                }
            }

            // Initial unread count update
            updateUnreadCount();
        });
    </script>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>