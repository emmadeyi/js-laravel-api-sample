// const http = new EasyHTTP;

// http.get('http://127.0.0.1:8000/api/contacts')
//     .then(data => console.log(data))
//     .catch(err => console.error(err));

// async get(url) {
//     const response = await fetch(url);
//     const resData = await response.json();
//     return resData;
// }

const contacts = fetch('http://127.0.0.1:8000/api/contacts');
console.log(contacts.then(data));
