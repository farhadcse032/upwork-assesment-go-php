<?php
require_once 'models/DataModel.php';

class DataController {
    public function handleRequest() {
        $model = new DataModel();
        $filters = $_GET['queries'] ?? '';
        $data = $model->getData($filters);
        require 'views/datatable.php';
    }
}
