document.addEventListener('DOMContentLoaded', function () {

  const header = document.querySelector('.header');
  const headerMenuToggle = document.querySelector('.header-menu-toggle');
  const headerMenu = document.querySelector('.header-menu');
  const submenuItems = document.querySelectorAll('.header-menu__item--submenu');

  // Обновление высоты основного меню
  function updateHeaderMenuHeight() {
    if (headerMenu.classList.contains('header-menu--active')) {
      headerMenu.style.height = `${headerMenu.scrollHeight}px`;
    }
  }

  // Плавное раскрытие/сжатие submenu
  function toggleSubmenu(submenu) {
    const isOpen = submenu.classList.contains('active');
    if (isOpen) {
      submenu.style.height = `${submenu.scrollHeight}px`; // установка текущей высоты для начала анимации
      requestAnimationFrame(() => {
        submenu.style.height = '0px';
        submenu.classList.remove('active');
      });
    } else {
      submenu.classList.add('active');
      const fullHeight = submenu.scrollHeight;
      submenu.style.height = '0px';
      requestAnimationFrame(() => {
        submenu.style.height = `${fullHeight}px`;
      });
    }
  }

  if (header && headerMenuToggle && headerMenu && window.matchMedia('(max-width: 1199.98px)').matches) {

    // Тогглер основного меню
    headerMenuToggle.addEventListener('click', function () {
      this.classList.toggle('header-menu-toggle--active');
      header.classList.toggle('header--active');

      if (headerMenu.classList.contains('header-menu--active')) {
        headerMenu.style.height = `${headerMenu.scrollHeight}px`;
        requestAnimationFrame(() => {
          headerMenu.style.height = '0px';
          headerMenu.classList.remove('header-menu--active');
        });
      } else {
        headerMenu.classList.add('header-menu--active');
        const fullHeight = headerMenu.scrollHeight;
        headerMenu.style.height = '0px';
        requestAnimationFrame(() => {
          headerMenu.style.height = `${fullHeight}px`;
        });
      }
    });

    // Обработка клика по подменю
    // submenuItems.forEach(item => {
    //   item.addEventListener('click', function (e) {
    //     if (window.innerWidth < 1200) {
    //       e.preventDefault();

    //       const submenu = item.querySelector('.header-menu__submenu');
    //       if (!submenu) return;

    //       item.classList.toggle('active');
    //       toggleSubmenu(submenu);

    //       // Пересчитать высоту основного меню
    //       setTimeout(updateHeaderMenuHeight, 250); // подождать завершения анимации
    //     }
    //   });
    // });
    submenuItems.forEach(item => {
      item.addEventListener('click', function (e) {
        // Если клик был по ссылке в подменю — разрешаем переход
        const isLink = e.target.closest('.submenu__link');
        if (isLink) return;

        if (window.innerWidth < 1200) {
          e.preventDefault();

          const submenu = item.querySelector('.header-menu__submenu');
          if (!submenu) return;

          item.classList.toggle('active');
          toggleSubmenu(submenu);

          setTimeout(updateHeaderMenuHeight, 250);
        }
      });
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

  /**
   * Скрипт для табов
   */

  function initTabsFromHTML() {
    const tabContainers = document.querySelectorAll('[data-tabs-container]');

    tabContainers.forEach(container => {
      const defaultTab = container.dataset.tabsDefault;
      const buttons = container.querySelectorAll('.tabs__btn');
      const contents = container.querySelectorAll('.tabs__content');

      if (buttons.length === 0 || contents.length === 0) return;

      const activeTab = defaultTab || buttons[0].dataset.tab;

      function activateTab(tabName) {
        contents.forEach(content => {
          content.classList.toggle('active', content.dataset.tab === tabName);
        });

        buttons.forEach(btn => {
          btn.classList.toggle('active', btn.dataset.tab === tabName);
        });
      }

      buttons.forEach(button => {
        button.addEventListener('click', () => {
          activateTab(button.dataset.tab);
        });
      });

      activateTab(activeTab);
    });
  }

  // Инициализация
  initTabsFromHTML();

  /**
   * Аккордеон для вакансий
   */

  function initAccordeons() {
    const accordions = document.querySelectorAll('.job-accordeon');

    accordions.forEach(accordeon => {
      const items = accordeon.querySelectorAll('.job-accordeon__item');

      items.forEach((item, index) => {
        const btn = item.querySelector('.job-accordeon__btn');
        const content = item.querySelector('.job-accordeon__content');

        // Инициализация: открываем первый
        if (index === 0) {
          item.classList.add('open');
          content.style.maxHeight = content.scrollHeight + 'px';
        } else {
          content.style.maxHeight = 0;
        }

        btn.addEventListener('click', () => {
          const isOpen = item.classList.contains('open');

          if (isOpen) {
            // Закрываем
            item.classList.remove('open');
            content.style.maxHeight = 0;
          } else {
            // Открываем
            item.classList.add('open');
            content.style.maxHeight = content.scrollHeight + 'px';
          }
        });
      });
    });
  }

  initAccordeons();

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
  * Инициализация swiper slider для страницы вакансий
  */

  const swiper = new Swiper('.page-job__slider', {
    slidesPerView: 1.3,
    spaceBetween: 8,
    breakpoints: {
      576: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 3,

      },
      1200: {
        slidesPerView: 4,
        spaceBetween: 24

      }
    },

    loop: false,
    navigation: {
      nextEl: '.page-job__nav--next',
      prevEl: '.page-job__nav--prev',
    },
    a11y: {
      prevSlideMessage: 'Предыдущая вакансия',
      nextSlideMessage: 'Следующая вакансия',
    },
    speed: 1400,
    autoHeight: false,
  });

  /**
   * Инициализация Glightbox
   */

  let lastClickedButton = null;

  const cfForm = GLightbox({
    elements: [{
      'content': document.getElementById('contact-form'),
    }],
    width: '600px',
    height: 'auto',
  });

  // Назначаем обработчики на все кнопки с data-form="true"
  document.querySelectorAll('[data-form="true"]').forEach(button => {
    button.addEventListener('click', function () {
      lastClickedButton = button; // Запоминаем кнопку
      cfForm.open();
    });
  });

  cfForm.on('open', () => {
    setTimeout(() => {
      const form = document.querySelector('#contact-form .wpcf7 form');
      if (!form || !lastClickedButton) return;

      const pageTitle = document.title;
      const productTitle = lastClickedButton.getAttribute('data-title') || '';
      const productInfo = lastClickedButton.getAttribute('data-info') || '';

      const pageTitleInput = form.querySelector('input[name="page_title"]');
      const productInfoInput = form.querySelector('input[name="product_info"]');

      if (pageTitleInput) pageTitleInput.value = pageTitle;
      if (productInfoInput) productInfoInput.value = productTitle && productInfo
        ? `${productTitle} – ${productInfo}`
        : productTitle || productInfo || 'Не указано';
    }, 100); // даем Glightbox немного времени на отрисовку
  });

  let resumeFormBtns = document.querySelectorAll('[data-resume="true"]');
  for (let i = 0; i < resumeFormBtns.length; i++) {
    resumeFormBtns[i].addEventListener('click', function () {
      jobForm.open();
    });
  }

  const lightbox = GLightbox({
    touchNavigation: true,
    loop: false,
    autoplayVideos: false,
    height: 'auto',
  });

  // Инициализация Glightbox для вакансий
  const lightboxJob = GLightbox({
    selector: '.glightbox-job',
    touchNavigation: true,
    loop: false,
    height: 'auto',
  });

  // После загрузки всплывающего окна с вакансией
  lightboxJob.on('slide_after_load', (current) => {
    const { slideNode } = current;

    // Инициализируем аккордеон
    initAccordeons();

    // Находим кнопку "Отправить резюме" в текущем слайде
    const formBtn = slideNode.querySelector('[data-job-form="true"]');

    // Если кнопка "Отправить резюме" найдена, то по нажатию мы закроем всплывающее окно вакансии и откроем в новом всплывающем окне форму отправки резюме
    if (formBtn) {
      formBtn.addEventListener('click', function (e) {
        // Отменим действие по умолчанию, чтобы форма не закрылась раньше времени
        e.preventDefault();

        // Закрыть lightbox вакансии
        lightboxJob.close();

        // Открыть форму отправки резюме с задержкой 800мс. Если задержку не давать - скрипты не успеют нормально отработать и форма отправки резюме не откроется - будет бесконечно крутиться спинер закгрузки
        setTimeout(() => {
          jobForm.open();
        }, 800);
      });
    }
  });

  // Инициализируем саму форму отправки резюме
  const jobForm = GLightbox({
    elements: [{
      'content': document.getElementById('job-form'),
    },],
    width: '870',
    loop: false,
    height: 'auto',
  });

  /**
   * Отображение имени файла для формы загрузкуи резюме
   */

  const fileInput = document.getElementById('file1');
  const labelText = document.querySelector('.resume-upload-text');

  if (fileInput && labelText) {

    fileInput.addEventListener('change', function () {
      if (fileInput.files.length > 0) {
        const fileName = fileInput.files[0].name;
        labelText.textContent = `Файл "${fileName}" прикреплён`;
      } else {
        labelText.textContent = 'Добавьте ваше резюме';
      }
    });
  }

  /**
   * Кнопка показать / скрыть форму фильтрации на странице каталога товаров
   */

  const toggleButton = document.querySelector(".page-catalog__filters-btn");
  const filterForm = document.querySelector(".page-catalog__filters-form");

  if (toggleButton && filterForm) {
    const btnText = toggleButton.querySelector(".page-catalog__filters-btn-text");

    let isOpen = false;

    toggleButton.addEventListener("click", () => {
      if (!isOpen) {
        const fullHeight = filterForm.scrollHeight + "px";
        filterForm.style.height = fullHeight;
        filterForm.classList.add("open");
        toggleButton.classList.add("active");
        btnText.textContent = "Скрыть фильтры";
      } else {
        filterForm.style.height = filterForm.scrollHeight + "px";
        requestAnimationFrame(() => {
          filterForm.style.height = "0";
        });
        filterForm.classList.remove("open");
        toggleButton.classList.remove("active");
        btnText.textContent = "Показать фильтры";
      }
      isOpen = !isOpen;
    });

    filterForm.addEventListener("transitionend", () => {
      if (isOpen) {
        filterForm.style.height = "auto";
      }
    });
  }


  /**
   * Уведомпление о куках
   */

  document.body.appendChild(document.getElementById("cookie-notification"));


  const cookieNotification = document.getElementById('cookie-notification');
  const cookieAcceptBtn = document.getElementById('cookie-accept');

  // Проверяем, было ли уже принято уведомление
  if (!getCookie('cookieAccepted')) {
    cookieNotification.style.display = 'block';
  }

  // Обработчик клика на кнопку "Принять"
  cookieAcceptBtn.addEventListener('click', function () {
    setCookie('cookieAccepted', 'true', 365);
    cookieNotification.style.display = 'none';
  });

  // Функция для установки куки
  function setCookie(name, value, days) {
    const date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    const expires = "expires=" + date.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
  }

  // Функция для получения куки
  function getCookie(name) {
    const cookieName = name + "=";
    const decodedCookie = decodeURIComponent(document.cookie);
    const cookieArray = decodedCookie.split(';');

    for (let i = 0; i < cookieArray.length; i++) {
      let cookie = cookieArray[i];
      while (cookie.charAt(0) === ' ') {
        cookie = cookie.substring(1);
      }
      if (cookie.indexOf(cookieName) === 0) {
        return cookie.substring(cookieName.length, cookie.length);
      }
    }
    return "";
  }


  /**
   * Табы на странице "О компании" - при выборе активного все остальные закрываются
   */
  // const items = document.querySelectorAll(".about-info__item");

  // function collapseAll() {
  //   items.forEach(item => {
  //     const content = item.querySelector(".about-info__content");
  //     item.classList.remove("about-info__item--active");
  //     content.style.maxHeight = "0px";
  //   });
  // }

  // items.forEach(item => {
  //   const header = item.querySelector(".about-info__head");
  //   const content = item.querySelector(".about-info__content");

  //   // Установим max-height на активный по умолчанию
  //   if (item.classList.contains("about-info__item--active")) {
  //     content.style.maxHeight = content.scrollHeight + "px";
  //   }

  //   header.addEventListener("click", function () {
  //     const isActive = item.classList.contains("about-info__item--active");

  //     collapseAll(); // Скрыть все

  //     if (!isActive) {
  //       item.classList.add("about-info__item--active");
  //       const scrollHeight = content.scrollHeight;
  //       content.style.maxHeight = scrollHeight + "px";
  //     }
  //   });
  // });

  /**
   * Табы на странице "О компании" - открываются и закрывается независимо от остальных
   */

  const items = document.querySelectorAll(".about-info__item");

  items.forEach(item => {
    const header = item.querySelector(".about-info__head");
    const content = item.querySelector(".about-info__content");

    // Установим max-height на активный по умолчанию
    if (item.classList.contains("about-info__item--active")) {
      content.style.maxHeight = content.scrollHeight + "px";
    }

    header.addEventListener("click", function () {
      const isActive = item.classList.contains("about-info__item--active");

      if (isActive) {
        // Закрыть таб
        item.classList.remove("about-info__item--active");
        content.style.maxHeight = "0px";
      } else {
        // Открыть таб
        item.classList.add("about-info__item--active");
        content.style.maxHeight = content.scrollHeight + "px";
      }
    });
  });
});
