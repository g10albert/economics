let walletCard = document.querySelector(".wallet__card");
let colorPicker = document.querySelector(".form__color");
let input = document.querySelector("input");

// If color picker is different from black (the default color) set color to the current color
// If color is in its default, set color to purple

if (colorPicker.value != "#000000") {
  console.log(colorPicker.value);
  walletCard.style.backgroundColor = colorPicker.value;
} else {
  colorPicker.value = "#c0a9d6";
}

// Change wallet background on input and change text color in wallet depending on background color

colorPicker.addEventListener("input", () => {
  walletCard.style.backgroundColor = colorPicker.value;
  walletCard.style.color = getTextColor(walletCard.style.backgroundColor);
});

// Function to change text color in wallet depending on background color

function getTextColor(rgba) {
  rgba = rgba.match(/\d+/g);
  if (rgba[0] * 0.299 + rgba[1] * 0.587 + rgba[2] * 0.114 > 186) {
    return "black";
  } else {
    return "white";
  }
}
