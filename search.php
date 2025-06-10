<?php
get_header();
?>

<section class="max-w-3xl mx-auto py-16 px-4">
    <h1 class="text-3xl font-bold mb-8">Search Results for: <?php echo get_search_query(); ?></h1>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="mb-8 border-b pb-6">
            <h2 class="text-2xl font-semibold mb-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p class="text-gray-600"><?php echo get_the_excerpt(); ?></p>
        </div>
    <?php endwhile; else: ?>
        <p>No results found. Please try a different search.</p>
    <?php endif; ?>
    <div class="mt-8">
        <?php the_posts_pagination(); ?>
    </div>
</section>

<?php get_footer(); ?>
