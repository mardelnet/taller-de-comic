<?php get_header(); ?>

<main id="index">
    <div class="container">
        <header>
            <a href="/" target="_self">
                <h1><?php echo get_field("titulo_del_sitio_web", "options"); ?></h1>
            </a>
        </header>

        <?php
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;

        $args = [
            'post_type'      => 'post',
            'posts_per_page' => 12,
            'paged'          => $paged,
            'meta_key'       => 'fecha_de_publicacion',
            'orderby'        => 'meta_value',
            'order'          => 'DESC'
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

        <div class="pagination">
            <?php
            echo paginate_links([
                'total'   => $query->max_num_pages,
                'current' => $paged,
            ]);
            ?>
        </div>

        <?php wp_reset_postdata(); ?>
        
        <div class="foot">
            <?php echo get_field("pie_de_pagina", "options"); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>