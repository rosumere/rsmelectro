jQuery(document).ready(function ($) {
  // 1. Загрузка марок
  $.post(ups_ajax.ajax_url, { action: 'load_ups_brands' }, function (response) {
    response.forEach(function (brand) {
      $('#brandSelect').append(`<option value="${brand.id}">${brand.name}</option>`);
    });
  });

  // 2. При выборе марки — загрузка серий
  $('#brandSelect').on('change', function () {
    const brandId = $(this).val();
    $('#seriesSelect').html('<option value="">Серия</option>');
    $('#upsSetSelect').html('<option value="">Комплект батарей производ...</option>');

    if (!brandId) return;

    $.post(ups_ajax.ajax_url, {
      action: 'load_ups_series',
      brand_id: brandId
    }, function (response) {
      response.forEach(function (series) {
        $('#seriesSelect').append(`<option value="${series.id}">${series.name}</option>`);
      });
    });
  });

  // 3. При выборе серии — загрузка ups_set
  $('#seriesSelect').on('change', function () {
    const seriesId = $(this).val();
    $('#upsSetSelect').html('<option value="">Комплект батарей производ...</option>');

    if (!seriesId) return;

    $.post(ups_ajax.ajax_url, {
      action: 'load_sets_by_series',
      series_id: seriesId
    }, function (response) {
      response.forEach(function (set) {
        $('#upsSetSelect').append(`<option value="${set.id}">${set.name}</option>`);
      });
    });
  });

  // 4. Фильтрация
  $('#upsFilterForm').on('submit', function (e) {
    e.preventDefault();
    $.post(ups_ajax.ajax_url, {
      action: 'filter_ups_catalog',
      brand: $('#brandSelect').val(),
      series: $('#seriesSelect').val(),
      ups_set: $('#upsSetSelect').val(),
    }, function (response) {
      $('#filterResults').html(response);
    });
  });
});
