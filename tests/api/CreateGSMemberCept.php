<?php
require __DIR__.'/_bootstrap.php';
$I = new ApiTester($scenario);
$I->wantTo('Add a new GS Member to the system, using valid data.');
$I->haveHttpHeader('Content-Type', 'application/json');
$I->haveHttpHeader('Accept', 'application/json');
$I->sendPOST('/zend-gs', $validCreationData);
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::CREATED); // 201
$I->seeResponseIsJson();
$I->seeResponseMatchesJsonType([
    'id' => 'string',
    '_links' => 'array'
]);
