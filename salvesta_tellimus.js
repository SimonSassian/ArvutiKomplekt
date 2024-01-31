// Salvesta tellimus
document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault();

    let kirjeldus = document.getElementById('kirjeldus').value;
    let korpus = document.getElementById('korpus').value;
    let kuvar = document.getElementById('kuvar').value;

    fetch('salvesta_tellimus.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            kirjeldus: kirjeldus,
            korpus: korpus,
            kuvar: kuvar
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
})

    .catch(error => {
        console.error('Viga:', error);
    });


});
