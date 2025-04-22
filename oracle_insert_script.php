<?php
// Oracle SQL Insert Generator for Question Master data
// This script converts the bulk inserts into individual Oracle SQL statements

// Original data provided by the user
$sql_data = <<<'SQL'
INSERT INTO carbon_footprint_new.question_master (sector_segment_map_id,particular,business_activity_id,category_id,unit,status,emission_factor,conversion_factor,conversion_ques_id,descrption,data_source,ques_type_id) VALUES
	 (2,'Fuel Oil',NULL,1,'kL',1,3.18317000,1000.00000000,NULL,'Total quantity of Fuel oil consumed as fuel','Log Book/ Purchase Bill',NULL),
	 (2,'Petrol',NULL,1,'kL',1,2.31467000,1000.00000000,NULL,'Total quantity of Petrol consumed as fuel','Log Book/ Purchase Bill',NULL),
	 (2,'Diesel',NULL,1,'kL',1,2.68787000,1000.00000000,NULL,'Total quantity of Diesel consumed as fuel','Log Book/ Purchase Bill',NULL),
	 (2,'Natural Gas',NULL,1,'cubic metre',1,2.03017000,1.00000000,NULL,'Total quantity of Natural Gas consumed as fuel','Log Book/ Purchase Bill',NULL),
	 (2,'Refuse Derived Fuel (RDF)/ Municipal Solid Waste (MSW)',NULL,1,'tonne',1,170.15000000,4.18410042,NULL,'Total quantity of Reuse Derived Fuel (RDF) or Municipal Solid Waste (MSW) consumed as fuel','Log Book/ Purchase Bill',NULL),
	 (3,'Personnel transporation by company owned vehicles ',NULL,2,'km',1,0.18347500,1.00000000,NULL,'Total distance covered by company owned passenger vehicles','Vehicle Log Book',NULL),
	 (3,'Goods transporation by company owned vehicles',NULL,2,'km',1,0.78500000,1.00000000,NULL,'Total distance covered by company owned goods vehicles','Vehicle Log Book',NULL),
	 (4,'Clinker Produced','1',3,'tonne',1,369.71220000,1.00000000,NULL,'Total Production of Clinker','Production Report/ Log Book',NULL),
	 (4,'Cement Produced','2',3,'tonne',1,374.48270000,1.00000000,NULL,'Total Production of Cement ','Production Report/ Log Book',NULL),
	 (1,'Electricity Purchased',NULL,4,'kWh',1,0.71600000,1.00000000,NULL,'Total electricity purchased from the grid','Electricity Bill ',NULL);
INSERT INTO carbon_footprint_new.question_master (sector_segment_map_id,particular,business_activity_id,category_id,unit,status,emission_factor,conversion_factor,conversion_ques_id,descrption,data_source,ques_type_id) VALUES
	 (1,'Renewable Electricity Purchased ',NULL,4,'KWh',1,0.00005000,1.00000000,NULL,'Total electricity generated through renewable sources purchased','Electricity Bill/ Others',NULL),
	 (5,'Limestone Purchased',NULL,5,'tonne',1,2.76000000,1.00000000,NULL,'Total quanitity of Limestone purchased','Purchase Bill',NULL),
	 (5,'Silica Purchased',NULL,5,'tonne',1,0.05800000,1.00000000,NULL,'Total quantity of Silica purchased','Purchase Bill',NULL),
	 (5,'Alumina Purchased',NULL,5,'tonne',1,1.23000000,1.00000000,NULL,'Total quanity of Alumina Purchased','Purchase Bill',NULL),
	 (3,'Goods transporation by leased vehicles',NULL,6,'km',1,0.78500000,1.00000000,NULL,'Total distance covered by leased goods vehicles for sourcing material (Upstream)','Vehicle Log Book/ Purchase Bill',NULL),
	 (3,'Quantity of Goods transportation by rail',NULL,6,'tonne',1,NULL,NULL,NULL,'Total weight of sourced material by railways (Upstream)','Purchase Bill/ Log Book',NULL),
	 (49,'Natural gas',NULL,1,'cubic meter',1,2.03017000,1250.00000000,NULL,'Total quantity of Natural Gas consumed as fuel','Log Book/ Purchase Bill',NULL),
	 (3,'Amount spent on Transportation',NULL,NULL,'INR',1,0.02992007,1.00000000,NULL,'Total amount spent on transportation','Balance Sheet',NULL),
	 (49,'Petrol',NULL,1,'kL',1,2.31467000,1000.00000000,NULL,'Total quantity of Petrol consumed as fuel','Log Book/ Purchase Bill',NULL),
	 (49,'Coal',NULL,1,'tonne',1,2.38001000,1000.00000000,NULL,'Total quantity of Coal consumed as fuel','Log Book/ Purchase Bill',NULL);
