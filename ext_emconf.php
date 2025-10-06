<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Dynamic form recipient',
    'description' => 'Adds new form select type, which shows recipient records of a given page. This information can be used as dynamic recipient for the form data.',
    'category' => 'plugin',
    'author' => 'Andreas Kießling',
    'author_email' => 'kontakt@kiessling.tech',
    'author_company' => 'kiessling.tech',
    'state' => 'stable',
    'version' => '4.0.2',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.0-13.4.99',
            'form' => '13.4.0-13.4.99',
        ],
    ],
];
