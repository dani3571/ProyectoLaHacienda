import './bootstrap';

import * as bootstrap from 'bootstrap'

import "@fortawesome/fontawesome-free/css/all.css";

window.$ = require('jquery');

let Chart = require("chart.js/dist/chart");
window.Chart = Chart;

$(".chart").each(function () {
    let type = $(this).data("type");
    let labels = $(this).data("labels");
    let series = $(this).data("series");
    let bgColor = $(this).data("bg-color");
    let borderColor = $(this).data("border-color");
    let color = $(this).data("color");
    let options = $(this).data("options");
    let ctx = this.getContext("2d");

    new Chart(ctx, {
        type: type,
        data: {
            labels: labels,
            datasets: [
                {
                    data: series,
                    color: color,
                    backgroundColor: bgColor,
                    borderColor: borderColor,
                },
            ],
        },
        options: options,
    });
});