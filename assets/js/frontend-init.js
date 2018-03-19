var lightbox = new Lightbox();
lightbox.load();

var elementExists = document.getElementById('newsletter');

if(elementExists !== null)
{
elementExists.addEventListener('submit', (elm) => {
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
}


document.querySelectorAll('.eventSub').forEach( (elm) => {
	elm.addEventListener('click', (e) => {
		e.preventDefault();
        const baseURL = document.getElementById('baseURL').getAttribute('href');
        var attr = elm.getAttribute('href');

		fetch(baseURL + 'Api/Event/' + attr, {method: 'GET', body: undefined})
			.then( (res) => {
				return res.json()
			})
			.then( (data) => {
				if(!data.err)
				{
                    elm.parentElement.innerHTML = '<p style="color:green;">Du er nu tilmeldt denne begivenhed.</p>';
                }
			})
			.catch( (err) => {
				console.warn('Fejl i fetch! -> ', err)
			})
	});
});

document.querySelectorAll('.eventNoSub').forEach( (elm) => {
	elm.addEventListener('click', (e) => {
		e.preventDefault();
        const baseURL = document.getElementById('baseURL').getAttribute('href');
        var attr = elm.getAttribute('href');

		fetch(baseURL + 'Api/EventDelete/' + attr, {method: 'GET', body: undefined})
			.then( (res) => {
				return res.json()
			})
			.then( (data) => {
				if(!data.err)
				{
                    elm.parentElement.innerHTML = '<p style="color:yellow;">Du er nu afmeldt denne begivenhed.</p>';
                }
			})
			.catch( (err) => {
				console.warn('Fejl i fetch! -> ', err)
			})
	});
});