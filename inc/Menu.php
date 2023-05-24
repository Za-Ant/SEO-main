<?php
    class Menu
    {
        public $menu;

        function __construct($menu)
        {
            $this->menu = $menu;
        }
        function get_menu()
        {
            return $this->menu;
        }
    }
    $Header_menu = new Menu(array("Home"=>"index.php",
                                  "Features"=>"features.php",
                                  "About Us"=>"about_as.php",
                                  "Services"=>"services.php",
                                  "Portfolio"=>"portfolio.php",
                                  "Contact Us"=>"contact.php",
                                ));