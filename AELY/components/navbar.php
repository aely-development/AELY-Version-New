    <?php 
        require_once 'config/config.php';
        $sth = $pdo->prepare("SELECT COUNT(*), `nm_genero` 
        FROM `jogo` GROUP BY `nm_genero` ORDER BY `nm_genero`");
        $sth->execute();
        $genero = $sth->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="container-nav main-navbar shadow-sm sticky-top">
        <div class="top-navbar">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2 my-auto d-none d-sm-none d-md-block d-lg-block">
                        <h5 class="brand-name">AELY</h5>
                    </div>
                    <div class="col-md-5 my-auto">
                        <form role="search" method="POST" action="busca.php">
                            <div class="input-group">
                                <input type="search" name="busca" placeholder="Pesquise o Produto" class="form-control" style="margin-right:auto"/>
                                <button class="btn bg-white" style="position:absolute;margin-left:auto" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-5 my-auto">
                        <ul class="nav justify-content-end">
                            
                        <?php if(session_status() == PHP_SESSION_ACTIVE&&(isset($_SESSION['adm']))){?>
                            <?php if($_SESSION['adm']==1){?>
                            <li class="nav-item">
                                <a class="nav-link" href="menuAdm.php">
                                    <i class=""></i> MenuAdm
                                </a>
                            </li>
                            <?php }else{?>
                                <li class="nav-item">
                                <a class="nav-link" href="carrinho.php">
                                    <i class="fa fa-shopping-cart"></i> Carrinho
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fa fa-heart"></i> Lista de Desejos
                                </a>
                            </li>
                            <?php }}else{?>
                                <li class="nav-item">
                                <a class="nav-link" href="carrinho.php">
                                    <i class="fa fa-shopping-cart"></i> Carrinho
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fa fa-heart"></i> Lista de Desejos
                                </a>
                            </li>    
                            <?php }?>
                                <?php if(session_status() == PHP_SESSION_ACTIVE && (!empty($_SESSION['emailUser']))){ ?>
                                <a class="nav-link" href="functions/logoff.php" role="button" aria-expanded="false">
                                    <i class="fa fa-user"></i> Logoff 
                                </a>
                            <?php }else{?>
                                <a class="nav-link" href="login.php" role="button" aria-expanded="false">
                                <i class="fa fa-user"></i> Login
                            </a>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand d-block d-sm-block d-md-none d-lg-none" href="#">
                    
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Início</a>
                        </li>
                        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                            <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Categorias
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                <?php foreach($genero as $linha){?>
                                    <li><a class="dropdown-item" href="categorias.php?genero=<?php echo $linha['nm_genero'];?>"><?php echo $linha['nm_genero'];?></a></li>
                                <?php }?>
                                </ul>
                                </li>
                            </ul>
                        </div>
    
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <style>
        .container-nav {
            background-color: #583c87;
        }
        .nav-link{
            color: #fff;
            text-decoration:none;
        }
        .nav-link:hover{
            color: #000;
            text-decoration:none;
        }
    </style>