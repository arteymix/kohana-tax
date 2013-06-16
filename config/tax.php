<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Tax settings.
 * 
 * @package Tax
 * @author Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 */
return array(
    'ca' => array(
        'qc' => array(
            'tps' => array(
                'cumulative' => FALSE,
                'percent' => 5.0,
            ),
            'tvq' => array(
                'cumulative' => FALSE,
                'percent' => 9.975
            )
        )
    )
);
?>
