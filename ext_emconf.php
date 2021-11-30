<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Dynamic form recipient',
    'description' => 'Adds new form select type, which shows recipient records of a given page. This information can be used as dynamic recipient for the form data.',
    'category' => 'plugin',
    'author' => 'Andreas Kießling',
    'author_email' => 'kiessling@extrameile-gehen.de',
    'author_company' => 'Extrameile GmbH',
    'state' => 'alpha',
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-10.4.99',
            'form' => '10.4.0-10.4.99',
        ],
    ],
];
