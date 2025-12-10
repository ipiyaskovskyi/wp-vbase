<?php
/**
 * The template for displaying comments
 *
 * @package VBase
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            printf(
                esc_html(_nx('One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'vbase')),
                number_format_i18n(get_comments_number()),
                '<span>' . get_the_title() . '</span>'
            );
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments([
                'style'       => 'ol',
                'short_ping'  => true,
            ]);
            ?>
        </ol>

        <?php
        the_comments_pagination([
            'prev_text' => esc_html__('Previous', 'vbase'),
            'next_text' => esc_html__('Next', 'vbase'),
        ]);
        ?>

    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
        <p class="no-comments"><?php esc_html_e('Comments are closed.', 'vbase'); ?></p>
    <?php endif; ?>

    <?php
    comment_form([
        'title_reply'          => esc_html__('Leave a Reply', 'vbase'),
        'title_reply_to'       => esc_html__('Leave a Reply to %s', 'vbase'),
        'cancel_reply_link'    => esc_html__('Cancel Reply', 'vbase'),
        'label_submit'         => esc_html__('Post Comment', 'vbase'),
    ]);
    ?>
</div>

