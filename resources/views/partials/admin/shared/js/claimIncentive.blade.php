<script>
    function printPage() {
        var div1 = document.getElementById('appTabContent');
        var newWin = window.open('', 'Print-Window');

        newWin.document.open();
        newWin.document.write('<html><head><title></title>');
            newWin.document.write('<link href="{{ asset("css/app.css") }}" rel="stylesheet">');
            newWin.document.write('<link href="{{ asset("css/app/preview.css") }}" rel="stylesheet">');
            newWin.document.write(
                '<style>@media print { .pagebreak { clear: both; page-break-before: always; }}</style>');
            newWin.document.write('</head><body onload="window.print()">');
        // newWin.document.write('<h2 class="text-center">Claim Preview Generated On '+time+'</h2>');
        newWin.document.write(div1.innerHTML);
        newWin.document.close();
    };
</script>

