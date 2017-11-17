<?php 
namespace Drupal\gavias_blockbuilder\shortcodes;
if(!class_exists('gsc_heading')):
   class gsc_heading{
      public function render_form(){
         $fields = array(
            'type'      => 'gsc_heading',
            'title'     => t('Heading'), 
            'size'      => 3, 
            
            'fields'    => array(
               array(
                  'id'        => 'title',
                  'type'      => 'textlangs',
                  'title'     => t('Title'),
                  'class'     => 'display-admin'
               ),
               array(
                  'id'        => 'sub_title',
                  'type'      => 'textlangs',
                  'title'     => t('Sub Title'),
                  'class'     => 'display-admin'
               ),
               array(
                  'id'        => 'desc',
                  'type'      => 'textarealangs',
                  'title'     => t('Description'),
               ),
               array(
                  'id'        => 'icon',
                  'type'      => 'text',
                  'title'     => t('Icon for heading'),
                  'desc'     => t('Use class icon font <a target="_blank" href="http://fontawesome.io/icons/">Icon Awesome</a>'),
               ),
               array(
                  'id'        => 'align',
                  'type'      => 'select',
                  'title'     => t('Align text for heading'),
                  'options'   => array(
                        'align-center' => 'Align Center',
                        'align-left'   => 'Align Left',
                        'align-right'  => 'Align Right'
                  ),
                  'std'       => 'align-center'
               ),
               array(
                  'id'        => 'style',
                  'type'      => 'select',
                  'title'     => t('Style display'),
                  'options'   => array(
                        'style-1'         => 'Style v1',
                        'style-2'         => 'Style v2',
                        'style-3'         => 'Style v3 (Big heading)',
                        'style-1 small'   => 'Style v4',
                        'style-5'         => 'Style v5',
                        'style-6'         => 'Style v6'

                  )
               ),
               array(
                  'id'        => 'style_text',
                  'type'      => 'select',
                  'title'     => t('Skin Text for box'),
                  'options'   => array(
                        'text-dark'   => 'Text dark',
                        'text-light'   => 'Text light'
                  )
               ),
               array(
                  'id'        => 'remove_padding',
                  'type'      => 'select',
                  'title'     => t('Remove Padding'),
                  'options'   => array(
                        ''                   => 'Default',   
                        'padding-top-0'      => 'Remove padding top',
                        'padding-bottom-0'    => 'Remove padding bottom',
                        'padding-bottom-0 padding-top-0'   => 'Remove padding top & bottom'
                  ),
                  'std'       => '',
                  'desc'      => 'Default heading padding top & bottom: 30px'
               ),
               array(
                  'id'        => 'el_class',
                  'type'      => 'text',
                  'title'     => t('Extra class name'),
                  'desc'      => t('Style particular content element differently - add a class name and refer to it in custom CSS.'),
               ),
               array(
                  'id'        => 'animate',
                  'type'      => 'select',
                  'title'     => t('Animation'),
                  'desc'      => t('Entrance animation'),
                  'options'   => gavias_blockbuilder_animate(),
               ),
            ),                                       
         );
         return $fields;
      } 
      
      public function render_content( $item ) {
         if( ! key_exists('desc', $item['fields']) ) $item['fields']['desc'] = '';
         print self::sc_heading( $item['fields'], $item['fields']['desc'] );
      }

      public static function sc_heading( $attr, $content = null ){
         extract(shortcode_atts(array(
            'title'           => '',
            'sub_title'       => '',
            'align'           => '',
            'style'           => 'style-1',
            'icon'            => '',
            'style_text'      => 'text-dark',
            'el_class'        => '',
            'remove_padding'  => '',
            'animate'         => ''
         ), $attr));
         $class = array();
         $class[] = $el_class;
         $class[] = $align;
         $class[] = $style;
         $class[] = $style_text;
         $class[] = $remove_padding;
         if($animate){
            $class[] = 'wow';
            $class[] = $animate;
         }
         ?>
         <?php ob_start() ?>
         <?php if($style == 'style-6'){ ?>
            
            <div class="widget gsc-heading <?php print implode($class, ' ') ?>">
               <?php if($icon){?><div class="title-icon"><span><i class="<?php print $icon ?>"></i></span></div><?php } ?> 
               <?php if(gavias_render_textlangs($title)){ ?><h2 class="title"><span><?php print gavias_render_textlangs($title); ?></span></h2><?php } ?>
               <?php if(gavias_render_textlangs($sub_title)){ ?><div class="sub-title"><?php print gavias_render_textlangs($sub_title); ?></div><?php } ?>
               <div class="line"><span class="one"></span><span class="second"></span><span class="three"></span></div>
               <?php if(gavias_render_textarealangs($content)){ ?><div class="title-desc"><?php print gavias_render_textarealangs($content); ?></div><?php } ?>
            </div>
            <div class="clearfix"></div>
            
         <?php }else{ ?>

            <div class="widget gsc-heading <?php print implode($class, ' ') ?>">
               <?php if($icon){?><div class="title-icon"><span><i class="<?php print $icon ?>"></i></span></div><?php } ?> 
               <?php if(gavias_render_textlangs($sub_title)){ ?><div class="sub-title"><?php print gavias_render_textlangs($sub_title); ?></div><?php } ?>
               <?php if(gavias_render_textlangs($title)){ ?><h2 class="title"><span><?php print gavias_render_textlangs($title); ?></span></h2><?php } ?>
               <div class="line"><span class="one"></span><span class="second"></span><span class="three"></span></div>
               <?php if(gavias_render_textarealangs($content)){ ?><div class="title-desc"><?php print gavias_render_textarealangs($content); ?></div><?php } ?>
            </div>
            <div class="clearfix"></div>

            <?php } ?>

         <?php return ob_get_clean() ?>
         <?php
      }

      public function load_shortcode(){
         add_shortcode( 'heading', array($this, 'sc_heading') );
      }
   }
endif;

