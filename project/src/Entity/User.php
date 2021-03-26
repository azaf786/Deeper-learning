<?php


namespace App\Entity;


class User
{

    public ?int $id;
    public string $username;
    public string $email;
    public string $password;

    /**
     * User constructor.
     */
    public function __construct()
    {
    }
}