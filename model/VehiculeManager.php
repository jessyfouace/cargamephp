<?php
class VehiculeManager
{
    private $_bdd;
    public function __construct(PDO $bdd)
    {
        $this->setDb($bdd);
    }
    /**
     * Add new Vehicle
     *
     * @param Vehicle $Vehicle
     * @return self
     */
    public function addVehicule(Vehicle $vehicule)
    {
        $addBdd = $this->_bdd->prepare('INSERT INTO vehicles(name, type, doors, weight, mark) VALUES(:name, :type, :doors, :weight, :mark)');
        $addBdd->bindValue(':name', $vehicule->getName(), PDO::PARAM_STR);
        $addBdd->bindValue(':type', $vehicule->getType(), PDO::PARAM_STR);
        $addBdd->bindValue(':doors', $vehicule->getDoor(), PDO::PARAM_INT);
        $addBdd->bindValue(':weight', $vehicule->getWeight(), PDO::PARAM_INT);
        $addBdd->bindValue(':mark', $vehicule->getMark(), PDO::PARAM_STR);
        $addBdd->execute();
    }
    /**
     * delete vehicule by id
     *
     * @param Vehicle $vehicule
     * @return self
     */
    public function deleteVehicule(Vehicle $vehicule)
    {
        $delete = $this->_bdd->prepare('DELETE FROM vehicles WHERE id = :id');
        $delete->bindValue('id', $vehicule->getId(), PDO::PARAM_INT);
        $delete->execute();
    }
    /**
     * get one Vehicule by id
     *
     * @param integer $vehicule
     * @return self
     */
    public function getVehicleById(int $id)
    {
        $vehicule;
        $takeBdd = $this->_bdd->prepare('SELECT * FROM vehicles WHERE id = :id');
        $takeBdd->bindValue(':id', $id, PDO::PARAM_INT);
        $takeBdd->execute();
        $takeAllBdd = $takeBdd->fetchAll();
        foreach ($takeAllBdd as $oneVehicule) {
            if ($oneVehicule['type'] == 'Camion') {
                $vehicule = new Truck($oneVehicule);
            } elseif ($oneVehicule['type'] == 'Voiture') {
                $vehicule = new Car($oneVehicule);
            } elseif ($oneVehicule['type'] == 'Moto') {
                $vehicule = new Motorbike($oneVehicule);
            }
        }
        return $vehicule;
    }
    /**
     * get all vehicules
     *
     * @return self
     */
    public function getVehicles()
    {
        $vehicules = [];
        $takeBdd = $this->_bdd->prepare('SELECT * FROM vehicles');
        $takeBdd->execute();
        $takeAllBdd = $takeBdd->fetchAll();
        foreach ($takeAllBdd as $oneVehicule) {
            if ($oneVehicule['type'] == 'Camion') {
                $vehicules[] = new Truck($oneVehicule);
            } elseif ($oneVehicule['type'] == 'Voiture') {
                $vehicules[] = new Car($oneVehicule);
            } elseif ($oneVehicule['type'] == 'Moto') {
                $vehicules[] = new Motorbike($oneVehicule);
            }
        }
        return $vehicules;
    }
    /**
     * update object by id
     *
     * @param Vehicule $vehicule
     * @return self
     */
    public function update(Vehicle $vehicle)
    {
        $updateBdd = $this->_bdd->prepare('UPDATE vehicles SET name = :name, type = :type, doors = :doors, weight = :weight, mark = :mark WHERE id = :id');
        $updateBdd->bindValue(':id', $vehicle->getId(), PDO::PARAM_STR);
        $updateBdd->bindValue(':name', $vehicle->getName(), PDO::PARAM_STR);
        $updateBdd->bindValue(':type', $vehicle->getType(), PDO::PARAM_STR);
        $updateBdd->bindValue(':doors', $vehicle->getDoor(), PDO::PARAM_INT);
        $updateBdd->bindValue(':weight', $vehicle->getWeight(), PDO::PARAM_INT);
        $updateBdd->bindValue(':mark', $vehicle->getMark(), PDO::PARAM_STR);
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
