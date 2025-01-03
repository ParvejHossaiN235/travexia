<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package travexia
 */

// header logo
function travexia_header_logo()
{ ?>
    <a href="<?php echo esc_url(home_url('/')); ?>">
        <?php
        $travexia_custom_logo_id = get_theme_mod('custom_logo');
        $travexia_logo = wp_get_attachment_image_src($travexia_custom_logo_id, 'full');
        if (has_custom_logo()) {
            echo '<img src="' . esc_url($travexia_logo[0]) . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
        } else {
            echo '<h1>' . esc_html(get_bloginfo('name')) . '</h1>';
        }
        ?>
    </a>
<?php
}

function travexia_sidepanel_logo()
{
    $side_logo = get_theme_mod('side_logo');
    $side_logo_link = get_theme_mod('side_logo_link');
?>
    <a href="<?php echo esc_url($side_logo_link); ?>">
        <img src="<?php echo esc_url($side_logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" />
    </a>
<?php
}

/**
 * [travexia_header_menu description]
 * @return [type] [description]
 */
function travexia_header_menu()
{
?>
    <?php
    wp_nav_menu([
        'theme_location' => 'main-menu',
        'menu_class'     => 'menu',
        'container'      => '',
        'fallback_cb'    => 'Hexa_Navwalker_Class::fallback',
        'walker'         => new \HexaCore\Widgets\Hexa_Navwalker_Class,
    ]);
    ?>
    <?php
}

// travexia_search_filter_form
if (!function_exists('travexia_search_filter_form')) {
    function travexia_search_filter_form($form)
    {
        $form = sprintf(
            '<div class="sidebar-search">
                <form action="%s" method="get">
                    <div class="sidebar-search-input">
                        <input type="text" value="%s" required name="s" placeholder="%s">
                        <button type="submit"><i class="far fa-search"></i></button>
                    </div>
                </form>
            </div>',
            esc_url(home_url('/')),
            esc_attr(get_search_query()),
            esc_html__('Search Here...', 'travexia')
        );
        return $form;
    }
    add_filter('get_search_form', 'travexia_search_filter_form');
}

/**
 * travexia comment 
 */
if (!function_exists('travexia_comment postbox-details-comment-inner')) {
    function travexia_comment($comment, $args, $depth)
    {
        $GLOBAL['comment'] = $comment;
        extract($args, EXTR_SKIP);
        $args['reply_text'] = '<div class="postbox-details-comment-reply">
        Reply
     </div>';
        $replayClass = 'comment-depth-' . esc_attr($depth);
    ?>

        <li id="comment-<?php comment_ID(); ?>" class="comment-list ">
            <div class="postbox-comment-box p-relative postbox-comment-info d-flex align-items-start mb-40">
                <div class="postbox-comment-avater postbox-user-thumb">
                    <?php print get_avatar($comment, 102, null, null, ['class' => []]); ?>
                </div>

                <div class="postbox-comment-name postbox-user-info">
                    <h4 class="user-title">
                        <?php print ucwords(get_the_author()); ?>
                    </h4>
                    <span class="post-meta m-0 mb-15 p-0">
                        <?php comment_time(get_option('date_format')); ?>
                    </span>

                    <div class="postbox-comment-text mt-15">
                        <?php comment_text(); ?>
                    </div>
                    <div class="postbox-comment-reply postbox-user-reply">
                        <?php comment_reply_link(array_merge($args, ['reply_text' => __('<button> Reply</button>', 'travexia'), 'depth' => $depth, 'max_depth' => $args['max_depth']])); ?>
                    </div>
                </div>
            </div>
    <?php
    }
}

/** Post time **/
if (!function_exists('travexia_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function travexia_posted_on()
    {

        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date())
        );

        $posted_on = sprintf(
            /* translators: %s: post date. */
            esc_html_x('%s', 'post date', 'travexia'),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
        );

        echo '<span class="posted-on"> ' . $posted_on . '</span>'; // WPCS: XSS OK.

    };
endif;

/** Post category **/
if (!function_exists('travexia_posted_in')) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function travexia_posted_in()
    {
        $categories_list = get_the_category_list(esc_html__(' ', 'travexia'));
        $posted_in = '';
        if (!empty($categories_list)) {
            /* translators: 1: list of categories. */
            $posted_in = sprintf(esc_html__('%1$s', 'travexia'), $categories_list); // WPCS: XSS OK.
        }

        echo '<div class="post-cat"><span class="posted-in">' . $posted_in . '</span></div>'; // WPCS: XSS OK.

    };
endif;

