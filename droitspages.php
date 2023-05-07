<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="style.css" />
        <title>Droits Users</title>
        <link rel="icon" type="image/png" sizes="32x32" href="./img/favicon.ico">
        <META NAME="Author" CONTENT="Hélèna/Maryam">
        <META NAME="Keywords" CONTENT="DAKTARI">


    </head>
    <body>

        <!-- Code du haut de page -->
        <nav class="NAVBAR">
            <div class="scroll"></div>
            <div class="DAKTARI">
                <a href="./index.php"><img src="./img/daktari.png" alt="DAKTARI"></a>
            </div>
            <div class="NAVI">
                <ul class="menu">
                    <?php
                    include("./php/connexion_inc.php");
                    include("./php/connexion_utilisateur.php");
                    $resultat = $cnx->prepare("SELECT nompage FROM d_droits WHERE acces=:acces ORDER BY nompage DESC");
                    $resultat->execute(array(':acces' => $_SESSION['acces']));
                    if ($resultat->rowCount() > 0) {
                        while ($ligne = $resultat->fetch(PDO::FETCH_OBJ)) {
                            echo '<li class="item"><a href="./'.$ligne->nompage.'.php">'.$ligne->nompage.'</a></li>';
                        }
                    }
                    ?>
                </ul>
            </div>
        </nav>

        <!-- Contenu de la page -->
        <div class="containerprive">
            <h1>Droits utilisateurs</h1>

            <?php
            echo "Vous êtes connectés en tant que ";
            echo $_SESSION['id'];
            ?>

            <h2>VETO</h2>
            <?php
            $sql = "SELECT acces, nompage FROM d_droits WHERE acces='VETO' ORDER BY acces ASC";
            $resultat = $cnx->query($sql);

            echo "<table>";
            echo "<tr><th>Accès</th><th>Nom de la page</th></tr>";
            while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>" . $ligne["acces"] . "</td><td>" . $ligne["nompage"] . "</td></tr>";
            }
            echo "</table>";
            ?>
            <br>
            <h2>CLIENT</h2>
            <?php
            $sql = "SELECT acces, nompage FROM d_droits WHERE acces='CLIENT' ORDER BY acces ASC";
            $resultat = $cnx->query($sql);

            echo "<table>";
            echo "<tr><th>Accès</th><th>Nom de la page</th></tr>";
            while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>" . $ligne["acces"] . "</td><td>" . $ligne["nompage"] . "</td></tr>";
            }
            echo "</table>";
            ?>

            <h2>Modification des droits</h2>
            <div class="droitsform">
            <form method="post">
            <label for="acces">Accès :</label>
            <select name="acces">
                <option value="" selected="selected">-- acces --</option>
                <option value="VETO">Vétérinaire</option>
                <option value="ADMIN">Administrateur</option>
                <option value="CLIENT">Client</option>
            </select>
            <label for="nompage">Nom de la page :</label>
            <?php
			$resultat=$cnx->query("SELECT nompage FROM d_page");
				echo '<select name="nompage">';
			while( $ligne = $resultat->fetch(PDO::FETCH_OBJ) ) {
				echo '<option value="'.$ligne->nompage.'">';
				echo $ligne->nompage;
				echo '</option>';
			}
				echo '</select>';
			?>

            <div class="choicesdroits">
            <input type="reset" name="reset" value="Effacer" /> 
            <input type="submit" name="Ajouter" value="Ajouter" />
            <input type="submit" name="Supprimer" value="Supprimer" />
            </div>
            </form>
            </div>
            
            <?php
            if (isset($_POST["Ajouter"])) {
                $acces = $_POST["acces"];
                $nompage = $_POST["nompage"];

                $stmt = $cnx->prepare("INSERT INTO d_droits (acces, nompage) VALUES (?, ?)");
                $stmt->execute([$acces, $nompage]);

                echo "Les droits ont été ajoutés avec succès.";
                header("Location: ".$_SERVER["PHP_SELF"]);
                exit();

            } elseif (isset($_POST["Supprimer"])) {
                $acces = $_POST["acces"];  
                $nompage = $_POST["nompage"];

                $stmt = $cnx->prepare("DELETE FROM d_droits WHERE acces = ? AND nompage = ?");
                $stmt->execute([$acces, $nompage]);

                echo "Les droits ont été supprimés avec succès.";
                header("Location: ".$_SERVER["PHP_SELF"]);
                exit();
            }
            ?>

        </div>
    </body>
</html>