const body = document.body;
body.onload = function() {
  body.classList.add('js-enabled');
};

const mobileNavButton = document.getElementById('js-mobile-nav');
const nav = document.getElementById('js-nav');
mobileNavButton.onclick = function() {
  nav.classList.toggle('Nav--active');
};