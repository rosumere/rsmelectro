<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Geologica:wght@100..900&family=Inter+Tight:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  <link rel="icon" href="/favicon.ico" sizes="any">
  <link rel="icon" href="/icon.svg" type="image/svg+xml">
  <link rel="manifest" href="/manifest.webmanifest">
  <link rel="yandex-tableau-widget" href="/tableau.json">
  <?php wp_head(); ?>
</head>

<?php
$header_type;
if (is_front_page() || get_field('is_show_hero')) {
  $header_type = 'header--absolute';
}
?>

<body <?php body_class(); ?>>
  <header class="header <?php echo esc_attr($header_type); ?>">
    <div class="container header__container">
      <div class="header__inner">
        <a href="<?php echo home_url(); ?>" class="header__logo site-logo">
          <?php if (get_field('logo_mobile', 'option')): ?>
            <img src="<?php echo esc_url(get_field('logo_mobile', 'option')); ?>" alt="Логотип" class="site-logo__mobile">
          <?php endif; ?>
          <?php if (get_field('logo_desktop', 'option')): ?>
            <img src="<?php echo esc_url(get_field('logo_desktop', 'option')); ?>" alt="Логотип" class="site-logo__desktop">
          <?php endif; ?>
        </a>
        <div class="header-menu">
          <div class="container header-menu__inner">


            <?php

            wp_nav_menu([
              'theme_location'  => 'header_menu',
              'menu'            => '',
              'container'       => 'nav',
              'container_class' => 'header-menu__nav',
              'container_id'    => '',
              'menu_class'      => 'header-menu__list',
              'menu_id'         => '',
              'echo'            => true,
              'fallback_cb'     => false, // Отключаем стандартный fallback
              'before'          => '',
              'after'           => '',
              'link_before'     => '',
              'link_after'      => '',
              'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
              'depth'           => 0,
              'walker'          => new Rsmelectro_Header_Nav(),
            ]);
            ?>
            <div class="header-menu__contacts">
              <?php if (get_field('contacts_phone_link', 'option') && get_field('contacts_phone_human', 'option')): ?>
                <a href="tel:<?php the_field('contacts_phone_link', 'option'); ?>" class="link header-menu__contacts-link header-menu__contacts-link--phone"><?php the_field('contacts_phone_human', 'option'); ?>
                </a>
              <?php endif; ?>
              <?php if (get_field('contacts_mail', 'option')): ?>
                <a href="mailto:<?php the_field('contacts_mail', 'option'); ?>" class="link header-menu__contacts-link header-menu__contacts-link--mail"><?php the_field('contacts_mail', 'option'); ?></a>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="header__contacts header-contacts">
          <div class="header-contacts__info">
            <?php if (get_field('contacts_phone_link', 'option') && get_field('contacts_phone_human', 'option')): ?>
              <a href="tel:<?php the_field('contacts_phone_link', 'option'); ?>" class="link header-contacts__link header-contacts__phone-link"><?php the_field('contacts_phone_human', 'option'); ?>
              </a>
            <?php endif; ?>
            <?php if (get_field('contacts_mail', 'option')): ?>
              <a href="mailto:<?php the_field('contacts_mail', 'option'); ?>" class="link header-contacts__link header-contacts__mail-link"><?php the_field('contacts_mail', 'option'); ?></a>
            <?php endif; ?>
          </div>

          <button class="btn btn--dark header-contacts__cta" data-form="true">Связаться с нами</button>
          <button class="btn header-menu-toggle">
            <span class="header-menu-toggle__line"></span>
            <span class="header-menu-toggle__line"></span>
          </button>
        </div>

      </div>


    </div>
    </div>
  </header>
