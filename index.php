<?php
namespace Thousand_Fib;

/**
 * Defines a value for the irrational number Phi.
 */
define( 'PHI', (1 + sqrt(5)) / 2 );

function get_first_fibonacci_by_length( int $length ): array {
	$index = (int) get_index_by_length( $length );

	return [
		'index' => $index,
		'number' => get_fibonacci_number_by_index( $index ),
	];
}

/**
 * Returns the Fibonacci number when given a specific index.
 *
 * @see https://www.geekality.net/2009/11/06/project-euler-problem-25/
 */
function get_fibonacci_number_by_index( int $index ): int {
    return (int) round( pow( PHI, $index) / sqrt(5) );
}

/**
 * Get the index of the first Fibonacci number of a specific length.
 *
 * @return int
 */
function get_index_by_length( int $length ): int {
	return (int) ceil(($length + log10(5) / 2 - 1) / log10(PHI));
}
