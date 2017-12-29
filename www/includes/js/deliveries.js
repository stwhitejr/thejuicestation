// Delivery signup
const deliveryRequestSubmit = document.getElementById('js-delivery-request-submit');
deliveryRequestSubmit.addEventListener('click', () => {
  event.preventDefault();
  // Get field data
  const name = document.getElementById('js-name-field').value;
  const address = document.getElementById('js-address-field').value;
  const town = document.getElementById('js-town-field').value;
  const zip = document.getElementById('js-zip-field').value;
  const email = document.getElementById('js-email-field').value;
  const phone = document.getElementById('js-phone-field').value;
  const request = document.getElementById('js-request-field').value;
  const frequency = document.getElementById('js-frequency-field').value;

  // Parents for validation formating
  const nameParent = document.getElementById('js-name-field').parentElement;
  const addressParent = document.getElementById('js-address-field').parentElement;
  const townParent = document.getElementById('js-town-field').parentElement;
  const zipParent = document.getElementById('js-zip-field').parentElement;
  const emailParent = document.getElementById('js-email-field').parentElement;
  
  const deliveryForm = document.getElementById('js-delivery-request');
  let deliveryRequestErrorFlag;
  let errorMessages = [];

  // Remove left over errors
  const fieldParents = [nameParent, addressParent, townParent, zipParent, emailParent];
  fieldParents.forEach((parent) => {
    parent.classList.remove('u-ErrorInput');
  });
  // If we already have an error message element remove it and start over
  const errorElement = document.getElementById('js-error');
  if (errorElement) {
    errorElement.remove();
  }
  // Validate form first
  if (name.length < 1) {
    errorMessages.push('You must enter your name.');
    nameParent.classList.add('u-ErrorInput');
    deliveryRequestErrorFlag = true;
  }
  if (address.length < 1) {
    errorMessages.push('You must enter your address.');
    addressParent.classList.add('u-ErrorInput');
    deliveryRequestErrorFlag = true;
  }
  if (town.length < 1) {
    errorMessages.push('You must enter your town.');
    townParent.classList.add('u-ErrorInput');
    deliveryRequestErrorFlag = true;
  }
  if (zip.length < 5 || !parseInt(zip)) {
    errorMessages.push('You must enter a valid zip code.');
    zipParent.classList.add('u-ErrorInput');
    deliveryRequestErrorFlag = true;
  }
  if (email.indexOf('@') === -1 || email.indexOf('.') === -1 || email.length < 7) {
    errorMessages.push('You must enter a valid email address.');
    emailParent.classList.add('u-ErrorInput');
    deliveryRequestErrorFlag = true;
  }
  if (deliveryRequestErrorFlag) {
    errorMessage = document.createElement('div');
    errorMessage.classList.add('u-ErrorMessage');
    errorMessage.id = 'js-error';
    errorMessage.innerHTML = errorMessages.join('<br/>');
    deliveryForm.prepend(errorMessage);
  } else {
    const fetchData = {
      method: 'post',
      headers: new Headers({
        'Content-Type': 'application/x-www-form-urlencoded'}),
      body: `delivery_request=1&name=${name}&address=${address}&town=${town}&zip=${zip}&email=${email}&phone=${phone}&request=${request}&frequency=${frequency}`
    };
    fetch('/?controller=pages&action=deliveries&is_ajax=1', fetchData).then((res) => res.text()).then((resData) => {
      deliveryForm.innerHTML = resData;
    }).catch((err) => {
      throw err;
    })
  }
});
