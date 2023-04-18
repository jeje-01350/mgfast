/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import './styles/app.scss';

import 'bootstrap'

let card1 = document.getElementById('1')
let card2 = document.getElementById('2')
let p1 = document.getElementById('bro')
let p2 = document.getElementById('bri')

card1.addEventListener('click', ()=>{
    card1.classList.add('active')
    card2.classList.remove('active')
    p1.classList.add('active')
    p2.classList.remove('active')
})

card2.addEventListener('click', ()=>{
    card1.classList.remove('active')
    card2.classList.add('active')
    p1.classList.remove('active')
    p2.classList.add('active')
})