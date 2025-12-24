<?php
/**
 * Template for displaying the Contact page
 *
 * @package VBase
 */

get_header();
?>

<main id="main-content" class="site-main">
    <section class="contact-page">
        <div class="l-container">
            <?php
            while (have_posts()) :
                the_post();

                // Contact info values (with sensible defaults)
                $heading      = get_post_meta(get_the_ID(), '_contact_heading', true);
                $email        = get_post_meta(get_the_ID(), '_contact_email', true);
                $address_line = get_post_meta(get_the_ID(), '_contact_address_line', true);
                $address_city = get_post_meta(get_the_ID(), '_contact_address_city', true);

                if (!$heading) {
                    $heading = esc_html__('Contact validityBase', 'vbase');
                }
                if (!$email) {
                    $email = 'hello@vbase.com';
                }
                if (!$phone) {
                    $phone = '+1 (000) 000-0000';
                }
                if (!$address_line) {
                    $address_line = '224 W. 35th St. Suite 500 #577';
                }
                if (!$address_city) {
                    $address_city = 'New York, NY 10001';
                }
            ?>
                <div class="contact-page__card">
                    <div class="row u-w-full gx-0">
                        <div class="col-12 col-lg-5">
                            <div class="contact-page__info">
                                <h1 class="contact-page__title"><?php echo esc_html($heading); ?></h1>

                                <div class="contact-info">
                                    <div class="contact-info__block">
                                        <span class="contact-info__label-small"><?php esc_html_e('Email', 'vbase'); ?></span>
                                        <p class="contact-info__text">
                                            <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                                        </p>
                                    </div>
                                    <div class="contact-info__block">
                                        <span class="contact-info__label-small"><?php esc_html_e('Address', 'vbase'); ?></span>
                                        <p class="contact-info__text">
                                            <?php echo esc_html($address_line); ?><br>
                                            <?php echo esc_html($address_city); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-7">
                            <div class="contact-page__form-wrapper">
                                <div class="contact-form-card">
                                    <?php
                                    // Contact Form 7: main contact form managed in admin
                                    if (function_exists('wpcf7')) {
                                        // Use the shortcode you provided
                                        echo do_shortcode('[contact-form-7 id="386ecc6" title="Contact"]');
                                    } else {
                                        // Very simple fallback form if CF7 is not installed
                                        ?>
                                        <form class="contact-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                                            <input type="hidden" name="action" value="vbase_contact_submit">
                                            <?php wp_nonce_field('vbase_contact_nonce', 'vbase_contact_nonce'); ?>

                                            <div class="contact-form__row">
                                                <div class="contact-form__group contact-form__group--half">
                                                    <label for="contact-name" class="contact-form__label">
                                                        <?php esc_html_e('Your Name', 'vbase'); ?> <span class="required">*</span>
                                                    </label>
                                                    <input
                                                        type="text"
                                                        id="contact-name"
                                                        name="name"
                                                        class="contact-form__input"
                                                        placeholder="<?php esc_attr_e('Your full name', 'vbase'); ?>"
                                                        required
                                                        aria-label="<?php esc_attr_e('Your name', 'vbase'); ?>"
                                                    >
                                                </div>

                                                <div class="contact-form__group contact-form__group--half">
                                                    <label for="contact-email" class="contact-form__label">
                                                        <?php esc_html_e('Email address', 'vbase'); ?> <span class="required">*</span>
                                                    </label>
                                                    <input
                                                        type="email"
                                                        id="contact-email"
                                                        name="email"
                                                        class="contact-form__input"
                                                        placeholder="<?php esc_attr_e('Your email address', 'vbase'); ?>"
                                                        required
                                                        aria-label="<?php esc_attr_e('Your email', 'vbase'); ?>"
                                                    >
                                                </div>
                                            </div>

                                            <div class="contact-form__group">
                                                <label for="contact-message" class="contact-form__label">
                                                    <?php esc_html_e('Message', 'vbase'); ?>
                                                </label>
                                                <textarea
                                                    id="contact-message"
                                                    name="message"
                                                    class="contact-form__textarea"
                                                    rows="6"
                                                    placeholder="<?php esc_attr_e('Write something...', 'vbase'); ?>"
                                                    aria-label="<?php esc_attr_e('Your message', 'vbase'); ?>"
                                                ></textarea>
                                            </div>

                                            <div class="contact-form__actions">
                                                <button type="submit" class="button button--dark u-flex u-justify-center u-items-center">
                                                    <?php esc_html_e('Send Message', 'vbase'); ?>
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
                // Display page content if any under the card
                if (get_the_content()) :
                    ?>
                    <div class="contact-page__additional">
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <?php
                endif;

            endwhile;
            ?>
        </div>
    </section>
</main>

<?php
get_footer();

?>


