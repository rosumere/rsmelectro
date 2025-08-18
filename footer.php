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
            <div class="footer-contacts__item footer-contacts__item--shedule">
              Работаем Пн - Пт с 9:00 - 18:00
            </div>
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
          <a href="/privacy-policy" class="link footer-copy__link footer-copy__link--privacy">Политика конфиденциальности</a>
        </div>
        <div class="footer-copy__offer">
          Данный интернет-сайт носит исключительно информационный характер и не является публичной офертой, определяемой положениями статьи 437 Гражданского кодекса Российский Федерации. Подробную информацию о стоимости и условиях продажи Вы можете получить у менеджеров. Компания ООО «Электро» оставляет за собой право вносить любые изменения в ассортимент предлагаемых товаров, в их описания, стоимость, а также вносить изменения в любую другую информацию о товаре без предварительного уведомления.
        </div>
      </div>
    </div>
  </div>
  <?php get_template_part('template-parts/cookie-notification'); ?>

  <div class="contact-form" id="contact-form" style="display:none">
    <h2 class="contact-form__title">Форма обратной связи</h2>
    <?php echo do_shortcode('[contact-form-7 id="119c600" title="form-contact"]'); ?>
  </div>
</footer>

<?php wp_footer(); ?>

<script>
  const oneumCSS = document.createElement('link');
  oneumCSS.rel = "stylesheet";
  oneumCSS.href = "https://chat.oneum.io/eChat.css";
  document.head.insertBefore(oneumCSS, document.head.childNodes[document.head.childNodes.length - 1].nextSibling);

  function loadOneumScript(url, callback) {
    const script = document.createElement("script");
    script.type = "text/javascript";
    script.async = true;
    script.defer = true;
    if (script.readyState) {
      script.onreadystatechange = function() {
        if (script.readyState === "loaded" || script.readyState === "complete") {
          script.onreadystatechange = null;
          callback();
        }
      };
    } else {
      script.onload = function() {
        callback();
      };
    }
    script.src = url;
    document.getElementsByTagName("head")[0].appendChild(script);
  }
  loadOneumScript("https://chat.oneum.io/eChat.js", function() {
    const chat = new window.eChat({
      key: '68503b2a378d24d52f94c15b',
      customization: 'electro'
    });
    chat.initialize();
  });
</script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
  (function(m, e, t, r, i, k, a) {
    m[i] = m[i] || function() {
      (m[i].a = m[i].a || []).push(arguments)
    };
    m[i].l = 1 * new Date();
    for (var j = 0; j < document.scripts.length; j++) {
      if (document.scripts[j].src === r) {
        return;
      }
    }
    k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
  })(window, document, 'script', 'https://mc.yandex.ru/metrika/tag.js', 'ym');

  ym(102715743, 'init', {
    webvisor: true,
    clickmap: true,
    accurateTrackBounce: true,
    trackLinks: true
  });
</script>
<noscript>
  <div><img src="https://mc.yandex.ru/watch/102715743" style="position:absolute; left:-9999px;" alt="" /></div>
</noscript>
<!-- /Yandex.Metrika counter -->
</body>

</html>
