<?php
require_once("inc/init.php");
if(!utilisateurEstConnecte())
{
	header("location:connexion.php");
	exit();
}
if($_POST)
{
	if(!empty($_POST['motdepasse']))
	{
		Request("update customers SET motdepasse='$_POST[motdepasse]',email='$_POST[email]',nometprenom='$_POST[nometprenom]', adresse='$_POST[adresse]',civilte='$_POST[civilte]',ville='$_POST[ville]',pays='$_POST[pays]',telephone='$_POST[telephone]' where id_custemers='".$_SESSION['utilisateur']['id_customers']."'");
		unset($_SESSION['utilisateur']);		
		foreach($customers as $indice => $element)
		{
			if($indice != 'motdepasse')
			{
				$_SESSION['utilisateur'][$indice] = $element;
			}
			else
			{
				$_SESSION['utilisateur'][$indice] = $_POST['motdepasse'];
			}
		}
		header("Location:customers.php?action=modif");
	}
	else
	{
		$msg .= "le nouveau mot de passe doit être renseigné !";
	}
}
if(isset($_GET['action']) && $_GET['action'] == 'modif')
{
	$msg .= "la modification à bien été prise en compte";
}

require_once("topmenu.php");
echo $msg;
?>
		<h2> Modification de vos informations </h2>
		<?php
			print "vous êtes connecté sous l'email: " . $_SESSION['utilisateur']['email'];
		?><br /><br />
		<form method="post" enctype="multipart/form-data" action="customers.php">
		<input type="hidden" id="id_costumers" name="id_costumers" value="<?php if(isset($_SESSION['utilisateur'])) print $_SESSION['utilisateur']['id_costumers']; ?>" />
			<label for="email">Email</label>
				<input disabled type="text" id="email" name="email" value="<?php if(isset($_SESSION['utilisateur'])) print $_SESSION['utilisateur']['email']; ?>"/><br />
				<input type="hidden" id="email" name="email" value="<?php if(isset($_SESSION['utilisateur'])) print $_SESSION['utilisateur']['email']; ?>"/>
			
			<label for="motdepasse">Nouv. Mot de passe</label>
				<input type="text" id="motdepasse" name="motdepasse" value="<?php if(isset($motdepasse)) print $motdepasse; ?>"/><br /><br />
			
			<label for="nometprenom">Nom et Prenom</label>
				<input type="text" id="nometprenom" name="nometprenom" value="<?php if(isset($_SESSION['utilisateur'])) print $_SESSION['utilisateur']['nometprenom']; ?>"/><br />
			<label for="sexe">Sexe</label>
					<select id="sexe" name="sexe">
						<option value="m" <?php if(isset($_SESSION['utilisateur']['sexe']) && $_SESSION['utilisateur']['sexe'] == "m") print "selected"; ?>>Homme</option>
						<option value="f" <?php if(isset($_SESSION['utilisateur']['sexe']) && $_SESSION['utilisateur']['sexe'] == "f") print "selected"; ?>>Femme</option>
					</select><br />
			<label for="ville">Ville</label>
				<input type="text" id="ville" name="ville" value="<?php if(isset($_SESSION['utilisateur'])) print $_SESSION['utilisateur']['ville']; ?>"/><br />
				<label for="adresse">Adresse</label>
					<textarea id="adresse" name="adresse"><?php if(isset($_SESSION['utilisateur'])) print $_SESSION['utilisateur']['adresse']; ?></textarea>
					<label for="pays">Pays</label>
					<input type="text" name="pays" value="<?php if(isset($_SESSION['utilisateur'])) print $_SESSION['utilisateur']['pays']; ?>"/><br />
					<label for="telephone">Telephone</label>
					<input type="text" name="telephone" value="<?php if(isset($_SESSION['utilisateur'])) print $_SESSION['utilisateur']['telephone']; ?>"/><br />
			<br /><br />
			<input type="submit" class="submit" name="modification" value="modification"/>
	</form><br />
</div>