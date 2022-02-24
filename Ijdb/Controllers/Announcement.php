<?php
    namespace Ijdb\Controllers;
    class Announcement
    {
        private $announcementsTable;
        private $usersTable;
        private $authentication;

        public function __construct($announcementsTable, $usersTable, $authentication)
        {
            $this->announcementsTable = $announcementsTable;
            $this->usersTable = $usersTable;
            $this->authentication = $authentication;
        }

        public function home(){ //List announcements on home page
            $announcements = $this->announcementsTable->order('id', 'closed', 1);
            return [
                'template' => 'home.html.php',
                'title' => 'Home',
                'variables' => [
                    'announcements' => $announcements
                ]
            ];
        }

        public function listActive(){ //List active announcements for admin approval
            $user = $this->authentication->getUser();
            $announcements = $this->announcementsTable->find('closed', 0);
            $title = 'Announcements';
            return [ 
                'template' => 'activeannouncements.html.php',
                'title' => $title,
                'variables' => [
                    'announcements' => $announcements,
                    'user' => $user
                ]
            ];
        }

        public function listClosed(){ //List closed announcements list
            $user = $this->authentication->getUser();
            $announcements = $this->announcementsTable->find('closed', 1);
            $title = 'Completed announcements';
            return [ 
                'template' => 'closedannouncements.html.php',
                'title' => $title,
                'variables' => [
                    'announcements' => $announcements,
                    'user' => $user
                ]
            ];
        }

        public function close(){ //Approve an announcement
            $user = $this->authentication->getUser();
            if (!$user->getPermission(\Ijdb\Entity\User::LIST_CLOSE_ANNOUNCEMENTS)) {
                return;
            }
            $announcement = $_POST['announcement'];
            $user->completeAnnouncement($announcement);
            header('location: /announcement/closed');
        }

        public function announcementForm(){ //Display announcement form
            $user = $this->authentication->getUser();
            return [
                'template' => 'announcement.html.php',
                'title' => 'Announcement',
                'variables' => [
                    'user' => $user
                ]
            ];
        }

        public function submitAnnouncement(){ //Submit new announcement
            $user = $this->authentication->getUser();
            $announcement = $_POST['announcement'];
            $user->addAnnouncement($announcement);
            header('location: /announcement/active');
        }
    }