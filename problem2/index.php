<?php
require_once('player_dao.php');
require_once('player.php');
//spin endpoint

$playerId = filter_input(INPUT_GET, 'playerId', FILTER_VALIDATE_INT);
$coinsBet = filter_input(INPUT_GET, 'coinsBet', FILTER_VALIDATE_INT);
$coinsWon = filter_input(INPUT_GET, 'coinsWon', FILTER_VALIDATE_INT);
$hash = filter_input(INPUT_GET, 'hash', FILTER_DEFAULT);

$playerDAO = new PlayerDAO();
$player = $playerDAO->getPlayerByIdAndHash($playerId, $hash);

if(!empty($player)) {
    $credits = $player->getCredits() + ($coinsWon - $coinsBet);
    $spins = $player->getLifetimeSpins() + 1;
    $success = $playerDAO->updatePlayer($spins, $credits, $playerId);
    if($success == true){
        $player = $playerDAO->getPlayerById($playerId); 
        $response = array("Player ID" => $player->getPlayerId(), "Name" => $player->getName(), "Credits" => $player->getCredits(),"Lifetime Spins" => $player->getLifetimeSpins(), "Lifetime Average Return" => $player->getLifetimeAverage());
        print json_encode($response);
    }
}

?>
