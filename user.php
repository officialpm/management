<?php

 include("config.php");
   session_start();
$handle = fopen("test.csv", "a");

if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $error="";
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      //$mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT * FROM users WHERE user_name = '$myusername'";
     $result = mysqli_query($db,$sql);

  
  
  
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
  
      $count = mysqli_num_rows($result);
      if($count >= 1) {
        $error =  " $myusername IS VALID";
        $u="$myusername";
       //$result = mysql_query('SELECT orderid FROM TABLE bills ORDER BY orderid DESC LIMIT 1');

//print values to screen


// Free the resources associated with the result set
// This is done automatically at the end of the script

        
     
      }else {
         $error = "Username is invalid";
      }
   }

//$user =   $_POST['user'];
$q = $_POST['quan'];
$item =  $_POST['itemn'];
$amt=  $_POST['amt'];
$sql = "INSERT INTO bills (user_name, quantity, item, amt) 
VALUES('$myusername','$q','$item', '$amt')";
mysqli_query($db,$sql);

	

?>

  <h1 align=center>USER PANEL</h1>
  <head>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
      

               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>		
            </div>	
         </div>
      </div>
   </body>
  
  <style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>

<style scoped>
       
        .button-success,
        .button-error,
        .button-warning,
        .button-secondary {
            color: white;
            border-radius: 4px;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
        }

        .button-success {
            background: rgb(28, 184, 65); /* this is a green */
        }

        .button-error {
            background: rgb(202, 60, 60); /* this is a maroon */
        }

        .button-warning {
            background: rgb(223, 117, 20); /* this is an orange */
        }

        .button-secondary {
            background: rgb(66, 184, 221); /* this is a light blue */
        }
.right {
  position: absolute;
  right: 0px;
  width: 100px;
  border: 1px solid #73AD21;
  padding: 5px;
  padding-top:1px;
}

    </style>




</head>
<body>
      <button id="myButton" class="button-error pure-button ">Sign Out</button>
        <br>
        <br>
        <script type="text/javascript">
    document.getElementById("myButton").onclick = function () {
        location.href = "logout.php";
    };
</script>


<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'London')">MENU</button>
  
</div>

<div id="London" class="tabcontent">
<head>
<title>MENU</title>

<script>
function billme()
{
var v1= document.order.frenchfriesQty.value;
var v2= document.order.hamburgerQty.value;
var v3= document.order.drinkQty.value;
var v4= document.order.discountRB[0];
var v5= document.order.discountRB[1];


//These lines define the variables.

	v1= parseInt(v1);
	v2= parseInt(v2);
	v3= parseInt(v3);
//These lines make sure that variables 1, 2, and 3 are numbers.
var tv1=v1*12;
  var tv2=v2*20;
  var tv3=v3*15;
  
  
	var sb=order.subtotalBox.value= (v1*12)+(v2*20)+(v3*15)

	if (document.order.discountRB[0].checked) {
		document.order.subtotalBox.value= (order.subtotalBox.value)*0.9
		}
	else if (document.order.discountRB[1].checked) {
		document.order.subtotalBox.value= (order.subtotalBox.value)*0.95
		}
//These lines assign discount function to the radio buttons.

	document.order.taxBox.value= (document.order.subtotalBox.value)*0.07
 document.order.grandtotalBox.value=parseInt(document.order.taxBox.value)+parseInt(document.order.subtotalBox.value);
  
  var doc = new jsPDF();
  
  //doc.text('\t\tCANTEEN \n\n ****BILL****\n\n ITEM\t QUANTITY \t AMOUNT'  , 10, 10)
 var ptext='\t\tCANTEEN \n\n \t\t****BILL****\n\n ITEM\t QUANTITY \t AMOUNT';
  if(v1>0)
  {
    ptext+="\nVADAPAV   \t"+v1+"\t\tRs"+tv1;
  }
  if(v2>0)
  {
    ptext+="\nSANDWICH \t"+v2+"\t\tRs"+tv2;
  }
  if(v3>0)
  {
    ptext+="\nDRINK \t\t"+v3+"\t\tRs"+tv3;
  }
var gt=document.order.grandtotalBox.value;
var tt=document.order.taxBox.value;
ptext+='\n  *TAX :   ';
  ptext=ptext+tt;

    
	if (document.order.discountRB[0].checked) {
		document.order.savingsBox.value= ((v1*12)+(v2*20)+(v3*15))*0.1
		}
	else if (document.order.discountRB[1].checked) {
		document.order.savingsBox.value= ((v1*12)+(v2*20)+(v3*15))*0.05
		} 
	else if (document.order.discountRB[2].checked) {
		document.order.savingsBox.value= 0
		}
//These lines define what should be displayed in the discount box.
ptext+='\nDISCOUNT :  '+document.order.savingsBox.value+'\n\n'

  ptext+='\n\n\n GRAND TOTAL: '+gt+'\n\n\t\t THANKYOU!!!';
doc.text(ptext  , 10, 10);
doc.save('order.pdf');
var uname = '<?php echo $u; ?>';
  var q=v1;
  var item="vadapav";
  var a=tv1;

  //var st=tv1;  
//
}


</script>
</head>

  
  <body>
  <head>
  
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <form action = "" method = "post">
                  <label>Username  :  </label><input type = "text" name = "username" class = "box"/><br /><br />
               
            
               </form>
<body>
<h1 align=center>MENU</h1>
<form id=order name=order>
<p align=center>

<br>
<br>
  
Vadapav Rs.12
 <input type="text" name="frenchfriesQty" size="2" value="0" ></br>
Sandwich Rs.20 <input type="text" name="hamburgerQty" size="2" value="0"></br>
Drink Rs.15 <input type="text" name="drinkQty" size="2" value="0" ></br>
<br>
<br>
<strong>Please select one of the following options:</strong><br>
<input type="radio" name="discountRB" /> Student (10% off) <br>
<input type="radio" name="discountRB" /> Professor (5% off) <br>

<br>
<input type="button" name="calcBtn" value="Place Order" onclick="billme(document.order)" />
<input type="reset" name="resetBtn" value="Clear Order" />
<br>
<br>
SubTotal: Rs.<input type="text" name="subtotalBox" size="6" value="0" /><br>
Tax: Rs.<input type="text" name="taxBox" size="6" value="0" /><br>
Grand Total: Rs.<input type="text" name="grandtotalBox" size="6" value="0" /><br>
Money saved with discounts: Rs.<input type="text" name="savingsBox" size="6" value="0" /><br>
</p>
</body>

</div>

<div id="Paris" class="tabcontent">
  
</div>

<div id="Tokyo" class="tabcontent">
  
</div>

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
  </html>