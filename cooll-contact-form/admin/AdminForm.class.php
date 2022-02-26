<?php

class AdminForm {
    function __construct($slug, $options) {
        $this->slug = $slug;
        $this->options = $options;
        add_action('admin_init', array($this, 'admin_init_callback'));
    }

    function admin_init_callback() {
        // https://developer.wordpress.org/reference/functions/register_setting/
        register_setting (
            $this->slug, // slug-name, page name, group name
            $this->options // option data to sanitize and save
        );
    
        // https://developer.wordpress.org/reference/functions/add_settings_section/
        add_settings_section (
            'section_one', // section id
            __('E-mail setting.', 'cool-domain'), // section title
            array($this, 'section_one_callback'), //callback, content between heading and fields
            $this->slug // A settings group name defined in register_setting
        );
    
        // https://developer.wordpress.org/reference/functions/add_settings_field/
        add_settings_field (
            'email_field', // field id
            __('E-mail', 'cool-domain'), // title of the field (left side)
            array($this, 'email_field_callback'), // callback fills the field with form inputs (right side)
            $this->slug, // The slug-name of the settings page
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
        <p id="<?php echo esc_attr( $args['id'] ); ?>">
            <?php esc_html_e('Fill in the e-mail where the message will be sent to.', 'cool-domain'); ?>
        </p>
        <?php
    }

    function email_field_callback() {
        if(!empty(get_option($this->options))) {
            $options = get_option($this->options);
            $email = array_key_exists('email', $options) ? $options['email'] : get_bloginfo('admin_email');
        } else {
            $email = get_bloginfo('admin_email');
        }
        $name = $this->options . '[email]';
        ?>
        
        <input type = "email" name = "<?php echo $name ?>" id = "email" value = "<?php echo $email ?>" size = "50">
        <p class="description">
            <?php esc_html_e('Please insert a valid e-mail', 'cool-domain' ); ?>
        </p>
        <?php
    }
}
