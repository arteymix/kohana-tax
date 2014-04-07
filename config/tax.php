<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Tax settings.
 * 
 * @package Tax
 * @author  Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 * @license BSD 3 clauses
 */
return array(
    /**
     * Sample tax.
     */
    'sample' => array(
        // order is important for cumulative taxes
        'a' => array(
            'cumulative' => TRUE, // applies on the taxed amount
            'amount'     => 2     // absolute amount to be taxed
        ),
        'b' => array(
            'cumulative' => FALSE, // applies on the initial amount
            'percent'    => 4      // relative amount to be taxed
        )
    ),
    'ca' => array(
        /**
         * Quebec applies TVQ over TPS
         */
        'qc' => array(
            'tps' => array(
                'cumulative' => FALSE,
                'percent'    => 5.0,
            ),
            'tvq' => array(
                'cumulative' => FALSE,
                'percent'    => 9.975
            )
        )
    ),
    /**
     * TVA from France.
     */
    'fr' => array(
        'tva' => array(
            'cumulative' => FALSE,
            'percent' => 20
        )
    )
);
