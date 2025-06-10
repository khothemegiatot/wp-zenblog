<?php
get_header();
?>

<section class="max-w-3xl mx-auto py-16 px-4">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article <?php post_class('prose lg:prose-xl'); ?>>
            <h1 class="text-4xl font-bold mb-6"><?php the_title(); ?></h1>
            <div class="mb-4 text-gray-500">
                <span>By <?php the_author(); ?></span> · <span><?php echo get_the_date(); ?></span>
            </div>
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="mb-8">
                    <?php the_post_thumbnail('large', ['class' => 'w-full rounded-xl shadow']); ?>
                </div>
            <?php endif; ?>
            <div class="content">
                <?php the_content(); ?>
            </div>
        </article>
    <?php endwhile; endif; ?>
</section>

<?php get_footer(); ?>
