<?php

namespace Imdb\Exception;

use Imdb\Exception;

class Http extends Exception
{
    public $HTTPStatusCode = null;
}
