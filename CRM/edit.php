<?php

$nom = "";
$prenom = "";
$telephone = "";
$email = "";
$errorMessage = "";
$successMessage = "";
$id = "";

// Votre connexion à la base de données
$connection = new mysqli("localhost", "root", "", "fichier");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET["id"])) {
        // Lorsqu'un ID est présent dans l'URL, récupérez les informations du client
        $id = $_GET["id"];
        $sql = "SELECT * FROM client WHERE id='$id'";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();

        if (!$row) {
            // Si aucun client n'est trouvé pour l'ID donné, redirigez vers une page d'erreur ou une autre page appropriée
            header("location:/CRM/index1.php");
            exit;
        } else {
            // Remplissez les champs du formulaire avec les données du client
            $nom = $row["nom"];
            $prenom = $row["prenom"];
            $telephone = $row["telephone"];
            $email = $row["email"];
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Traitement du formulaire lorsqu'il est soumis
    $id = $_POST["id"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $telephone = $_POST["telephone"];
    $email = $_POST["email"];

    if (empty($nom) || empty($prenom) || empty($telephone) || empty($email)) {
        $errorMessage = "Veuillez remplir tous les champs.";
    } else {
        // Mettre à jour les informations du client dans la base de données
        $sql = "UPDATE client SET nom='$nom', prenom='$prenom', telephone='$telephone', email='$email' WHERE id=$id";
        if ($connection->query($sql) === TRUE) {
            $successMessage = "Client mis à jour avec succès.";
        } else {
            $errorMessage = "Erreur lors de la mise à jour du client: " . $connection->error;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier client</title>
    <!-- Liens vers Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Ajoutez votre propre CSS personnalisé ici si nécessaire */
    </style>
</head>

<body>
    <div class="container my-5">
        <h2 class="mb-4">Modifier client</h2>

        <?php if (!empty($errorMessage)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($successMessage)) : ?>
            <div class="alert alert-success" role="alert">
                <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group row">
                <label for="nom" class="col-sm-3 col-form-label">Nom</label>
                <div class="col-sm-6">
                    <input type="text" id="nom" name="nom" class="form-control" placeholder="Entrez votre nom" value="<?php echo isset($nom) ? $nom : ''; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="prenom" class="col-sm-3 col-form-label">Prénom</label>
                <div class="col-sm-6">
                    <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Entrez votre prénom" value="<?php echo isset($prenom) ? $prenom : ''; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="telephone" class="col-sm-3 col-form-label">Téléphone</label>
                <div class="col-sm-6">
                    <input type="tel" id="telephone" name="telephone" class="form-control" placeholder="Entrez votre téléphone" value="<?php echo isset($telephone) ? $telephone : ''; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" id="email" name="email" class="form-control" placeholder="Entrez votre email" value="<?php echo isset($email) ? $email : ''; ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 offset-sm-3">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                    <a href="/CRM/index1.php" class="btn btn-secondary">Annuler</a>
                </div>
            </div>
        </form>
    </div>

    <!-- Scripts Bootstrap JS requis -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
