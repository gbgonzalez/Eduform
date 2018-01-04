<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'EDUFORM - Zona administrativa';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    
    <?php echo $this->Html->meta('icon', '/img/favicon.ico') ?>

    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('adminStyle.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body ng-app="eduform" ng-cloak>
    <div class="container">

        <div class="col-md-12">
            <nav id="navbarPublic" class="visible-lg">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active">
                        <?php
                        echo $this->Html->link(
                            'Inicio',
                            '/eduform/home'
                        );
                        ?>
                    </li>
                    <li>
                        <?php
                        echo $this->Html->link(
                            'Mi perfil',
                            '/users/view'
                        );
                        ?>
                    </li>
                    
                    <?php 
                    if( $current_user['role'] == 'Administrador')
                    {
                    ?>

                        <li>
                            <?php
                                echo $this->Html->link(
                                    'Usuarios',
                                    '/users/'
                                );
                            ?>
                        </li>
                        <li>
                            <?php
                            echo $this->Html->link(
                                'Categorias',
                                '/categories/'
                            );
                            ?>
                        </li>
                        <li>
                            <?php

                            echo $this->Html->link(
                                'Materias',
                                '/subjects/'
                            );
                            ?>
                        </li>
                    <?php
                    }
                    if( $current_user['role'] != 'Alumno')
                    {
                    ?>
                        <li>
                            <?php
                            echo $this->Html->link(
                                'Competencias',
                                '/competences'
                            );
                            ?>
                        </li>
                        <li>
                            <?php
                            echo $this->Html->link(
                                'Contenidos',
                                '/contents/'
                            );
                            ?>
                        </li>
                        <li>
                            <?php
                            echo $this->Html->link(
                                'Evaluaciones',
                                '/competences/evaluation'
                            );
                            ?>
                        </li>
                    <?php } ?>
                  

                    <li>
                         <?php
                        echo $this->Html->link(
                            'Desconectar',
                            '/users/logout'
                        );
                        ?>
                    </li>
                </ul>
            </nav>
            <!-- navbar mobile -->
            <nav class="navbar navbar-default hidden-lg navbarMobile">
                <div class="container-fluid">
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Eduform</a>
                  </div>
                  <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                      <li class="active">
                            <?php echo $this->Html->link('Inicio','/eduform/home');?>
                        </li>
                        <li>
                            <?php echo $this->Html->link('Mi perfil','/users/view');?>
                        </li>
                    
                        <?php 
                        if( $current_user['role'] == 'Administrador')
                        {
                        ?>
                            <li>
                                <?php echo $this->Html->link('Usuarios','/users/');?>
                            </li>
                            <li>
                                <?php echo $this->Html->link('Categorias','/categories/');?>
                            </li>
                            <li>
                                <?php echo $this->Html->link('Materias','/subjects/'); ?>
                            </li>
                        <?php
                        }
                        if( $current_user['role'] != 'Alumno')
                        {
                        ?>
                            <li>
                                <?php
                                    echo $this->Html->link('Competencias','/competences');
                                ?>
                            </li>
                            <li>
                                <?php echo $this->Html->link('Contenidos','/contents/'); ?>
                            </li>
                            <li>
                                <?php echo $this->Html->link('Evaluaciones','/competences/evaluation'); ?>
                            </li>
                            <?php 
                        } ?>
                        <li>
                            <?php echo $this->Html->link('Desconectar','/users/logout');?>
                        </li>
                    </ul>
                  </div><!--/.nav-collapse -->
                </div><!--/.container-fluid -->
              </nav>
        </div>
        
        <div class="container clearfix">
            <?= $this->fetch('content') ?>
        </div>
        <footer class="visible-lg">
            <div class="col-md-4">
                

            </div>
            <div class="col-md-4">
                

            </div>
            <div class="col-md-4">

                <p class="copyrightFooter">&copy 2017 EDUFORM </p>

            </div>
        </footer>

</body>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
     <?= $this->Html->script('bootstrap.min.js'); ?>
</html>

