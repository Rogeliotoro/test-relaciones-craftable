<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'last_login_at' => 'Last login',
            'activated' => 'Activated',
            'email' => 'Email',
            'first_name' => 'First name',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
            'last_name' => 'Last name',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
                
            //Belongs to many relations
            'roles' => 'Roles',
                
        ],
    ],

    'pilot' => [
        'title' => 'Pilots',

        'actions' => [
            'index' => 'Pilots',
            'create' => 'New Pilot',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'nickName' => 'NickName',
            
        ],
    ],

    'car' => [
        'title' => 'Cars',

        'actions' => [
            'index' => 'Cars',
            'create' => 'New Car',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'id_pilot' => 'Id pilot',
            'models' => 'Models',
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];