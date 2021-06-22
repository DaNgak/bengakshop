const buttonclose = document.getElementById("close-button");
const popup = document.getElementById("buying-popup");
const buttonaddfavorit = document.getElementById("buttonfavorit");
const buttonaddlist = document.getElementById("buttonlist");
const buttonaddcart = document.getElementById("buttoncart");
const productclick = document.querySelectorAll("#product-click");

buttonclose.addEventListener("click", function () {
    popup.classList.add("d-none");
});

buttonaddlist.addEventListener("click", function () {
    alert("Berhasil ditambahkan ke List");
});

buttonaddfavorit.addEventListener("click", function () {
    alert("Berhasil ditambahkan ke Favorit");
});

buttonaddcart.addEventListener("click", function () {
    alert("Berhasil ditambahkan ke Cart");
});

console.log("ok");

productclick.forEach((product) => {
    product.addEventListener("click", function () {
        popup.classList.toggle("d-none");
        // const xhr = new XMLHttpRequest();
        // xhr.onreadystatechange = function () {
        //     if (xhr.readyState == 4 && xhr.status == 200) {
        //         console.log(xhr.responseText);
        //         alert("Ajax ok");
        //     }
        // };
        // xhr.open("GET", "ajax/databarang.txt", true);
        // xhr.send();
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Didalam pengkondisian jika ajaxnya ready maka ubah apa yang ada didalam container dengan response ajaxnya
                // popup.innerHTML = xhr.responseText;
                console.log("hello");
            }
        };
        xhr.open("GET", "ajax/databarang.php", true);
        xhr.send();
    });
});
