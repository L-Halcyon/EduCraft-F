document.getElementById('descargar').addEventListener('click', function () {

    const diploma = document.getElementById('diploma');

   
    const opciones = {
        margin: [0.5, 0.5, 0.5, 0.5], 
        filename: 'diploma_educraft.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2, letterRendering: true },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'landscape' } 
    };

 
    html2pdf().set(opciones).from(diploma).save();
});
