<!DOCTYPE html>
<html>

<head>
	<title>Dice</title>
	<meta charset="UTF-8">
	<meta name="description" content="dobbelstenen">
	<meta name="keywords" content="hobbbeldebobbel">
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>

	<div id="move">
		<?php
function werp(){
  for($i=1; $i <=5; $i++){
    $roll = rand(1,6);
    create_image($roll, $i);
    print "<img src=" . $roll.".png>";
    echo "   ";
    $aWorp[$i] = $roll;
  }
    analyse($aWorp);
}

werp();


echo "</br><form action='' method='post'></br><input type='submit' value='gooien'></form>";
if(isset($_POST['submit'])){
  
}

function create_image($roll){
  $im = @imagecreate(200,200) or die("Cannot Initialize new GD image stream");
  $background_color = imagecolorallocate($im,25,150,220); 
  $dot = imagecolorallocate($im,255,255,255); 

  if($roll==1 OR $roll==3 OR $roll==5){
    imagefilledellipse($im,100,100,40,40,$dot);
  }
  if($roll==2 OR $roll==3){
    imagefilledellipse($im,50,50,40,40,$dot); 
    imagefilledellipse($im,150,150,40,40,$dot); 
  }
  if($roll==4 OR $roll==5 OR $roll==6){
    imagefilledellipse($im,50,50,40,40,$dot); 
    imagefilledellipse($im,150,50,40,40,$dot); 
    imagefilledellipse($im,50,150,40,40,$dot); 
    imagefilledellipse($im,150,150,40,40,$dot);
  }
  if($roll==6){
    imagefilledellipse($im,50,100,40,40,$dot); 
    imagefilledellipse($im,150,100,40,40,$dot); 
  }
  imagepng($im,$roll.".png");
  imagedestroy($im);
}

function analyse($aWorp){
    $aScore = array(0,0,0,0,0,0,0);
    for($i=1; $i <=6; $i++){//outer loop
        for($j=1; $j<6; $j++){//inner loop
            if($aWorp[$j] == $i){
                $aScore[$i]++;
            }
        }
    }
    pokerOrNot($aScore);
    
}

function pokerOrNot($aScore){
    echo "<br>";
    if($aScore[1] == 1 && $aScore[2] == 1 && $aScore[3] == 1 && $aScore[4] == 1 && $aScore[5] == 1){
        echo "large street!";
    } elseif($aScore[2] == 1 && $aScore[3] == 1 && $aScore[4] == 1 && $aScore[5] == 1 && $aScore[6] == 1){
        echo " large street!";
    }
    
    elseif($aScore[1] == 1 && $aScore[2] == 1 && $aScore[3] == 1 && $aScore[4] == 1){
        echo " small street!";
    } elseif($aScore[2] == 1 && $aScore[3] == 1 && $aScore[4] == 1 && $aScore[5] == 1){
        echo " street!";
    } elseif($aScore[3] == 1 && $aScore[4] == 1 && $aScore[5] == 1 && $aScore[6] == 1){
        echo " street!";
    }
    rsort($aScore);
    if($aScore[0] == 2){
        if($aScore[1] == 2){
            echo " 2 pairs!";
        } else{
            echo "1 pair!";
        }
    } elseif($aScore[0] == 3){
        if($aScore[1] == 2){
            echo "full house!";
        } else{
            echo " 3 of a kind!";
        }
    } elseif($aScore[0] == 4){
        echo "4 of a kind!";
    } elseif($aScore[0] == 5){
        echo " Yahtzee!";
    }
}


?>




	</div>





</body>

</html>