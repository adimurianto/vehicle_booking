app.querySelector('.page-loader', function (el) {
  const pageLoader = el[0];

  const hidePageLoader = function () {
    setTimeout(function(){
      pageLoader.classList.add('hidden');
    }, 2000);
  };
  
  window.addEventListener('load', hidePageLoader);
});