<?php

/**
 * Comment area template.
 *
 * @package Natural_Company
 */
if (!defined('ABSPATH')) exit;

if (comments_open()) { ?>
    <div class="l-comments">
        <div class="l-comments__title">
            <div class="l-comments__subtext">Comments</div>
            <h2 class="l-comments__h2">コメント</h2>
        </div>
        <?php if (have_comments()) { ?>
            <ol class="l-comments__list">
                <?php wp_list_comments('avatar_size=30'); ?>
            </ol>
            <?php if (get_comment_pages_count() > 1) { ?>
                <div class="l-comments__pagelink">
                    <?php paginate_comments_links(); ?>
                </div>
            <?php } ?>
        <?php } ?>
        <div class="l-comments__form">
            <?php
            $req = get_option('require_name_email');
            $required_text = sprintf(' ' . __('<span class="l-comments__required">*</span>マークがある項目は必須です。 %s'), '');
            $aria_req = ($req ? " aria-required='true'" : '');
            $fields = array(
                'author' => '<div class="l-comments__formauthor">' . '<label for="author">' . __('Name') . ($req ? '<span class="l-comments__required">*</span>' : '') . '</label> ' .
                    '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></div>',
                'email'  => '<div class="l-comments__formemail"><label for="email">' . __('Email') . ($req ? '<span class="l-comments__required">*</span>' : '') . '</label> ' .
                    '<input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></div>',
                'url'    => '',
            );
            $args = array(
                'fields'               => apply_filters('comment_form_default_fields', $fields),
                'comment_field'        => '<div class="l-comments__textarea"><label for="comment">コメント<span class="l-comments__required">*</span></label><textarea id="comment" name="comment" aria-required="true"></textarea></div>',
                'must_log_in'          => '<p class="l-comments__must-log-in">' .  sprintf(__('コメントする際は <a href="%s">ログイン</a> してください。'), wp_login_url(apply_filters('the_permalink', get_permalink()))) . '</p>',
                'logged_in_as'         => '<p class="l-comments__logged-in-as">' . sprintf(__('<a href="%1$s">%2$s</a>としてログイン中｜<a href="%3$s" title="Log out of this account">ログアウト</a>'), admin_url('profile.php'), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink()))) . '</p>',
                'comment_notes_before' => '<p class="l-comments__commentnotes">' . ($req ? $required_text : '') .  __('また、メールアドレスを入力しても、公開されることはありません。') . '</p>',
                'title_reply'          => 'コメントする'
            );
            comment_form($args);
            ?>
        </div>
    </div>
<?php } ?>