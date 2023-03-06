<?php

return [
    'whisker' => [
        'admin'=>[
        'username' => 'dev1',
        'password' => 'OWYQgV37ZO%ahw1UKKC0q(7SBxgs*qczj8#dKXL1fDTQmobP'
        ],
        'armember_api_key'=>'80PiekHihrxX9AoSEAsNxkFfp0Q16h',
        'url'=>[
            'token'=>'https://wandsdev.divinus.us/wp-json/jwt-auth/v1/token',
            'token_validate'=>'https://wandsdev.divinus.us/wp-json/jwt-auth/v1/token/validate',
            'search_user'=>'https://wandsdev.divinus.us/wp-json/wp/v2/users?search=',
            'get_user'=>'https://wandsdev.divinus.us/wp-json/wp/v2/users/',
            'list_order'=>'https://wandsdev.divinus.us/wp-json/wc/v3/orders',
            'get_order'=>'https://wandsdev.divinus.us/wp-json/wc/v3/orders/',
            'reset_password'=>'https://wandsdev.divinus.us/wp-json/bdpwr/v1/reset-password',
            'reset_validate'=> 'https://wandsdev.divinus.us/wp-json/bdpwr/v1/validate-code',
            'set_password'=>'https://wandsdev.divinus.us/wp-json/bdpwr/v1/set-password',
            'get_billing'=>'https://wandsdev.divinus.us/wp-json/wc/v3/customers/',
            'user_memberhip_details'=>'https://wandsdev.divinus.us/wp-json/armember/v1/arm_member_memberships?',
            'user_transaction_details'=>'https://wandsdev.divinus.us/wp-json/armember/v1/arm_member_payments?',
            'membership_list'=>'https://wandsdev.divinus.us/wp-json/armember/v1/arm_memberships?',
            'membership_details'=>'https://wandsdev.divinus.us/wp-json/armember/v1/arm_membership_details?',
            'add_member_plan'=>'https://wandsdev.divinus.us/wp-json/armember/v1/arm_add_member_membership?',
            'add_transaction'=>'https://wandsdev.divinus.us/wp-json/armember/v1/arm_add_member_transaction?'
        ],
    ],
    'griffin'=>[
        'admin'=>[
            "username"=>'dev1',
            'password'=>'$Y*IenB62r(DN%PC8ylp@wwIjJfAA9DeXg^O)IM3jj3f#q7H'
        ],
        'url'=>[
            'token'=>'https://grcrdev.divinus.us/wp-json/jwt-auth/v1/token',
            'token_validate'=>'https://grcrdev.divinus.us/wp-json/jwt-auth/v1/token/validate',
            'list_order'=>'https://grcrdev.divinus.us/wp-json/wc/v3/orders',
            'search_user'=>'https://grcrdev.divinus.us/wp-json/wp/v2/users?search=',
            'get_user'=>'https://grcrdev.divinus.us/wp-json/wp/v2/users/',
            'get_order'=>'https://grcrdev.divinus.us/wp-json/wc/v3/orders/',  
            'reset_password'=>'https://grcrdev.divinus.us/wp-json/bdpwr/v1/reset-password',
            'reset_validate'=>'https://grcrdev.divinus.us/wp-json/bdpwr/v1/validate-code',
            'set_password'=>'https://grcrdev.divinus.us/wp-json/bdpwr/v1/set-password',
            'get_billing'=>'https://grcrdev.divinus.us/wp-json/wc/v3/customers/',
            'get_bookings'=>'https://grcrdev.divinus.us/wp-json/portalapi/v1/bookings/',
            'cancel_booking'=>'https://grcrdev.divinus.us/wp-json/portalapi/v1/booking/cancel?bookingid='
        ],
    ],

];