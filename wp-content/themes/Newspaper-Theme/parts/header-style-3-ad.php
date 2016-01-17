<div class="container header-content-rec">
    <div class="row">
        <div class="span12">
            <?php
            // show the header ad spot
            echo td_global_blocks::get_instance('td_ad_box')->render(array('spot_id' => 'header'));
            ?>
        </div>
    </div>
</div>