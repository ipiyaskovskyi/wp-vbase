<?php
/**
 * Template for displaying the Demo Request page
 *
 * @package VBase
 */

get_header();
?>

<main id="main-content" class="site-main">
    <section class="demo-page">
        <div class="l-container">
            <?php
            while (have_posts()) :
                the_post();
            ?>
                <div class="demo-page__card">
                    <div class="row u-w-full gx-0">
                        <!-- Left Column: Content -->
                        <div class="col-12 col-lg-5">
                            <div class="demo-page__info">
                                <span class="demo-page__badge"><?php esc_html_e('REQUEST A DEMO', 'vbase'); ?></span>
                                <h1 class="demo-page__title"><?php esc_html_e('Schedule your Platform Demo', 'vbase'); ?></h1>
                                <p class="demo-page__description">
                                    <?php 
                                    $description = get_post_meta(get_the_ID(), '_demo_description', true);
                                    if (!$description) {
                                        $description = esc_html__('validityBase is a platform that enables organizations with valuable data to prove its integrity and performance with globally credible audit trails — turning data and strategies into trusted, investable products.', 'vbase');
                                    }
                                    echo esc_html($description);
                                    ?>
                                </p>
                            </div>
                        </div>

                        <!-- Right Column: Form -->
                        <div class="col-12 col-lg-7">
                            <div class="demo-page__form-wrapper">
                                <div class="demo-form-card">
                                    <?php
                                    // Contact Form 7: Demo Request Form
                                    if (function_exists('wpcf7')) {
                                        // Try to use a demo form shortcode, fallback to ID if needed
                                        $demo_form_id = get_post_meta(get_the_ID(), '_demo_form_id', true);
                                        if ($demo_form_id) {
                                            echo do_shortcode('[contact-form-7 id="' . esc_attr($demo_form_id) . '"]');
                                        } else {
                                            // Fallback: try common demo form IDs
                                            echo do_shortcode('[contact-form-7 id="" title="Request a Demo"]');
                                        }
                                    } else {
                                        // Fallback form if CF7 is not installed
                                        ?>
                                        <form class="demo-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                                            <input type="hidden" name="action" value="vbase_demo_request">
                                            <?php wp_nonce_field('vbase_demo_nonce', 'vbase_demo_nonce'); ?>

                                            <div class="demo-form__group">
                                                <label for="demo-email" class="demo-form__label">
                                                    <?php esc_html_e('Business Email', 'vbase'); ?> <span class="required">*</span>
                                                </label>
                                                <input
                                                    type="email"
                                                    id="demo-email"
                                                    name="email"
                                                    class="demo-form__input"
                                                    placeholder="<?php esc_attr_e('Enter your email', 'vbase'); ?>"
                                                    required
                                                    aria-label="<?php esc_attr_e('Business Email', 'vbase'); ?>"
                                                >
                                            </div>

                                            <div class="demo-form__row">
                                                <div class="demo-form__group demo-form__group--half">
                                                    <label for="demo-first-name" class="demo-form__label">
                                                        <?php esc_html_e('First Name', 'vbase'); ?> <span class="required">*</span>
                                                    </label>
                                                    <input
                                                        type="text"
                                                        id="demo-first-name"
                                                        name="first_name"
                                                        class="demo-form__input"
                                                        placeholder="<?php esc_attr_e('Enter your name', 'vbase'); ?>"
                                                        required
                                                        aria-label="<?php esc_attr_e('First Name', 'vbase'); ?>"
                                                    >
                                                </div>

                                                <div class="demo-form__group demo-form__group--half">
                                                    <label for="demo-last-name" class="demo-form__label">
                                                        <?php esc_html_e('Last Name', 'vbase'); ?> <span class="required">*</span>
                                                    </label>
                                                    <input
                                                        type="text"
                                                        id="demo-last-name"
                                                        name="last_name"
                                                        class="demo-form__input"
                                                        placeholder="<?php esc_attr_e('Enter your last name', 'vbase'); ?>"
                                                        required
                                                        aria-label="<?php esc_attr_e('Last Name', 'vbase'); ?>"
                                                    >
                                                </div>
                                            </div>

                                            <div class="demo-form__row">
                                                <div class="demo-form__group demo-form__group--half">
                                                    <label for="demo-job-role" class="demo-form__label">
                                                        <?php esc_html_e('Job Role', 'vbase'); ?>
                                                    </label>
                                                    <input
                                                        type="text"
                                                        id="demo-job-role"
                                                        name="job_role"
                                                        class="demo-form__input"
                                                        placeholder="<?php esc_attr_e('Enter Job Role', 'vbase'); ?>"
                                                        aria-label="<?php esc_attr_e('Job Role', 'vbase'); ?>"
                                                    >
                                                </div>

                                                <div class="demo-form__group demo-form__group--half">
                                                    <label for="demo-company" class="demo-form__label">
                                                        <?php esc_html_e('Company Name', 'vbase'); ?>
                                                    </label>
                                                    <input
                                                        type="text"
                                                        id="demo-company"
                                                        name="company"
                                                        class="demo-form__input"
                                                        placeholder="<?php esc_attr_e('Enter company name', 'vbase'); ?>"
                                                        aria-label="<?php esc_attr_e('Company Name', 'vbase'); ?>"
                                                    >
                                                </div>
                                            </div>

                                            <div class="demo-form__group">
                                                <label class="demo-form__checkbox-label">
                                                    <input
                                                        type="checkbox"
                                                        name="communications_consent"
                                                        class="demo-form__checkbox"
                                                        checked
                                                    >
                                                    <span class="demo-form__checkbox-text">
                                                        <?php esc_html_e('I agree to receive communications from validityBase and I can update my email preferences at any time.', 'vbase'); ?>
                                                    </span>
                                                </label>
                                            </div>

                                            <div class="demo-form__actions">
                                                <button type="submit" class="button button--dark u-flex u-justify-center u-items-center">
                                                    <?php esc_html_e('Submit', 'vbase'); ?> <span class="button-arrow">></span>
                                                </button>
                                            </div>
                                        </form>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
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

