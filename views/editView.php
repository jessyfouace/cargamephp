<?php $title = "Edition";
 require '../views/template/header.php' ?>
<a href="index.php?id=<?php echo $_GET['edit'] ?>&type=<?php echo $_GET['type'] ?>"><-- Retour</a>
<p><?php echo $message; ?></p>
<form action="edit.php?verif=true&edit=<?php echo $_GET['edit'] ?>&type=<?php echo $_GET['type'] ?>" method="post">

<label for="name">Nom du véhicule:</label><br>
<input type="text" name="name" id="name" value="<?php echo $objectVehicle->getName(); ?>"><br>

<label class="mt-2" for="type">Type de véhicule:</label><br>
<select name="select" id="type">
  <option value="Voiture" <?php if ($objectVehicle->getType() == "Voiture") {
     ?> selected <?php
 } ?>>Voiture</option>

  <option value="Moto" <?php if ($objectVehicle->getType() == "Moto") {
     ?>selected <?php
 } ?>>Moto</option>

 
  <option value="Camion" <?php if ($objectVehicle->getType() == "Camion") {
     ?>selected <?php
 } ?>>Camion</option>
</select><br>

<label for="doors">Nom de porte du véhicule:</label><br>
<input type="text" name="doors" id="doors" value="<?php echo $objectVehicle->getDoor(); ?>"><br>

<label for="weight">Poid du véhicule: </label><br>
<input type="text" name="weight" id="weight" value="<?php echo $objectVehicle->getWeight(); ?>"><br>

<label for="mark">Marque du véhicule:</label><br>
<input type="text" name="mark" id="mark" value="<?php echo $objectVehicle->getMark(); ?>"><br>

<input class="mt-2 btn btn-success" type="submit" value="Envoyer">
</form>

<?php require '../views/template/footer.php';