/** Post author **/
if (!function_exists('travexia_posted_by')) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function travexia_posted_by()
    {
        $byline = sprintf(
            /* translators: %s: post author. */
            esc_html_x('%s', 'post author', 'travexia'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

    }
endif;

/** Socials Share Post**/
if (!function_exists('travexia_socials_share')) :

    function travexia_socials_share()
    {
        $share = get_theme_mod('post_socials');
        echo '<div class="share-post">';

        if (in_array('twit', $share)) echo '<a class="twit" target="_blank" href="https://twitter.com/intent/tweet?text=' . get_the_title() . '&url=' . get_the_permalink() . '" title="Twitter"><i class="fab fa-twitter"></i></a>';
        if (in_array('face', $share)) echo '<a class="face" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '" title="Facebook"><i class="fab fa-facebook-f"></i></a>';
        if (in_array('pint', $share)) echo '<a class="pint" target="_blank" href="https://www.pinterest.com/pin/create/button/?url=' . get_the_permalink() . '&description=' . get_the_title() . '" title="Pinterest"><i class="fab fa-pinterest-p"></i></a>';
        if (in_array('link', $share)) echo '<a class="linked" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=' . get_the_permalink() . '&title=' . get_the_title() . '&summary=' . esc_url(get_home_url('/')) . '&source=' . get_bloginfo('name') . '" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>';
        if (in_array('google', $share)) echo ' <a class="google" target="_blank" href="https://plus.google.com/share?url=' . get_the_permalink() . '" title="Google Plus"><i class="fab fa-google-plus-g"></i></a>';
        if (in_array('tumblr', $share)) echo ' <a class="tumblr" target="_blank" href="http://www.tumblr.com/share/link?url=' . get_the_permalink() . '&name=' . get_the_title() . '&description=' . get_the_excerpt() . '" title="Tumblr"><i class="fab fa-tumblr"></i></a>';
        if (in_array('reddit', $share)) echo '<a class="reddit" href="http://reddit.com/submit?url=' . get_the_permalink() . '&title=' . get_the_title() . '" target="_blank" title="Reddit"><i class="fab fa-reddit-alien" aria-hidden="true"></i></a>';
        if (in_array('vk', $share)) echo '<a class="vk" href="http://vk.com/share.php?url=' . get_the_permalink() . '" target="_blank" title="VK"><i class="fab fa-vk"></i></a>';

        echo '</div>';
    };
endif;

/** Single Post Navigation**/
if (!function_exists('travexia_single_post_nav')) :

    function travexia_single_post_nav()
    {
        echo '<div class="hexa-post-nav">';
        if (get_previous_post()) {
            $ppost  = get_previous_post();
            $ptitle = get_the_title($ppost->ID);
            $pdate  = get_the_time(get_option('date_format'), $ppost->ID);
            echo '<div class="post-prev">';
            previous_post_link('%link', '<span class="title">' . esc_html__('Prev', 'travexia') . '</span><h6>' . $ptitle . '</h6><span class="date">' . $pdate . '</span>');
            echo '</div>';
        }
        if (get_next_post()) {
            $npost  = get_next_post();
            $ntitle = get_the_title($npost->ID);
            $ndate  = get_the_time(get_option('date_format'), $npost->ID);
            echo '<div class="post-next">';
            next_post_link('%link', '<span class="title">' . esc_html__('Next', 'travexia') . '</span><h6>' . $ntitle . '</h6><span class="date">' . $ndate . '</span>');
            echo '</div>';
        }
        echo '</div>';
    };
endif;


if (!function_exists('travexia_posts_navigation')) :
    function travexia_pagi_callback($pagination)
    {
        return $pagination;
    }

    function travexia_posts_navigation($prev = '<i class="fa-solid fa-arrow-left-long"></i>', $next = '<i class="fa-solid fa-arrow-right-long"></i>', $pages = '')
    {
        global $wp_query, $wp_rewrite;

        $current = max(1, get_query_var('paged'));

        if ($pages == '') {
            $pages = $wp_query->max_num_pages ?: 1;
        }

        $pagination = [
            'base'      => add_query_arg('paged', '%#%'),
            'format'    => '',
            'total'     => $pages,
            'current'   => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type'      => 'array',
        ];

        if ($wp_rewrite->using_permalinks()) {
            $pagination['base'] = user_trailingslashit(trailingslashit(remove_query_arg('s', get_pagenum_link(1))) . 'page/%#%/', 'paged');
        }

        if (!empty($wp_query->query_vars['s'])) {
            $pagination['add_args'] = ['s' => get_query_var('s')];
        }

        $pagi = paginate_links($pagination);

        if ($pagi) {
            $pagination_output = '<ul class="pagination list-unstyled">';

            foreach ($pagi as $link) {
                $pagination_output .= '<li>' . $link . '</li>';
            }

            $pagination_output .= '</ul>';

            echo travexia_pagi_callback($pagination_output);
        }
    }
endif;

/** Excerpt Section Blog Post **/
function travexia_excerpt_length($length)
{
    $length = get_theme_mod('excerpt_length', 30);
    return $length; // Change the number to the desired length of words in the excerpt
}
add_filter('excerpt_length', 'travexia_excerpt_length');


function travexia_author_info_box()
{

    global $post;

    $author_details = '';
    // Get author's display name - NB! changed display_name to first_name. Error in code.
    $display_name = get_the_author_meta('display_name', $post->post_author);

    // If display name is not available then use nickname as display name
    if (empty($display_name))
        $display_name = get_the_author_meta('nickname', $post->post_author);

    // Get author's biographical information or description
    $user_post          = get_the_author_meta('user_post', $post->post_author);
    $user_twitter       = get_the_author_meta('twitter', $post->post_author);
    $user_facebook      = get_the_author_meta('facebook', $post->post_author);
    $user_skype         = get_the_author_meta('skype', $post->post_author);
    $user_linkedin      = get_the_author_meta('linkedin', $post->post_author);
    $user_youtube       = get_the_author_meta('youtube', $post->post_author);
    $user_googleplus    = get_the_author_meta('googleplus', $post->post_author);
    $user_pinterest     = get_the_author_meta('pinterest', $post->post_author);
    $user_instagram     = get_the_author_meta('instagram', $post->post_author);
    $user_github        = get_the_author_meta('github', $post->post_author);

    // Get link to the author archive page
    $user_posts = get_author_posts_url(get_the_author_meta('ID', $post->post_author));
    if (!empty($display_name))
        // Author avatar - - the number 90 is the px size of the image.
        $author_details .= '<div class="author-image">' . get_avatar(get_the_author_meta('ID'), 250) . '</div>';
    $author_details .= '<div class="author-info">';
    $author_details .= '<span class="author-post">' . esc_html__('Author', 'travexia') . '</span>';
    $author_details .= '<h6 class="author-title">' . $display_name . '</h6>';
    $author_details .= '<p class="author-des">' . get_the_author_meta('description') . '</p>';
    $author_details .= '<div class="author-socials">';

    // Check if author has Twitter in their profile
    if (!empty($user_twitter)) {
        $author_details .= ' <a href="' . $user_twitter . '" target="_blank" rel="nofollow" title="Twitter"><i class="fab fa-twitter"></i></a>';
    }

    if (!empty($user_facebook)) {
        $author_details .= ' <a href="' . $user_facebook . '" target="_blank" rel="nofollow" title="Facebook"><i class="fab fa-facebook-f"></i> </a>';
    }

    if (!empty($user_skype)) {
        $author_details .= ' <a href="' . $user_skype . '" target="_blank" rel="nofollow" title="Skype"><i class="fab fa-skype"></i> </a>';
    }

    if (!empty($user_linkedin)) {
        $author_details .= ' <a href="' . $user_linkedin . '" target="_blank" rel="nofollow" title="LinkedIn"><i class="fab fa-linkedin-in"></i> </a>';
    }

    if (!empty($user_youtube)) {
        $author_details .= ' <a href="' . $user_youtube . '" target="_blank" rel="nofollow" title="Youtube"><i class="fab fa-youtube"></i> </a>';
    }

    if (!empty($user_googleplus)) {
        $author_details .= ' <a href="' . $user_googleplus . '" target="_blank" rel="nofollow" title="Google+"><i class="fab fa-google-plus"></i> </a>';
    }

    if (!empty($user_pinterest)) {
        $author_details .= ' <a href="' . $user_pinterest . '" target="_blank" rel="nofollow" title="Pinterest"><i class="fab fa-pinterest"></i> </a>';
    }

    if (!empty($user_instagram)) {
        $author_details .= ' <a href="' . $user_instagram . '" target="_blank" rel="nofollow" title="Instagram"><i class="fab fa-instagram"></i> </a>';
    }

    if (!empty($user_github)) {
        $author_details .= ' <a href="' . $user_github . '" target="_blank" rel="nofollow" title="Github"><i class="fab fa-github"></i> </a>';
    }

    $author_details .= '</div></div>';

    // Pass all this info to post content 
    echo '<div class="author-bio" >' . $author_details . '</div>';
}
