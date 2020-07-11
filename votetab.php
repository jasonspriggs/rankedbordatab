<?php

$candidatestring = file_get_contents("test/1/candidates.json");
$votestring = file_get_contents("test/1/votes.json");
if ($string === false) {
    die("Sad");
}
$candidates = json_decode($candidatestring, true);
$votes = json_decode($votestring, true);
$candidates['voteline'] = "None of the Below";
$top = 2;

$candidatecount = count($candidates);
$tabulation1 = array();

// Check if NotB is winner
foreach($votes as $vote) {
    for($x = 0; $x < $candidatecount; $x++) {
        //echo $x . " place: " . $vote[$x] . " - pts: " . ($candidatecount - $x) . "\n";
        $tabulation1[$vote[$x]] += ($candidatecount - $x);
    }
    //echo "---\n";
}

echo 'inc all totals';
asort($tabulation1);
var_dump($tabulation1);

$tabulation2 = array();

// run real sim
foreach($votes as $vote) {
    $hitnotb = false;
    for($x = 0; $x < $candidatecount - 1; $x++) {
        if($vote[$x] != "voteline" && $hitnotb == false) {
            //echo $x . " place: " . $vote[$x] . " - pts: " . ($candidatecount - 1 - $x) . "\n";
            $tabulation2[$vote[$x]] += ($candidatecount - 1 - $x);
        } else {
            $hitnotb = true;
        }
    }
    //echo "---\n";
}

echo 'final totals';
asort($tabulation2);
var_dump($tabulation2);
