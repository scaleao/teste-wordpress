<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<section class="navigation">
    <div class="nav-container">
        <div class="brand">
            <?php
                the_custom_logo();
            ?>
        </div>
        <nav>
            <div class="nav-mobile">
                <a id="nav-toggle" href="#!"><span></span></a>
            </div>
            <ul class="nav-list">
                <?php 
                    wp_nav_menu(
                        array('menu' => 'menu-navegacao')
                    )
                ?>
            </ul>
        </nav>
    </div>
</section>