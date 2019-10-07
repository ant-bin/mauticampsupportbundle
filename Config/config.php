<?php

return [
    'name'        => 'Mautic AMP',
    'description' => 'Add AMP-email support  for Mautic',
    'author'      => 'yozma.tech',
    'version'     => '1.0.0',
    'services' => [
        'events' => [
            'mautic.plugin.email.amp.subscriber' => [
                'class'     => \MauticPlugin\MauticAMPSupportBundle\EventListener\EmailSubscriber::class,
                'arguments' => [
                    'mautic.amp.helper.token',
                ],
            ],
        ],
        'other' => [
            'mautic.amp.helper.token' => [
                'class'     => \MauticPlugin\MauticAMPSupportBundle\Helper\AMPHelper::class,
                'arguments' => [
                    'mautic.http.connector',
                ],
            ],
        ],
    ],
];
