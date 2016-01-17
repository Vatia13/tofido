<?php

/*  ----------------------------------------------------------------------------
    The default header (graphic logo and ad)
 */

?>

<!-- graphic logo and ad -->
<div class="td-header-bg">
    <div class="container td-logo-rec-wrap">
        <div class="row">
            <div class="span4 header-logo-wrap" role="banner" itemscope="itemscope" itemtype="<?php echo td_global::$http_or_https?>://schema.org/Organization">
                <?php
                //read the logo + retina logo
                $td_customLogo = td_util::get_option('tds_logo_upload');
                $td_customLogoR = td_util::get_option('tds_logo_upload_r');

                $td_logo_text = td_util::get_option('tds_logo_text');
                $td_tagline_text = td_util::get_option('tds_tagline_text');

                $td_logo_alt = td_util::get_option('tds_logo_alt');
                $td_logo_title = td_util::get_option('tds_logo_title');

                if (!empty($td_logo_title)) {
                    $td_logo_title = ' title="' . $td_logo_title . '"';
                }

                if (!empty($td_customLogoR)) {
                    //if retina
                    ?>
                    <a itemprop="url" href="<?php echo home_url(); ?>">
                        <img width="300" class="td-retina-data" data-retina="<?php echo htmlentities($td_customLogoR) ?>" src="<?php echo $td_customLogo?>" alt="<?php echo $td_logo_alt ?>"<?php echo $td_logo_title ?>/>
                    </a>
                    <meta itemprop="name" content="<?php bloginfo('name')?>">
                    <?php
                } else {
                    //not retina
                    if (!empty($td_customLogo)) {
                        ?>
                        <a itemprop="url" href="<?php echo home_url(); ?>"><img width="300" src="<?php echo $td_customLogo?>" alt="<?php echo $td_logo_alt ?>"<?php echo $td_logo_title ?>/></a>
                        <meta itemprop="name" content="<?php bloginfo('name')?>">
                        <?php
                    }
                }

                ?>
            </div>
            <div class="span8 td-header-style-1">
                <?php
                    // show the header ad spot
                    echo td_global_blocks::get_instance('td_ad_box')->render(array('spot_id' => 'header'));
                ?>
            </div>
        </div>
    </div>
</div>
