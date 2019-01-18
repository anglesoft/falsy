<?php

use PHPUnit\Framework\TestCase;
use Angle\Falsy\Exceptions\FalsyClosureException;

final class FalsyTest extends TestCase
{
    private function makeClosureReturning($var)
    {
        return function () use ($var) {
            return $var;
        };
    }

    public function testFalsy()
    {
        // Basic
        $this->assertTrue(
            falsy(false)
        );

        $this->assertFalse(
            falsy(true)
        );

        $this->assertFalse(
            falsy(true, false)
        );

        $this->assertFalse(
            falsy(false, true)
        );

        $this->assertFalse(
            falsy(false, true, false)
        );

        // Dummy class
        $std = new stdClass;
        $std->nullProperty = '';
        $std->falseProperty = false;

        // Falsy types
        $this->assertTrue(
            falsy(
                false,
                0,
                0.0,
                '0',
                [],
                [''],
                $std,
                null
            )
        );

        $std->filledProperty = 'foo';
        $std->trueProperty = true;

        // Truthy types
        $this->assertFalse(
            falsy(
                // Truthy
                true,
                1,
                0.1,
                '1',
                ['1'],
                $std
            )
        );

        // Arrays
        $this->assertFalse(
            falsy([true, true])
        );

        $this->assertFalse(
            falsy([true, false])
        );

        $this->assertTrue(
            falsy([false, false])
        );

        $this->assertTrue(
            falsy([], [''], [0], ['' => ''], ['key' => null], [[0], [0], [0 => '']])
        );

        $this->assertFalse(
            falsy([1], [0, 1], ['key' => 'value'], [0 => [0 => true]])
        );

        // Closure
        $this->assertFalse(
            falsy(function () { return true; })
        );

        $this->assertTrue(
            falsy(function () { return false; })
        );

        $this->assertTrue(
            falsy(function () { return [false]; })
        );

        // Exception
        $this->expectException(FalsyClosureException::class);

        falsy(
            function () { return false; },
            function () { return false; }
        );
    }

    public function testNullsy()
    {
        // Basic
        $this->assertTrue(
            nullsy('')
        );

        $this->assertTrue(
            nullsy(0)
        );

        $this->assertTrue(
            nullsy('0')
        );

        $this->assertTrue(
            nullsy([])
        );

        $this->assertTrue(
            nullsy([''])
        );

        $this->assertTrue(
            nullsy('', [''])
        );

        $this->assertFalse(
            nullsy('', 'foo', [''])
        );

        $this->assertFalse(
            nullsy('foo', null, '')
        );

        $this->assertFalse(
            nullsy('foo', '0')
        );

        $this->assertFalse(
            nullsy('foo', 'bar')
        );

        // Dummy class
        $std = new stdClass;
        $std->nullProperty = '';
        $std->falseProperty = false;

        // Falsy types
        $this->assertTrue(
            nullsy(
                false,
                0,
                0.0,
                '0',
                [],
                [''],
                $std,
                null
            )
        );

        $std->filledProperty = 'foo';
        $std->trueProperty = true;

        // Truthy types
        $this->assertFalse(
            nullsy(
                true,
                1,
                0.1,
                '1',
                ['1'],
                $std
            )
        );

        $this->assertFalse(
            nullsy(
                9999,
                false,
                0,
                0.0,
                '0',
                [],
                [''],
                $std,
                null
            )
        );

        $this->assertFalse(
            nullsy(
                false,
                0,
                0.0,
                '0',
                999,
                [],
                [''],
                $std,
                null,
                9999
            )
        );

        $this->assertFalse(
            nullsy(
                false,
                0,
                0.0,
                '0',
                [],
                [''],
                $std,
                null,
                9999
            )
        );

        // Arrays
        $this->assertTrue(
            nullsy([])
        );

        $this->assertFalse(
            nullsy([true, true])
        );

        $this->assertFalse(
            nullsy([true, false])
        );

        $this->assertTrue(
            nullsy([false, false], [null])
        );

        $this->assertTrue(
            nullsy([], [''], [0], ['' => ''], ['key' => null], [[0], [0], [0 => '', [0 => [0 => null]]]])
        );

        $this->assertFalse(
            nullsy([1], [0, 1], ['key' => 'value'], [0 => [0 => true]])
        );
        $this->assertFalse(
            nullsy(null, [1], [0, 1], ['key' => 'value'], [0 => [0 => true]])
        );

        // Closure
        $this->assertFalse(
            falsy(function () { return true; })
        );

        $this->assertTrue(
            falsy(function () { return false; })
        );

        $this->assertTrue(
            falsy(function () { return [false]; })
        );

        // Exception
        $this->expectException(FalsyClosureException::class);

        falsy(
            function () { return false; },
            function () { return false; }
        );
    }

    public function testTruthy()
    {
        // Basic
        $this->assertTrue(
            truthy(true)
        );

        $this->assertFalse(
            truthy(false)
        );

        $this->assertFalse(
            truthy(false, true)
        );

        $this->assertFalse(
            truthy(true, false)
        );

        $this->assertFalse(
            truthy(true, false, true)
        );

        $this->assertFalse(
            truthy(false, true, false)
        );

        $this->assertTrue(
            truthy(1, ' ', true)
        );

        $this->assertFalse(
            truthy(
                true,
                false
            )
        );

        // Dummy class
        $std = new stdClass;
        $std->nullProperty = '';
        $std->falseProperty = false;

        // Falsy types
        $this->assertFalse(
            truthy(
                false,
                0,
                0.0,
                '0',
                [],
                [''],
                $std,
                null
            )
        );

        $std->filledProperty = 'foo';
        $std->trueProperty = true;

        // Truthy types
        $this->assertTrue(
            truthy(
                // Truthy
                true,
                1,
                0.1,
                '1',
                ['1'],
                $std
            )
        );

        // Arrays
        $this->assertTrue(
            truthy([true, true])
        );

        $this->assertFalse(
            truthy([true, false])
        );

        $this->assertFalse(
            truthy([false, false])
        );

        $this->assertFalse(
            truthy([], [''], [0], ['' => ''], ['key' => null], [[0], [0], [0 => '']])
        );

        $this->assertTrue(
            truthy([1], [0, 1], ['key' => 'value'], [0 => [0 => true]])
        );

        // Closure
        $this->assertTrue(
            truthy(function () { return true; })
        );

        $this->assertFalse(
            truthy(function () { return false; })
        );

        $this->assertFalse(
            truthy(function () { return [false]; })
        );

        // Exception
        $this->expectException(FalsyClosureException::class);

        truthy(
            function () { return false; },
            function () { return false; }
        );
    }
}
