<?php

class Player
{
    protected $player_id;
    protected $name;
    protected $credits;
    protected $lifetime_spins;
    protected $salt_value;

    public function getPlayerId() {
        return $this->player_id;
    } 

    public function setPlayerId($id) {
        $this->player_id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getCredits() {
        return $this->credits;
    }

    public function setCredits($credits) {
        $this->credits = $credits;
    }

    public function getLifetimeSpins() {
        return $this->lifetime_spins;
    }

    public function setLifetimeSpins($lifetimeSpins) {
        $this->lifetime_spins = $lifetimeSpins;
    }

    public function getSaltValue() {
        return $this->salt_value;
    }

    public function toString() {
        return $this->player_id . ":" . $this->name . ":" . $this->credits . ":" . $this->lifetime_spins;
    }

    public function getLifetimeAverage() {
        return intval($this->credits / $this->lifetime_spins);
    }
}

?>
