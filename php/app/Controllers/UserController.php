<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends ApiController
{
    /**
     * Returns all users
     *
     * @return json
     */
    public function index()
    {
        $users = User::all();

        return $this->respond($users);
    }


    /**
     * Returns a specific User
     *
     * @return json
     */
    public function get($id)
    {
        $user = User::get($id);

        $user['name'] = $user['first_name'] . ' ' . $user['last_name'];

        return $this->respond($user);
    }


    /**
     * NOT IMPLEMENTED
     * Adds a specific User
     *
     * @return json
     */
    public function post($request)
    {
        return $this->respond('Ok, thank you.');
    }

}