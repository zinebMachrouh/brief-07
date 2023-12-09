<?php
ob_start();
session_start();
include '../SQL/connect.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Add question</title>
    <link rel="shortcut icon" href="../public/brand.png" type="image/x-icon">
    <meta name="title" content="Team and project management for DataWare">
    <meta name="keywords" content="team, project, Members, team management, project management">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika&family=Inter:wght@100&family=Ruda&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika&family=Inter:wght@100&family=Ruda&display=swap" rel="stylesheet">


    <!-- js -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                fontFamily: {
                    'Saira': ['Saira Condensed', 'sans-serif']

                },
                extend: {
                    colors: {
                        'dark': '#1e1b4b',
                        'white-color': '#F6F6F6',
                        'purp-color': '#8F51E1',
                        'blue-color': '#5476E4',
                        'blue-primary': '#308BE6',
                        'blutext': '#00A8E8',
                        'black-color': '#1E1E1E',
                    },

                },
            },
        }
    </script>
    <style>
        .login-body {
            width: 100%;
            height: 100vh;
            background: url(../public/bg-login.png) no-repeat;
            background-position: center;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .create-form h2 {
            display: flex;
            align-items: center;
            color: #1e1e1e;
            font-size: 30px;
            justify-content: center;
            padding: 20px;
        }
    </style>

</head>

<body class="login-body">
    <div class="border  m-auto mt-20  w-1/2 rounded-lg border-blutext border-4 bg-white-color">
        <div class="create-form">
            <h2>Data<img src="../public/brand.png" alt=brand />are</h2>
            <form action="" method="post" class="my-10 mx-10">
                <?php
                $id = $_GET['modifyOne'];
                $query = "SELECT * FROM questions WHERE id = :id";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                echo '

                <div class="my-6">

                    <div class="w-full ">
                        <label for="title" class="text-lg font-bold text-dark">Title:</label>
                    </div>

                    <input type="text" id="title" name="title" value=' . $questions['title'] . ' class="border border-2 border-blutext w-full py-2 rounded-lg pl-2 mt-2">
                </div>
                <div>
                    <label for="Content" class="text-lg font-bold text-dark">Content:</label>
                </div>

                <input type="text" id="content" name="content" value=' . $questions['content'] . ' required class="border border-2 border-blutext w-full py-2 rounded-lg pl-2 mt-2">


                <div class="my-2">
                    <label for="tags" class="text-lg font-bold text-dark">Tags:</label>
                </div>
                    ';
                ?>

                <div class="flex gap-8 my-4">
                    <?php if (count($tags_name) > 0) {
                        foreach ($tags_name as $tag_name) { ?>
                            <div>
                                <input type="checkbox" name="" value="$tag_name['id']">
                                <label for="" class="text-lg text-dark"><?php echo $tag_name['name'] ?></label>
                            </div>



                        <?php } ?>
                    <?php } ?>
                </div>
                <div>
                    <button class="addMoreTags text-blutext border-b border-1 border-blutext">Add more tags</button>
                </div>

                <div>
                    <input type="text" id="tags" name="tags" placeholder="Tag1, Tag2, Tag3" class="hidden border border-2 border-blutext w-full px-4 rounded-lg py-2 mt-2">
                </div>
        </div>
        <div class="w-full my-4 px-8">
            <input type="submit" value="Submit Question" name="addquestion" class="text-white-color bg-blutext  px-2 py-2 rounded-lg w-full text-lg">
        </div>
        </form>
    </div>
    <?php

        if (isset($_POST["modifyOne"])) {
            $title = $_POST["title"];
            $lname = $_POST["lname"];
            $email = $_POST["email"];
            $birthdate = $_POST["birthdate"];
            $tel = $_POST["tel"];
            $adress = $_POST["adress"];
            $service = $_POST["service"];
            $pswd = base64_encode($_POST["pswd"]);


            $stmtM = $conn->prepare("UPDATE users 
                                    SET 
                                        `lname` = :lname, 
                                        `fname` = :fname, 
                                        `birthdate` = :birthdate, 
                                        `service` = :service, 
                                        `adress` = :adress, 
                                        `tel` = :tel, 
                                        `email` = :email, 
                                        `password` = :pswd 
                                    WHERE `id` = :id");

            $stmtM->bindParam(':lname', $lname);
            $stmtM->bindParam(':fname', $fname);
            $stmtM->bindParam(':birthdate', $birthday);
            $stmtM->bindParam(':service', $service);
            $stmtM->bindParam(':adress', $adress);
            $stmtM->bindParam(':tel', $tel);
            $stmtM->bindParam(':email', $email);
            $stmtM->bindParam(':pswd', $pswd);
            $stmtM->bindParam(':id', $id); 

            $stmtM->execute();

        header('Location: ./dashboard.php');
    }
    ?>

    <script>
        document.querySelector(".addMoreTags").addEventListener("click", () => {
            document.querySelector("#tags").classList.toggle("hidden")
        })
    </script>
</body>

</html>