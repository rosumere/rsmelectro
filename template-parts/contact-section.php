  <section class="contact-section <?php echo $args['section-type']; ?>">
    <div class="container">
      <div class="contact-section__inner">
        <div class="contact-section__head">
          <h2 class="page__subtitle contact-section__title">Форма обратной связи</h2>
          <div class="contact-section__info">
            Оставьте заявку и наш сотрудник свяжется с Вами в ближайшее время
          </div>
        </div>
        <div class="contact-section__form">
          <?php echo do_shortcode('[contact-form-7 id="67fc3c1" title="form-page"]'); ?>
        </div>
      </div>
      <?php echo $args['section-line']; ?>
    </div>
  </section>
