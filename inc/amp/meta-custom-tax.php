<ul class="amp-tags">
    <?php 
    $posttags = get_the_tags( $this->get( 'post_id' ) );
    if ($posttags) {
      foreach($posttags as $tag) {
        ?><li><a href="<?php echo get_tag_link($tag->term_id); ?>"><span itemprop="keywords"><?php echo $tag->name; ?></span></a></li><?php 
      }
    }
    ?>
</ul>

<ul class="amp-categories">
<?php
    $categories = get_the_category( $this->get( 'post_id' ) );

    foreach( $categories as $category ) {
        ?><li><a href="<?php echo get_category_link( $category->term_id ); ?>" title="<?php echo $category->name; ?>"><?php echo $category->name; ?></a></li>  <?php
    }
?>
</ul>