import 'dart:async';

import 'package:firebase_core/firebase_core.dart';
import 'package:flutter/material.dart';
import 'package:firebase_messaging/firebase_messaging.dart';

Future<void> main() async {
  WidgetsFlutterBinding.ensureInitialized();
  await Firebase.initializeApp();
  runApp(MyApp());
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
  FirebaseMessaging _fcm = FirebaseMessaging();
  String token = 'none';
  String messageText = 'none';

  @override
  void initState() {
    super.initState();
    _fcm.configure(onMessage: (message) async {
      setState(() {
        messageText = message["data"]["title"];
      });
    }, onResume: (message) async {
      setState(() {
        messageText = message["data"]["title"];
      });
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Firebase Message"),
      ),
      body: Center(
        child: Column(children: [
          FlatButton(
            onPressed: () {
              setState(() {
                _fcm.getToken().then((value) {
                  token = value;
                  print(value);
                });
              });
            },
            child: Text("refresh"),
            color: Colors.cyan,
          ),
          Text("token:  \n" + token + "\n"),
          Text("\nMessage: \n" + messageText)
        ]),
      ),
    );
  }
}
