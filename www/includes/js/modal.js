// Modal
var modalItems = document.querySelectorAll('.js-modal-open');
var modalWrap = document.querySelector('.js-modal-wrap');
var modal = document.querySelector('.js-modal');
var id;
function toggleModal() {
  // Set modal position relative to window scroll position
  modal.style.top = window.pageYOffset + 'px';
  id = this.getAttribute('data-modal-id') ? this.getAttribute('data-modal-id') : id;
  var modalContent = document.querySelectorAll('.js-modal-content');

  modalWrap.classList.toggle('ModalWrap--active');
  modalContent.forEach(item => {
    console.log(id);
    console.log(item.getAttribute('data-modal-id'));
    if (item.getAttribute('data-modal-id') === id) {
      item.classList.toggle('Modal-content--active');
    }
  })
}

modalItems.forEach(col => {
  col.addEventListener('click', toggleModal);
});
modalWrap.addEventListener('click', toggleModal);