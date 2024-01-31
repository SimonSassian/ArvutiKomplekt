function komplekteeriTellimus(tellimusId) {
    fetch('komplekteeri_tellimus.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            tellimusId: tellimusId
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Päring ebaõnnestus');
        }
        return response.json();
    })
    .then(data => {
        console.log(data); // Käsitse serverilt saadud vastust
        // Võite siin teha vajalikud tegevused vastusega
    })
    .catch(error => {
        console.error('Viga:', error);
    });

}
