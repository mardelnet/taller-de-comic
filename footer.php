    <footer>
      <div class="container">
        <a class="title" href="/" target="_self">
            <?php echo get_field("titulo_del_sitio_web", "options"); ?>
        </a>
        <?php echo get_field("pie_de_pagina", "options"); ?>
        <?php echo do_shortcode('[addtoany]'); ?>
      </div>
    </footer>
    <?php wp_footer(); ?>
  </body>
</html>