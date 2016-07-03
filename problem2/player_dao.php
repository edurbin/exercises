<?php

interface IPlayerDAO
{
    public function getPlayerById($id);
    public function getPlayerByIdAndHash($id, $hash);
    public function updatePlayer($spins, $credits, $id);
}

class PlayerDAO implements IPlayerDAO{
    function getPlayerById($id) {
        $dbh = new PDO('mysql:host=localhost;dbname=exercise;charset=utf8', 'eric', 'password');
        $sth = $dbh->prepare('SELECT * FROM player WHERE player_id = :playerId');
        $sth->bindParam(':playerId', $id, PDO::PARAM_INT);
        $sth->execute();
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Player');
        $player = $sth->fetch(); 
        return $player;
    }

    function getPlayerByIdAndHash($id, $hash) {
        $player = $this->getPlayerById($id);
        if(password_verify($player->toString(), $hash)) {
            return $player;
        } else {
            return null;
        }
    }

    function updatePlayer($spins, $credits, $id) {
        $dbh = new PDO('mysql:host=localhost;dbname=exercise;charset=utf8', 'eric', 'password');
        $sth = $dbh->prepare('UPDATE player SET lifetime_spins=:spins, credits=:credits WHERE player_id = :playerId');
        $sth->bindParam(':spins', $spins, PDO::PARAM_INT);
        $sth->bindParam(':credits', $credits, PDO::PARAM_INT);
        $sth->bindParam(':playerId', $id, PDO::PARAM_INT);
        return $sth->execute();
    }
}
?>
