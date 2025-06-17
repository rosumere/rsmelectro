document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('catalog-filter-form');
  const resetButton = document.getElementById('reset-filters');
  const resultsContainer = document.getElementById('catalog-results');
  const originalCatalogList = document.getElementById('original-catalog-list');

  if (!form) return;

  // Отправка формы
  form.addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = cleanFormData(collectFormData());
    formData.append('action', 'filter_catalog');

    fetch(catalog_filter_vars.ajax_url, {
      method: 'POST',
      body: formData
    })
      .then(response => response.text())
      .then(data => {
        resultsContainer.innerHTML = data;
        if (originalCatalogList) originalCatalogList.style.display = 'none';
        resultsContainer.style.display = 'block';

        updateFilterOptions(collectFormData());
        checkResetButtonVisibility();
      })
      .catch(error => console.error('Ошибка при загрузке товаров:', error));
  });

  // Обновление фильтров при изменении любого поля (кроме многовыборного)
  form.querySelectorAll('select:not([multiple]), input').forEach(input => {
    input.addEventListener('change', () => {
      const formData = collectFormData();
      updateFilterOptions(formData);
      checkResetButtonVisibility();
    });
  });

  // Обработка множественного выбора — application_area
  const multiSelect = document.getElementById('application_area');
  if (multiSelect) {
    multiSelect.addEventListener('change', () => {
      const powerSelect = document.getElementById('power');
      if (powerSelect) powerSelect.selectedIndex = 0;

      const formData = collectFormData();
      updateFilterOptions(formData);
      checkResetButtonVisibility();
    });
  }

  // Кнопка "Сбросить"
  if (resetButton) {
    resetButton.addEventListener('click', () => {
      form.reset();
      const formData = collectFormData();
      updateFilterOptions(formData);

      resultsContainer.innerHTML = '';
      resultsContainer.style.display = 'none';
      if (originalCatalogList) originalCatalogList.style.display = 'block';

      checkResetButtonVisibility();
    });

    checkResetButtonVisibility();
  }

  function checkResetButtonVisibility() {
    const hasValue = Array.from(form.elements).some(el => {
      if (el.tagName === 'SELECT' && el.multiple) {
        return Array.from(el.selectedOptions).some(opt => opt.value !== '');
      }
      return (el.tagName === 'SELECT' || el.tagName === 'INPUT') &&
        el.type !== 'submit' &&
        el.type !== 'hidden' &&
        el.value && el.value !== '';
    });

    if (resetButton) {
      resetButton.style.display = hasValue ? 'inline-block' : 'none';
    }
  }

  function cleanFormData(formData) {
    const cleaned = new FormData();
    for (const [key, value] of formData.entries()) {
      if (value !== '') cleaned.append(key, value);
    }
    return cleaned;
  }

  function collectFormData() {
    const formData = new FormData();
    const elements = form.querySelectorAll('select, input');

    elements.forEach(el => {
      if (el.tagName === 'SELECT' && el.multiple) {
        Array.from(el.selectedOptions).forEach(option => {
          if (option.value !== '') formData.append(el.name, option.value);
        });
      } else if (el.type !== 'submit' && el.type !== 'hidden' && el.value !== '') {
        formData.append(el.name, el.value);
      }
    });

    return formData;
  }

  function updateFilterOptions(formData) {
    const requestData = new FormData();
    const excluded = ['voltage', 'power', 'service-life'];

    for (const [key, value] of formData.entries()) {
      if (!excluded.includes(key)) {
        requestData.append(key, value);
      }
    }

    requestData.set('action', 'get_filter_options');

    fetch(catalog_filter_vars.ajax_url, {
      method: 'POST',
      body: requestData
    })
      .then(res => res.json())
      .then(data => {
        updateSelectOptions('voltage', data.voltage);
        // сортировка по числовому значению
        const sortedPower = data.power.slice().sort((a, b) => parseFloat(a) - parseFloat(b));
        updateSelectOptions('power', sortedPower);
        updateSelectOptions('service-life', data.life);
        updateMultiSelect('application_area', data.areas);
      })
      .catch(err => console.error('Ошибка при обновлении фильтров:', err));
  }

  function updateSelectOptions(selectId, options) {
    const select = document.getElementById(selectId);
    if (!select) return;

    const placeholder = select.querySelector('option:first-child')?.cloneNode(true);
    const currentValue = select.value;

    select.innerHTML = '';
    if (placeholder) select.appendChild(placeholder);

    let foundCurrent = false;

    options.forEach(option => {
      const opt = document.createElement('option');
      opt.value = option;

      if (selectId === 'power') {
        opt.textContent = option + ' Ач';
      } else if (selectId === 'voltage') {
        opt.textContent = option + ' В';
      } else {
        opt.textContent = option;
      }

      if (option === currentValue) {
        opt.selected = true;
        foundCurrent = true;
      }
      select.appendChild(opt);
    });

    if (!foundCurrent && select.options.length > 0) {
      select.selectedIndex = 0;
    }
  }

  function updateMultiSelect(selectId, options) {
    const select = document.getElementById(selectId);
    if (!select) return;

    const previouslySelected = Array.from(select.selectedOptions).map(opt => opt.value);
    select.innerHTML = '';

    options.forEach(option => {
      const opt = document.createElement('option');
      opt.value = option;
      opt.textContent = option;
      if (previouslySelected.includes(option)) {
        opt.selected = true;
      }
      select.appendChild(opt);
    });
  }
});
