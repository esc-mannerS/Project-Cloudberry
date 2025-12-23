document.addEventListener("DOMContentLoaded", function () {
  initMenu();
  initCustomDropdowns();
  initFQA();
  initLoginForms();
  initProfilePanels();
  initNewListingFields();
  initPriceCorrection();
  initFetchBookByIsbn();
});

// global functions start
// menu toggle + icon swap
function initMenu() {
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

  btn.addEventListener("click", (ev) => {
    ev.preventDefault();
    const isOpen = menu.classList.toggle("open");
    btn.setAttribute("aria-expanded", isOpen ? "true" : "false");
    setIcon(isOpen);
  });

  // close menu when clicking outside
  document.addEventListener("click", (ev) => {
    if (!menu.classList.contains("open")) return;
    const target = ev.target;
    if (!btn.contains(target) && !menu.contains(target)) {
      menu.classList.remove("open");
      btn.setAttribute("aria-expanded", "false");
      setIcon(false);
    }
  });

  // close menu with Escape
  document.addEventListener("keydown", (ev) => {
    if (ev.key === "Escape" && menu.classList.contains("open")) {
      menu.classList.remove("open");
      btn.setAttribute("aria-expanded", "false");
      setIcon(false);
      btn.focus();
    }
  });
}

// custom dropdown
function initCustomDropdowns() {
  const dropdowns = [
    { selectId: "custom-municipality", hiddenId: "municipality_id" },
    { selectId: "custom-category", hiddenId: "category_id" },
  ];

  dropdowns.forEach(({ selectId, hiddenId }) => {
    const customSelect = document.getElementById(selectId);
    const hiddenInput = document.getElementById(hiddenId);
    if (!customSelect || !hiddenInput) return;

    const selected = customSelect.querySelector(".selected");
    const optionsContainer = customSelect.querySelector(".options");
    if (!selected || !optionsContainer) return;

    // toggle dropdown visibility
    selected.addEventListener("click", (e) => {
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
        // my profile, new listing fields trigger
        if (selectId === "custom-category") {
          showNewListingFields();
        }
      });
    });

    // close dropdown if clicked outside
    document.addEventListener("click", function () {
      optionsContainer.style.display = "none";
    });
  });
}

// confirm deletion
let pendingForm = null;

document.addEventListener("submit", (e) => {
  if (!e.target.classList.contains("confirm-delete")) return;

  e.preventDefault(); // stop normal submit
  pendingForm = e.target;

  openModal();
});

function openModal() {
  document.getElementById("confirmModal").classList.remove("hidden");
}

function closeModal() {
  document.getElementById("confirmModal").classList.add("hidden");
  pendingForm = null;
}

document.getElementById("confirmCancel").addEventListener("click", closeModal);

document.getElementById("confirmOk").addEventListener("click", () => {
  if (!pendingForm) return;

  pendingForm.submit(); // submit after confirmation
  closeModal();
});
// global functions end

// fqa  start
// fqa panel open and close panel
function initFQA() {
  const panels = document.querySelectorAll(".panel-group");
  if (!panels.length) return;
  panels.forEach((group) => {
    group.addEventListener("click", () => {
      const body = group.querySelector(".panel-body");
      if (body) body.classList.toggle("open");
    });
  });
}
// fqa end

// login register start
// show login or register page
function initLoginForms() {
  const links = document.querySelectorAll("[data-toggle-form]");
  if (!links.length) return;

  function showForm(formId) {
    document
      .querySelectorAll(".login-container")
      .forEach((form) => form.classList.remove("active"));
    const target = document.getElementById(formId);
    if (target) target.classList.add("active");
  }

  links.forEach((link) => {
    link.addEventListener("click", (ev) => {
      ev.preventDefault();
      showForm(link.dataset.toggleForm);
    });
  });
}
// login register end

