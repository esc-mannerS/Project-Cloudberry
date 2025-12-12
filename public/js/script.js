// menu toggle + icon swap
document.addEventListener("DOMContentLoaded", function () {
  const btn = document.getElementById("menuToggle");
  const menu = document.getElementById("slideMenu");
  const icon = document.getElementById("menuIcon");

  if (!btn || !menu) return;

  function setIcon(open) {
    if (!icon || !icon.dataset) return;
    icon.src = open
      ? icon.dataset.openSrc || icon.src
      : icon.dataset.closedSrc || icon.src;
  }

  btn.addEventListener("click", function (ev) {
    ev.preventDefault();
    const isOpen = menu.classList.toggle("open");
    btn.setAttribute("aria-expanded", isOpen ? "true" : "false");
    setIcon(isOpen);
  });

  // close menu when clicking outside
  document.addEventListener("click", function (ev) {
    if (!menu.classList.contains("open")) return;
    const target = ev.target;
    if (!btn.contains(target) && !menu.contains(target)) {
      menu.classList.remove("open");
      btn.setAttribute("aria-expanded", "false");
      setIcon(false);
    }
  });

  // close menu with Escape
  document.addEventListener("keydown", function (ev) {
    if (ev.key === "Escape" && menu.classList.contains("open")) {
      menu.classList.remove("open");
      btn.setAttribute("aria-expanded", "false");
      setIcon(false);
      btn.focus();
    }
  });
});

// FQA panel open and close panel
document.querySelectorAll(".panel-group").forEach((group) => {
  group.addEventListener("click", () => {
    const body = group.querySelector(".panel-body");
    body.classList.toggle("open");
  });
});

// my profil sections open and close panel
document.querySelectorAll(".profile-head").forEach((head) => {
  head.addEventListener("click", () => {
    const body = head.nextElementSibling;
    if (body && body.classList.contains("profile-body")) {
      body.classList.toggle("open");
    }
  });
});

// login page
function showForm(formId) {
  document
    .querySelectorAll(".login-container")
    .forEach((form) => form.classList.remove("active"));
  document.getElementById(formId).classList.add("active");
}

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll("[data-toggle-form]").forEach((link) => {
    link.addEventListener("click", (ev) => {
      ev.preventDefault();
      const formId = link.dataset.toggleForm;
      showForm(formId);
    });
  });
});

// custom dropdown
document.addEventListener("DOMContentLoaded", function () {
  /**
   * initialize a custom dropdown
   * @param {string} selectId - the ID of the custom select container
   * @param {string} hiddenInputId - the ID of the hidden input to store the value
   */
  function initCustomDropdown(selectId, hiddenInputId) {
    const customSelect = document.getElementById(selectId);
    if (!customSelect) return; // safety check

    const selected = customSelect.querySelector(".selected");
    const optionsContainer = customSelect.querySelector(".options");
    const hiddenInput = document.getElementById(hiddenInputId);

    // toggle dropdown visibility
    selected.addEventListener("click", function (e) {
      e.stopPropagation();
      optionsContainer.style.display =
        optionsContainer.style.display === "block" ? "none" : "block";
    });

    // set value when an option is clicked
    optionsContainer.querySelectorAll(".option").forEach((option) => {
      option.addEventListener("click", function () {
        selected.textContent = this.textContent;
        hiddenInput.value = this.dataset.value;
        optionsContainer.style.display = "none";
      });
    });

    // close dropdown if clicked outside
    document.addEventListener("click", function () {
      optionsContainer.style.display = "none";
    });
  }

  // initialize dropdowns
  initCustomDropdown("custom-municipality", "municipality_id");
  initCustomDropdown("custom-category", "category_id");
});
