<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codebar Generator</title>
    <link rel="stylesheet" href="style1.css">

    <!-- code bar link library -->
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>

    <!-- pdf link library -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body>
    <section>
        <h4>Générateur de Code-barres</h4>
        <div class="search_bar">
            <input type="text" placeholder="Entrer un texte..." id="text">
            <button id="button_code_bar">Générer</button>
        </div>
        <div id="box">
            <img src="barcode.png" alt="code bar">
        </div>
        <div id="pdf_box"></div>
    </section>
    <script src="script.js"></script>
</body>
</html>