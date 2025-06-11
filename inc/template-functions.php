<?php
/**
 * Custom template functions for this theme
 */

if (!function_exists('wp_zenblog_comment_template')) {
    /**
     * Template for comments and pingbacks.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     *
     * @param WP_Comment $comment The comment object.
     * @param array     $args    An array of arguments.
     * @param int       $depth   Depth of comment.
     */
    function wp_zenblog_comment_template($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;

        // Get comment author's initial
        $author = get_comment_author();
        $initial = strtoupper(substr($author, 0, 1));
        if (strpos($author, ' ') !== false) {
            $name_parts = explode(' ', $author);
            $initial = strtoupper(substr($name_parts[0], 0, 1) . substr(end($name_parts), 0, 1));
        }

        // Generate a random pastel background color class
        $colors = array(
            'bg-blue-100 text-blue-600',
            'bg-green-100 text-green-600',
            'bg-purple-100 text-purple-600',
            'bg-orange-100 text-orange-600',
            'bg-pink-100 text-pink-600'
        );
        $color_class = $colors[array_rand($colors)];
        ?>
        
        <div id="comment-<?php comment_ID(); ?>" class="bg-white p-6 rounded-xl shadow-sm">
            <div class="flex items-center mb-4">
                <div class="w-10 h-10 rounded-full <?php echo esc_attr($color_class); ?> flex items-center justify-center">
                    <span class="font-semibold"><?php echo esc_html($initial); ?></span>
                </div>
                <div class="ml-3">
                    <h4 class="font-bold">
                        <?php echo esc_html(get_comment_author()); ?>
                        <?php if (get_comment_author_url()) : ?>
                            <a href="<?php echo esc_url(get_comment_author_url()); ?>" class="text-blue-600 hover:text-blue-800" target="_blank" rel="nofollow">
                                <i class="fas fa-link text-sm ml-1"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($comment->user_id === get_the_author_meta('ID')) : ?>
                            <span class="text-blue-600 text-sm">(Author)</span>
                        <?php endif; ?>
                    </h4>
                    <p class="text-gray-500 text-sm">
                        <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
                            <?php
                            printf(
                                /* translators: 1: date, 2: time */
                                __('%1$s at %2$s'),
                                get_comment_date(),
                                get_comment_time()
                            );
                            ?>
                        </a>
                        <?php edit_comment_link(__('(Edit)'), ' • ', ''); ?>
                    </p>
                </div>
            </div>

            <?php if ($comment->comment_approved == '0') : ?>
                <p class="text-yellow-600 mb-4">
                    <em><?php _e('Your comment is awaiting moderation.'); ?></em>
                </p>
            <?php endif; ?>

            <div class="text-gray-700">
                <?php comment_text(); ?>
            </div>

            <?php
            comment_reply_link(array_merge($args, array(
                'add_below' => 'comment',
                'depth'     => $depth,
                'max_depth' => $args['max_depth'],
                'before'    => '<div class="mt-4">',
                'after'     => '</div>',
                'reply_text' => '<span class="text-blue-600 hover:text-blue-800 text-sm font-medium">Reply</span>'
            )));
            ?>
        </div>

        <?php if ($args['has_children']) : ?>
            <div class="ml-8 pl-4 border-l-2 border-gray-200 mt-6">
        <?php endif;
    }
}

// Add other template functions below... 