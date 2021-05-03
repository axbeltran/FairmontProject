// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
var firebaseConfig = {
    apiKey: "AIzaSyD0unRAlqZ5kOMdZvB26p1dw0s5mRLoSDo",
    authDomain: "fairmont-test.firebaseapp.com",
    databaseURL: "https://fairmont-test-default-rtdb.firebaseio.com",
    projectId: "fairmont-test",
    storageBucket: "fairmont-test.appspot.com",
    messagingSenderId: "484558491",
    appId: "1:484558491:web:a043b1ca8d5928ea36683e",
    measurementId: "G-63FNB3RHE5"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);

function writeData() {

    firebase.database().ref("/Services/").push({
        firstName: document.getElementById("firstName").value,
        lastName: document.getElementById("lastName").value,
        subject: document.getElementById("subject").value,
        description: document.getElementById("serviceDescription").value
    });

    document.getElementById("serviceForm").reset();
}

function readData() {

    firebase.database().ref('/Services/').once('value', function (snapshot) {
        snapshot.forEach(function (childSnapshot) {

            var childData = childSnapshot.val();

            const containerElement = document.createElement('containerforum');

            // document.getElementById("title").innerHTML = childData['subject'];
            const subjectElement = document.createElement('h1');
            const subjectElementText = document.createTextNode("Service: " + childData['subject']);
            subjectElement.appendChild(subjectElementText);
            containerElement.appendChild(subjectElement);

            // document.getElementById("name").innerHTML = childData['firstName'] + " " + childData['lastName'];
            const nameElement = document.createElement('p');
            const nameElementText = document.createTextNode("Published by: " + childData['firstName'] + " " + childData['lastName']);
            nameElement.appendChild(nameElementText);
            containerElement.appendChild(nameElement);

            // document.getElementById("context").innerHTML = childData['description'];
            const contextElement = document.createElement('p');
            const contextElementText = document.createTextNode(childData['description']);
            contextElement.appendChild(contextElementText);
            containerElement.appendChild(contextElement);

            document.getElementById("forumContext").appendChild(containerElement);
        })
    })
}
readData();