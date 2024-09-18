<?php

namespace App\Enums;

enum Roles: string
{
    case ADMIN = 'Admin';
    case USER = 'User';
    case AUTHOR = 'Author';
}
