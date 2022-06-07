<?php

namespace App\Traits;

trait Friendable
{
    public function getOnlineFriends() {
        return $this->getFriends()->filter(function ($friend) {
            return $friend->isOnline();
        });
    }

    public function getOfflineFriends() {
        return $this->getFriends()->filter(function ($friend) {
            return !$friend->isOnline();
        });
    }
}
