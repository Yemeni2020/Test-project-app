<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commenting and Review System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Ninth navbar example">
    <div class="container-xl">
      <a class="navbar-brand" href="#">C.A.R.S</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07XL" aria-controls="navbarsExample07XL" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample07XL">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../frontend/index.php">Comments</a>
          </li>
          
        </ul>
        <form role="search">
          <input class="form-control" type="search" placeholder="Search" aria-label="Search">
        </form>
      </div>
    </div>
  </nav>
    <div class="container">
        <h1>Comments</h1>
        <form id="commentForm" method="post" action="../backend/add_comment.php" >
            <textarea class="form-control" name="comment" placeholder="Write your comment..." required></textarea>
            <input type="number" class="form-control mt-2" name="rating" min="1" max="5" placeholder="Rating (1-5)" required>
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
        <div id="commentsSection">
            <!-- Comments will be loaded  dynamically -->
        </div>
        <div id="google-recaptcha-checkbox"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            loadComments();

            $("#commentForm").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    url: "backend/add_comment.php",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(data) {
                        loadComments();
                        $("#commentForm")[0].reset();
                    }
                });
            });

            function loadComments() {
                $.ajax({
                    url: "backend/fetch_comments.php",
                    method: "GET",
                    success: function(data) {
                        $("#commentsSection").html(data);
                    }
                });
            }
        });
    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
    async defer>
</script>

<script type="text/javascript">
    var onloadCallback = function() {
        grecaptcha.render('google-recaptcha-checkbox', {
            'sitekey' : 'my-ste-key-goes-here'
        });
    };
</script>
</body>
</html>