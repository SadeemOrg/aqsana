<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TestNotfiy</title>

    <!-- firebase integration started -->

<!-- Firebase App is always required and must be first -->
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>

<!-- Add additional services that you want to use -->
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-functions.js"></script>

<!-- firebase integration end -->

<!-- Comment out (or don't include) services that you don't want to use -->


<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-analytics.js"></script>
</head>
<body>

  <a href="{{route('sendNotfiy')}}">Send Notification Testing</a>
    
<h1>owais</h1>
</body>

<script>

  console.log("owais");
  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyCUFf82RK4_UHpnJ2EAD1eXgz2tIIBoFaE",
    authDomain: "alaqsa-association.firebaseapp.com",
    projectId: "alaqsa-association",
    storageBucket: "alaqsa-association.appspot.com",
    messagingSenderId: "16943275285",
    appId: "1:16943275285:web:c95070543cf570cb265d1c",
    measurementId: "G-FHN8R2KH3M"
  };
firebase.initializeApp(firebaseConfig);
//   firebase.initializeApp({
//     apiKey: "AIzaSyCUFf82RK4_UHpnJ2EAD1eXgz2tIIBoFaE",
//     authDomain: "alaqsa-association.firebaseapp.com",
//     projectId: "alaqsa-association",
//     storageBucket: "alaqsa-association.appspot.com",
//     messagingSenderId: "16943275285",
//     appId: "1:16943275285:web:c95070543cf570cb265d1c",
//     measurementId: "G-FHN8R2KH3M"
//     });
 

  const messaging = firebase.messaging();


	messaging.requestPermission()
.then(function () {
//MsgElem.innerHTML = "Notification permission granted." 
	console.log("Notification permission granted.");

     // get the token in the form of promise
	return messaging.getToken()
})
.then(function(token) {
 // print the token on the HTML page     
  console.log(token);
  
  
  
})
.catch(function (err) {
	console.log("Unable to get permission to notify.", err);
});

messaging.onMessage(function(payload) {
    console.log(payload);
    var notify;
    notify = new Notification(payload.notification.title,{
        body: payload.notification.body,
        icon: payload.notification.icon,
        tag: "Dummy"
    });
    console.log(payload.notification);
});

    //firebase.initializeApp(config);
// var database = firebase.database().ref().child("/users/");
   
// database.on('value', function(snapshot) {
//     renderUI(snapshot.val());
// });

// // On child added to db
// database.on('child_added', function(data) {
// 	console.log("Comming");
//     if(Notification.permission!=='default'){
//         var notify;
         
//         notify= new Notification('CodeWife - '+data.val().username,{
//             'body': data.val().message,
//             'icon': 'bell.png',
//             'tag': data.getKey()
//         });
//         notify.onclick = function(){
//             alert(this.tag);
//         }
//     }else{
//         alert('Please allow the notification first');
//     }
// });

// self.addEventListener('notificationclick', function(event) {       
//     event.notification.close();
// });

// messaging.setBackgroundMessageHandler(function(payload) {
//   console.log('[firebase-messaging-sw.js] Received background message ', payload);
//   // Customize notification here
//   const notificationTitle = 'Background Message Title';
//   const notificationOptions = {
//     body: 'Background Message body.',
//     icon: 'https://images.theconversation.com/files/93616/original/image-20150902-6700-t2axrz.jpg' //your logo here
//   };

//   return self.registration.showNotification(notificationTitle,
//       notificationOptions);
// });
</script>
</html>