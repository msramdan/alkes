const flasData = $('.flash-data').data('flashdata');
const flasDataError = $('.flash-data2').data('flashdata2');


if(flasData){
	Swal.fire(
	  'Terima Kasih',
	  flasData,
	  'success'
	)
}

if(flasDataError){
	Swal.fire(
	  'Error 404',
	  flasDataError,
	  'error'
	)
}
