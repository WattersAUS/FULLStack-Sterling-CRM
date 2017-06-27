<?php
class Asset {
    // database connection and table name
    private $conn;

    // object properties (asset data first, related after)
    public $asset_id;
    public $asset_type_id;
    public $asset_employee_id;
    public $asset_name;
    public $asset_date_allocated;
    public $asset_date_to_service;
    public $asset_make;
    public $asset_model;
    public $asset_serial_number;
    public $asset_internal_id;
    public $asset_in_service_date;
    public $asset_total_cost;
    public $asset_purchase_date;
    public $asset_depreciation_years;
    public $asset_depreciation_rate;
    public $asset_book_value;
    public $asset_supplier_id;
    public $asset_tracker_id;
    public $asset_allocated_employee_id;
    public $asset_allocation_status;
    public $asset_location;
    public $asset_notes;
    public $asset_condition;
    public $asset_date_updated;

    public $allocated_by_user_id;
    public $allocated_by_first_name;
    public $allocated_by_last_name;
    public $allocated_by_full_name;

    public $supplier_name;

    public $allocated_to_division;
    public $allocated_to_user_id;
    public $allocated_to_first_name;
    public $allocated_to_last_name;
    public $allocated_to_full_name;

    public $query;
    public $numrows;
    public $data;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    private function initialiseJSON() {
        $this->data            = array();
        $this->data["records"] = array();
        $this->data["count"]   = 0;
        $this->data["success"] = "Fail";
        return;
    }

    private function setDefaultAllocatedQuery() {
        return "SELECT a.id AS asset_id,
                        a.asset_type_id,
                        a.employee_id AS asset_employee_id,
                        a.name AS asset_name,
                        a.date_allocated AS asset_date_allocated,
                        a.date_to_service AS asset_date_to_service,
                        a.make AS asset_make,
                        a.model AS asset_model,
                        a.serial_number AS asset_serial_number,
                        a.internal_id AS asset_internal_id,
                        a.in_service_date AS asset_in_service_date,
                        a.total_cost AS asset_total_cost,
                        a.purchase_date AS asset_purchase_date,
                        a.depreciation_years AS asset_depreciation_years,
                        a.depreciation_rate AS asset_depreciation_rate,
                        a.book_value AS asset_book_value,
                        COALESCE(a.supplier_id, 0) AS asset_supplier_id,
                        a.tracker_id AS asset_tracker_id,
                        a.allocated_employee_id AS asset_allocated_by_employee_id,
                        a.allocation_status AS asset_allocation_status,
                        a.location AS asset_location,
                        a.notes AS asset_notes,
                        a.condition AS asset_condition,
                        a.date_updated AS asset_date_updated,
                        u.id AS allocated_by_user_id,
                        u.first_name AS allocated_by_first_name,
                        u.last_name AS allocated_by_last_name,
                        COALESCE(s.name, 'n/a') AS supplier_name,
                        d.description AS allocated_to_division,
                        au.id AS allocated_to_user_id,
                        au.first_name AS allocated_to_first_name,
                        au.last_name AS allocated_to_last_name
                    FROM asset a
                    LEFT JOIN employee e ON a.employee_id = e.id
                    LEFT JOIN user u ON e.user_id = u.id
                    LEFT JOIN supplier s ON a.supplier_id = s.id
                    LEFT JOIN employee ae ON a.allocated_employee_id = ae.id
                    LEFT JOIN division d ON ae.division_id = d.id
                    LEFT JOIN user au ON ae.user_id = au.id
                    WHERE a.allocation_status = true";
    }

