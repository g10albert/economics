const body = document.querySelector('body');
const initialTheme = 'Light';
const toggleTheme = document.querySelector('#toggle-theme');
const menu = document.querySelector('.nav')
const openMenu = document.querySelector('.nav__btn-open')
const closeMenu = document.querySelector('.nav__btn-close')

// Making menu responsive

openMenu.addEventListener('click', () => {
    menu.classList.remove('hidden')
    menu.classList.add('menu__active')
    
})

closeMenu.addEventListener('click', () => {
    menu.classList.remove('menu__active')
})


// Creating the dark/light theme

const setTheme = (theme) => {
    localStorage.setItem('theme', theme);
    body.setAttribute('data-theme', theme);
}

toggleTheme.addEventListener('click', () => {

    activeTheme = localStorage.getItem('theme');

    if (activeTheme === 'light') {
        setTheme('dark');
    } else {
        setTheme('light');
    }
})

const setThemeOnInit = () => {
    const savedTheme = localStorage.getItem('theme');

    activeTheme = localStorage.getItem('theme');

    if (savedTheme) {
        body.setAttribute('data-theme', savedTheme);

    } else {
        setTheme(initialTheme);
    }
}

setThemeOnInit();