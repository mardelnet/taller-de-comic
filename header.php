<?php
$title = is_home() || is_front_page() ? get_field("titulo_del_sitio_web", "options") : get_the_title();
$description = get_field("descripcion", "options");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="<?php echo $description; ?>">
    <title><?php echo $title; ?></title>
    <link rel="icon" href="<?php echo get_field("favicon", "options"); ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/main.css">

    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo $title; ?>" />
    <meta property="og:url" content="<?php echo get_permalink(); ?>" />
    <meta property="og:image" content="<?php echo get_field("favicon", "options"); ?>" />
    <meta property="og:description" content="<?php echo $description; ?>" />

    <meta name="twitter:title" content="<?php echo $title; ?>">
    <meta name="twitter:description" content="<?php echo $description; ?>">
    <meta name="twitter:image" content="<?php echo get_field("favicon", "options"); ?>">
    <meta name="twitter:url" content="<?php echo get_permalink(); ?>">

    <?php wp_head(); ?>
  </head>
  <body>