INSERT INTO carbon_footprint_new.question_master (sector_segment_map_id,particular,business_activity_id,category_id,unit,status,emission_factor,conversion_factor,conversion_ques_id,descrption,data_source,ques_type_id) VALUES
	 (49,'Diesel',NULL,1,'kL',1,2.68787000,1000.00000000,NULL,'Total quantity of Diesel consumed as fuel','Log Book/ Purchase Bill',NULL),
	 (49,'Fuel Oil',NULL,1,'kL',1,3.18317000,1000.00000000,NULL,'Total quantity of Fuel oil consumed as fuel','Log Book/ Purchase Bill',NULL),
	 (50,'Personnel transporation by company owned vehicles ',NULL,2,'km',1,0.18347500,1.00000000,NULL,'Total distance covered by company owned passenger vehicles','Vehicle Log Book',NULL),
	 (50,'Goods transporation by company owned vehicles',NULL,2,'km',1,0.78500000,1.00000000,NULL,'Total distance covered by company owned goods vehicles','Vehicle Log Book',NULL),
	 (48,'Electricity Purchased',NULL,4,'kWh',1,0.71600000,1.00000000,NULL,'Total electricity purchased from the grid','Electricity Bill ',NULL),
	 (48,'Renewable Electricity Purchased ',NULL,4,'kWh',1,0.00005000,1.00000000,NULL,'Total electricity generated through renewable sources purchased','Electricity Bill/ Others',NULL),
	 (48,'Amount spent on Electricity',NULL,4,'INR',1,0.71600000,0.14310000,NULL,'Total amount of money spent on electricity purchased from grid','Balance Sheet',NULL),
	 (51,'High-Density Polyethylene (HDPE) (Virgin) Purchased',NULL,5,'kg',1,1.89000000,1.00000000,NULL,'Total amount of purchased High-Density 
Polyethylene (HDPE) (Virgin) for the production','Purchase Bill',NULL),
	 (51,'High-Density Polyethylene (HDPE) (Recycled) Purchased',NULL,5,'kg',1,0.56000000,1.00000000,NULL,'Total amount of purchased High-Density Polyethylene (HDPE) (Recycled) for the production','Purchase Bill',NULL),
	 (51,'Low-Density Polyethylene (LDPE) (Virgin) Purchased',NULL,5,'kg',1,2.06000000,1.00000000,NULL,'Total amount of purchased Low High-Density 
Polyethylene (LDPE) (Virgin) for the production','Purchase Bill',NULL);
INSERT INTO carbon_footprint_new.question_master (sector_segment_map_id,particular,business_activity_id,category_id,unit,status,emission_factor,conversion_factor,conversion_ques_id,descrption,data_source,ques_type_id) VALUES
	 (51,'Low-Density Polyethylene (LDPE) (Recyled) Purchased',NULL,5,'kg',1,1.01000000,1.00000000,NULL,'Total amount of purchased Low-Density Polyethylene (LDPE) (Recycled) for the production','Purchase Bill',NULL),
	 (51,'Polypropylene (PP) (Virgin) Purchased',NULL,5,'kg',1,1.84000000,1.00000000,NULL,'Total amount of purchased Polypropylene (PP) (Virgin)  for the production','Purchase Bill',NULL),
	 (51,'Polypropylene (PP) (Recyled) Purchased',NULL,5,'kg',1,0.53000000,1.00000000,NULL,'Total amount of purchased Polypropylene (PP) (Recyled) for the production','Purchase Bill',NULL),
	 (51,'Polyvinyl Chloride (PVC) (Virgin) Purchased',NULL,5,'kg',1,2.22000000,1.00000000,NULL,'Total amount of purchased Polyvinyl Chloride (PVC) (Virgin) for the production','Purchase Bill',NULL),
	 (51,'Polyvinyl Chloride (PVC) (Recyled) Purchased',NULL,5,'kg',1,0.48000000,1.00000000,NULL,'Total amount of purchased Polyvinyl Chloride (PVC) (Recyled) for the production','Purchase Bill',NULL),
	 (7,'Petroleum Coke',NULL,1,'tonne ',1,3.39779000,1000.00000000,NULL,'Total quantity of Pet Coke consumed as fuel','Log Book/ Purchase Bill',NULL),
	 (7,'Coal Tar',NULL,1,'tonne ',1,2.62000000,1000.00000000,NULL,'Total quantity of Coal Tar consumed as fuel','Log Book/ Purchase Bill',NULL),
	 (7,'Diesel',NULL,1,'kL',1,2.68787000,1000.00000000,NULL,'Total quantity of Diesel consumed as fuel','Log Book/ Purchase Bill',NULL),
	 (7,'Coking Coal',NULL,1,'tonne ',1,3.22204000,1000.00000000,NULL,'Total quantity of Coking Coal consumed as fuel','Log Book/ Purchase Bill',NULL),
	 (7,'Natural Gas',NULL,1,'cubic meter',1,2.03017000,1.00000000,NULL,'Total quantity of Natural Gas consumed as fuel','Log Book/ Purchase Bill',NULL);
INSERT INTO carbon_footprint_new.question_master (sector_segment_map_id,particular,business_activity_id,category_id,unit,status,emission_factor,conversion_factor,conversion_ques_id,descrption,data_source,ques_type_id) VALUES
	 (8,'Personnel transporation by company owned vehicles ',NULL,2,'km',1,0.18347500,1.00000000,NULL,'Total distance covered by company owned passenger vehicles','Vehicle Logbook',NULL),
	 (8,'Goods transporation by company owned vehicles',NULL,2,'km',1,0.78500000,1.00000000,NULL,'Total distance covered by company owned goods vehicles','Vehicle Logbook',NULL),
	 (15,'Total Amount of Coal Purchased',NULL,5,'tonne ',1,320.00000000,1.00000000,NULL,'Total Amount of Coal purchased for production','Purchase Bill',NULL),
	 (13,'Quantity of Goods transportation by waterways',NULL,6,'tonne',1,0.00000000,NULL,NULL,'Total weight of sourced material by waterways (Upstream)','Purchase Bill/ Log Book',NULL),
	 (9,'Primary Aluminium Produced using prebake technology','3',3,'tonne ',1,1167.50000000,1.00000000,NULL,'Total Production of the Primary aluminium through Prebake Technology','Production Report/ Log Book/ Annual Report',NULL),
	 (9,'Primary Aluminium Produced using Soderberg Technology','4',3,'tonne ',1,1150.00000000,1.00000000,NULL,'Total Production of the Primary aluminium through Soderberg Technology','Production Report/ Log Book/ Annual Report',NULL),
	 (9,'Primary Cast Ingot Produces','5',3,'tonne ',1,16.47770000,1000.00000000,NULL,'Total Production of the Primary cast Ingot','Production Report/ Log Book/ Annual Report',NULL),
	 (9,'Alumina Produced','6',3,'tonne ',1,1.26484000,1000.00000000,NULL,'Total Production of the Alumina in a Year','Production Report/ Log Book/ Annual Report',NULL),
	 (6,'Electricity Purchased',NULL,4,'kWh',1,0.71600000,1.00000000,NULL,'Total electricity purchased from the grid','Electricity Bill ',NULL),
	 (6,'Renewable Electricity Purchased ',NULL,4,'kWh',1,0.00010000,1.00000000,NULL,'Total electricity generated through renewable sources purchased','Electricity Bill/others',NULL);
SQL;

// Include all the rest of the insert statements from the original question
$sql_data .= <<<'SQL'
INSERT INTO carbon_footprint_new.question_master (sector_segment_map_id,particular,business_activity_id,category_id,unit,status,emission_factor,conversion_factor,conversion_ques_id,descrption,data_source,ques_type_id) VALUES
	 (10,'Bauxite Purchased',NULL,5,'tonne ',1,0.00840000,1000.00000000,NULL,'Total quanity of Bauxite Purchased','Purchase Bill',NULL),
	 (10,'Caustic Soda Purchased',NULL,5,'tonne ',1,1.12000000,1000.00000000,NULL,'Total quanity of Caustic Soda Purchased','Purchase Bill',NULL),
	 (10,'Lime Purchased',NULL,5,'tonne ',1,0.79000000,1000.00000000,NULL,'Total quanity of Lime Purchased','Purchase Bill',NULL),
	 (8,'Goods transporation by leased vehicles',NULL,6,'km',1,0.78500000,1.00000000,NULL,'Total distance covered by leased goods vehicles for sourcing material (Upstream)','Vehicle Log Book/ Purchase Bill',NULL),
	 (51,'Polyethylene Terephthalate (PET) ( Virgin) Purchased',NULL,5,'kg',1,2.23000000,1.00000000,NULL,'Total amount of purchased Polyethylene Terephthalate (PET) ( Virgin) for the production','Purchase Bill',NULL),
	 (8,'Amount spent on Transportation',NULL,NULL,'INR',1,0.02992007,1.00000000,NULL,'Total amount spent on transportation','Balance Sheet',NULL),
	 (51,'Polyethylene Terephthalate (PET) (Recyled) Purchased',NULL,5,'kg',1,0.91000000,1.00000000,NULL,'Total amount of purchased Polyethylene Terephthalate (PET) (Recyled) for the production','Purchase Bill',NULL),
	 (51,'Polystyrene (PS) Purchased',NULL,5,'kg',1,1.95000000,1.00000000,NULL,'Total amount of purchased Polystyrene (PS) for the production','Purchase Bill',NULL),
	 (51,'Acrylonitrile Butadiene Styrene (ABS) Purchased',NULL,5,'kg',1,3.46000000,1.00000000,NULL,'Total amount of purchased Acrylonitrile Butadiene Styrene (ABS) for the production','Purchase Bill',NULL),
	 (51,'Nylon (Polyamide (PA)) Purchased',NULL,5,'kg',1,7.90000000,1.00000000,NULL,'Total amount of purchased Nylon (Polyamide (PA)) for the production','Purchase Bill',NULL);
SQL;

// Process the data to extract individual records
$sql_data = preg_replace('/;\s*INSERT INTO.*VALUES/s', ',', $sql_data);
$sql_data = preg_replace('/^INSERT INTO.*VALUES\s*/s', '', $sql_data);
$sql_data = rtrim($sql_data, ';');

// Extract values from the SQL
preg_match_all('/\((.*?)\)(?:,|$)/s', $sql_data, $matches);

// Open a file to write the Oracle-compatible SQL
$file = fopen("question_master_oracle_inserts.sql", "w");

// Write the file header
fwrite($file, "-- Oracle SQL Insert Script for QUESTION_MASTER\n");
fwrite($file, "-- Generated: " . date("Y-m-d H:i:s") . "\n\n");

// Process each record and generate an Oracle-compatible INSERT statement
$counter = 0;
foreach ($matches[1] as $valueSet) {
    // Clean up the values
    $values = explode(',', $valueSet);
    for ($i = 0; $i < count($values); $i++) {
        $values[$i] = trim($values[$i]);
        
        // Handle NULL values
        if ($values[$i] === 'NULL') {
            $values[$i] = 'NULL';
        } 
        // Handle string values
        elseif (preg_match('/^\'.*\'$/', $values[$i])) {
            // Already properly quoted
        } 
        // Handle numeric values
        else {
            // Ensure numeric value has no quotes
            $values[$i] = preg_replace('/\'/', '', $values[$i]);
        }
    }
    
    // Generate the Oracle INSERT statement
    $insert = "INSERT INTO QUESTION_MASTER (SECTOR_SEGMENT_MAP_ID, PARTICULAR, BUSINESS_ACTIVITY_ID, CATEGORY_ID, UNIT, STATUS, EMISSION_FACTOR, CONVERSION_FACTOR, CONVERSION_QUES_ID, DESCRPTION, DATA_SOURCE, QUES_TYPE_ID) VALUES\n";
    $insert .= "(" . implode(', ', $values) . ");\n";
    
    fwrite($file, $insert);
    
    // Add COMMIT every 20 records to avoid transaction timeout
    $counter++;
    if ($counter % 20 == 0) {
        fwrite($file, "COMMIT;\n\n");
    }
}

// Final COMMIT
fwrite($file, "COMMIT;\n");
fclose($file);

echo "SQL script generated successfully as 'question_master_oracle_inserts.sql'";
?> 