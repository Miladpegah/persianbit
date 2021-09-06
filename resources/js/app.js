require('./bootstrap');


require('./app');

require('alpinejs');

let questionField = document.getElementById('question');
questionField.addEventListener('keypress',passToReviw);

let passToReviw = () => {
  console.log('hello');
  let fieldInner = document.getElementById('question').innerHTML;

  let reviwField = document.getElementById('review');

  reviwField.innerHTML = fieldInner;
}
