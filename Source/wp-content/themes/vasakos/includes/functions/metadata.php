<?php
function get_site_metadata($type='title'){
    global $post;
    switch ($type){
        case 'title':
            if(is_home() || is_front_page()) return get_post_meta($post->ID, '_yoast_wpseo_title', true) ? replacements_yoast(get_post_meta($post->ID, '_yoast_wpseo_title', true)) : get_the_title($post->ID);
            if(is_page()) return  get_post_meta($post->ID, '_yoast_wpseo_title', true) ? replacements_yoast(get_post_meta($post->ID, '_yoast_wpseo_title', true)) : get_the_title($post->ID);
            if(is_single()) return  get_post_meta($post->ID, '_yoast_wpseo_title', true) ? replacements_yoast(get_post_meta($post->ID, '_yoast_wpseo_title', true)) : get_the_title($post->ID);
            if(is_archive()) return the_archive_title();
            if(is_404()) return 'Ουπς! Η Σελίδα δεν βρέθηκε...';
            if(is_search()) return 'Αναζήτηση για: '.$_GET['s'];
            if(is_tax() || is_category() || is_tag()){
                $taxonomy = get_queried_object()->taxonomy;
                $term_id = get_queried_object()->term_id;
                $meta   = get_option( 'wpseo_taxonomy_meta' );
                $title  = $meta[$taxonomy][$term_id]['wpseo_title'];
                if ( isset($meta) && !empty($title) ) :
                    return  replacements_yoast( $title );
                else :
                    single_term_title();
                endif;
            }
            break;
        case 'description':
            if(is_home() || is_front_page())  return get_post_meta($post->ID, '_yoast_wpseo_metadesc', true) ? replacements_yoast(get_post_meta($post->ID, '_yoast_wpseo_metadesc', true)) : get_the_excerpt($post->ID);
            if(is_page()) return  get_post_meta($post->ID, '_yoast_wpseo_metadesc', true) ? replacements_yoast(get_post_meta($post->ID, '_yoast_wpseo_metadesc', true)) : get_the_excerpt($post->ID);
            if(is_single()) return  get_post_meta($post->ID, '_yoast_wpseo_metadesc', true) ? replacements_yoast(get_post_meta($post->ID, '_yoast_wpseo_metadesc', true)) : get_the_excerpt($post->ID);
            if(is_archive()) return  the_archive_description();
            if(is_404()) return 'Ουπς! Η Σελίδα δεν βρέθηκε...';
            if(is_search()) return 'Αναζήτηση για: '.$_GET['s'];
            if(is_tax() || is_category() || is_tag()){
                $taxonomy = get_queried_object()->taxonomy;
                $term_id = get_queried_object()->term_id;
                $meta   = get_option( 'wpseo_taxonomy_meta' );
                $title  = $meta[$taxonomy][$term_id]['wpseo_desc'];
                if ( isset($meta) && !empty($title) ) :
                    return  replacements_yoast($title);
                else :
                    return strip_tags(term_description($term_id));
                endif;
            }
            break;
        case 'canonical':
            if(is_home() || is_front_page()) return wp_get_canonical_url($post->ID);
            if(is_page()) return wp_get_canonical_url($post->ID);
            if(is_single()) return wp_get_canonical_url($post->ID);
            if(is_404()) return get_bloginfo( 'wpurl' );
            if(is_search()) return get_bloginfo( 'wpurl' );
            if(is_tax() || is_category() || is_tag()){
                $term_id = get_queried_object()->term_id;
                return get_term_link($term_id);
            }
            break;
        case 'image':
            $defaultImage = '';
            if(is_home() || is_front_page()) return get_the_post_thumbnail_url($post->ID) ?: $defaultImage;
            if(is_page()) return get_the_post_thumbnail_url($post->ID) ?: $defaultImage;
            if(is_single()) return get_the_post_thumbnail_url($post->ID) ?: $defaultImage;
            if(is_404()) return get_the_post_thumbnail_url($post->ID) ?: $defaultImage;
            if(is_search()) return get_the_post_thumbnail_url($post->ID) ?: $defaultImage;
            if(is_archive()) return $defaultImage;
            if(is_tax() || is_category() || is_tag()){
                return get_the_post_thumbnail_url($post->ID) ?: $defaultImage;
            }
            break;
        case 'index':
            $index =  get_post_meta($post->ID,'_yoast_wpseo_meta-robots-noindex',true);
            $follow =  get_post_meta($post->ID,'_yoast_wpseo_meta-robots-nofollow',true);
            if (isset($index, $follow) && $index === '1' && $follow === '1') {
                return 'noindex,nofollow';
            }
            if (isset($index, $follow) &&  empty($index) && $follow === '1') {
                return 'index,nofollow';
            }
            if (isset($index, $follow) && $index === '1' && empty($follow)) {
                return 'noindex,follow';
            }
            return 'index,follow';
            break;
    }
}

function replacements_yoast($content){
    global $post;
    $primary_cat_id=get_post_meta($post->ID,'_yoast_wpseo_primary_category',true);
    $product_cat = get_term($primary_cat_id, 'category');
    $primary_cat_name = $product_cat->name;
    if(!$primary_cat_id){
        $categories = get_the_category();
        $primary_cat_name = $categories[0]->name;
    }
    $content = str_replace('%%sep%%','|',$content);
    $content = str_replace('%%page%%','',$content);
    $content = str_replace('%%sitename%%',get_bloginfo( 'name' ),$content);
    $content = str_replace('%%title%%',get_the_title($post->ID),$content);
    $content = str_replace('%%term_title%%',single_term_title("",false),$content);
    $content = str_replace('%%primary_category%%',$primary_cat_name,$content);
    return $content;
}