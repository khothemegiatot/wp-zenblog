<?php get_header(); ?>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6"><?php bloginfo('name'); ?></h1>
            <p class="text-xl mb-8"><?php bloginfo('description'); ?></p>
            <a href="#blog"
                class="bg-white text-blue-600 hover:bg-gray-100 px-6 py-3 rounded-full font-medium inline-block transition duration-300">Read
                Latest Posts</a>
        </div>
    </div>
</section>

<!-- Featured Post -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-12 text-center">Featured Post</h2>

        <div class="featured-post max-w-5xl mx-auto bg-white rounded-xl overflow-hidden shadow-lg">
            <div class="md:flex">
                <div class="md:w-1/2 overflow-hidden">
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='600' height='400' viewBox='0 0 600 400'%3E%3Crect width='600' height='400' fill='%23e0e7ff'/%3E%3Cpath d='M0 350 L600 250 L600 400 L0 400 Z' fill='%233b82f6'/%3E%3Ccircle cx='450' cy='100' r='50' fill='%23f59e0b' opacity='0.8'/%3E%3C/svg%3E"
                        alt="Featured Post" class="w-full h-full object-cover">
                </div>
                <div class="md:w-1/2 p-8">
                    <div class="uppercase tracking-wide text-sm text-blue-600 font-semibold">Travel</div>
                    <h3 class="mt-2 text-2xl font-bold">Discovering Hidden Gems in Southeast Asia</h3>
                    <p class="mt-4 text-gray-600">
                        My three-month journey through Southeast Asia revealed incredible places often overlooked by
                        typical tourists. From secluded beaches to mountain villages, these experiences changed my
                        perspective on travel forever.
                    </p>
                    <div class="mt-4 flex items-center">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                            <span class="text-blue-600 font-semibold">JD</span>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Jane Doe</p>
                            <p class="text-sm text-gray-500">June 15, 2023 · 8 min read</p>
                        </div>
                    </div>
                    <a href="#"
                        class="mt-6 inline-block px-6 py-2 border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white rounded-full transition duration-300">Read
                        More</a>
                </div>
            </div>
        </div>
    </div>
</section>

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