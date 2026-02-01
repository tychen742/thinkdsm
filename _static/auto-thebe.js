document.addEventListener("DOMContentLoaded", () => {
  // Only auto-init if there are any cells eligible for Thebe
  const hasThebeCells =
    document.querySelector(".thebe,.cell,div.tag_thebe-interactive") !== null;

  if (!hasThebeCells) return;

  // Sphinx-thebe expects a launch/status element to exist.
  // If it's not present, calling initThebe() will crash.
  const launchEl = document.querySelector(
    ".thebe-launch-button, button.thebe-launch-button, .thebe-status, #thebe-status"
  );

  if (!launchEl) return;

  if (typeof initThebe === "function") initThebe();
});
