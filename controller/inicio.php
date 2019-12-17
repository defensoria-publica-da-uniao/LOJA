<?php
require_once 'controller.php';
class Inicio extends controller{
    
    function inicio(){
       return '<p align="center">Teste de chamada do método inicio.</p>';
    }
    
    function mapa() {
        //Estagiarios Ativos
        //$est_ativos = $this->ativos();
        //$Locais = $this->geraLista($est_ativos, 'sigla');
        //$Qtd = $this->geraLista($est_ativos, 'qtde');
        //$maior_valor = max(array_column($est_ativos, 'qtde'));
        //$menor_valor = '0';
        //Vagas Abertas
        $Locais = 'SP-RJ-CE-MT-AC-GO';
        $Qtd = '5-10-1-5-7-6';
        $maior_valor = '10';
        $menor_valor = '1';
        ?>
        <!-- Styles -->
        <style>
            #chartdiv {
                width: 100%;
                height: 500px;
            }
        </style>
        <!-- FIM Styles -->


        <!-- INICIO Estagiarios Ativos -->
        <script>
            //variáveis
            var i, arraylocais, arraytotal, maior_valor, menor_valor;
            //recebe a string com elementos separados, vindos do PHP
            arraylocais = "<?php echo $Locais; ?>";
            arraytotal = "<?php echo $Qtd; ?>";
            maior_valor = "<?php echo $maior_valor; ?>";
            menor_valor = "<?php echo $menor_valor; ?>";


            //transforma esta string em um array próprio do Javascript
            arraylocais = arraylocais.split("-");
            arraytotal = arraytotal.split("-");

            //alert( arraytotal);
            var map = AmCharts.makeChart("chartdiv", {
                "type": "map",
                "theme": "light",
                "colorSteps": 10,
                "dataProvider": {
                    "map": "brazilLow",
                    "getAreasFromMap": true,
                    "zoomLevel": 0.9,
                    //Posso usar id,value,description,percent
                    "areas": function() {
                        var dadosArray = [];
                        for (i in arraylocais) {
                            dadosArray.push({
                                "id": "BR-" + arraylocais[i],
                                "value": arraytotal[i],

                            })
                        }
                        return dadosArray;
                    }()
                },
                "areasSettings": {
                    "autoZoom": true,
                    "balloonText": "[[title]]:<strong>[[value]]</strong>",
                    "color": "#92D1C8",
                    "colorSolid": "#000000",
                    "rollOverOutlineColor": "#114669"
                },
                "legend": {
                    "width": 240,
                    "marginRight": 20,
                    "marginLeft": 20,
                    "equalWidths": true,
                    "maxColumns": 2,
                    "backgroundAlpha": 0.5,
                    "backgroundColor": "#FFFFFF",
                    "borderColor": "#ffffff",
                    "borderAlpha": 1,
                    "right": 0,
                    "horizontalGap": 10,
                    "switchable": true,
                    "data": (function() {
                        var dadosArray = [];
                        for (i in arraylocais) {
                            dadosArray.push({
                                "id": "BR-" + arraylocais[i],
                                "title": arraylocais[i] + ' - ' + arraytotal[i],
                                "color": "#83c2ba"

                            })
                        }
                        return dadosArray;
                    }())
                },
                "valueLegend": {
                    "right": 10,
                    "minValue": menor_valor,
                    "maxValue": maior_valor
                },
                "zoomControl": {
                    "minZoomLevel": 0.9
                },
                "titles": 'titles',
                "listeners": [{
                        "event": "clickMapObject",
                        "method": redir
                    }],
                "titles": [{
                        "text": "Estagiários Ativos",
                        "size": 15
                    }]
            });

            map.addListener('init', function() {
                //map.legend.switchable = true;
                map.legend.addListener("clickMarker", AmCharts.myHandleLegendClick);
                map.legend.addListener("clickLabel", AmCharts.myHandleLegendClick);
            });

            AmCharts.myHandleLegendClick = function(event) {
                var id = event.dataItem.id;
                if (undefined !== event.dataItem.hidden && event.dataItem.hidden) {
                    event.dataItem.hidden = false;
                    map.showGroup(id);
                } else {
                    event.dataItem.hidden = true;
                    map.hideGroup(id);
                }
                map.legend.validateNow();
            };

            function redir(event) {
                if (event) {
                    parent.window.location.href = "../estagiarios/listarEstagiario/estado/" + event.mapObject.id;
                    //alert(event.mapObject.id);
                }
            }
            ;
            function updateHeatmap(event) {
                var map = event.chart;
                if (map.dataGenerated)
                    return;
                if (map.dataProvider.areas.length === 0) {
                    setTimeout(updateHeatmap, 100);
                    return;

                }

                /*
                 for ( var i = 0; i < map.dataProvider.areas.length; i++ ) {
                 map.dataProvider.areas[ i ].value = Math.round( i * 1 );
                 }*/
                map.dataGenerated = true;
                map.validateNow();
            }
            ;

        </script>
        <!-- FIM Estagiarios Ativos -->

<?php
    }
    
}

    $oInicio = new Inicio();
    $classe = 'Inicio';
    $oBjeto = $oInicio;
    @include_once '../application/request.php';
?>