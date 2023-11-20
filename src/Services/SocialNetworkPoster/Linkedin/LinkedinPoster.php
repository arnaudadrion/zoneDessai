<?php

namespace App\Services\SocialNetworkPoster\Linkedin;

use App\Services\SocialNetworkPoster\SocialNetworkConnector;
use App\Services\SocialNetworkPoster\SocialNetworkPoster;

class LinkedinPoster extends SocialNetworkPoster
{
    private $login, $password;

    public function __construct(string $login, string $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public function getSocialNetwork(): SocialNetworkConnector
    {
        return new LinkedinConnector($this->login, $this->password);
    }
}