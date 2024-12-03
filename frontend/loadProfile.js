// Retrieve data from localStorage
const profile = localStorage.getItem('profile');

// Retrive data from backend (currently just default values)
const balance = 0;
const address = '';
const phone = '';
const maxavail = 0;
const totavail = 0;
const parents = '';
const pending = 0;
const active = 0;
const completed = 0;
const avgreview = 0;
const previousten = [0,0,0,0,0,0,0,0,0,0];

// Check if the data exists in localStorage and update the HTML
if (profile) {
    document.getElementById('profile').textContent = `${profile}'s Profile`;
    document.getElementById('balance').textContent = `Balance : ${balance} Care Dollars`;
    document.getElementById('address').textContent = `Address : ${address}`;
    document.getElementById('phone').textContent = `Phone # : ${phone}`;
    document.getElementById('maxavail').textContent = `Max Availabile Hours per week : ${maxavail}`;
    document.getElementById('totavail').textContent = `Current Hours Caretaking per week : ${totavail}`;
    document.getElementById('parents').textContent = `Parents info : ${parents}`;
    document.getElementById('pending').textContent = `Pending Contracts : ${pending}`;
    document.getElementById('active').textContent = `Active Contracts : ${active}`;
    document.getElementById('completed').textContent = `Completed Contracts : ${completed}`;
    document.getElementById('avgreview').textContent = `Average Review Rating : ${avgreview}`;
    document.getElementById('previousten').textContent = `Previous Ten Review Ratings : ${previousten}`;

    
} else {
    document.getElementById('profile').textContent = 'User not found';
}