    private function setDefaultUnallocatedQuery() {
        return "SELECT a.id AS asset_id,
                        a.asset_type_id,
                        a.employee_id AS asset_employee_id,
                        a.name AS asset_name,
                        a.date_allocated AS asset_date_allocated,
                        a.date_to_service AS asset_date_to_service,
                        a.make AS asset_make,
                        a.model AS asset_model,
                        a.serial_number AS asset_serial_number,
                        a.internal_id AS asset_internal_id,
                        a.in_service_date AS asset_in_service_date,
                        a.total_cost AS asset_total_cost,
                        a.purchase_date AS asset_purchase_date,
                        a.depreciation_years AS asset_depreciation_years,
                        a.depreciation_rate AS asset_depreciation_rate,
                        a.book_value AS asset_book_value,
                        COALESCE(a.supplier_id, 0) AS asset_supplier_id,
                        a.tracker_id AS asset_tracker_id,
                        a.allocated_employee_id AS asset_allocated_employee_id,
                        a.allocation_status AS asset_allocation_status,
                        a.location AS asset_location,
                        a.notes AS asset_notes,
                        a.condition AS asset_condition,
                        a.date_updated AS asset_date_updated,
                        u.id AS allocated_by_user_id,
                        u.first_name AS allocated_by_first_name,
                        u.last_name AS allocated_by_last_name,
                        COALESCE(s.name, 'n/a') AS supplier_name,
                        '' AS allocated_to_division,
                        0 AS allocated_to_user_id,
                        '' AS allocated_to_first_name,
                        '' AS allocated_to_last_name
                    FROM asset a
                    LEFT JOIN employee e ON a.employee_id = e.id
                    LEFT JOIN user u ON e.user_id = u.id
                    LEFT JOIN supplier s ON a.supplier_id = s.id
                    WHERE a.allocation_status = false";
    }

    private function setDefaultQuery() {
        $this->query = $this->setDefaultAllocatedQuery()." UNION ".$this->setDefaultUnallocatedQuery();
        return;
    }

    private function setDefaultQueryByID($id) {
        $this->query  = $this->setDefaultAllocatedQuery().$this->setAssetID($id)." UNION ".$this->setDefaultUnallocatedQuery().$this->setAssetID($id);
        return;
    }

    private function setAssetID($id) {
        return " AND a.id = ".$id;
    }

    private function buildRowArray($row) {
        $item = array(
            "asset_id"                       => $row['asset_id'],
            "asset_type_id"                  => $row['asset_type_id'],
            "asset_employee_id"              => $row['asset_employee_id'],
            "asset_name"                     => $row['asset_name'],
            "asset_date_allocated"           => $row['asset_date_allocated'],
            "asset_date_to_service"          => $row['asset_date_to_service'],
            "asset_make"                     => $row['asset_make'],
            "asset_model"                    => $row['asset_model'],
            "asset_serial_number"            => $row['asset_serial_number'],
            "asset_internal_id"              => $row['asset_internal_id'],
            "asset_in_service_date"          => $row['asset_in_service_date'],
            "asset_total_cost"               => $row['asset_total_cost'],
            "asset_purchase_date"            => $row['asset_purchase_date'],
            "asset_depreciation_years"       => $row['asset_depreciation_years'],
            "asset_depreciation_rate"        => $row['asset_depreciation_rate'],
            "asset_book_value"               => $row['asset_book_value'],
            "asset_supplier_id"              => $row['asset_supplier_id'],
            "asset_tracker_id"               => $row['asset_tracker_id'],
            "asset_allocated_by_employee_id" => $row['asset_allocated_by_employee_id'],
            "asset_allocation_status"        => $row['asset_allocation_status'],
            "asset_location"                 => $row['asset_location'],
            "asset_notes"                    => $row['asset_notes'],
            "asset_condition"                => $row['asset_condition'],
            "asset_date_updated"             => $row['asset_date_updated'],
            "allocated_by_user_id"           => $row['allocated_by_user_id'],
            "allocated_by_first_name"        => $row['allocated_by_first_name'],
            "allocated_by_last_name"         => $row['allocated_by_last_name'],
            "allocated_by_full_name"         => $row['allocated_by_last_name'].', '.$row['allocated_by_first_name'],
            "supplier_name"                  => $row['supplier_name'],
            "allocated_to_division"          => $row['allocated_to_division'],
            "allocated_to_user_id"           => $row['allocated_to_user_id'],
            "allocated_to_first_name"        => $row['allocated_to_first_name'],
            "allocated_to_last_name"         => $row['allocated_to_last_name']
        );
        if ($item["allocated_to_user_id"] == 0) {
            $item["allocated_to_full_name"] = "Unallocated";
        } else {
            $item["allocated_to_full_name"] = $row['allocated_to_last_name'].', '.$row['allocated_to_first_name'];
        }
        return($item);
    }

