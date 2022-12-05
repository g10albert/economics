let dateInput = document.querySelector("#date");

let now = moment();
let date = moment().format("YYYY-MM-DD");
let time = moment().format("H:m:s");

dateInput.max = `${date}T${time}`;
