<?php
// Here you can initialize variables that will be available to your tests
$validCreationData = [
    'name' => 'Adam',
    'surname' => 'Culp',
    'city'    => 'Miami',
    'country' => 'US',
    'email' => 'adam.c@zend.com'
];
$invalidCreationData1 = [
    'name' => '12345',
    'surname' => 'Cavicchioli',
    'city'    => 'London',
    'country' => 'UK',
    'email' => 'massi.c@zend.com'
];
$invalidCreationData2 = [
    'name' => 'Massi',
    'surname' => '12435',
    'city'    => 'London',
    'country' => 'UK',
    'email' => 'massi.c@zend.com'
];
$invalidCreationData3 = [
    'name' => 'Massi',
    'surname' => 'Cavicchioli',
    'city'    => 'London',
    'country' => 'UK',
    'email' => 'Yo Yo!!!!'
];