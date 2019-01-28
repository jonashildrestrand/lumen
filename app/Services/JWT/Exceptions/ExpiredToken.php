<?php

class ExpiredToken extends Exception
{
    public function __construct()
    {
        parent::__construct('Token has expired.');
    }
}