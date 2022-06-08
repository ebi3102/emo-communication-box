<?php
class Class_icon_representation
{
    private $plugin_url;
    private $location_settings;
    private $bg_color;
    private $shadow;

    public function  __construct()
    {
        global $ecb_plugin_url;
        $this->plugin_url = $ecb_plugin_url;
        $this->location_settings = get_option('style-ecb-location');
        $this->bg_color = get_option('style-ecb-color');
        $this->shadow = (get_option('style-ecb-shadow') != false)? 'fab-shadow':'';

    }

    /**
	 * Render Icon template
	 *
     * @param array $args array(array1(url => , icon_url => , tooltip =>), array2... )
     * 
     * @return void | ' '
	 */

    public function render_icon_template(array $args)
    {
        if(!is_array($args) || count($args) == 0){
            return ' ';
        }
        echo '<div class="fab-container">';
        if(count($args) == 1){
            foreach($args as $arg){
                echo '<div class="fab round '.  $this->location_settings . ' '. $this->bg_color . '" data-tooltip="'. $arg['tooltip'].
            '" id="fab1"><a href="'.$arg['url'].'"><img id="fab1" style="width: 30px" src="'. $arg['icon_url'] .'" alt="'. $arg['tooltip'].'"></a></div>';
            }
        }else{
            echo '<div class="inner-fabs">';
            foreach($args as $arg){
                echo '<div class="fab round '.  $this->location_settings . ' '. $this->bg_color . '" id="fab4" data-tooltip="'. $arg['tooltip'].
            '" id="fab1"><a href="'.$arg['url'].'"><img style="width: 20px" src="'. $arg['icon_url'] .'" alt="'. $arg['tooltip'].'"></a></div>';
            }

            echo '</div>';
            echo '<div class="fab round '.  $this->location_settings . ' '. $this->bg_color .
            '" id="fab1"><img id="fab1" style="width: 30px" src="'. $this->plugin_url .'assets/images/chat.png" alt=""></div>';
        }
        echo '</div>';
    }

}
