<?php $title = "Ajouter un véhicule";
      include("template/header.php"); ?>

<?php if (!isset($_GET['id'])) {
          ?>
<form action="addVehicle.php" class="col-12 text-center">
  <input type="submit" class="btn btn-primary" value="Ajouter un nouveau Véhicule">
</form>
<div class="text-center">
<?php foreach ($objectVehicle as $vehicle) {
              ?>
    <ul class="list-unstyled mt-3">
      <li>Nom du véhicule: <?php echo $vehicle->getName(); ?></li>
      <li>Marque du véhicule: <?php echo $vehicle->getMark(); ?></li>
      <li><a class="btn btn-info" href="index.php?id=<?php echo $vehicle->getId(); ?>&type=<?php echo $vehicle->getType(); ?>">Voir plus -></a></li>
    </ul>
<?php
          } ?>
</div>
<?php
      } else {
          ?>
      <a href="index.php"><-- Retour</a>
              <p>Nom du véhicule: <?php echo $objectVehicle->getName(); ?></p>
              <p>Type de véhicule: <?php echo $objectVehicle->getType(); ?></p>
              <?php if ($objectVehicle->getDoor() > 0) {
              ?>
                <p>Nombre de portes: <?php echo $objectVehicle->getDoor(); ?></p>
              <?php
          } ?>
              <p>Poid du véhicule: <?php echo $objectVehicle->getWeight(); ?> kg</p>
              <p>Marque du véhicule: <?php echo $objectVehicle->getMark(); ?></p>
              <a class="btn btn-danger" href="index.php?remove=<?php echo $objectVehicle->getId(); ?>&type=<?php echo $objectVehicle->getType(); ?>">Supprimer</a>
              <a class="btn btn-warning" href="edit.php?edit=<?php echo $objectVehicle->getId(); ?>&type=<?php echo $objectVehicle->getType(); ?>">Modifier</a>
          <?php
      } ?>

<?php include("template/footer.php"); ?>
