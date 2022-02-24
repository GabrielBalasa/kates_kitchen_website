<?php
    namespace Ijdb\Entity;
    class User
    {
        const ADD_MENU = 1;
        const EDIT_DELETE_ARCHIVE_MENU = 2;
        const ADD_EDIT_DELETE_CATEGORIES = 4;
        const LIST_CLOSE_ANNOUNCEMENTS = 8;
        const LIST_CLOSE_BOOKINGS = 16;
        const ADD_ACCOUNTS = 32;
        const EDIT_ACCOUNTS = 64;
        private $permission;
        private $menuTable;
        private $bookingsTable;
        private $announcementsTable;

        public function __construct(\CSY2028\DatabaseTable $menuTable, $bookingsTable, $announcementsTable)
        {
            $this->menuTable = $menuTable;
            $this->bookingsTable = $bookingsTable;
            $this->announcementsTable = $announcementsTable;
        }

        // Code from PHP & MySQL: Novice to Ninja 6th Edition
        public function getPermission($permission){ //Check user permissions
            return $this->permission & $permission;
        }

        public function addItem($item){ //Add new item
            $item['user_id'] = $this->id;
            $this->menuTable->save($item);
        }

        public function completeBooking($booking){ //Approve booking
            $booking['admin_id'] = $this->id;
            $this->bookingsTable->update($booking);
        }

        public function completeannouncement($announcement){ //Approve announcement
            $announcement['user_id'] = $this->id;
            $this->announcementsTable->update($announcement);
        }

        public function addAnnouncement($announcement){ //Add new announcement
            $announcement['user_id'] = $this->id;
            $this->announcementsTable->save($announcement);
        }
    }