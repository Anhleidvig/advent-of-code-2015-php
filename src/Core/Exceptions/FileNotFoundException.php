<?php

namespace App\Core\Exceptions;

use Exception;
use Throwable;

class FileNotFoundException extends Exception
{
    public function __construct(string $filename = "", int $code = 0, ?Throwable $previous = null)
    {
        $message = "File not found";

        if (!empty($filename)) {
            $message .= ": $filename";
        }

        parent::__construct($message, $code, $previous);
    }
}
