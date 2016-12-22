<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif;

function materialized_reply_link_class($class){
    $class = str_replace("class='comment-reply-link", "class='waves-effect waves-light btn", $class);
    return $class;
}
add_filter('comment_reply_link', 'materialized_reply_link_class');
 
function materialized_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
 
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<div <?php comment_class( array( 'section', empty( $args['has_children'] ) ? '' : 'parent',) ) ?> id="comment-<?php comment_ID() ?>">
        <article id="div-comment-<?php comment_ID() ?>" class="comment-body" itemprop="comment" itemscope itemtype="http://schema.org/Comment">
            <header class="comment-header">
            <?php echo get_avatar( $comment, 60, '' , '' , array( 'class' => 'comment-avatar') ); ?>
                <?php 
                    printf( __( '<cite class="comment-author" itemprop="creator" itemscope itemtype="http://schema.org/Person">%s</cite>' ), 
                            '<span class="fn" itemprop="name"><a href="'.get_comment_author_url().'" rel="external" itemprop="url">' . get_comment_author() . '</a></span>'
                          ); 
                ?>
                <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
                    <time class="post-date updated" itemprop="datePublished" datetime="<?php comment_time('c'); ?>">
                    <?php
                            /* translators: 1: date, 2: time */
                            /*printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), '  ', '' );*/
                            echo time_ago();
                    ?></time></a>
                </div>
            </header>
            <?php if ( $comment->comment_approved == '0' ) : ?>
                <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
                <br />
            <?php endif; ?>

            <div class="comment-content" itemprop="description">
                <?php comment_text(); ?>
            </div>
            
        </article>
        <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div>
    </div>
    <div class="divider"></div>
<?php
}