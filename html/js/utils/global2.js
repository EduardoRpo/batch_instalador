$('input#user-submit').on('click', function(){
        	var user1 = $('input#user1').val();
        	if ($.trim(user1) != '') {
        		$.post('../html/controller/savedata8.php',{user1: user1}, function(data){

        			$('div#firma-data').text(data);

        		});


        	}


    });


$('input#user-submit1').on('click', function(){
            var user3 = $('input#user3').val();
            if ($.trim(user1) != '') {
                $.post('../html/controller/savedata8.php',{user3: user3}, function(data){

                    $('div#firma-data1').text(data);

                });


            }


    });