    public function getAssetByID($asset_id) {
        $this->initialiseJSON();
        $this->setDefaultQueryByID($asset_id);
        $stmt = $this->conn->prepare($this->query);
        $stmt->execute();
        $this->numRows = 0;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->numRows += 1;
            array_push($this->data["records"], $this->buildRowArray($row));
        }
        if ($this->numRows > 0) {
            $this->data["success"] = "Ok";
            $this->data["count"]   = $this->numRows;
        }
        return json_encode($this->data);
    }

    public function getAllAssets() {
        $this->initialiseJSON();
        $this->setDefaultQuery();
        $stmt = $this->conn->prepare($this->query);
        $stmt->execute();
        $this->numRows = 0;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->numRows += 1;
            array_push($this->data["records"], $this->buildRowArray($row));
        }
        if ($this->numRows > 0) {
            $this->data["success"] = "Ok";
            $this->data["count"]   = $this->numRows;
        }
        return json_encode($this->data);
    }

    public function insertAsset() {
        $this->initialiseJSON();
        $query  = "INSERT INTO asset (asset_type_id, employee_id, name, date_allocated, date_to_service, make, model, serial_number, internal_id, in_service_date, total_cost, purchase_date, depreciation_years, depreciation_rate, book_value, supplier_id, allocated_employee_id, allocation_status, location, notes, condition, date_updated) ";
        $query .= " VALUES (:asset_type_id, :employee_id, :name, :date_allocated, :date_to_service, :make, :model, :serial_number, :internal_id, :in_service_date, :total_cost, :purchase_date, :depreciation_years, :depreciation_rate, :book_value, :supplier_id, :allocated_employee_id, :allocation_status, :location, :notes, :condition, now())";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':asset_type_id',            $this->asset_type_id);
        $stmt->bindParam(':employee_id',              $this->asset_employee_id);
        $stmt->bindParam(':name',                     htmlspecialchars(strip_tags($this->asset_name)));
        $stmt->bindParam(':date_allocated',           $this->asset_date_allocated);
        $stmt->bindParam(':date_to_service',          $this->asset_date_to_service);
        $stmt->bindParam(':make',                     htmlspecialchars(strip_tags($this->asset_make)));
        $stmt->bindParam(':model',                    htmlspecialchars(strip_tags($this->asset_model)));
        $stmt->bindParam(':serial_number',            htmlspecialchars(strip_tags($this->asset_serial_number)));
        $stmt->bindParam(':internal_id',              htmlspecialchars(strip_tags($this->asset_internal_id)));
        $stmt->bindParam(':in_service_date',          htmlspecialchars(strip_tags($this->asset_in_service_date)));
        $stmt->bindParam(':total_cost',               $this->asset_total_cost);
        $stmt->bindParam(':purchase_date',            $this->asset_purchase_date);
        $stmt->bindParam(':depreciation_years',       $this->asset_depreciation_years);
        $stmt->bindParam(':depreciation_rate',        $this->asset_depreciation_rate);
        $stmt->bindParam(':book_value',               $this->asset_book_value);
        $stmt->bindParam(':supplier_id',              $this->asset_supplier_id);
        $stmt->bindParam(':tracker_id',               htmlspecialchars(strip_tags($this->asset_tracker_id)));
        $stmt->bindParam(':allocated_by_employee_id', $this->asset_allocated_by_employee_id);
        $stmt->bindParam(':allocation_status',        $this->asset_allocation_status);
        $stmt->bindParam(':location',                 htmlspecialchars(strip_tags($this->asset_location)));
        $stmt->bindParam(':notes',                    htmlspecialchars(strip_tags($this->asset_notes)));
        $stmt->bindParam(':condition',                htmlspecialchars(strip_tags($this->asset_condition)));
        if ($stmt->execute()) {
            $this->data["id"]      = $this->conn->lastInsertId();
            $this->data["success"] = "Ok";
            $this->data["count"]   = 1;
        }
        return json_encode($this->data);
    }

    public function updateAsset() {
        $this->initialiseJSON();
        $query = "UPDATE asset SET asset_type_id          = :asset_type_id,
                                    employee_id           = :employee_id,
                                    name                  = :name,
                                    date_allocated        = :date_allocated,
                                    date_to_service       = :date_to_service,
                                    make                  = :make,
                                    model                 = :model,
                                    serial_number         = :serial_number,
                                    internal_id           = :internal_id,
                                    in_service_date       = :in_service_date,
                                    total_cost            = :total_cost,
                                    purchase_date         = :purchase_date,
                                    depreciation_years    = :depreciation_years,
                                    depreciation_rate     = :depreciation_rate,
                                    book_value            = :book_value,
                                    supplier_id           = :supplier_id,
                                    allocated_employee_id = :allocated_employee_id,
                                    allocation_status     = :allocation_status,
                                    location              = :location,
                                    notes                 = :notes,
                                    condition             = :condition,
                                    date_updated          = now()
                    WHERE id = :id";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':asset_type_id',            $this->asset_type_id);
        $stmt->bindParam(':employee_id',              $this->asset_employee_id);
        $stmt->bindParam(':name',                     htmlspecialchars(strip_tags($this->asset_name)));
        $stmt->bindParam(':date_allocated',           $this->asset_date_allocated);
        $stmt->bindParam(':date_to_service',          $this->asset_date_to_service);
        $stmt->bindParam(':make',                     htmlspecialchars(strip_tags($this->asset_make)));
        $stmt->bindParam(':model',                    htmlspecialchars(strip_tags($this->asset_model)));
        $stmt->bindParam(':serial_number',            htmlspecialchars(strip_tags($this->asset_serial_number)));
        $stmt->bindParam(':internal_id',              htmlspecialchars(strip_tags($this->asset_internal_id)));
        $stmt->bindParam(':in_service_date',          htmlspecialchars(strip_tags($this->asset_in_service_date)));
        $stmt->bindParam(':total_cost',               $this->asset_total_cost);
        $stmt->bindParam(':purchase_date',            $this->asset_purchase_date);
        $stmt->bindParam(':depreciation_years',       $this->asset_depreciation_years);
        $stmt->bindParam(':depreciation_rate',        $this->asset_depreciation_rate);
        $stmt->bindParam(':book_value',               $this->asset_book_value);
        $stmt->bindParam(':supplier_id',              $this->asset_supplier_id);
        $stmt->bindParam(':tracker_id',               htmlspecialchars(strip_tags($this->asset_tracker_id)));
        $stmt->bindParam(':allocated_by_employee_id', $this->asset_allocated_by_employee_id);
        $stmt->bindParam(':allocation_status',        $this->asset_allocation_status);
        $stmt->bindParam(':location',                 htmlspecialchars(strip_tags($this->asset_location)));
        $stmt->bindParam(':notes',                    htmlspecialchars(strip_tags($this->asset_notes)));
        $stmt->bindParam(':condition',                htmlspecialchars(strip_tags($this->asset_condition)));
        $stmt->bindParam(':id',                       $this->asset_id);
        if ($stmt->execute()) {
            $this->data["success"] = "Ok";
            $this->data["count"]   = $this->numRows;
        }
        return json_encode($this->data);
    }

    public function deleteAsset() {
        $this->initialiseJSON();
        $query = "DELETE FROM asset WHERE id = :id";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->asset_id);
        if ($stmt->execute()) {
            $this->data["id"]      = $this->asset_id;
            $this->data["success"] = "Ok";
            $this->data["count"]   = $this->numRows;
        }
        return json_encode($this->data);
    }

    public function allocateAsset() {
        $this->initialiseJSON();
        $query = "UPDATE asset SET employee_id           = :employee_id,
                                    date_allocated        = :date_allocated,
                                    allocated_employee_id = :allocated_employee_id,
                                    allocation_status     = true,
                                    date_updated          = now()
                    WHERE id = :id";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':employee_id',              $this->asset_employee_id);
        $stmt->bindParam(':date_allocated',           $this->asset_date_allocated);
        $stmt->bindParam(':allocated_by_employee_id', $this->asset_allocated_by_employee_id);
        $stmt->bindParam(':id',                       $this->asset_id);
        if ($stmt->execute()) {
            $this->data["id"]      = $this->asset_id;
            $this->data["success"] = "Ok";
            $this->data["count"]   = $this->numRows;
        }
        return json_encode($this->data);
    }

    public function deallocateAsset() {
        $this->initialiseJSON();
        $query = "UPDATE asset SET employee_id           = :employee_id,
                                    date_allocated        = NULL,
                                    allocated_employee_id = NULL,
                                    allocation_status     = false,
                                    date_updated          = now()
                    WHERE id = :id";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':employee_id', $this->asset_employee_id);
        $stmt->bindParam(':id',          $this->asset_id);
        if ($stmt->execute()) {
            $this->data["id"]      = $this->asset_id;
            $this->data["success"] = "Ok";
            $this->data["count"]   = $this->numRows;
        }
        return json_encode($this->data);
    }

}
?>
