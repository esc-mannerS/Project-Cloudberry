async function loadIncludes(callback) {
  const includeElements = document.querySelectorAll("[include-html]");

  // convert NodeList to array of promises
  const tasks = Array.from(includeElements).map(async (el) => {
    const file = el.getAttribute("include-html");
    try {
      const response = await fetch(file);
      el.innerHTML = await response.text();
    } catch (e) {
      el.innerHTML = "Failed to load " + file;
    }
  });

  // wait for ALL fetch() calls to complete
  await Promise.all(tasks);

  // now ALL includes are finished
  if (typeof callback === "function") callback();
}

// Load includes and THEN run initMenu()
loadIncludes(() => {
  initMenu();
});
