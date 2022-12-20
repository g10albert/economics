let walletCard = document.querySelector(".wallet__card");
let colorPicker = document.querySelector(".form__color");
let input = document.querySelector("input");

if (colorPicker.value != "#000000") {
  console.log(colorPicker.value);
  walletCard.style.backgroundColor = colorPicker.value;
} else {
  colorPicker.value = "#c0a9d6";
}

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
