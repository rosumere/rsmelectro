<section class="contacts section-light">
  <div class="container">
    <div class="contacts__wrapper">
      <div class="contacts__inner">
        <div class="contacts__content">
          <h2 class="page__subtitle contacts__title">Контакты</h2>
          <ul class="contacts__list">
            <?php if (get_field('contacts_phone_link', 'option')): ?>
              <li class="contacts__item contacts__item--phone">
                <div class="contacts__label">Телефон</div>
                <a href="tel:<?php the_field('contacts_phone_link', 'option'); ?>" class="link contacts__value">
                  <?php the_field('contacts_phone_human', 'option'); ?>
                </a>
              </li>
            <?php endif; ?>
            <?php if (get_field('contacts_adress', 'option')): ?>
              <li class="contacts__item contacts__item--adress">
                <div class="contacts__label">Адрес</div>
                <div class="contacts__value"><?php the_field('contacts_adress', 'option'); ?></div>
              </li>
            <?php endif; ?>
            <?php if (get_field('contacts_mail', 'option')): ?>
              <li class="contacts__item contacts__item--mail">
                <div class="contacts__label">Почта</div>
                <a href="mailto:<?php the_field('contacts_mail', 'option'); ?>" class="link contacts__value">
                  <?php the_field('contacts_mail', 'option'); ?>
                </a>
              </li>
            <?php endif; ?>

            <?php if (get_field('contacts_name', 'option')): ?>
              <li class="contacts__item contacts__item--name">
                <div class="contacts__label">Наименование</div>
                <div class="contacts__value"><?php the_field('contacts_name', 'option'); ?></div>
              </li>
            <?php endif; ?>
          </ul>
        </div>
        <div class="contacts__form">
          <div class="contact-form">
            <?php echo do_shortcode('[contact-form-7 id="119c600" title="form-contact"]'); ?>
          </div>
        </div>
      </div>
    </div>
    <div class="section-line"></div>
  </div>
</section>
