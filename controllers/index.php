<?php
require "../model/Database.php";

function chargerClasse($classname)
{
    if (file_exists('../model/'. ucfirst($classname).'.php')) {
        require '../model/'. ucfirst($classname).'.php';
    } else {
        require '../entities/'. ucfirst($classname).'.php';
    }
}
spl_autoload_register('chargerClasse');

$bdd = Database::BDD();
if (!isset($_GET['id'])) {
    $vehicleManager = new VehiculeManager($bdd);
    $objectVehicle = $vehicleManager->getVehicles();
}

if (isset($_GET['id'])) {
    $takeId = $_GET['id'];
    $takeType = $_GET['type'];
    $takeVehicule = new VehiculeManager($bdd);
    if ($takeType == "Moto") {
        $objectVehicle = $takeVehicule->getVehicleById($takeId);
    } elseif ($takeType == "Voiture") {
        $objectVehicle = $takeVehicule->getVehicleById($takeId);
    } elseif ($takeType == "Camion") {
        $objectVehicle = $takeVehicule->getVehicleById($takeId);
    }
}

if (isset($_GET['remove'])) {
    if (isset($_GET['type'])) {
        $takeId = $_GET['remove'];
        $takeType = $_GET['type'];
        $takeVehicle = new VehiculeManager($bdd);
        if ($takeType == "Moto") {
            $objectVehicle = $takeVehicle->getVehicleById($takeId);
            $removeVehicle = $takeVehicle->deleteVehicule($objectVehicle);
            header('location: index.php');
        } elseif ($takeType == "Voiture") {
            $objectVehicle = $takeVehicle->getVehicleById($takeId);
            $removeVehicle = $takeVehicle->deleteVehicule($objectVehicle);
            header('location: index.php');
        } elseif ($takeType == "Camion") {
            $objectVehicle = $takeVehicle->getVehicleById($takeId);
            $removeVehicle = $takeVehicle->deleteVehicule($objectVehicle);
            header('location: index.php');
        } else {
            header('location: index.php');
        }
    } else {
        header('location: index.php');
    }
}




require "../views/indexVue.php";
