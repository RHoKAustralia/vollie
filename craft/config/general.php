<?php

/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here.
 * You can see a list of the default settings in craft/app/etc/config/defaults/general.php
 */

$parameters = require __DIR__ . '/parameters.php';

return array_merge($parameters, [
    'devMode' => true
]);
