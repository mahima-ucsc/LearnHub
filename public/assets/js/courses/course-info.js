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
  module.addEventListener("click", (e) => {
    const moduleContent = module.querySelector(".module-content");
    const chevron = module.querySelector(".module-toggle .chevron-icon");

    moduleContent.classList.toggle("active");
    module.classList.toggle("expanded");
    chevron.classList.toggle("rotated");
    e.stopPropagation();
  });
});
