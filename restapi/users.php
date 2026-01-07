<?php

function getUsers()
{
    return [
        ['id' => 1, 'name' => 'Ram'],
        ['id' => 2, 'name' => 'Shyam']
    ];
}

function createUser($data)
{
    return [
        'message' => 'User created',
        'user' => $data
    ];
}
