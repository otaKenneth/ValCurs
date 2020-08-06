<?php session_start();
require_once('api/index.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>/\/Currency</title>

    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        div.contact:nth-child(odd) {
            background-color: #dedede;
        }
    </style>
</head>

<body>
    <div id="app">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#" style="font-family: Engravers MT;"><b>/\/</b>Currency</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <?php if (isset($_SESSION['powcur'])) { ?>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <!-- <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dropdown
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li> -->
                        </ul>
                        <form action="api/control/Logout.php" class="form-inline my-2 my-lg-0">
                            <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button>
                        </form>
                    </div>
                <?php } else { ?>
                    <div class="col-9"></div>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto my-2">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Options
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" id="option-login" href="#login">Login</a>
                                    <a class="dropdown-item" id="option-register" href="#register">Register</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                <?php } ?>
            </nav>
        </header>

        <?php if (!isset($_SESSION['powcur'])) { ?>
            <section class="row justify-content-center">

                <form id="login" class="col-5" action="api/control/Login.php" method="POST">
                    <div class="d-flex justify-content-center">
                        <h1 class="mt-5 mb-4">Login</h1>
                    </div>

                    <div class="form-group">
                        <label for="username" class="font-semibold">Username</label>
                        <input type="text" class="form-control" name="username" id="username" aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="password" class="font-semibold">Password</label>
                        <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="">
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>

                <form id="register" class="collapse col-5" action="api/control/Register.php" method="POST">
                    <div class="d-flex justify-content-center">
                        <h1 class="mt-5 mb-4">Register</h1>
                    </div>

                    <div class="form-group">
                        <label for="username" class="font-semibold">Username</label>
                        <input type="text" class="form-control" name="username" id="username" aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="password" class="font-semibold">Password</label>
                        <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password" class="font-semibold">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" aria-describedby="helpId" placeholder="">
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </section>
        <?php } else { ?>
            <section class="mx-0 justify-content-around mt-4">
                <div id="calculator" class="col-7" style="height: 20vh;">
                    <div class="form-group row justify-content-around">
                        <select class="col-6 form-control" v-model="cur1" id="cur1">
                            <option v-for="cur in currencies" :value="cur">{{cur.name}}</option>
                        </select>

                        <input type="number" class="col-5 form-control text-right" v-model="money" id="" aria-describedby="helpId" placeholder="" min="1" step="0.001">
                    </div>
                    <div class="form-group row justify-content-around">
                        <select class="col-6 form-control" v-model="cur2" id="cur2">
                            <option v-for="cur in currencies" :value="cur">{{cur.name}}</option>
                        </select>

                        <input type="number" class="col-5 form-control text-right" v-model="exchange" id="" aria-describedby="helpId" placeholder="" step="0.001">
                    </div>
                </div>
                <div class="mx-3 my-2 border-solid border-gray-400 border-2" style="height: 65vh; overflow:auto;">
                    <table class="table table-striped table-inverse table-md-responsive">
                        <thead class="thead-inverse">
                            <tr>
                                <th>ID</th>
                                <th>NumCode</th>
                                <th>CharCode</th>
                                <th>Name</th>
                                <th>Value</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="cur in currencies">
                                <td scope="row">{{cur.id}}</td>
                                <td>{{cur.numcode}}</td>
                                <td>{{cur.charcode}}</td>
                                <td>{{cur.name}}</td>
                                <td>{{cur.value}}</td>
                                <td>{{cur.date}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        <?php } ?>

        <footer></footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="index.js"></script>
</body>

</html>