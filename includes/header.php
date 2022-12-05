<header>
    <iconify-icon class="nav__btn-open" icon="charm:menu-hamburger"></iconify-icon>
    <nav class="nav">
      <h1 class="nav__logo">Economics</h1>
      <iconify-icon class="nav__btn-close" icon="bi:x"></iconify-icon>
      <div class="nav__divider">
        <ul class="nav__ul-u nav__ul">
          <li class="nav__li">
            <!-- <a href="../pages/dashboard.php" class="nav__a nav__a-active"> -->
            <a href="../pages/dashboard.php" class="nav__a <?php if ($page == "dashboard") {echo "nav__a-active";} ?>">
              <iconify-icon class="nav__icon" icon="bxs:dashboard"></iconify-icon>Dashboard
            </a>
          </li>
          <li class="nav__li">
            <a href="#" class="nav__a <?php if ($page == "mywallets") {echo "nav__a-active";} ?>">
              <iconify-icon class="nav__icon" icon="akar-icons:wallet"></iconify-icon>My wallets
            </a>
          </li>
          <li class="nav__li">
            <a href="#" class="nav__a <?php if ($page == "categories") {echo "nav__a-active";} ?>">
              <iconify-icon class="nav__icon" icon="carbon:categories"></iconify-icon>Categories
            </a>
          </li>
          <li class="nav__li">
            <a href="#" class="nav__a <?php if ($page == "transanctions") {echo "nav__a-active";} ?>">
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
      <a href="./new_transaction.php" class="new__transaction">
        New transaction<iconify-icon icon="grommet-icons:transaction" class="new__transaction"></iconify-icon>
      </a>
    </div>
  </header>