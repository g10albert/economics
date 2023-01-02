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
  const [r, g, b] = hex.match(/\w\w/g).map((x) => parseInt(x, 16));
  return `rgba(${r},${g},${b},${alpha})`;
};

// Fetch Wallets

fetch("http://localhost/api/wallets_api.php")
  .then((response) => {
    return response.json();
  })
  .then((data) => {
    for (let i = 0; i < 2; i++) {
      let itemWallet = `
      <div class="wallet__card" style="background:${
        data[i].color
      }; color: ${getTextColor(hex2rgba(data[i].color))};">
        <div class="wallet__top">
          <p class="wallet__p-gray">${data[i].type}</p>
          <p class="wallet__p">${data[i].name}</p>
        </div>
        <p class="wallet__p">Balance</p>
        <p class="wallet__p-price">${formatter.format(data[i].balance)}</p>
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

// Show monthly final status

let totalJan = 0;
let totalFeb = 0;
let totalMar = 0;
let totalApr = 0;
let totalMay = 0;
let totalJun = 0;
let totalJul = 0;
let totalAug = 0;
let totalSep = 0;
let totalOct = 0;
let totalNov = 0;
let totalDec = 0;

fetch("http://localhost/api/transactions_api.php")
  .then((response) => {
    return response.json();
  })
  .then((data) => {
    for (let i = 0; i < data.length; i++) {
      // get the year only from the transaction
      let dateYear = data[i].date.substring(0, 4);
      // only get data from current year
      if (dateYear == new Date().getFullYear()) {
        // get the year only from the data from the database
        let dateMonth = data[i].date.substring(5, 7);

        // if month of the transaction math with number of month add the income and subtract the outcome to get final status of month

        if (dateMonth == "01") {
          if (data[i].income_or_outcome == 1) {
            totalJan += +data[i].amount;
          } else {
            totalJan -= +data[i].amount;
          }
        } else if (dateMonth == "02") {
          if (data[i].income_or_outcome == 1) {
            totalFeb += +data[i].amount;
          } else {
            totalFeb -= +data[i].amount;
          }
        } else if (dateMonth == "03") {
          if (data[i].income_or_outcome == 1) {
            totalMar += +data[i].amount;
          } else {
            totalMar -= +data[i].amount;
          }
        } else if (dateMonth == "04") {
          if (data[i].income_or_outcome == 1) {
            totalApr += +data[i].amount;
          } else {
            totalApr -= +data[i].amount;
          }
        } else if (dateMonth == "05") {
          if (data[i].income_or_outcome == 1) {
            totalMay += +data[i].amount;
          } else {
            totalMay -= +data[i].amount;
          }
        } else if (dateMonth == "06") {
          if (data[i].income_or_outcome == 1) {
            totalJun += +data[i].amount;
          } else {
            totalJun -= +data[i].amount;
          }
        } else if (dateMonth == "07") {
          if (data[i].income_or_outcome == 1) {
            totalJul += +data[i].amount;
          } else {
            totalJul -= +data[i].amount;
          }
        } else if (dateMonth == "08") {
          if (data[i].income_or_outcome == 1) {
            totalAug += +data[i].amount;
          } else {
            totalAug -= +data[i].amount;
          }
        } else if (dateMonth == "09") {
          if (data[i].income_or_outcome == 1) {
            totalSep += +data[i].amount;
          } else {
            totalSep -= +data[i].amount;
          }
        } else if (dateMonth == "10") {
          if (data[i].income_or_outcome == 1) {
            totalOct += +data[i].amount;
          } else {
            totalOct -= +data[i].amount;
          }
        } else if (dateMonth == "11") {
          if (data[i].income_or_outcome == 1) {
            totalNov += +data[i].amount;
          } else {
            totalNov -= +data[i].amount;
          }
        } else if (dateMonth == "12") {
          if (data[i].income_or_outcome == 1) {
            totalDec += +data[i].amount;
          } else {
            totalDec -= +data[i].amount;
          }
        }
      }
    }

    // display monthly final status information

    const ctx = document.getElementById("barChart").getContext("2d");
    barChart = new Chart(ctx, {
      type: "bar",
      data: {
        labels: [
          `Jan`,
          `Feb`,
          `Mar`,
          `Apr`,
          `May`,
          `Jun`,
          `Jul`,
          `Aug`,
          `Sep`,
          `Oct`,
          `Nov`,
          `Dec`,
        ],
        datasets: [
          {
            data: [
              `${totalJan}`,
              `${totalFeb}`,
              `${totalMar}`,
              `${totalApr}`,
              `${totalMay}`,
              `${totalJun}`,
              `${totalJul}`,
              `${totalAug}`,
              `${totalSep}`,
              `${totalOct}`,
              `${totalNov}`,
              `${totalDec}`,
            ],
            backgroundColor: [""],
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
              size: 15,
            },
          },
        },
        scales: {
          y: {
            // display: false,
            grid: {
              display: false,
            },
          },
          x: {
            display: false,
            grid: {
              display: false,
            },
          },
        },
      },
    });
    let chartColors = {
      red: "rgb(252, 110, 86)",
      green: "rgb(88, 216, 110)",
    };

    // change color of bar depending if there were more outcomes or incomes

    let dataset = barChart.data.datasets[0];
    for (let i = 0; i < dataset.data.length; i++) {
      if (dataset.data[i] < 0) {
        dataset.backgroundColor[i] = chartColors.red;
      } else {
        dataset.backgroundColor[i] = chartColors.green;
      }
    }
    barChart.update();
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
