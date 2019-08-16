<?php
/**
 * Add a custom options page.
 */
function rl_libguides_cache_add_options_page() {
  add_options_page(
    __( 'LibGuides Cache Settings', 'rl_libguides_cache' ),
    __( 'LibGuides Cache Settings', 'rl_libguides_cache' ),
    'manage_options',
    'rl_libguides_cache',
    'rl_libguides_cache_render_options_page_callback'
  );
}
add_action( 'admin_menu', 'rl_libguides_cache_add_options_page' );

/**
 * Callback function to render custom options page.
 */
function rl_libguides_cache_render_options_page_callback() {
  ?>
    <form method="POST" action="options.php">
      <?php 
      settings_fields( 'rl_libguides_cache' );
      do_settings_sections( 'rl_libguides_cache' );
      submit_button(); 
      ?>
    </form>
  <?php
}

/**
 * Register and initialize settings for the plugin.
 */
function rl_libguides_cache_settings_init() {
  $settings_section = 'rl_libguides_cache-main';
  $settings_page = 'rl_libguides_cache';

  add_settings_section(
    $settings_section,
    'Settings for LibGuides Cache plugin',
    'rl_libguides_cache_settings_section_main_callback',
    $settings_page
  );

  add_settings_field(
    'rl_libguides_cache-site_id',
    'LibGuides Site ID',
    'rl_libguides_cache_site_id_callback',
    $settings_page,
    $settings_section,
    array( 'label_for' => 'rl_libguides_cache-site_id' )
  );

  add_settings_field(
    'rl_libguides_cache-api_key',
    'LibGuides API Key',
    'rl_libguides_cache_api_key_callback',
    $settings_page,
    $settings_section,
    array( 'label_for' => 'rl_libguides_cache-api_key' )
  );

  $site_id_setting_args = array(
    'type' => 'string',
    'default' => '',
    'description' => ''
  );
  register_setting($settings_page, 'rl_libguides_cache-site_id', $site_id_setting_args);

  
  $api_key_setting_args = array(
    'type' => 'string',
    'default' => '',
    'description' => ''
  );
  register_setting($settings_page, 'rl_libguides_cache-api_key', $api_key_setting_args);


}
add_action( 'admin_init', 'rl_libguides_cache_settings_init' );

/**
 * Callback function to render settings section html
 */
function rl_libguides_cache_settings_section_main_callback() {
  echo '';
}

/**
 * Callback functions to render settings
 */
function rl_libguides_cache_site_id_callback( $args ) {
  $setting_id = 'rl_libguides_cache-site_id';
  $setting_value = esc_attr( get_option( 'rl_libguides_cache-site_id' ) );
  echo <<<setting_html
  <input type="text" id="{$setting_id}" name="{$setting_id}" value="{$setting_value}" />
  <p class="description">{$args[0]}</p>  
setting_html;
}

function rl_libguides_cache_api_key_callback( $args ) {
  $setting_id = 'rl_libguides_cache-api_key';
  $setting_value = esc_attr( get_option( 'rl_libguides_cache-api_key' ) );
  echo <<<setting_html
  <input type="text" id="{$setting_id}" name="{$setting_id}" value="{$setting_value}" />
  <p class="description">{$args[0]}</p>  
setting_html;
}