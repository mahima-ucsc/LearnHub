/**
 * This script adds functionality to toggle a dropdown menu for each course card and provides
 * options like "Pin Course" when the menu is opened. The dropdown is triggered by clicking
 * the menu icon (three vertical dots) and will close when clicking outside the menu area.
 *
 * Key Features:
 * 1. Dropdown Toggle:
 *    - Clicking the menu icon (fa-ellipsis-v) shows the dropdown options for the specific course.
 *    - Clicking outside the menu closes all open dropdowns.
 * 2. Pin Course Action:
 *    - When the "Pin Course" option is selected, a function is triggered (e.g., an alert or API call).
 *
 * Example:
 * - HTML Structure:
 *   <div class="course-menu">
 *       <i class="fa fa-ellipsis-v"></i>
 *       <div class="menu-dropdown hidden">
 *           <ul>
 *               <li onclick="pinCourse(101)">Pin Course</li>
 *               <li>Other Option</li>
 *           </ul>
 *       </div>
 *   </div>
 *
 * - Usage:
 *   - Clicking the three-dot icon will display the dropdown menu for the respective course.
 *   - Selecting "Pin Course" will call the `pinCourse(courseId)` function, passing the course ID.
 *   - The dropdown automatically hides when clicking outside the menu area.
 */

// Toggle dropdown visibility
document.addEventListener("DOMContentLoaded", () => {
  const menuIcons = document.querySelectorAll(".course-menu .fa-ellipsis-v");

  menuIcons.forEach((icon) => {
    icon.addEventListener("click", (e) => {
      const dropdown = e.target.nextElementSibling;

      // Hide other open menus
      document.querySelectorAll(".menu-dropdown").forEach((menu) => {
        if (menu !== dropdown) menu.classList.remove("active");
      });

      // Toggle current menu
      dropdown.classList.toggle("active");
    });
  });

  // Close the dropdown when clicking outside
  document.addEventListener("click", (e) => {
    if (!e.target.closest(".course-menu")) {
      document.querySelectorAll(".menu-dropdown").forEach((menu) => {
        menu.classList.remove("active");
      });
    }
  });
});

// Example function for "Pin Course"
function pinCourse(courseId) {
  console.log(`Course ${courseId} pinned!`);
  alert(`Course ${courseId} pinned!`);
}
