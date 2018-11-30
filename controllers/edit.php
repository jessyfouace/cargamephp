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

$vehicleManager = new VehiculeManager($bdd);
if (isset($_GET['edit'])) {
    $takeId = $_GET['edit'];
    $takeType = $_GET['type'];
    $takeVehicle = new VehiculeManager($bdd);
    if ($takeType == "Moto") {
        $objectVehicle = $takeVehicle->getVehicleById($takeId);
    } elseif ($takeType == "Voiture") {
        $objectVehicle = $takeVehicle->getVehicleById($takeId);
    } elseif ($takeType == "Camion") {
        $objectVehicle = $takeVehicle->getVehicleById($takeId);
    } else {
        header('location: index.php');
    }
}

$message = 'Veuillez remplir tous les champ.';
$color = 'colorblack';
if (isset($_GET['verif'])) {
    if (!empty($_POST['name'])) {
        $name = htmlspecialchars(strip_tags($_POST['name']));
        if (!empty($_POST['select'])) {
            $select = htmlspecialchars(strip_tags($_POST['select']));
            if ($_POST['doors'] >= 0) {
                $doors = htmlspecialchars(strip_tags($_POST['doors']));
                if ($_POST['weight'] >= 0) {
                    $weight = htmlspecialchars(strip_tags($_POST['weight']));
                    if (!empty($_POST['mark'])) {
                        $mark = htmlspecialchars(strip_tags($_POST['mark']));
                        if (intval($_POST['doors']) >= 0) {
                            if (intval($_POST['weight']) >= 0) {
                                $doors = intval($_POST['doors']);
                                $weight = intval($_POST['weight']);
                                $message = 'Envois en cours.';
                                $color = 'colorgreen';
                                $vehiculeManager = new VehiculeManager($bdd);
                                if ($_POST['select'] == 'Voiture') {
                                    $objectVehicle = $vehiculeManager->getVehicleById($takeId);
                                    $newCar = new Car([
                                        'id' => $objectVehicle->getId(),
                                        'name' => $name,
                                        'type' => $select,
                                        'doors' => $doors,
                                        'weight' => $weight,
                                        'mark' => $mark
                                    ]);
                                    $updateCar = $vehiculeManager->update($newCar);
                                    $objectVehicle = $vehiculeManager->getVehicleById($takeId);
                                } elseif ($_POST['select'] == 'Camion') {
                                    $objectVehicle = $vehiculeManager->getVehicleById($takeId);
                                    $newTruck = new Truck([
                                        'id' => $objectVehicle->getId(),
                                        'name' => $name,
                                        'type' => $select,
                                        'doors' => $doors,
                                        'weight' => $weight,
                                        'mark' => $mark
                                    ]);
                                    $updateTruck = $vehiculeManager->update($newTruck);
                                    $objectVehicle = $vehiculeManager->getVehicleById($takeId);
                                } elseif ($_POST['select'] == 'Moto') {
                                    $objectVehicle = $vehiculeManager->getVehicleById($takeId);
                                    $newMotorbike = new Motorbike([
                                        'id' => $objectVehicle->getId(),
                                        'name' => $name,
                                        'type' => $select,
                                        'doors' => 0,
                                        'weight' => $weight,
                                        'mark' => $mark
                                    ]);
                                    $updateMotorbike = $vehiculeManager->update($newMotorbike);
                                    $objectVehicle = $vehiculeManager->getVehicleById($takeId);
                                } else {
                                    $message = 'Il s\'emblerait que le type de voiture ne soit pas bon.';
                                    $color = 'colorred';
                                }
                                header('Refresh: 1.5; URL=index.php?id=' . $objectVehicle->getId() . '&type=' . $objectVehicle->getType() . '');
                            }
                        }
                    } else {
                        $message = 'Il s\'emblerait que la marque ne soit pas bonne.';
                        $color = 'colorred';
                    }
                } else {
                    $message = 'Il s\'emblerait que le poid ne soit pas bon.';
                    $color = 'colorred';
                }
            } else {
                $message = 'Il s\'emblerait que le nombre de porte ne soit pas bon.';
                $color = 'colorred';
            }
        } else {
            $message = 'Il s\'emblerait que le type de voiture ne soit pas bon.';
            $color = 'colorred';
        }
    } else {
        $message = 'Il s\'emblerait que le nom ne soit pas bon.';
        $color = 'colorred';
    }
}


require "../views/editView.php";
