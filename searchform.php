<form role="search" method="get" class="searchform-navbar group hide-on-med-and-down" action="<?php echo home_url( '/' ); ?>">
    <div class="input-field">
        <input id="search" type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>"/>
    </div>
</form>