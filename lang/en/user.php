<?php

declare(strict_types=1);

return [
    'model'          => 'User',

    'store_success'  => ':model registration was successful',
    'store_failed'   => 'there was an error registration the :model, please report the problem',

    'update_success' => ':model update was successful',
    'update_failed'  => 'there was an error update the :model, please report the problem',

    'delete_success' => ':model delete was successful',
    'delete_failed'  => 'there was an error delete the :model, please report the problem',
    'delete_can_not' => 'you do not have access to delete the :model',

    'toggle_success' => ':model switching was successful',
    'toggle_failed'  => 'there was an error switching the :model, please report the problem',
    'toggle_can_not' => 'you do not have access to switching the :model',
];
