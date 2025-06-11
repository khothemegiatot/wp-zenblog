<?php
// Footer section for MindfulJournal theme
?>

<?php if (get_theme_mod('about_section_enable', true)): ?>
<!-- About Section -->
<section id="about" class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold mb-2 text-center"><?php _e('About Me', 'zenblog'); ?></h2>
            <p class="text-gray-600 text-center mb-12"><?php _e('Get to know the person behind the blog', 'zenblog'); ?></p>

            <div class="md:flex items-center gap-12">
                <div class="md:w-1/3 mb-8 md:mb-0 flex justify-center">
                    <div class="w-48 h-48 rounded-full overflow-hidden border-4 border-blue-100 shadow-lg">
                        <?php 
                        $about_image = get_theme_mod('about_image');
                        if ($about_image): 
                        ?>
                            <img src="<?php echo esc_url($about_image); ?>" alt="<?php echo esc_attr(get_theme_mod('about_name', 'Alex Morgan')); ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" class="w-full h-full">
                                <rect width="200" height="200" fill="#e0e7ff" />
                                <circle cx="100" cy="85" r="40" fill="#93c5fd" />
                                <path d="M40 180 Q100 120 160 180" fill="#3b82f6" />
                            </svg>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="md:w-2/3">
                    <h3 class="text-2xl font-bold mb-4">
                        <?php printf(__('Hi, I\'m %s', 'zenblog'), esc_html(get_theme_mod('about_name', 'Alex Morgan'))); ?>
                    </h3>
                    <div class="text-gray-700 mb-6">
                        <?php echo wp_kses_post(get_theme_mod('about_description', '')); ?>
                    </div>
                    <div class="flex space-x-4">
                        <?php
                        $social_platforms = array(
                            'twitter' => 'fab fa-twitter',
                            'instagram' => 'fab fa-instagram',
                            'linkedin' => 'fab fa-linkedin-in'
                        );

                        foreach ($social_platforms as $platform => $icon) {
                            $url = get_theme_mod('about_social_' . $platform);
                            if ($url) {
                                printf(
                                    '<a href="%s" class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition duration-300" target="_blank" rel="noopener noreferrer"><i class="%s"></i></a>',
                                    esc_url($url),
                                    esc_attr($icon)
                                );
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if (get_theme_mod('newsletter_section_enable', true)): ?>
<!-- Newsletter -->
<section class="py-16 bg-blue-50">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4"><?php echo esc_html(get_theme_mod('newsletter_title', __('Subscribe to My Newsletter', 'zenblog'))); ?></h2>
            <p class="text-gray-600 mb-8"><?php echo esc_html(get_theme_mod('newsletter_description', __('Get notified when I publish new articles. No spam, just quality content.', 'zenblog'))); ?></p>

            <form id="newsletter-form" class="flex flex-col md:flex-row gap-4 justify-center">
                <input type="email" placeholder="<?php esc_attr_e('Your email address', 'zenblog'); ?>" required
                    class="px-5 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 flex-grow max-w-md">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition duration-300">
                    <?php esc_html_e('Subscribe', 'zenblog'); ?>
                </button>
            </form>
            <p id="subscription-message" class="mt-4 text-green-600 hidden"><?php esc_html_e('Thank you for subscribing!', 'zenblog'); ?></p>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if (get_theme_mod('contact_section_enable', true)): ?>
<!-- Contact Section -->
<section id="contact" class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-2 text-center"><?php echo esc_html(get_theme_mod('contact_title', __('Get In Touch', 'zenblog'))); ?></h2>
        <p class="text-gray-600 text-center mb-12"><?php echo esc_html(get_theme_mod('contact_description', __('Have a question or just want to say hi? Drop me a message!', 'zenblog'))); ?></p>

        <div class="max-w-3xl mx-auto">
            <?php 
            $contact_form_shortcode = get_theme_mod('contact_form_shortcode');
            if ($contact_form_shortcode) {
                echo do_shortcode($contact_form_shortcode);
            } else {
            ?>
                <form id="contact-form" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-gray-700 mb-2"><?php esc_html_e('Name', 'zenblog'); ?></label>
                            <input type="text" id="name" name="name" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="email" class="block text-gray-700 mb-2"><?php esc_html_e('Email', 'zenblog'); ?></label>
                            <input type="email" id="email" name="email" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    <div>
                        <label for="subject" class="block text-gray-700 mb-2"><?php esc_html_e('Subject', 'zenblog'); ?></label>
                        <input type="text" id="subject" name="subject" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="message" class="block text-gray-700 mb-2"><?php esc_html_e('Message', 'zenblog'); ?></label>
                        <textarea id="message" name="message" rows="5" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit"
                            class="bg-blue-600 text-white px-8 py-3 rounded-full hover:bg-blue-700 transition duration-300">
                            <?php esc_html_e('Send Message', 'zenblog'); ?>
                        </button>
                    </div>
                </form>
                <div id="contact-success" class="mt-6 bg-green-100 text-green-700 p-4 rounded-lg text-center hidden">
                    <?php esc_html_e('Thank you for your message! I\'ll get back to you soon.', 'zenblog'); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Footer -->
<footer class="bg-gray-900 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <?php if (is_active_sidebar('footer-1')): ?>
                    <?php dynamic_sidebar('footer-1'); ?>
                <?php else: ?>
                    <h4 class="text-lg font-semibold mb-4"><?php bloginfo('name'); ?></h4>
                    <p class="text-gray-400"><?php bloginfo('description'); ?></p>
                <?php endif; ?>
            </div>

            <div>
                <?php if (is_active_sidebar('footer-2')): ?>
                    <?php dynamic_sidebar('footer-2'); ?>
                <?php endif; ?>
            </div>

            <div>
                <?php if (is_active_sidebar('footer-3')): ?>
                    <?php dynamic_sidebar('footer-3'); ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.
                <?php
                $copyright_text = get_theme_mod('footer_copyright_text', 'All rights reserved.');
                echo esc_html($copyright_text);
                ?>
            </p>
        </div>
    </div>
</footer>

<script>
    // Mobile Menu Toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    // Newsletter Form
    const newsletterForm = document.getElementById('newsletter-form');
    const subscriptionMessage = document.getElementById('subscription-message');

    newsletterForm.addEventListener('submit', (e) => {
        e.preventDefault();
        newsletterForm.reset();
        subscriptionMessage.classList.remove('hidden');

        setTimeout(() => {
            subscriptionMessage.classList.add('hidden');
        }, 5000);
    });

    // Contact Form
    const contactForm = document.getElementById('contact-form');
    const contactSuccess = document.getElementById('contact-success');

    contactForm.addEventListener('submit', (e) => {
        e.preventDefault();
        contactForm.reset();
        contactSuccess.classList.remove('hidden');

        setTimeout(() => {
            contactSuccess.classList.add('hidden');
        }, 5000);
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });

                // Close mobile menu if open
                if (!mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                }
            }
        });
    });
</script>
<script>(function () { function c() { var b = a.contentDocument || a.contentWindow.document; if (b) { var d = b.createElement('script'); d.innerHTML = "window.__CF$cv$params={r:'94d56eda90248515',t:'MTc0OTUyMjQ4Mi4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);"; b.getElementsByTagName('head')[0].appendChild(d) } } if (document.body) { var a = document.createElement('iframe'); a.height = 1; a.width = 1; a.style.position = 'absolute'; a.style.top = 0; a.style.left = 0; a.style.border = 'none'; a.style.visibility = 'hidden'; document.body.appendChild(a); if ('loading' !== document.readyState) c(); else if (window.addEventListener) document.addEventListener('DOMContentLoaded', c); else { var e = document.onreadystatechange || function () { }; document.onreadystatechange = function (b) { e(b); 'loading' !== document.readyState && (document.onreadystatechange = e, c()) } } } })();</script>

<?php wp_footer(); ?>
</body>

</html>