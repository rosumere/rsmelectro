document.addEventListener('DOMContentLoaded', function () {
  /*
 ** Главная навигация в header
 */
  const headerNavOpen = document.querySelector('.header__nav-open');
  const headerNavClose = document.querySelector('.header__nav-close');
  const headerMenu = document.querySelector('.header__nav');
  const bodyTag = document.querySelector('body');

  function headerMenuToggle() {
    headerMenu.classList.toggle('header__nav--open');
    bodyTag.classList.toggle('body--menu-active');
  }

  headerNavOpen.addEventListener('click', function (e) {
    e.stopPropagation();
    headerMenuToggle();
  });

  headerNavClose.addEventListener('click', function (e) {
    e.stopPropagation();
    headerMenuToggle();
  });

  headerMenu.addEventListener('click', function (e) {
    if (headerMenu.classList.contains('header__nav--open') &&
      e.target.classList.contains('header-nav__link')) {
      headerMenuToggle();
    }
  });

  document.addEventListener('click', function (e) {
    if (headerMenu.classList.contains('header__nav--open') &&
      !e.target.classList.contains('header__nav-open')) {
      headerMenuToggle();
    }
  });

  /**
   * Инициализация Glightbox
   */

  const cfForm = GLightbox({
    elements: [{
      'content': document.getElementById('contact-form'),
    },],
    width: '600',
    height: 'auto',
  });

  let contactFormBtns = document.querySelectorAll('[data-form="true"]');
  for (let i = 0; i < contactFormBtns.length; i++) {
    contactFormBtns[i].addEventListener('click', function () {
      cfForm.open();
    });
  }


  const lightbox = GLightbox({
    touchNavigation: true,
    loop: true,
    autoplayVideos: true
  });

});
