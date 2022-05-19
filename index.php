<?php
namespace Thousand_Fib;

function get_fibonacci_index_by_length( int $length ): int {
	$last_fib = 1;
	$fib      = 1;
	$index    = 2;
	while( strlen( $fib ) < $length ){
		$new_last_fib = $fib;
		$fib = $last_fib + $new_last_fib;
		$last_fib = $new_last_fib;
		$index++;
	}

	return $index;
}
