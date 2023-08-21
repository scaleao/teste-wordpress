<?php
/* Plugin Name: Teste Tray API Description: Um plugin desenvolvido para consumir um endpoint de produtos */

function minha_api_endpoint()
{
    register_setting(
        'grupo_minhas_configuracoes',
        'endpoint_api_integracao',
    [
        'sanitize_callback' => function ($value) {
            if (!preg_match('/^https:\/\//', $value)) {
                add_settings_error(
                    'endpoint_api_integracao',
                    esc_attr('endpoint_api_integracao_error'),
                    'URL da API não esta no formato desejado',
                    'error'
                );
                return get_option('endpoint_api_integracao');
            }
            if (get_option('endpoint_api_integracao') == $value) {
                add_settings_error(
                    'endpoint_api_integracao',
                    esc_attr('endpoint_api_integracao_error'),
                    'URL da API já cadatrada',
                    'error'
                );
                return get_option('endpoint_api_integracao');
            }

            $api_url = $value;


            if ($api_url) {
                $response = wp_remote_get($api_url);

                if (is_array($response) && !is_wp_error($response)) {
                    $response_body = wp_remote_retrieve_body($response);
                    $decoded_response = json_decode($response_body, true); // Decodifica o JSON em um array associativo

                    if ($decoded_response) {
                        foreach($decoded_response['Products'] as $prod_data){
                            $product_data = $prod_data['Product'];

                            $new_product = array(
                                'post_title' => $product_data['name'],
                                'post_content' => '',
                                'post_status' => 'publish',
                                'post_type' => 'produtos_teste_tray'
                            );

                            try {
                                $product_id = wp_insert_post($new_product);

                                if ($product_id) {
                                    // Adicionar metadados do produto, como URL, imagem, preço, método de pagamento
                                    update_post_meta($product_id, 'product_url', $product_data['url']['https']);
                                    update_post_meta($product_id, 'product_image', $product_data['ProductImage'][0]['thumbs'][180]['https']);
                                    update_post_meta($product_id, 'product_price', $product_data['price']);
                                    update_post_meta($product_id, 'product_payment_method', $product_data['payment_option']);
                                    update_post_meta($product_id, 'product_views', '0');
                                }
                            }
                            catch (Exception $e) {
                                add_settings_error(
                                    'endpoint_api_integracao',
                                    esc_attr('endpoint_api_integracao_error'),
                                    'Erro ao inserir produto: '. $e->getMessage(),
                                    'error'
                                );
                            }
                        }
                    } else {
                        add_settings_error(
                            'endpoint_api_integracao',
                            esc_attr('endpoint_api_integracao_error'),
                            'Erro ao decodificar a resposta JSON.',
                            'error'
                        );
                    }
                } else {
                    add_settings_error(
                        'endpoint_api_integracao',
                        esc_attr('endpoint_api_integracao_error'),
                        'Erro ao fazer a requisição à API.',
                        'error'
                    );
                }
            } else {
                add_settings_error(
                    'endpoint_api_integracao',
                    esc_attr('endpoint_api_integracao_error'),
                    'Resposta da API não desejada.',
                    'error'
                );
            }

            return $value;
        },
    ]
    );

    add_settings_section(
        'minha_secao_api',
        'MInha Seção API',
        function ($args) {
        echo "<p>Insira a URL do endpoint da API Teste Tray</p>";
    },
        'grupo_minhas_configuracoes'
    );

    add_settings_field(
        'endpoint_api_integracao',
        'API TesteTray Produtos URL',
        function ($args) {
        $options = get_option('endpoint_api_integracao');
            ?>
            <input
                id="<?php echo esc_attr($args['label_for']); ?>"
                type="text"
                name="endpoint_api_integracao"
                value="<?php echo esc_attr($options); ?>"
            >
            <?php
    },
        'grupo_minhas_configuracoes',
        'minha_secao_api',
    [
        'label_for' => 'endpoint_api_integracao_id'
    ]
    );
}
add_action('admin_init', 'minha_api_endpoint');

function configuracao_menu_api_tray()
{
    //admin_menu_page
    add_options_page(
        'Configuração URL API Teste Tray',
        'API TesteTray',
        'manage_options',
        'api-teste-tray',
        'configuracoes_api_teste_tray_html'
    );
}
add_action('admin_menu', 'configuracao_menu_api_tray');

// function meu_plugin_menu() {
//     add_menu_page(
//         'Configuração URL API Teste Tray',
//         'API TesteTray',
//         'manage_options',
//         'api-teste-tray',
//         'configuracoes_api_teste_tray_html' 
//     );
// }
// add_action('admin_menu', 'meu_plugin_menu');

// Função para registrar o Custom Post Type
function registrar_custom_post_type_produtos_teste()
{
    $labels = array(
        'name' => 'Produtos TesteTray',
        'singular_name' => 'Produto Teste',
        // Adicione mais rótulos conforme necessário
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'menu_position' => 0,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        // Adicione mais argumentos conforme necessário
    );

    register_post_type('produtos_teste_tray', $args);
}
add_action('init', 'registrar_custom_post_type_produtos_teste');

function configuracoes_api_teste_tray_html()
{
?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <form action="options.php" method="post">
                <?php
                    settings_fields('grupo_minhas_configuracoes');
                    do_settings_sections('grupo_minhas_configuracoes');
                    submit_button();
                ?>
            </form>
        </div>
    <?php
}