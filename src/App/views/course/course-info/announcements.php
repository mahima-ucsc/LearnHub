<?php include $this->resolve("partials/_header.php"); ?>
<?php include $this->resolve("course/sidebar/sidebar.php"); ?>

<link rel="stylesheet" href="/assets/styles/Course/announcement.css">

<style>
    /* Attachment List Styling */
    .attachments-list {
        margin-top: 15px;
        margin-bottom: 15px;
    }

    .attachments-list ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        background-color: #f9f9f9;
    }

    .attachments-list li {
        padding: 10px 15px;
        border-bottom: 1px solid #e0e0e0;
        display: flex;
        align-items: center;
    }

    .attachments-list li:last-child {
        border-bottom: none;
    }

    .attachments-list li a {
        color: #2563eb;
        text-decoration: none;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        transition: color 0.2s ease;
    }

    .attachments-list li a:hover {
        color: #1e40af;
        text-decoration: underline;
    }

    .attachments-list li a:before {
        content: "";
        display: inline-block;
        width: 16px;
        height: 16px;
        margin-right: 8px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%232563eb'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13'%3E%3C/path%3E%3C/svg%3E");
        background-size: contain;
        background-repeat: no-repeat;
    }

    /* Empty state styling */
    .attachments-list:empty {
        display: none;
    }

    /* Responsive adjustments */
    @media (max-width: 640px) {
        .attachments-list li {
            padding: 12px 10px;
        }

        .attachments-list li a {
            font-size: 13px;
        }
    }
</style>

