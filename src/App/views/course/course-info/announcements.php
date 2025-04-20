<?php include $this->resolve("partials/_header.php"); ?>
<?php include $this->resolve("course/sidebar/sidebar.php"); ?>

<link rel="stylesheet" href="/assets/styles/Course/announcement.css">

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
                    <button class="filter-button" data-filter="general">general</button>
                    <button class="filter-button" data-filter="read">Read</button>
                    <button class="filter-button" data-filter="unread">Unread</button>
                </div>
            </div>

            <div class="announcement-list">
                <?php
                // dd($announcements);
                foreach ($announcements as $announcement) { ?>
                    <div class="announcement-item" id="<?php echo ("announcement-" . $announcement['announcement_id']); ?>" data-type="<?php echo htmlspecialchars($announcement["category"]) ?>" data-read="<?php echo ($announcement['is_read'] == 1 ? 'true' : 'false'); ?>">
                        <div class="announcement-header">
                            <div class="announcement-source">
                                <?php echo $announcement['is_read'] == 0 ? ("<div class='unread-indicator'></div>") : ''; ?>
                                <div class="source-icon source-tutor">
                                    <?php echo strtoupper(substr($announcement['tutor_name'], 0, 1)); ?>
                                </div>
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
                                <button
                                    class="read_btn"
                                    announcement_id="<?php echo ($announcement['announcement_id']); ?>"
                                    is_read="<?php echo $announcement['is_read'] == 1 ? "true" : "false" ?>">
                                    <?php echo  $announcement['is_read'] == 1 ? "Mark as unread" : "Mark as read" ?>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div id="result"></div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Filter functionality
            const filterButtons = document.querySelectorAll(".filter-button");
            const announcementItems = document.querySelectorAll(".announcement-item");
            checkEmptyState();

            // Add event listeners to filter buttons
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
                            item.style.display = item.getAttribute("data-read") === "false" ? "block" : "none";
                        } else if (filter === "read") {
                            item.style.display = item.getAttribute("data-read") === "true" ? "block" : "none";
                        } else {
                            item.style.display = item.getAttribute("data-type") === filter ? "block" : "none";
                        }
                    });

                    // Check if there are any visible announcements
                    checkEmptyState();
                });
            });

            document.querySelectorAll('.read_btn').forEach(button => {
                button.addEventListener('click', function() {
                    const btn = this;
                    const announcement_id = btn.getAttribute('announcement_id');
                    const is_read = btn.getAttribute('is_read') === 'true';

                    // update button appearence
                    btn.textContent = is_read ? "Mark As Unread" : "Mark As Read";
                    btn.setAttribute('is_read', !is_read);

                    // send AJAX request
                    fetch('/announcements/mark_as', {
                            method: 'POST',
                            headers: {
                                'content-Type': "application/x-www-form-urlencoded"
                            },
                            body: `announcement_id=${announcement_id}&is_read=${!is_read}`
                        })
                        .then(response => response.text())
                        .then(data => {
                            console.log(data);
                            document.getElementById('result').innerHTML = data;
                        })
                })
                updateUnreadCount();
            })

            // Mark as read/unread functionality
            let markReadButtons = document.querySelectorAll(".mark-read-btn");
            let markUnreadButtons = document.querySelectorAll(".mark-unread-btn");

            // Add event listeners to mark-as-read buttons in the items that are unread states
            markReadButtons.forEach((button) => {
                button.addEventListener("click", function() {
                    const buttonValue = this.className;
                    const announcementItem = this.closest(".announcement-item");
                    const unreadIndicator = announcementItem.querySelector(".unread-indicator");

                    // Send POST request to mark announcement as read
                    fetch('/announcements/mark-as-read', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                announcement_id: announcementItem.getAttribute('id').split('-')[1]
                            }),
                        })
                        .then((response) => {
                            if (!response.ok) {
                                throw new Error('Failed to mark as read');
                                alert('Failed to mark as read');
                            }
                            return response.json();
                        })
                        .then((data) => {
                            console.log('Announcement marked as read:', data);
                            // Change item's state to read
                            announcementItem.classList.add("read");
                            announcementItem.setAttribute("data-read", "true");

                            // Update unread count
                            updateUnreadCount();

                            this.textContent = 'Mark as unread';
                            this.className = 'mark-unread-btn';

                            // Remove unread indicator
                            if (unreadIndicator) {
                                unreadIndicator.remove();
                            }

                            // If we're in read filter, this item should disappear
                            if (document.querySelector('.filter-button[data-filter="unread"].active')) {
                                announcementItem.style.display = "none";
                                checkEmptyState();
                                console.log("unread .active to none")
                            }
                        })
                        .catch((error) => {
                            console.error('Error:', error);
                        });


                });
            });

            // Add event listeners to mark-as-unread buttons in the items that are read states
            markUnreadButtons.forEach((button) => {
                button.addEventListener("click", function() {
                    let buttonValue = this.className;
                    let announcementItem = this.closest(".announcement-item");
                    let unreadIndicator = document.createElement("div");
                    let sourceDiv = announcementItem.querySelector(".announcement-source");

                    // Send POST request to mark announcement as unread
                    fetch('/announcements/mark-as-unread', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                announcement_id: announcementItem.getAttribute('id').split('-')[1]
                            }),
                        })
                        .then((response) => {
                            if (!response.ok) {
                                throw new Error('Failed to mark as read');
                            }
                            return response.json();
                        })
                        .then((data) => {
                            console.log('Announcement marked as read:', data);
                            // Change item's state to read
                            announcementItem.classList.remove("read");
                            announcementItem.setAttribute("data-read", "false");

                            // Change button text
                            this.textContent = "Mark as read";
                            this.className = "mark-read-btn";

                            // Add unread indicator if not already present
                            if (!announcementItem.querySelector(".unread-indicator")) {
                                unreadIndicator.className = "unread-indicator";
                                sourceDiv.prepend(unreadIndicator);
                            }

                            // If we're in read filter, this item should disappear
                            if (document.querySelector('.filter-button[data-filter="read"].active')) {
                                announcementItem.style.display = "none";
                                console.log("unread .active to none");
                            }
                            // Update unread count
                            updateUnreadCount();
                            checkEmptyState();
                        })
                        .catch((error) => {
                            console.error('Error:', error);
                        });


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

                if (e.target && e.target.classList.contains("mark-read-btn")) {
                    const announcementItem = e.target.closest(".announcement-item");
                    announcementItem.classList.add("read");
                    announcementItem.setAttribute("data-read", "true");

                    // Remove unread indicator
                    const unreadIndicator = announcementItem.querySelector(".unread-indicator");
                    if (unreadIndicator) {
                        unreadIndicator.remove();
                    }

                    // Change button text
                    e.target.textContent = "Mark as unread";
                    e.target.className = "mark-unread-btn";

                    // Update unread count
                    updateUnreadCount();
                }
            });

            // Function to update unread count badge
            function updateUnreadCount() {
                const unreadItems = document.querySelectorAll('.announcement-item[data-read="false"]');
                const notificationBadge = document.querySelector(".notification-badge");

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