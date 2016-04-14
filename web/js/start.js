var myChoice = 0;
var computerChoice = 0;

$( document ).ready(function() {
	getChoices();
});

$('#myChoices').on('click', '.choice', function() {
	$('.choice').attr('disabled','disabled');
	$('#' + $(this).attr('id')).css('background-color','red');
	myChoice = $(this).attr('id');
	$('#computerChoices').show();

	computerPick();
});

function showResults(){
	
	getChoices();
}

function computerPick(){
	$.ajax({
                type: 'GET',
                url: 'computerPick',
                data: '',
                success: function( r ) {
			$('.choice').each(function(i, obj) {
				if($(this).attr('id') == ('c' + r)){
					computerChoice = r;
					$('#c' + r).css('background-color','red');
				}
			});

			showResults();	
                },
                error: function ( r ) {
                        alert(r);
                }
        });
}

function getChoices(){
	myChoice = 0;
	computerChoice = 0;

	$.ajax({
  		type: 'GET',
  		url: 'getChoices',
  		data: '',
		success: function( r ) {
			var id;
			var myData = '';
			var computerData = '';

			//print button choices
			for(id in r){
				myData += '<button class="choice" id="' + r[id]['id'] + '">' + r[id]['name'] + '</button>';
				computerData += '<button class="choice" id="c' + r[id]['id'] + '" disabled="disabled">' + r[id]['name'] + '</button>';
			}

			$('#myChoices').html(myData);
			$('#computerChoices').html(computerData);
		},
		error: function ( r ) {
			alert(r);
		}
	});	
}
