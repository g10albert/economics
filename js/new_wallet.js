let walletCard = document.querySelector(".wallet__card");
let colorPicker = document.querySelector(".form__color")


if (colorPicker.value != '#000000') {
    console.log(colorPicker.value);
    walletCard.style.backgroundColor = colorPicker.value;
} else {
    colorPicker.value = '#c0a9d6';
}

colorPicker.addEventListener("input", () => {
    walletCard.style.backgroundColor = colorPicker.value;
})