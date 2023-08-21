<?php
$views_current = intval(get_post_meta(get_the_ID(), 'product_views', true));
$views_soma = $views_current + 1;
$views_update = strval($views_soma);
update_post_meta(get_the_ID(), 'product_views', $views_update);
$url_product = get_post_meta(get_the_ID(), 'product_url', true);
header("Location: $url_product");
exit();
?>