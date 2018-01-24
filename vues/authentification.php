<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Authentification</title>
		<link rel="stylesheet" href="../web/css/bootstrap.min.css">
        <script src="../web/js/jquery-3.1.1.min.js"></script>
    </head>
    <body>
	    <div class="container-fluid">
        <H3>Accéder à mon compte</H3>
        <form action="authentification.php" method="POST">
            <input type="text" name="login" required placeholder="Login" value="">
            <input type="password" name="password" required placeholder="Mot de passe" value="">
            <input type="submit" value="Connexion" class="btn btn-success btn-sm">
        </form>
        <H3>Créer un compte </H3>
        <form action="inscription.php" method="POST">
            <input type="text" name="login" required placeholder="Login">
            <input type="password" name="password" required placeholder="Mot de passe">
            <input type="password" name="password2" required placeholder="Retapez le mot de passe">
            <input type="submit" value="Inscription" class="btn btn-success btn-sm">
        </form>
		
		
		</div>
		
		
		
    </body>
</html>