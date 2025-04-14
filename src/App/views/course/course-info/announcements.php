<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Dashboard - Announcements</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Arial", sans-serif;
        }

        body {
            background-color: #f5f7fa;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background-color: #2c3e50;
            color: white;
            padding: 15px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #3498db;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .announcements-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-top: 20px;
            overflow: hidden;
        }

        .announcements-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #eee;
        }

        .announcements-title {
            font-size: 20px;
            font-weight: bold;
            color: #2c3e50;
        }

        .filter-controls {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .filter-button {
            padding: 8px 12px;
            background-color: #f5f7fa;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
        }

        .filter-button:hover,
        .filter-button.active {
            background-color: #3498db;
            color: white;
            border-color: #3498db;
        }

        .announcement-list {
            max-height: 600px;
            overflow-y: auto;
        }

        .announcement-item {
            padding: 20px;
            border-bottom: 1px solid #eee;
            transition: background-color 0.3s;
        }

        .announcement-item:hover {
            background-color: #f9f9f9;
        }

        .announcement-item:last-child {
            border-bottom: none;
        }

        .announcement-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .announcement-source {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .source-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
            font-weight: bold;
        }

        .source-admin {
            background-color: #e74c3c;
        }

        .source-tutor {
            background-color: #2ecc71;
        }

        .source-system {
            background-color: #9b59b6;
        }

        .source-name {
            font-weight: bold;
            color: #2c3e50;
        }

        .announcement-time {
            color: #7f8c8d;
            font-size: 14px;
        }

        .announcement-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #2c3e50;
        }

        .announcement-content {
            color: #34495e;
            line-height: 1.5;
            margin-bottom: 10px;
        }

        .announcement-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .announcement-tags {
            display: flex;
            gap: 8px;
        }

        .tag {
            padding: 4px 8px;
            border-radius: 50px;
            font-size: 12px;
            background-color: #f5f7fa;
            color: #7f8c8d;
        }

        .tag.urgent {
            background-color: #ffecee;
            color: #e74c3c;
        }

        .tag.assignment {
            background-color: #e8f8f5;
            color: #2ecc71;
        }

        .tag.event {
            background-color: #eef4fc;
            color: #3498db;
        }

        .announcement-actions button {
            background: none;
            border: none;
            color: #3498db;
            cursor: pointer;
            margin-left: 15px;
            font-size: 14px;
        }

        .announcement-actions button:hover {
            text-decoration: underline;
        }

        .empty-state {
            padding: 60px 20px;
            text-align: center;
            color: #7f8c8d;
        }

        .empty-state-icon {
            font-size: 40px;
            margin-bottom: 10px;
            color: #bdc3c7;
        }

        .unread-indicator {
            width: 8px;
            height: 8px;
            background-color: #3498db;
            border-radius: 50%;
            margin-right: 6px;
        }

        .read {
            opacity: 0.7;
        }

        .notification-badge {
            background-color: #e74c3c;
            color: white;
            border-radius: 50px;
            padding: 2px 8px;
            font-size: 12px;
            margin-left: 5px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 10px;
            }

            .announcements-header {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }

            .filter-controls {
                width: 100%;
                overflow-x: auto;
                padding-bottom: 5px;
            }
        }
    </style>
</head>

<!-- array(10) {
    ["id"]=>    int(11)
    ["title"]=>    string(4) "anno"
    ["content"]=>    string(4) "disc"
    ["priority"]=>    string(3) "low"
    ["visibility"]=>    string(3) "all"
    ["specific_emails"]=>    NULL
    ["attachments"]=>    string(59) "["67f9f1d8d0b9a_SCS 2204.pdf","67f9f1d8d0ced_SCS 2203.pdf"]"
    ["send_email"]=>    int(0)
    ["created_at"]=>    string(19) "2025-04-12 10:23:44"
    ["updated_at"]=>    string(19) "2025-04-12 10:23:44"
    ["tutor_name"]=>    string(12) "tutor-name"
    ["course_id"]=>    string(10) "course-id"
  } -->

