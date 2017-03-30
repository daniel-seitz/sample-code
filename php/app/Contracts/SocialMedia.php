<?php

namespace App\Contracts;

interface SocialMedia {
    /**
     * Authenticates the given user
     *
     * @param App\Models\User $user
     */
    public function authenticate(App\Models\User $user);

    /**
     * Posts to the network
     *
     * @param string $message
     * @return string
     */
    public function post($message);

    /**
     * Deletes a post from the network
     *
     * @param $postId
     */
    public function dePost($postId);
}