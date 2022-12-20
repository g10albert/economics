let dateInput = document.querySelector("#date");

let now = moment();
let date = moment().format("YYYY-MM-DD");
let time = moment().format("H:m:s");

dateInput.max = `${date}T${time}`;

let incomeOrExpenseInput = document.querySelector(".description");
let transactionItem = document.querySelector(".transaction__item");

if (
  incomeOrExpenseInput.value == "1" ||
  incomeOrExpenseInput.value == "Expense"
) {
  transactionItem.style.backgroundColor = "#4eaf5e";
} else if (
  incomeOrExpenseInput.value == "2" ||
  incomeOrExpenseInput.value == "Income"
) {
  transactionItem.style.backgroundColor = "#fc6e56";
}

incomeOrExpenseInput.addEventListener("click", () => {
  if (
    incomeOrExpenseInput.value == "1" ||
    incomeOrExpenseInput.value == "Expense"
  ) {
    transactionItem.style.backgroundColor = "#4eaf5e";
  } else if (
    incomeOrExpenseInput.value == "2" ||
    incomeOrExpenseInput.value == "Income"
  ) {
    transactionItem.style.backgroundColor = "#fc6e56";
  } else {
    transactionItem.style.backgroundColor = "##221f2d";
  }
});
