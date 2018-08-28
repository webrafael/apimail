<?php

namespace Mail;

use Mail\Core\MailCore;

class Mail
{
	public static function __callStatic($method, $arguments)
    {
       return call_user_func_array(array(new MailCore, $method), $arguments);
    }
}