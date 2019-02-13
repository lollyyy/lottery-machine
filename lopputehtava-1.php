<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Da lottery machine</title>
</head>
<body>

<?php

//Create an array to store numbers 1-30
$num_pool = range(1,30);

?>
<fieldset>
  <legend>Pick six lucky numbers!</legend>
  <form action="lopputehtava-1.php" method="post">
    <?php
    //Loop through each value in the number pool, creating form inputs for each
    foreach($num_pool as $choice) {
    echo "<input type='checkbox' name='usr_choice[]' value='$choice' class='selection'><label> $choice </label>";
    //Linebreak after every tenth item to keep things tidy
    $i++;
    if($i % 10 == 0){
      echo "<br>";
      }
    }
    ?>
    <br>
    <input type="submit" name="submit" value="Submit">
  </form>
</fieldset>
<?php

//Store the values get from the form
$usr_choice = $_POST['usr_choice'];

//Pick six random values from the number pool and store them to new variable
$raffle = array_rand(array_flip($num_pool), 6);


//Display choices and raffle numbers
echo "Your Numbers: ";
foreach($usr_choice as $usr_display) {
  echo "$usr_display ";
}
echo "<br> Correct Numbers: ";
foreach($raffle as $raffle_display) {
  echo "$raffle_display ";
}

//Count the difference between the two arrays and store the lenght to new variable
//Stfu operator to silence the warning that comes up on the first page load
@$diff = array_diff($usr_choice, $raffle);

//Count the difference of new array
$diff_length = sizeof($diff);

if ($_POST['usr_choice'] != "" && sizeof($usr_choice) == 6) {

echo "<br>";
//Switch through the diff_length array and give user different messages
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
    echo "JACKPOT! YOU ARE THE WINNER!!!";
    break;
}
} else {
  echo "Pick your number";
}
?>

</body>
</html>
