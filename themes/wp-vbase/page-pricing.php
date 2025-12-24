<?php
/**
 * Template for displaying the Pricing page
 *
 * @package VBase
 */

get_header();
?>

<main id="main-content" class="site-main">
    <section class="pricing-page">
        <div class="l-container">
            <?php
            while (have_posts()) :
                the_post();
            ?>
                <!-- Main Title Section -->
                <div class="pricing-page__header">
                    <h1 class="pricing-page__title"><?php esc_html_e('Select Your Best Fit', 'vbase'); ?></h1>
                    <p class="pricing-page__subtitle"><?php esc_html_e('Plans built for every team.', 'vbase'); ?></p>
                    
                    <!-- DIY Banner -->
                    <div class="pricing-page__diy-banner">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/diy.svg" alt="<?php esc_attr_e('DIY Illustration', 'vbase'); ?>">
                        <span class="pricing-page__diy-text">
                            <strong><?php esc_html_e('DIY:', 'vbase'); ?></strong> <?php esc_html_e('unlimited free stamps and validations forever.', 'vbase'); ?>
                            <a href="https://docs.vbase.com/" class="pricing-page__diy-link"><?php esc_html_e('Always an option.', 'vbase'); ?></a>
                        </span>
                    </div>
                </div>

                <!-- Pricing Plans Section -->
                <?php
                // Pricing plans data
                $pricing_plans = [
                    [
                        'id' => 'free',
                        'title' => __('FREE', 'vbase'),
                        'price' => __('$0', 'vbase'),
                        'price_period' => '/mo',
                        'features' => [
                            __('100 stamps per month', 'vbase'),
                            __('Unlimited validations*', 'vbase'),
                            __('E-mail support', 'vbase'),
                            __('1 live index', 'vbase'),
                        ],
                        'button_class' => 'button--white',
                        'button_url' => 'https://app.vbase.com/',
                    ],
                    [
                        'id' => 'base',
                        'title' => __('BASE', 'vbase'),
                        'price' => '$50',
                        'price_period' => '/mo',
                        'features' => [
                            __('All features of FREE plan', 'vbase'),
                            __('400 stamps per month', 'vbase'),
                            __('White glove support', 'vbase'),
                            __('3 live indices', 'vbase'),
                        ],
                        'button_class' => 'button--white',
                        'button_url' => 'https://app.vbase.com/',
                    ],
                    [
                        'id' => 'pro',
                        'title' => __('PRO', 'vbase'),
                        'price' => '$200',
                        'price_period' => '/mo',
                        'features' => [
                            __('All features of BASE plan', 'vbase'),
                            __('2000 stamps per month', 'vbase'),
                            __('Managed service for S3, REST, & other data stores', 'vbase'),
                            __('5 live indices', 'vbase'),
                        ],
                        'button_class' => 'button--dark',
                        'button_url' => 'https://app.vbase.com/',
                    ],
                ];
                ?>
                <div class="pricing-page__plans">
                    <div class="row u-w-full gx-0">
                        <?php foreach ($pricing_plans as $plan) : ?>
                            <div class="col-12 col-lg-4">
                                <div class="pricing-card pricing-card--<?php echo esc_attr($plan['id']); ?>">
                                    <h3 class="pricing-card__title"><?php echo esc_html($plan['title']); ?></h3>
                                    <div class="pricing-card__price">
                                        <span class="pricing-card__price-amount"><?php echo esc_html($plan['price']); ?></span>
                                        <?php if (!empty($plan['price_period'])) : ?>
                                            <span class="pricing-card__price-period"><?php echo esc_html($plan['price_period']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <ul class="pricing-card__features">
                                        <?php foreach ($plan['features'] as $feature) : ?>
                                            <li class="pricing-card__feature">
                                                <span class="pricing-card__feature-icon material-icons">task_alt</span>
                                                <?php echo esc_html($feature); ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <a href="<?php echo esc_url($plan['button_url']); ?>" class="button <?php echo esc_attr($plan['button_class']); ?>" target="_blank" rel="noopener">
                                        <?php esc_html_e('Get Started', 'vbase'); ?>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- High Volume Solutions Section -->
                <div class="pricing-page__high-volume">
                    <div class="pricing-page__high-volume-content">
                        <p class="pricing-page__high-volume-text"><strong><?php esc_html_e('High Volume', 'vbase'); ?></strong> <?php esc_html_e('Solutions Available.', 'vbase'); ?></p>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="button button--dark">
                            <?php esc_html_e('Learn More', 'vbase'); ?>
                        </a>
                    </div>
                </div>

                <!-- FAQ Section -->
                <?php
                // FAQ data
                $faq_items = [
                    [
                        'question' => __('How many stamps do I need?', 'vbase'),
                        'answer' => [
                            ['type' => 'paragraph', 'content' => __('It depends on your use case and how frequently your data or track record updates.', 'vbase')],
                            ['type' => 'paragraph', 'content' => __('Each "stamp" records a file or piece of data at a point in time — so the number you need is based on how often your files or records are updated and how many files or records you want to make verifiable.', 'vbase')],
                            ['type' => 'heading', 'content' => __('Examples:', 'vbase')],
                            ['type' => 'list', 'items' => [
                                __('Monthly-updated dataset → 1 stamp/month', 'vbase'),
                                __('Daily-rebalancing strategy → ~30 stamps/month', 'vbase'),
                                __('10 daily datasets → 10 × 30 = 300 stamps/month', 'vbase'),
                                __('Hourly predictive signal → ~600 stamps/month', 'vbase'),
                                __('Dataset updating every 10 minutes → ~4,000+ stamps/month', 'vbase'),
                            ]],
                            ['type' => 'paragraph', 'content' => sprintf(__('We offer tailored solutions for higher-volume needs, just %s.', 'vbase'), '<a href="' . esc_url('https://www.vbase.com/contact/') . '">' . __('reach out', 'vbase') . '</a>')],
                        ],
                    ],
                    [
                        'question' => __('What\'s the difference between FREE and DIY?', 'vbase'),
                        'answer' => [
                            ['type' => 'paragraph', 'content' => __('vBase runs on open infrastructure. The DIY plan offers free stamping using our smart contracts—but requires your own wallet and blockchain access. Ideal if you want full control.', 'vbase')],
                            ['type' => 'paragraph', 'content' => __('The Free plan gives you 100 stamps/month using our hosted setup—no technical skills needed. Verification is always free and unlimited.', 'vbase')],
                            ['type' => 'paragraph', 'content' => __('Both plans produce the same verifiable proofs, and you can switch between them anytime.', 'vbase')],
                            ['type' => 'paragraph', 'content' => __('DIY offers long-term peace of mind: even if you stop using vBase you can continue to build and verify your data\'s history.', 'vbase')],
                        ],
                    ],
                    [
                        'question' => __('What payment methods do you accept?', 'vbase'),
                        'answer' => [
                            ['type' => 'paragraph', 'content' => sprintf(__('We can accept payment cards or bank-to-bank payments. If you need a different payment method, %s.', 'vbase'), '<a href="' . esc_url('https://www.vbase.com/contact/') . '">' . __('please let us know', 'vbase') . '</a>')],
                        ],
                    ],
                    [
                        'question' => __('How often will I be billed?', 'vbase'),
                        'answer' => [
                            ['type' => 'paragraph', 'content' => __('Our paid plans are billed monthly. If you exceed your stamp allowance, you can always buy more mid-month.', 'vbase')],
                        ],
                    ],
                    [
                        'question' => __('Do you offer volume discounts for bulk purchases?', 'vbase'),
                        'answer' => [
                            ['type' => 'paragraph', 'content' => sprintf(__('Beyond the 2000 stamps / month included in the PRO plan, we charge $20 per 1000 stamps. If you plan to consistently make over 10,000 stamps per month, %s.', 'vbase'), '<a href="' . esc_url('https://www.vbase.com/contact/') . '">' . __('please contact us', 'vbase') . '</a>')],
                        ],
                    ],
                ];
                ?>
                <div class="pricing-page__faq">
                    <h2 class="pricing-page__faq-title"><?php esc_html_e('Frequently Asked Questions', 'vbase'); ?></h2>
                    <div class="row u-w-full gx-0">
                        <div class="col-12 col-lg-5">
                            <div class="pricing-page__faq-illustration">
                                <div class="pricing-page__faq-image">
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/faq.svg'); ?>" alt="<?php esc_attr_e('FAQ Illustration', 'vbase'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-7">
                            <div class="b-faq-block">
                                <div class="b-faq-block-qa">
                                    <?php foreach ($faq_items as $faq) : ?>
                                        <div class="b-faq-block-qa-item">
                                            <div class="b-faq-block-qa-item-head">
                                                <span><?php echo esc_html($faq['question']); ?></span>
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4 6L8 10L12 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                            <div class="b-faq-block-qa-item-content">
                                                <?php foreach ($faq['answer'] as $answer_part) : ?>
                                                    <?php if ($answer_part['type'] === 'paragraph') : ?>
                                                        <p><?php echo wp_kses_post($answer_part['content']); ?></p>
                                                    <?php elseif ($answer_part['type'] === 'heading') : ?>
                                                        <p><strong><?php echo esc_html($answer_part['content']); ?></strong></p>
                                                    <?php elseif ($answer_part['type'] === 'list') : ?>
                                                        <ul>
                                                            <?php foreach ($answer_part['items'] as $item) : ?>
                                                                <li><?php echo esc_html($item); ?></li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Engagement Section -->
                <div class="b-engagement">
                    <h2 class="b-engagement__title"><?php esc_html_e('See what the buzz is all about.', 'vbase'); ?></h2>
                    <div class="b-engagement__actions">
                        <a href="https://app.vbase.com/" class="button button--white" target="_blank" rel="noopener">
                            <?php esc_html_e('Get Started for Free', 'vbase'); ?>
                        </a>
                        <span class="b-engagement__divider"><?php esc_html_e('- or -', 'vbase'); ?></span>
                        <div class="b-engagement__form">
                            <?php
                            // Contact Form 7: Contact form home
                            if (function_exists('wpcf7')) {
                                echo do_shortcode('[contact-form-7 id="881b6b6" title="Contact form home"]');
                            } else {
                                // Simple fallback
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

            <?php
            endwhile;
            ?>
        </div>
    </section>
</main>

<?php
get_footer();
?>

