<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Da lottery machine</title>
</head>
<body>

<?php

//Creating an array to store numbers 1-30
$num_pool[] = "";

for($pool_val = 1; $pool_val <= 30; $pool_val++){
  $num_pool[] = $pool_val;
}

//Discarding the zeroth array item to only get numbers 1-30
unset($num_pool[0]);

?>
<fieldset>
  <legend>Pick six lucky numbers!</legend>
<form action="lopputehtava-1.php" method="post">

  <?php
  //Looping through each value in the number pool, creating form inputs for each
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

//Storing the values get from the form
$usr_choice = $_POST['usr_choice'];

//Validating the input so the user can't pick less or more than six values
if(sizeof($usr_choice) != 6){
  echo "Hey man, pick six numbers!";
}

//Pick six random values from the number pool and store them to new variable
$raffle = array_rand($num_pool, 6);

$diff = array_diff($usr_choice, $raffle);

$diff_length = sizeof($diff);

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


 ?>

</body>
</html>
