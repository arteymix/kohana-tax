<?php


class TaxTest extends Unittest_TestCase {
    
    public function amounts() {
        
        return array(
            array(20, 22.8),
            array(0, 2),
            array(-20, -18.8)
        );        
    }

    /**
     * @dataProvider amounts
     */
    public function test_calculate($subtotal, $total) {

        $this->assertEquals($total, Tax::factory('sample')->calculate($subtotal));
    }
    
    
    /**
     * @dataProvider amounts
     */
    public function test_reverse($subtotal, $total) {

        $this->assertEquals($subtotal, Tax::factory('sample')->reverse($total));
    }
    
    /**
     * @dataProvider amounts
     */
    public function test_diff($subtotal, $total) {

        $this->assertEquals($total - $subtotal, Tax::factory('sample')->diff($subtotal));
    }    

    public function test_fr() {
        
        $this->assertEquals(24.0,Tax::factory('fr')->calculate(20.0));
    }
}
