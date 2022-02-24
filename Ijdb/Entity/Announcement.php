<?php
    namespace Ijdb\Entity;
    class Announcement
    {
        public $usersTable;
        public $id;
        public $username;
        public $complete;
        public $user_id;
        

        public function __construct(\CSY2028\DatabaseTable $usersTable) {
            $this->usersTable = $usersTable;
        }

        public function getAdmin(){ //Get admin details
            return $this->usersTable->find('id', $this->user_id)[0];
        }
        
        public function getPermission($permission) { //Check admin permissions
            return $this->permission & $permission;
        }
    }