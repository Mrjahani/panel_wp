<?php 


function validate_email($email)
{
	if (! filter_var($email , FILTER_VALIDATE_EMAIL)) {
		return 'email not valid';
	}
}

function validate_password($password)
{
	if (! mb_strlen($password) <= 8 ) {
		return 'Password must not be less than 8 characters ';
	}
}

