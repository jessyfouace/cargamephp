<?php
class MotorbikeManager
{
    private $_bdd;
    public function __construct(PDO $bdd)
    {
        $this->setDb($bdd);
    }
    /**
     * Add new Motorbike
     *
     * @param Motorbike $motorbike
     * @return self
     */
    public function addMotorbike(Motorbike $motorbike)
    {
        $addBdd = $this->_bdd->prepare('INSERT INTO vehicles(name, type, doors, weight, mark) VALUES(:name, :type, :doors, :weight, :mark)');
        $addBdd->bindValue(':name', $motorbike->getName(), PDO::PARAM_STR);
        $addBdd->bindValue(':type', $motorbike->getType(), PDO::PARAM_STR);
        $addBdd->bindValue(':doors', $motorbike->getDoor(), PDO::PARAM_INT);
        $addBdd->bindValue(':weight', $motorbike->getWeight(), PDO::PARAM_INT);
        $addBdd->bindValue(':mark', $motorbike->getMark(), PDO::PARAM_STR);
        $addBdd->execute();
    }
    /**
     * delete Motorbike by id
     *
     * @param Motorbike $Motorbike
     * @return self
     */
    public function deleteMotorbike(Motorbike $motorbike)
    {
        $this->_bdd->exec('DELETE FROM vehicles WHERE id = '.$motorbike->getId());
    }
    /**
     * get one motorbike by id
     *
     * @param integer $id
     * @return self
     */
    public function getMotorbikeById(int $id)
    {
        $motorbike;
        $takeBdd = $this->_bdd->prepare('SELECT * FROM vehicles WHERE id = :id');
        $takeBdd->bindValue(':id', $id, PDO::PARAM_INT);
        $takeBdd->execute();
        $takeAllBdd = $takeBdd->fetchAll();
        foreach ($takeAllBdd as $oneMotorbike) {
            $motorbike = new Motorbike($oneMotorbike);
        }
        return $motorbike;
    }
    /**
     * get all motorbikes
     *
     * @return self
     */
    public function getMotorbikes()
    {
        $motorbikes = [];
        $takeBdd = $this->_bdd->prepare('SELECT * FROM vehicles WHERE type = :motorbikes');
        $takeBdd->bindValue(':motorbikes', 'Moto', PDO::PARAM_STR);
        $takeBdd->execute();
        $takeAllBdd = $takeBdd->fetchAll();
        foreach ($takeAllBdd as $allMotorbikes) {
            $motorbikes[] = new Motorbike($allMotorbikes);
        }
        return $motorbikes;
    }
    /**
     * update object by id
     *
     * @param Motorbike $motorbike
     * @return self
     */
    public function update(Motorbike $motorbike)
    {
        $updateBdd = $this->_bdd->prepare('UPDATE vehicles SET name = :name, type = :type, doors = :doors, weight = :weight, mark = :mark WHERE id = :id');
        $updateBdd->bindValue(':id', $motorbike->getId(), PDO::PARAM_STR);
        $updateBdd->bindValue(':name', $motorbike->getName(), PDO::PARAM_STR);
        $updateBdd->bindValue(':type', $motorbike->getType(), PDO::PARAM_STR);
        $updateBdd->bindValue(':doors', $motorbike->getDoor(), PDO::PARAM_INT);
        $updateBdd->bindValue(':weight', $motorbike->getWeight(), PDO::PARAM_INT);
        $updateBdd->bindValue(':mark', $motorbike->getMark(), PDO::PARAM_STR);
        $updateBdd->execute();
    }
    /**
     * set the bdd
     *
     * @param PDO $bdd
     * @return self
     */
    public function setDb(PDO $bdd)
    {
        $this->_bdd = $bdd;
    }
}
