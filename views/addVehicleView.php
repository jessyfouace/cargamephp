<?php $title = "Ajouter un véhicule";
     require 'template/header.php'; ?>

<a href="index.php"><-- Retour</a>

<p class="text-center font-weight-bold <?php echo $color; ?>"><?php echo $message; ?></p>

<form action="addVehicle.php?verif=true" method="post" class="col-12 text-center">
<label for="name">Nom:</label><br>
<input type="text" name="name" id="name"><br>

<label class="mt-2" for="type">Type:</label>
<select name="select" id="type">
  <option value="Voiture" selected>Voiture</option>
  <option value="Moto">Moto</option>
  <option value="Camion">Camion</option>
</select><br>

<label class="mt-2" for="doors">Nombre de Portes:</label><br>
<input type="text" name="doors" id="doors"><br>

<label class="mt-2" for="weight">Poids: (Kg)</label><br>
<input type="text" name="weight" id="weight"><br>

<label class="mt-2" for="mark">Marque:</label><br>
<input type="text" name="mark" id="mark"><br>

<input class="mt-2 btn btn-primary" type="submit" value="Envoyer">
</form>

<?php require 'template/footer.php';
