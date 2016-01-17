<?php

/*  ----------------------------------------------------------------------------
    Full header text logo
 */

?>
<!-- text logo -->
<div class="td-header-bg">
    <div class="container td-logo-rec-wrap">
        <div class="row">
            <div class="span12 header-logo-wrap" role="banner" itemscope="itemscope" itemtype="<?php echo td_global::$http_or_https?>://schema.org/Organization">
                <div class="td-logo-wrap-align">


                    <?php
                    //read the logo + retina logo
                    $td_customLogo = td_util::get_option('tds_logo_upload');
                    $td_customLogoR = td_util::get_option('tds_logo_upload_r');

                    $td_logo_alt = td_util::get_option('tds_logo_alt');
                    $td_logo_title = td_util::get_option('tds_logo_title');

                    if (!empty($td_logo_title)) {
                        $td_logo_title = ' title="' . $td_logo_title . '"';
                    }

                    if (!empty($td_customLogoR)) {
                        ?>
                        <a itemprop="url" href="<?php echo home_url(); ?>">
                            <img class="td-retina-data td-logo"  data-retina="<?php echo htmlentities($td_customLogoR) ?>" src="<?php echo $td_customLogo?>" alt="<?php echo $td_logo_alt ?>"<?php echo $td_logo_title ?>/>
                        </a>
                        <meta itemprop="name" content="<?php bloginfo('name')?>">
                        <?php

                    } else {
                        if (!empty($td_customLogo)) {
                            ?>
                            <a class="td-logo" itemprop="url" href="<?php echo home_url(); ?>"><img src="<?php echo $td_customLogo?>" alt="<?php echo $td_logo_alt ?>"<?php echo $td_logo_title ?>/></a>
                            <meta itemprop="name" content="<?php bloginfo('name')?>">

                            <?php
                        } else { ?>

                            <a itemprop="url" class="td-logo-wrap" href="<?php echo home_url(); ?>">
                                <span class="td-logo-text"><?php echo get_bloginfo( 'name' ); ?></span>
                                <span class="td-tagline-text"><?php echo get_bloginfo( 'description' ); ?></span>
                            </a>
                            <?php
                        }
                    }
                    ?>
                </div>
                <meta itemprop="name" content="<?php bloginfo('name')?>">
            </div>
        </div>
    </div>
</div>
