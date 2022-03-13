<?php

class AdminForm {
    function __construct() {
        add_action('admin_init', array($this, 'admin_init_callback'));
    }

    function admin_init_callback() {
        // https://developer.wordpress.org/reference/functions/register_setting/
        register_setting (
            CCF::SLUG, // slug-name, page name, group name
            CCF::OPTIONS // option data to sanitize and save
        );

        // https://developer.wordpress.org/reference/functions/add_settings_section/
        add_settings_section (
            'section_one', // section id
            __('E-mail setting.', CCF::TEXT_DOMAIN), // section title
            array($this, 'section_one_callback'), //callback, content between heading and fields
            CCF::SLUG // A settings group name defined in register_setting
        );
    
        // https://developer.wordpress.org/reference/functions/add_settings_field/
        add_settings_field (
            'email_field', // field id
            __('E-mail', CCF::TEXT_DOMAIN), // title of the field (left side)
            array($this, 'email_field_callback'), // callback fills the field with form inputs (right side)
            CCF::SLUG, // The slug-name of the settings page
            'section_one', // section id
            array( // Extra arguments used when outputting the field
                'label_for'         => 'email_field',
                'class'             => 'ccf_row',
                'ccf_custom_data' => 'custom-data',
            )
        );
    }

    function section_one_callback( $args ) {
        ?>
        <p id = "<?php echo esc_attr( $args['id'] ); ?>">
            <?php 
            esc_html_e('- Fill in the e-mail where the message will be sent to.', CCF::TEXT_DOMAIN); 
            echo "<br>";
            esc_html_e('- Insert the shortcode: [' . CCF::SHORTCODE . '] in a page', CCF::TEXT_DOMAIN); 

            ?>
        </p>
        <?php
    }

    function email_field_callback() {
        if(!empty(get_option(CCF::OPTIONS))) {
            $options = get_option(CCF::OPTIONS);
            $email = array_key_exists('email', $options) ? $options['email'] : get_bloginfo('admin_email');
        } else {
            $email = get_bloginfo('admin_email');
        }
        $name = CCF::OPTIONS . '[email]';
        ?>
        
        <input type = "email" name = "<?php echo $name ?>" id = "email" value = "<?php echo $email ?>" size = "50">
        <p class="description">
            <?php esc_html_e('Please insert a valid e-mail', CCF::TEXT_DOMAIN); ?>
        </p>
        <?php
    }
}
