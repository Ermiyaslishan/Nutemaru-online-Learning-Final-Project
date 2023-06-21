<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Nutermaru online compiler</title>
</head>
<body>
    <div class="container-fluid">
        <br/><br/>
        <h3 class="text-center text-success">
        Nutemaru Online Code Editor
        </h3>
        <hr>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <h3 class="text-info">
                                 Code Editor
                            </h3>
                        </div>
                        <div class="float-left">
                            <div class="form-group" style="float:right; margin-top:-40px" >
                            <a href="index.php"><input type="button" id="clear" class="btn btn-primary btn-sm" value="Home"></a>
                                <input type="button" id="clear" class="btn btn-primary btn-sm" value="Clear">
                                <input type="button" id="run" class="btn btn-success btn-sm" value="Run">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="myEditor" style="min-height:90vh;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="card" style="min-height:90vh;">
                    <div class="card-header">
                        <h3 class="text-info">
                            Output screen
                        </h3>
                    </div>
                    <div class="card-body" id="output"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js"></script>

    <script type="text/javascript">
        var editor = ace.edit('myEditor');
        editor.getSession().setMode("ace/mode/html");
        editor.getSession().setMode("ace/mode/css");
        editor.setTheme("ace/theme/html");
        editor.setValue(`<!DOCTYPE html>
<html lang="en">
   <head>
    <title>Document</title>
   </head>
      <body>
        <h1> hello world </h1>
      </body>
</html>`);

        document.getElementById("run").addEventListener("click", function() {
            var code = editor.getValue();
            document.getElementById("output").innerHTML = code;
        });

        document.getElementById("clear").addEventListener("click", function() {
            editor.setValue("");
        });
    </script>
</body>
</html>
