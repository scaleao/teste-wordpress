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
<?php
if (have_posts()) :
			// Start the Loop.
            var_dump(get_post_type());
			while(have_posts()) : the_post();
				switch( get_post_type() ) {
					case 'produtos_teste-tray':
						get_template_part('template-parts/content/content', 'single-produtos_teste-tray');
						break;

					default:
						get_template_part('template-parts/content', 'single');
						break;
				}
            endwhile;
        endif;
?>


<?php get_footer(); ?>