<body>
    <div class="container">
        <div class="announcements-container">
            <div class="announcements-header">
                <div class="announcements-title">
                    Announcements <span class="notification-badge">3</span>
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
                <div class="announcement-item" data-type="assignment" data-read="false">
                    <div class="announcement-header">
                        <div class="announcement-source">
                            <div class="unread-indicator"></div>
                            <div class="source-icon source-tutor">T</div>
                            <div class="source-name"><?php echo htmlspecialchars($announcement['tutor_name']); ?></div>
                        </div>
                        <div class="announcement-time">Today, 10:35 AM</div>
                    </div>
                    <div class="announcement-title">
                        Final Project Submission Guidelines
                    </div>
                    <div class="announcement-content">
                        Dear students, the final project submission deadline is
                        approaching. Please ensure you follow the guidelines listed in the
                        course materials section. Remember to include all required
                        components and submit before Friday, 11:59 PM.
                    </div>
                    <div class="announcement-footer">
                        <div class="announcement-tags">
                            <span class="tag assignment">Assignment</span>
                            <span class="tag urgent">Urgent</span>
                        </div>
                        <div class="announcement-actions">
                            <button class="mark-read-btn">Mark as read</button>
                        </div>
                    </div>
                </div>

                <div class="announcement-item" data-type="event" data-read="false">
                    <div class="announcement-header">
                        <div class="announcement-source">
                            <div class="unread-indicator"></div>
                            <div class="source-icon source-admin">A</div>
                            <div class="source-name">Admin</div>
                        </div>
                        <div class="announcement-time">Yesterday, 3:15 PM</div>
                    </div>
                    <div class="announcement-title">
                        Virtual Guest Lecture - Industry Expert
                    </div>
                    <div class="announcement-content">
                        We're excited to announce a virtual guest lecture by industry
                        expert David Chen next Wednesday at 2:00 PM. The session will
                        cover emerging trends in the field and career opportunities.
                        Attendance is optional but highly recommended.
                    </div>
                    <div class="announcement-footer">
                        <div class="announcement-tags">
                            <span class="tag event">Event</span>
                        </div>
                        <div class="announcement-actions">
                            <button class="mark-read-btn">Mark as read</button>
                        </div>
                    </div>
                </div>

                <div class="announcement-item" data-type="update" data-read="false">
                    <div class="announcement-header">
                        <div class="announcement-source">
                            <div class="unread-indicator"></div>
                            <div class="source-icon source-system">S</div>
                            <div class="source-name">System</div>
                        </div>
                        <div class="announcement-time">Apr 12, 9:00 AM</div>
                    </div>
                    <div class="announcement-title">Platform Maintenance Notice</div>
                    <div class="announcement-content">
                        The learning platform will undergo scheduled maintenance this
                        weekend from Saturday 10:00 PM to Sunday 2:00 AM. During this
                        time, the system may be temporarily unavailable. We apologize for
                        any inconvenience.
                    </div>
                    <div class="announcement-footer">
                        <div class="announcement-tags">
                            <span class="tag">System Update</span>
                        </div>
                        <div class="announcement-actions">
                            <button class="mark-read-btn">Mark as read</button>
                        </div>
                    </div>
                </div>

                <div class="announcement-item read" data-type="assignment" data-read="true">
                    <div class="announcement-header">
                        <div class="announcement-source">
                            <div class="source-icon source-tutor">T</div>
                            <div class="source-name">Prof. Michael Brown</div>
                        </div>
                        <div class="announcement-time">Apr 10, 11:20 AM</div>
                    </div>
                    <div class="announcement-title">Quiz 3 Grades Released</div>
                    <div class="announcement-content">
                        Quiz 3 grades have been posted. The class average was 82%. If you
                        scored below 70%, please consider attending the review session on
                        Thursday at 4:00 PM. You can access your detailed feedback in the
                        Grades section.
                    </div>
                    <div class="announcement-footer">
                        <div class="announcement-tags">
                            <span class="tag assignment">Assignment</span>
                        </div>
                        <div class="announcement-actions">
                            <button class="mark-unread-btn">Mark as unread</button>
                        </div>
                    </div>
                </div>

                <div class="announcement-item read" data-type="event" data-read="true">
                    <div class="announcement-header">
                        <div class="announcement-source">
                            <div class="source-icon source-admin">A</div>
                            <div class="source-name">Admin</div>
                        </div>
                        <div class="announcement-time">Apr 5, 2:30 PM</div>
                    </div>
                    <div class="announcement-title">
                        Student Support Services Hours Update
                    </div>
                    <div class="announcement-content">
                        Starting next week, Student Support Services will have extended
                        hours on Tuesdays and Thursdays until 7:00 PM. This change is
                        being implemented to better accommodate students with evening
                        classes or work commitments.
                    </div>
                    <div class="announcement-footer">
                        <div class="announcement-tags">
                            <span class="tag">General</span>
                        </div>
                        <div class="announcement-actions">
                            <button class="mark-unread-btn">Mark as unread</button>
                        </div>
                    </div>
                </div>
            </div>
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
</body>