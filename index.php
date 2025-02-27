<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>LunchBox</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
       /* Custom styling to center the form on the page */
       body, html {
            height: 100%;
            margin: 0;
        }
        .center-form {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            
        }
        .card{
            backdrop-filter: blur(16px) saturate(180%);
    -webkit-backdrop-filter: blur(16px) saturate(180%);
    background-color: rgba(255, 255, 255, 0.897);
    border-radius: 12px;
    border: 1px solid rgba(209, 213, 219, 0.3);
        }
</style>
<body  style="background-image: url('https://th.bing.com/th/id/R.0deb6001ee3b95fc898a13a75167e7fb?rik=r334WSRu9KO%2fQw&riu=http%3a%2f%2fgetwallpapers.com%2fwallpaper%2ffull%2fe%2f0%2fb%2f233290.jpg&ehk=yPkr5WQslK7cCMKA7yRw3D3zTONWD05J09wDb5edBbI%3d&risl=&pid=ImgRaw&r=0'); background-repeat: no-repeat; background-position: center; background-size: cover;">

    <div class="center-form  d-flex justify-content-center align-items-center">
        <div class="card" style="width: 20rem;">
            <div class="card-body">
                <div class="text-center">
                    <img class="mb-1" style="height: 150px;" src="https://th.bing.com/th/id/OIP.4ACXwAp_zyQCh6Iqi7rnlAHaHa?pid=ImgDet&w=206&h=206&c=7&dpr=1.6" alt="">

                </div>
                <h3 class="text-center mb-1">WELCOME ADMIN</h3>
                <h5 class="card-title text-center mb-4">Login</h5>

                <!-- Login Form -->
                <form>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Enter username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter password" required>
                    </div>
                    <div class="d-grid">
                        <a href="dashboard.php" type="submit" class="button">Submit</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>