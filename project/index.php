<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Send Mail</title>
</head>

<body>
    <div class="container">
        <div class="text-center">
            <img src="img/logo.png" alt="logo" class="img-fluid" width="250px">
            <h2>Send Mail</h2>
            <p>O seu aplicativo pessoal para envio de e-mails!</p>
        </div>
        <div class="row py-5">
            <form action="" method="POST" class="col-md-12">
                <div class="form-group">
                    <label for="idEmail">E-mail do destinatário</label>
                    <input type="email" class="form-control" name="email" id="idEmail" placeholder="exemplo@exemplo.com">
                </div>
                <div class="form-group">
                    <label for="idTitulo">Assunto</label>
                    <input type="text" class="form-control" name="titulo" id="idTitulo">
                </div>
                <div class="form-group">
                    <label for="idAssunto">Mensagem</label>
                    <textarea name="" class="form-control" name="assunto" id="idAssunto" cols="100" rows="5"></textarea>
                </div>
                <div class="form-group text-right py-3">
                    <button type="submit" class="btn btn-success">Enviar E-mail</button>
                </div>
            </form>
        </div>


    </div>

</body>

</html>