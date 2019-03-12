$(document).ready(function(){
	$('#butt').click(function() {
		myMove();
		$('#butt').hide();
		$('#locate').hide();
	});

	$('div#fishes').on("click", "label", function() {
		$(this).fadeOut(1200);
	});
});

//Count for restart button - will show when count == 5.
var count = 0;
var restaurants = new Array();

function myMove() {
	var moveTitle = document.getElementById('title2');
	var move = setInterval(frame, 4);
	var pos = 150;
	function frame() {
		if (pos == -50) {
			clearInterval(move);
		} else {
			pos--;
			moveTitle.style.top = pos + "px";
		}
	}
}

function getName() {
	
	var location = document.getElementById("locate").value;
	var link = 'https://cors-anywhere.herokuapp.com/https://api.yelp.com/v3/businesses/search?term=sushi&location=' + location;

	//this will call the api with the URL above and get the data from API. default it gets 20 restaurants and it will store them in restaurants array.
	$.ajax({
	    url: link,
	    headers:
	    {
	    	'Authorization' : 'Bearer AnGUpVSOMtVoI5Rp2EtzOyY9MaOqx5Cuy0jGt2E6Qxlv4kDEJKbYg3UBP9MN6p6qVf5D1t36H_BMEo0VNbliY10WZhOqk1EJQhdd5MXSEDFxl4VWbbyLYC6zowmDXHYx',
	    },
	    method: 'GET',
	    dataType: 'json',
	    success: function(data){

	        var result = data.total;

	            $.each(data.businesses, function(i, item) {

	            	var name = item.name;
	                var cost = item.price;
	                var phone = item.display_phone;
	                var image = item.image_url;
	                var rating = item.rating;
	                var count = item.review_count;
	                var address = item.location.address1;
	                var city = item.location.city;
	                var state = item.location.state;
	                var zipcode = item.location.zip_code;
	                var wholeaddress = address + ' ' + city + ', ' + state + ' ' + zipcode;
	                var website = item.url;

	                restaurants.push([image, name, cost, rating, count, phone, wholeaddress, website]);		//stores the info in 2D array
	                document.getElementById('fishes').classList.remove('hidefish');		//once we have pull all info from API fish will appear
	          });
                 
     
        }
	    
	}).fail(function() {
		//On fail, will alert then reload page.
		alert("Invalid city or address. Please try again.");
		window.location.reload();
	});
}

function createPopup(num)
{
	var popupbox = document.createElement('span');			//this creates the popupbox that contains restaurant
	popupbox.setAttribute('class','popuptext');
	popupbox.setAttribute('id','sushi'+num+'');
	popupbox.innerHTML = '<img src="' + restaurants[num][0] + '" style="width:200px;height:150px;"><br><a href="'+restaurants[num][7] +'">'+ restaurants[num][1] + '</a><br> Address: ' + restaurants[num][6] + '<br>Phone Number: ' + restaurants[num][5] + '<br>Rating: ' + restaurants[num][3] + ' out of ' + restaurants[num][4] + ' reviews</div>';

	var popup = document.createElement('div');				//this creates the picture that user clicks to show restaurant info
	popup.setAttribute('class','popup');
	popup.setAttribute('onclick','showpopup(sushi'+num+')');
	popup.innerHTML = '<img src="./Fishy Pics/' +num+ '.jpg" height="50px" width="50px">';
	popup.appendChild(popupbox);
	
	return popup;
}

function getInfo(num,picname)
{
	$('.wrapper').css('min-height', '95%');
	var x = num;
	document.getElementById('yelpWrapper').appendChild(createPopup(x));
	picname.setAttribute('class','killfish');		//start the kill fish animation
	count++;
	if (count == 5) {
		showNewSearch();
	}
}

function showpopup(n)
{
	n.classList.toggle('show');		//onclick function that will dislpay the popup
}

function showNewSearch() {
	$('#secondaryButton').css('visibility', 'visible');
}
    

