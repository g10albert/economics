<header>
    <iconify-icon class="nav__btn-open" icon="charm:menu-hamburger"></iconify-icon>
    <nav class="nav">
      <a href="./dashboard.php" class="nav__logo">Economics</a>
      <iconify-icon class="nav__btn-close" icon="bi:x"></iconify-icon>
      <div class="nav__divider">
        <ul class="nav__ul-u nav__ul">
          <li class="nav__li">
            <a href="./dashboard.php" class="nav__a <?php if ($page == "dashboard") {echo "nav__a-active";} ?>">
              <iconify-icon class="nav__icon" icon="bxs:dashboard"></iconify-icon>Dashboard
            </a>
          </li>
          <li class="nav__li">
            <a href="./wallets.php" class="nav__a <?php if ($page == "mywallets") {echo "nav__a-active";} ?>">
              <iconify-icon class="nav__icon" icon="akar-icons:wallet"></iconify-icon>My wallets
            </a>
          </li>
          <li class="nav__li">
            <a href="./categories.php" class="nav__a <?php if ($page == "categories") {echo "nav__a-active";} ?>">
              <iconify-icon class="nav__icon" icon="carbon:categories"></iconify-icon>Categories
            </a>
          </li>
          <li class="nav__li">
            <a href="./transactions.php" class="nav__a <?php if ($page == "transactions") {echo "nav__a-active";} ?>">
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
            <a href="mailto:albertmiguelg10@gmail.com" class="nav__a">
              <iconify-icon class="nav__icon" icon="carbon:phone"></iconify-icon>Contact me
            </a>
          </li>
          <li class="nav__li">
            <a href="./logout.php" class="nav__a">
              <iconify-icon class="nav__icon" icon="fluent-mdl2:leave"></iconify-icon>Log Out
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="new__transaction-wrapper new__transaction-phone">
      <a href="./new_transaction.php" class="new__transaction">
        New transaction<iconify-icon icon="grommet-icons:transaction" class="new__transaction"></iconify-icon>
      </a>
    </div>
  </header>