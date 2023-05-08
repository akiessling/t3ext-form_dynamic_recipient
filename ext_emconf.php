<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Dynamic form recipient',
    'description' => 'Adds new form select type, which shows recipient records of a given page. This information can be used as dynamic recipient for the form data.',
    'category' => 'plugin',
    'author' => 'Andreas Kießling',
    'author_email' => 'kontakt@kiessling.tech',
    'author_company' => 'kiessling.tech',
    'state' => 'stable',
    'version' => '2.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-11.5.99',
            'form' => '10.4.0-11.5.99',
        ],
    ],
];
