$(function() {
    "use strict";
    var barData;
    var ctxL = document.getElementById("line-chart").getContext("2d");
    $.ajax({
        url : 'dashboard/brands',
        beforeSend: function () {
            ctxL.fillStyle = "#ccc";
            ctxL.font="100 22px Calibri";
            ctxL.fillText("Carregando...",100,50);
        }
    }).done(function(response){
        ctxL.clearRect(0, 0, document.getElementById("line-chart").width, 
                             document.getElementById("line-chart").height);
        try{
            response = JSON.parse(response);
            if(response.label){
                barData = {
                    labels: response.label,
                    datasets: [
                        {
                            label: "Histórico de pedidos",
                            fillColor: "rgba(151,187,205,0.5)",
                            strokeColor: "rgba(151,187,205,0.8)",
                            highlightFill: "rgba(151,187,205,0.75)",
                            highlightStroke: "rgba(151,187,205,1)",
                            data: response.data
                        }
                    ]

                };
                window.myLine = new Chart(ctxL).Bar(barData, {
                    responsive: true
                });
            } else {
                ctxL.fillStyle = "#ccc";
                ctxL.font="100 22px Calibri";
                ctxL.fillText("Não há dados diponíveis.",20,50);
            }
            
        } catch (e){
            alert('Desculpe, houve um erro ao carregar gráfico');
        }
    });
    
    var ctx = document.getElementById("chart-area").getContext("2d");
    $.ajax({
        url : 'dashboard/types',
        beforeSend: function () {
            ctx.fillStyle = "#ccc";
            ctx.font="100 22px Calibri";
            ctx.fillText("Carregando...",100,50);
        }
    }).done(function(response){
        ctx.clearRect(0, 0, document.getElementById("chart-area").width, 
                            document.getElementById("chart-area").height);
        try{
            response = JSON.parse(response);
            
            if(response.length){
                var options = {
                    tooltipTemplate: "<%if (label){%><%=label %>: <%}%><%= value + ' %' %>"
                };
                window.myPie = new Chart(ctx).Pie(response,options);
            } else {
                ctx.fillStyle = "#ccc";
                ctx.font="100 22px Calibri";
                ctx.fillText("Não há dados diponíveis.",20,50);
            }
            
        } catch (e){
            alert('Desculpe, houve um erro ao carregar gráfico');
        }
    });

});