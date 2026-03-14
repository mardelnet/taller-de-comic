<?php get_header(); ?>

<main id="single">
    <div class="container">
        <a href="/" class="home-link" target="_self">
            <img src="<?php echo get_template_directory_uri() ;?>/assets/images/icon-home.png" />
        </a>
        <section>
            <article>
                <h1 class="hide-desktop">
                    <?php echo get_the_title(); ?>
                </h1>
                <div class="comic-data hide-desktop">
                    <div><span>Autor:</span> <?php echo get_field("autor"); ?></div>
                    <div><span>Fecha de Publicación:</span> <?php echo get_field("fecha_de_publicacion"); ?></div>
                </div>
                <div class="social hide-desktop">
                    <div class="social-download">
                        <a target="_blank" href="<?php echo esc_url( get_field("comic_en_formato_pdf") ); ?>">
                            Descargar
                        </a>
                    </div>
                </div>
                <object data="<?php echo esc_url( get_field("comic_en_formato_pdf") ); ?>" type="application/pdf" width="100%"></object>
                <p><?php echo get_field("detalles"); ?></p>
            </article>
            <aside>
                <header class="hide-mobile">
                    <h1>
                        <?php echo get_the_title(); ?>
                    </h1>
                    <div class="comic-data">
                        <div><span>Autor:</span> <?php echo get_field("autor"); ?></div>
                        <div><span>Fecha de Publicación:</span> <?php echo get_field("fecha_de_publicacion"); ?></div>
                    </div>
                    <p><?php echo get_field("detalles"); ?></p>
                </header>
                <div class="social hide-mobile">
                    <div class="social-download">
                        <a target="_blank" href="<?php echo esc_url( get_field("comic_en_formato_pdf") ); ?>">
                            Descargar
                        </a>
                    </div>
                </div>
            </aside>
        </section>
        <div>
            <p class="ver-mas">Ver más:</p>

            <?php
            $args = [
                'post_type'      => 'post',
                'posts_per_page' => 4,
                'meta_key'       => 'fecha_de_publicacion',
                'orderby'        => 'meta_value',
                'order'          => 'DESC',
                'post__not_in'   => [ get_the_ID() ],
            ];
            $query = new WP_Query($args);
            ?>

            <div class="items-container">
                <?php if ($query->have_posts()) : ?>
                    <?php while ($query->have_posts()) : $query->the_post(); ?>

                        <a href="<?php the_permalink(); ?>" target="_self">
                            <div class="item">
                                <div class="item-overlay"></div>

                                <div class="item-data">
                                    <div class="item-data--title">
                                        <?php the_title(); ?>
                                    </div>
                                </div>

                                <img class="item-img" src="<?php echo get_field('portada'); ?>" />
                            </div>
                        </a>

                    <?php endwhile; ?>
                <?php endif; ?>
            </div>

            <?php wp_reset_postdata(); ?>
        </div>
        <div class="foot">
            <?php echo get_field("pie_de_pagina", "options"); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>