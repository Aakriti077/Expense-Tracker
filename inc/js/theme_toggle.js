const themeToggler = document.querySelector(".theme-toggler");

// Change Theme
themeToggler.addEventListener("click", () => {
  document.body.classList.toggle("dark-theme-variables");

  themeToggler.querySelector("span:nth-child(1)").classList.toggle("active");
  themeToggler.querySelector("span:nth-child(2)").classList.toggle("active");
});

// Get all links in the sidebar
const sidebarLinks = document.querySelectorAll("aside a");

// Function to remove active class from all links except the clicked one
function removeActiveClassExceptClicked(clickedLink) {
  sidebarLinks.forEach((link) => {
    if (link !== clickedLink) {
      link.classList.remove("active");
    }
  });
}
