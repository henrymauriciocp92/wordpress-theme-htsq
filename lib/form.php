<?php 

/**
 * Controls gravyti forms
 */
add_filter('gform_pre_render_2', 'qt_populate_posts');
function qt_populate_posts($form){
    
    foreach($form['fields'] as &$field) {
    
            if( $field->id != 3){
                continue;
            }

            $posts = get_posts ( array(

                'posts_per_page'=>10

                ));

            $choices = array();

            foreach ($posts as $post){
                
                $choices[] = array (
                    'text' => $post->post_title,
                    'value' => $post->id,
                    'isSelected' => false,
                );
            }
            $field->choices = $choices;
        }
        return $form;


    }

 ?>
