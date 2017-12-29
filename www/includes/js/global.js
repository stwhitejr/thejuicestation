// General Functions
const smoothScroll = (dest, i) => {
  i = i || 100;
  if (i !== dest) {
    setTimeout(() => {
      scrollTo(0, i);
      if (i < dest) {
        let scrollToAmount = i + 100;
        if (scrollToAmount > dest) {
          scrollToAmount = dest;
        }
        smoothScroll(dest, scrollToAmount);
      } else {
        let scrollToAmount = i - 100;
        if (scrollToAmount < dest) {
          scrollToAmount = dest;
        }
        smoothScroll(dest, scrollToAmount);
      }
    }, 35);
  }
}

// Event Listeners
const body = document.body;
window.addEventListener('load', () => {
  body.classList.add('js-enabled');
});

// Mobile Navigation
const mobileNavButton = document.getElementById('js-mobile-nav');
const nav = document.getElementById('js-nav');
mobileNavButton.addEventListener('click', () => {
  nav.classList.toggle('Nav--active');
});

// Location smooth scroll
const navLocation = document.querySelectorAll('.js-nav-location');
Array.from(navLocation).forEach((e) => {
  e.addEventListener('click', () => {
    event.preventDefault();
    const locationElement = document.getElementById('location');
    const headerElement = document.getElementById('js-header');
    let scrollDest = locationElement.offsetTop;
    // If we're on mobile take the sticky header height into consideration
    if (window.innerWidth < 600) {
      nav.classList.remove('Nav--active');
      scrollDest -= headerElement.offsetHeight;
    }
    smoothScroll(scrollDest, window.pageYOffset);
  });
})

// Footer email signup
const emailSignup = document.getElementById('js-email-signup');
let emailSignupErrorFlag;
emailSignup.addEventListener('click', () => {
  event.preventDefault();
  const emailInput = document.getElementById('js-email-signup-field').value;
  const signUpText = document.getElementById('js-email-signup-text');
  let errorMessage;
  // Validate form first
  if (emailInput.indexOf('@') === -1 || emailInput.indexOf('.') === -1) {
    if (!emailSignupErrorFlag) {
      errorMessage = document.createElement('div');
      errorMessage.classList.add('u-ErrorMessage');
      errorMessage.innerHTML = 'You must enter a valid email address.';
      signUpText.appendChild(errorMessage);
    }
    emailSignupErrorFlag = true;
    return false;
  } else {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        signUpText.remove();
       document.getElementById('js-email-signup-form').innerHTML = this.responseText;
      }
    };
    xhttp.open("GET", "/?is_ajax=1&email_signup=" + emailInput, true);
    xhttp.send();
  }
});
