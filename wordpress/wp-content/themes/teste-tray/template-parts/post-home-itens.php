<?php 
    $args = array('post_type' => 'post');
    $query = new WP_Query($args);
?>

<div class="post-home-container">
    <h2>CONHEÇA O CONTEUDO TRAY:</h2>
    <div class="post-home">
        <?php
        if($query->have_posts()):
            while($query->have_posts()): $query->the_post();
        ?>
            <a class="post-home_item" href="<?php echo get_permalink(); ?>">
                <img class="post-home_item_image"
                    src="<?php the_post_thumbnail_url(); ?>"
                >
                <div class="post-home_item_title">
                    <?php
                        $title = get_the_title();
                        $title_res = mb_substr($title, 0, 55);
                        echo $title_res . ' ...';
                    ?>
                </div>
                <div class="post-home_item_excerpt">
                    <?php 
                        $excerpt = get_the_excerpt(); 
                        $excerpt_res = substr($excerpt, 0, 80);
                        echo $excerpt_res . " [...]";
                    ?>
                </div>
            </a>
        <?php
            endwhile;
        endif;
        ?>

    </div>
</div>