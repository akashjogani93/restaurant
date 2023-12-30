class pdfMake
{
    generate(headers,labe,save,coloumSty)
    {
        var fdate=$('#fdate').val();
        var tdate=$('#tdate').val();
        var y = 20;
        var doc = new jsPDF({
            unit: 'pt',
            format: 'A4',
            putOnlyUsedFonts: true,
            orientation: 'p',
            margin: 0,
        });
        doc.setLineWidth(2);
        doc.text(150, y = y + 10, labe+fdate+" To "+tdate);
        doc.autoTable({
            margin: {top: 40, left: 10, right: 10, bottom: 20},
            html: '#example1',
            theme: 'grid',
            columns:headers,
            styles: {
                overflow: 'linebreak',
                lineWidth: 1,
                fontSize: 7,
                cellPadding: {horizontal: 4, vertical: 2},
                textColor: [0, 0, 0],
            },
            headerStyles: {
                fillColor: [128, 128, 128],
                textColor: [255, 255, 255],
                fontSize: 8,
                lineWidth: 1,
            },
            footStyles: {
                fontSize: 8,
                fillColor: [128, 128, 128],
                textColor: [255, 255, 255],
                lineWidth: 1,
            },
            columnStyles:coloumSty
        })
        doc.save(save);
    }
}