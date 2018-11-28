<?php
class TruckManager
{
    private $_bdd;

    public function __construct(PDO $bdd)
    {
        $this->setDb($bdd);
    }

    /**
     * Add new Truck
     *
     * @param Truck $truck
     * @return self
     */
    public function addTruck(Truck $truck)
    {
        $addBdd = $this->_bdd->prepare('INSERT INTO vehicles(name, type, doors, weight, mark) VALUES(:name, :type, :doors, :weight, :mark)');
        $addBdd->bindValue(':name', $truck->getName(), PDO::PARAM_STR);
        $addBdd->bindValue(':type', $truck->getType(), PDO::PARAM_STR);
        $addBdd->bindValue(':doors', $truck->getDoor(), PDO::PARAM_INT);
        $addBdd->bindValue(':weight', $truck->getWeight(), PDO::PARAM_INT);
        $addBdd->bindValue(':mark', $truck->getMark(), PDO::PARAM_STR);

        $addBdd->execute();
    }

    /**
     * delete truck by id
     *
     * @param Truck $truck
     * @return self
     */
    public function deleteTruck(Truck $truck)
    {
        $this->_bdd->exec('DELETE FROM vehicles WHERE id = '.$truck->getId());
    }

    /**
     * get one truck by id
     *
     * @param integer $id
     * @return self
     */
    public function getTruckById(int $id)
    {
        $truck;

        $takeBdd = $this->_bdd->prepare('SELECT * FROM vehicles WHERE id = :id');
        $takeBdd->bindValue(':id', $id, PDO::PARAM_INT);
        $takeBdd->execute();

        $takeAllBdd = $takeBdd->fetchAll();
        foreach ($takeAllBdd as $oneTruck) {
            $truck = new Truck($oneTruck);
        }

        return $truck;
    }

    /**
     * get all trucks
     *
     * @return self
     */
    public function getTrucks()
    {
        $trucks = [];

        $takeBdd = $this->_bdd->prepare('SELECT * FROM vehicles WHERE type = :trucks');
        $takeBdd->bindValue(':trucks', 'truck', PDO::PARAM_STR);
        $takeBdd->execute();
        $takeAllBdd = $takeBdd->fetchAll();
        foreach ($takeAllBdd as $allTrucks) {
            $trucks[] = new Truck($allTrucks);
        }

        return $trucks;
    }

    /**
     * update object by id
     *
     * @param Truck $truck
     * @return self
     */
    public function update(Truck $truck)
    {
        $updateBdd = $this->_bdd->prepare('UPDATE vehicles SET name = :name, type = :type, doors = :doors, weight = :weight, mark = :mark WHERE id = :id');
        $updateBdd->bindValue(':id', $truck->getId(), PDO::PARAM_STR);
        $updateBdd->bindValue(':name', $truck->getName(), PDO::PARAM_STR);
        $updateBdd->bindValue(':type', $truck->getType(), PDO::PARAM_STR);
        $updateBdd->bindValue(':doors', $truck->getDoor(), PDO::PARAM_INT);
        $updateBdd->bindValue(':weight', $truck->getWeight(), PDO::PARAM_INT);
        $updateBdd->bindValue(':mark', $truck->getMark(), PDO::PARAM_STR);

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
