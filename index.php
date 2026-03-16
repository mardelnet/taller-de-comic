<?php
$paged = get_query_var('paged') ? get_query_var('paged') : 1;

$args = [
    'post_type'      => 'post',
    'posts_per_page' => 8,
    'paged'          => $paged,
    'meta_key'       => 'fecha_de_publicacion',
    'orderby'        => 'meta_value',
    'order'          => 'DESC'
];

$query = new WP_Query($args);
?>

<?php get_header(); ?>

<main id="index">
    <header>
        <div class="overlay"></div>
        <div class="header-overlay"></div>
        <a href="/" target="_self">
            <h1><?php echo get_field("titulo_del_sitio_web", "options"); ?></h1>
            <h2><?php echo get_field("subtitulo_del_sitio_web", "options"); ?></h2>
        </a>
    </header>
    <div class="container">
        <div class="last">
            últimos trabajos:
        </div>
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
        <div class="pagination">
            <?php
            echo paginate_links([
                'total'   => $query->max_num_pages,
                'current' => $paged,
            ]);
            ?>
        </div>
        <?php wp_reset_postdata(); ?>
    </div>
</main>

<?php get_footer(); ?>