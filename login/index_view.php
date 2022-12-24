<?php
$page = "landing";

session_start();

include_once("./api/connection.php");

if (isset($_SESSION['user_id'])) {

    // Get id to check if the user has a session

    $id = $_SESSION['user_id'];

    $sql = "SELECT id, email, password FROM users WHERE id = '$id'";

    $result = mysqli_query($con, $sql);

    $result_data = mysqli_fetch_assoc($result);

    $user = null;

    if ($result_data > 0) {
        $user = $result_data;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("./economics/includes/head.php") ?>
    <link rel="stylesheet" href="./economics/css/landing_page.css">
</head>

<iconify-icon class="nav__btn-open" icon="charm:menu-hamburger"></iconify-icon>

<body>

    <!-- If the user has a session send to dashboard -->
    <?php if (!empty($user)) : ?>
        <?php header("Location: ./dashboard.php") ?>

        <!-- If the user doesn't have a session show landing page -->

    <?php else : ?>
        <header>
            <input class="landing" value="index" style="display: none;">
            <nav class="nav" id="home">
                <a href="./" class="nav__logo">Economics</a>
                <ul class="nav__ul">
                    <iconify-icon class="nav__btn-close" icon="bi:x"></iconify-icon>
                    <li class="nav__li">
                        <a class="nav__a" href="#home">
                            <iconify-icon class="nav__icon" icon="material-symbols:home-outline"></iconify-icon> Home
                        </a>
                    </li>
                    <li class="nav__li"><a class="nav__a" href="#features">
                            <iconify-icon class="nav__icon" icon="ic:baseline-star-border"></iconify-icon>Features
                        </a></li>
                    <li class="nav__li">
                        <a class="nav__a" href="#about">
                            <iconify-icon class="nav__icon" icon="mdi:about-circle-outline"></iconify-icon> About
                        </a>
                    </li>
                    <li class="nav__li"><a class="nav__a" href="./login.php">
                            <iconify-icon class="nav__icon" icon="material-symbols:login"></iconify-icon>
                            Log in
                        </a></li>
                    <li class="dark_light nav__li" id="toggle-theme">
                        <div href="" class="" id="toggle-theme">
                            <iconify-icon class="dark_light-icon nav__icon" icon="carbon:sun"></iconify-icon>
                        </div>
                    </li>
                </ul>
            </nav>
        </header>
        <main>

            <!-- Call to action section -->

            <div class="cta">
                <div class="cta__left animate__animated animate__fadeInLeft">
                    <h2 class="cta__h2">CONTROL YOUR FINANCES <br> <span class="cta__h2-span">IN ONE PLACE</span></h2>
                    <p class="cta__p">Take control over your finances. Yes, it's hard, but it is doable.</p>
                    <p class="cta__p">With our app you will better understand where your money is going each day, week, month, and year.</p>
                    <p class="cta__p">What are you waiting for?</p>
                    <div class="cta_links">
                        <a class="cta__show" href="#features">Show me the place</a>
                        <a class="cta__get" href="./signup.php">Get Started</a>
                    </div>
                </div>
                <div class="cta__right animate__animated animate__fadeInRight">
                    <img class="cta_img" src="" alt="app dashboard image">
                </div>
            </div>
            <div class="wave__divider">
                <svg class="svg__features" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path class="wave__1" fill-opacity="1" d="M0,64L48,74.7C96,85,192,107,288,138.7C384,171,480,213,576,208C672,203,768,149,864,128C960,107,1056,117,1152,106.7C1248,96,1344,64,1392,48L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                </svg>

                <!-- Features section -->

                <h2 class="features__h2 revealjs" id="features">FEATURES</h2>
            </div>
            <div class="mfs__wrapper">
                <!-- Monthly final status section -->
                <div class="mfs">
                    <div class="mfs__left revealjs">
                        <h3 class="mfs__h3">MONTHLY FINAL STATUS SECTION</h3>
                        <img class="mfs__img" src="" alt="Monthly final status image">
                    </div>
                    <div class="mfs__right revealjs">
                        <p class="mfs__p p__m__left">You can see, edit and create personalized wallets to control from your credit card to your cash.</p>
                    </div>
                </div>
            </div>
            <div class="wave__divider">
                <svg class="svg__wallets" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path class="wave__2" fill-opacity="1" d="M0,224L48,224C96,224,192,224,288,224C384,224,480,224,576,208C672,192,768,160,864,154.7C960,149,1056,171,1152,154.7C1248,139,1344,85,1392,58.7L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                </svg>
                <!-- Wallets section -->
                <h3 class="wallets__h3 revealjs">WALLETS SECTION</h3>
            </div>
            <div class="wallets">
                <div class="wallets__right revealjs">
                    <img class="wallets__img" src="" alt="Wallets section image">
                </div>
                <div class="wallets_left revealjs">
                    <p class="wallets__p p__m__right">You can see, edit and create personalized wallets to control from your credit card to your cash.</p>
                </div>
            </div>
            <div class="wave__divider">
                <svg class="svg__categories" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path class="wave__1" fill-opacity="1" d="M0,256L48,234.7C96,213,192,171,288,170.7C384,171,480,213,576,224C672,235,768,213,864,202.7C960,192,1056,192,1152,202.7C1248,213,1344,235,1392,245.3L1440,256L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                </svg>
                <!-- Categories section -->
                <h3 class="categories__h3 revealjs">CATEGORIES SECTION</h3>
            </div>
            <div class="categories__wrapper">
                <div class="categories">
                    <div class="categories__left revealjs">
                        <img class="categories__img" src="" alt="Categories section image">
                    </div>
                    <div class="categories__right revealjs">
                        <p class="categories__p p__m__left">You can see, edit and create personalized categories that actually match with how you spend you money.</p>
                    </div>
                </div>
            </div>
            <div class="wave__divider">
                <svg class="svg__transactions" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path class="wave__2" fill-opacity="1" d="M0,256L48,234.7C96,213,192,171,288,170.7C384,171,480,213,576,224C672,235,768,213,864,202.7C960,192,1056,192,1152,202.7C1248,213,1344,235,1392,245.3L1440,256L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                </svg>
                <!-- Transactions section -->
                <h3 class="transactions__h3 revealjs">TRANSACTIONS SECTION</h3>
            </div>
            <div class="transactions">
                <div class="transactions__right revealjs">
                    <img class="transactions__img" src="" alt="transactions section image">
                </div>
                <div class="transactions__left revealjs">
                    <p class="transactions__p p__m__right">You can see, edit and create personalized wallets to control from your credit card to your cash.</p>
                </div>
            </div>
            <div class="wave__divider">
                <svg class="svg__extra" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path class="wave__1" fill-opacity="1" d="M0,256L48,234.7C96,213,192,171,288,170.7C384,171,480,213,576,224C672,235,768,213,864,202.7C960,192,1056,192,1152,202.7C1248,213,1344,235,1392,245.3L1440,256L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                </svg>

                <!-- Extra section -->

                <h3 class="extra_h3 revealjs">EXTRA</h3>
            </div>

            <div class="extra__wrapper">
                <div class="extra">
                    <!-- Extra-recents section -->
                    <div class="extra__recents">
                        <div class="recents__img-div">
                            <img class="extra__img recents__img revealjs" src="" alt="Recent transactions section image">
                        </div>
                        <div>
                            <p class="extra__p p__m__left revealjs">You can see the 3 most recent transactions.</p>
                        </div>
                    </div>
                    <!-- Extra-expenses section -->
                    <div class="extra__expenses">
                        <div class="expenses__img-div">
                            <img class="extra__img expenses__img revealjs" src="" alt="Expenses section image">
                        </div>
                        <div>
                            <p class="extra__p p__m__right revealjs">You can see in which 3 categories your spending the most daily, weekly and monthly.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wave__divider">
                <svg class="svg__about" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path class="wave__2" fill-opacity="1" d="M0,256L48,234.7C96,213,192,171,288,170.7C384,171,480,213,576,224C672,235,768,213,864,202.7C960,192,1056,192,1152,202.7C1248,213,1344,235,1392,245.3L1440,256L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                </svg>
                <!-- About section -->
                <h3 class="about__h3 revealjs" id="about">ABOUT</h3>
            </div>
            <div class="about revealjs">
                <p class="about__p">After more than 1 year of studying web development basics and developing 1 page projects I needed something to level up my skills.</p>
                <p class="about__p">I used to manage my money with a phone app, however, I didn't have access to it on other devices. Whit this web app I have more benefits for free and I can add transactions everywhere and anywhere.</p>
                <p class="about__p">This is an app I started because I wanted to find a way to manage my money without to use paper or manual calculations.</p>
            </div>
        </main>
        <!-- Footer section -->
        <footer class="footer revealjs">
            <p class="footer__a">Support the Project: <a class="footer__link" target="_blank" href="https://www.paypal.com/donate/?hosted_button_id=WM2TSMT6N5LZ4">Paypal</a></p>
            <p class="footer__a">Contact me: <a class="footer__link" target="_blank" href="mailto:albertmiguelg10@gmail.com">Email</a></p>
            <p class="footer__a">Github: <a class="footer__link" target="_blank" href="https://github.com/g10albert">g10albert</a></p>
            <p class="footer__p">
                Made with <span class="footer__heart">&hearts;</span> by g10albert
            </p>
        </footer>
        <!-- back to top button -->
        <button class="toTop" id="myBtn">
            <iconify-icon icon="mdi:arrow-top"></iconify-icon>
        </button>
    <?php endif; ?>
    <?php include_once("./economics/includes/scripts.php") ?>
    <script src="./economics/js/landing_page.js"></script>
</body>

</html>