<?php
trait TranslateMethods
{
    public function getTranslatedAttribute($value)
    {
        if ($json = json_decode($value)) {
            return $json->{app()->getLocale()} ?? "";
        }
        return $value;
    }
}

















?>