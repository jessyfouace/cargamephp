<?php
class CarManager
{
    private $_bdd;

    public function __construct(PDO $bdd)
    {
        $this->setDb($bdd);
    }

    /**
     * Add new Car
     *
     * @param Car $car
     * @return self
     */
    public function addCar(Car $car)
    {
        $addBdd = $this->_bdd->prepare('INSERT INTO vehicles(name, type, doors, weight, mark) VALUES(:name, :type, :doors, :weight, :mark)');
        $addBdd->bindValue(':name', $car->getName(), PDO::PARAM_STR);
        $addBdd->bindValue(':type', $car->getType(), PDO::PARAM_STR);
        $addBdd->bindValue(':doors', $car->getDoor(), PDO::PARAM_INT);
        $addBdd->bindValue(':weight', $car->getWeight(), PDO::PARAM_INT);
        $addBdd->bindValue(':mark', $car->getMark(), PDO::PARAM_STR);

        $addBdd->execute();
    }

    /**
     * delete car by id
     *
     * @param Car $car
     * @return self
     */
    public function deleteCar(Car $car)
    {
        $this->_bdd->exec('DELETE FROM vehicles WHERE id = '.$car->getId());
    }

    /**
     * get one car by id
     *
     * @param integer $id
     * @return self
     */
    public function getCarById(int $id)
    {
        $car;

        $takeBdd = $this->_bdd->prepare('SELECT * FROM vehicles WHERE id = :id');
        $takeBdd->bindValue(':id', $id, PDO::PARAM_INT);
        $takeBdd->execute();

        $takeAllBdd = $takeBdd->fetchAll();
        foreach ($takeAllBdd as $oneCar) {
            $car = new Car($oneCar);
        }

        return $car;
    }

    /**
     * get all cars
     *
     * @return self
     */
    public function getCars()
    {
        $cars = [];

        $takeBdd = $this->_bdd->prepare('SELECT * FROM vehicles WHERE type = :cars');
        $takeBdd->bindValue(':cars', 'Voiture', PDO::PARAM_STR);
        $takeBdd->execute();
        $takeAllBdd = $takeBdd->fetchAll();
        foreach ($takeAllBdd as $allCars) {
            $cars[] = new Car($allCars);
        }

        return $cars;
    }


    /**
     * get all vehicle
     *
     * @return void
     */
    public function getVehicles()
    {
        $vehicles = [];

        $takeBdd = $this->_bdd->prepare('SELECT * FROM vehicles ORDER BY id DESC');
        $takeBdd->execute();
        $takeAllBdd = $takeBdd->fetchAll();
        foreach ($takeAllBdd as $allVehicles) {
            $vehicles[] = new Car($allVehicles);
        }

        return $vehicles;
    }

    /**
     * update object by id
     *
     * @param Car $car
     * @return self
     */
    public function update(Car $car)
    {
        $updateBdd = $this->_bdd->prepare('UPDATE vehicles SET name = :name, type = :type, doors = :doors, weight = :weight, mark = :mark WHERE id = :id');
        $updateBdd->bindValue(':id', $car->getId(), PDO::PARAM_STR);
        $updateBdd->bindValue(':name', $car->getName(), PDO::PARAM_STR);
        $updateBdd->bindValue(':type', $car->getType(), PDO::PARAM_STR);
        $updateBdd->bindValue(':doors', $car->getDoor(), PDO::PARAM_INT);
        $updateBdd->bindValue(':weight', $car->getWeight(), PDO::PARAM_INT);
        $updateBdd->bindValue(':mark', $car->getMark(), PDO::PARAM_STR);

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
