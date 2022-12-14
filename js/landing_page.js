// Get the button and go to top on click
let mybutton = document.getElementById("myBtn");

mybutton.addEventListener("click", () => {
  topFunction();
});

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () {
  scrollFunction();
};

// Function to track scroll

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

// Track elements to use revealjs on them

let revealElement = document.querySelectorAll(".revealjs");

ScrollReveal().reveal(revealElement, { duration: 1200 });
