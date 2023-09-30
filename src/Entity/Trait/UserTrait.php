<?php

namespace App\Entity\Trait;

trait UserTrait
{
    public function getFullname(): string
    {
        $fullname = $this->getFirstname().' '.$this->getLastname();

        return '' == trim($fullname) ? $this->getEmail() : $fullname;
    }
}