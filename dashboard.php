<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./css/super-reset.css" />
  <link rel="stylesheet" href="./css/dashboard.css" />
  <title>Economics</title>
</head>

<body>
  <header>
    <iconify-icon class="nav__btn-open" icon="charm:menu-hamburger"></iconify-icon>
    <nav class="nav">
      <h1 class="nav__logo">Economics</h1>
      <iconify-icon class="nav__btn-close" icon="bi:x"></iconify-icon>
      <div class="nav__divider">
        <ul class="nav__ul-u nav__ul">
          <li class="nav__li">
            <a href="#" class="nav__a nav__a-active">
              <iconify-icon class="nav__icon" icon="bxs:dashboard"></iconify-icon>Dashboard
            </a>
          </li>
          <li class="nav__li">
            <a href="#" class="nav__a">
              <iconify-icon class="nav__icon" icon="akar-icons:wallet"></iconify-icon>My wallets
            </a>
          </li>
          <li class="nav__li">
            <a href="#" class="nav__a">
              <iconify-icon class="nav__icon" icon="carbon:categories"></iconify-icon>Categories
            </a>
          </li>
          <li class="nav__li">
            <a href="#" class="nav__a">
              <iconify-icon class="nav__icon" icon="grommet-icons:transaction"></iconify-icon>Transactions
            </a>
          </li>
        </ul>
        <ul class="nav__ul-d nav__ul">
          <li class="nav__li" id="toggle-theme">
            <a href="#" class="nav__a">
              <iconify-icon class="nav__icon" icon="carbon:sun"></iconify-icon>Dark / Light
            </a>
          </li>
          <li class="nav__li">
            <a href="#" class="nav__a">
              <iconify-icon class="nav__icon" icon="carbon:phone"></iconify-icon>Contact us
            </a>
          </li>
          <li class="nav__li">
            <a href="#" class="nav__a">
              <iconify-icon class="nav__icon" icon="carbon:settings"></iconify-icon>Settings
            </a>
          </li>
          <li class="nav__li">
            <a href="#" class="nav__a">
              <iconify-icon class="nav__icon" icon="fluent-mdl2:leave"></iconify-icon>Log Out
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="new__transaction-wrapper new__transaction-phone">
      <p class="new__transaction">
        New transaction<iconify-icon icon="grommet-icons:transaction" class="new__transaction"></iconify-icon>
      </p>
    </div>
  </header>

  <main>
    <h2 class="wallet__title">My wallets</h2>
    <div class="wallet" id="wallets">

      <!-- element that is going to have the wallet cards -->

    </div>

    <div class="monthly">
      <h2 class="monthly__title">Monthly final status</h2>
      <div class="monthly__graphic-container">
        <canvas id="barChart" class="monthly__graphic"></canvas>
      </div>
    </div>

    <div class="expenses__recents-wrapper">
      <div class="new__transaction-wrapper new__transaction-desktop">
        <p class="new__transaction">
          New transaction<iconify-icon icon="grommet-icons:transaction" class="new__transaction"></iconify-icon>
        </p>
      </div>
      <div class="expenses">
        <div class="expenses__top">
          <div class="">
            <h3 class="expenses__title">My expenses</h3>
          </div>
          <div class="expenses__periods">
            <p class="expenses__p timeframe expenses__active" value="1" id="expense_day">D</p>
            <p class="expenses__p timeframe" value="2" id="expense_week">W</p>
            <p class="expenses__p timeframe" value="3" id="expense_month">M</p>
          </div>
        </div>
        <div class="graphic__wrapper">
          <div class="graphic__text">
            <p class="graphic__p">Total</p>
            <p class="graphic__p" id="total">

              <!-- element that is going to have the total amount of expenses depending on period of time -->

            </p>
          </div>
          <canvas id="doughnutChart" class="expenses__graphic"></canvas>
        </div>
      </div>
      <div class="recents">
        <h2 class="recents__title">Recents</h2>
        <div class="recents__divider" id="recents">

          <!-- element that is going to have the recent transactions -->

        </div>
      </div>
    </div>
  </main>

  <footer class="footer">
    <p class="footer__p">
      Made with <span class="footer__heart">&hearts;</span> by g10albert
    </p>
  </footer>

  <!-- CDN CHARTJS (FOR CHARTS) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- CDN ICONIFY (FOR ICONS) -->
  <script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>
  <!-- MomentJS CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- LINK TO MY JS FILE -->
  <script src="./js/dashboard.js" type="module"></script>
  <!-- LINK TO JQUERY -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


  <script>

  </script>
</body>

</html>