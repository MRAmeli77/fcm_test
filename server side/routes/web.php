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

Route::get('/', function () {
    $deviceToken = "e6jomCy4SZSm8eggAVlfu7:APA91bHmWEX3A1q7H6hGBLuX6_PwIQYYqJe3WXmK6xwZkW5gWJZIdXnZLnkmcmYtzonXVtzIRr5mfr7MpnsuuhVhOJ3O4VeseXzRoH3B2SvfGjteg-n2SC3iHwATPFunYazAVkGG-0qG";
    $factory = (new Factory)->withServiceAccount(__DIR__ . '\..\fcmtest-73a06-firebase-adminsdk-nafl1-ae84c5f43d.json');
    $messaging = $factory->createMessaging();

    $message = CloudMessage::withTarget('token', $deviceToken)->withNotification(Notification::create('Title is title', 'Body is body2'))// optional
    ->withData(['title' => 'message testttttttttttttt']);
    $messaging->send($message);

    //    $url = 'https://fcm.googleapis.com/fcm/send';
//    $fields = array(
//        'registration_ids' => array(
//            $id
//        ),
//        'data' => array(
//            "message" => $message
//        )
//    );
//    $fields = json_encode($fields);
//    $headers = array(
//        'Authorization: key=' . "AAAANj7oQjM:APA91bF1AtV0sRajn3SsVNalTrjBlTFciejvJ8nZMtygAu7IBjUzsev8ovFi1687BmRXjRXUcgevjQ2G5k2I_QOeI7EoQWqWe2kHw7lXKz4tdpHG9gmlbBDdJeJdwl2aun7kmgFGc3L7",
//        'Content-Type: application/json'
//    );
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, $url);
//    curl_setopt($ch, CURLOPT_POST, true);
//    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
//    $result = curl_exec($ch);
//    echo $result;
//    curl_close($ch);
});
//Route::get('/tokenCheck/', function () {
//    $deviceToken = "fQ9GlswcQDeoVzBkSgF0S5:APA91bHBMZBSO8lifdlpwmFLjE1Z7f1XxBHp0k5rVRvrek51pmgDjOfpXAxTcLMqPWv-0xn7gAV6Dj6NRq1ifhEe7ATw5uRogQ-qpqtXYGcsx-xmKSL1qNbWH3p4Ndf-woi46KbvoYVG";
//    $deviceToken = "fQ9GlswcQDeoVzBkSgF0S5:APA91bHBMZBSO8lifdlpwmFLjE1Z7f1XxBHp0k5rVRvrek51pmgDjOfpXAxTcLMqPWv-0xn7gAV6Dj6NRq1ifhEe7ATw5uRogQ-qpqtXYGcsx-xmKSL1qNbWH3p4Ndf-woi46KbvoYVG";
//    $factory = (new Factory)->withServiceAccount(__DIR__.'\fcmtest-73a06-firebase-adminsdk-nafl1-ae84c5f43d.json');
//    $messaging = $factory->createMessaging();
//    $message = CloudMessage::withTarget('token', $deviceToken);
//    $message = CloudMessage::fromArray([
//        'token' => $deviceToken,
//        'notification' => Notification::create('Title is title', 'Body is not body') // optional
//    ]);
//
//    try {
//        $response = $messaging->send($message);
//        var_dump($response);
//    } catch (Exception $e) {
//        echo($e->getMessage());
//    }
//
//});
