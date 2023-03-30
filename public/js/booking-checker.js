let xhr = new XMLHttpRequest();

setInterval(() => {
    xhr.open('GET', '/booking-check');
    xhr.send();

    xhr.onreadystatechange = function() {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            console.log(xhr.responseText);
        }
    }
}, 5000); // every 5 seconds check expired booking
