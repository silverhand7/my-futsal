// let xhr = new XMLHttpRequest();

setInterval(() => {
    xhr.open('GET', '/notification-check');
    xhr.send();

    xhr.onreadystatechange = function() {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            const response = JSON.parse(xhr.responseText);
            if (response.count != 0) {
                document.querySelectorAll('#notification-dropdown a')[0].classList.add('notification-dot');
            }

            let html = '';
            for (let i = 0; i < response.data.length; i++) {
                html += `<div id="${response.data[i].id}" class="px-2 notification-item">
                    <a href="${response.data[i].actionUrl}">
                        <div>${response.data[i].message}</div>
                    </a>
                </div>
                <hr>`
                if (document.getElementById(response.data[i].id) == null) {
                    document.querySelector('#notification-dropdown ul').insertAdjacentHTML('afterbegin', html);
                }
            }
            // console.log('New Notification ' + response.count);
        }
    }
}, 2000); // every 2 seconds check new notification
