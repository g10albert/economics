const body = document.querySelector("body");
const initialTheme = "Light";
const toggleTheme = document.querySelector("#toggle-theme");
const menu = document.querySelector(".nav");
const openMenu = document.querySelector(".nav__btn-open");
const closeMenu = document.querySelector(".nav__btn-close");

// Making menu responsive

openMenu.addEventListener("click", () => {
  menu.classList.remove("hidden");
  menu.classList.add("menu__active");
});

closeMenu.addEventListener("click", () => {
  menu.classList.remove("menu__active");
});

// Creating the dark/light theme

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

const ctx = document.getElementById("barChart").getContext("2d");
const barChart = new Chart(ctx, {
  type: "bar",
  data: {
    labels: [
      "January",
      "February",
      "March",
      "April",
      "March",
      "June",
      "July",
      "August",
      "September",
      "October",
      "November",
      "December",
    ],
    datasets: [
      {
        fill: false,
        data: [1, -20, 3, 5, -2, 3, -30, 3, -5, 10, -10, 30],
        backgroundColor: ["#63f17a", "#fc6e56", "#63f17a", "#63f17a", "#fc6e56", "#63f17a", "#fc6e56", "#63f17a", "#fc6e56", "#63f17a", "#fc6e56", "#63f17a"],
        barPercentage: 1,
      },
    ],
  },
  options: {
    maintainAspectRatio: false,
    plugins: {
      legend: {
        display: false,
      },
    },
    indexAxis: "y",
    scales: {
      x: {
        grid: {
          drawOnChartArea: false,
        },
        display: false,
      },
      y: {
        beginAtZero: false,
        grid: {
          drawOnChartArea: false,
        },
        display: false,
      },
    },
  },
});

const ctx2 = document.getElementById("doughnutChart").getContext("2d");
const doughnutChart = new Chart(ctx2, {
  type: "doughnut",
  data: {
    labels: [
      'Red',
      'Blue',
      'Yellow'
    ],
    datasets: [{
      label: 'My First Dataset',
      data: [300, 50, 100],
      backgroundColor: [
        'rgb(255, 99, 132)',
        'rgb(54, 162, 235)',
        'rgb(255, 205, 86)'
      ],
      hoverOffset: 1
    }]
  },
  options: {
    plugins: {
      legend: {
        display: false,
      },
    },
  },
});

