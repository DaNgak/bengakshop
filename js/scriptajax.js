const buttonclose = document.getElementById("close-button");
const buttonaddfavorit = document.getElementById("buttonfavorit");
const buttonaddlist = document.getElementById("buttonlist");
const buttonaddcart = document.getElementById("buttoncart");
const productclick = document.querySelectorAll("#productclick");
const containershowproduct = document.getElementById("productview");
const inputsearchproduct = document.getElementById("inputsearchproduct");
const popup = document.getElementById("buyingpopup");

function kembalidaripopup() {
    popup.classList.add("d-none");
}

// buttonaddlist.addEventListener("click", function () {
//     alert("Berhasil ditambahkan ke List");
// });

// buttonaddfavorit.addEventListener("click", function () {
//     alert("Berhasil ditambahkan ke Favorit");
// });

// buttonaddcart.addEventListener("click", function () {
//     alert("Berhasil ditambahkan ke Cart");
// });

console.log("ok");
console.log(`id_barang = ${valuedatabarang.value}, username=${valuedatauserpembeli.value}`);
for (let index = 0; index < productclick.length; index++) {
    console.log(index);
}

productclick.forEach((product) => {
    product.addEventListener("click", function () {
        popup.classList.remove("d-none");
        const valuedatabarang = document.getElementById("valuedatabarang");
        const valuedatauserpembeli = document.getElementById("valuedatauserpembeli");
        console.log(`id_barang = ${valuedatabarang.value}, username=${valuedatauserpembeli.value}`);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                popup.innerHTML = xhr.responseText;
            }
        };
        xhr.open("GET", "ajax/databarang.php?id_barang=" + valuedatabarang.value + "&username=" + valuedatauserpembeli.value, true);
        xhr.send();

        // let xhr = new XMLHttpRequest();
        // xhr.onreadystatechange = function () {
        //     if (xhr.readyState == 4 && xhr.status == 200) {
        //         // Didalam pengkondisian jika ajaxnya ready maka ubah apa yang ada didalam container dengan response ajaxnya
        //         // popup.innerHTML = xhr.responseText;
        //         console.log("hello");
        //     }
        // };
        // xhr.open("GET", "ajax/databarang.php", true);
        // xhr.send();
    });
});

inputsearchproduct.addEventListener("keyup", function () {
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            containershowproduct.innerHTML = xhr.responseText;
        }
    };

    xhr.open("GET", "ajax/tampilcaridatabarang.php?keywoarddatacari=" + inputsearchproduct.value, true);
    xhr.send();
});
