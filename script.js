var button_code_bar = document.getElementById('button_code_bar');
var text = document.getElementById('text');
var box = document.getElementById('box');
var pdf_box = document.getElementById('pdf_box');

button_code_bar.onclick = function(){
  if(text.value.length > 0){  // Check if text field is not empty
    if(text.value.length < 50){  // Check if text length is less than 50 characters
      // Generate barcode
      box.innerHTML = "<svg id='barcode'></svg>";  // Create an SVG element for the barcode
      JsBarcode("#barcode", text.value);            // Use JsBarcode library to generate the barcode
      box.style.border='1px solid #999';            // Add a border to the barcode container
      // Create download button
      pdf_box.innerHTML ="<button onclick='genererPDF()'>Télécharger le code à barre</button>";  // Create a button with text "Download Barcode" (French) and click event handler
      pdf_box.style.marginTop="10px";               // Add margin-top to the download button container
      pdf_box.style.display="flex";                // Set display style to "flex" for potential layout adjustments
    } else {
      box.style.border ="0";                     // Remove border if text is too long
      box.innerHTML="<p class='error'> Le texte est trop long !</p>";  // Display error message (French: "The text is too long!")
      pdf_box.style.display ="none";             // Hide the download button container
    }
  } else {
    box.style.border ="0";                     // Remove border if text field is empty
    box.innerHTML="<p class='error'>Remplissez le champ !</p>";  // Display error message (French: "Fill the field!")
    pdf_box.style.display ="none";             // Hide the download button container
  }
  
}

//generer le pdf
function genererPDF(){
    var opt = {
      margin:       1,
      filename:     `${text.value}.pdf`,
      image:        { type: 'jpeg', quality: 0.98 },
      html2canvas:  { scale: 2 },
      jsPDF:        { unit: 'in', format: 'a6', orientation: 'l' }
    };
    
    // New Promise-based usage:
    html2pdf().set(opt).from(box).save();
    
    
}
