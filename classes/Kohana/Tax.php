<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Tax amounts with a tax configuration.
 *
 * @package   Tax
 * @author    Hète.ca Team
 * @copyright (c) 2013, Hète.ca Inc.
 * @license   BSD 3 clauses
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

    protected function __construct($group) {

        if ($group === NULL) {

            throw new Kohana_Exception('You must set Tax::$default value in your bootstrap file.');
        }

        $this->config = Kohana::$config->load("tax.$group");

        if ($this->config === NULL) {

            throw new Kohana_Exception('Tax group :group is not defined in the configuration.', array(
        ':group' => $group
            ));
        }
    }

    /**
     * Calcuate taxes on a specified amount.
     * 
     * @param  real $subtotal
     * @return real
     */
    public function diff($subtotal) {

        $taxes = 0.0;

        foreach ($this->config as $tax) {

            $amount = Arr::get($tax, 'cumulative', FALSE) ? $subtotal + $taxes : $subtotal;

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
     * @param  real $total
     * @return real the sub total that generates $total once taxed.
     */
    public function reverse($total) {

        $b = $this->diff(0);
        $a = ($this->diff(100) - $b) / 100;

        return ($total - $b) / ($a + 1);
    }

    /**
     * Calculate the amount of taxes applied on a sub total.

     * @param  real $subtotal a sub total.
     * @return real the amount of taxes appliable on $subtotal.
     */
    public function calculate($subtotal) {

        return $subtotal + $this->diff($subtotal);
    }

}
