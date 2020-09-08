<?php

namespace Tests;

use App\Exceptions\Handler;
use Throwable;

class ExceptionHandler extends Handler
{
    public function render($request, Throwable $e)
    {
        if (
            !$this->isHttpNotFoundException($e)
            && !$this->isForbiddenException($e)
            && !in_array(get_class($e), $this->dontReport)
        ) {
            throw $e;
        }

        return parent::render($request, $e);
    }
}
