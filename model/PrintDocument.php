<?php

require_once ('model/DB.php');

class PrintDocument {

    public function __construct($contract, $status) {

        $this->id = $contract;
        (is_array($status)) ? $this->status = 'IN (' . implode(', ', $status) . ')' : $this->status = $status;

    }

    public function getData() {

        $query = 'SELECT cu.name_customer, cu.company, co.number, co.date_sign, CONCAT (s.title_service, \' = \', s.status) as services_name
                  FROM obj_contracts co
                  JOIN obj_customers cu
                  ON co.id_customer = cu.id_customer
                  LEFT JOIN obj_services s
                  ON co.id_contract = s.id_contract
                  WHERE co.id_contract = ' . $this->id .
                  ' AND s.status ' . $this->status . ';';

        $result = DB::getInstance()->connection->query($query);

        if(!$result->num_rows) {

            $this->document['number'] = 'Contract with such options not exists!';

        } else {

            while ($row = $result->fetch_assoc()) {

                $data[] = $row;

            }

            $this->document = $data[0];

            for ($i = 1; $i<count($data); $i++) {

                $this->document['services_name'] .= ('<br>' . $data[$i]['services_name']);

            }

        }

        $result->free_result();
        echo json_encode($this->document);

    }

}