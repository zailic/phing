<?php

namespace Phing\Test\Helper;

class Proxy
{
    private $text = '';

    public function addText($text)
    {
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }
}