<?php

namespace Memory\Services;

class Matcher
{
    private $haystack;

    public function setData($haystack)
    {
        $this->haystack = $haystack;
    }

    public function knows($needleName, $needleValue)
    {
        if (current($this->haystack) == $needleValue) {
            return true;
        }

        foreach ($this->haystack as $fieldName => $value) {
            if ($needleName == $fieldName && $needleValue == $value) {
                return true;
            }
        }

        return false;
    }
}
