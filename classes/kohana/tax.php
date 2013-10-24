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
     * Calcuate taxes on a specified amount.
     * 
     * @param real $sub_total
     * @return real
     */
    public function calculate($sub_total) {

        $taxes = 0.0;

        foreach (Kohana::$config->load("tax.$this->group") as $tax) {
            $amount = Arr::get($tax, 'cumulative', FALSE) ? $sub_total + $taxes : $sub_total;
            $taxes += $amount * (Arr::get($tax, 'percent', 0) / 100) + Arr::get($tax, 'amount', 0);
        }

        return $taxes;
    }

    /**
     * Calcuate reverse taxes on a specified amount.
     * 
     * Tax are linear, therefore we have
     * 
     * f(t) = at + b
     * 
     * b = f(0)
     * a = (f(k) - b) / k
     * 
     * Given those parameters, we can reverse the tax calculation.
     * 
     * @param real $total
     * @return real
     */
    public function reverse($total) {

        $b = $this->calculate(0);
        $a = ($this->calculate(100) - $b) / 100;

        return ($total - $b) / ($a + 1);
    }

}
