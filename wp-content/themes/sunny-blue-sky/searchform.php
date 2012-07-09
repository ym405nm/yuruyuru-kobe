	<form method="get" class="searchform" action="<?php echo home_url(); ?>/">
		<fieldset>
				<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" />
				<button type="submit" id="searchsubmit" value="Search">Search</button>
		</fieldset>
	</form>
