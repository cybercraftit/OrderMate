<?php
return [
    'create' => [
        \CyberCraft\OrderMate\models\Order::class,
        \CyberCraft\OrderMate\models\Customer::class,
    ],
    'read' => [
        \CyberCraft\OrderMate\models\Order::class,
        \CyberCraft\OrderMate\models\Customer::class,
    ],
    'update' => [
        \CyberCraft\OrderMate\models\Order::class,
        \CyberCraft\OrderMate\models\Customer::class,
    ],
    'delete' => [
        \CyberCraft\OrderMate\models\Order::class,
        \CyberCraft\OrderMate\models\Customer::class,
    ]
];