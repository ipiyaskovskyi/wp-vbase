<?php
/**
 * Template for displaying the front page
 *
 * @package VBase
 */

get_header();
?>

<main id="primary" class="site-main" role="main">

<section class="hero" aria-labelledby="hero-heading">
    <div class="l-container">
        <div class="hero__content u-flex u-justify-between u-items-center u-flex-wrap">
            <div class="hero__content-left">
                <h1 id="hero-heading"><strong>validityBase</strong></h1>
                <h2><?php esc_html_e('The trust layer for valuable data', 'vbase'); ?></h2>
                <p class="hero__text"><?php esc_html_e('Build trust. Close deals.', 'vbase'); ?></p>
                <!-- <a class="button button--dark with-arrow u-flex u-items-center" target="_blank" href="https://app.vbase.com/">
                    Try The App
                </a> -->
            </div>
            <div class="hero__content-right">
                <img src="<?php echo esc_url(VBASE_URI . '/assets/images/sample_mock_1_7_-removebg-preview.png'); ?>" alt="<?php esc_attr_e('validityBase', 'vbase'); ?>">
            </div>
        </div>
        <div class="hero__bottom">
            <div class="hero__bottom-title">
                <?php esc_html_e('Tailored Solutions for', 'vbase'); ?>
            </div>
            <div class="hero__bottom-grid">
                <div class="hero__bottom-item u-flex u-flex-col u-justify-between">
                    <span><?php esc_html_e('Alternative Data', 'vbase'); ?></span>
                    <p><?php esc_html_e('Showcase and increase your data\'s value', 'vbase'); ?></p>
                    <a href="<?php echo esc_url(home_url('/alt-data/')); ?>" class="hero__bottom-item-link">
                        <?php esc_html_e('Learn More', 'vbase'); ?>
                    </a>
                </div>

                <div class="hero__bottom-item u-flex u-flex-col u-justify-between">
                    <span><?php esc_html_e('Investment Managers and Allocators', 'vbase'); ?></span>
                    <p><?php esc_html_e('Turn any strategy into a live verified index', 'vbase'); ?></p>
                    <a href="<?php echo esc_url(home_url('/track-record/')); ?>" class="hero__bottom-item-link">
                        <?php esc_html_e('Learn More', 'vbase'); ?>
                    </a>
                </div>

                <div class="hero__bottom-item u-flex u-flex-col u-justify-between">
                    <span><?php esc_html_e('Trading Signals', 'vbase'); ?></span>
                    <p><?php esc_html_e('Make signals credible to leading hedge funds', 'vbase'); ?></p>
                    <a href="<?php echo esc_url(home_url('/signals/')); ?>" class="hero__bottom-item-link">
                        <?php esc_html_e('Learn More', 'vbase'); ?>
                    </a>
                </div>

                <div class="hero__bottom-item u-flex u-flex-col u-justify-between">
                    <span><?php esc_html_e('Predictive Datasets', 'vbase'); ?></span>
                    <p><?php esc_html_e('Prove the value of your data and models', 'vbase'); ?></p>
                    <a href="<?php echo esc_url(home_url('/predictive-data/')); ?>" class="hero__bottom-item-link">
                        <?php esc_html_e('Learn More', 'vbase'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="hero__bg"></div>
</section>

<section id="client-logos" class="b-logos" aria-labelledby="client-logos-heading">
    <div class="l-container">
        <div class="b-logos-title">
            <p><?php esc_html_e('validityBase, Chosen by Clients Setting the Standard Worldwide', 'vbase'); ?></p>
        </div>
        <div class="b-logos-grid">
            <?php
            // Client logos - can be customized via theme options
            $client_logos = [
                ['url' => 'https://stocktwits.com/', 'image' => 'client-logos/stocktwits-logo.svg', 'alt' => 'StockTwits'],
                ['url' => 'https://www.tenzingmemo.com/', 'image' => 'client-logos/tenzing-logo.svg', 'alt' => 'Tenzing'],
                ['url' => 'https://www.bluewatermacro.com/', 'image' => 'client-logos/bluewatermacro-logo.png', 'alt' => 'BlueWater Macro'],
                ['url' => 'https://en.allears.ai/', 'image' => 'client-logos/allears-logo.svg', 'alt' => 'AllEars'],
                ['url' => 'https://www.quantconnect.com/', 'image' => 'client-logos/qc-copy.webp', 'alt' => 'QuantConnect'],
                ['url' => 'https://giesbusiness.illinois.edu/experience/academies-centers/derivatives-and-trading-academy', 'image' => 'client-logos/uiuc-logo.svg', 'alt' => 'UIUC'],
                ['url' => 'https://newmarkrisk.com/', 'image' => 'client-logos/nmr-logo.png', 'alt' => 'NewMark Risk'],
            ];
            
            foreach ($client_logos as $logo) :
            ?>
                <div class="b-logos-item">
                    <a href="<?php echo esc_url($logo['url']); ?>" target="_blank" rel="noopener">
                        <img src="<?php echo esc_url(VBASE_URI . '/assets/images/' . $logo['image']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>">
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="featured-in" class="b-logos" aria-labelledby="featured-in-heading">
    <div class="l-container">
        <div class="b-logos-title">
            <p><?php esc_html_e('Featured In', 'vbase'); ?></p>
        </div>
        <div class="b-logos-grid">
            <div class="b-logos-item">
                <a href="https://www.forbes.com/sites/jacobwolinsky/2025/09/09/new-tech-aids-fund-return-verification-as-sec-scrutiny-rises/" target="_blank" rel="noopener">
                    <img src="<?php echo esc_url(VBASE_URI . '/assets/images/forbes.webp'); ?>" alt="Forbes">
                </a>
            </div>
            <div class="b-logos-item">
                <a href="https://hedgefundalpha.com/profile/fund-managers-verify-track-record/" target="_blank" rel="noopener">
                    <img src="<?php echo esc_url(VBASE_URI . '/assets/images/HedgeFundAlpha-BL-1.webp'); ?>" alt="Hedge Fund Alpha">
                </a>
            </div>
        </div>
    </div>
</section>

<section id="statistics" class="b-statistics" aria-labelledby="statistics-heading">
    <div class="l-container">
        <h2 id="statistics-heading" class="screen-reader-text"><?php esc_html_e('Key statistics', 'vbase'); ?></h2>
        <div class="b-statistics-content">
            <span>500+ <?php esc_html_e('indices', 'vbase'); ?></span>
            <span class="separator">•</span>
            <span>100+ <?php esc_html_e('data providers', 'vbase'); ?></span>
            <span class="separator">•</span>
            <span>&lt;1s <?php esc_html_e('verification', 'vbase'); ?></span>
            <span class="separator">•</span>
            <span><?php esc_html_e('Trusted globally', 'vbase'); ?></span>
        </div>
    </div>
</section>

<section id="trust-by-design" class="b-trust-by-design" aria-labelledby="trust-by-design-heading">
    <div class="l-container">
        <h3 id="trust-by-design-heading"><?php esc_html_e('Trust and Security by Design', 'vbase'); ?></h3>
        <div class="b-trust-by-design-block u-flex u-justify-between">
            <div class="b-trust-by-design-block-item-left">
                <div class="b-trust-by-design-block-item-img">
                    <img src="<?php echo esc_url(VBASE_URI . '/assets/images/vBase-diagram___-2-768x476.webp'); ?>" alt="<?php esc_attr_e('Trust and Security', 'vbase'); ?>">
                </div>
            </div>
            <div class="b-trust-by-design-block-item-right">
                <div class="b-trust-by-design-block-item-title">
                    <?php esc_html_e('Design Implications', 'vbase'); ?>
                </div>
                <div class="b-trust-by-design-block-item-content">
                    <div class="b-trust-by-design-block-item-content-item u-flex u-items-center">
                        <span class="u-flex u-justify-center u-items-center">1</span>
                        <p><?php esc_html_e('Instantly verifiable timestamps and integrity of historical data', 'vbase'); ?></p>
                    </div>
                    <div class="b-trust-by-design-block-item-content-item u-flex u-items-center">
                        <span class="u-flex u-justify-center u-items-center">2</span>
                        <p><?php esc_html_e('Anyone can trust your historical data as if they saw it live', 'vbase'); ?></p>
                    </div>
                    <div class="b-trust-by-design-block-item-content-item u-flex u-items-center">
                        <span class="u-flex u-justify-center u-items-center">3</span>
                        <p><?php esc_html_e('Your data stays private -- even from vBase', 'vbase'); ?></p>
                    </div>
                    <div class="b-trust-by-design-block-item-content-item u-flex u-items-center">
                        <span class="u-flex u-justify-center u-items-center">4</span>
                        <p><?php esc_html_e('Compatible with all data types and pipelines', 'vbase'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section" aria-labelledby="data-providers-heading">
    <div class="l-container">
        <div class="feature-panel">
            <div class="feature-panel__content">
                <div class="feature-panel__icon">
                    <img src="<?php echo esc_url(VBASE_URI . '/assets/images/icon-checkmark.svg'); ?>" alt="" width="48" height="48">
                </div>
                <span class="feature-panel__label"><?php esc_html_e('Data Providers', 'vbase'); ?></span>
                <h3 id="data-providers-heading" class="feature-panel__title"><?php esc_html_e('Package Data to Sell at a Premium', 'vbase'); ?></h3>
                <p class="feature-panel__desc"><?php esc_html_e('vBase turns your data into a verifiable, investor-ready product that commands higher pricing and faster adoption.', 'vbase'); ?></p>
                <ul class="feature-panel__list">
                    <li><strong><?php esc_html_e('Enrichment API:', 'vbase'); ?></strong> <?php esc_html_e('Automated audit trails prove data is point-in-time and trial-ready', 'vbase'); ?></li>
                    <li><strong><?php esc_html_e('Data Monetization:', 'vbase'); ?></strong> <?php esc_html_e('Turn raw data into investor-ready products', 'vbase'); ?></li>
                </ul>
                <div class="feature-panel__buttons">
                    <a href="<?php echo esc_url(home_url('/alt-data/')); ?>" class="button button--dark with-arrow"><?php esc_html_e('Learn More', 'vbase'); ?></a>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="button button--white"><?php esc_html_e('Talk to Us', 'vbase'); ?></a>
                </div>
            </div>
            <div class="feature-panel__image">
                <div class="feature-panel__image-wrapper">
                    <img src="<?php echo esc_url(VBASE_URI . '/assets/images/image7.png'); ?>" alt="<?php esc_attr_e('Package Data', 'vbase'); ?>">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section" aria-labelledby="investment-managers-heading">
    <div class="l-container">
        <div class="feature-panel feature-panel--reverse">
            <div class="feature-panel__content">
                <div class="feature-panel__icon">
                    <img src="<?php echo esc_url(VBASE_URI . '/assets/images/icon-chart.svg'); ?>" alt="" width="48" height="48">
                </div>
                <span class="feature-panel__label"><?php esc_html_e('Investment Managers and Research', 'vbase'); ?></span>
                <h3 id="investment-managers-heading" class="feature-panel__title"><?php esc_html_e('Turn Trading Strategies into Trusted Products', 'vbase'); ?></h3>
                <p class="feature-panel__desc"><?php esc_html_e('vBase turns any signal, model, portfolio or basket into a verifiable live index.', 'vbase'); ?></p>
                <ul class="feature-panel__list">
                    <li><strong><?php esc_html_e('Instant Credibility:', 'vbase'); ?></strong> <?php esc_html_e('Independently verifiable audit trails that prove performance without exposing IP', 'vbase'); ?></li>
                    <li><strong><?php esc_html_e('Trust at Scale:', 'vbase'); ?></strong> <?php esc_html_e('Automate the proof investors demand at a fraction of the cost of legacy solutions', 'vbase'); ?></li>
                </ul>
                <div class="feature-panel__buttons">
                    <a href="<?php echo esc_url(home_url('/track-record/')); ?>" class="button button--dark with-arrow"><?php esc_html_e('Learn More', 'vbase'); ?></a>
                    <a href="https://app.vbase.com/" class="button button--white" target="_blank" rel="noopener"><?php esc_html_e('Get Started', 'vbase'); ?></a>
                </div>
            </div>
            <div class="feature-panel__image">
                <div class="feature-panel__image-wrapper">
                    <img src="<?php echo esc_url(VBASE_URI . '/assets/images/alfa-signals-group.png'); ?>" alt="<?php esc_attr_e('Trading Strategies Chart', 'vbase'); ?>">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section" aria-labelledby="developers-heading">
    <div class="l-container">
        <div class="feature-panel">
            <div class="feature-panel__content">
                <div class="feature-panel__icon">
                    <img src="<?php echo esc_url(VBASE_URI . '/assets/images/icon-shield.svg'); ?>" alt="" width="48" height="56">
                </div>
                <span class="feature-panel__label"><?php esc_html_e('Developers And Builders', 'vbase'); ?></span>
                <h3 id="developers-heading" class="feature-panel__title"><?php esc_html_e('Trust as a Service', 'vbase'); ?></h3>
                <p class="feature-panel__desc"><?php esc_html_e('vBase globally credible audit trails provide verifiable history for critical data', 'vbase'); ?></p>
                <ul class="feature-panel__list">
                    <li><strong><?php esc_html_e('No heavyweight platforms:', 'vbase'); ?></strong> <?php esc_html_e('Robust lightweight process that can be called from any environment', 'vbase'); ?></li>
                    <li><strong><?php esc_html_e('Compliance-Ready:', 'vbase'); ?></strong> <?php esc_html_e('Prove "what was known when" for regulated and otherwise critical workflows', 'vbase'); ?></li>
                </ul>
                <div class="feature-panel__buttons">
                    <a href="https://docs.vbase.com/" class="button button--dark with-arrow" target="_blank" rel="noopener"><?php esc_html_e('Learn More', 'vbase'); ?></a>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="button button--white"><?php esc_html_e('Talk to Us', 'vbase'); ?></a>
                </div>
            </div>
            <div class="feature-panel__image">
                <div class="feature-panel__image-wrapper">
                    <img src="<?php echo esc_url(VBASE_URI . '/assets/images/stamper-screenshot.png'); ?>" alt="<?php esc_attr_e('Trust as a Service - Stamp Found', 'vbase'); ?>" onerror="this.src='<?php echo esc_url(VBASE_URI . '/assets/images/image7.png'); ?>'">
                </div>
            </div>
        </div>
    </div>
</section>


<?php
// Blog posts section
$recent_posts = get_posts([
    'numberposts' => 10,
    'post_status' => 'publish',
]);

if ($recent_posts) :
?>
<section id="blog" class="b-blog" aria-labelledby="blog-heading">
    <div class="l-container">
        <div class="b-blog-title-nav u-flex u-justify-between u-items-center">
            <div class="b-blog-title">
                <h3 id="blog-heading"><?php esc_html_e('Articles & Resources', 'vbase'); ?></h3>
            </div>
            <div class="b-blog-nav u-flex">
                <button class="b-blog-nav-button u-flex b-blog-nav-prev prev-js" aria-label="<?php esc_attr_e('Prev', 'vbase'); ?>">
                    <span class="material-icons">arrow_back</span>
                </button>
                <button class="b-blog-nav-button u-flex b-blog-nav-next next-js" aria-label="<?php esc_attr_e('Next', 'vbase'); ?>">
                    <span class="material-icons">arrow_forward</span>
                </button>
            </div>
        </div>
        <div class="b-blog-slider">
            <div class="b-blog-slider-slides slides-js u-flex recent">
                <?php foreach ($recent_posts as $post) : setup_postdata($post); ?>
                    <div class="recent-item slide-js">
                        <a href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium', ['class' => 'recent-item-img', 'loading' => 'lazy']); ?>
                            <?php else : ?>
                                <div class="recent-item-img"></div>
                            <?php endif; ?>
                        </a>
                        <a class="recent-item-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        <div class="recent-item-categories u-flex u-flex-wrap">
                            <?php
                            $categories = get_the_category();
                            $category_count = 0;
                            foreach ($categories as $category) {
                                if ($category_count < 2) { // Show max 2 categories
                                    echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html(strtoupper($category->name)) . '</a>';
                                    $category_count++;
                                }
                            }
                            ?>
                        </div>
                    </div>
                <?php endforeach; wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<section id="form" class="b-form" aria-labelledby="form-heading">
    <div class="l-container">
        <div class="b-form-block u-flex u-flex-wrap u-justify-center">
            <svg class="b-form-block-svg" xmlns="http://www.w3.org/2000/svg" width="59.727" height="67.741" viewBox="0 0 59.727 67.741">
                <use xlink:href="#icon-form"></use>
            </svg>
            <div class="b-form-block-text u-flex u-justify-center">
                <div class="b-form-block-text-inner">
                    <p><?php printf(esc_html__('Curious if %s can help supercharge your business?', 'vbase'), '<strong>validityBase</strong>'); ?></p>
                    <p><?php esc_html_e('We\'d love to give you a quick 15 minute demo & answer your questions.', 'vbase'); ?></p>
                </div>
            </div>
            <?php
            // Contact Form 7 shortcode - Request Demo Form
            echo do_shortcode('[contact-form-7 id="16" title="Request Demo Form"]');
            ?>
        </div>
    </div>
</section>

<section id="started" class="b-started" aria-labelledby="started-heading">
    <div class="l-container">
        <h2 id="started-heading" class="screen-reader-text"><?php esc_html_e('Get started resources', 'vbase'); ?></h2>
        <div class="b-started-block u-flex u-flex-wrap">
            <div class="b-started-block-item b-started-block-left">
                <img src="<?php echo esc_url(VBASE_URI . '/assets/images/doc.svg'); ?>" alt="">
                <div class="b-started-block-item-title"><?php esc_html_e('Read the Docs', 'vbase'); ?></div>
                <p><?php esc_html_e('Learn more about vBase\'s capabilities', 'vbase'); ?></p>
                <div class="b-started-block-item-buttons u-flex">
                    <a class="button button--white with-arrow" target="_blank" href="https://docs.vbase.com/" rel="noopener">
                        <?php esc_html_e('Learn More', 'vbase'); ?>
                    </a>
                </div>
            </div>
            <div class="b-started-block-item b-started-block-right">
                <img src="<?php echo esc_url(VBASE_URI . '/assets/images/started.svg'); ?>" alt="">
                <div class="b-started-block-item-title"><?php esc_html_e('Get Started', 'vbase'); ?></div>
                <p><?php esc_html_e('Start using vBase tools and services', 'vbase'); ?></p>
                <div class="b-started-block-item-buttons u-flex">
                    <a class="button button--white with-arrow" href="https://app.vbase.com/" target="_blank" rel="noopener">
                        <?php esc_html_e('Begin Today', 'vbase'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

</main>

<?php
get_footer();

