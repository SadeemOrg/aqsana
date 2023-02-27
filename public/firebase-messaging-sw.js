// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({
    apiKey: "AIzaSyA4a_fkjeIEDYd_avYYZ_XbqwLIhtd6HCQ",
    authDomain: "alqudsquds-82c73.firebaseapp.com",
    databaseURL: 'https://project-id.firebaseio.com',
    projectId: "alqudsquds-82c73",
    storageBucket: "alqudsquds-82c73.appspot.com",
    messagingSenderId: "168567225793",
    appId: "1:168567225793:web:417c87aa992aa0784d4340",
    measurementId: "G-HH0SH5P3KT"
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log("Message received.", payload);
    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png",
    };
    return self.registration.showNotification(
        title,
        options,
    );
});
