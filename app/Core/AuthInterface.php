<?php
namespace Core;

interface AuthInterface 
{
    public function isGranted(string $role):bool;
}