<?php 
    $args = array(
        'post_type' => 'produtos_teste_tray',
        'posts_per_page' => 6,  // Número de produtos por página
        'paged' => get_query_var('paged') ? get_query_var('paged') : 1 // Página atual
    );
    $query = new WP_Query($args);
?>

<div class="post-produtos-container">
    <h2>CONHEÇA O PRODUTOS TRAY:</h2>
    <div class="post-produtos">
        <?php
        if($query->have_posts()):
            while($query->have_posts()): $query->the_post();
        ?>
            <a class="post-produtos_item" href="<?php echo get_permalink(); ?>">
                <img class="post-produtos_item_image"
                    src="<?php echo get_post_meta(get_the_ID(), 'product_image', true); ?>"
                >
                <div class="post-produtos_item_title">
                    <?php
                        the_title();
                    ?>
                </div>
                <div class="post-produtos_item_container">
                    <div class="post-produtos_item_container_price">
                        <?php 
                            echo get_post_meta(get_the_ID(), 'product_price', true);
                        ?>
                    </div>
                    <div class="post-produtos_item_container_view">
                        <?php 
                            echo 'View: ' . get_post_meta(get_the_ID(), 'product_views', true);
                        ?>
                    </div>
                </div>
                <div class="post-produtos_item_excerpt">
                    <?php 
                        echo get_post_meta(get_the_ID(), 'product_payment_method', true);
                    ?>
                </div>
            </a>
        <?php
            endwhile;
        endif;
        ?>

    </div>
    <div class="products-pagination">
    <?php 
        echo paginate_links(array(
            'total' => $query->max_num_pages,
            'current' => max(1, get_query_var('paged')),
        ));
    ?>
    </div>
</div>
