<?php get_header(); ?>

<?php if (have_posts()): while (have_posts()): the_post(); 
    // Get category
    $categories = get_the_category();
    $category_name = $categories ? $categories[0]->name : '';
    
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

<!-- Article Header -->
<div class="bg-gradient-to-r from-blue-500 to-indigo-600 py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <?php if ($category_name): ?>
            <div class="bg-white/10 text-white px-3 py-1 rounded-full inline-block mb-4">
                <span><?php echo esc_html($category_name); ?></span>
            </div>
            <?php endif; ?>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-6"><?php the_title(); ?></h1>
            <div class="flex items-center text-white">
                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                    <span class="text-white font-semibold"><?php echo esc_html($author_initials); ?></span>
                </div>
                <div class="ml-3">
                    <p class="font-medium"><?php echo esc_html($author_name); ?></p>
                    <p class="text-sm opacity-80"><?php echo esc_html($post_date); ?> · <?php echo esc_html($read_time); ?> min read</p>
                </div>
            </div>
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

<!-- Article Content -->
<div class="container mx-auto px-4 py-12">
    <div class="max-w-3xl mx-auto">
        <!-- Social Share Sidebar (Desktop) -->
        <div class="hidden lg:block fixed left-8 top-1/3 space-y-4">
            <div class="flex flex-col items-center space-y-4">
                <span class="text-gray-500 text-sm font-medium">Share</span>
                <button class="share-button w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition duration-300">
                    <i class="fab fa-facebook-f"></i>
                </button>
                <button class="share-button w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition duration-300">
                    <i class="fab fa-twitter"></i>
                </button>
                <button class="share-button w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition duration-300">
                    <i class="fab fa-linkedin-in"></i>
                </button>
                <button class="share-button w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition duration-300">
                    <i class="fas fa-link"></i>
                </button>
            </div>
        </div>

        <!-- Article Content -->
        <article class="article-content prose lg:prose-xl text-gray-800">
            <?php the_content(); ?>
        </article>

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

        <!-- Social Share (Mobile) -->
        <div class="mt-8 lg:hidden">
            <h3 class="text-lg font-bold mb-4">Share this article</h3>
            <div class="flex space-x-4">
                <button class="share-button w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition duration-300">
                    <i class="fab fa-facebook-f"></i>
                </button>
                <button class="share-button w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition duration-300">
                    <i class="fab fa-twitter"></i>
                </button>
                <button class="share-button w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition duration-300">
                    <i class="fab fa-linkedin-in"></i>
                </button>
                <button class="share-button w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition duration-300">
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

<!-- Related Posts -->
<section class="bg-gray-50 py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-12 text-center">You Might Also Enjoy</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <?php
            $related_args = array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'post__not_in' => array(get_the_ID()),
                'orderby' => 'rand'
            );
            
            $related_query = new WP_Query($related_args);
            
            if ($related_query->have_posts()) :
                while ($related_query->have_posts()) : $related_query->the_post();
                    $post_categories = get_the_category();
                    $category = $post_categories ? $post_categories[0] : null;
            ?>
            <div class="related-post bg-white rounded-xl overflow-hidden shadow-md">
                <div class="h-48 overflow-hidden">
                    <?php if (has_post_thumbnail()): ?>
                        <?php the_post_thumbnail('medium_large', array('class' => 'w-full h-full object-cover')); ?>
                    <?php endif; ?>
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <?php if ($category): ?>
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">
                            <?php echo esc_html($category->name); ?>
                        </span>
                        <?php endif; ?>
                        <span class="ml-auto text-gray-500 text-sm"><?php echo get_the_date('M j, Y'); ?></span>
                    </div>
                    <h3 class="text-xl font-bold mb-3"><?php the_title(); ?></h3>
                    <p class="text-gray-600 mb-4"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                    <a href="<?php the_permalink(); ?>" class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                        Read More
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
            <?php 
                endwhile;
                wp_reset_postdata();
            endif; 
            ?>
        </div>
    </div>
</section>

<?php endwhile; endif; ?>

<?php get_footer(); ?>