<?php

namespace App\Dto;

final class UserOutput
{
    public $id;

    public $orders;

    public $email;

    public $roles = [];

    public $firstname;

    public $lastname;

    public $password;

    public $cart;

    public $store;
}