const wallets = document.getElementById("wallets");
const recents = document.getElementById("recents");
const categoryDay = document.querySelector("#expense_day");
const categoryWeek = document.querySelector("#expense_week");
const categoryMonth = document.querySelector("#expense_month");
const total = document.querySelector("#total");
let doughnutChart = null;
let barChart = null;
let totalByTime = 0;

// Make hex color become rgba

const hex2rgba = (hex, alpha = 1) => {
  const [r, g, b] = hex.match(/\w\w/g).map(x => parseInt(x, 16));
  return `rgba(${r},${g},${b},${alpha})`;
};

// Fetch Wallets

fetch("http://localhost/api/wallets_api.php")
  .then((response) => {
    return response.json();
  })
  .then((data) => {
    for (let i = 0; i < data.length; i++) {
      let itemWallet = `
      <div class="wallet__card" style="background:${data[i].color}; color: ${getTextColor(hex2rgba(data[i].color))};">
        <div class="wallet__top">
          <p class="wallet__p-gray">${data[i].type}</p>
          <p class="wallet__p">${data[i].name}</p>
        </div>
        <p class="wallet__p">Balance</p>
        <p class="wallet__p-price">${formatter.format(data[i].balance)}</p>
        <a class="wallet__a" href="./edit_wallet.php?id=${
          data[i].id
        }"><iconify-icon icon="material-symbols:edit"></iconify-icon></a>
      </div>
      `;
      wallets.innerHTML += itemWallet;
    }
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

// Create number formatter for the currencies.

const formatter = new Intl.NumberFormat("en-US", {
  style: "currency",
  currency: "USD",
});

// Changing styles to the timeframe buttons

$(document).ready(function () {
  $(".timeframe").on("click", function () {
    $(this).siblings().removeClass("expenses__active");
    $(this).addClass("expenses__active");
  });
});

// Function to load graph in different timeframes

function loadGraph(url) {
  if (doughnutChart != null) {
    doughnutChart.destroy();
  }
  let val1;
  let cat1;
  let val2;
  let cat2;
  let val3;
  let cat3;

  fetch(url)
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      let numberOfTransactions = data.length;
      totalByTime = 0;
      for (let i = 0; i < data.length; i++) {
        totalByTime += +data[i].total_category;
      }

      total.textContent = formatter.format(totalByTime);

      if (numberOfTransactions == 0) {
        total.textContent = " This looks empty!";
      } else if (numberOfTransactions == 1) {
        val1 = data[0].total_category;
        cat1 = data[0].category;
      } else if (numberOfTransactions == 2) {
        val1 = data[0].total_category;
        cat1 = data[0].category;
        val2 = data[1].total_category;
        cat2 = data[1].category;
      } else {
        val1 = data[0].total_category;
        cat1 = data[0].category;
        val2 = data[1].total_category;
        cat2 = data[1].category;
        val3 = data[2].total_category;
        cat3 = data[2].category;
      }

      const ctx = document.getElementById("doughnutChart").getContext("2d");
      doughnutChart = new Chart(ctx, {
        type: "doughnut",
        data: {
          labels: [`${cat1}`, `${cat2}`, `${cat3}`],
          datasets: [
            {
              label: "My First Dataset",
              data: [`${val1}`, `${val2}`, `${val3}`],
              backgroundColor: [
                "rgb(255, 99, 132)",
                "rgb(255, 205, 86)",
                "rgb(54, 162, 235)",
              ],
            },
          ],
        },
        options: {
          plugins: {
            legend: {
              display: false,
            },
            tooltip: {
              bodyFont: {
                size: 20,
              },
            },
          },
        },
      });
    });
}

// Call function in the day timefray to start the app

loadGraph("http://localhost/api/expenses_api_day.php");

// Fetch and display transactions by timeframe

categoryDay.addEventListener("click", () => {
  loadGraph("http://localhost/api/expenses_api_day.php");
});

categoryWeek.addEventListener("click", () => {
  loadGraph("http://localhost/api/expenses_api_week.php");
});

categoryMonth.addEventListener("click", () => {
  loadGraph("http://localhost/api/expenses_api_month.php");
});

// Fetch recent transactions

let color;

fetch("http://localhost/api/transactions_api.php")
  .then((response) => {
    return response.json();
  })
  .then((data) => {
    for (let i = 0; i < 3; i++) {
      if (data[i].income_or_outcome == 1) {
        color = "recents__income";
      } else {
        color = "recents__outcome";
      }

      let itemTransaction = `
      <div class="recents__item ${color}">
          <p class="recents__p">
            <iconify-icon icon="grommet-icons:transaction" class="recents__icon"></iconify-icon>${
              data[i].category
            }
          </p>
          <p class="recents__p-price">${formatter.format(data[i].amount)}</p>
        </div>
      `;
      recents.innerHTML += itemTransaction;
    }
  });
