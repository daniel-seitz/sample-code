<?php

namespace App\Services;

use App\Contracts\SocialMedia;

class Twitter implements SocialMedia
{
    /**
     * Authenticates the given user
     *
     * @param App\Models\User $user
     */
    public function authenticate(App\Models\User $user)
    {
        // perform auth here
    }

    /**
     * Tweets to the network
     *
     * @param string $message
     * @return string
     */
    public function post($message)
    {
        // post to network
    }

    /**
     * Deletes a tweet from the network
     *
     * @param $postId
     */
    public function dePost($postId)
    {
        // delete post
    }
}