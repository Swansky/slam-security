<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">    
    <title>Flop-Security - Homepage</title>
  </head>
  <body>
    <div class="container-lg">

      <nav class="navbar navbar-expand-lg navbar-light bg-light my-2">
        <div class="container-fluid">
          <a class="navbar-brand" href="/">Flop-Security</a>

          <ul class="nav justify-content-end">
            <li class="nav-item active">
              <a class="nav-link" href="/home.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="log.php">Commentaires</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/index.php?action=logout">Logout</a>
            </li>
          </ul>          
        </div>
      </nav>

      <div class="row mt-5">
        <div class="col"></div>
        <div class="card" style="width: 32rem;">
          <div class="card-body">
            <h3 class="card-title text-center">Bravo</h3>
            <p class="card-text text-center">Première étape réussie.</p>
            <p class="card-text text-center"><a href="log.php" class="btn btn-warning">Etape 2</a></p>
          </div>
        </div>
        <div class="col"></div>

        <footer class="mt-auto text-center">
        <p>Refresh database :&nbsp;<small><?php echo $sTime2refresh; ?></small></p>
        </footer>
    </div>
  </body>
</html>