<?php
/**
 * PÁGINA INICIAL
 *
 * @package WordPress
 * @subpackage Teste_Tray
 * @since Teste_Tray_2023
 */
?>

<?php get_header(); ?>

<section class="main-conteudo">
    <?php 
            get_template_part('template-parts/post', 'home-itens');
    ?>
</section>

<?php get_footer(); ?>