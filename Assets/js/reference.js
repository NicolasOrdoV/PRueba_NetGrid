var arrayMovements = [];

$('#add').click(function(e){
  e.preventDefault();
  let idMovement = $("#movements").val()
  let nameMovement = $("#movements option:selected").text()
  if (idMovement != '') {
    if (typeof existMovement(idMovement) === 'undefined') {
       arrayMovements.push({
     	'IDMOVIMIENTO' : idMovement,
     	'FECHAMOVIMIENTO' : nameMovement
     })
     showMovements()
    }else{
    	alert("El movimiento ya fue seleccionado")
    }
  }else{
  	alert("Debe seleccionar un movimiento");
  }
});

function showMovements(){
	$('#list-movements').empty()
	arrayMovements.forEach(function(movement){
		let html = '<div class="form-group"><button onclick="removeElement('+movement.IDMOVIMIENTO+')" class="btn btn-danger">X</button><span>'+movement.FECHAMOVIMIENTO+'</span></div>'
		$('#list-movements').append(html)
	})
}

function existMovement(idMovement){
	let existMovement = arrayMovements.find(function(movement){
		return movement.IDMOVIMIENTO = idMovement
	})
	return existMovement
}

function removeElement(idMovement){
	let index = arrayMovements.indexOf(existMovement(idMovement))
	arrayMovements.splice(index,1)
	showMovements()
}

$("#submit").click(function(e){
	e.preventDefault() 

	let url = "?controller=reference&method=save"
	let params = {
		NUMREFERENCIA   : $("#NUMREFERENCIA").val(),
		NOMBRE          : $("#NOMBRE").val(),
		EXISTENCIA      : $("#EXISTENCIA").val(),
		PUNTODEREORDEN  : $("#PUNTODEREORDEN").val(),
		PRECIO          : $("#PRECIO").val(),
		TOTALMOVIMIENTO : $("#TOTALMOVIMIENTO").val(),
		movements       : arrayMovements
	}

	$.post(url, params, function(response){
       if (typeof response.error !== 'undefined') {
       	alert(response.message)
       }else{
       	alert("Inserción satistactoria")
       	location.href = '?controller=reference'
       }
	},'json').fail(function(error){
		alert("Error insertando la referencia")
	});
});