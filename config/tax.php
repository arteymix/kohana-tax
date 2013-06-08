<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Tax settings.
 * 
 * @package Tax
 * @author Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 */
return array(
    'default' => array(
        'tax1' => array(
            'cumulative' => FALSE, // Wether the tax is add on cumulated amount or applied to initial amount
            'percent', // Percent of tax applied
            'amount' // Absolute amount of tax applied            
        )
    ),
    'canada' => array(
        'quebec' => array(
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
