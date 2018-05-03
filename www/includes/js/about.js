// Read more 
//@TODO Change read more to Close
//@TODO Add entire content for each. Separate into it's own HTML?
var advisoryColumns = document.querySelectorAll('.AdvisoryBoard-col');
function readMore(i) {
  if (advisoryColumns[i].classList.contains('AdvisoryBoard-col--hidden')) return;
  advisoryColumns[i].classList.toggle('AdvisoryBoard-col--expand');
  advisoryColumns.forEach((col, colI) => {
    if (i === colI) return;
    col.classList.toggle('AdvisoryBoard-col--hidden');
  })
}

advisoryColumns.forEach((col, i) => {
  col.addEventListener('click', function() {
    readMore(i);
  });
});