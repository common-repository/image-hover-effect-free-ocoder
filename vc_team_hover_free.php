<?php

/*
  Plugin Name: VC Image Hover Effect Free - oCoder
  Plugin URI: http://ocoderEducation.com
  Description: Visual Composer Team Hover Effect by oCoder.  please buy pro version for full function <a href="https://codecanyon.net/item/image-hover-effects-for-team-member-and-product-visual-composer/19501499?ref=trungstormsix">here</a>.
  Version: 1.1
  Author: oCoder
  Author URI: http://ocoderEducation.com
  License: GPLv2 or later
 */

/*
  This example/starter plugin can be used to speed up Visual Composer plugins creation process.
  More information can be found here: http://kb.wpbakery.com/index.php?title=Category:Visual_Composer
 */


// don't load directly
if (!defined('ABSPATH'))
    die('-1');
if (!defined("OC_CONTACT_DEBUG"))
    define("OC_CONTACT_DEBUG", 1);
if (!class_exists('VCTeamHoverOcoderAddonFreeClass')) {

    function vc_team_hover_free_admin_enqeue() {
        wp_enqueue_style('vc_team_hover_free_admin_enqeue', plugins_url('admin/css/admin.css', __FILE__));
    }

    add_action('admin_enqueue_scripts', 'vc_team_hover_free_admin_enqeue');

//sitekey captcha google for http://localhost
    class VCTeamHoverOcoderAddonFreeClass {

        function __construct() {
            // We safely integrate with VC with this hook
            add_action('init', array($this, 'integrateWithVC'));
            // Use this when creating a shortcode addon
            add_shortcode('vc_team_hover_free_ocoder', array($this, 'renderMyAddon'));
            // Register CSS and JS
            add_action('wp_enqueue_scripts', array($this, 'loadCssAndJs'));
        }

        public function integrateWithVC() {
            // Check if Visual Composer is installed
            if (!defined('WPB_VC_VERSION')) {
                // Display notice that Visual Compser is required
                add_action('admin_notices', array($this, 'showVcVersionNotice'));
                return;
            }
            require_once 'admin/params/slider/slider-params.php';

            /*
              Add your Visual Composer logic here.
              Lets call vc_map function to "register" our custom shortcode within Visual Composer interface.

              More info: http://kb.wpbakery.com/index.php?title=Vc_map
             */
            vc_map(array(
                "name" => __("Team Hover Free - oCoder", 'vc_ocoder'),
                "description" => __("Team Hover Free", 'vc_ocoder'),
                "base" => "vc_team_hover_free_ocoder",
                "class" => "",
                "controls" => "full",
                "icon" => plugins_url('assets/icon_team_hover.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_ocoder_my_class"
                "category" => __('Content', 'vc_ocoder'),
                'admin_enqueue_css' => array(plugins_url('assets/vc_ocoder_admin.css', __FILE__)), // This will load css file in the VC backend editor
                "params" => array(
                    array(
                        'type' => 'dropdown',
                        'heading' => __('Style', 'vc_ocoder'),
                        'description' => __('Select display style.', 'vc_ocoder'),
                        'param_name' => 'display_style',
                        'group' => __('General', 'vc_ocoder'),
                        'value' => array(
                            __('Default', 'vc_ocoder') => 'default',
                            __('Box (Pro only)', 'vc_ocoder') => 'team_member_box',
                            __('Shadow Effect', 'vc_ocoder') => 'shadow_effect',
                            __('Round Member (Pro only)', 'vc_ocoder') => 'round',
                            __('Circle Many Effects', 'vc_ocoder') => 'circle',
                            __('Square Many Effects', 'vc_ocoder') => 'square',
                        ),
                    ),
                    // Select Circle Field
                    array(
                        "type" => "dropdown",
                        "heading" => __("Select Effects"),
                        "param_name" => "circle_effect",
                        "admin_label" => true,
                        "value" => array(
                            'Circle Spinner' => 'effect1',
                            'Image Rotate' => 'effect2',
                            'Image Zoom Out' => 'effect3',
                            'Image Fade Out' => 'effect4',
                            'Rotate Info' => 'effect5',
                            'Scale Effect' => 'effect6',
                            'Image Fade In' => 'effect7',
                            'Image Fade-Zoom Out' => 'effect8',
                            'Rotate Out - pro Only' => 'effect9',
                            'Rotate Center - pro Only' => 'effect11',
                            'Rotate In Out - pro Only' => 'effect12',
                            'Text Fade In - pro Only' => 'effect13',
                            'Flip Fade - pro Only' => 'effect14',
                            'Rotate 2 - pro Only' => 'effect16',
                            'Flip - pro Only' => 'effect18',
                            'Text Zoom Out - pro Only' => 'effect19'
                        ),
                        "dependency" => array('element' => 'display_style', 'value' => 'circle'),
                        'group' => __('General', 'vc_ocoder'),
                    ),
                    // Select Square Field
                    array(
                        "type" => "dropdown",
                        "heading" => __("Select Effects"),
                        "param_name" => "square_effect",
                        "admin_label" => true,
                        "value" => array(
                            'Effects 1' => 'effect1',
                            'Effects 2' => 'effect2',
                            'Effects 3' => 'effect3',
                            'Effects 4' => 'effect4',
                            'Effects 5' => 'effect5',
                            'Effects 6 - pro Only' => 'effect6',
                            'Effects 7 - pro Only' => 'effect7',
                            'Effects 8 - pro Only' => 'effect8',
                            'Effects 9 - pro Only' => 'effect9'
                        ),
                        "std" => $defaults['style1'],
                        "dependency" => array('element' => 'display_style', 'value' => 'square'),
                        'group' => __('General', 'vc_ocoder'),
                    ),
                    // Title Field 
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __("Circle Size", 'vc_ocoder'),
                        "param_name" => "circle_size",
                        "description" => "Circle size (default is 220px)",
                        'group' => __('General', 'vc_ocoder'),
                        "dependency" => array('element' => 'display_style', 'value' => 'circle'),
                    /* "description" => __("Provide the title for the iHover.", 'ultimate') */
                    ),
                    // Select Square Field
                    array(
                        "type" => "dropdown",
                        "heading" => __("Hover Animation"),
                        "param_name" => "th_animation",
                        "admin_label" => true,
                        "value" => array(
                            'Left To Right (Scale In)' => 'left_to_right',
                            'Right To Left (Scalse Out)' => 'right_to_left',
                            'Top To Bottom (Scale In Out)' => 'top_to_bottom',
                            'Bottom To Top (Scale Out In)' => 'bottom_to_top'
                        ),
                        "std" => $defaults['left_to_right'],
                        "dependency" => array('element' => 'display_style', 'value' => 'circle'),
                        'group' => __('General', 'vc_ocoder'),
                    ),
                    array(
                        "type" => "attach_image",
                        "heading" => __("Upload Image", "vc_ocoder"),
                        "param_name" => "image",
                        "value" => "",
                        "description" => __("Select images from media library.", 'vc_ocoder'),
                        'group' => __('General', 'vc_ocoder'),
                    ),
                    // Title Field 
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __("Title", 'vc_ocoder'),
                        "param_name" => "title",
                        "admin_label" => true,
                        "value" => "Title Goes Here",
                        'group' => __('General', 'vc_ocoder'),
                    /* "description" => __("Provide the title for the iHover.", 'ultimate') */
                    ),
                     array(
                        "type" => "colorpicker",
                        "class" => "",
                        "heading" => __("Title Background Color", "my-text-domain"),
                        "param_name" => "title_bg_color",
                        "value" => '',
                        "description" => __("Chose Background Color From Color Picker, leave it blank to use default color defined in CSS.", "my-text-domain"),
                        "group" => "General",
                        "dependency" => array('element' => 'display_style', 'value' => 'square'),

                    ),
                    array(
                        "type" => "textarea",
                        /* "holder" => "div", */
                        "class" => "",
                        "heading" => __("Caption", 'vc_ocoder'),
                        "param_name" => "caption",
                        "admin_label" => true,
                        "value" => "Caption Goes Here",
                        'group' => __('General', 'vc_ocoder'),
                    /* "description" => __("Provide the title for the iHover.", 'ultimate') */
                    ),
                    array(
                        "type" => "textarea",
                        /* "holder" => "div", */
                        "class" => "",
                        "heading" => __("Description", 'vc_ocoder'),
                        "param_name" => "description",
                        "admin_label" => true,
                        "value" => "Description Goes Here",
                        'group' => __('General', 'vc_ocoder'),
                    /* "description" => __("Provide the title for the iHover.", 'ultimate') */
                    ),
                    /**
                     * for Typography
                     */
                    array(
                        'type' => 'prime_slider',
                        'heading' => __('Title Text Font Size', 'vc_ocoder'),
                        'param_name' => 'title_text_size',
                        'tooltip' => __('This only for <a href="https://codecanyon.net/item/image-hover-effects-for-team-member-and-product-visual-composer/19501499?ref=trungstormsix">Pro Version</a>.Choose Title Text Size Here. Leave it blank to use default font size.', 'vc_ocoder'),
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                        'value' => 0,
                        'unit' => 'px',
                        "description" => __("This only for <a href='https://codecanyon.net/item/image-hover-effects-for-team-member-and-product-visual-composer/19501499?ref=trungstormsix'>Pro Version</a>.<br>Chose Title Text Size as Pixel. Set this to 0 to use default font size which pre-defined in CSS.", 'vc_ocoder'),
                        'group' => __('Typography', 'vc_ocoder'),
                    ),
                    array(
                        "type" => "colorpicker",
                        "class" => "",
                        "heading" => __("Title Text color", "my-text-domain"),
                        "param_name" => "title_color",
                        "value" => '',
                        "description" => __("This only for <a href='https://codecanyon.net/item/image-hover-effects-for-team-member-and-product-visual-composer/19501499?ref=trungstormsix'>Pro Version</a>.<br>Chose Title Font Color From Color Picker, leave it blank to use default color defined in CSS.", "my-text-domain"),
                        "group" => "Typography"
                    ),
                    array(
                        'type' => 'prime_slider',
                        'heading' => __('Caption Text Font Size', 'vc_ocoder'),
                        'param_name' => 'caption_text_size',
                        'tooltip' => __("This only for <a href='https://codecanyon.net/item/image-hover-effects-for-team-member-and-product-visual-composer/19501499?ref=trungstormsix'>Pro Version</a>.<br>Choose Caption Text Size Here. Leave it blank to use default font size.", 'vc_ocoder'),
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                        'value' => 0,
                        'unit' => 'px',
                        "description" => __("This only for <a href='https://codecanyon.net/item/image-hover-effects-for-team-member-and-product-visual-composer/19501499?ref=trungstormsix'>Pro Version</a>.<br>Chose Caption Text Size as Pixel. Set this to 0 to use default font size which pre-defined in CSS.", 'vc_ocoder'),
                        'group' => __('Typography', 'vc_ocoder'),
                    ),
                    array(
                        "type" => "colorpicker",
                        "class" => "",
                        "heading" => __("Caption Text color", "my-text-domain"),
                        "param_name" => "caption_color",
                        "value" => '',
                        "description" => __("Chose Caption Font Color From Color Picker, leave it blank to use default color defined in CSS.", "my-text-domain"),
                        "group" => "Typography"
                    ),
                    array(
                        'type' => 'prime_slider',
                        'heading' => __('Description Text Font Size', 'vc_ocoder'),
                        'param_name' => 'description_text_size',
                        'tooltip' => __("This only for <a href='https://codecanyon.net/item/image-hover-effects-for-team-member-and-product-visual-composer/19501499?ref=trungstormsix'>Pro Version</a>.<br>Choose Description Text Size Here. Leave it blank to use default font size.", 'vc_ocoder'),
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                        'value' => 0,
                        'unit' => 'px',
                        "description" => __("This only for <a href='https://codecanyon.net/item/image-hover-effects-for-team-member-and-product-visual-composer/19501499?ref=trungstormsix'>Pro Version</a>.<br>Chose Description Text Size as Pixel. Set this to 0 to use default font size which pre-defined in CSS.", 'vc_ocoder'),
                        'group' => __('Typography', 'vc_ocoder'),
                    ),
                    array(
                        "type" => "colorpicker",
                        "class" => "",
                        "heading" => __("Description Text color", "my-text-domain"),
                        "param_name" => "description_color",
                        "value" => '',
                        "description" => __("This only for <a href='https://codecanyon.net/item/image-hover-effects-for-team-member-and-product-visual-composer/19501499?ref=trungstormsix'>Pro Version</a>.<br>Chose Description Font Color From Color Picker, leave it blank to use default color defined in CSS.", "my-text-domain"),
                        "group" => "Typography"
                    ),
                    array(
                        "type" => "colorpicker",
                        "class" => "",
                        "heading" => __("Overlay color", "my-text-domain"),
                        "param_name" => "overlay_color",
                        "value" => '',
                        "description" => __("Chose Overlay From Color Picker, this is the background color when you hover the image, leave it blank to use default color defined in CSS.", "my-text-domain"),
                        "group" => "Typography"
                    ),
                    // Link Field
                    array(
                        'type' => 'param_group',
                        'value' => '[{"icon":"fa fa-facebook","link":"http://facebook.com","new_tab":"true"},{"icon":"fa fa-twitter","link":"http://twitter.com","new_tab":"true"},{"icon":"fa fa-instagram","link":"http://google.com","new_tab":"true"}]',
                        'param_name' => 'socials',
                        "description" => __("Add Social link by click on + button, edit by click on arrow button.", 'vc_ocoder'),
                        "heading" => __("Add Social Links", 'vc_ocoder'),
                        // Note params is mapped inside param-group:
                        "group" => "Socials",
                        'params' => array(
                            array(
                                "holder" => "div",
                                "class" => "",
                                'type' => 'iconpicker',
                                'value' => '',
                                'heading' => __('Icon', 'vc_ocoder'),
                                'description' => "Icon of the link, please choose fontawsome class. Please click <a href='http://fontawesome.io/icons/' target='_blank' >here</a>.",
                                'param_name' => 'icon',
                            ),
                            array(
                                "holder" => "div",
                                "class" => "",
                                'type' => 'textfield',
                                'value' => '',
                                'heading' => __('Link', 'vc_ocoder'),
                                'param_name' => 'link',
                            ),
                            array(
                                "holder" => "div",
                                "class" => "",
                                'type' => 'checkbox',
                                'value' => '',
                                'heading' => __('Open link in new tab', 'vc_ocoder'),
                                'param_name' => 'new_tab',
                            )
                        )
                    ),
                    array(
                        "type" => "colorpicker",
                        "class" => "",
                        "heading" => __("Social Color", "my-text-domain"),
                        "param_name" => "social_color",
                        "value" => '',
                        "description" => __("This only for <a href='https://codecanyon.net/item/image-hover-effects-for-team-member-and-product-visual-composer/19501499?ref=trungstormsix'>Pro Version, please buy it</a>.<br>Chose Social Color From Color Picker, this is the color of social icon, leave it blank to use default color defined in CSS.", "my-text-domain"),
                        "group" => "Socials",
                    ),
                    array(
                        "type" => "colorpicker",
                        "class" => "",
                        "heading" => __("Social Hover Color", "my-text-domain"),
                        "param_name" => "social_hover_color",
                        "value" => '',
                        "description" => __("This only for <a href='https://codecanyon.net/item/image-hover-effects-for-team-member-and-product-visual-composer/19501499?ref=trungstormsix'>Pro Version, please buy it</a>.<br>Chose Social Hover Color From Color Picker, this is the color of social icon when you hover the icon, leave it blank to use default color defined in CSS.", "my-text-domain"),
                        "group" => "Socials",
                    ),
                    array(
                        'type' => 'css_editor',
                        'heading' => __('CSS box', 'vc_ocoder'),
                        'param_name' => 'css',
                        'group' => __('Block Design', 'vc_ocoder'),
                    )
                )
            ));
        }

        /*
          Shortcode logic how it should be rendered
         */

        public function renderMyAddon($atts, $content = null) {

            $css = '';
            extract(shortcode_atts(array(
                'css' => '',
                'display_style' => 'default',
                'title' => 'Title Goes Here',
                'caption' => 'Caption Goes Here',
                'description' => 'Description Goes Here',
                'th_animation' => "left_to_right",
                 'caption_text_size' => "",
                'caption_color' => "",
                'description_text_size' => "",
                'description_color' => "",
                'overlay_color' => "",
                'image' => '',
                'circle_size' => '',
                'circle_effect' => 'effect1',
                'square_effect' => 'effect1',
                 'social_hover_color' => '',
                'border_color' => '',
                'title_bg_color' => '',
                            ), $atts));
            $title_text_size = null;
            $title_color = null;
            $caption_text_size = null;
            $description_text_size = null;
            $social_hover_color = null;
            $social_color = null;
            $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '), $this->settings['base'], $atts);
            $socials = vc_param_group_parse_atts(@$atts['socials']);

            $output = "";
            if (file_exists(plugin_dir_path(__FILE__) . "/template/$display_style.php")) {
                require(plugin_dir_path(__FILE__) . "/template/$display_style.php");
            }
            $output.= ob_get_contents();
            ob_end_clean();
            return $output;
        }

        /*
          Load plugin css and javascript files which you may need on front end of your site
         */

        public function loadCssAndJs() {
            wp_register_style('vc_bootstrap', plugins_url('assets/css/bootstrap.min.css', __FILE__));
            wp_register_style('vc_font_awsome', plugins_url('assets/font-awesome/css/font-awesome.min.css', __FILE__));

            wp_enqueue_style('vc_bootstrap');

            wp_enqueue_style('vc_font_awsome');

            // If you need any javascript files on front end, here is how you can load them.
            wp_enqueue_script('vc_bootstrap_js', plugins_url('assets/js/bootstrap.min.js', _FILE_), array('jquery'), null, true);
        }

        /*
          Show notice if your plugin is activated but Visual Composer is not
         */

        public function showVcVersionNotice() {
            $plugin_data = get_plugin_data(__FILE__);
            echo '
        <div class="updated">
          <p>' . sprintf(__('<strong>%s</strong> requires <strong><a href="http://bit.ly/vcomposer" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'vc_ocoder'), $plugin_data['Name']) . '</p>
        </div>';
        }

    }

// Finally initialize code
    new VCTeamHoverOcoderAddonFreeClass();
}
if (!function_exists("vcTeamHoverOcoderFreeAdjustBrightness")) {

    function vcTeamHoverOcoderFreeAdjustBrightness($hex, $steps) {
        // Steps should be between -255 and 255. Negative = darker, positive = lighter
        $steps = max(-255, min(255, $steps));

        // Normalize into a six character long hex string
        $hex = str_replace('#', '', $hex);
        if (strlen($hex) == 3) {
            $hex = str_repeat(substr($hex, 0, 1), 2) . str_repeat(substr($hex, 1, 1), 2) . str_repeat(substr($hex, 2, 1), 2);
        }

        // Split into three parts: R, G and B
        $color_parts = str_split($hex, 2);
        $return = '#';

        foreach ($color_parts as $color) {
            $color = hexdec($color); // Convert to decimal
            $color = max(0, min(255, $color + $steps)); // Adjust color
            $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
        }

        return $return;
    }

}