const containerdatapengiriman = document.getElementById("containerdatapengiriman");
const inputcaridatapengiriman = document.getElementById("inputcaridatapengiriman");

const containerdatabarang = document.getElementById("containerdatabarang");
const inputcaridatabarang = document.getElementById("inputcaridatabarang");

const containerdatatransaksi = document.getElementById("containerdatatransaksi");
const inputcaridatatransaksi = document.getElementById("inputcaridatatransaksi");

const containerdatapembayaran = document.getElementById("containerdatapembayaran");
const inputcaridatapembayaran = document.getElementById("inputcaridatapembayaran");

const inputcaridatapembeli = document.getElementById("inputcaridatapembeli");
const containerdatapembeli = document.getElementById("containerdatapembeli");

const inputcaridatapenjual = document.getElementById("inputcaridatapenjual");
const containerdatapenjual = document.getElementById("containerdatapenjual");

const inputdatasatuanbarang = document.getElementById("inputdatasatuanbarang");
const containerdatasatuanbarang = document.getElementById("containerdatasatuanbarang");

const inputdatajenisbarang = document.getElementById("inputdatajenisbarang");
const containerdatajenisbarang = document.getElementById("containerdatajenisbarang");

inputcaridatapembeli.addEventListener("keyup", function () {
    const xhr1 = new XMLHttpRequest();
    xhr1.onreadystatechange = function () {
        if (xhr1.readyState == 4 && xhr1.status == 200) {
            containerdatapembeli.innerHTML = xhr1.responseText;
        }
    };

    xhr1.open("GET", "../ajax/admin/datapembeliadmin.php?keywordcaridatapembeli=" + inputcaridatapembeli.value, true);

    xhr1.send();
});

inputcaridatapenjual.addEventListener("keyup", function () {
    const xhr2 = new XMLHttpRequest();
    xhr2.onreadystatechange = function () {
        if (xhr2.readyState == 4 && xhr2.status == 200) {
            containerdatapenjual.innerHTML = xhr2.responseText;
        }
    };

    xhr2.open("GET", "../ajax/admin/datapenjualadmin.php?keywordcaridatapenjual=" + inputcaridatapenjual.value, true);

    xhr2.send();
});

inputcaridatapembayaran.addEventListener("keyup", function () {
    const xhr3 = new XMLHttpRequest();
    xhr3.onreadystatechange = function () {
        if (xhr3.readyState == 4 && xhr3.status == 200) {
            containerdatapembayaran.innerHTML = xhr3.responseText;
        }
    };

    xhr3.open("GET", "../ajax/admin/datapembayaranadmin.php?keywordcaridatapembayaran=" + inputcaridatapembayaran.value, true);

    xhr3.send();
});

inputcaridatapengiriman.addEventListener("keyup", function () {
    const xhr4 = new XMLHttpRequest();
    xhr4.onreadystatechange = function () {
        if (xhr4.readyState == 4 && xhr4.status == 200) {
            containerdatapengiriman.innerHTML = xhr4.responseText;
        }
    };

    xhr4.open("GET", "../ajax/admin/datapengirimanadmin.php?keywordcaridatapengiriman=" + inputcaridatapengiriman.value, true);

    xhr4.send();
});

inputdatasatuanbarang.addEventListener("keyup", function () {
    const xhr5 = new XMLHttpRequest();
    xhr5.onreadystatechange = function () {
        if (xhr5.readyState == 4 && xhr5.status == 200) {
            containerdatasatuanbarang.innerHTML = xhr5.responseText;
        }
    };

    xhr5.open("GET", "../ajax/admin/datasatuanbarangadmin.php?keywordcaridatasatuan=" + inputdatasatuanbarang.value, true);

    xhr5.send();
});

inputdatajenisbarang.addEventListener("keyup", function () {
    const xhr6 = new XMLHttpRequest();
    xhr6.onreadystatechange = function () {
        if (xhr6.readyState == 4 && xhr6.status == 200) {
            containerdatajenisbarang.innerHTML = xhr6.responseText;
        }
    };

    xhr6.open("GET", "../ajax/admin/datajenisbarangadmin.php?keywordcaridatajenisbarang=" + inputdatajenisbarang.value, true);

    xhr6.send();
});

inputcaridatabarang.addEventListener("keyup", function () {
    const xhr7 = new XMLHttpRequest();
    console.log(inputcaridatabarang.value);
    xhr7.onreadystatechange = function () {
        if (xhr7.readyState == 4 && xhr7.status == 200) {
            containerdatabarang.innerHTML = xhr7.responseText;
        }
    };

    xhr7.open("GET", "../ajax/admin/databarangadmin.php?keywordcaridatabarang=" + inputcaridatabarang.value, true);

    xhr7.send();
});
