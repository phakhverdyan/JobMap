<?php
/**
 * Created by PhpStorm.
 * User: denispetrusha
 * Date: 20.01.2018
 * Time: 19:45
 */

namespace App\GraphQL\Extensions;

use Folklore\GraphQL\Support\Field;
use App\GraphQL\Auth;

class AuthQuery extends Field
{
    // use JWT authorization
    use Auth;
}