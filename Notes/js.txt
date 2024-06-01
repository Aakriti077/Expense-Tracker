// Document operation functions
// const sideMenu = document.querySelector("aside");
// const menuBtn = document.querySelector("#menu-btn");
// const closeBtn = document.querySelector("#close-btn");
const themeToggler = document.querySelector(".theme-toggler");

// // Show Sidebar
// menuBtn.addEventListener("click", () => {
//   sideMenu.style.display = "block";
// });

// // Hide Sidebar
// closeBtn.addEventListener("click", () => {
//   sideMenu.style.display = "none";
// });

// // Change Theme
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

// Add click event listener to each link
sidebarLinks.forEach((link) => {
  link.addEventListener("click", (event) => {
    // event.preventDefault(); // Prevent default link behavior
    // Remove active class from all links except the clicked one
    removeActiveClassExceptClicked(link);
    // Add active class to the clicked link
    // link.classList.add("active");
  });
});

