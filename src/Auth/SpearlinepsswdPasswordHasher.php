<?php

namespace App\Auth;

use Cake\Auth\AbstractPasswordHasher;

class SpearlinepsswdPasswordHasher extends AbstractPasswordHasher
{
	const SPEARLINESALT = 'sdfdewjrOU4rfjflasiknqdsfsafrjeel';
	
    public function hash($password)
    {
        return sha1($password . self::SPEARLINESALT);
    }

    public function check($password, $hashedPassword)
    {
        return sha1($password . self::SPEARLINESALT) === $hashedPassword;
    }
}