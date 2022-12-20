const body = document.querySelector("body");
const initialTheme = "Light";
const toggleTheme = document.querySelector("#toggle-theme");
const menu = document.querySelector(".nav");
const openMenu = document.querySelector(".nav__btn-open");
const closeMenu = document.querySelector(".nav__btn-close");
const wallets = document.getElementById("wallets");
const recents = document.getElementById("recents");
const categoryDay = document.querySelector("#expense_day");
const categoryWeek = document.querySelector("#expense_week");
const categoryMonth = document.querySelector("#expense_month");
const total = document.querySelector("#total");
let doughnutChart = null;
let barChart = null;
let totalByTime = 0;

let activeTheme;

// Making menu responsive

openMenu.addEventListener("click", () => {
  menu.classList.remove("hidden");
  menu.classList.add("menu__active");
});

closeMenu.addEventListener("click", () => {
  menu.classList.remove("menu__active");
});

// Creating the dark/light theme

if (!document.querySelector("#toggle-theme")) {
  body.setAttribute("data-theme", "dark");
} else {
  const setTheme = (theme) => {
    localStorage.setItem("theme", theme);
    body.setAttribute("data-theme", theme);
  };

  toggleTheme.addEventListener("click", () => {
    activeTheme = localStorage.getItem("theme");

    if (activeTheme === "light") {
      setTheme("dark");
    } else {
      setTheme("light");
    }
  });

  const setThemeOnInit = () => {
    const savedTheme = localStorage.getItem("theme");

    activeTheme = localStorage.getItem("theme");

    if (savedTheme) {
      body.setAttribute("data-theme", savedTheme);
    } else {
      setTheme(initialTheme);
    }
  };

  setThemeOnInit();
}

// Jquery Dependency

$("input[data-type='currency']").on({
  keyup: function() {
    formatCurrency($(this));
  },
  blur: function() { 
    formatCurrency($(this), "blur");
  }
});


function formatNumber(n) {
// format number 1000000 to 1,234,567
return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}


function formatCurrency(input, blur) {
// appends $ to value, validates decimal side
// and puts cursor back in right position.

// get input value
var input_val = input.val();

// don't validate empty input
if (input_val === "") { return; }

// original length
var original_len = input_val.length;

// initial caret position 
var caret_pos = input.prop("selectionStart");
  
// check for decimal
if (input_val.indexOf(".") >= 0) {

  // get position of first decimal
  // this prevents multiple decimals from
  // being entered
  var decimal_pos = input_val.indexOf(".");

  // split number by decimal point
  var left_side = input_val.substring(0, decimal_pos);
  var right_side = input_val.substring(decimal_pos);

  // add commas to left side of number
  left_side = formatNumber(left_side);

  // validate right side
  right_side = formatNumber(right_side);
  
  // On blur make sure 2 numbers after decimal
  if (blur === "blur") {
    right_side += "00";
  }
  
  // Limit decimal to only 2 digits
  right_side = right_side.substring(0, 2);

  // join number by .
  input_val = "$" + left_side + "." + right_side;

} else {
  // no decimal entered
  // add commas to number
  // remove all non-digits
  input_val = formatNumber(input_val);
  input_val = "$" + input_val;
  
  // final formatting
  if (blur === "blur") {
    input_val += ".00";
  }
}

// send updated string to input
input.val(input_val);

// put caret back in the right position
var updated_len = input_val.length;
caret_pos = updated_len - original_len + caret_pos;
input[0].setSelectionRange(caret_pos, caret_pos);
}