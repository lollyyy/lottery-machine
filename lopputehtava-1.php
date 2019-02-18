<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Lato:700|Roboto|Righteous" rel="stylesheet">
  <title>Da lottery machine</title>
</head>
<body>
<?php
//Create an array to store numbers 1-30
$num_pool = range(1,30);
?>
<h1>Divi Lottery 2019</h1>
<div class="form-container">
  <legend>Pick <em>6</em> lucky numbers!</legend>
  <form action="lopputehtava-1.php" method="post">
    <?php
    //Loop through each value in the number pool, creating form inputs for each
    foreach($num_pool as $choice) {
    echo "<input type='checkbox' name='usr_choice[]' value='$choice' id='selection$choice'><label for='selection$choice'>$choice</label>";
    //Linebreak after every tenth item to keep things tidy
    if($choice % 10 == 0){
      echo "<br>";
      }
    }
    ?>
    <br>
    <input type="submit" name="submit" value="Submit">

  </form>
</div>
<div id="parrotBox"></div>
<div id="expBox"></div>
<?php

//Store the values get from the form
$usr_choice = $_POST['usr_choice'];

//Pick six random values from the number pool and store them to new variable
$raffle = array_rand(array_flip($num_pool), 6);

if ($_POST['usr_choice'] != "" && sizeof($usr_choice) == 6) {

//Count the difference between the two arrays and store the length to new variable
$diff = array_diff($usr_choice, $raffle);

//Count the difference of new array
$diff_length = sizeof($diff);


//Switch through the diff_length array and give user different messages
echo "<p class='result'><em>";
switch($diff_length) {
  case 6:
    echo "You got 0 right :(";
    break;
  case 5:
    echo "You got 1 right, that's pretty good!";
    break;
  case 4:
    echo "You got 2 right, NICE!";
    break;
  case 3:
    echo "You got 3 right, getting close!";
    break;
  case 2:
    echo "You got 4 right, daymn!";
    break;
  case 1:
    echo "You got 5 right, DON'T LOSE HOPE!";
    break;
  case 0:
    echo "JACKPOT! YOU ARE THE WINNER!!! <br>";
    echo "Here, have some cake! <br> <img src='images/cake.jpg' alt='CAKE!!!' width='200px' height='200px'>";
    break;
}

echo "</em><br>";
//Display choices and raffle numbers
echo "Your Numbers: ";
foreach($usr_choice as $usr_display) {
  echo "$usr_display ";
}
echo "<br> Correct Numbers: ";
foreach($raffle as $raffle_display) {
  echo "$raffle_display ";
}
echo "</p>";

} else {
  echo "<p id='alert'>Good luck!</p>";
}


//For JavaScript wizardy
$usr_choice_json = json_encode($usr_choice);
?>


<script>

const userChoice = JSON.parse('<?= $usr_choice_json; ?>')
const userAlert = document.getElementById('alert')
const parrotBox = document.getElementById('parrotBox')
const expBox = document.getElementById('expBox')

if(userChoice.length != 6) {
  userAlert.innerHTML = 'Please choose <em>six</em> numbers'
}

if(userChoice.length == 30) {
  userAlert.innerHTML = 'You cheeky rascal :D'
  parrotBox.innerHTML = '<img src=images/partyParrot.gif alt=partyParrot>'
  expBox.innerHTML = '<img src=images/expParrot.gif alt=EXPOLOSION>'
}

</script>
</body>
</html>
