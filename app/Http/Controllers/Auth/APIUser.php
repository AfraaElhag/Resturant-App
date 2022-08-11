<?php

//namespace App\Auth;
namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;

use Illuminate\Auth\GenericUser;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;

class ApiUser extends GenericUser implements UserContract
{
	protected $attributes = [];
     protected $rememberTokenName = false;

public function __construct($attributes)

{

    $this->attributes = $attributes;
}
public function __get($attribute)
{
    return $this->attributes[$attribute];
}
public function getKey()
{
    return $this->attributes['name'];
}
/**
 * Get the name of the unique identifier for the user.
 *
 * @return string
 */
public function getAuthIdentifierName()
{
    return 'id';
}
/**
 * Get the unique identifier for the user.
 *
 * @return mixed
 */
public function getAuthIdentifier()
{
    return $this->attributes['id'];
}
/**
 * Get the password for the user.
 *
 * @return string
 */
public function getAuthPassword()
{
    return null;
}

public function getAuthIdentifierEmail()
{
    return $this->attributes['email'];
}

/**
 * Get the token value for the "remember me" session.
 *
 * @return string
 */
public function getRememberToken()
{
    return null;
}
/**
 * Set the token value for the "remember me" session.
 *
 * @param  string  $value
 * @return void
 */
public function setRememberToken($value)
{
    //$this->attributes[$this->getRememberTokenName()] = null;
}
/**
 * Get the column name for the "remember me" token.
 *
 * @return string
 */
public function getRememberTokenName()
{ return null;
}

public function getAttributes()
{
    return $this->attributes;
}
}