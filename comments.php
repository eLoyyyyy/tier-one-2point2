<?php
$commentargs = array(
  'id_form'           => 'commentform',
  'id_submit'         => 'submit',
  'class_submit'      => 'btn waves-effect waves-light right-align',
  'name_submit'       => 'submit',
  'title_reply'       => __( 'Comment on this:' ),
  'title_reply_to'    => __( 'Reply to %s' ),
  'cancel_reply_link' => __( 'Cancel Reply' ),
  'label_submit'      => __( 'Post Comment' ),
  'format'            => 'xhtml', 
  'fields'              =>
    apply_filters( 'comment_form_default_fields', array(
            'author'    => '<div class="input-field col s12">' . 
                                '<i class="mdi-action-account-circle prefix"></i>
                                <input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" />
                                <label for="author">' . __( 'Name' ) . '</label>
                            </div>',  
            'email'     => '<div class="input-field col s12">' . 
                                '<i class="mdi-communication-email prefix"></i>
                                <input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" />
                                <label for="email">' . __( 'Email' ) . '</label>'.
                            '</div>',
            'url'       => ''
    )),
  'comment_field' =>  
            '<div class="input-field col s12">
                <i class="fa fa-commenting-o prefix" aria-hidden="true"></i>
                <textarea id="comment" name="comment" class="materialize-textarea">' . '</textarea>
                <label for="comment">' . _x( 'Comment', 'noun' ) . '</label>
            </div>',
  'must_log_in' => '<p class="must-log-in">' .
                        sprintf(
                          __( 'You must be <a href="%s">logged in</a> to post a comment.' ), 
                            wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
                        ) . 
                    '</p>',
 
  'logged_in_as' => '<p class="logged-in-as">' .
                        sprintf(
                        __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
                          admin_url( 'profile.php' ),
                          $user_identity,
                          wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
                        ) . 
                    '</p>',
  'comment_notes_after' => '<div class="clear"></div>
                            <span class="black-text hide-on-small-only">' .
                                sprintf(
                                  __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ),
                                  ' <code>' . allowed_tags() . '</code>'
                                ) . 
                            '</span>'
 
);
?>

<div class="card hoverable">
    <div class="card-content">
        <?php comment_form($commentargs); ?>
    </div>
</div>

<?php if( have_comments() ) : ?>

    <ul class="hide-on-med-and-down">
        <li>
            <h3 class="h5" id="comments">Comments</h3>
            <ul>
                <?php
                    // Display comments
                    wp_list_comments( array(
                        'callback' => 'better_comments'
                    ) );
                ?>
            </ul>
        </li>
    </ul>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
    <div id="comment-nav-below" class="navigation comment-navigation" role="navigation">
        <div class="nav-links row clearfix">
            <div class="nav-previous col l6 m6 s6 center-align"><?php previous_comments_link( __( '&laquo; Older Comments', 'materialized' ) ); ?></div>
            <div class="nav-next col l6 m6 s6 center-align"><?php next_comments_link( __( 'Newer Comments &raquo;', 'materialized' ) ); ?></div>

        </div><!-- .nav-links -->
    </div><!-- #comment-nav-below -->
    <?php endif; // check for comment navigation ?>
    

<?php else : ?>
    <?php if ('open' == $post->comment_status) : ?>

    <?php else : ?>
        <p class="nocomments">Comments are closed.</p>

    <?php endif; ?>

<?php endif; ?>