<?php

return [
    'whisker' => [
        'admin'=>[
        'username' => 'admin',
        'password' => 'admin@3338'
        ],
        'url'=>[
            'token'=>'https://exceledunet.com/wordpress/wp-json/jwt-auth/v1/token',
            'token_validate'=>'https://exceledunet.com/wordpress/wp-json/jwt-auth/v1/token/validate',
            'search_user'=>'https://exceledunet.com/wordpress/wp-json/wp/v2/users?search=',
            'get_user'=>'https://exceledunet.com/wordpress/wp-json/wp/v2/users/',
            'list_order'=>'https://exceledunet.com/wordpress/wp-json/wc/v3/orders',
            'get_order'=>'https://exceledunet.com/wordpress/wp-json/wc/v3/orders/',
            'reset_password'=>'https://exceledunet.com/wordpress/wp-json/bdpwr/v1/reset-password',
            'reset_validate'=> 'https://exceledunet.com/wordpress/wp-json/bdpwr/v1/validate-code',
            'set_password'=>'https://exceledunet.com/wordpress/wp-json/bdpwr/v1/set-password',
            'get_billing'=>'https://exceledunet.com/wordpress/wp-json/wc/v3/customers/',
        ],
    ],
    'griffin'=>[
        'admin'=>[
            "username"=>'admin2',
            'password'=>'admin2@3338'
        ],
        'url'=>[
            'token'=>'https://exceledunet.com/wordpress2/wp-json/jwt-auth/v1/token',
            'token_validate'=>'https://exceledunet.com/wordpress2/wp-json/jwt-auth/v1/token/validate',
            'list_order'=>'https://exceledunet.com/wordpress2/wp-json/wc/v3/orders',
            'search_user'=>'https://exceledunet.com/wordpress2/wp-json/wp/v2/users?search=',
            'get_user'=>'https://exceledunet.com/wordpress2/wp-json/wp/v2/users/',
            'get_order'=>'https://exceledunet.com/wordpress2/wp-json/wc/v3/orders/',  
            'reset_password'=>'https://exceledunet.com/wordpress2/wp-json/bdpwr/v1/reset-password',
            'reset_validate'=>'https://exceledunet.com/wordpress2/wp-json/bdpwr/v1/validate-code',
            'set_password'=>'https://exceledunet.com/wordpress2/wp-json/bdpwr/v1/set-password',
            'get_billing'=>'https://exceledunet.com/wordpress2/wp-json/wc/v3/customers/',
        ],
    ],

];