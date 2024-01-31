// Laadige tellimuste nimekiri
window.addEventListener('DOMContentLoaded', (event) => {
    laeNimekiri();
});

function laeNimekiri() {
    fetch('lae_nimekiri.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Päring ebaõnnestus');
        }
        return response.json();
    })
    .then(data => {
        // Käsitle saadud andmeid
        console.log(data);
    })
    .catch(error => {
        console.error('Viga:', error);
    });
}
