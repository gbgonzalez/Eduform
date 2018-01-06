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
    <?= $this->Html->css('styleDefault.css') ?>
    <?= $this->Html->css('index.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div class="container">
        <div class="col-md-12">
          <nav class="navbar navbar-default navbarInformation">
            <div class="container-fluid">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span> 
                </button>
                <a class="navbar-brand" href="/Eduform">Eduform</a>
              </div>
              <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                  <li><a href="/eduform/information">Información</a></li>
                  <li><a href="/eduform/contact">Contacto</a></li> 
                  <li>
                      <a href="#" data-toggle="modal" data-target="#add">Clientes</a>
                  </li> 
                </ul>
              </div>
            </div>
          </nav>
        </div>
        
        <div class="container clearfix">
            <?= $this->fetch('content') ?>
        </div>
    <footer>
      <div class="col-md-4">
      </div>
      <div class="col-md-4">
      </div>
          <div class="col-md-4">
            <div class="footerRight">
              <p>&#9400; Copyright EDUFORM 2017</p>
              <p><a href="#"> Contacto </a></p>
              <p><a href="#"> Información </a></p>
            </div>
        </div>

        <?= $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js', array('inline' => false)); ?>
        <?= $this->Html->script('bootstrap.min.js') ?>

    </footer>

</body>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
     <?= $this->Html->script('bootstrap.min.js'); ?>
</html>

