<?php

class DataModel {
    private $dataFile = 'data/sample_data.json';

    public function getData($filters = '') {
        if (!file_exists($this->dataFile)) return [];

        $json = file_get_contents($this->dataFile);
        $records = json_decode($json, true);

        if (!$filters) return $records;
        return $this->filterData($records,$filters);
    }


    private function filterData($records,$filters){

            $records = array_filter($records, function ($item) use ($filters) {
                return
                    (stripos($item['name'], $filters) !== false) ||
                    (stripos($item['email'], $filters) !== false) ||
                    (stripos($item['designation'], $filters) !== false) ||
                    ($this->matchStack($item['stack'], $filters));
                   //array_filter($item['stack'],fn($tech) => stripos($tech,$filters) !==false);
            });
        return $records;
    }

    private function matchStack($stackArray, $search) {
        foreach ($stackArray as $tech) {
            if (stripos($tech, $search) !== false) return true;
        }
        return false;
    }
}
