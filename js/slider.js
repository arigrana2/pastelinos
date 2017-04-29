//intervalo tiempo cambio img slide, 5 segundos, se llama a la función "avanzaSlide()"
setInterval('avanzaSlide()',3000);
 
//array con las clases para las diferentes imagenes
var arrayImagenes = new Array(".img1",".img2",".img3");
 
//variable que nos permitirá saber qué imagen se está mostrando
var contador = 0;
 
//hace un efecto fadeIn para mostrar una imagen
function mostrar(img){
	$(img).ready(function(){				
  		$(arrayImagenes[contador]).fadeIn(1500);		
	});
}
 
//hace un efecto fadeOut para ocultar una imagen
function ocultar(img){
	$(img).ready(function(){				
  		$(arrayImagenes[contador]).fadeOut(1500);		
	});
}
 
//función principal
function avanzaSlide(){
        //se oculta la imagen actual
	ocultar(arrayImagenes[contador]);
        //aumentamos el contador en una unidad
	contador = (contador + 1) % 3;
        //mostramos la nueva imagen
	mostrar(arrayImagenes[contador]);
}

function boda() {
    if(document.getElementById('boda').style.display=='none'){
        document.getElementById('boda').style.display='block';
        document.getElementById('infantil').style.display='none';
        document.getElementById('xv').style.display='none';
        document.getElementById('baby').style.display='none'; 
    }else{
        document.getElementById('boda').style.display='none';
    }
    
} function infantil() {
    if(document.getElementById('infantil').style.display=='none'){
        document.getElementById('infantil').style.display = 'block';
        document.getElementById('boda').style.display='none';
        document.getElementById('xv').style.display='none';
        document.getElementById('baby').style.display='none';
     }else{
        document.getElementById('infantil').style.display='none';
    }
} function xv() {
    if(document.getElementById('xv').style.display=='none'){
        document.getElementById('xv').style.display = 'block';
        document.getElementById('boda').style.display='none';
        document.getElementById('infantil').style.display='none';
        document.getElementById('baby').style.display='none';
    }else{
        document.getElementById('xv').style.display='none';
    }
} function baby() {
    if(document.getElementById('baby').style.display=='none'){
        document.getElementById('baby').style.display = 'block';
        document.getElementById('infantil').style.display='none';
        document.getElementById('xv').style.display='none';
        document.getElementById('boda').style.display='none';
    }else{
        document.getElementById('baby').style.display='none';
    }
}function todos() {
   if(document.getElementById('boda').style.display=='block'&& document.getElementById('baby').style.display == 'block'&&
      document.getElementById('infantil').style.display=='block'&&document.getElementById('xv').style.display=='block'){
        document.getElementById('baby').style.display = 'none';
        document.getElementById('infantil').style.display='none';
        document.getElementById('xv').style.display='none';
        document.getElementById('boda').style.display='none';
    }else{
        document.getElementById('boda').style.display='block';   document.getElementById('baby').style.display = 'block';
        document.getElementById('infantil').style.display='block';
        document.getElementById('xv').style.display='block';
    }
}
var $TABLE = $('#table');
var $BTN = $('#export-btn');
var $EXPORT = $('#export');

$('.table-add').click(function () {
  var $clone = $TABLE.find('tr.hide').clone(true).removeClass('hide table-line');
  $TABLE.find('table').append($clone);
});

$('.table-remove').click(function () {
  $(this).parents('tr').detach();
});

$('.table-up').click(function () {
  var $row = $(this).parents('tr');
  if ($row.index() === 1) return; // Don't go above the header
  $row.prev().before($row.get(0));
});

$('.table-down').click(function () {
  var $row = $(this).parents('tr');
  $row.next().after($row.get(0));
});

// A few jQuery helpers for exporting only
jQuery.fn.pop = [].pop;
jQuery.fn.shift = [].shift;

$BTN.click(function () {
  var $rows = $TABLE.find('tr:not(:hidden)');
  var headers = [];
  var data = [];
  
  // Get the headers (add special header logic here)
  $($rows.shift()).find('th:not(:empty)').each(function () {
    headers.push($(this).text().toLowerCase());
  });
  
  // Turn all existing rows into a loopable array
  $rows.each(function () {
    var $td = $(this).find('td');
    var h = {};
    
    // Use the headers from earlier to name our hash keys
    headers.forEach(function (header, i) {
      h[header] = $td.eq(i).text();   
    });
    
    data.push(h);
  });
  
  // Output the result
  $EXPORT.text(JSON.stringify(data));
});