<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: origin, x-requested-with, content-type");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");

/*$imagedata = base64_decode($_POST['imgdata']);
$filename = md5(uniqid(rand(), true));
//path where you want to upload image
$file =  $filename.'.png';
$imageurl  = './'.$filename.'.png';
file_put_contents($file,$imagedata);*/


$text = '<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

    
    <title>Mail</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">

  </head>
  <body>
    <p style="margin-left: 40px;"><span style="font-family: Arial;">Hola, Soy
        Sam OutTheBox,</span></p>
    <p style="margin-left: 40px;"><span style="font-family: Arial;">¡Te comparto la evaluación de rutas de hoy! . <br>
      </span></p>
<!--     <p><img src="./sam-xs.png"
         style="width: 145px; height: 167px;"></p> -->
    <p></p>
    <h4>Evaluación de 2021-11-30</h4>

          
          <div class="row">
              
            <div class="col-4 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">R01 -San Jose<h3>
                    </div>
                    <div class="card-body text-center">
                    
                        <input type="text" class="knob" value="0" data-skin="tron" data-thickness="0.2" data-width="120"
                            data-height="120" data-fgColor="#ff0000" data-readonly="true">

                        <div class="knob-label">Deficiente.</div>

                        <div class="col-10 offset-1" style="text-align: justify !important;">
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Meta de TAE y Raspables.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Efectividad de Compra.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Efectividad de Visita.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Clientes Nuevos.</p>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <div class="col-4 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">R02-San Jose<h3>
                    </div>
                    <div class="card-body text-center">
                    
                        <input type="text" class="knob" value="0" data-skin="tron" data-thickness="0.2" data-width="120"
                            data-height="120" data-fgColor="#ff0000" data-readonly="true">

                        <div class="knob-label">Deficiente.</div>

                        <div class="col-10 offset-1" style="text-align: justify !important;">
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Meta de TAE y Raspables.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Efectividad de Compra.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Efectividad de Visita.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Clientes Nuevos.</p>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <div class="col-4 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">R01-Perez Zeledon<h3>
                    </div>
                    <div class="card-body text-center">
                    
                        <input type="text" class="knob" value="0" data-skin="tron" data-thickness="0.2" data-width="120"
                            data-height="120" data-fgColor="#ff0000" data-readonly="true">

                        <div class="knob-label">Deficiente.</div>

                        <div class="col-10 offset-1" style="text-align: justify !important;">
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Meta de TAE y Raspables.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Efectividad de Compra.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Efectividad de Visita.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Clientes Nuevos.</p>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <div class="col-4 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">R03-Perez Zeledon<h3>
                    </div>
                    <div class="card-body text-center">
                    
                        <input type="text" class="knob" value="0" data-skin="tron" data-thickness="0.2" data-width="120"
                            data-height="120" data-fgColor="#ff0000" data-readonly="true">

                        <div class="knob-label">Deficiente.</div>

                        <div class="col-10 offset-1" style="text-align: justify !important;">
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Meta de TAE y Raspables.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Efectividad de Compra.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Efectividad de Visita.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Clientes Nuevos.</p>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <div class="col-4 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">R04-Perez Zeledon<h3>
                    </div>
                    <div class="card-body text-center">
                    
                        <input type="text" class="knob" value="0" data-skin="tron" data-thickness="0.2" data-width="120"
                            data-height="120" data-fgColor="#ff0000" data-readonly="true">

                        <div class="knob-label">Deficiente.</div>

                        <div class="col-10 offset-1" style="text-align: justify !important;">
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Meta de TAE y Raspables.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Efectividad de Compra.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Efectividad de Visita.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Clientes Nuevos.</p>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <div class="col-4 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">R01-Rio Claro<h3>
                    </div>
                    <div class="card-body text-center">
                    
                        <input type="text" class="knob" value="0" data-skin="tron" data-thickness="0.2" data-width="120"
                            data-height="120" data-fgColor="#ff0000" data-readonly="true">

                        <div class="knob-label">Deficiente.</div>

                        <div class="col-10 offset-1" style="text-align: justify !important;">
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Meta de TAE y Raspables.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Efectividad de Compra.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Efectividad de Visita.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Clientes Nuevos.</p>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <div class="col-4 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">R01-PUNTARENAS<h3>
                    </div>
                    <div class="card-body text-center">
                    
                        <input type="text" class="knob" value="0" data-skin="tron" data-thickness="0.2" data-width="120"
                            data-height="120" data-fgColor="#ff0000" data-readonly="true">

                        <div class="knob-label">Deficiente.</div>

                        <div class="col-10 offset-1" style="text-align: justify !important;">
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Meta de TAE y Raspables.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Efectividad de Compra.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Efectividad de Visita.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Clientes Nuevos.</p>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <div class="col-4 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">R02-PUNTARENAS<h3>
                    </div>
                    <div class="card-body text-center">
                    
                        <input type="text" class="knob" value="0" data-skin="tron" data-thickness="0.2" data-width="120"
                            data-height="120" data-fgColor="#ff0000" data-readonly="true">

                        <div class="knob-label">Deficiente.</div>

                        <div class="col-10 offset-1" style="text-align: justify !important;">
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Meta de TAE y Raspables.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Efectividad de Compra.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Efectividad de Visita.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Clientes Nuevos.</p>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <div class="col-4 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">R03-PUNTARENAS<h3>
                    </div>
                    <div class="card-body text-center">
                    
                        <input type="text" class="knob" value="0" data-skin="tron" data-thickness="0.2" data-width="120"
                            data-height="120" data-fgColor="#ff0000" data-readonly="true">

                        <div class="knob-label">Deficiente.</div>

                        <div class="col-10 offset-1" style="text-align: justify !important;">
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Meta de TAE y Raspables.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Efectividad de Compra.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Efectividad de Visita.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Clientes Nuevos.</p>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <div class="col-4 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">R01-Quepos<h3>
                    </div>
                    <div class="card-body text-center">
                    
                        <input type="text" class="knob" value="0" data-skin="tron" data-thickness="0.2" data-width="120"
                            data-height="120" data-fgColor="#ff0000" data-readonly="true">

                        <div class="knob-label">Deficiente.</div>

                        <div class="col-10 offset-1" style="text-align: justify !important;">
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Meta de TAE y Raspables.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Efectividad de Compra.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Efectividad de Visita.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Clientes Nuevos.</p>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <div class="col-4 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">ROCC-01<h3>
                    </div>
                    <div class="card-body text-center">
                    
                        <input type="text" class="knob" value="0" data-skin="tron" data-thickness="0.2" data-width="120"
                            data-height="120" data-fgColor="#ff0000" data-readonly="true">

                        <div class="knob-label">Deficiente.</div>

                        <div class="col-10 offset-1" style="text-align: justify !important;">
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Meta de TAE y Raspables.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Efectividad de Compra.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Efectividad de Visita.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Clientes Nuevos.</p>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <div class="col-4 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">ROCC-03<h3>
                    </div>
                    <div class="card-body text-center">
                    
                        <input type="text" class="knob" value="0" data-skin="tron" data-thickness="0.2" data-width="120"
                            data-height="120" data-fgColor="#ff0000" data-readonly="true">

                        <div class="knob-label">Deficiente.</div>

                        <div class="col-10 offset-1" style="text-align: justify !important;">
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Meta de TAE y Raspables.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Efectividad de Compra.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Efectividad de Visita.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Clientes Nuevos.</p>
                        </div>
                    </div>
                    
                </div>
            </div>
             	
            <div class="col-4 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">ROCC-04<h3>
                    </div>
                    <div class="card-body text-center">
                    
                        <input type="text" class="knob" value="0" data-skin="tron" data-thickness="0.2" data-width="120"
                            data-height="120" data-fgColor="#ff0000" data-readonly="true">

                        <div class="knob-label">Deficiente.</div>

                        <div class="col-10 offset-1" style="text-align: justify !important;">
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Meta de TAE y Raspables.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Efectividad de Compra.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Efectividad de Visita.</p>
                            <p><i class="fas fa-times" style="color: #ff0000;"></i> Clientes Nuevos.</p>
                        </div>
                    </div>
                    
                </div>
            </div>
            
          </div>
    <p><br>
    </p>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="http://html2canvas.hertzen.com/dist/html2canvas.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Knob/1.2.13/jquery.knob.min.js" integrity="sha512-NhRZzPdzMOMf005Xmd4JonwPftz4Pe99mRVcFeRDcdCtfjv46zPIi/7ZKScbpHD/V0HB1Eb+ZWigMqw94VUVaw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.js"></script>

 <!-- SCRIPT PARA LOS GRAFICOS -->
      
           <script>
             $(function() {
               /* jQueryKnob */
      
               $(".knob").knob({
                 change: function(value) {
                   //console.log("change : " + value);
                 },
                 release: function(value) {
                   console.log("release : " + value);
                 },
                 cancel: function() {
                   console.log("cancel : " + this.value);
                 },
                 draw: function() {
      
                   // "tron" case
                   if (this.$.data("skin") == "tron") {
      
                     var a = this.angle(this.cv) // Angle
                       ,
                       sa = this.startAngle // Previous start angle
                       ,
                       sat = this.startAngle // Start angle
                       ,
                       ea // Previous end angle
                       ,
                       eat = sat + a // End angle
                       ,
                       r = true
      
                     this.g.lineWidth = this.lineWidth
      
                     this.o.cursor &&
                       (sat = eat - 0.3) &&
                       (eat = eat + 0.3)
      
                     if (this.o.displayPrevious) {
                       ea = this.startAngle + this.angle(this.value)
                       this.o.cursor &&
                         (sa = ea - 0.3) &&
                         (ea = ea + 0.3)
                       this.g.beginPath()
                       this.g.strokeStyle = this.previousColor
                       this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false)
                       this.g.stroke()
                     }
      
                     this.g.beginPath()
                     this.g.strokeStyle = r ? this.o.fgColor : this.fgColor
                     this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false)
                     this.g.stroke()
      
                     this.g.lineWidth = 2
                     this.g.beginPath()
                     this.g.strokeStyle = this.o.fgColor
                     this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false)
                     this.g.stroke()
      
                     return false
                   }
                 }
               })
             });


           </script>
  </body>
    
</html>';


echo $text;

