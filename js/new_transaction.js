let dateInput = document.querySelector("#date");

// Using moment to handle input date

let now = moment();
let date = moment().format("YYYY-MM-DD");
let time = moment().format("H:m:s");

// Setting max date to the moment the user clicks

dateInput.max = `${date}T${time}`;

let incomeOrExpenseInput = document.querySelector(".description");
let transactionItem = document.querySelector(".transaction__item");

// Set background to edit wallet depending if it's income or outcome

if (incomeOrExpenseInput.value == "1") {
  transactionItem.style.backgroundColor = "#4eaf5e";
} else if (incomeOrExpenseInput.value == "2") {
  transactionItem.style.backgroundColor = "#fc6e56";
}

// Set background to new wallet depending if it's income or outcome

incomeOrExpenseInput.addEventListener("click", () => {
  if (incomeOrExpenseInput.value == "1") {
    transactionItem.style.backgroundColor = "#4eaf5e";
  } else if (incomeOrExpenseInput.value == "2") {
    transactionItem.style.backgroundColor = "#fc6e56";
  } else {
    transactionItem.style.backgroundColor = "#221f2d";
  }
});
