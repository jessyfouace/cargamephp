<?php

abstract class Vehicle
{
    protected $id;
    protected $name;
    protected $type;
    protected $weight;
    protected $mark;
    protected $doors;

    /**
     * constructor
     *
     * @param array $array
     */
    public function __construct(array $array)
    {
        $this->hydrate($array);
    }

    /**
     * Hydrate for setter
     *
     * @param array $donnees
     * @return self
     */
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * get value of id
     *
     * @return self
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * get value of name
     *
     * @return self
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * get value of type
     *
     * @return self
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * get value of weight
     *
     * @return self
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * get value of mark
     *
     * @return self
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
    * get value of doors
     *
     * @return self
     */
    public function getDoor()
    {
        return $this->doors;
    }

    /**
     * set Value of id
     *
     * @param string $id
     * @return self
     */
    public function setId($newId)
    {
        $newId = (int) $newId;
        $this->id = $newId;

        return $this->id;
    }

    /**
     * set Value of Name
     *
     * @param string $newName
     * @return self
     */
    public function setName(string $newName)
    {
        $this->name = $newName;

        return $this->name;
    }
    
    /**
     * set Value of type
     *
     * @param string $newType
     * @return self
     */
    public function setType(string $newType)
    {
        $this->type = $newType;

        return $this->type;
    }

    /**
     * set Value of weight
     *
     * @param string $newWeight
     * @return self
     */
    public function setWeight($newWeight)
    {
        $newWeight = (int) $newWeight;
        $this->weight = $newWeight;

        return $this->weight;
    }

    /**
     * set Value of Mark
     *
     * @param string $newMark
     * @return self
     */
    public function setMark(string $newMark)
    {
        $this->mark = $newMark;

        return $this->mark;
    }

    /**
     * set Value of doors
     *
     * @param int $numberdoors
     * @return self
     */
    public function setDoors($numberDoors)
    {
        $numberDoors = (int) $numberDoors;
        $this->doors = $numberDoors;

        return $this->doors;
    }
}
