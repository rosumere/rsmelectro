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

  /**
   * Меняем background-color на .about-info__item при наведении на .about-info__head
   */

  const canHover = window.matchMedia('(hover: hover)').matches;

  if (canHover) {
    const heads = document.querySelectorAll('.about-info__head');

    heads.forEach(head => {
      head.addEventListener('mouseenter', () => {
        const parentItem = head.closest('.about-info__item');
        if (parentItem) {
          parentItem.classList.add('about-info__item--hovered');
        }
      });

      head.addEventListener('mouseleave', () => {
        const parentItem = head.closest('.about-info__item');
        if (parentItem) {
          parentItem.classList.remove('about-info__item--hovered');
        }
      });
    });
  }



  const buttons = document.querySelectorAll('.tabs__btn');
  const contents = document.querySelectorAll('.tabs__content');

  // По умолчанию активен "Паспорта"
  const defaultTab = 'passport';

  function activateTab(tabName) {
    contents.forEach(content => {
      if (content.dataset.tab === tabName) {
        content.classList.add('active');
      } else {
        content.classList.remove('active');
      }
    });

    buttons.forEach(btn => {
      if (btn.dataset.tab === tabName) {
        btn.classList.add('active');
      } else {
        btn.classList.remove('active');
      }
    });
  }

  buttons.forEach(button => {
    button.addEventListener('click', () => {
      const target = button.dataset.tab;
      activateTab(target);
    });
  });

  // Инициализация
  activateTab(defaultTab);





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



document.addEventListener("DOMContentLoaded", function () {
  const items = document.querySelectorAll(".about-info__item");

  function collapseAll() {
    items.forEach(item => {
      const content = item.querySelector(".about-info__content");
      item.classList.remove("about-info__item--active");
      content.style.maxHeight = "0px";
    });
  }

  items.forEach(item => {
    const header = item.querySelector(".about-info__head");
    const content = item.querySelector(".about-info__content");

    // Установим max-height на активный по умолчанию
    if (item.classList.contains("about-info__item--active")) {
      content.style.maxHeight = content.scrollHeight + "px";
    }

    header.addEventListener("click", function () {
      const isActive = item.classList.contains("about-info__item--active");

      collapseAll(); // Скрыть все

      if (!isActive) {
        item.classList.add("about-info__item--active");
        const scrollHeight = content.scrollHeight;
        content.style.maxHeight = scrollHeight + "px";
      }
    });
  });
});
