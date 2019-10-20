<?php

$config = [];

$config = [
    'scoutgroup' =>  [
        'scoutnet' => 'scoutgroupfunc'
    ],
    'member' => [
        'scoutnet' => 'memberfunc'
    ],
    'contact' => [
        'scoutnet' => 'contactfunc'
    ],
    'troop' => [
        'scoutnet' => 'troopbuilder'
    ],
    'patrol' => [
        'scoutnet' => 'patrolsfunc'
    ],
    'branch' => [
        'local' => 'branchbuilder2',
    ],
    'rolegroup' => [
        'scoutnet' => 'rolegroupie',
        'local' => 'localgroupie',
    ],
    'customlist' => [
        'scoutnet' => 'customulisturu'
    ],
    'waitingmember' => [
        'scoutnet' => 'waintinglistbuild',
    ],
    'contact' => [
        'scoutnet' => 'waitingcontactbuilder'
    ],
    'troopmember' => [
        'scoutnet' => 'funcyfunk1',
        'local' => 'funcyfunk2'
    ],
    'patrolmember' => [
        'scoutnet' => 'weh',
        'local' => 'funcyfunk2complement'
    ],
];
