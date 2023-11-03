<?php

    $IS_DEV = true;
    $FOLDER_NAME = "";

    if ($IS_DEV) {  /** not local */
        $FOLDER_NAME = "/bulsu-hg-segregate";

    }
    else {          /** for Cpanel/server */
        $FOLDER_NAME = "";
    }



?>