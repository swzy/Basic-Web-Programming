$(document).ready(function() 
{
    console.log("ready freddy!");
});

function check()
{
	var arr = new Array();			
	arr = $("#form").serializeArray();				//grabs all data from form element

	console.log(arr);
	$(arr).each(function(i,field)					//checks if all fields are filled in. displays message if not
	{
		if(field.value == "")
		{
			document.getElementById("root").innerHTML = "";
			document.getElementById("root").innerHTML += "<h4>MAKE SURE ALL FIELDS ARE FILLED IN!</h4>";
			exit();
		}
	});

	 $.ajax({										//call php to check if fields are valid. will store in database if true
            url: "checkregister.php",
            type: "post",
            data: $("#form").serialize()
        }).done(function(data){

   			if(data == '{"bool":true}')
        	{
        		window.location = "./NewUsersOptionsPage.php";
        	}
        	else
        	{
        		document.getElementById("root").innerHTML = "";
            	document.getElementById("root").innerHTML += data;
        	}
        });
}

function check2()
{
	var arr = new Array();			
	arr = $("#form").serializeArray();				//grabs all data from form element

	console.log(arr);
	$(arr).each(function(i,field)					//checks if all fields are filled in. displays message if not
	{
		if(field.value == "")
		{
			document.getElementById("root").innerHTML = "";
			document.getElementById("root").innerHTML += "<h4>MAKE SURE ALL FIELDS ARE FILLED IN!</h4>";
			exit();
		}
	});

	 $.ajax({										//call php to check if fields are valid. will store in database if true
            url: "checklogin.php",
            type: "post",
            data: $("#form").serialize()
        }).done(function(data){
        	
        	if(data == '{"bool":true}')
        	{
        		window.location = "../options.php";
        	}
        	else
        	{
        		document.getElementById("root").innerHTML = "";
            	document.getElementById("root").innerHTML += data;
        	}
   			
        });
}

function getPassword()
{
	var x = document.getElementById("emailadd").value;

	if(x == "")
	{
		document.getElementById("root").innerHTML = "";
		document.getElementById("root").innerHTML += "<h4>MAKE SURE ALL FIELDS ARE FILLED IN!</h4>";
		exit();
	}
	else
	{
	 $.ajax({										//call php to check if fields are valid. will store in database if true
            url: "checkuser.php",
            type: "post",
            data: {value: x}
        }).done(function(data){

        	var response = jQuery.parseJSON(data);
        	if(typeof response === "object")		//if an object is returned that means user was found
        	{
        		 answer = response.answ;			//store the user's answer and password in global var to be useing in checkAnwer()
        		 password = response.pass;
       
        		 $("#root").html("");										//change the elements on the forgot password page
        		 $("#emailadd").val("");
        		 $("#heading").html("<h3>"+response.quest+"</h3>");
        		 $("#helpme").html("Answer:");
        		 $("#butt").attr("onclick","checkAnswer()");
        	}
        	else
        	{
				document.getElementById("root").innerHTML = "";
            	document.getElementById("root").innerHTML += data;
        	}  			
        });
    }
}

function checkAnswer()
{
	var junk = $("#emailadd").val();

	if(junk == answer)
	{
		var timer = setTimeout(function() {
            window.location='./login.html'
        }, 5000);

		alert("Your password is: " + password + ". You will be redirected to the login page in 5 seconds.");
	}
	else
	{
		$("#root").html("INCORRECT ANSWER!");
	}
}