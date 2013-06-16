<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * 
 * @package Tax
 * @author Hète.ca Team
 * @copyright (c) 2013, Hète.ca Inc.
 */
class Kohana_Tax {

    /**
     * Default tax group to be used.
     * 
     * @var string 
     */
    public static $default = NULL;

    public static function factory($group = NULL) {

        if ($group === NULL) {
            $group = Tax::$default;
        }

        return new Tax($group);
    }

    private $group;

    protected function __construct($group) {
        $this->group = $group;
    }

    /**
     * Applies configured taxes on an amount.
     * 
     * @param real $amount
     * @return real
     */
    public function tax($amount) {

        $initial_amount = $amount;        
        
        foreach (Kohana::$config->load("tax.$this->group") as $tax) {

            $amount_to_be_taxed = Arr::get($tax, 'cumulative', FALSE) ? $amount : $initial_amount;

            $relative_amount = $amount_to_be_taxed * (Arr::get($tax, 'percent', 0) / 100); // Relative tax
            $absolute_amount = Arr::get($tax, 'amount', 0); // Absolute tax

            $amount += $relative_amount + $absolute_amount;
        }

        return $amount;
    }

    /**
     * Calculate the amount of tax applied on a price.
     * 
     * @param real $amount
     * @return real
     */
    public function tax_diff($amount) {
        return static::tax($amount) - $amount;
    }

}

?>
