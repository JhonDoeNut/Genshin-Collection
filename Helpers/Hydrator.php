<?php
namespace Helpers;

class Hydrator
{
    public static function hydrate(object $obj, array $data): object
    {
        foreach ($data as $key => $value) {
            $camel = str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
            $method = 'set' . $camel;

            if (method_exists($obj, $method)) {
                $obj->$method($value);
            }
        }
        return $obj;
    }
}
