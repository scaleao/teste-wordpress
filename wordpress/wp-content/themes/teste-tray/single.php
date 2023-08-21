<?php
/**
 * SINGLE - Detalhe internas
 *
 * @package WordPress
 * @subpackage Teste_tray
 * @since Teste_Tray_2023
 */
?>

<?php get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="bloco-conteudo">
        <div class="bloco-destaque">
            <img class="post-image" src="<?php the_post_thumbnail_url() ?>">
            <div class="post-title-content">
                <div class="post-date"><?php echo get_the_date('d \d\e F \d\e Y'); ?></div>
                <h1 class="post-title"><?php the_title(); ?></h1>
                <div class="post-author">
                    ESCRITO POR:
                    <strong><?php echo get_the_author_meta('first_name', $post->post_author) ?></sctrong>
                </div>
            </div>
        </div>
        <div class="post-content">
            <?php 
                echo apply_filters('the_content', get_the_content());
            ?>
        </div>
        
    </div>

    <a href="/produtos-teste-tray" class="chamada-produtos">Conheça nossos produtos</a>
</article>


<?php get_footer(); ?>