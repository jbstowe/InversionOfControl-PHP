<?php
require_once 'IoC.php';
require_once ... any classes used in IoC class;
IoC::getInstance();

//Classes ready to use with all dependencies injected!!
//You can also register classes here if you don't want to in the constructor of the IoC class