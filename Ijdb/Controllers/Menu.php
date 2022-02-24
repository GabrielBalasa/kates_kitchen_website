<?php
    namespace Ijdb\Controllers;
    use \CSY2028\DatabaseTable;
    use \CSY2028\Authentication;
    use \Datetime;
    class Menu
    {
        private $menuTable;
        private $categoriesTable;
        private $usersTable;
        private $authentication;

        public function __construct($menuTable, $categoriesTable, $usersTable, $authentication){
            $this->menuTable = $menuTable;
            $this->categoriesTable = $categoriesTable;
            $this->usersTable = $usersTable;
            $this->authentication = $authentication;
        }

        public function listByCategory(){ //List active menu by category
            $categories = $this->categoriesTable->findAll();
            $menu = $this->menuTable->findTwo('categoryId', $_REQUEST['id'], 'archived', 0);
            return [ 'template' => 'itemlist.html.php',
                'title' => 'Menu by category',
                'variables' => [
                    'menu' => $menu,
                    'categories' => $categories
                ]
            ];
        }

        public function manageActive(){ //List all the active menu items
            $user = $this->authentication->getUser();
            $categories = $this->categoriesTable->findAll();
            $menu = $this->menuTable->find('archived', 0);
            return [ 'template' => 'manageactiveitems.html.php',
                'title' => 'Active items',
                'variables' => [
                    'menu' => $menu,
                    'user' => $user,
                    'categories' => $categories
                ]
            ];
        }

        public function manageActiveCategory(){ //List all the active menu items by category
            $user = $this->authentication->getUser();
            $categories = $this->categoriesTable->findAll();
            $menu = $this->menuTable->findTwo('categoryId', $_REQUEST['id'], 'archived', 0);
            return [ 'template' => 'manageactiveitems.html.php',
                'title' => 'Active items',
                'variables' => [
                    'menu' => $menu,
                    'user' => $user,
                    'categories' => $categories
                ]
            ];
        }

        public function manageArchived(){ //List all the archived menu items
            $user = $this->authentication->getUser();
            $categories = $this->categoriesTable->findAll();
            $menu = $this->menuTable->find('archived', 1);
            return [ 'template' => 'managearchiveditems.html.php',
                'title' => 'Archived items',
                'variables' => [
                    'menu' => $menu,
                    'user' => $user,
                    'categories' => $categories
                ]
            ];
        }

        public function manageArchivedCategory(){ //List all the archived menu items by category
            $user = $this->authentication->getUser();
            $categories = $this->categoriesTable->findAll();
            $menu = $this->menuTable->findTwo('categoryId', $_REQUEST['id'], 'archived', 1);
            return [ 'template' => 'managearchiveditems.html.php',
                'title' => 'Archived items',
                'variables' => [
                    'menu' => $menu,
                    'user' => $user,
                    'categories' => $categories
                ]
            ];
        }

        public function editSubmit(){ //Edit an item
            $user = $this->authentication->getUser();
            if (isset($_GET['id'])) {
                $item = $this->menuTable->find('id', $_GET['id'])[0];
                if ($item->user_id != $user->id || !$user->getPermission(\Ijdb\Entity\User::EDIT_DELETE_ARCHIVE_MENU)) {
                    return;
                }
            }
            $item = $_POST['item'];
            $user->additem($item);
            header('location: /menu/manage/active');
        }

        public function editForm(){ //Edit an item form
            $user = $this->authentication->getUser();
            $categories = $this->categoriesTable->findAll();
            if (isset($_GET['id'])){
                $result = $this->menuTable->find('id', $_GET['id']);
                $item = $result[0];
            }
            return [
                'template' => 'edititem.html.php',
                'title' => 'Edit menu',
                'variables' => [ 'item' => $item ?? null,
                    'categories' => $categories,
                    'user' => $user
                ]
            ];
        }

        public function delete(){ //Delete function
            $user = $this->authentication->getUser();
            $item = $this->menuTable->find('id', $_POST['id'])[0];
            $this->menuTable->delete($item->id);
            header('location: /menu/manage/active');
        }

        public function archive(){ //Archive function
            $item = $_POST['menu'];
            $this->menuTable->update($item);
            header('location: /menu/manage/archived');
        }

        public function about(){ //Display all categories on about page
            return [
                'template' => 'about.html.php',
                'title' => 'About',
                'variables' => [
                    'categories' => $this->categoriesTable->findAll()
                ]
            ];
        }
    }