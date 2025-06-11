<?php get_header(); ?>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6"><?php bloginfo('name'); ?></h1>
            <p class="text-xl mb-8"><?php bloginfo('description'); ?></p>
            <a href="#blog"
                class="bg-white text-blue-600 hover:bg-gray-100 px-6 py-3 rounded-full font-medium inline-block transition duration-300">
                <?php esc_html_e('Read Latest Posts', 'zenblog'); ?>
            </a>
        </div>
    </div>
</section>

<?php
// Get featured post
function zenblog_get_featured_post() {
    $method = get_theme_mod('featured_post_method', 'latest');
    $args = array('posts_per_page' => 1);

    switch ($method) {
        case 'sticky':
            $sticky = get_option('sticky_posts');
            if (!empty($sticky)) {
                $args['post__in'] = $sticky;
            }
            break;
        case 'specific':
            $post_id = get_theme_mod('featured_post_id');
            if ($post_id) {
                $args['p'] = $post_id;
            }
            break;
        case 'latest':
        default:
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
            break;
    }

    $featured_query = new WP_Query($args);
    return $featured_query->posts[0] ?? null;
}

if (get_theme_mod('featured_section_enable', true)):
    $featured_post = zenblog_get_featured_post();
    if ($featured_post):
        setup_postdata($featured_post);
?>
<!-- Featured Post -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-12 text-center">
            <?php echo esc_html(get_theme_mod('featured_section_title', __('Featured Post', 'zenblog'))); ?>
        </h2>

        <div class="featured-post max-w-5xl mx-auto bg-white rounded-xl overflow-hidden shadow-lg">
            <div class="md:flex">
                <div class="md:w-1/2 overflow-hidden">
                    <?php if (has_post_thumbnail($featured_post)): ?>
                        <?php echo get_the_post_thumbnail($featured_post, 'large', array(
                            'class' => 'w-full h-full object-cover',
                            'alt' => get_the_title($featured_post)
                        )); ?>
                    <?php else: ?>
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='600' height='400' viewBox='0 0 600 400'%3E%3Crect width='600' height='400' fill='%23e0e7ff'/%3E%3Cpath d='M0 350 L600 250 L600 400 L0 400 Z' fill='%233b82f6'/%3E%3Ccircle cx='450' cy='100' r='50' fill='%23f59e0b' opacity='0.8'/%3E%3C/svg%3E"
                            alt="<?php echo esc_attr(get_the_title($featured_post)); ?>" class="w-full h-full object-cover">
                    <?php endif; ?>
                </div>
                <div class="md:w-1/2 p-8">
                    <?php
                    $categories = get_the_category($featured_post);
                    if (!empty($categories)):
                    ?>
                        <div class="uppercase tracking-wide text-sm text-blue-600 font-semibold">
                            <?php echo esc_html($categories[0]->name); ?>
                        </div>
                    <?php endif; ?>
                    
                    <h3 class="mt-2 text-2xl font-bold">
                        <a href="<?php echo get_permalink($featured_post); ?>" class="hover:text-blue-600 transition duration-300">
                            <?php echo get_the_title($featured_post); ?>
                        </a>
                    </h3>
                    
                    <p class="mt-4 text-gray-600">
                        <?php echo wp_trim_words(get_the_excerpt($featured_post), 30); ?>
                    </p>
                    
                    <div class="mt-4 flex items-center">
                        <?php
                        $author_id = $featured_post->post_author;
                        $author_avatar = get_avatar($author_id, 40, '', '', array('class' => 'w-10 h-10 rounded-full'));
                        if ($author_avatar):
                        ?>
                            <?php echo $author_avatar; ?>
                        <?php else: ?>
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                <span class="text-blue-600 font-semibold">
                                    <?php echo substr(get_the_author_meta('display_name', $author_id), 0, 2); ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">
                                <?php echo get_the_author_meta('display_name', $author_id); ?>
                            </p>
                            <p class="text-sm text-gray-500">
                                <?php 
                                echo get_the_date('F j, Y', $featured_post);
                                echo ' · ';
                                echo sprintf(
                                    _n('%d min read', '%d min read', 5, 'zenblog'),
                                    5
                                );
                                ?>
                            </p>
                        </div>
                    </div>
                    
                    <a href="<?php echo get_permalink($featured_post); ?>"
                        class="mt-6 inline-block px-6 py-2 border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white rounded-full transition duration-300">
                        <?php esc_html_e('Read More', 'zenblog'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php 
    wp_reset_postdata();
    endif;
endif;
?>

<!-- Blog Posts -->
<section id="blog" class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-2 text-center">Latest Articles</h2>
        <p class="text-gray-600 text-center mb-12">Explore my recent thoughts and adventures</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if (have_posts()):
                while (have_posts()):
                    the_post(); ?>
                    <div class="blog-card bg-white rounded-xl overflow-hidden shadow-md">
                        <?php if (has_post_thumbnail()): ?>
                            <div class="h-48 overflow-hidden">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('large', ['class' => 'w-full h-full object-cover']); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">
                                    <?php $cat = get_the_category();
                                    if ($cat) {
                                        echo esc_html($cat[0]->name);
                                    } ?>
                                </span>
                                <span class="ml-auto text-gray-500 text-sm"><?php echo get_the_date(); ?></span>
                            </div>
                            <h3 class="text-xl font-bold mb-3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <p class="text-gray-600 mb-4"><?php echo get_the_excerpt(); ?></p>
                            <a href="<?php the_permalink(); ?>"
                                class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                                Read More
                            </a>
                        </div>
                    </div>
                <?php endwhile; else: ?>
                <p class="col-span-3 text-center">No posts found.</p>
            <?php endif; ?>
        </div>
        <div class="text-center mt-12">
            <?php the_posts_pagination(); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>