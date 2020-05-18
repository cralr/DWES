<?php
    include "config/parameters.php";
?>

<!DOCTYPE html>
	<head>
		<title><?php echo $TITULO ?></title>
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="css/normalize.css">
    	<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<header>
            <?php include "include/cabecera.php"; ?>
		</header>

		<main>
			<section>
                <?php 
                    if (isset($_GET["page"])){
                            if (($_GET["page"]=="home")) {
                                include "page/home.php"; 
							}                 
                    }else{
                        include "page/home.php";
                    }
                ?>
			</section>
		</main>
		<footer>
            <?php include "include/footer.php";?>
		</footer>
</html>