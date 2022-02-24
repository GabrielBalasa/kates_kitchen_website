<?php
    namespace Ijdb\Entity;
    class Menu 
    {
        public $categoriesTable;
        public $usersTable;
        public $id;
        public $title;
        public $categoryId;

        public function __construct(\CSY2028\DatabaseTable $categoriesTable, $usersTable) {
            $this->categoriesTable = $categoriesTable;
            $this->usersTable = $usersTable;
        }

        public function getCategory(){ //Get categories details
            return $this->categoriesTable->find('id', $this->categoryId)[0];
        }
        
        public function getUser(){ //Get user details
            return $this->usersTable->find('id', $this->user_id)[0];
        }
    }