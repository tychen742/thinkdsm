document.addEventListener("click", (e) => {
  const runBtn = e.target.closest("button.thebelab-run-button");
  if (!runBtn) return;

  const cell = runBtn.closest(".thebelab-cell");
  if (!cell) return;

  // show output as soon as user clicks Run
  cell.classList.add("thebe-show-output");
});
