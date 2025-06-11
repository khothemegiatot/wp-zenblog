<?php ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Header -->
<header class="bg-white shadow-sm sticky top-0 z-10">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <?php if (has_custom_logo()): ?>
            <?php the_custom_logo(); ?>
        <?php else: ?>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="text-2xl font-bold text-blue-600">
                <?php bloginfo('name'); ?>
            </a>
        <?php endif; ?>

        <nav class="hidden md:flex space-x-8">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary-menu',
                'container' => false,
                'menu_class' => 'flex space-x-8',
                'fallback_cb' => false,
            ));
            ?>
        </nav>

        <button id="mobile-menu-button" class="md:hidden text-gray-800 focus:outline-none">
            <i class="fas fa-bars text-xl"></i>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden bg-white hidden">
        <div class="container mx-auto px-4 py-3 flex flex-col space-y-3">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'mobile-menu',
                'container' => false,
                'menu_class' => 'flex flex-col space-y-3',
                'fallback_cb' => false,
            ));
            ?>
        </div>
    </div>
</header>

<?php
// Header and navigation will be included here
?>