<?php

namespace App\Exceptions;


use GraphQL\Error\Error;
use Folklore\GraphQL\Error\ValidationError;

class GraphQLExceptions
{
    public static function formatError(Error $e)
    {
        $error = [
            'message' => $e->getMessage(),
            'source' => $e->getSource(),
        ];

        $locations = $e->getLocations();

        if (!empty($locations)) {
            $error['locations'] = array_map(function ($loc) {
                return $loc->toArray();
            }, $locations);
        }

        $previous = $e->getPrevious();

        if ($previous) {
            if ($previous instanceof ValidationError) {
                $error['validation'] = $previous->getValidatorMessages();
            } else {
                $error['code'] = $previous->getCode();
                $error['file'] = $previous->getFile();
                $error['line'] = $previous->getLine();
                $error['trace'] = preg_split('/\n/', $previous->getTraceAsString());
            }
        } else {
            if (app()->bound('sentry') && $e->getPrevious()) {
                app('sentry')->captureException($e->getPrevious());
            }
        }

        return $error;
    }
}
