<?php
/******************
 * Login Form
 ******************/
// login action hook - catches form submission and acts accordingly
add_action('init','sandbox_login');
function sandbox_login() {
  global $sandbox_error;
  $sandbox_error = false;
  if (isset($_POST['username']) && isset($_POST['password'])) {
    $creds = array();
    $creds['user_login'] = $_POST['username'];
    $creds['user_password'] = $_POST['password'];
    $user = wp_signon( $creds, false );
    if ( is_wp_error($user) ) {
      $sandbox_error = $user->get_error_message();
    } else {
      if (isset($_POST['redirect']) && $_POST['redirect']) {
        wp_redirect($_POST['redirect']);
		exit();
      }
    }
  }
}

// shows error message
function get_sandbox_error() {
  global $sandbox_error;
  if ($sandbox_error) {
    $return = $sandbox_error;
    $sandbox_error = false;
    return $return;
  } else {
    return false;
  }
}
// shows login form (or a message, if user already logged in)
function get_sandbox_login_form($redirect) { 
  if (!is_user_logged_in()) {
    $return  = "<div class=\"sandbox-login sandbox-form popup-inner\">";
    $return .= "<a href=\"#\" class=\"popup-close otbtn-close\"><i class=\"uil uil-times\"></i></a>";
    if( sandbox_get_option('login_title') )
      $return .= "<h2 class=\"mb-3 text-start\">".sandbox_get_option('login_title')."</h2>";
    if( sandbox_get_option('login_sub') )
      $return .= "<p class=\"lead mb-6 text-start\">".sandbox_get_option('login_sub')."</p>";
    $error   = get_sandbox_error();
    if ($error)
      $return .= "<p class=\"error text-start\">{$error}</p>\r\n";
    $return .= "<form action=\"\" method=\"post\">\r\n";
    $return .= "<p class=\"form-floating\">
      <input type=\"text\" class=\"form-control\" name=\"username\" placeholder=\"".esc_html__('Email or Username','sandbox')."\" value=\"".(isset($_POST['username'])?$_POST['username']:"")."\" required />
    <label>".esc_html__('Email or Username','sandbox')."</label></p>\r\n";
    $return .= "<p class=\"form-floating password-field\">
      <input type=\"password\" class=\"form-control\" name=\"password\" placeholder=\"".esc_html__('Password','sandbox')."\"required />
      <span class=\"password-toggle\"><i class=\"uil uil-eye uil-eye-slash\"></i></span>
      <label>".esc_html__('Password','sandbox')."</label>
    </p>\r\n";
    if ($redirect)
      $return .= "<input type=\"hidden\" name=\"redirect\" value=\"{$redirect}\">\r\n";
    $return .= "<input type=\"submit\"class=\"octf-btn\"  value=\"".esc_html__('Sign In','sandbox')."\"/>\r\n";
    $return .= "</form>\r\n";
    $return .= "<p class=\"mb-1\"><a class=\"hover\" href=\"".esc_url( wp_lostpassword_url() )."\">".esc_html__( 'Forgot Password?', 'sandbox' )."</a></p>";
    $return .= "<p class=\"mb-0\">".esc_html__( 'Don\'t have an account? ', 'sandbox' )."<a class=\"hover user-btn\" href=\"".esc_url( "#signup" )."\">".esc_html__( 'Sign up', 'sandbox' )."</a></p></div>";
  } else {
    $return = "<p class=\"mx-auto white\">".esc_html__('User is already logged in. ','sandbox')."<a class=\"hover\" href=\"".wp_logout_url(home_url())."\">".esc_html__('Log out?','sandbox')."</a></p>";
  }
  return $return;
}

// adds a handy [sandbox_login] shortcode to use in posts/pages
add_shortcode('sandbox_login','sandbox_login_shortcode');
function sandbox_login_shortcode ($atts,$content=false) {
  $atts = shortcode_atts(array(
    'redirect' => home_url()
  ), $atts);
  return get_sandbox_login_form($atts['redirect']);
}

/*********************
 * Register Form
 ********************/
function sandbox_registration_form() {
 
  // only show the registration form to non-logged-in members
  if(!is_user_logged_in()) {

    // check if registration is enabled
    $registration_enabled = get_option('users_can_register');
 
    // if enabled
    if($registration_enabled) {
      $output = sandbox_registration_fields();
    } else {
      $output = esc_html__('User registration is not enabled');
    }
  } else {
    $output = "<p class=\"mx-auto white\">".esc_html__('User is already logged in. ','sandbox')."<a class=\"hover\" href=".wp_logout_url(home_url()).">".esc_html__('Log out?','sandbox')."</a></p>";
  }
  return $output;
}
// adds a handy [sandbox_register] shortcode to use in posts/pages
add_shortcode('sandbox_register', 'sandbox_registration_form');

