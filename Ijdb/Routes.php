<?php
    namespace Ijdb;
    class Routes implements \CSY2028\Routes 
    {
        private $usersTable;
        private $menuTable;
        private $bookingsTable;
        private $categoriesTable;
        private $authentication;
        private $announcementsTable;

        public function __construct(){
            require '../connection.php';
            $this->menuTable = new \CSY2028\DatabaseTable($pdo, 'menu', 'id', '\Ijdb\Entity\Menu', [&$this->categoriesTable, &$this->usersTable]);
            $this->categoriesTable = new \CSY2028\DatabaseTable($pdo, 'categories', 'id');
            $this->bookingsTable = new \CSY2028\DatabaseTable($pdo, 'bookings', 'id', '\Ijdb\Entity\Booking', [&$this->usersTable]);
            $this->usersTable = new \CSY2028\DatabaseTable($pdo, 'users', 'id', '\Ijdb\Entity\User', [&$this->menuTable, &$this->bookingsTable, &$this->announcementsTable]);
            $this->authentication = new \CSY2028\Authentication($this->usersTable, 'username', 'password');
            $this->announcementsTable = new \CSY2028\DatabaseTable($pdo, 'announcements', 'id', '\Ijdb\Entity\Announcement', [&$this->usersTable]);
        }

        public function checkPermission($permission): bool{
            $user = $this->authentication->getUser();
            if ($user && $user->getPermission($permission)){
                return true;
            } else {
                return false;
            }
        }

        public function getRoutes(): array{
            $menuController = new \Ijdb\Controllers\Menu($this->menuTable, $this->categoriesTable, $this->usersTable, $this->authentication);
            $categoryController = new \Ijdb\Controllers\Category($this->categoriesTable, $this->authentication);
            $bookingController = new \Ijdb\Controllers\Booking($this->bookingsTable, $this->usersTable, $this->authentication);
            $adminController = new \Ijdb\Controllers\Admin($this->authentication, $this->usersTable);
            $loginController = new \Ijdb\Controllers\Login($this->authentication);
            $announcementController = new \Ijdb\Controllers\Announcement($this->announcementsTable, $this->usersTable, $this->authentication);

            $routes= [
                '' => [
                    'GET' => [
                        'controller' => $announcementController,
                        'function' => 'home'
                    ]
                ],

                'home' => [
                    'GET' => [
                        'controller' => $announcementController,
                        'function' => 'home'
                    ]
                ],

                'announcement' => [
                    'GET' => [
                        'controller' => $announcementController,
                        'function' => 'announcementForm'
                    ],
                    'POST' => [
                        'controller' => $announcementController,
                        'function' => 'submitAnnouncement'
                    ]
                ],

                'about' => [
                    'GET' => [
                        'controller' => $menuController,
                        'function' => 'about'
                    ]
                ],

                'book' => [
                    'GET' => [
                        'controller' => $bookingController,
                        'function' => 'bookForm'
                    ],
                    'POST' => [
                        'controller' => $bookingController,
                        'function' => 'submitBooking'
                    ]
                ],

                'faq' => [
                    'GET' => [
                        'controller' => $bookingController,
                        'function' => 'faq'
                    ]
                ],

                'menu/list/category' => [
                    'GET' => [
                        'controller' => $menuController,
                        'function' => 'listByCategory'
                    ]
                ],

                'menu/manage/archived' => [
                    'GET' => [
                        'controller' => $menuController,
                        'function' => 'manageArchived'
                    ],
                    'login' => true,
                    'permission' => \Ijdb\Entity\User::EDIT_DELETE_ARCHIVE_MENU
                ],

                'menu/manage/archived/category' => [
                    'GET' => [
                        'controller' => $menuController,
                        'function' => 'manageArchivedCategory'
                    ],
                    'login' => true,
                    'permission' => \Ijdb\Entity\User::EDIT_DELETE_ARCHIVE_MENU
                ],

                'menu/manage/active' => [
                    'GET' => [
                        'controller' => $menuController,
                        'function' => 'manageActive'
                    ],
                    'login' => true,
                    'permission' => \Ijdb\Entity\User::EDIT_DELETE_ARCHIVE_MENU
                ],

                'menu/manage/active/category' => [
                    'GET' => [
                        'controller' => $menuController,
                        'function' => 'manageActiveCategory'
                    ],
                    'login' => true,
                    'permission' => \Ijdb\Entity\User::EDIT_DELETE_ARCHIVE_MENU
                ],

                'menu/edit' => [
                    'GET' => [
                        'controller' => $menuController,
                        'function' => 'editForm'
                    ],
                    'POST' => [
                        'controller' => $menuController,
                        'function' => 'editSubmit'
                    ],
                    'login' => true,
                    'permission' => \Ijdb\Entity\User::EDIT_DELETE_ARCHIVE_MENU
                ],

                'menu/delete' => [
                    'POST' => [
                        'controller' => $menuController,
                        'function' => 'delete'
                    ],
                    'login' => true,
                    'permission' => \Ijdb\Entity\User::EDIT_DELETE_ARCHIVE_MENU
                ],

                'menu/archive' => [
                    'POST' => [
                        'controller' => $menuController,
                        'function' => 'archive'
                    ],
                    'login' => true,
                    'permission' => \Ijdb\Entity\User::EDIT_DELETE_ARCHIVE_MENU
                ],

                'category/list' => [
                    'GET' => [
                            'controller' => $categoryController,
                            'function' => 'list'
                    ],
                    'login' => true,
                    'permission' => \Ijdb\Entity\User::ADD_EDIT_DELETE_CATEGORIES
                ],

                'category/edit' => [
                    'GET' => [
                        'controller' => $categoryController,
                        'function' => 'editForm'
                    ],
                    'POST' => [
                        'controller' => $categoryController,
                        'function' => 'editSubmit'
                    ],
                    'login' => true,
                    'permission' => \Ijdb\Entity\User::ADD_EDIT_DELETE_CATEGORIES
                ],

                'category/delete' => [
                    'POST' => [
                        'controller' => $categoryController,
                        'function' => 'delete'
                    ],
                    'login' => true,
                    'permission' => \Ijdb\Entity\User::ADD_EDIT_DELETE_CATEGORIES
                ],

                'accounts/register' => [
                    'GET' => [
                        'controller' => $adminController,
                        'function' => 'registrationForm'
                    ],
                    'POST' => [
                        'controller' => $adminController,
                        'function' => 'registerUser'
                    ],
                        'login' => true,
                        'permission' => \Ijdb\Entity\User::ADD_ACCOUNTS
                ],

                'accounts/admin' => [
                    'GET' => [
                        'controller' => $adminController,
                        'function' => 'manageadmins'
                    ],
                    'login' => true,
                    'permission' => \Ijdb\Entity\User::EDIT_ACCOUNTS
                ],

                'accounts/delete' => [
                    'POST' => [
                        'controller' => $adminController,
                        'function' => 'delete'
                    ],
                    'login' => true,
                    'permission' => \Ijdb\Entity\User::EDIT_ACCOUNTS
                ],

                'booking/active' => [
                    'GET' =>  [
                        'controller' => $bookingController,
                        'function' => 'listActive'
                ],
                    'login' => true,
                    'permission' => \Ijdb\Entity\User::LIST_CLOSE_BOOKINGS
                    ],

                'booking/closed' => [
                    'GET' => [
                        'controller' => $bookingController,
                        'function' => 'listClosed'
                    ],
                    'login' => true,
                    'permission' => \Ijdb\Entity\User::LIST_CLOSE_BOOKINGS
                ],

                'booking/close' => [
                    'POST' => [
                        'controller' => $bookingController,
                        'function' => 'close'
                    ],
                    'login' => true,
                            'permission' => \Ijdb\Entity\User::LIST_CLOSE_BOOKINGS
                ],

                'login/error' => [
                    'GET' => [
                        'controller' => $loginController,
                        'function' => 'error'
                    ]
                ],

                'login' => [
                    'GET' => [
                        'controller' => $loginController,
                        'function' => 'loginForm'
                    ],
                    'POST' => [
                        'controller' => $loginController,
                        'function' => 'processLogin'
                    ]
                ],

                'login/success' => [
                    'GET' => [
                        'controller' => $loginController,
                        'function' => 'success'
                    ],
                    'login' => true
                ],

                'logout' => [
                    'GET' => [
                        'controller' => $loginController,
                        'function' => 'logout'
                    ]
                ],

                'user/permissions' => [
                    'GET' => [
                        'controller' => $adminController,
                        'function' => 'permissions'
                    ],
                    'POST' => [
                        'controller' => $adminController,
                        'function' => 'savePermissions'
                    ],
                    'login' => true,
                    'permission' => \Ijdb\Entity\User::EDIT_ACCOUNTS
                ],

                'register' => [
                    'GET' => [
                        'controller' => $adminController,
                        'function' => 'registrationForm'
                    ],
                    'POST' => [
                        'controller' => $adminController,
                        'function' => 'registerUser'
                    ]
                ],

                'registration/success' => [
                    'GET' => [
                        'controller' => $adminController,
                        'function' => 'registrationSuccess'
                    ]
                ],

                'announcement/active' => [
                    'GET' =>  [
                        'controller' => $announcementController,
                        'function' => 'listActive'
                    ],
                    'login' => true,
                    'permission' => \Ijdb\Entity\User::LIST_CLOSE_ANNOUNCEMENTS
                ],

                'announcement/closed' => [
                    'GET' => [
                        'controller' => $announcementController,
                        'function' => 'listClosed'
                    ],
                    'login' => true,
                    'permission' => \Ijdb\Entity\User::LIST_CLOSE_ANNOUNCEMENTS
                ],

                'announcement/close' => [
                    'POST' => [
                        'controller' => $announcementController,
                        'function' => 'close'
                    ],
                    'login' => true,
                    'permission' => \Ijdb\Entity\User::LIST_CLOSE_ANNOUNCEMENTS
                ],

                'login/error' => [
                    'GET' => [
                        'controller' => $loginController,
                        'function' => 'error'
                    ]
                ],

                'login' => [
                    'GET' => [
                        'controller' => $loginController,
                        'function' => 'loginForm'
                    ],
                    'POST' => [
                        'controller' => $loginController,
                        'function' => 'processLogin'
                    ]
                ]
            ];
            return $routes;
        }

        public function getLayoutVariables(){
            return [
                'loggedIn' => $this->authentication->loggedIn(),
                'categories' => $this->categoriesTable->findAll()
            ];
        }

        public function authentication(): \CSY2028\Authentication {
            return $this->authentication;
        }
    }
?>