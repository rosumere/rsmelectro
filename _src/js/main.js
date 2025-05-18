document.addEventListener('DOMContentLoaded', function () {
  /**
   * Главная навигация header
   */

  const header = document.querySelector('.header');
  const headerMenuToggle = document.querySelector('.header-menu-toggle');
  const headerMenu = document.querySelector('.header-menu');

  if (header && headerMenuToggle && headerMenu && window.matchMedia('(max-width: 1199.98px)').matches) {

    headerMenuToggle.addEventListener('click', function () {
      this.classList.toggle('header-menu-toggle--active');
      header.classList.toggle('header--active');
    });

    headerMenuToggle.addEventListener('click', () => {
      if (headerMenu.classList.contains('header-menu--active')) {
        // Закрытие
        headerMenu.style.height = `${headerMenu.scrollHeight}px`;
        requestAnimationFrame(() => {
          headerMenu.style.height = '0px';
          headerMenu.classList.remove('header-menu--active');
        });
      } else {
        // Открытие
        headerMenu.classList.add('header-menu--active');
        const fullHeight = headerMenu.scrollHeight;
        headerMenu.style.height = '0px';
        requestAnimationFrame(() => {
          headerMenu.style.height = `${fullHeight}px`;
        });
      }
    });
  }

  // Очистить инлайн стиль после окончания transition
  // headerMenu.addEventListener('transitionend', () => {
  //   if (headerMenu.classList.contains('header-menu--active')) {
  //     headerMenu.style.height = 'auto';
  //   }
  // });

  /**
   * Отступ margin-top hero__content homepage от header для полосок
   */

  // const heroContent = document.querySelector('.home-hero');
  // if (heroContent) {
  //   heroContent.style.marginTop = "20px";
  // }


  /**
   * Правильный отступ для catalog-card__cta. Установим для неё инлайново bottom равное высоте catalog-card__content
   */

  const cards = document.querySelectorAll('.catalog-card');

  cards.forEach(card => {
    const content = card.querySelector('.catalog-card__content');
    const cta = card.querySelector('.catalog-card__cta');

    if (content && cta) {
      const updatePosition = () => {
        const height = content.getBoundingClientRect().height;
        cta.style.bottom = `${height}px`;
      };

      updatePosition();

      // Следим за изменениями размера
      const ro = new ResizeObserver(updatePosition);
      ro.observe(content);
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
