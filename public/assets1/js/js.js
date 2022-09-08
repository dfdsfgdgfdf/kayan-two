document.getElementById("btnPrint").onclick = function () {
    printElement(document.getElementById("printThis"));
}

function printElement(elem) {
    var domClone = elem.cloneNode(true);

    var $printSection = document.getElementById("printSection");

    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }

    $printSection.innerHTML = "";
    $printSection.appendChild(domClone);
    window.print();
}

window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer",
        {
            theme: "light2",
            title: {
                text: "Report Chart"
            },
            data: [
                {
                    type: "pie",
                    showInLegend: true,
                    toolTipContent: "{y} - #percent %",
                    yValueFormatString: "#,##0,,.## Million",
                    legendText: "{indexLabel}",
                    dataPoints: [
                        { y: 4181563, indexLabel: "New " },
                        { y: 2175498, indexLabel: "Recovered" },
                        { y: 3125844, indexLabel: "Treatment" },
                        // {  y: 1176121, indexLabel: "Nintendo DS"},
                        // {  y: 1727161, indexLabel: "PSP" },
                        // {  y: 4303364, indexLabel: "Nintendo 3DS"},
                        // {  y: 1717786, indexLabel: "PS Vita"}
                    ]
                }
            ]
        });
    chart.render();
}

//   bar
window.onload = function () {

    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,

        title: {
            text: "Report Bar Chart"
        },
        axisX: {
            interval: 1
        },
        axisY2: {
            interlacedColor: "rgba(1,77,101,.2)",
            gridColor: "rgba(1,77,101,.1)",
            title: "Bar Chart"
        },
        data: [{
            type: "bar",
            name: "companies",
            axisYType: "secondary",
            color: "#014D65",
            dataPoints: [

                { y: 15, label: "Recovered" },
                { y: 12, label: "Recovered" },
                { y: 70, label: "Recovered" },
                { y: 25, label: "Treatment" },
                { y: 28, label: "Treatment" },
                { y: 29, label: "Treatment" },
                { y: 52, label: "NEW" },
                { y: 103, label: "NEW" },
                { y: 134, label: "NEW" }
            ]
        }]
    });
    chart.render();

}