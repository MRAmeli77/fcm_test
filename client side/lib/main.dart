import 'dart:async';

import 'package:flutter/material.dart';

import 'fcm.dart';

Future<void> main() async {
  WidgetsFlutterBinding.ensureInitialized();
  Firebase.initializeApp();

  runApp(MyApp());

  firebaseMessaging.configure(
    onMessage: (Map<String, dynamic> message) async {
      print("onMessage: $message");
    },
    onBackgroundMessage: myBackgroundMessageHandler,
    onLaunch: (Map<String, dynamic> message) async {
      print("onLaunch: $message");
    },
    onResume: (Map<String, dynamic> message) async {
      print("onResume: $message");
    },
  );
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Firebase Analytics Demo',
      theme: ThemeData(
        primarySwatch: Colors.blue,
      ),
      home: MyHomePage2(),
    );
  }
}

class MyHomePage2 extends StatefulWidget {
  MyHomePage2({Key key}) : super(key: key);

  @override
  _MyHomePage2State createState() => _MyHomePage2State();
}

class _MyHomePage2State extends State<MyHomePage2> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
        appBar: AppBar(
          title: Text("Firebase Messaing"),
        ),
        body: Column(
          children: [
            Container(
          child: FlatButton(
                  onPressed: () async {
                    print('*********************** Token********************');
                FirebaseMessaging().getToken().then(print);
              },
              child: Text("Print token")),
            ),
            Container(
              child: FlatButton(
                  onPressed: sendAndRetrieveMessage,
                  child: Text("send And Retrieve Message ")),
            ),
          ],
        ));
  }
}
