<?php get_header(); ?>

<?php if (have_posts()): while (have_posts()): the_post(); 
    // Get author info
    $author_id = get_the_author_meta('ID');
    $author_name = get_the_author();
    $author_initials = substr($author_name, 0, 1);
    
    // Get post date and read time
    $post_date = get_the_date('F j, Y');
    $content = get_the_content();
    $word_count = str_word_count(strip_tags($content));
    $read_time = ceil($word_count / 200); // Assume 200 words per minute reading speed
?>

<!-- Page Header -->
<div class="bg-gradient-to-r from-blue-500 to-indigo-600 py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-6"><?php the_title(); ?></h1>
            <?php if (!is_front_page()): // Hiển thị thông tin tác giả chỉ khi không phải trang chủ ?>
            <div class="flex items-center text-white">
                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                    <span class="text-white font-semibold"><?php echo esc_html($author_initials); ?></span>
                </div>
                <div class="ml-3">
                    <p class="font-medium"><?php echo esc_html($author_name); ?></p>
                    <p class="text-sm opacity-80">
                        <?php echo esc_html($post_date); ?> 
                        <?php if ($read_time > 0): ?>
                            · <?php echo esc_html($read_time); ?> min read
                        <?php endif; ?>
                    </p>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Featured Image -->
<?php if (has_post_thumbnail()): ?>
<div class="container mx-auto px-4 -mt-12">
    <div class="max-w-4xl mx-auto">
        <div class="rounded-xl overflow-hidden shadow-xl">
            <?php the_post_thumbnail('full', array('class' => 'w-full h-auto')); ?>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Page Content -->
<div class="container mx-auto px-4 py-12">
    <div class="max-w-3xl mx-auto">
        <!-- Social Share Sidebar (Desktop) -->
        <div class="hidden lg:block fixed left-8 top-1/3 space-y-4">
            <div class="flex flex-col items-center space-y-4">
                <span class="text-gray-500 text-sm font-medium">Share</span>
                <button onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>', '_blank')" 
                        class="share-button w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition duration-300">
                    <i class="fab fa-facebook-f"></i>
                </button>
                <button onclick="window.open('https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>', '_blank')"
                        class="share-button w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition duration-300">
                    <i class="fab fa-twitter"></i>
                </button>
                <button onclick="window.open('https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>', '_blank')"
                        class="share-button w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition duration-300">
                    <i class="fab fa-linkedin-in"></i>
                </button>
                <button onclick="navigator.clipboard.writeText(window.location.href); alert('Link copied to clipboard!');"
                        class="share-button w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition duration-300">
                    <i class="fas fa-link"></i>
                </button>
            </div>
        </div>

        <!-- Page Content -->
        <article class="article-content prose lg:prose-xl text-gray-800">
            <?php the_content(); ?>
        </article>

        <?php if (!is_front_page()): // Hiển thị thông tin tác giả chỉ khi không phải trang chủ ?>
        <!-- Author Bio -->
        <div class="mt-12 pt-8 border-t border-gray-200">
            <div class="flex items-center">
                <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center">
                    <?php echo get_avatar($author_id, 64, '', '', array('class' => 'rounded-full')); ?>
                </div>
                <div class="ml-4">
                    <h3 class="font-bold text-lg">Written by <?php echo esc_html($author_name); ?></h3>
                    <p class="text-gray-600"><?php echo esc_html(get_the_author_meta('description')); ?></p>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Social Share (Mobile) -->
        <div class="mt-8 lg:hidden">
            <h3 class="text-lg font-bold mb-4">Share this page</h3>
            <div class="flex space-x-4">
                <button onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>', '_blank')"
                        class="share-button w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition duration-300">
                    <i class="fab fa-facebook-f"></i>
                </button>
                <button onclick="window.open('https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>', '_blank')"
                        class="share-button w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition duration-300">
                    <i class="fab fa-twitter"></i>
                </button>
                <button onclick="window.open('https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>', '_blank')"
                        class="share-button w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition duration-300">
                    <i class="fab fa-linkedin-in"></i>
                </button>
                <button onclick="navigator.clipboard.writeText(window.location.href); alert('Link copied to clipboard!');"
                        class="share-button w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition duration-300">
                    <i class="fas fa-link"></i>
                </button>
            </div>
        </div>

        <!-- Comments Section -->
        <?php 
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;
        ?>
    </div>
</div>

<?php endwhile; endif; ?>

<?php get_footer(); ?> 