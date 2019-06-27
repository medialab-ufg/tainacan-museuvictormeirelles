<?php


function get_mvm_default_options() {
    
    // Coloquei aqui o nome e o valor padrão de cada opção que você criar
    
    return array(
        'main_collection_id' => '',
    );

}

function mvm_options_menu() {
    

    $topLevelMenuLabel = 'Opções do Museu';
    $page_title = 'Opções';
    $menu_title = 'Opções';
    
    /* Top level menu */
    add_submenu_page('mvm_options', $page_title, $menu_title, 'customize', 'mvm_options', 'mvm_options_page_callback_function');
    add_menu_page($topLevelMenuLabel, $topLevelMenuLabel, 'customize', 'mvm_options', 'mvm_options_page_callback_function');

    
}

function mvm_options_validate_callback_function($input) {

    // Se necessário, faça aqui alguma validação ao salvar seu formulário
    return $input;

}



function mvm_options_page_callback_function() {
    
    // Crie o formulário. Abaixo você vai ver exemplos de campos de texto, textarea e checkbox. Crie quantos você quiser

	$dropdown_args = array(
        'post_type'        => 'tainacan-collection',
        'selected'         => get_theme_option('main_collection_id'),
        'name'             => 'mvm_options[main_collection_id]',
    );
	
?>
  <div class="wrap span-20">
    <h2>Opções do Museu Victor Meirelles</h2>

    <form action="options.php" method="post" class="clear prepend-top">
      <?php settings_fields('mvm_options_options'); ?>
      <?php $options = wp_parse_args( get_option('mvm_options'), get_mvm_default_options() );?>
      
      <div class="span-20 ">
        
        <h3>Itens Relacionados</h3>
        
        <div class="span-6 last">
          
          <p>Informe qual é a coleção de obras. Nas páginas dos itens de outras coleções, como autores, aparecerão a lista de obras relacionadas</p>
		  
          <label for="wellcome_title"><strong>Coleção principal</strong></label><br/>
		  
		  <?php wp_dropdown_pages($dropdown_args); ?>

          
        </div>
      </div>
      
      <p class="textright clear prepend-top">
        <input type="submit" class="button-primary" value="Salvar" />
      </p>
    </form>
  </div>

<?php } 

function get_theme_option($option_name) {
    $option = wp_parse_args( 
                    get_option('mvm_options'), 
                    get_mvm_default_options()
                );
    return isset($option[$option_name]) ? $option[$option_name] : false;
}

add_action('admin_init', 'mvm_options_init');
add_action('admin_menu', 'mvm_options_menu');

function mvm_options_init() {
    register_setting('mvm_options_options', 'mvm_options', 'mvm_options_validate_callback_function');
}
