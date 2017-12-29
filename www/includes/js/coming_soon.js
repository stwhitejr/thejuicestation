function signUp() {
  event.preventDefault();
  const emailInput = document.getElementById('js-signup-email').value;
  const signUpText = document.getElementById('js-signup-text');
  let errorMessage;
  // Validate form first
  if (emailInput.indexOf('@') === -1 || emailInput.indexOf('.') === -1) {
    if (!errorFlag) {
      errorMessage = document.createElement('div');
      errorMessage.classList.add('ErrorMessage');
      errorMessage.innerHTML = 'You must enter a valid email address.';
      signUpText.appendChild(errorMessage);
    }
    errorFlag = true;
    return false;
  } else {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
       signUpText.innerHTML = this.responseText;
      }
    };
    xhttp.open("GET", "/index.php?&is_ajax=1&email_signup=" + emailInput, true);
    xhttp.send();
  }
}

const signUpSubmit = document.getElementById('js-signup-submit');
signUpSubmit.addEventListener("click", signUp);
let errorFlag;