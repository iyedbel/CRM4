<?php
// Database credentials
$db_host = 'localhost'; // or your database host
$db_user = 'root'; // your database username
$db_password = ''; // your database password
$db_name = 'fichier'; // your database name

// Initialize variables for form data
$nom = $prenom = $telephone = $email =$password = '';
$errorMessage = $successMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate form data (you can add more validation if needed)

    // Check if required fields are empty
    if (empty($nom) || empty($prenom) || empty($telephone) || empty($email)|| empty($password)) {
        $errorMessage = "Veuillez remplir tous les champs.";
    } else {
        try {
            // Connect to MySQL database using PDO
            $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
            // Set the PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare SQL statement for insertion
            $stmt = $pdo->prepare("INSERT INTO client (nom, prenom, telephone, email,password) VALUES (:nom, :prenom, :telephone, :email, :password)");

            // Bind parameters
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':telephone', $telephone);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);

            // Execute the prepared statement
            $stmt->execute();

            // Set success message
            $successMessage = "Inscription réussie !";

        } catch(PDOException $e) {
            $errorMessage = "Erreur lors de l'inscription : " . $e->getMessage();
        }

        // Close database connection
        unset($pdo);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau client</title>
    <!-- Liens vers Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Ajoutez votre propre CSS personnalisé ici si nécessaire */
    </style>
</head>
<body>
    <div class="container my-5">
        <h2 class="mb-4">Nouveau client</h2>

        <?php if (!empty($errorMessage)) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?php echo $errorMessage; ?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?php if (!empty($successMessage)) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?php echo $successMessage; ?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <form method="post">
            <div class="form-group row">
                <label for="nom" class="col-sm-3 col-form-label">Nom</label>
                <div class="col-sm-6">
                    <input type="text" id="nom" name="nom" class="form-control" placeholder="Entrez votre nom" value="<?php echo $nom; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="prenom" class="col-sm-3 col-form-label">Prénom</label>
                <div class="col-sm-6">
                    <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Entrez votre prénom" value="<?php echo $prenom; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="telephone" class="col-sm-3 col-form-label">Téléphone</label>
                <div class="col-sm-6">
                    <input type="text" id="telephone" name="telephone" class="form-control" placeholder="Entrez votre numéro de téléphone" value="<?php echo $telephone; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" id="email" name="email" class="form-control" placeholder="Entrez votre adresse email" value="<?php echo $email; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">password</label>
                <div class="col-sm-6">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Entrez votre password" value="<?php echo $password; ?>">
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
