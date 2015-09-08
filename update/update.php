<?php

class Smashing_Updater {

  private $file;

  private $theme;

  private $basename;

  private $active;

  private $username;

  private $repository;

  private $authorize_token;

  private $github_response;

  public function __construct( $file ) {

    $this->file = $file;

    add_action( 'admin_init', array( $this, 'set_theme_properties' ) );

    return $this;
  }

  public function set_theme_properties() {
    $this->theme = get_theme_data( $this->file );
    $this->basename = theme_basename( $this->file );
    $this->active = is_theme_active( $this->basename );
  }

  public function set_username( $username ) {
    $this->username = $username;
  }

  public function set_repository( $repository ) {
    $this->repository = $repository;
  }

  public function authorize( $token ) {
    $this->authorize_token = $token;
  }

  private function get_repository_info() {
      if ( is_null( $this->github_response ) ) { // Do we have a response?
          $request_uri = sprintf( 'https://api.github.com/repos/%s/%s/releases', $this->username, $this->repository ); // Build URI
          
          if( $this->authorize_token ) { // Is there an access token?
              $request_uri = add_query_arg( 'access_token', $this->authorize_token, $request_uri ); // Append it
          }        
          
          $response = json_decode( wp_remote_retrieve_body( wp_remote_get( $request_uri ) ), true ); // Get JSON and parse it
          
          if( is_array( $response ) ) { // If it is an array
              $response = current( $response ); // Get the first item
          }
          
          if( $this->authorize_token ) { // Is there an access token?
              $response['zipball_url'] = add_query_arg( 'access_token', $this->authorize_token, $response['zipball_url'] ); // Update our zip url with token
          }
          
          $this->github_response = $response; // Set it to our property  
      }
  }

  public function initialize() {
    add_filter( 'pre_set_site_transient_update_themes', array( $this, 'modify_transient' ), 10, 1 );
    add_filter( 'themes_api', array( $this, 'theme_popup' ), 10, 3);
    add_filter( 'upgrader_post_install', array( $this, 'after_install' ), 10, 3 );
  }

  public function modify_transient( $transient ) {
    
    if( property_exists( $transient, 'checked') ) { // Check if transient has a checked property
      
      if( $checked = $transient->checked ) { // Did Wordpress check for updates?
  
        $this->get_repository_info(); // Get the repo info
  
        $out_of_date = version_compare( $this->github_response['tag_name'], $checked[ $this->basename ] ); // Check if we're out of date
  
        if( $out_of_date ) {
  
          $new_files = $this->github_response['zipball_url']; // Get the ZIP
          
          $slug = current( explode('/', $this->basename ) ); // Create valid slug
          
          $theme = array( // setup our theme info
            'url' => $this->theme["themeURI"],
            'slug' => $slug,
            'package' => $new_files,
            'new_version' => $this->github_response['tag_name']
          );
  
          $transient->response[$this->basename] = (object) $theme; // Return it in response
        }
      }
    }

    return $transient; // Return filtered transient
  }

  public function theme_popup( $result, $action, $args ) {

    if( ! empty( $args->slug ) ) { // If there is a slug

      if( $args->slug == $this->basename ) { // And it's our slug

        $this->get_repository_info(); // Get our repo info

        // Set it to an array
        $theme = array(
          'name'        => $this->theme["Name"],
          'slug'        => $this->basename,
          'version'     => $this->github_response['tag_name'],
          'author'      => $this->theme["AuthorName"],
          'author_profile'  => $this->theme["AuthorURI"],
          'last_updated'    => $this->github_response['published_at'],
          'homepage'      => $this->theme["themeURI"],
          'short_description' => $this->theme["Description"],
          'sections'      => array( 
            'Description' => $this->theme["Description"],
            'Updates'   => $this->github_response['body'],
          ),
          'download_link'   => $this->github_response['zipball_url']
        );

        return (object) $theme; // Return the data
      }

    } 
    return $result; // Otherwise return default
  }

  public function after_install( $response, $hook_extra, $result ) {
    global $wp_filesystem; // Get global FS object

    $install_directory = theme_dir_path( $this->file ); // Our theme directory 
    $wp_filesystem->move( $result['destination'], $install_directory ); // Move files to the theme dir
    $result['destination'] = $install_directory; // Set the destination for the rest of the stack

    if ( $this->active ) { // If it was active
      activate_theme( $this->basename ); // Reactivate
    }

    return $result;
  }
}