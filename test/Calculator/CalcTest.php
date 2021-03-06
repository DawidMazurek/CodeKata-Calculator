<?php

use CodeKata\Calculator\Calc;

class CalcTest extends PHPUnit_Framework_TestCase {

    protected $calc;

    public function setUp()
    {
        $this->calc = new Calc();
        $this->calc->turnOn();
    }

    /** @test */
    public function it_displays_welcome_message()
    {


        $this->assertEquals(
            '0',
            $this->calc->getResult()
        );
    }

    /**
     * @test
     * @dataProvider button_to_press_data_provider
     */
    public function it_displays_given_value($a)
    {
        $length = strlen($a);
        for ($i = 0; $i < $length; $i++) {
            $this->calc->pressButton($a{$i});
        }

        $this->assertEquals(
            $a,
            $this->calc->getResult(),
            'Display not equal given value'
        );
    }

    /**
     * @test
     * @dataProvider backspace_button_data_provider
     */
    public function it_removes_last_character($given, $expected)
    {
        $length = strlen($given);
        for ($i = 0; $i < $length; $i++) {
            $this->calc->pressButton($given{$i});
        }
        $this->calc->pressButton('backspace');
        $this->assertEquals($expected, $this->calc->getResult());
    }
    /**
     * @test
     * @dataProvider values_to_add
     */
    public function it_can_add($n1, $n2, $expected) {
        $this->calcPressButtons($n1);
        $this->calc->pressButton('plus');
        $this->calcPressButtons($n2);
        $this->calc->pressButton('equals');
        $this->assertEquals($expected, $this->calc->getResult());
    }

    /**
     * @test
     * @dataProvider values_to_minus
     */
    public function it_can_minus($n1, $n2, $expected) {
        $this->calcPressButtons($n1);
        $this->calc->pressButton('minus');
        $this->calcPressButtons($n2);
        $this->calc->pressButton('equals');
        $this->assertEquals($expected, $this->calc->getResult());
    }

    /**
     * @test
     * @dataProvider values_to_divide
     * @param $n1
     * @param $n2
     * @param $expected
     */
    public function it_can_divide($n1, $n2, $expected) {
        $this->calcPressButtons($n1);
        $this->calc->pressButton('minus');
        $this->calcPressButtons($n2);
        $this->calc->pressButton('equals');
        $this->assertEquals($expected, $this->calc->getResult());
    }

    public function button_to_press_data_provider() {
        return [
            ['1'],
            ['-11'],
            ['1234']
        ];
    }
    public function values_to_add() {
        return [
            ['1', '1', '2'],
            ['2', '3', '5'],
            ['-2', '-3', '-5']
        ];
    }
    public function values_to_minus() {
        return [
            ['1', '1', '0'],
            ['2', '3', '-1'],
            ['-2', '-3', '1']
        ];
    }

    public function backspace_button_data_provider()
    {
        return [
            ['0', '0'],
            ['11', '1'],
            ['-1', '0'],
            ['-11', '-1'],
        ];
    }
    
    public function values_to_divide()
    {
        return [
            ['10', '5', '2'],
            ['0', '8', '0'],
            ['8', '0', 'dude wtf'],
            ['1', '3', '0,3(3)'],
            ['-40', '-20', '2']
        ];
    }

    private function calcPressButtons($given) {
        $length = strlen($given);
        for ($i = 0; $i < $length; $i++) {
            $this->calc->pressButton($given{$i});
        }
    }
}
