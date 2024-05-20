<html>

<head>

    <link rel="stylesheet" href="<?= asset_url(); ?>css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= asset_url(); ?>css/all.min.css" />
    <link rel="stylesheet" href="<?= asset_url(); ?>css/index_style.css" />

    <style>
        .pagination a {
            font-weight: bold;
            font-size: 18px;
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid black;
        }

        .pagination a.active {
            background-color: pink;
        }

        .pagination a:hover:not(.active) {
            background-color: skyblue;
        }
    </style>



</head>

<body>



    <div class="jumbotron jum">

        <div class=" navbar">
            <h3>Phone Book <i class="far fa-address-book"></i></h3>

        </div>


        <div class="row">


            <div class="col-lg-4 inp">

                <form action="">
                    <input onkeyup="searchFunction()" id="myInput" name="s" class="form-control mt-2" placeholder="search">
                    <span class="icon text-primary"><i class="fas fa-search"></i></span>
                </form>

                <h5 class="mt-5">Add New Contact</h5>

                <form action="<?= site_url('contact/add')?>" method="post">
                    <input name='name'  class="form-control mb-3 mt-3" placeholder="add name" id="userName">
                    <div id="nameAlert" class="alert alert-danger text-justify p-2 ">Please add name</div>
                    <input name='mobile'  class="form-control mb-3" placeholder="add phone" id="userPhone">
                    <div id="phoneAlert" class="alert alert-danger text-justify p-2 ">Please add a valid number</div>
                    <input name='email'  class="form-control mb-3" placeholder="add e-mail" id="userEmail">
                    <div id="mailAlert" class="alert alert-danger text-justify p-2 ">Please add a valid e-mail</div>

                    <button type="submit" class="btn btn-info w-100 btn1">Add</button>
                </form>

            </div>


            <div class="col-lg-8">
                <h2 class="mb-3">Search result for <span class="text-warning"><?= $search_keyword; ?></span></h2>
                <table id="myTable" class="table text-justify table-striped">

                    <thead class="tableh1">
                        <th class="">id</th>
                        <th class="">Name</th>
                        <th class="">Phone</th>
                        <th class="">E-mail</th>
                        <th class="col-1">Actions</th>
                    </thead>

                    <tbody id="tableBody">
                        <?php foreach ($contacts as $contact) : ?>
                            <tr class="tableh1">
                                <td class=""><?= $contact['id']; ?></td>
                                <td class=""><?= $contact['name']; ?></td>
                                <td class=""><?= $contact['mobile']; ?></td>
                                <td class=""><?= $contact['email']; ?></td>
                                <td class="col-1">
                                    <a href="<?=site_url("contact/delete/{$contact['id']}")?>"><img src="<?=asset_url('images/delete-icon.png')?>"></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>


                    </tbody>

                </table>

                <input class="float:right mb-4 " style="border-radius:10px; text-align: center; color: black;" id="page" type="number" min="1" max="" placeholder="page" required>
                <button class="btn btn-info w-20 ml-2 mr-2 mb-2" onClick="go2Page();">Go</button>

                <div class="pagination">
                    <?php
                    $page = $_GET['page'] ?? 1;
                    $num_pages = ceil($num_contacts/$pageSize); 
                    $num_buttons_show = 5;
                    $start_button = ( (ceil($page/$num_buttons_show) - 1) * $num_buttons_show ) + 1;
                    $end_button = $start_button + $num_buttons_show;

                    if ($page >= 2) {
                        echo "<a href='?page=" . ($page - 1) . "'>  Prev </a>";
                    }


                    for ($i = $start_button ; $i < $end_button; $i++) {
                        ?>
                        <a href="?page=<?= $i; ?>" class="<?php if ($i == $page) { echo 'active'; }?>"><?=$i;?></a>
                        <?php
                    }
                  

                    if ($page < $num_pages) {
                        echo "<a href='?page=" . ($page + 1) . "'>  Next </a>";
                    }

                    ?>

                </div>


            </div>



        </div>






    </div>


    <script>
        function go2Page() {
            var page = document.getElementById("page").value;

            window.location.href = '?page=' + page;
        }
    </script>


    <script src="<?= asset_url(); ?>js/jquery-3.3.1.min.js"></script>
    <script src="<?= asset_url(); ?>js/popper.min.js"></script>
    <script src="<?= asset_url(); ?>js/bootstrap.min.js"></script>
    <!-- <script src="<?= asset_url(); ?>js/index.js"></script> -->
</body>

</html>