// my profile start
// my profile sections open and close panel
function initProfilePanels() {
  const heads = document.querySelectorAll(".profile-head");
  function openSection(target, updateURL = false) {
    if (!target || !target.classList.contains("profile-body")) return;

    // close all other open sections
    document.querySelectorAll(".profile-body.open").forEach((body) => {
      if (body !== target) body.classList.remove("open");
    });

    // open the target section
    target.classList.add("open");
    target.scrollIntoView({ behavior: "smooth" });

    // update URL hash if requested
    if (updateURL) {
      history.replaceState(null, "", "#" + target.id);
    }
  }

  // click on profile-head opens the section manually
  heads.forEach((head) => {
    head.addEventListener("click", () => {
      const body = head.nextElementSibling;
      openSection(body, false); // false = don’t update URL
    });
  });

  // open section on page load
  if (window.location.hash) {
    const target = document.getElementById(window.location.hash.substring(1));
    openSection(target, false);
  }

  // listen for hash changes
  window.addEventListener("hashchange", () => {
    const target = document.getElementById(window.location.hash.substring(1));
    openSection(target, false);
  });
}

document.addEventListener("DOMContentLoaded", initProfilePanels);

// show fields when category is set
function initNewListingFields() {
  const fieldsContainer = document.querySelector(".fields-after-category");
  if (!fieldsContainer) return;
  fieldsContainer.style.display = "none"; // hide by default
}

function showNewListingFields() {
  document.querySelectorAll(".fields-after-category").forEach((el) => {
    el.style.display = "block";
  });
}

// fetch book data
document.getElementById("isbn").addEventListener("blur", function () {
  const isbn = this.value.trim();

  if (!isbn) return;

  fetch("/sagaswap/public/actions/my-profile/fetch-book.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ isbn: isbn }),
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.success) {
        document.getElementById("title").value = data.title;
        document.getElementById("author").value = data.author;
        document.getElementById("book_id").value = data.book_id;
      } else {
        alert("Book not found or invalid ISBN");
      }
    })
    .catch((err) => console.error(err));
});

// new listing price correction
function initPriceCorrection() {
  const priceInput = document.getElementById("price");
  if (!priceInput) return;

  priceInput.addEventListener("blur", () => {
    let value = priceInput.value.trim();
    if (!value) return;

    // Remove all non-numeric and comma characters
    value = value.replace(/[^\d,]/g, "");

    // Split decimals by comma
    let [whole, decimal] = value.split(",");
    whole = whole.replace(/\./g, ""); // remove thousand separators

    // Add thousand separators
    whole = whole.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

    // Fix decimals
    if (!decimal) decimal = "00";
    else if (decimal.length === 1) decimal += "0";
    else if (decimal.length > 2) decimal = decimal.substring(0, 2);

    priceInput.value = `${whole},${decimal}`;
  });
}

// image previewer
const customBox = document.getElementById("customUploadBox");
const input = document.getElementById("imageInput");
const realInput = document.getElementById("realImages");
const preview = document.getElementById("imagePreview");

const dt = new DataTransfer();

// open file picker
customBox.addEventListener("click", () => {
  input.click();
});

// handle file selection
function handleFiles(files) {
  for (const file of files) {
    if (!file.type.startsWith("image/")) continue;

    if (dt.files.length >= 2) {
      alert("Du kan kun uploade 2 billeder.");
      break;
    }

    // add file
    dt.items.add(file);
    realInput.files = dt.files;

    // preview
    const img = document.createElement("img");
    img.src = URL.createObjectURL(file);
    img.onload = () => URL.revokeObjectURL(img.src);
    preview.appendChild(img);

    // change text
    if (dt.files.length === 2) {
      customBox.textContent = "Perfekt, så er de på plads!";
    }
  }
}

// input change (click upload)
input.addEventListener("change", (e) => {
  handleFiles(Array.from(e.target.files));
  input.value = "";
});

// drag and drop
customBox.addEventListener("dragover", (e) => {
  e.preventDefault();
  customBox.classList.add("dragover");
});

customBox.addEventListener("dragleave", () => {
  customBox.classList.remove("dragover");
});

customBox.addEventListener("drop", (e) => {
  e.preventDefault();
  customBox.classList.remove("dragover");

  const files = Array.from(e.dataTransfer.files);
  handleFiles(files);
});
// my profile end
