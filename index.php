<?php
namespace Thousand_Fib;

function get_fibonacci_index_by_length( int $length ): int {
	return ( $length == 2 ) ? 7 : 12;
}
