<?php 
namespace Drupal\gavias_blockbuilder\shortcodes;
if(!class_exists('gsc_services_carousel')):
   class gsc_services_carousel{

      public function render_form(){
         $fields = array(
            'type' => 'gsc_services_carousel',
            'title' => t('Services Carousel'),
            'size' => 3,
            'fields' => array(
               array(
                  'id'     => 'title',
                  'type'      => 'text',
                  'title'  => t('Title For Admin'),
               ),
               array(
                  'id'     => 'more_link',
                  'type'      => 'text',
                  'title'  => t('Link view more'),
               ),
               array(
                  'id'     => 'more_text',
                  'type'      => 'textlangs',
                  'title'  => t('Text Link view more'),
               ),
               array(
                  'id'     => 'animate',
                  'type'      => 'select',
                  'title'  => ('Animation'),
                  'desc'  => t('Entrance animation for element'),
                  'options'   => gavias_blockbuilder_animate(),
               ),
               array(
                  'id'        => 'el_class',
                  'type'      => 'text',
                  'title'     => t('Extra class name'),
                  'desc'      => t('Style particular content element differently - add a class name and refer to it in custom CSS.'),
               ),   
            ),                                     
         );

         for($i=1; $i<=10; $i++){
            $fields['fields'][] = array(
               'id'     => "info_${i}",
               'type'   => 'info',
               'desc'   => "Information for item {$i}"
            );
            $fields['fields'][] = array(
               'id'        => "title_{$i}",
               'type'      => 'textlangs',
               'title'     => t("Title {$i}")
            );
            $fields['fields'][] = array(
               'id'           => "icon_{$i}",
               'type'         => 'text',
               'title'        => t("Icon {$i}"),
            );
            $fields['fields'][] = array(
               'id'        => 'image_{$i}',
               'type'      => 'upload',
               'title'     => t('Image Icon'),
               'desc'      => t('Use image icon instead of icon class'),
            );
            $fields['fields'][] = array(
               'id'        => "link_{$i}",
               'type'      => 'text',
               'title'     => t("Link {$i}")
            );
         }
         return $fields;
      }

      public function render_content( $item ) {
         print self::sc_services_carousel( $item['fields'] );
      }

      public static function sc_services_carousel( $attr, $content = null ){
         global $base_url;
         $default = array(
            'title'      => '',
            'more_link'  => '',
            'more_text'  => 'View all services',
            'el_class'   => '',
            'animate'    => '',
         );

         for($i=1; $i<=10; $i++){
            $default["title_{$i}"] = '';
            $default["icon_{$i}"] = '';
            $default["link_{$i}"] = '';
            $default["image_{$i}"] = '';
         }

         extract(shortcode_atts($default, $attr));

         if($animate){
            $el_class .= ' wow';
            $el_class .= ' ' . $animate;
         }
         $_id = gavias_blockbuilder_makeid();
         
         ?>
         <?php ob_start() ?>
         <div class="gsc-service-carousel <?php echo $el_class ?>"> 
            <div class="owl-carousel init-carousel-owl owl-loaded owl-drag" data-items="6" data-items_lg="6" data-items_md="5" data-items_sm="4" data-items_xs="2" data-loop="1" data-speed="500" data-auto_play="1" data-auto_play_speed="2000" data-auto_play_timeout="5000" data-auto_play_hover="1" data-navigation="1" data-rewind_nav="0" data-pagination="0" data-mouse_drag="1" data-touch_drag="1">
               <?php for($i=1; $i<=10; $i++){ ?>
                  <?php 
                     $title = "title_{$i}";
                     $icon = "icon_{$i}";
                     $link = "link_{$i}";
                     $image = "image_{$i}";
                     $link = gavias_render_textlangs($link);
                  ?>
                  <?php if(gavias_render_textlangs($$title)){ ?>
                     <div class="item"><div class="content-inner">
                     <?php if($$icon){ ?><div class="icon"><a href="<?php print $$link ?>"><i class="<?php print $$icon ?>"></i></a></div><?php } ?>         
                     <?php if($$image){?><div class="icon"><a href="<?php print $$link ?>"><img src="<?php echo ($base_url . $$image) ?>"></i></a></div><?php } ?>
                     <?php if($$title){ ?><div class="title"><a href="<?php print $$link ?>"><?php print gavias_render_textlangs($$title) ?></a></div><?php } ?>
                     </div></div>
                  <?php } ?>    
               <?php } ?>
            </div> 
            <?php if($more_link){ ?>
               <div class="read-more"><a class="btn-theme" href="<?php print $more_link ?>"><?php print gavias_render_textlangs($more_text) ?></a></div>
            <?php } ?>   
         </div>   

         <?php return ob_get_clean();
      }

      public function load_shortcode(){
         add_shortcode( 'services_carousel', array($this, 'sc_services_carousel') );
      }
   }
 endif;  



