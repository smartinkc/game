var myChoice = 0;
var computerChoice = 0;

$( document ).ready(function() {
	getChoices();
});

$('#myChoices').on('click', '.choice', function() {
	$('.choice').attr('disabled','disabled');
	$('#' + $(this).attr('id')).css('background-color','yellow');
	myChoice = $(this).attr('id');
	$('#computerChoices').show();

	computerPick();
});

function showResults(){
	$.ajax({
                type: 'POST',
                url: 'winner',
                data: 'myChoice=' + myChoice + '&computerChoice=' + computerChoice,
                success: function( r ) {
			if(r == '-1'){
				$('#result').html('<h1>Draw</h1>');
			}
			else if(r == '1'){
				$('#result').html('<h1>Win</h1>');
			}
			else{
				$('#result').html('<h1>Lose</h1>');
			}
                },
                error: function ( r ) {
                        alert(r);
                }
        });
	
	setTimeout(function(){ 
		getChoices(); 
	}, 3000);
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
					$('#c' + r).css('background-color','yellow');
				}
			});

			showResults();	
                },
                error: function ( r ) {
                        alert(r);
                }
        });
}

function getScore(){
	$.ajax({
                type: 'GET',
                url: 'getScore',
                data: '',
                success: function( r ) {
			var id;
			for(id in r){
				$('#score' + r[id]['winner']).html(r[id]['score']);
			}
                },
                error: function ( r ) {
                        alert(r);
                }
        });
}

function getUserChoices(){
	$.ajax({
                type: 'GET',
                url: 'getUserChoices',
                data: '',
                success: function( r ) {
			console.log(r)
                        //var id;
                        //for(id in r){
                        //        $('#score' + r[id]['winner']).html(r[id]['score']);
                        //}
                },
                error: function ( r ) {
                        alert(r);
                }
        });
}

function getChoices(){
	myChoice = 0;
	computerChoice = 0;
	$('#result').html('');

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

			getScore();
			getUserChoices();
		},
		error: function ( r ) {
			alert(r);
		}
	});	
}
