    <footer>
      <div class="container">
        <a class="title" href="/" target="_self">
            <?php echo get_field("titulo_del_sitio_web", "options"); ?>
        </a>
        <div class="cols">
          <?php if (!empty(get_field("pie_de_pagina", "options"))) : ?>
            <div><?php echo get_field("pie_de_pagina", "options"); ?></div>
          <?php endif; ?>

          <?php if (!empty(get_field("pie_de_pagina_col_2", "options"))) : ?>
            <div><?php echo get_field("pie_de_pagina_col_2", "options"); ?></div>
          <?php endif; ?>
          
          <?php if (!empty(get_field("pie_de_pagina_col_3", "options"))) : ?>
            <div><?php echo get_field("pie_de_pagina_col_3", "options"); ?></div>
          <?php endif; ?>
        </div>
        <?php echo do_shortcode('[addtoany]'); ?>
      </div>
    </footer>
    <?php wp_footer(); ?>
  </body>
</html>