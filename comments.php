<?php
/**
 * The template for displaying comments
 */

if (post_password_required()) {
    return;
}
?>

<div class="mt-12 pt-8 border-t border-gray-200">
    <h3 class="text-2xl font-bold mb-6">
        <?php
        $comments_number = get_comments_number();
        if ($comments_number === 0) {
            echo 'No Comments';
        } else {
            printf(
                _n('Comments (%s)', 'Comments (%s)', $comments_number, 'wp-zenblog'),
                number_format_i18n($comments_number)
            );
        }
        ?>
    </h3>

    <?php if (comments_open()) : ?>
        <!-- Comment Form -->
        <div class="bg-gray-50 p-6 rounded-xl mb-8">
            <h4 class="text-lg font-bold mb-4"><?php _e('Leave a comment', 'wp-zenblog'); ?></h4>
            
            <?php
            comment_form(array(
                'class_form' => 'comment-form',
                'comment_field' => sprintf(
                    '<div class="mb-4"><label for="comment" class="block text-gray-700 mb-1">%s</label><textarea id="comment" name="comment" rows="4" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea></div>',
                    _x('Comment', 'noun')
                ),
                'fields' => array(
                    'author' => sprintf(
                        '<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4"><div><label for="author" class="block text-gray-700 mb-1">%s</label><input type="text" id="author" name="author" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required></div>',
                        __('Name')
                    ),
                    'email' => sprintf(
                        '<div><label for="email" class="block text-gray-700 mb-1">%s</label><input type="email" id="email" name="email" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required></div></div>',
                        __('Email')
                    ),
                ),
                'class_submit' => 'bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300',
                'label_submit' => __('Post Comment'),
                'title_reply' => '',
                'comment_notes_before' => '',
                'comment_notes_after' => '',
            ));
            ?>
        </div>
    <?php endif; ?>

    <?php if (have_comments()) : ?>
        <!-- Existing Comments -->
        <div class="space-y-6">
            <?php
            if (function_exists('wp_zenblog_comment_template')) {
                wp_list_comments(array(
                    'style' => 'div',
                    'callback' => 'wp_zenblog_comment_template',
                    'reverse_top_level' => false,
                ));
            } else {
                // Fallback to default comment template if our custom one is not available
                wp_list_comments(array(
                    'style' => 'div',
                    'reverse_top_level' => false,
                ));
            }
            ?>
        </div>

        <?php
        the_comments_pagination(array(
            'prev_text' => '<span class="text-blue-600 hover:text-blue-800">' . __('Previous', 'wp-zenblog') . '</span>',
            'next_text' => '<span class="text-blue-600 hover:text-blue-800">' . __('Next', 'wp-zenblog') . '</span>',
        ));
        ?>

    <?php endif; ?>
</div> 