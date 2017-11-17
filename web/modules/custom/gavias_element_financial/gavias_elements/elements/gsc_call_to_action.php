<?php 
namespace Drupal\gavias_blockbuilder\shortcodes;
if(!class_exists('gsc_call_to_action')):
   class gsc_call_to_action{
      public function render_form(){
         $fields = array(
            'type' => 'gsc_call_to_action',
            'title' => t('Call to Action'),
            'size' => 12,
            
            'fields' => array(
               array(
                  'id'        => 'title',
                  'type'      => 'textlangs',
                  'title'     => t('Title'),
                  'class'     => 'display-admin'
               ),
               array(
                  'id'        => 'icon',
                  'type'      => 'text',
                  'title'     => t('Icon'),
                  'desc'     => t('Use class icon font <a target="_blank" href="http://fontawesome.io/icons/">Icon Awesome</a>'),
               ),
               array(
                  'id'        => 'content',
                  'type'      => 'textarealangs',
                  'title'     => t('Content'),
                  'desc'      => t('HTML tags allowed.'),
               ),
               array(
                  'id'        => 'link',
                  'type'      => 'textlangs',
                  'title'     => t('Link'),
               ),
               array(
                  'id'        => 'button_title',
                  'type'      => 'textlangs',
                  'title'     => t('Button Title'),
                  'desc'      => t('Leave this field blank if you want Call to Action with Big Icon'),
               ),
               array(
                  'id'        => 'button_align',
                  'type'      => 'select',
                  'title'     => 'Button position',
                  'options'   => array(
                     'button-bottom'   => 'Bottom',
                     'button-left'     => 'Left',
                     'button-right'    => 'Right',
                     'button-bottom-left' => 'Bottom Left',
                     'button-bottom-right' => 'Bottom Right',
                     'button-bottom-center'   => 'Bottom Center',
                     'button-bottom-center v2'   => 'Bottom Center V2',
                  )
               ),
               array(
                  'id'        => 'style_text',
                  'type'      => 'select',
                  'title'     => 'Skin Text for box',
                  'options'   => array(
                        'text-light'   => 'Text light',
                        'text-dark'   => 'Text dark'
                  ),
                  'std'       => 'text-dark'
               ),
               array(
                  'id'     => 'target',
                  'type'      => 'select',
                  'title'  => t('Open in new window'),
                  'desc'      => t('Adds a target="_blank" attribute to the link'),
                  'options'   => array( 0 => 'No', 1 => 'Yes' ),
               ),
               array(
                  'id'        => 'el_class',
                  'type'      => 'text',
                  'title'     => t('Extra class name'),
                  'desc'      => t('Style particular content element differently - add a class name and refer to it in custom CSS.'),
               ),
               array(
                  'id'     => 'animate',
                  'type'      => 'select',
                  'title'  => t('Animation'),
                  'sub_desc'  => t('Entrance animation'),
                  'options'   => gavias_blockbuilder_animate(),
               ),
            ),                                       
         );
      return $fields;
      }

      function render_content( $item ) {
         if( ! key_exists('content', $item['fields']) ) $item['fields']['content'] = '';
         print self::sc_call_to_action( $item['fields'], $item['fields']['content'] );
      }

      function sc_call_to_action( $attr, $content = null ){
         extract(shortcode_atts(array(
            'title'        => '',
            'subtitle'     => '',
            //'content'      => '',
            'icon'         => '',
            'link'         => '',
            'button_title' => '',
            'button_align' => '',
            'target'       => '',
            'el_class'     => '',
            'animate'      => '',
            'style_text'   => 'text-dark'
         ), $attr));
         
         // target
         if( $target ){
            $target = 'target="_blank"';
         } else {
            $target = false;
         }
         
         $class = array();
         $class[] = $el_class;
         $class[] = $button_align;
         $class[] = $style_text;
         if($animate){
            $class[] = ' wow';
            $class[] = $animate;
         }
         $link = gavias_render_textlangs($link);
         ?>
         <?php ob_start() ?>
         <div class="widget gsc-call-to-action <?php print implode($class, ' ') ?>">
            <div class="content-inner clearfix">
               <div class="content">
                  <h3 class="title"><span><?php print gavias_render_textlangs($title); ?></span></h3>
                  <?php print do_shortcode(gavias_render_textarealangs($content)); ?>
               </div>
               <?php if($link){?>
               <div class="button-action">
                  <a href="<?php print $link ?>" class="btn-theme btn btn-md" <?php print $target ?>>
                     <?php if($icon){ ?>
                        <span class="icon"><i class="<?php print $icon; ?>"></i></span>
                     <?php } ?>
                     <span><?php print gavias_render_textlangs($button_title) ?></span>
                  </a>   
               </div>
               <?php } ?>
            </div>
         </div>
         <?php return ob_get_clean() ?>
      <?php
      }

      public function load_shortcode(){
         add_shortcode( 'cta', array($this, 'sc_call_to_action') );
      }
   }
endif;   



