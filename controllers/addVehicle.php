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
                                if ($_POST['select'] == 'Voiture') {
                                    $message = 'Envois en cours.';
                                    $color = 'colorgreen';
                                    $carManager = new CarManager($bdd);
                                    $newCar = new Car([
                                        'name' => $name,
                                        'type' => $select,
                                        'doors' => $doors,
                                        'weight' => $weight,
                                        'mark' => $mark
                                    ]);
                                    $addCar = $carManager->addCar($newCar);
                                    header('Refresh: 1.5; URL=addVehicle.php');
                                } elseif ($_POST['select'] == 'Camion') {
                                    $message = 'Envois en cours.';
                                    $color = 'colorgreen';
                                    $truckManager = new TruckManager($bdd);
                                    $newTruck = new Truck([
                                        'name' => $name,
                                        'type' => $select,
                                        'doors' => $doors,
                                        'weight' => $weight,
                                        'mark' => $mark
                                    ]);
                                    $addTruck = $truckManager->addTruck($newTruck);
                                    header('Refresh: 1.5; URL=addVehicle.php');
                                } elseif ($_POST['select'] == 'Moto') {
                                    $message = 'Envois en cours.';
                                    $color = 'colorgreen';
                                    $motorbikeManager = new MotorbikeManager($bdd);
                                    $newMotorbike = new Motorbike([
                                        'name' => $name,
                                        'type' => $select,
                                        'doors' => 0,
                                        'weight' => $weight,
                                        'mark' => $mark
                                    ]);
                                    $addMotorbike = $motorbikeManager->addMotorbike($newMotorbike);
                                    header('Refresh: 1.5; URL=addVehicle.php');
                                } else {
                                    $message = 'Il s\'emblerait que le type de voiture ne soit pas bon.';
                                    $color = 'colorred';
                                    header('Refresh: 1.5; URL=addVehicle.php');
                                }
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

require "../views/addVehicleView.php";
