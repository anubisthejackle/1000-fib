<?php

namespace Thousand_Fib\Tests;

use function Thousand_Fib\get_first_fibonacci_by_length;

class Test_Fibonacci extends \WP_UnitTestCase {

    /**
     * Smoke Test: Confirm that we are actually loading the Fibonacci code.
     *
     * @test
     */
    public function fibonnaci_function_is_available() {
        $this->assertTrue( function_exists( 'Thousand_Fib\get_first_fibonacci_by_length') );
    }

	/**
	 * The first 2 digit Fibonacci number is the number 13, which happens
	 * to be Fibonacci index of 7.
	 *
	 * @test
	 */
	public function correct_index_provided_for_first_2_digit_number()
	{
		// Arrange
		$length   = 2;
		$expected = 7;

		// Act
		[ 'index' => $index ] = get_first_fibonacci_by_length( $length );

		// Assert
		$this->assertSame( $expected, $index );
	}

	/**
	 * The first 3 digit Fibonacci number is the number 144, which happens
	 * to be Fibonacci index of 12.
	 *
	 * @test
	 */
	public function correct_index_provided_for_first_3_digit_number()
	{
		// Arrange
		$length   = 3;
		$expected = 12;

		// Act
		[ 'index' => $index ] = get_first_fibonacci_by_length( $length );

		// Assert
		$this->assertSame( $expected, $index );
	}

	/**
	 * The first 4 digit Fibonacci number is the number 1597, which happens
	 * to be Fibonacci index of 17.
	 *
	 * @test
	 */
	public function correct_index_provided_for_first_4_digit_number()
	{
		// Arrange
		$length   = 4;
		$expected = 17;

		// Act
		[ 'index' => $index ] = get_first_fibonacci_by_length( $length );

		// Assert
		$this->assertSame( $expected, $index );
	}

	/**
	 * The first 1000 digit Fibonacci number can be found.
	 *
	 * @test
	 */
	public function correct_index_provided_for_first_1000_digit_number()
	{
		// Arrange
		$length   = 1000;
		$expected = 4782;

		// Act
		[ 'index' => $index ] = get_first_fibonacci_by_length( $length );

		// Assert
		$this->assertIsInt( $index );
		$this->assertSame( $expected, $index );
	}

}
