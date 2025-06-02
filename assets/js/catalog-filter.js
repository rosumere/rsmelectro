document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('catalog-filter-form');
  const resetButton = document.getElementById('reset-filters');
  const resultsContainer = document.getElementById('catalog-results');

  if (!form) return;

  // При отправке формы — фильтруем каталог
  form.addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(form);
    formData.append('action', 'filter_catalog');

    fetch(catalog_filter_vars.ajax_url, {
      method: 'POST',
      body: formData
    })
      .then(response => response.text())
      .then(data => {
        resultsContainer.innerHTML = data;
        updateFilterOptions(new FormData(form));
        checkResetButtonVisibility();
      })
      .catch(error => {
        console.error('Ошибка при загрузке товаров:', error);
      });
  });

  // Обновление опций в других селектах при изменении одного из них
  form.querySelectorAll('select, input').forEach(input => {
    input.addEventListener('change', () => {
      const formData = new FormData(form);
      updateFilterOptions(formData);
      checkResetButtonVisibility();
    });
  });

  // Кнопка сброса параметров
  if (resetButton) {
    resetButton.addEventListener('click', () => {
      form.reset();
      const formData = new FormData(form);
      updateFilterOptions(formData);
      resultsContainer.innerHTML = '';
      checkResetButtonVisibility();
    });

    checkResetButtonVisibility();
  }

  // Проверка, отображать ли кнопку сброса
  function checkResetButtonVisibility() {
    const hasValue = Array.from(form.elements).some(el => {
      return (el.tagName === 'SELECT' || el.tagName === 'INPUT') &&
        el.type !== 'submit' &&
        el.type !== 'hidden' &&
        el.value &&
        el.value !== '';
    });

    if (resetButton) {
      resetButton.style.display = hasValue ? 'inline-block' : 'none';
    }
  }

  // Обновление всех опций фильтров
  function updateFilterOptions(formData) {
    formData.set('action', 'get_filter_options');

    fetch(catalog_filter_vars.ajax_url, {
      method: 'POST',
      body: formData
    })
      .then(res => res.json())
      .then(data => {
        updateSelectOptions('voltage', data.voltage);
        updateSelectOptions('power', data.power);
        updateSelectOptions('service-life', data.life);
        updateMultiSelect('application_area', data.areas);
      })
      .catch(err => {
        console.error('Ошибка при обновлении фильтров:', err);
      });
  }

  // Обновление обычного <select>
  function updateSelectOptions(selectId, options) {
    const select = document.getElementById(selectId);
    if (!select) return;

    const placeholder = select.querySelector('option:first-child')?.cloneNode(true);
    const currentValue = select.value;

    select.innerHTML = '';
    if (placeholder) select.appendChild(placeholder);

    options.forEach(option => {
      const opt = document.createElement('option');
      opt.value = option;
      opt.textContent = option;
      if (option === currentValue) {
        opt.selected = true;
      }
      select.appendChild(opt);
    });
  }

  // Обновление <select multiple>
  function updateMultiSelect(selectId, options) {
    const select = document.getElementById(selectId);
    if (!select) return;

    const selected = Array.from(select.selectedOptions).map(o => o.value);
    select.innerHTML = '';

    options.forEach(option => {
      const opt = document.createElement('option');
      opt.value = option;
      opt.textContent = option;
      if (selected.includes(option)) {
        opt.selected = true;
      }
      select.appendChild(opt);
    });
  }
});
