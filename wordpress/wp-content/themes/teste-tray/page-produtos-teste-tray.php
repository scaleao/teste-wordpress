<?php
/**
 * PÁGINA PRODUTOS
 *
 * @package WordPress
 * @subpackage Teste_Tray
 * @since Teste_Tray_2023
 */
get_header(); 
?>



<section class="main-conteudo">
    <?php 
            get_template_part('template-parts/post', 'produtos-itens');
    ?>
</section>

<?php get_footer();?>
<?php wp_footer(); ?>