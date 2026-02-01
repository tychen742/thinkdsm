// _static/auto-thebe.js
document.addEventListener("DOMContentLoaded", () => {
  // Only auto-init if the page has at least one tagged cell.
  if (document.querySelector(".tag_thebe-interactive")) {
    // initThebe() is provided by sphinx-thebe when enabled by Jupyter Book
    if (typeof initThebe === "function") {
      initThebe();
    }
  }
});
