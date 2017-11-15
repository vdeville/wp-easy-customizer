<?php

class YourTheme_Customizer
{

    private static $panel = 'yourTheme_options';

    private static $textDomain = 'yourtheme';

    private static $sectionBase = 'yourtheme';

    /**
     * @param WP_Customize_Manager $wp_customize
     */
    public static function register($wp_customize)
    {
        $panel = self::$panel;

        $wp_customize->add_panel(
            $panel,
            array(
                'title' => __('Options for your theme', self::$textDomain),
                'priority' => 1000
            )
        );

        /**
         * Create section and add elements into
         */
        $section = self::addSection($wp_customize, 'header', 'Header settings', $panel, 1);
        // Add media element in previous created section
        self::addparamMedia($wp_customize, $section['name'] . 'header_image', $section['full'], 'Image background', 'image');
        self::addparamMedia($wp_customize, $section['name'] . 'header_logo', $section['full'], 'Logo (avec date) header', 'image');

        /**
         * Second section
         */
        $section = self::addSection($wp_customize, 'otherssettings', 'Other settings for theme', $panel, 2);
        // Add text element
        self::addParam($wp_customize, $section['name'] . 'text1', $section['full'], 'Text 1', 'text');
        self::addParam($wp_customize, $section['name'] . 'text2', $section['full'], 'Text 2', 'text');

        /**
         * Add more here...
         */
    }

    /**
     * @param WP_Customize_Manager $wp_customize
     * @param $name
     * @param $section
     * @param $label
     * @param $type
     */
    private static function addParam($wp_customize, $name, $section, $label, $type)
    {
        $wp_customize->add_setting($name,
            array(
                'default' => ''
            )
        );
        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                $name,
                array(
                    'label' => __($label, self::$textDomain),
                    'section' => $section,
                    'type' => $type,
                )
            )
        );
    }

    /**
     * @param WP_Customize_Manager $wp_customize
     * @param $name
     * @param $section
     * @param $label
     * @param $type
     */
    private static function addParamMedia($wp_customize, $name, $section, $label, $type)
    {
        $wp_customize->add_setting($name,
            array(
                'default' => ''
            )
        );

        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, $name, array(
            'section' => $section,
            'label' => $label,
            'mime_type' => $type
        )));
    }


    /**
     * @param WP_Customize_Manager $wp_customize
     * @param $name
     * @param $diplayname
     * @param $panel
     * @return array
     */
    private static function addSection($wp_customize, $name, $diplayname, $panel, $priority)
    {
        $wp_customize->add_section(
            self::$sectionBase . "_options_section_$name",
            array(
                'title' => __($diplayname, self::$textDomain),
                'priority' => $priority,
                'panel' => $panel
            )
        );

        return ["full" => self::$sectionBase . "_options_section_$name", "name" => $name];
    }

}
