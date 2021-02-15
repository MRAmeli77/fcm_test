import 'dart:convert';

import 'package:http/http.dart' as http;

import 'package:firebase_messaging/firebase_messaging.dart';

import 'notification.dart';

export 'package:firebase_core/firebase_core.dart';
export 'package:firebase_messaging/firebase_messaging.dart';


Future<dynamic> myBackgroundMessageHandler(Map<String, dynamic> message) async {
  await initializeNotification();

  if (message.containsKey('data')) {
    // Handle data message
    final dynamic data = message['data'];
    print('************** Background Message Data *****************');
    print(data);
    showNotification('background Data', '$data');
  }

  if (message.containsKey('notification')) {
    // Handle notification message
    final dynamic notification = message['notification'];
    print('************** Background Message Notification *****************');
    print(notification);
    showNotification('background Notification', '$notification');
  }

  // Or do other work.
}

// Replace with server token from firebase console settings.
final String serverToken =
    'AAAArqUZvFM:APA91bGvECqIxSLmviy_YQuxG_BO1pbitJ_U4FuTdWTnDsEDrf3cYfxXVaV2mLvM8Yx-cOYFZEpvjCRx40ThSLkNG-acaQvj7COGc5fhJFqU9SwCW2BYHuFm4dNYNOWQEzkkKLe0GZ_r';
// '<Server-Token>';
final FirebaseMessaging firebaseMessaging = FirebaseMessaging();

Future<Map<String, dynamic>> sendAndRetrieveMessage() async {
  await firebaseMessaging.requestNotificationPermissions(
    const IosNotificationSettings(
        sound: true, badge: true, alert: true, provisional: false),
  );

  await http.post(
    'https://fcm.googleapis.com/fcm/send',
    headers: <String, String>{
      'Content-Type': 'application/json',
      'Authorization': 'key=$serverToken',
    },
    body: jsonEncode(
      <String, dynamic>{
        'notification': <String, dynamic>{
          'body': 'this is a body',
          'title': 'this is a title'
        },
        'priority': 'high',
        'data': <String, dynamic>{
          'click_action': 'FLUTTER_NOTIFICATION_CLICK',
          'id': '1',
          'status': 'done'
        },
        'to': await firebaseMessaging.getToken(),
      },
    ),
  );
  return null;
  // final Completer<Map<String, dynamic>> completer =
  //     Completer<Map<String, dynamic>>();

  // return completer.future;
}
