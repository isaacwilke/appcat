<?php

return [
    'whisker' => [
        'admin'=>[
        'username' => 'dev1',
        'password' => 'OWYQgV37ZO%ahw1UKKC0q(7SBxgs*qczj8#dKXL1fDTQmobP'
        ],
        'armember_api_key'=>'80PiekHihrxX9AoSEAsNxkFfp0Q16h',
        'url'=>[
            'token'=>'https://whiskersandsoda.com/wp-json/jwt-auth/v1/token',
            'token_validate'=>'https://whiskersandsoda.com/wp-json/jwt-auth/v1/token/validate',
            'search_user'=>'https://whiskersandsoda.com/wp-json/wp/v2/users?search=',
            'get_user'=>'https://whiskersandsoda.com/wp-json/wp/v2/users/',
            'list_order'=>'https://whiskersandsoda.com/wp-json/wc/v3/orders',
            'get_order'=>'https://whiskersandsoda.com/wp-json/wc/v3/orders/',
            'reset_password'=>'https://whiskersandsoda.com/wp-json/bdpwr/v1/reset-password',
            'reset_validate'=> 'https://whiskersandsoda.com/wp-json/bdpwr/v1/validate-code',
            'set_password'=>'https://whiskersandsoda.com/wp-json/bdpwr/v1/set-password',
            'get_billing'=>'https://whiskersandsoda.com/wp-json/wc/v3/customers/',
            'user_memberhip_details'=>'https://whiskersandsoda.com/wp-json/armember/v1/arm_member_memberships?',
            'user_transaction_details'=>'https://whiskersandsoda.com/wp-json/armember/v1/arm_member_payments?',
            'membership_list'=>'https://whiskersandsoda.com/wp-json/armember/v1/arm_memberships?',
            'membership_details'=>'https://whiskersandsoda.com/wp-json/armember/v1/arm_membership_details?',
            'add_member_plan'=>'https://whiskersandsoda.com/wp-json/armember/v1/arm_add_member_membership?'
        ],
    ],
    'griffin'=>[
        'admin'=>[
            "username"=>'dev1',
            'password'=>'$Y*IenB62r(DN%PC8ylp@wwIjJfAA9DeXg^O)IM3jj3f#q7H'
        ],
        'url'=>[
            'token'=>'https://griffinrockcatretreat.com/wp-json/jwt-auth/v1/token',
            'token_validate'=>'https://griffinrockcatretreat.com/wp-json/jwt-auth/v1/token/validate',
            'list_order'=>'https://griffinrockcatretreat.com/wp-json/wc/v3/orders',
            'search_user'=>'https://griffinrockcatretreat.com/wp-json/wp/v2/users?search=',
            'get_user'=>'https://griffinrockcatretreat.com/wp-json/wp/v2/users/',
            'get_order'=>'https://griffinrockcatretreat.com/wp-json/wc/v3/orders/',  
            'reset_password'=>'https://griffinrockcatretreat.com/wp-json/bdpwr/v1/reset-password',
            'reset_validate'=>'https://griffinrockcatretreat.com/wp-json/bdpwr/v1/validate-code',
            'set_password'=>'https://griffinrockcatretreat.com/wp-json/bdpwr/v1/set-password',
            'get_billing'=>'https://griffinrockcatretreat.com/wp-json/wc/v3/customers/',
        ],
    ],

];