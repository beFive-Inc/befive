<?php

namespace App\Traits;

trait Operator
{
    /**
     * Similar to SQL Like Operator
     *
     * @param $pattern
     * @param $subject
     * @return bool
     */
    public function likeOperator($pattern, $subject): bool
    {
        $pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
        return preg_match("/^{$pattern}$/i", $subject);
    }

    /**
     * @return int
     */
    public function getRandomHashtag(): int
    {
        $hashtag = null;

        for ($i = 1; $i <= 4; $i++) {
            $randNumber = rand(0, 9);

            $hashtag = $hashtag . $randNumber;
        }

        return (int) $hashtag;
    }
}
