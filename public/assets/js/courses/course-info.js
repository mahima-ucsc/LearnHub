document.querySelectorAll(".period-item").forEach((period) => {
  period.addEventListener("click", (e) => {
    const periodContent = period.querySelector(".period-content");
    const chevron = period.querySelector(".period-toggle .chevron-icon");

    periodContent.classList.toggle("active");
    period.classList.toggle("expanded");
    chevron.classList.toggle("rotated");
  });
});

document.querySelectorAll(".module-item").forEach((module) => {
  module.querySelector(".module-header").addEventListener("click", (e) => {
    const moduleContent = module.querySelector(".module-content");
    const chevron = module.querySelector(".module-toggle .chevron-icon");

    moduleContent.classList.toggle("active");
    module.classList.toggle("expanded");
    chevron.classList.toggle("rotated");
    e.stopPropagation();
  });
});

document.addEventListener("DOMContentLoaded", function () {
  // Get all attendance checkboxes
  const attendanceCheckboxes = document.querySelectorAll(
    ".module-complete-checkbox"
  );

  // Add event listeners to each checkbox
  attendanceCheckboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", function () {
      const moduleId = this.getAttribute("data-module-id");
      const courseId = this.getAttribute("data-course-id");
      const isAttended = this.checked;
      console.log(moduleId);
      console.log(courseId);
      console.log(isAttended);

      // Send attendance data to server
      fetch("/mark-attendance", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          module_id: moduleId,
          course_id: courseId,
          attended: isAttended,
        }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            console.log(data.res);

            showToast("Success", "Attendance marked successfully.", "success");
          } else {
            console.error("Failed to mark attendance");
            showToast("Error", "Failed to mark attendance.", "error");
            this.checked = !isAttended;
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          // Reset checkbox if error
          this.checked = !isAttended;
        });
    });
  });
});
