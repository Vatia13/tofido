<?php

/*  ----------------------------------------------------------------------------
    Text logo + ad spot
 */

?>
<!-- text logo and ad -->
<div class="td-header-bg">
    <div class="container td-logo-rec-wrap">
        <div class="row">
            <div class="span4 header-logo-wrap" role="banner" itemscope="itemscope" itemtype="<?php echo td_global::$http_or_https?>://schema.org/Organization">
                <div class="td-logo-wrap-align">
                    <a itemprop="url" class="td-logo-wrap" href="<?php echo home_url(); ?>">
                        <span class="td-logo-text"><?php echo get_bloginfo( 'name' ); ?></span>
                        <span class="td-tagline-text"><?php echo get_bloginfo( 'description' ); ?></span>
                    </a>
                </div>
                <meta itemprop="name" content="<?php bloginfo('name')?>">
            </div>
            <div class="span8">
                <?php
                // show the header ad spot
                echo td_global_blocks::get_instance('td_ad_box')->render(array('spot_id' => 'header'));
                ?>
            </div>
        </div>
    </div>
</div>
