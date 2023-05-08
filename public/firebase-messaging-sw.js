// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({
    apiKey: "AIzaSyCUFf82RK4_UHpnJ2EAD1eXgz2tIIBoFaE",
            authDomain: "alaqsa-association.firebaseapp.com",
            databaseURL: 'https://project-id.firebaseio.com',
            projectId: "alaqsa-association",
            storageBucket: "alaqsa-association.appspot.com",
            messagingSenderId: "16943275285",
            appId: "1:16943275285:web:c95070543cf570cb265d1c",
            measurementId: "G-FHN8R2KH3M"
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
