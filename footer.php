<footer class="footer">
  <div class="footer__wrapper">
    <div class="container">
      <div class="footer__inner">
        <div class="footer__col footer__social footer-social">
          <div class="footer-social__inner">
            <a href="<?php echo home_url(); ?>" class="footer__logo">
              <?php if (get_field('logo_desktop', 'option')): ?>
                <img src="<?php echo esc_url(get_field('logo_desktop', 'option')); ?>" alt="Логотип сайта">
              <?php endif; ?>
            </a>
            <ul class="footer-social__list">
              <?php if (get_field('contacts_link_video', 'option')): ?>
                <li class="footer-social__item">
                  <a href="<?php the_field('contacts_link_video', 'option'); ?>" target="_blank" class="link footer-social__link footer-social__link--video">
                    <svg viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M19.5 2.125C19.25 1.25 18.625 0.625 17.75 0.375C16.25 2.23517e-07 9.87499 0 9.87499 0C9.87499 0 3.62501 2.23517e-07 2.00001 0.375C1.12501 0.625 0.499996 1.25 0.249996 2.125C-3.81842e-06 3.75 0 7 0 7C0 7 3.7998e-06 10.25 0.375004 11.875C0.625004 12.75 1.25 13.375 2.125 13.625C3.625 14 10 14 10 14C10 14 16.25 14 17.875 13.625C18.75 13.375 19.375 12.75 19.625 11.875C20 10.25 20 7 20 7C20 7 20 3.75 19.5 2.125ZM7.99999 10V4L13.25 7L7.99999 10Z" fill="white" />
                    </svg>
                  </a>
                </li>
              <?php endif; ?>
              <?php if (get_field('contacts_link_telegram', 'option')): ?>
                <li class="footer-social__item">
                  <a href="<?php the_field('contacts_link_telegram', 'option'); ?>" target="_blank" class="link footer-social__link footer-social__link--telegram">
                    <svg viewBox="0 0 21 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M2.1249 7.63537C7.49359 5.29631 11.0736 3.75426 12.8648 3.00922C17.9792 0.881975 19.0419 0.51245 19.7346 0.500118C19.8869 0.497565 20.2276 0.53532 20.4482 0.714361C20.6345 0.86554 20.6858 1.06976 20.7103 1.2131C20.7348 1.35643 20.7654 1.68295 20.7411 1.93808C20.464 4.85012 19.2647 11.9169 18.6546 15.1784C18.3965 16.5585 17.8882 17.0212 17.3961 17.0665C16.3266 17.1649 15.5145 16.3597 14.4787 15.6807C12.8578 14.6182 11.9421 13.9568 10.3688 12.92C8.55053 11.7218 9.72923 11.0633 10.7654 9.98699C11.0366 9.70533 15.7487 5.41933 15.8399 5.03052C15.8513 4.98189 15.8619 4.80063 15.7542 4.70492C15.6465 4.60921 15.4876 4.64194 15.3729 4.66797C15.2104 4.70487 12.621 6.41634 7.60486 9.80237C6.86988 10.3071 6.20416 10.553 5.6077 10.5401C4.95015 10.5259 3.68528 10.1683 2.74498 9.86264C1.59166 9.48774 0.675027 9.28953 0.754845 8.65284C0.796419 8.32121 1.2531 7.98205 2.1249 7.63537Z" fill="white" />
                    </svg>
                  </a>
                </li>
              <?php endif; ?>
              <?php if (get_field('contacts_link_vk', 'option')): ?>
                <li class="footer-social__item">
                  <a href="<?php the_field('contacts_link_vk', 'option'); ?>" target="_blank" class="link footer-social__link footer-social__link--vk">
                    <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0 9.6C0 5.07333 0 2.81333 1.4 1.4C2.82 0 5.08 0 9.6 0H10.4C14.9267 0 17.1867 0 18.6 1.4C20 2.82 20 5.08 20 9.6V10.4C20 14.9267 20 17.1867 18.6 18.6C17.18 20 14.92 20 10.4 20H9.6C5.07333 20 2.81333 20 1.4 18.6C0 17.18 0 14.92 0 10.4V9.6Z" fill="white" />
                      <path d="M10.6402 14.4063C6.0802 14.4063 3.4802 11.2863 3.37354 6.08626H5.66687C5.7402 9.89959 7.4202 11.5129 8.75354 11.8463V6.08626H10.9069V9.37292C12.2202 9.23292 13.6069 7.73292 14.0735 6.07959H16.2202C16.0452 6.93543 15.6955 7.74599 15.1931 8.46061C14.6907 9.17523 14.0463 9.77857 13.3002 10.2329C14.1328 10.6473 14.8681 11.2336 15.4576 11.9529C16.0471 12.6723 16.4775 13.5084 16.7202 14.4063H14.3535C13.8469 12.8263 12.5802 11.5996 10.9069 11.4329V14.4063H10.6469H10.6402Z" fill="#181A1C" />
                    </svg>

                  </a>
                </li>
              <?php endif; ?>
            </ul>
          </div>

        </div>
        <div class="footer__col footer__contacts footer-contacts">
          <div class="footer-contacts__inner">
            <button class="btn footer-contacts__cta-btn btn--white" data-form="true" data-title="<?php echo esc_attr(wp_get_document_title()); ?>" data-info="Заявка с кнопки в подвале сайта">Связаться с нами</button>

            <?php if (get_field('contacts_phone_link', 'option')): ?>
              <a href="tel:<?php the_field('contacts_phone_link', 'option'); ?>" class="link footer-contacts__link footer-contacts__link--phone">
                <?php the_field('contacts_phone_human', 'option'); ?>
              </a>
            <?php endif; ?>
            <?php if (get_field('contacts_mail', 'option')): ?>
              <a href="mailto:<?php the_field('contacts_mail', 'option'); ?>" class="link footer-contacts__link footer-contacts__link--mail">
                <?php the_field('contacts_mail', 'option'); ?>
              </a>
            <?php endif; ?>
            <?php if (get_field('contacts_adress', 'option')): ?>
              <div class="footer-contacts__item footer-contacts__item--adress">
                <?php the_field('contacts_adress', 'option'); ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
        <div class="footer__col footer__menus footer-menu">
          <div class="footer-menu__inner">
            <div class="footer-menu__block">
              <h3 class="footer-menu__title">Продукция</h3>
              <?php
              wp_nav_menu([
                'theme_location'  => 'footer_production',
                'menu'            => '',
                'container'       => '',
                'container_class' => '',
                'container_id'    => '',
                'menu_class'      => 'footer-menu__list',
                'menu_id'         => '',
                'echo'            => true,
                'fallback_cb'     => 'wp_page_menu',
                'before'          => '',
                'after'           => '',
                'link_before'     => '',
                'link_after'      => '',
                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth'           => 0,
                'walker'          => '',
              ]);
              ?>
            </div>
            <div class="footer-menu__block">
              <h3 class="footer-menu__title">О нас</h3>
              <?php
              wp_nav_menu([
                'theme_location'  => 'footer_menu',
                'menu'            => '',
                'container'       => '',
                'container_class' => '',
                'container_id'    => '',
                'menu_class'      => 'footer-menu__list',
                'menu_id'         => '',
                'echo'            => true,
                'fallback_cb'     => 'wp_page_menu',
                'before'          => '',
                'after'           => '',
                'link_before'     => '',
                'link_after'      => '',
                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth'           => 0,
                'walker'          => '',
              ]);
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer__copy footer-copy">
      <div class="container">
        <div class="footer-copy__inner">
          <div class="footer-copy__info">&#xA9; <?php echo date('Y'); ?> Все права защищены</div>
          <a href="/privacy-policy" class="link footer-copy__link footer-copy__link--privacy">Политика конциденциальности</a>
        </div>
      </div>
    </div>
  </div>
  <div id="cookie-notification" class="cookie-notification">
    <div class="cookie-content">
      <p>Мы используем файлы cookie для улучшения работы сайта. Оставаясь на сайте, вы соглашаетесь с <a href="/privacy-policy" target="_blank">Политикой конфиденциальности</a>.</p>
      <button id="cookie-accept" class="cookie-btn">Принять</button>
    </div>
  </div>
  <div class="contact-form" id="contact-form" style="display:none">
    <h2 class="contact-form__title">Форма обратной связи</h2>
    <?php echo do_shortcode('[contact-form-7 id="119c600" title="form-contact"]'); ?>
  </div>
</footer>

<?php wp_footer(); ?>

</body>

</html>