<section>
    <div class="container">
        <div class="title-header">
            <a href="/courses/<?php echo $course_id; ?>"><?php echo $course_title; ?></a> <a href="/courses/<?php echo $course_id; ?>/announcements">/ Announcements</a>
            <div class="filter-title" id='filter-title'></div>
        </div>
        <div class="announcements-container">
            <div class="announcements-header">
                <div class="announcements-title">
                    Announcements <span class="notification-badge"></span>
                </div>
                <div class="filter-controls">
                    <div class="filter-dropdown" id="dropdown">
                        <button class="dropdown-toggle">Filter</button>
                        <div class="dropdown-menu">
                            <button class="filter-button active" data-filter="all">All</button>
                            <button class="filter-button" data-filter="assignment">Assignment</button>
                            <button class="filter-button" data-filter="general">General</button>
                            <button class="filter-button" data-filter="remainder">Remainder</button>
                            <button class="filter-button" data-filter="event">Event</button>
                        </div>
                    </div>
                    <button class="filter-button" data-filter="read">Read</button>
                    <button class="filter-button" data-filter="unread">Unread</button>
                </div>
            </div>

            <div class="announcement-list">
                <?php
                // dd($announcements);
                foreach ($announcements as $announcement) { ?>
                    <div
                        class="announcement-item <?php echo $announcement['is_read'] == 1 ? 'read' : ''; ?>"
                        id="<?php echo ("announcement-" . $announcement['announcement_id']); ?>"
                        category="<?php echo htmlspecialchars($announcement["category"]) ?>"
                        data-read="<?php echo ($announcement['is_read'] == 1 ? 'true' : 'false'); ?>">
                        <div class="announcement-header">
                            <div class="announcement-source">
                                <div class='unread-indicator' style="display: <?php echo $announcement['is_read'] == 1 ? 'none' : 'block'; ?>"></div>
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
                        <div class="attachments-list" style="display: <?php echo (isset($announcement['attachments'])) ? 'block' : 'none'; ?>">
                            <?php
                            echo "<ul>";

                            if (isset($announcement['attachments'])) {
                                $files = json_decode($announcement['attachments']);
                                foreach ($files as $file) {
                                    // Remove prefix before underscore using regex
                                    $display_name = preg_replace('/^[^_]+_/', '', $file);
                                    echo "<li><a href='#' onclick='downloadAttachment(\"" . htmlspecialchars($file) . "\")'>" . htmlspecialchars($display_name) . "</a></li>";
                                }
                            }

                            echo "</ul>";
                            ?>
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
                                    <?php echo  $announcement['is_read'] == 1 ? "Mark As Unread" : "Mark As Read" ?>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Filter functionality
            const announcementItems = document.querySelectorAll(".announcement-item");
            const filterButtons = document.querySelectorAll(".filter-button");
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
                    applyCurrentFilter();
                    addfilterTitle();
                });
            });

            // add filter type in to the tytle
            function addfilterTitle() {
                const activeFilter = document.querySelector('.filter-button.active').getAttribute('data-filter');
                const filterTitle = document.getElementById('filter-title');

                let titleText = '';
                switch (activeFilter) {
                    case 'all':
                        titleText = '/ All';
                        break;
                    case 'unread':
                        titleText = '/ Unread';
                        break;
                    case 'read':
                        titleText = '/ Read';
                        break;
                    case 'assignment':
                        titleText = '/ Assignment';
                        break;
                    case 'general':
                        titleText = '/ General';
                        break;
                    case 'remainder':
                        titleText = '/ Remainder ';
                        break;
                    case 'event':
                        titleText = '/ Event';
                        break;
                    default:
                        titleText = '';
                }

                filterTitle.textContent = titleText;
            }


            // apply current filter
            function applyCurrentFilter() {
                const activeFilter = document.querySelector('.filter-button.active').getAttribute('data-filter');
                announcementItems.forEach((item) => {
                    const category = item.getAttribute("category");
                    const itemRead = item.getAttribute("data-read");

                    if (activeFilter === "all") {
                        item.style.display = "block";
                    } else if (activeFilter === "unread") {
                        item.style.display = itemRead === "false" ? "block" : "none";
                    } else if (activeFilter === "read") {
                        item.style.display = itemRead === "true" ? "block" : "none";
                    } else {
                        item.style.display = category === activeFilter ? "block" : "none";
                    }
                });
                checkEmptyState();
            }


            // |Add event listnets to togle isread btn
            document.querySelectorAll('.read_btn').forEach(button => {

                button.addEventListener('click', function() {
                    const btn = this;
                    const announcement_id = btn.getAttribute('announcement_id');
                    const is_read = btn.getAttribute('is_read') === 'true';
                    const announcementItem = btn.closest(".announcement-item");
                    const unreadIndicator = announcementItem.querySelector(".unread-indicator");
                    let sourceDiv = announcementItem.querySelector(".announcement-source");


                    // update button appearence
                    btn.textContent = !is_read ? "Mark As Unread" : "Mark As Read";
                    btn.setAttribute('is_read', !is_read);
                    announcementItem.setAttribute("data-read", (!is_read).toString());


                    // update styles
                    if (!is_read) {
                        unreadIndicator.style.display = "none";
                        announcementItem.classList.add("read");

                    } else {
                        announcementItem.classList.remove("read");
                        unreadIndicator.style.display = "block";

                    }

                    applyCurrentFilter();
                    // send AJAX request
                    fetch('/announcements/mark_as', {
                            method: 'POST',
                            headers: {
                                'Content-Type': "application/x-www-form-urlencoded"
                            },
                            body: `announcement_id=${announcement_id}&is_read=${!is_read}`
                        })
                        .then(response => response.text())
                        .then(data => {
                            updateUnreadCount();
                            document.getElementById('result').innerHTML = data;
                        })
                })
            })


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

            // Initial update
            updateUnreadCount();
            addfilterTitle();
        });
    </script>

    <script>
        let dropdown = document.getElementById("dropdown");
        let menu = dropdown.querySelector(".dropdown-menu");

        let timer;

        dropdown.addEventListener("mouseenter", () => {
            timer = setTimeout(() => {
                menu.style.display = "flex";
                setTimeout(() => {
                    menu.style.opacity = "1";
                    menu.style.pointerEvents = "auto";
                }, 10);
            }, 200); // 0.5 second delay
        });

        dropdown.addEventListener("mouseleave", () => {
            clearTimeout(timer);
            menu.style.opacity = "0";
            menu.style.pointerEvents = "none";
            setTimeout(() => {
                menu.style.display = "none";
            }, 200); // matches the CSS transition time
        });
    </script>

    <script>
        function downloadAttachment(fileName) {
            const formData = new FormData();
            formData.append("file_name", fileName);

            fetch("/courses/1/announcements/attachments", {
                    method: "POST",
                    body: formData
                })
                .then(response => {
                    if (!response.ok) throw new Error("Download failed");
                    return response.blob();
                })
                .then(blob => {
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement("a");
                    a.href = url;
                    a.download = fileName;
                    document.body.appendChild(a);
                    a.click();
                    a.remove();
                    URL.revokeObjectURL(url);
                })
                .catch(error => {
                    alert("Error downloading file: " + error.message);
                });
        }
    </script>

</section>

<?php include $this->resolve("partials/_footer.php"); ?>