// registration form fields
function sandbox_registration_fields() {
  
  ob_start(); ?>  
    
    <div class="sandbox-register sandbox-form popup-inner">
      <a href="#" class="popup-close otbtn-close"><i class="uil uil-times"></i></a>
      <h2 class="mb-3 text-start"><?php echo sandbox_get_option('regis_title'); ?></h2>
      <p class="lead mb-6 text-start"><?php echo sandbox_get_option('regis_sub'); ?></p>
      <?php sandbox_register_messages(); ?>
      <form action="" method="POST">
          <p class="form-floating">
            <input name="sandbox_user_name" class="form-control" type="text" placeholder="Username" required />
            <label><?php esc_html_e('Username', 'sandbox'); ?></label>
          </p>
          <p class="form-floating">
            <input name="sandbox_user_email" class="form-control" type="email" placeholder="Email" required />
            <label><?php esc_html_e('Email', 'sandbox'); ?></label>
          </p>
          <p class="form-floating password-field">
            <input name="sandbox_user_pass" class="form-control" type="password" placeholder="Password" required />
            <span class="password-toggle"><i class="uil uil-eye uil-eye-slash"></i></span>
            <label><?php esc_html_e('Password', 'sandbox'); ?></label>
          </p>
          <p class="form-floating password-field">
            <input name="sandbox_user_pass_confirm" class="form-control" type="password" placeholder="Confirm Password" required />
            <span class="password-toggle"><i class="uil uil-eye uil-eye-slash"></i></span>
            <label><?php esc_html_e('Confirm Password', 'sandbox'); ?></label>
          </p>
          <p>
            <input type="hidden" name="sandbox_csrf" value="<?php echo wp_create_nonce('sandbox-csrf'); ?>"/>
            <input type="submit" class="octf-btn" value="<?php esc_html_e('Sign Up', 'sandbox'); ?>"/>
          </p>
          <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
      </form>
      <p class="mb-0"><?php esc_html_e( 'Already have an account? ', 'sandbox' ); ?><a class="hover user-btn" href="#signin">Sign in</a></p>
    </div>
  <?php
  return ob_get_clean();
}

// register a new user
function sandbox_add_new_user() {
    if (isset( $_POST["sandbox_user_name"] ) && wp_verify_nonce($_POST['sandbox_csrf'], 'sandbox-csrf')) {
      $user_login   = $_POST["sandbox_user_name"];
      $user_email   = $_POST["sandbox_user_email"];
      $user_pass    = $_POST["sandbox_user_pass"];
      $pass_confirm = $_POST["sandbox_user_pass_confirm"];
      
      // this is required for username checks
      require_once(ABSPATH . WPINC . '/registration.php');
      
      if(username_exists($user_login)) {
          // Username already registered
          sandbox_regis_errors()->add('username_unavailable',__('Username already taken', 'sandbox'));
      }
      if(!validate_username($user_login)) {
          // invalid username
          sandbox_regis_errors()->add('username_invalid',__('Invalid username', 'sandbox'));
      }
      if(!is_email($user_email)) {
          //invalid email
          sandbox_regis_errors()->add('email_invalid',__('Invalid email', 'sandbox'));
      }
      if(email_exists($user_email)) {
          //Email address already registered
          sandbox_regis_errors()->add('email_used',__('Email already registered', 'sandbox'));
      }
      if($user_pass != $pass_confirm) {
          // passwords do not match
          sandbox_regis_errors()->add('password_mismatch',__('Passwords don\'t match', 'sandbox'));
      }
      
      $errors = sandbox_regis_errors()->get_error_messages();
      
      // if no errors then cretate user
      if(empty($errors)) {
          
          $new_user_id = wp_insert_user(array(
                  'user_login'    => $user_login,
                  'user_pass'     => $user_pass,
                  'user_email'    => $user_email,
                  'user_registered' => date('Y-m-d H:i:s'),
                  'role'        => 'subscriber'
              )
          );
          if($new_user_id) {
              // send an email to the admin
              wp_new_user_notification($new_user_id);
              
              // log the new user in
              wp_setcookie($user_login, $user_pass, true);
              wp_set_current_user($new_user_id, $user_login); 
              do_action('wp_login', $user_login);
              
              // send the newly created user to the home page after logging them in
              wp_redirect(home_url()); exit;
          }
          
      }
  
  }
}
add_action('init', 'sandbox_add_new_user');

// used for tracking error messages
function sandbox_regis_errors(){
    static $wp_error; // global variable handle
    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}

// displays error messages from form submissions
function sandbox_register_messages() {
  if($codes = sandbox_regis_errors()->get_error_codes()) {
    echo '<p class="sandbox_regis_errors text-start">';
        // Loop error codes and display errors
       foreach($codes as $code){
            $message = sandbox_regis_errors()->get_error_message($code);
            echo '<span class="error"><strong>' . esc_html__('Error', 'sandbox') . '</strong>: ' . $message . '</span><br/>';
        }
    echo '</p>';
  } 
}