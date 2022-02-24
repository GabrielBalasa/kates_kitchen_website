<?php
    namespace Ijdb\Controllers;
    class Category
    {
        private $categoriesTable;
        private $authentication;

        public function __construct($categoriesTable, $authentication)
        {
            $this->categoriesTable = $categoriesTable;
            $this->authentication = $authentication;
        }

        public function list(){ //List all categories
            $user = $this->authentication->getUser();
            $categories = $this->categoriesTable->findAll();
            return [
                'template' => 'categorylist.html.php',
                'title' => 'Manage categories' ,
                'variables' => [
                    'categories' => $categories,
                    'user' => $user
                ]
            ];
        }

        public function delete(){ //Delete a category
            $user = $this->authentication->getUser();
            $category = $this->categoriesTable->find('id', $_POST['id'])[0];
            if (!$user->getPermission(\Ijdb\Entity\User::ADD_EDIT_DELETE_CATEGORIES)){
                return;
            }
            $this->categoriesTable->delete($category->id);
            header('location: /category/list');
        }

        public function editForm(){ //Edit/New a category
            $user = $this->authentication->getUser();
            if (isset($_GET['id'])){
                $result = $this->categoriesTable->find('id', $_GET['id']);
                $category = $result[0];
            }
            return [
                'template' => 'editcategory.html.php',
                'title' => 'Edit categories',
                'variables' => [
                    'category' => $category ?? null,
                    'user' => $user
                ]
            ];
        }

        public function editSubmit(){ //Submit edit/new category
            $category = $_POST['category'];
            $this->categoriesTable->save($category);
            header('location: /category/list');
        }
    }