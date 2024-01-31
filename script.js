// script.js

// Funktsioon tellimuse salvestamiseks
function salvestaTellimus() {
    var kirjeldus = document.getElementById("kirjeldus").value;
    var korpus = document.getElementById("korpus").value;
    var kuvar = document.getElementById("kuvar").value;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
            uuendaNimekirja();
        }
    };

    xhr.open("POST", "salvesta_tellimus.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("kirjeldus=" + kirjeldus + "&korpus=" + korpus + "&kuvar=" + kuvar);
}

// Funktsioon tellimuse komplekteerimiseks
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
    .then(response => response.json())
    .then(data => console.log(data))
    .catch(error => console.error('Viga:', error));
}

// Funktsioon tellimuse pakkimiseks
function pakiTellimus(tellimusId) {
    fetch('paki_tellimus.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            tellimusId: tellimusId
        })
    })
    .then(response => response.json())
    .then(data => console.log(data))
    .catch(error => console.error('Viga:', error));
}

// Funktsioon tellimuste nimekirja värskendamiseks
function uuendaNimekirja() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("tellimusteNimekiri").innerHTML = xhr.responseText;
        }
    };

    xhr.open("GET", "lae_nimekiri.php", true);
    xhr.send();
}
