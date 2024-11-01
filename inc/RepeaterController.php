<?php 
/**
 * @package Travel_Company_Helper
 */

add_action( 'customize_register', 'travel_company_helper_frontpage_settings_register' );

function travel_company_helper_frontpage_settings_register( $wp_customize ) {

require_once('ClassSettingsRepeater.php');
require_once('ClassControlRepeater.php');
require_once('CustomizeDropdownTaxonomiesControl.php');
/**
 * Add Frontpage Settings Panel
 *
 * @since 1.0.0
 */
$wp_customize->add_panel(
    'travel_company_frontpage_settings_panel',
    array(
        'priority'       => 20,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __( 'Frontpage Settings', 'travel-company-helper' ),
    )
);

/*----------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Frontpage About section
 *
 * @since 1.0.0
 */

$wp_customize->add_section(
    'travel_company_frontpage_about_section',
    array(
        'priority'       => 1,
        'panel'          => 'travel_company_frontpage_settings_panel',
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __( 'About Section', 'travel-company-helper' ),
        'description'    => __( 'Managed the about display at Frontpage section.', 'travel-company-helper' ),
    )
);

//About Enable/Disable
$wp_customize->add_setting( 'travel_company_about_enable', array(
    'capability'            => 'edit_theme_options',
    'default'               => 0,
    'sanitize_callback'     => 'travel_company_sanitize_checkbox'
) );

$wp_customize->add_control( 'travel_company_about_enable', array(
    'label'                 =>  __( 'Enable/Disable  about section', 'travel-company-helper' ),
    'section'               => 'travel_company_frontpage_about_section',
    'type'                  => 'checkbox',
    'settings'              => 'travel_company_about_enable',
) );

/** About Text */
$wp_customize->add_setting(
    'travel_company_about_text',
    array(
        'default'           => __( 'About Company', 'travel-company-helper' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage'
    )
);

$wp_customize->add_control(
    'travel_company_about_text',
    array(
        'label'    => __( 'About title line text', 'travel-company-helper' ),
        'section'  => 'travel_company_frontpage_about_section',
        'type'     => 'text',
    )
);

$wp_customize->selective_refresh->add_partial( 'travel_company_about_text', array(
    'selector' => '.about-us .about-right .title-line p',
    'render_callback' => 'travel_company_get_about_text',
) );

// About title and description with featured image selection
$wp_customize->add_setting( 'travel_company_about_page_title', array(
    'capability'            => 'edit_theme_options',
    'default'               => '',
    'sanitize_callback'     => 'travel_company_sanitize_dropdown_pages'
) );

$wp_customize->add_control( 'travel_company_about_page_title', array( 
    'label'                 =>  __( 'Select Page for  about Title & Description with Featured Image', 'travel-company-helper' ),
    'section'               => 'travel_company_frontpage_about_section',
    'type'                  => 'dropdown-pages',
    'settings'              => 'travel_company_about_page_title',
) );

// Skill Items
$wp_customize->add_setting( 
    new Travel_Company_Helper_Repeater_Setting( 
        $wp_customize, 
        'travel_company_skill_items', 
        array(
            'default' => array(
                array(
                    'number' => 1,
                    'title'=> 'Satisfied Clients'                    
                ),
                array(
                    'number' => 0.75,
                    'title'=> 'Advanced Booking'         
                ),
            ),
            'sanitize_callback' => array( 'Travel_Company_Repeater_Setting', 'sanitize_repeater_setting' ),
        ) 
    ) 
);

$wp_customize->add_control(
    new Travel_Company_Helper_Control_Repeater(
        $wp_customize,
        'travel_company_skill_items',
        array(
            'section' => 'travel_company_frontpage_about_section',              
            'label'   => __( 'Skill items', 'travel-company-helper' ),
            'fields'  => array(
                'number' => array(
                    'type'        => 'text',
                    'label'       => __( 'Skill Number(0-1)', 'travel-company-helper' ),
                    'description' => __( 'Example:0.75, 1, 0.50', 'travel-company-helper' ),
                ),
                'title' => array(
                    'type'        => 'text',
                    'label'       => __( 'Skill Title', 'travel-company-helper' ),
                    'description' => __( 'Example: Satisfied Clients, Advanced Booking', 'travel-company-helper' ),
                )
            ),
            'row_label' => array(
                'type' => 'field',
                'value' => __( 'skills', 'travel-company-helper' ),
                'field' => 'title'
            )                        
        )
    )
);


/*----------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Frontpage Popular Destination section
 *
 * @since 1.0.0
 */

$wp_customize->add_section(
    'travel_company_frontpage_popular_destination_section',
    array(
        'priority'       => 2,
        'panel'          => 'travel_company_frontpage_settings_panel',
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __( 'Popular Destination Section', 'travel-company-helper' ),
        'description'    => __( 'Managed the popular destination display at Frontpage section.', 'travel-company-helper' ),
    )
);

//Popular Destination Enable/Disable
$wp_customize->add_setting( 'travel_company_popular_destination_enable', array(
    'capability'            => 'edit_theme_options',
    'default'               => 0,
    'sanitize_callback'     => 'travel_company_sanitize_checkbox'
) );

$wp_customize->add_control( 'travel_company_popular_destination_enable', array(
    'label'                 =>  __( 'Enable/Disable  popular destination section', 'travel-company-helper' ),
    'section'               => 'travel_company_frontpage_popular_destination_section',
    'type'                  => 'checkbox',
    'settings'              => 'travel_company_popular_destination_enable',
) );

/** Popular Destination Title */
$wp_customize->add_setting(
    'travel_company_popular_destination_title',
    array(
        'default'           => __( 'Popular Destinations Offered', 'travel-company-helper' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage'
    )
);

$wp_customize->add_control(
    'travel_company_popular_destination_title',
    array(
        'label'    => __( 'Popular Destination Title Line heading', 'travel-company-helper' ),
        'section'  => 'travel_company_frontpage_popular_destination_section',
        'type'     => 'text',
    )
);

$wp_customize->selective_refresh->add_partial( 'travel_company_popular_destination_title', array(
    'selector' => '.p-destination .container .title-line h2',
    'render_callback' => 'travel_company_get_popular_destination_title',
) );

/** Popular Destination Description */
$wp_customize->add_setting(
    'travel_company_popular_destination_description',
    array(
        'default'           => __( 'World\'s Best Tourist Destinations', 'travel-company-helper' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage'
    )
);

$wp_customize->add_control(
    'travel_company_popular_destination_description',
    array(
        'label'    => __( 'Popular Destination Title Line Text', 'travel-company-helper' ),
        'section'  => 'travel_company_frontpage_popular_destination_section',
        'type'     => 'text',
    )
);

$wp_customize->selective_refresh->add_partial( 'travel_company_popular_destination_description', array(
    'selector' => '.p-destination .container .title-line p',
    'render_callback' => 'travel_company_get_popular_destination_description',
) );

// Popular Destination Category
for ($i=1;$i<=6;$i++) {
    $wp_customize->add_setting( 'travel_company_p_destination_'.$i, array(
        'capability'            => 'edit_theme_options',
        'default'               => '',
        'sanitize_callback'     => 'travel_company_sanitize_select'
    ) );


    $wp_customize->add_control( 'travel_company_p_destination_'.$i, array(
        /* translators: %s: Popular Destination Number */ 
        'label'                 =>  sprintf( __( 'Choose popular destination %s', 'travel-company-helper' ), $i ),
        'description' => __( 'Go to Trips > Destination and add. Then you will be able to select a trip Destination from the dropdown.', 'travel-company-helper' ),
        'section'               => 'travel_company_frontpage_popular_destination_section',
        'type'                  => 'select',
        'settings'              => 'travel_company_p_destination_'.$i,
        'choices'     => travel_company_helper_get_categories( true, 'destination', false )
    ) );

    /** Popular Destination Price */
    $wp_customize->add_setting( 'travel_company_p_destination_price_'.$i, array(
        'capability'            => 'edit_theme_options',
        'default'               => '',
        'sanitize_callback'     => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'travel_company_p_destination_price_'.$i, array(
        /* translators: %s: Description */ 
        'label'                 =>  sprintf( __( 'Popular Destination Price %s', 'travel-company-helper' ), $i ),
        'description'           =>  __( '$355', 'travel-company-helper' ),
        'section'               => 'travel_company_frontpage_popular_destination_section',
        'type'                  => 'text',
        'settings' => 'travel_company_p_destination_price_'.$i,
    ) );
}


/*----------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Frontpage Popular Trips section
 *
 * @since 1.0.0
 */

$wp_customize->add_section(
    'travel_company_frontpage_p_trips_section',
    array(
        'priority'       => 3,
        'panel'          => 'travel_company_frontpage_settings_panel',
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __( 'Popular trips Section', 'travel-company-helper' ),
        'description'    => __( 'Managed the popular trips display at Frontpage section.', 'travel-company-helper' ),
    )
);

//Popular Trips Enable/Disable
$wp_customize->add_setting( 'travel_company_p_trips_enable', array(
    'capability'            => 'edit_theme_options',
    'default'               => 0,
    'sanitize_callback'     => 'travel_company_sanitize_checkbox'
) );

$wp_customize->add_control( 'travel_company_p_trips_enable', array(
    'label'                 =>  __( 'Enable/Disable  Popular Trips section', 'travel-company-helper' ),
    'section'               => 'travel_company_frontpage_p_trips_section',
    'type'                  => 'checkbox',
    'settings'              => 'travel_company_p_trips_enable',
) );


/** Popular Trips Text */
$wp_customize->add_setting(
    'travel_company_p_trips_text',
    array(
        'default'           => __( 'Popular Trips', 'travel-company-helper' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage'
    )
);

$wp_customize->add_control(
    'travel_company_p_trips_text',
    array(
        'label'    => __( 'popular trips title line text', 'travel-company-helper' ),
        'section'  => 'travel_company_frontpage_p_trips_section',
        'type'     => 'text',
    )
);

$wp_customize->selective_refresh->add_partial( 'travel_company_p_trips_text', array(
    'selector' => '.popular-trips .title-line p.title',
    'render_callback' => 'travel_company_get_p_trips_text',
) );

// popular_trips title and description with featured image selection
$wp_customize->add_setting( 'travel_company_p_trips_page_title', array(
    'capability'            => 'edit_theme_options',
    'default'               => '',
    'sanitize_callback'     => 'travel_company_sanitize_dropdown_pages'
) );

$wp_customize->add_control( 'travel_company_p_trips_page_title', array( 
    'label'                 =>  __( 'Select Page for  popular trips Title & Description with Featured Image', 'travel-company-helper' ),
    'section'               => 'travel_company_frontpage_p_trips_section',
    'type'                  => 'dropdown-pages',
    'settings'              => 'travel_company_p_trips_page_title',
) );

$wp_customize->add_setting( 'travel_company_p_trips_items_number', array(
    'capability'            => 'edit_theme_options',
    'default'               => 3,
    'sanitize_callback'     => 'absint'
));


 $wp_customize->add_control( 'travel_company_p_trips_items_number', array(
    'label'                 =>  __( 'Number of Popular trips to slide', 'travel-company-helper' ),
    'description'           =>  __( 'input 3,4,5,6,7,8,9,10', 'travel-company-helper' ),
    'section'               => 'travel_company_frontpage_p_trips_section',
    'type'                  => 'number',
    'settings' => 'travel_company_p_trips_items_number',
) );

/*----------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Frontpage Top Destination section
 *
 * @since 1.0.0
 */

$wp_customize->add_section(
    'travel_company_frontpage_t_destination_section',
    array(
        'priority'       => 4,
        'panel'          => 'travel_company_frontpage_settings_panel',
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __( 'Top Destination Section', 'travel-company-helper' ),
        'description'    => __( 'Managed the Top Destination display at Frontpage section.', 'travel-company-helper' ),
    )
);

//p_trips Enable/Disable
$wp_customize->add_setting( 'travel_company_t_destination_enable', array(
    'capability'            => 'edit_theme_options',
    'default'               => 0,
    'sanitize_callback'     => 'travel_company_sanitize_checkbox'
) );

$wp_customize->add_control( 'travel_company_t_destination_enable', array(
    'label'                 =>  __( 'Enable/Disable Top Destination section', 'travel-company-helper' ),
    'section'               => 'travel_company_frontpage_t_destination_section',
    'type'                  => 'checkbox',
    'settings'              => 'travel_company_t_destination_enable',
) );


/** Top Destination Title Line Text */
$wp_customize->add_setting(
    'travel_company_t_destination_text',
    array(
        'default'           => __( 'World\'s Best Tourist Destinations', 'travel-company-helper' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage'
    )
);

$wp_customize->add_control(
    'travel_company_t_destination_text',
    array(
        'label'    => __( 'Top Destination title line text', 'travel-company-helper' ),
        'section'  => 'travel_company_frontpage_t_destination_section',
        'type'     => 'text',
    )
);

$wp_customize->selective_refresh->add_partial( 'travel_company_t_destination_text', array(
    'selector' => '.top-destination .title-line p',
    'render_callback' => 'travel_company_get_t_destination_text',
) );


/** Top Destination Title Line Heading */
$wp_customize->add_setting(
    'travel_company_t_destination_heading',
    array(
        'default'           => __( 'Book your Trip', 'travel-company-helper' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage'
    )
);

$wp_customize->add_control(
    'travel_company_t_destination_heading',
    array(
        'label'    => __( 'Top Destination title line Heading', 'travel-company-helper' ),
        'section'  => 'travel_company_frontpage_t_destination_section',
        'type'     => 'text',
    )
);

$wp_customize->selective_refresh->add_partial( 'travel_company_t_destination_heading', array(
    'selector' => '.top-destination .title-line h2 span',
    'render_callback' => 'travel_company_get_t_destination_heading',
) );

/** Top Destination Title Line Heading */
$wp_customize->add_setting(
    'travel_company_t_destination_subheading',
    array(
        'default'           => __( 'Top Destination', 'travel-company-helper' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage'
    )
);

$wp_customize->add_control(
    'travel_company_t_destination_subheading',
    array(
        'label'    => __( 'Top Destination title line Subheading', 'travel-company-helper' ),
        'section'  => 'travel_company_frontpage_t_destination_section',
        'type'     => 'text',
    )
);

$wp_customize->selective_refresh->add_partial( 'travel_company_t_destination_subheading', array(
    'selector' => '.top-destination .title-line h2 span:after',
    'render_callback' => 'travel_company_get_t_destination_subheading',
) );


// Top Destination Category
for ($i=1;$i<=6;$i++) {
    $wp_customize->add_setting( 'travel_company_t_destination_'.$i, array(
        'capability'            => 'edit_theme_options',
        'default'               => '',
        'sanitize_callback'     => 'travel_company_sanitize_select'
    ) );


    $wp_customize->add_control( 'travel_company_t_destination_'.$i, array(
        /* translators: %s: Popular Destination Number */ 
        'label'                 =>  sprintf( __( 'Choose Top destination %s', 'travel-company-helper' ), $i ),
        'description' => __( 'Go to Trips > Destination and add. Then you will be able to select a trip Destination from the dropdown.', 'travel-company-helper' ),
        'section'               => 'travel_company_frontpage_t_destination_section',
        'type'                  => 'select',
        'settings'              => 'travel_company_t_destination_'.$i,
        'choices'     => travel_company_helper_get_categories( true, 'destination', false )
    ) );
}
/*----------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Frontpage  Call to action section
 *
 * @since 1.0.0
 */

$wp_customize->add_section(
    'travel_company_frontpage_cta_section',
    array(
        'priority'       => 5,
        'panel'          => 'travel_company_frontpage_settings_panel',
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __( 'Call to Action Section', 'travel-company-helper' ),
        'description'    => __( 'Managed the Call to Action display at Frontpage section.', 'travel-company-helper' ),
    )
);

//Call to action Enable/Disable
$wp_customize->add_setting( 'travel_company_cta_enable', array(
    'capability'            => 'edit_theme_options',
    'default'               => 0,
    'sanitize_callback'     => 'travel_company_sanitize_checkbox'
) );

$wp_customize->add_control( 'travel_company_cta_enable', array(
    'label'                 =>  __( 'Enable/Disable Call to Action section', 'travel-company-helper' ),
    'section'               => 'travel_company_frontpage_cta_section',
    'type'                  => 'checkbox',
    'settings'              => 'travel_company_cta_enable',
) );

/**Call to action About Text */
$wp_customize->add_setting(
    'travel_company_cta_text',
    array(
        'default'           => __( 'About Company', 'travel-company-helper' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage'
    )
);

$wp_customize->add_control(
    'travel_company_cta_text',
    array(
        'label'    => __( 'Call to Action Title line Text', 'travel-company-helper' ),
        'section'  => 'travel_company_frontpage_cta_section',
        'type'     => 'text',
    )
);

$wp_customize->selective_refresh->add_partial( 'travel_company_cta_text', array(
    'selector' => '.cta  .cta-text .title-line p',
    'render_callback' => 'travel_company_get_cta_text',
) );

/**Call to action title line heading */
$wp_customize->add_setting(
    'travel_company_cta_title',
    array(
        'default'           => __( 'Worthy time spent around the world with traveltrek.', 'travel-company-helper' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage'
    )
);

$wp_customize->add_control(
    'travel_company_cta_title',
    array(
        'label'    => __( 'Call to Action title line heading', 'travel-company-helper' ),
        'section'  => 'travel_company_frontpage_cta_section',
        'type'     => 'text',
    )
);

$wp_customize->selective_refresh->add_partial( 'travel_company_cta_title', array(
    'selector' => '.cta  .cta-text .title-line h2',
    'render_callback' => 'travel_company_get_cta_title',
) );


/**Call to action Button text */
$wp_customize->add_setting(
    'travel_company_cta_button_text',
    array(
        'default'           => __( 'Book your trip', 'travel-company-helper' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage'
    )
);

$wp_customize->add_control(
    'travel_company_cta_button_text',
    array(
        'label'    => __( 'Call to Action Button Text', 'travel-company-helper' ),
        'section'  => 'travel_company_frontpage_cta_section',
        'type'     => 'text',
    )
);

$wp_customize->selective_refresh->add_partial( 'travel_company_cta_button_text', array(
    'selector' => '.cta  .cta-text a.btn',
    'render_callback' => 'travel_company_get_cta_button_text',
) );

/**Call to action Button url */
$wp_customize->add_setting(
    'travel_company_cta_button_url',
    array(
        'capability'            => 'edit_theme_options',
        'default'           => __( '#', 'travel-company-helper' ),
        'sanitize_callback' => 'esc_url_raw'
    )
);

$wp_customize->add_control(
    'travel_company_cta_button_url',
    array(
        'label'    => __( 'Call to Action Button Url', 'travel-company-helper' ),
        'section'  => 'travel_company_frontpage_cta_section',
        'type'     => 'url',
        'settings' => 'travel_company_cta_button_url'
    )
);

/**Call to action Background Image */
$wp_customize->add_setting(
    'travel_company_cta_bg_image',
    array(
      'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw'
    )
);
$wp_customize->add_control( 
    new WP_Customize_Image_Control( 
    $wp_customize, 
    'travel_company_cta_bg_image', 
    array(
        'label'      => __( 'Background Image', 'travel-company-helper' ),
        'section'    => 'travel_company_frontpage_cta_section',
        'settings'   => 'travel_company_cta_bg_image',
    ) ) 
);
/*----------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Frontpage Testimonials section
 *
 * @since 1.0.0
 */

$wp_customize->add_section(
    'travel_company_frontpage_testimonials_section',
    array(
        'priority'       => 6,
        'panel'          => 'travel_company_frontpage_settings_panel',
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __( 'Testimonials Section', 'travel-company-helper' ),
        'description'    => __( 'Managed the Testimonials display at Frontpage section.', 'travel-company-helper' ),
    )
);

//Testimonials Enable/Disable
$wp_customize->add_setting( 'travel_company_testimonials_enable', array(
    'capability'            => 'edit_theme_options',
    'default'               => 0,
    'sanitize_callback'     => 'travel_company_sanitize_checkbox'
) );

$wp_customize->add_control( 'travel_company_testimonials_enable', array(
    'label'                 =>  __( 'Enable/Disable Testimonials section', 'travel-company-helper' ),
    'section'               => 'travel_company_frontpage_testimonials_section',
    'type'                  => 'checkbox',
    'settings'              => 'travel_company_testimonials_enable',
) );


// Testimonials Title Description and Featured Image
$wp_customize->add_setting( 'travel_company_testimonials_page_title', array(
    'capability'            => 'edit_theme_options',
    'default'               => '',
    'sanitize_callback'     => 'travel_company_sanitize_dropdown_pages'
) );

$wp_customize->add_control( 'travel_company_testimonials_page_title', array( 
    'label'                 =>  __( 'Select Page for  testimonials title, description with featured image', 'travel-company-helper' ),
    'section'               => 'travel_company_frontpage_testimonials_section',
    'type'                  => 'dropdown-pages',
    'settings'              => 'travel_company_testimonials_page_title',
) );


//Category select for testimonialss
$wp_customize->add_setting('travel_company_testimonials_category_id',array(
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'travel_company_sanitize_category',
    'default' =>  '1',
)
);

$wp_customize->add_control(new Travel_Company_Customize_Dropdown_Taxonomies_Control($wp_customize,'travel_company_testimonials_category_id',
    array(
     'label' => __('Select Category for testimonials','travel-company-helper'),
     'section' => 'travel_company_frontpage_testimonials_section',
     'settings' => 'travel_company_testimonials_category_id',
     'type'=> 'dropdown-taxonomies',
 )
));
$wp_customize->add_setting( 'travel_company_testimonials_number', array(
    'capability'            => 'edit_theme_options',
    'default'               => '3',
    'sanitize_callback'     => 'absint'
));

$wp_customize->add_control( 'travel_company_testimonials_number', array(
    'label'                 =>  __( 'Number of Recent Testimonials to Show in Front Page', 'travel-company-helper' ),
    'description'           =>  __( 'input 3,4,5,6,7,8,9,10', 'travel-company-helper' ),
    'section'               => 'travel_company_frontpage_testimonials_section',
    'type'                  => 'number',
    'settings' => 'travel_company_testimonials_number',
) );
/*----------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Frontpage Services section
 *
 * @since 1.0.0
 */

$wp_customize->add_section(
    'travel_company_frontpage_service_section',
    array(
        'priority'       => 7,
        'panel'          => 'travel_company_frontpage_settings_panel',
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __( 'service Section', 'travel-company-helper' ),
        'description'    => __( 'Managed the service display at Frontpage section.', 'travel-company-helper' ),
    )
);

//Services Enable/Disable
$wp_customize->add_setting( 'travel_company_service_enable', array(
    'capability'            => 'edit_theme_options',
    'default'               => 0,
    'sanitize_callback'     => 'travel_company_sanitize_checkbox'
) );

$wp_customize->add_control( 'travel_company_service_enable', array(
    'label'                 =>  __( 'Enable/Disable service section', 'travel-company-helper' ),
    'section'               => 'travel_company_frontpage_service_section',
    'type'                  => 'checkbox',
    'settings'              => 'travel_company_service_enable',
) );


// Service Image and vedio Link
$wp_customize->add_setting( 'travel_company_service_page_title', array(
    'capability'            => 'edit_theme_options',
    'default'               => '',
    'sanitize_callback'     => 'travel_company_sanitize_dropdown_pages'
) );

$wp_customize->add_control( 'travel_company_service_page_title', array( 
    'label'                 =>  __( 'Select Page for  service image(Featured Image) & Vedio Link(description)', 'travel-company-helper' ),
    'section'               => 'travel_company_frontpage_service_section',
    'type'                  => 'dropdown-pages',
    'settings'              => 'travel_company_service_page_title',
) );

/// Setting: Link of Service Custom Post Type.
class Service_Post_Type_Info extends WP_Customize_Control {
    public $type = 'customtext';
    public $extra = ''; // we add this for the extra description
    public function render_content() {
        ?>
        <label>            
            <a href="<?php echo esc_url( 'edit.php?post_type=service' ); ?>" target='_blank'><?php echo esc_html( $this->label ); ?></a>
            <span><?php echo esc_html( $this->extra ); ?></span>         
        </label>
        <?php
    }
}

$wp_customize->add_setting('service_post_type_info', array(
  'default' => '',
  'type' => 'customtext',
  'capability' => 'edit_theme_options',
  'transport' => 'refresh',
  'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Service_Post_Type_Info( $wp_customize, 'service_post_type_info', array(
    'label' => esc_attr__( 'Go to Service Page', 'travel-company-helper' ),
    'section' => 'travel_company_frontpage_service_section',
    'settings' => 'service_post_type_info',
    'extra' => esc_attr__( ' for more info', 'travel-company-helper' )
) ) 
);

/*----------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Frontpage Blog section
 *
 * @since 1.0.0
 */

$wp_customize->add_section(
    'travel_company_frontpage_blog_section',
    array(
        'priority'       => 7,
        'panel'          => 'travel_company_frontpage_settings_panel',
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __( 'blog Section', 'travel-company-helper' ),
        'description'    => __( 'Managed the blog display at Frontpage section.', 'travel-company-helper' ),
    )
);

//Blogs Enable/Disable
$wp_customize->add_setting( 'travel_company_blog_enable', array(
    'capability'            => 'edit_theme_options',
    'default'               => 0,
    'sanitize_callback'     => 'travel_company_sanitize_checkbox'
) );

$wp_customize->add_control( 'travel_company_blog_enable', array(
    'label'                 =>  __( 'Enable/Disable blog section', 'travel-company-helper' ),
    'section'               => 'travel_company_frontpage_blog_section',
    'type'                  => 'checkbox',
    'settings'              => 'travel_company_blog_enable',
) );

/** News & Blog Text */
$wp_customize->add_setting(
    'travel_company_blog_text',
    array(
        'default'           => __( 'News & Blog', 'travel-company-helper' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage'
    )
);

$wp_customize->add_control(
    'travel_company_blog_text',
    array(
        'label'    => __( 'News & Blog Title Line Text', 'travel-company-helper' ),
        'section'  => 'travel_company_frontpage_blog_section',
        'type'     => 'text',
    )
);

$wp_customize->selective_refresh->add_partial( 'travel_company_blog_text', array(
    'selector' => '.blog-area .title-line p',
    'render_callback' => 'travel_company_get_blog_text',
) );


/** Blog & News Title */
$wp_customize->add_setting(
    'travel_company_blog_title',
    array(
        'default'           => __( 'Latest Updates', 'travel-company-helper' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage'
    )
);

$wp_customize->add_control(
    'travel_company_blog_title',
    array(
        'label'    => __( 'News & Blog Title Line Heading', 'travel-company-helper' ),
        'section'  => 'travel_company_frontpage_blog_section',
        'type'     => 'text',
    )
);

$wp_customize->selective_refresh->add_partial( 'travel_company_blog_title', array(
    'selector' => '.blog-area .title-line h2',
    'render_callback' => 'travel_company_get_blog_title',
) );


//Category select for Blogs
$wp_customize->add_setting('travel_company_blog_category_id',array(
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'travel_company_sanitize_category',
    'default' =>  '1',
)
);

$wp_customize->add_control(new Travel_Company_Customize_Dropdown_Taxonomies_Control($wp_customize,'travel_company_blog_category_id',
    array(
     'label' => __('Select Category for blog','travel-company-helper'),
     'section' => 'travel_company_frontpage_blog_section',
     'settings' => 'travel_company_blog_category_id',
     'type'=> 'dropdown-taxonomies',
 )
));
$wp_customize->add_setting( 'travel_company_blog_number', array(
    'capability'            => 'edit_theme_options',
    'default'               => '3',
    'sanitize_callback'     => 'absint'
));

$wp_customize->add_control( 'travel_company_blog_number', array(
    'label'                 =>  __( 'Number of Recent blog to Show in Front Page', 'travel-company-helper' ),
    'description'           =>  __( 'input 3,4,5,6,7,8,9,10', 'travel-company-helper' ),
    'section'               => 'travel_company_frontpage_blog_section',
    'type'                  => 'number',
    'settings' => 'travel_company_blog_number',
) );
/*----------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Frontpage Clients section
 *
 * @since 1.0.0
 */

$wp_customize->add_section(
    'travel_company_frontpage_clients_section',
    array(
        'priority'       => 7,
        'panel'          => 'travel_company_frontpage_settings_panel',
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __( 'clients Section', 'travel-company-helper' ),
        'description'    => __( 'Managed the clients display at Frontpage section.', 'travel-company-helper' ),
    )
);

//Clients Enable/Disable
$wp_customize->add_setting( 'travel_company_clients_enable', array(
    'capability'            => 'edit_theme_options',
    'default'               => 0,
    'sanitize_callback'     => 'travel_company_sanitize_checkbox'
) );

$wp_customize->add_control( 'travel_company_clients_enable', array(
    'label'                 =>  __( 'Enable/Disable clients section', 'travel-company-helper' ),
    'section'               => 'travel_company_frontpage_clients_section',
    'type'                  => 'checkbox',
    'settings'              => 'travel_company_clients_enable',
) );

//Category select for clients
$wp_customize->add_setting('travel_company_clients_category_id',array(
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'travel_company_sanitize_category',
    'default' =>  '1',
)
);

$wp_customize->add_control(new Travel_Company_Customize_Dropdown_Taxonomies_Control($wp_customize,'travel_company_clients_category_id',
    array(
     'label' => __('Select Category for Clients','travel-company-helper'),
     'section' => 'travel_company_frontpage_clients_section',
     'settings' => 'travel_company_clients_category_id',
     'type'=> 'dropdown-taxonomies',
 )
));
$wp_customize->add_setting( 'travel_company_client_number', array(
    'capability'            => 'edit_theme_options',
    'default'               => '3',
    'sanitize_callback'     => 'absint'
));

$wp_customize->add_control( 'travel_company_client_number', array(
    'label'                 =>  __( 'Number of Recent Clients to Show in Front Page', 'travel-company-helper' ),
    'description'           =>  __( 'input 3,4,5,6,7,8,9,10', 'travel-company-helper' ),
    'section'               => 'travel_company_frontpage_clients_section',
    'type'                  => 'number',
    'settings' => 'travel_company_client_number',
) );
}