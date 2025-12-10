<?php
/**
 * The template for displaying comments
 *
 * @package Performance_Theme
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            printf(
                /* translators: 1: comment count number */
                esc_html(_n('%1$s Comment', '%1$s Comments', $comment_count, 'performance-theme')),
                number_format_i18n($comment_count)
            );
            ?>
        </h2>
        
        <ol class="comment-list">
            <?php
            wp_list_comments([
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 60,
            ]);
            ?>
        </ol>
        
        <?php
        the_comments_navigation([
            'prev_text' => __('&larr; Older Comments', 'performance-theme'),
            'next_text' => __('Newer Comments &rarr;', 'performance-theme'),
        ]);
        ?>
        
    <?php endif; ?>
    
    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
        <p class="no-comments"><?php esc_html_e('Comments are closed.', 'performance-theme'); ?></p>
    <?php endif; ?>
    
    <?php
    comment_form([
        'title_reply'          => __('Leave a Comment', 'performance-theme'),
        'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
        'title_reply_after'    => '</h3>',
        'class_form'           => 'comment-form',
        'class_submit'         => 'btn btn-primary',
        'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',
    ]);
    ?>
</div>

