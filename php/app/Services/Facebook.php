<?php

namespace App\Services;

use App\Contracts\SocialMedia;

class Facebook implements SocialMedia
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
     * Posts to the network
     *
     * @param string $message
     * @return string
     */
    public function post($message)
    {
        // post to network
    }

    /**
     * Deletes a post from the network
     *
     * @param $postId
     */
    public function dePost($postId)
    {
        // delete post
    }
}