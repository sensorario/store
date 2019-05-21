<?php

namespace Memory\Services\Helper;

class Matcher
{
    private $haystack;

    public function setData($haystack)
    {
        $this->haystack = $haystack;
    }

    public function knows($needleName, $needleValue)
    {
        if (is_array($this->haystack) && isset($this->haystack[$needleName]) && $this->haystack[$needleName] == $needleValue) {
            return true;
        }

        if (current($this->haystack) == $needleValue && !is_array($this->haystack)) {
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
