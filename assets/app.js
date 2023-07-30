/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
import { Tooltip, Toast, Popover } from 'bootstrap'
// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu");
const contractMenu = document.querySelector("#user_contract");
const dateLabel = document.querySelector('.lab');
const dateInput = document.querySelector('#user_dateContract');

hamburger.addEventListener("click", mobileMenu);

function mobileMenu() {
    hamburger.classList.toggle("active");
    navMenu.classList.toggle("active");
}
contractMenu.addEventListener("change", (e) => {
    if (e.target.value == 'CDD' || e.target.value == 'INTERIM'){
        dateInput.classList.remove('d-none');
        dateInput.classList.add('d-block');
        dateLabel.classList.remove('d-none');
        dateLabel.classList.add('d-block');
    } else {
        dateInput.classList.remove('d-block');
        dateInput.classList.add('d-none');
        dateLabel.classList.remove('d-block');
        dateLabel.classList.add('d-none');
    }
});
