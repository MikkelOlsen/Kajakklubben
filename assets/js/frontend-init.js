var lightbox = new Lightbox();
lightbox.load();


document.getElementById('newsletter').addEventListener('submit', (elm) => {
    elm.preventDefault();
    const baseURL = document.getElementById('baseURL').getAttribute('href');
    const email = document.getElementById('newsletterEmail').value;
    fetch(baseURL + 'Api/Newsletter/' + email, {method: 'GET', body: undefined})
        .then( (res) => {
            return res.json()
        })
        .then( (data) => {
            if(!data.err)
            {
                console.log(data)
                document.getElementById('newsletter').innerHTML = '<p>Tak for din tilmelding.</p>';
            } else 
            {
                document.getElementById('newsletterEmail').style.color = 'red'
                document.getElementById('newsletterEmail').value = data.msg
                console.warn(data)
            }
        })
        .catch( (err) => {
            console.warn(err)
        })

})
