<?php

/**
 * This is the full blog post module
 * Class td_module_7 - full blog post module
 */

class td_module_7 extends td_module_1 {

    function __construct($post) {
        //run the parrent constructor
        $this->show_excerpt = true;
        parent::__construct($post);
    }


}




