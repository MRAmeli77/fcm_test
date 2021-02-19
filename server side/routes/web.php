<?php

use Illuminate\Support\Facades\Route;

use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/SendNotification', function () {
    $factory = (new Factory)->withServiceAccount(__DIR__ . '\..\fcmtest-73a06-firebase-adminsdk-nafl1-ae84c5f43d.json');
    $messaging = $factory->createMessaging();

//    $topic = 'a-topic';
//    $message = CloudMessage::withTarget('topic', $topic)
//        ->withNotification($notification) // optional
//        ->withData($data) // optional
//    ;

//    $condition = "'TopicA' in topics && ('TopicB' in topics || 'TopicC' in topics)";
///*
//    OR-conditions are currently not processed correctly by the Firebase Rest API, leading to undelivered messages.
//    This can be resolved by splitting up a message to an OR-condition into multiple messages to AND-conditions.
//    So one conditional message to 'a' in topics || 'b' in topics should be sent as
//    two messages to the conditions 'a' in topics && !('b' in topics) and 'b' in topics && !('a' in topics)
//    References:
//        https://github.com/firebase/quickstart-js/issues/183
//        https://stackoverflow.com/a/52302136/284325
//*/
//    $message = CloudMessage::withTarget('condition', $condition)
//        ->withNotification($notification) // optional
//        ->withData($data) // optional
//    ;

    $data = ['title' => 'text messsssage'];
    $deviceToken = "add token here";
    $message = CloudMessage::withTarget('token', $deviceToken)->withNotification(Notification::create('Title is title', 'Body is body'))->withData($data);
    try {
        $messaging->send($message);
    } catch (Exception $e) {
        var_dump($e->getMessage());
    }
});
Route::get('/SendNotification/{deviceToken}', function ($deviceToken) {
    $factory = (new Factory)->withServiceAccount(__DIR__ . '\..\fcmtest-73a06-firebase-adminsdk-nafl1-ae84c5f43d.json');
    $messaging = $factory->createMessaging();
    $data = ['title' => 'text messsssage'];
    $message = CloudMessage::withTarget('token', $deviceToken)->withNotification(Notification::create('Title is title', 'Body is body'))
        ->withData($data);
    try {
        $messaging->send($message);
    } catch (Exception $e) {
        var_dump($e->getMessage());
    }
});
Route::get('/tokenCheck/{deviceToken}', function ($deviceToken) {
    $factory = (new Factory)->withServiceAccount(__DIR__ . '\fcmtest-73a06-firebase-adminsdk-nafl1-ae84c5f43d.json');
    $messaging = $factory->createMessaging();
//    $message = CloudMessage::withTarget('token', $deviceToken);
    $message = CloudMessage::fromArray([
        'token' => $deviceToken,
        'notification' => Notification::create('Title is title', 'Body is not body') // optional
    ]);
    try {
        $response = $messaging->send($message);
        var_dump($response);
    } catch (Exception $e) {
        var_dump($e->getMessage());
    }
});
Route::get('/subscribeUser/{deviceToken}/topic/{topic}', function ($deviceToken, $topic) {
    /*
     * You can subscribe client app instances to any existing topic, or you can create a new topic.
     * When you use the API to subscribe a client app to a new topic (one that does not already exist for your Firebase project),
     * a new topic of that name is created in FCM and any client can subsequently subscribe to it.
     */

    $factory = (new Factory)->withServiceAccount(__DIR__ . '\fcmtest-73a06-firebase-adminsdk-nafl1-ae84c5f43d.json');
    $messaging = $factory->createMessaging();
    $result = $messaging->subscribeToTopic($topic, $deviceToken);
//    $result = $messaging->subscribeToTopics($topics, $registrationTokenOrTokens);
    var_dump($result);
});
Route::get('/unsubscribeUser/{deviceToken}', function ($deviceToken) {
    $factory = (new Factory)->withServiceAccount(__DIR__ . '\fcmtest-73a06-firebase-adminsdk-nafl1-ae84c5f43d.json');
    $messaging = $factory->createMessaging();
    $result = $messaging->unsubscribeFromAllTopics($deviceToken);
    var_dump($result);
});

Route::get('/unsubscribeUser/{deviceToken}/topic/{topic}', function ($deviceToken, $topic) {
    $factory = (new Factory)->withServiceAccount(__DIR__ . '\fcmtest-73a06-firebase-adminsdk-nafl1-ae84c5f43d.json');
    $messaging = $factory->createMessaging();
    $result = $messaging->unsubscribeFromTopic($topic, $deviceToken);
//    $result = $messaging->unsubscribeFromTopics($topics, $registrationTokenOrTokens);
    var_dump($result);
});
