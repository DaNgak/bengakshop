const containerdatapengiriman = document.getElementById("containerdatapengiriman");
const containerdatapembayaran = document.getElementById("containerdatapembayaran");
const containerdatabarang = document.getElementById("containerdatabarang");
const containerdatatransaksi = document.getElementById("containerdatatransaksi");
const inputcaridatatransaksi = document.getElementById("inputcaridatatransaksi");
const inputcaridatapembayaran = document.getElementById("inputcaridatapembayaran");
const inputcaridatabarang = document.getElementById("inputcaridatabarang");
const inputcaridatapengiriman = document.getElementById("inputcaridatapengiriman");

inputcaridatabarang.addEventListener("keyup", function () {
    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // containerdatabarang.innerHTML = xhr.responseText;
            // console.log(inputcaridatabarang.value);
        }
    };

    xhr.open("GET", "../ajax/datatransaksipenjual.php?keywordcaridatabarang=" + inputcaridatabarang.value, true);

    xhr.send();
});

inputcaridatatransaksi.addEventListener("keyup", function () {
    const xhr1 = new XMLHttpRequest();
    xhr1.onreadystatechange = function () {
        if (xhr1.readyState == 4 && xhr1.status == 200) {
            alert("Ajax transaksi ok");
        }
    };

    xhr1.open("GET", "../ajax/datatransaksipenjual.php", true);

    xhr1.send();
});

inputcaridatapembayaran.addEventListener("keyup", function () {
    const xhr2 = new XMLHttpRequest();
    xhr2.onreadystatechange = function () {
        if (xhr2.readyState == 4 && xhr2.status == 200) {
            containerdatapembayaran.innerHTML = xhr2.responseText;
        }
    };

    xhr2.open("GET", "../ajax/datapembayaranpenjual.php?keywordcaridatapembayaran=" + inputcaridatapembayaran.value, true);

    xhr2.send();
});

inputcaridatapengiriman.addEventListener("keyup", function () {
    const xhr3 = new XMLHttpRequest();
    xhr3.onreadystatechange = function () {
        if (xhr3.readyState == 4 && xhr3.status == 200) {
            containerdatapengiriman.innerHTML = xhr3.responseText;
        }
    };

    xhr3.open("GET", "../ajax/datapengirimanpenjual.php?keywordcaridatapemngiriman=" + inputcaridatapengiriman.value, true);

    xhr3.send();
});
