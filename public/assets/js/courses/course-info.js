document.querySelectorAll(".period-item").forEach((period) => {
  period.addEventListener("click", (e) => {
    const periodContent = period.querySelector(".period-content");
    const chevron = period.querySelector(".chevron-icon");

    periodContent.classList.toggle("active");
    period.classList.toggle("expanded");
    chevron.classList.toggle("rotated");
  });
});
