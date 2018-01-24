<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>T’chat app</title>
    </head>
    <body>
        <div class="container">
		
		<div class="row pt"> <div class="pull-right"><a href="authentification.php">Déconnexion</a></div></div>
            <div class="row">

                <div class="col-md-8">
                    <h3>Liste des messages</h3>
                    <table width="100%" id="table_messages">
                        <tr>
                            <th width="20%">Date</th>
                            <th>Message</th>
                        </tr>
                        <?php foreach ($messages as $message) {
                            ; ?>
                            <tr>
                                <td><?php print $message['date_post']; ?></td>
                                <td><?php echo "<strong>". $message["login"]."</strong>: ".$message['message'];  ?></td>
                            </tr>
                        <?php }; ?>
                    </table>
                </div>
                <div class="col-md-4">
                    <h3> Utilisateurs Connectés</h3>
                    <table width="100%" id="table_users">
                        <tr>
                            <th>Login</th>
                        </tr>
                        <?php foreach ($users as $user) {
                            ?>
                            <tr>
                                <td><?php print $user["login"]; ?></td>
                            </tr>
                            <?php
                        } ?>
                    </table>
                </div>
            </div>

            <br>
           
            <br><br>
            <form action="chat.php" method="POST">
                <h4><?php print $_SESSION['login'] . ':'; ?> </h4>
                <textarea id="message_area" name="message" placeholder="Votre message" required class="form-control" rows="5"></textarea>
                <input type="submit" value="Envoyer" class="btn btn-primary">
            </form>
            <br>

            <br>
           
        </div>
    </body>
</html>


<style>
    table {
        border-spacing: 0 50px;
    }
	
	th{
		border :1px solid #ddd;
		padding-left:10px !important;
	}

    td{
        border-bottom: 1px solid #ddd;
		padding-left:10px !important;
		padding: 10px !important;
         text-align: left;
    }
	
	textarea{
		    margin-bottom: 10px !important;
	}
	.pt{
		padding-top:15px;
	}

</style>
<link rel="stylesheet" href="../web/css/bootstrap.min.css">
<script src="../web/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
    setInterval(
        function () {
            refresh();
        }, 3000
    );

    function refresh() {
        $.ajax(
            {
                type : "POST",
                dataType : "json",
                url : "../controleurs/realTime.php",
                success : function (data) {
                    messages = data['messages'];
                    users = data['users'];

                    table_messages = '<tr><th ' +
                        'width="20%">Date</th><th>Message</th></tr>';
                    for (var i = 0; i < messages.length; i++) {
                        table_messages += '<tr><td>' + messages[i]['date_post'] + '</td>';
                        table_messages += '<td><strong>' + messages[i]['login'] + '</strong>: ' + messages[i]['message'] + '</td>'
                    }
                    table_messages += '</tr>';

                    $('#table_messages').html(table_messages);

                    table_users = '<tr><th>Login</th></tr>';
                    for (var i = 0; i < users.length; i++) {
                        table_users += '<tr><td>' + users[i]['login'] + '</td></tr>';
                    }

                    $('#table_users').html(table_users);
                }
            }
        );
    }


</script>