// assets/js/barcode.js
document.addEventListener("DOMContentLoaded", () => {
    Quagga.init({
        inputStream: {
            type: "LiveStream",
            target: document.querySelector("#camera") // div où la caméra s’affiche
        },
        decoder: {
            readers: ["ean_reader", "code_128_reader"] // types de codes-barres
        }
    }, err => {
        if (err) { console.error(err); return; }
        Quagga.start();
    });

    Quagga.onDetected(result => {
        let code = result.codeResult.code;
        console.log("Code-barres détecté:", code);

        // Envoi au serveur PHP
        fetch("modules/produits.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ code_barre: code })
        })
        .then(res => res.json())
        .then(data => {
            if (data.existe) {
                alert("Produit trouvé: " + data.nom + " - Prix: " + data.prix_unitaire);
            } else {
                // Afficher formulaire pour nouvel enregistrement
                document.querySelector("#formProduit").style.display = "block";
                document.querySelector("#code_barre").value = code;
                //
            }
        });
    });
});
// 