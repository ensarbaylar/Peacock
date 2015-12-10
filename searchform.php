<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
<div class="input-group peacock-search-bar">
	<span class="input-group-btn">
		<button class="btn btn-default" type="submit"><span class="search-icon">Search</span></button>
	</span>
	<input type="text" name="s" value="" class="form-control" placeholder="<?php echo __( 'Search for', 'peacock' )?>">
</div><!-- /input-group -->
<div class="clearfix"></div>
</form>