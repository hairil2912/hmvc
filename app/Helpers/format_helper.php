<?php

/**
Helper format
https://khairilanwar.web.id
 */

function format_ribuan($value)
{
	return number_format($value, 0, ',', '.');
}
