<div class="sidebar">
<ul>
        <?php
        if (!dynamic_sidebar('sidebar-widget-area') ) : ?>
        <li>
            <h3  class="widget-heading font-1">Pages</h3>
            <ul>
                <?php wp_list_pages('title_li='); ?>
            </ul>
        </li>
        <li>
            <h3  class="widget-heading font-1">Categories</h3>
            <ul>
                <?php wp_list_categories('title_li='); ?>
            </ul>				
        </li>
        <li>
            <h3  class="widget-heading font-1">Archives</h3>
            <ul>
                <?php wp_get_archives('type=monthly'); ?>
            </ul>
        </li>
        <?php /* If this is the frontpage */ if ( is_home() || is_page() ) { ?>
        <li>
            <h3  class="widget-heading font-1">Meta</h3>
            <ul>
                <?php wp_register(); ?>
                <li><?php wp_loginout(); ?></li>
                <?php wp_meta(); ?>
            </ul>
        </li>
        <?php } ?>

        <?php endif; ?>
</ul>					
</div>