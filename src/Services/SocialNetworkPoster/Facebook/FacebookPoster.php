<?php

namespace App\Services\SocialNetworkPoster\Facebook;

use App\Services\SocialNetworkPoster\SocialNetworkConnector;
use App\Services\SocialNetworkPoster\SocialNetworkPoster;

class FacebookPoster extends SocialNetworkPoster
{
    private $login, $password;

    public function __construct(string $login, string $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public function getSocialNetwork(): SocialNetworkConnector
    {
        return new FacebookConnector($this->login, $this->password);
    }
}