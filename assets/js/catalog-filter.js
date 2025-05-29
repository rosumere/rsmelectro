document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('catalog-filter-form');

  if (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();

      const formData = new FormData(form);

      fetch(catalog_filter_vars.ajax_url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
          action: 'filter_catalog',
          voltage: formData.get('voltage'),
          power: formData.get('power'),
          tech: formData.get('tech')
        })
      })
        .then(response => response.text())
        .then(data => {
          document.getElementById('catalog-results').innerHTML = data;
        })
        .catch(error => {
          console.error('Ошибка при отправке запроса:', error);
        });
    });
  }
});
