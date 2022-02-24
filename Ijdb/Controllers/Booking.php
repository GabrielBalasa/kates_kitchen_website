<?php
    namespace Ijdb\Controllers;
    class Booking 
    {
        private $bookingsTable;
        private $usersTable;
        private $authentication;

        public function __construct($bookingsTable, $usersTable, $authentication)
        {
            $this->bookingsTable = $bookingsTable;
            $this->usersTable = $usersTable;
            $this->authentication = $authentication;
        }

        public function listActive(){ //List active bookings for admin approval
            $user = $this->authentication->getUser();
            $bookings = $this->bookingsTable->find('closed', 0);
            $title = 'bookings';
            return [ 
                'template' => 'activebookings.html.php',
                'title' => $title,
                'variables' => [
                    'bookings' => $bookings,
                    'user' => $user
                ]
            ];
        }

        public function listClosed(){ //List approved bookings
            $user = $this->authentication->getUser();
            $bookings = $this->bookingsTable->find('closed', 1);
            $title = 'Completed bookings';
            return [ 
                'template' => 'closedbookings.html.php',
                'title' => $title,
                'variables' => [
                    'bookings' => $bookings,
                    'user' => $user
                ]
            ];
        }

        public function close(){ //Approve a booking
            $user = $this->authentication->getUser();
            if (!$user->getPermission(\Ijdb\Entity\User::LIST_CLOSE_BOOKINGS)) {
                return;
            }
            $booking = $_POST['booking'];
            $user->completeBooking($booking);
            header('location: /booking/closed');
        }

        public function bookForm(){ //Display booking form
            return [
                'template' => 'book.html.php',
                'title' => 'Book',
                'variables' => []
            ];
        }

        public function submitBooking(){ //Submit a new booking
            $booking = $_POST['booking'];
            $this->bookingsTable->save($booking);
            return  [
                'template' => 'success.html.php',
                'title' => 'Success',
                'variables' => []
            ];
        }
    }