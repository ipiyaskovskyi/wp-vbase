<?php
/**
 * Template for displaying the About page
 *
 * @package VBase
 */

get_header();
?>

<main id="primary" class="site-main" role="main">
    <?php
    while (have_posts()) :
        the_post();
    ?>

    <!-- Our Mission Section -->
    <section id="our-mission" class="b-about-mission" aria-labelledby="mission-heading">
        <div class="l-container">
            <div class="b-about-mission__content u-flex u-justify-between u-items-center u-flex-wrap">
                <div class="b-about-mission__image">
                    <div class="b-about-mission__image-wrapper">
                        <img src="<?php echo esc_url(VBASE_URI . '/assets/images/sample_mock_1_7_-removebg-preview.png'); ?>" alt="<?php esc_attr_e('vBase Stamp', 'vbase'); ?>">
                    </div>
                </div>
                <div class="b-about-mission__text">
                    <h2 id="mission-heading"><?php esc_html_e('Our Mission', 'vbase'); ?></h2>
                    <p><?php esc_html_e('If you don\'t know where your data comes from, how can you know what it means? validityBase is an easy button for data credibility.', 'vbase'); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Story Section -->
    <section id="our-story" class="b-about-story" aria-labelledby="story-heading">
        <div class="l-container">
            <div class="b-about-story__content u-flex u-justify-between u-items-center u-flex-wrap">
                <div class="b-about-story__text">
                    <h2 id="story-heading"><?php esc_html_e('Our Story', 'vbase'); ?></h2>
                    <div class="b-about-story__content-text">
                        <?php
                        // Display page content or default text
                        if (get_the_content()) {
                            the_content();
                        } else {
                            ?>
                            <p><?php esc_html_e('The founders of validityBase recognized a critical gap in the data industry: the lack of verifiable credibility for data sources. Motivated by the need for trust and transparency, they created validityBase to provide an easy, accessible solution for data credibility.', 'vbase'); ?></p>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="b-about-story__image">
                    <div class="b-about-story__image-wrapper">
                        <img src="<?php echo esc_url(VBASE_URI . '/assets/images/story.webp'); ?>" alt="<?php esc_attr_e('Our Story', 'vbase'); ?>">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Founders Section -->
    <section id="founders" class="b-about-founders" aria-labelledby="founders-heading">
        <div class="l-container">
            <h2 id="founders-heading" class="b-about-founders__title"><?php esc_html_e('Founders', 'vbase'); ?></h2>
            <div class="b-about-founders__grid u-flex u-flex-wrap u-justify-center">
                <div class="b-about-founders__item">
                    <div class="b-about-founders__photo">
                        <?php
                        // Try to get founder image from meta or use placeholder
                        $dan_image = get_post_meta(get_the_ID(), '_founder_dan_image', true);
                        if (!$dan_image) {
                            $dan_image = VBASE_URI . '/assets/images/dan-2.webp'; // Placeholder
                        }
                        ?>
                        <img src="<?php echo esc_url($dan_image); ?>" alt="<?php esc_attr_e('Dan Averbukh', 'vbase'); ?>">
                    </div>
                    <h3 class="b-about-founders__name"><?php esc_html_e('Dan Averbukh', 'vbase'); ?></h3>
                    <p class="b-about-founders__role"><?php esc_html_e('Co-founder & CEO', 'vbase'); ?></p>
                    <div class="b-about-founders__bio">
                        <?php
                        $dan_bio = get_post_meta(get_the_ID(), '_founder_dan_bio', true);
                        if ($dan_bio) {
                            echo wp_kses_post($dan_bio);
                        } else {
                            ?>
                            <p><?php esc_html_e('Dan brings extensive experience in data and technology, leading validityBase with a vision to make data credibility accessible to everyone.', 'vbase'); ?></p>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="b-about-founders__item">
                    <div class="b-about-founders__photo">
                        <?php
                        $greg_image = get_post_meta(get_the_ID(), '_founder_greg_image', true);
                        if (!$greg_image) {
                            $greg_image = VBASE_URI . '/assets/images/greg-new-1.webp'; // Placeholder
                        }
                        ?>
                        <img src="<?php echo esc_url($greg_image); ?>" alt="<?php esc_attr_e('Greg Kapoustin', 'vbase'); ?>">
                    </div>
                    <h3 class="b-about-founders__name"><?php esc_html_e('Greg Kapoustin', 'vbase'); ?></h3>
                    <p class="b-about-founders__role"><?php esc_html_e('Co-founder & CTO', 'vbase'); ?></p>
                    <div class="b-about-founders__bio">
                        <?php
                        $greg_bio = get_post_meta(get_the_ID(), '_founder_greg_bio', true);
                        if ($greg_bio) {
                            echo wp_kses_post($greg_bio);
                        } else {
                            ?>
                            <p><?php esc_html_e('Greg is a technical leader with deep expertise in building scalable systems and blockchain technology, driving the technical vision of validityBase.', 'vbase'); ?></p>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Customers & Principles Section -->
    <section id="customers-principles" class="b-about-customers-principles">
        <div class="l-container">
            <div class="b-about-customers-principles__grid u-flex u-flex-wrap">
                <div class="b-about-customers-principles__item b-about-customers">
                    <div class="b-about-customers__icon">
                        <img src="<?php echo esc_url(VBASE_URI . '/assets/images/customers.svg'); ?>" alt="<?php esc_attr_e('Customers', 'vbase'); ?>">
                    </div>
                    <h3 class="b-about-customers__title"><?php esc_html_e('Customers', 'vbase'); ?></h3>
                    <p class="b-about-customers__text"><?php esc_html_e('We work with data vendors, asset managers, and others.', 'vbase'); ?></p>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="b-about-customers__link">
                        <?php esc_html_e('Contact us to see if validityBase can help your business.', 'vbase'); ?>
                    </a>
                </div>

                <div class="b-about-customers-principles__item b-about-principles">
                    <div class="b-about-principles__icon">
                        <img src="<?php echo esc_url(VBASE_URI . '/assets/images/principles.svg'); ?>" alt="<?php esc_attr_e('Principles', 'vbase'); ?>">
                    </div>
                    <h3 class="b-about-principles__title"><?php esc_html_e('Principles', 'vbase'); ?></h3>
                    <p class="b-about-principles__text"><?php esc_html_e('vBase tools are designed to be:', 'vbase'); ?></p>
                    <ul class="b-about-principles__list">
                        <li><?php esc_html_e('Easy to use', 'vbase'); ?></li>
                        <li><?php esc_html_e('Lightweight', 'vbase'); ?></li>
                        <li><?php esc_html_e('Built on open principles', 'vbase'); ?></li>
                        <li><?php esc_html_e('No single point of failure', 'vbase'); ?></li>
                        <li><?php esc_html_e('No vendor lock-in', 'vbase'); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Customer Reviews Section -->
    <section id="customer-reviews" class="b-about-reviews" aria-labelledby="reviews-heading">
        <div class="l-container">
            <div class="b-about-reviews__wrapper">
                <div class="b-about-reviews__left">
                    <div class="b-about-reviews__quote-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" version="1.1" viewBox="0 20 100 60" preserveAspectRatio="xMidYMid meet">
                            <path d="m57.121 82.492v-34.645c0-22.281 16.176-31.801 29.949-32.32 3.5156-0.13281 6.4102 2.8164 6.4102 6.3359 0 3.3594-2.6172 5.5039-5.8828 6.2852-4.207 1.0039-7.7031 2.2773-10.105 5.125-2.2109 2.6211-3.4453 6.5156-3.6602 12.496l19.902 0.12891c1.0742 0.007812 1.9414 0.87891 1.9414 1.9531v34.645c0 1.0781-0.875 1.9531-1.9531 1.9531h-34.645c-1.0781 0-1.9531-0.875-1.9531-1.9531z" fill-rule="evenodd"/>
                            <path d="m4.2969 82.492v-34.645c0-22.281 16.176-31.801 29.949-32.32 3.5156-0.13281 6.4102 2.8164 6.4102 6.3359 0 3.3594-2.6172 5.5039-5.8828 6.2852-4.207 1.0039-7.7031 2.2773-10.105 5.125-2.2109 2.6211-3.4453 6.5156-3.6602 12.496l19.902 0.12891c1.0742 0.007812 1.9414 0.87891 1.9414 1.9531v34.645c0 1.0781-0.875 1.9531-1.9531 1.9531h-34.645c-1.0781 0-1.9531-0.875-1.9531-1.9531z" fill-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="b-about-reviews__subtitle"><?php esc_html_e('What our customers are saying', 'vbase'); ?></h3>
                    <div class="b-about-reviews__nav">
                        <button class="b-about-reviews__nav-button reviews-prev-js" aria-label="<?php esc_attr_e('Previous review', 'vbase'); ?>">
                            <span class="material-icons">arrow_back</span>
                        </button>
                        <div class="b-about-reviews__nav-indicator">
                            <span class="b-about-reviews__nav-dot" data-slide="0"></span>
                            <span class="b-about-reviews__nav-dot is-active" data-slide="1"></span>
                            <span class="b-about-reviews__nav-dot" data-slide="2"></span>
                        </div>
                        <button class="b-about-reviews__nav-button reviews-next-js" aria-label="<?php esc_attr_e('Next review', 'vbase'); ?>">
                            <span class="material-icons">arrow_forward</span>
                        </button>
                    </div>
                </div>
                <div class="b-about-reviews__right">
                    <?php
                    // Customer reviews data
                    $reviews = [
                        [
                            'quote' => esc_html__('vBase really helps a newer data product like mine gain credibility and compete with more established companies.', 'vbase'),
                            'role' => esc_html__('Founder', 'vbase'),
                            'company' => esc_html__('US financial survey data company.', 'vbase'),
                        ],
                        [
                            'quote' => esc_html__('If a data vendor is even considering using validityBase, we want to know about them. It sends a very positive signal about the quality of their data.', 'vbase'),
                            'role' => esc_html__('CIO', 'vbase'),
                            'company' => esc_html__('London ML/AI quantitative fund', 'vbase'),
                        ],
                    ];
                    ?>
                    <div class="b-about-reviews__slider">
                        <div class="b-about-reviews__slides reviews-slides-js">
                            <?php foreach ($reviews as $index => $review) : ?>
                                <article class="b-about-reviews__card" data-review-index="<?php echo esc_attr($index); ?>">
                                    <blockquote class="b-about-reviews__quote">
                                        <p><?php echo esc_html($review['quote']); ?></p>
                                    </blockquote>
                                    <div class="b-about-reviews__author">
                                        <div class="b-about-reviews__author-avatar">
                                            <span class="material-icons" aria-hidden="true">account_circle</span>
                                        </div>
                                        <div class="b-about-reviews__author-info">
                                            <p class="b-about-reviews__author-role"><?php echo esc_html($review['role']); ?></p>
                                            <p class="b-about-reviews__author-company"><?php echo esc_html($review['company']); ?></p>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section (reuse pricing engagement layout/styles) -->
    <section id="about-cta" class="b-about-cta">
        <div class="l-container">
            <div class="b-engagement">
                <h2 class="b-engagement__title"><?php esc_html_e('Curious if validityBase can help you?', 'vbase'); ?></h2>
                <div class="b-engagement__actions">
                    <a href="https://app.vbase.com/" class="button button--white" target="_blank" rel="noopener">
                        <?php esc_html_e('Try Free vBase App', 'vbase'); ?>
                    </a>
                    <span class="b-engagement__divider"><?php esc_html_e('- or -', 'vbase'); ?></span>
                    <div class="b-engagement__form">
                        <?php
                        // Contact Form 7: Contact form home
                        if (function_exists('wpcf7')) {
                            echo do_shortcode('[contact-form-7 id="881b6b6" title="Contact form home"]');
                        } else {
                            ?>
                            <form class="b-engagement__demo-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                                <input type="hidden" name="action" value="vbase_demo_request">
                                <?php wp_nonce_field('vbase_demo_nonce', 'vbase_demo_nonce'); ?>
                                <input
                                    type="email"
                                    name="email"
                                    class="b-engagement__demo-input"
                                    placeholder="<?php esc_attr_e('Enter your email', 'vbase'); ?>"
                                    required
                                    aria-label="<?php esc_attr_e('Your email', 'vbase'); ?>"
                                >
                                <button type="submit" class="button button--dark">
                                    <?php esc_html_e('Request a Demo', 'vbase'); ?>
                                </button>
                            </form>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    endwhile;
    ?>
</main>

<?php
get_footer();
?>

