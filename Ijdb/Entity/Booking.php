<?php
    namespace Ijdb\Entity;
    class Booking
    {
        public $usersTable;
        public $id;
        public $username;
        public $role;
        public $permission;
        
        public function __construct(\CSY2028\DatabaseTable $usersTable) {
            $this->usersTable = $usersTable;
        }

        public function getAdmin(){ //Get admin details
            return $this->usersTable->find('id', $this->admin_id)[0];
        }
    }