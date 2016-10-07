<?php
require __DIR__.'/_bootstrap.php';

// Attempt with wrong surname
$I = new ApiTester($scenario);
$I->wantTo('Try to add a new GS Member to the system, using invalid name.');
$I->haveHttpHeader('Content-Type', 'application/json');
$I->haveHttpHeader('Accept', 'application/json');
$I->sendPOST('/zend-gs', $invalidCreationData2);
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::UNPROCESSABLE_ENTITY); // 422
$I->seeResponseIsJson();
// Check conformity to API Problem format
$I->seeResponseMatchesJsonType([
    'validation_messages' => 'array',
    'type'                => 'string',
    'title'               => 'string',
    'status'              => 'integer',
    'detail'              => 'string'
]);