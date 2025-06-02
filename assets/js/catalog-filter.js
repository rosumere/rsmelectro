document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('catalog-filter-form');
  const resetButton = document.getElementById('reset-filters');
  const resultsContainer = document.getElementById('catalog-results');

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
        updateFilterOptions(collectFormData());
        checkResetButtonVisibility();
      })
      .catch(error => {
        console.error('Ошибка при загрузке товаров:', error);
      });
  });

  // Обновление фильтров при изменении любого поля (кроме множественного выбора)
  form.querySelectorAll('select:not([multiple]), input').forEach(input => {
    input.addEventListener('change', () => {
      const formData = collectFormData();
      updateFilterOptions(formData);
      checkResetButtonVisibility();
    });
  });

  // Отдельная обработка для множественного выбора (только проверка кнопки сброса)
  const multiSelect = document.getElementById('application_area');
  if (multiSelect) {
    multiSelect.addEventListener('change', () => {
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
      checkResetButtonVisibility();
    });

    checkResetButtonVisibility();
  }

  // Проверка видимости кнопки сброса
  function checkResetButtonVisibility() {
    const hasValue = Array.from(form.elements).some(el => {
      if (el.tagName === 'SELECT' && el.multiple) {
        // Для множественного выбора проверяем, есть ли выбранные опции
        return Array.from(el.selectedOptions).some(opt => opt.value !== '');
      }
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

  // Очистка пустых значений из FormData
  function cleanFormData(formData) {
    const cleaned = new FormData();
    for (const [key, value] of formData.entries()) {
      if (value !== '') {
        cleaned.append(key, value);
      }
    }
    return cleaned;
  }

  // Обновление опций фильтров
  function updateFilterOptions(formData) {
    // Создаем копию formData для отправки
    const requestData = new FormData();

    // Копируем все данные из переданного formData
    for (const [key, value] of formData.entries()) {
      requestData.append(key, value);
    }

    requestData.set('action', 'get_filter_options');

    fetch(catalog_filter_vars.ajax_url, {
      method: 'POST',
      body: requestData
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

  function collectFormData() {
    const formData = new FormData();
    const elements = form.querySelectorAll('select, input');

    elements.forEach(el => {
      if (el.tagName === 'SELECT' && el.multiple) {
        // Для множественного выбора добавляем каждое выбранное значение
        Array.from(el.selectedOptions).forEach(option => {
          if (option.value !== '') {
            formData.append(el.name, option.value);
          }
        });
      } else if (el.type !== 'submit' && el.type !== 'hidden' && el.value !== '') {
        formData.append(el.name, el.value);
      }
    });

    return formData;
  }

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

  function updateMultiSelect(selectId, options) {
    const select = document.getElementById(selectId);
    if (!select) return;

    // Получаем выбранные значения ДО очистки
    const previouslySelected = Array.from(select.options)
      .filter(opt => opt.selected)
      .map(opt => opt.value);

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
