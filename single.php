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

<?php get_header(); ?>

<main id="single">
    <a href="/" class="home-link" target="_self">
        <span>Inicio</span>
        <img src="<?php echo get_template_directory_uri() ;?>/assets/images/icon-home.png" />
    </a>
    <header style="background-image: url(<?php echo get_field('portada'); ?>)">
        <div class="overlay"></div>
        <div class="header-overlay"></div>
        <h1><?php echo esc_html( get_the_title() ); ?></h1>
    </header>
    <div class="container">
        <div class="last">
            <span>Autor:</span>
            <?php echo (!empty(get_field('autor'))) ? get_field('autor') : 'autor desconocido'; ?>
        </div>
        <div class="comic">
            <object data="<?php echo esc_url( get_field("comic_en_formato_pdf") ); ?>" type="application/pdf" width="100%">
                <p>El navegador no permite cargar el archivo PDF del cómic.</p>
                <a href="<?php echo esc_url( get_field("comic_en_formato_pdf") ); ?>">Descargar</a>
            </object>
            <div class="comic-data">
                <span>Fecha de Publicación:</span>
                <?php echo get_field("fecha_de_publicacion"); ?>
                <span>Detalles:</span>
                <?php echo get_field("detalles"); ?>
            </div>
        </div>
    </div>
    <section>
        <div class="container">
            <div class="items-container">
                <?php if ($query->have_posts()) : ?>
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <a href="<?php the_permalink(); ?>" target="_self">
                            <div class="item">
                                <div class="item-img">
                                    <div class="overlay"></div>
                                    <img src="<?php echo get_field('portada'); ?>" />
                                </div>
                                <div class="item-author">
                                    <?php echo (!empty(get_field('autor'))) ? get_field('autor') : 'autor desconocido'; ?>
                                </div>
                                <div class="item-title">
                                    <?php echo esc_html( get_the_title() ); ?>
                                </div>
                            </div>
                        </a>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <?php wp_reset_postdata(); ?>
        </div>
    </section>
</main>


<?php get_footer(); ?>