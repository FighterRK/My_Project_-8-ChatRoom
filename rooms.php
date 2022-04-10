<?php 

// Get Parameters


$roomname = $_GET['roomname'];
 

// connecting to db

include 'db_connect.php';



// execute sql to check wheather room exist

$sql = " SELECT * FROM `rooms` WHERE roomname = '$roomname' ";

$result = mysqli_query($conn,$sql);
if($result)
{
	// check room exist

	if (mysqli_num_rows($result)==0)
	 {
		$message="This Room Doesn't Exist";
		echo '<script language="javascript">';
	    echo 'alert("'.$message.'");';
	    echo 'window.location="http://localhost/chatroom"';
		echo '</script>';
	}

}
else
{
	echo "Error :" .mysqli_error($conn);
}






?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

 <link href="css/product.css" rel="stylesheet">
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}

.anyclass { 
	height: 350px;
	overflow-y: scroll;

}
</style>
</head>
<body>

	 <nav class="container d-flex flex-column flex-md-row justify-content-between">
    <a class="py-2" href="#" aria-label="Product">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="d-block mx-auto" role="img" viewBox="0 0 24 24"><title>Home</title><circle cx="12" cy="12" r="10"/><path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94"/></svg>
    Club Malayali</a>
    <a class="py-2 d-none d-md-inline-block" href="#">About</a>
    <a class="py-2 d-none d-md-inline-block" href="#">Contact</a>
    
  </nav>

<h2>Chat Messages - <?php echo $roomname;  ?></h2>

<div class="container">
	<div class="anyclass">
 
  </div>
</div> 


<input type="text" class="form-control" name="usermsg" id="usermsg" placeholder="add message"> <br>
<button type="text" class="btn btn-outline-primary" name="submitmsg" id="submitmsg">Send Message</button>


<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script type="text/javascript">
    // checks for new messages every 1 sec

    setInterval(runFunction, 1000);
    function runFunction()
    {
      $.post("htcont.php",{room:'<?php echo $roomname ?>'},
        function(data, status)
        {
          document.getElementsByClassName('anyclass')[0].innerHTML=data;
        }

        )
    }



	// Get the input field




// Execute a function when the user releases a key on the keyboard


var input = document.getElementById("usermsg");
input.addEventListener("keyup", function(event) {
   event.preventDefault();
  
  if (event.keyCode === 13) {
  
    document.getElementById("submitmsg").click();
  }
  });



	// user sends then
	
	$("#submitmsg").click(function(){
		var clientmsg = $("#usermsg").val();
  $.post("postmsg.php", {text: clientmsg, room:'<?php echo $roomname ?>', ip:'<?php echo $_SERVER['REMOTE_ADDR']?>'},
  function(data, status){
  	document.getElementsByClassName('anyclass')[0].innerHTML = data; });
  $("#usermsg").val("");
  return false;
  

  
});


</script>
</body>
</html>
