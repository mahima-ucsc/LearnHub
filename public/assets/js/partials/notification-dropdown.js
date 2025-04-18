const notificationIcon = document.querySelector(".notification-icon-container");
const notificationsDropdown = document.querySelector(".notifications-dropdown");
const markAllReadBtn = document.querySelector(".mark-all-read");
const refreshBtn = document.querySelector(".refresh-notifications");
const notificationsListContainer = document.querySelector(
  ".notifications-list"
);

let notifications = [];

// Function to fetch notifications
function fetchNotifications() {
  // Add rotating class to show loading state
  refreshBtn.classList.add("rotating");

  fetch("/api/notifications")
    .then((response) => {
      if (!response.ok) {
        throw new Error("Notifications Network response was not ok");
      }
      return response.json();
    })
    .then((data) => {
      notifications = data;
      renderNotifications();
    })
    .catch((error) => {
      console.error("Error fetching notifications:", error);
      notifications = []; // Reset to empty if fetch fails
      renderNotifications();
    })
    .finally(() => {
      // Remove rotating class when done
      setTimeout(() => {
        refreshBtn.classList.remove("rotating");
      }, 500);
    });
}

// Initial fetch
fetchNotifications();

// Optionally, refresh notifications periodically
// setInterval(fetchNotifications, 60000); // Refresh every minute

// Function to mark notification as read
function markAsRead(notificationId, event) {
  event.preventDefault();
  event.stopPropagation();

  fetch(`/api/notifications/mark-as-read/${notificationId}`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-Requested-With": "XMLHttpRequest",
    },
  })
    .then((response) => {
      if (!response.ok) {
        console.error("Failed to mark notification as read");
      }
      return response.json();
    })
    .then((data) => {
      // Find and update the notification in our array
      const notificationIndex = notifications.findIndex(
        (n) => n.notification_id === notificationId
      );
      if (notificationIndex !== -1) {
        notifications[notificationIndex].is_read = true;
        window.location.href = notifications[notificationIndex].url;
        renderNotifications();
      }
    })
    .catch((error) => {
      console.error("Error marking notification as read:", error);
    });
}

// Function to render notifications
function renderNotifications() {
  notificationsListContainer.innerHTML = "";
  let unreadCount = 0;

  if (notifications.length === 0) {
    notificationsListContainer.innerHTML =
      '<div class="no-notifications">No notifications</div>';
  } else {
    notifications.forEach((notification) => {
      if (!notification.is_read) unreadCount++;

      const notificationItem = document.createElement("a");
      notificationItem.href = notification.url;
      notificationItem.className = `notification-item ${
        notification.is_read ? "read" : "unread"
      }`;
      notificationItem.dataset.id = notification.id;

      notificationItem.innerHTML = `
    <div class="notification-content">
        <p>${notification.message}</p>
        <span class="notification-time">${notification.updated_at}</span>
    </div>
    ${!notification.is_read ? '<div class="notification-badge"></div>' : ""}
    `;

      // Add click handler for each notification
      notificationItem.addEventListener("click", function (e) {
        if (!notification.is_read) {
          markAsRead(notification.notification_id, e);
        }
      });

      notificationsListContainer.appendChild(notificationItem);
    });
  }

  document.querySelector(".notification-count").textContent = unreadCount;
}

// Initial render
renderNotifications();

// Refresh button click handler
refreshBtn.addEventListener("click", function (e) {
  e.preventDefault();
  e.stopPropagation();
  fetchNotifications();
});

notificationIcon.addEventListener("click", function (e) {
  e.stopPropagation();
  notificationsDropdown.style.display =
    notificationsDropdown.style.display === "block" ? "none" : "block";
});

markAllReadBtn.addEventListener("click", function (e) {
  e.preventDefault();
  e.stopPropagation();
  fetch("/api/notifications/mark-all-as-read", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-Requested-With": "XMLHttpRequest",
    },
  })
    .then((response) => {
      if (!response.ok) {
        console.error("Failed to mark notifications as read");
      }
      return response.json();
    })
    .then(() => {
      // Update all notifications as read
      notifications.forEach((notification) => {
        notification.is_read = true;
      });
      renderNotifications();
    })
    .catch((error) => {
      console.error("Error marking notifications as read:", error);
    });
});

// Close dropdown when clicking elsewhere
document.addEventListener("click", function (e) {
  if (
    !notificationsDropdown.contains(e.target) &&
    !notificationIcon.contains(e.target)
  ) {
    notificationsDropdown.style.display = "none";
  }
});
