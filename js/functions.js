
  var availableDates = ["12-11-2017","19-11-2017","24-11-2017"];

  function available(date) {
  	dmy = date.getDate() + "-" + (date.getMonth()+1) + "-" + date.getFullYear();
  	  if ($.inArray(dmy, availableDates) !== -1) {
  	      return [true, "","Available"];
  	    } else {
  	      return [false,"","Unavailable"];
  	    }
  }


/*=============================*/

function available_seats(){
	var airlineId = $("#airlineId").val();
	var departureDate = $("#departureDate").val();
	var dataString = {"departureDate":departureDate, "airlineId":airlineId} 
	
	//alert(departureDate);
	$.ajax({
		type: "POST",
		url: "/scripts/get-available-seats.php",
		data:dataString,
		success: function(html){
			$("#available-seats").html(html);
			book_seats();
		}
	});
}

function book_seats(){
	var seats = $("[name='seats']").val();
	//alert(tickets);
	$("#seats").empty();

	 if(seats != 0){
		if(seats >= 9){
			for (i=1; i<=10; i++){
				$('<option>').val(i).text(i).appendTo("#seats");
			}
			$("#seats-booking").show();
		}	else {
			for (i=1; i<=seats; i++){
				$('<option>').val(i).text(i).appendTo("#seats");
			}
			$("#seats-booking").show();
			}

	} else{
		$("#seats-booking").hide();
	}
}


/*=======CHECK AVAILABILITY OF SEATS IN EDIT-FLIGHT.PHP======================*/
function check_flight_avail(){
	var airlineId = $("#airlineId").val();
	var departureDate = $("#departureDate").val();
	var numSeats = $("#seats").val();
	var dataString = {"departureDate":departureDate, "airlineId":airlineId} 
	
	//alert(departureDate);
	$.ajax({
		type: "POST",
		url: "/scripts/get-available-seats.php",
		data:dataString,
		success: function(html){
			$("#available-seats").html(html);
		}
	});

}
