<?php
    namespace CSY2028;
    interface Routes
    {
        public function getRoutes(): array;
        public function authentication(): \CSY2028\Authentication;
        public function checkPermission($permission): bool;
        public function getLayoutVariables();
    }