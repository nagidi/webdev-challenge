<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\categoryInfo;
use App\lotconditionInfo;
use App\InventoryInfo;
use App\TaxInfo;
class InventoryController extends Controller
{
    //

    public function import_parse(Request $request){ 
        $this->validate($request, [
            'import_file' => 'required|mimes:csv,txt'
        ]);

        // file path
        $path = $request->file('import_file')->getRealPath();
       // Parse a CSV file into an array
        $data = array_map('str_getcsv', file($path));
        // Slice First array element to find columan Headers
        $csv_titles = array_slice($data, 0, 1);

        $columan_headers= array();

        // Parseing csv headers
        foreach($csv_titles as $csv_head)
        {
            // Convert into lowercase
            foreach($csv_head as $headers)
            {
               
                // Convert string into lowercase
                $string_lower = strtolower($headers);

                // Replace whitespace with underscore
                $strip_space = str_replace(" ", "_",$csv_head);

                // Replace dash with dash
                $strip_dash = str_replace( "-", "_",$strip_space);
            }
            array_push($columan_headers, $strip_dash);
        }
        //Get the column listing for a given table.
        $columns = DB::getSchemaBuilder()->getColumnListing('inventory_info');
       // Slice id and timestemps from array
       $stripped_column_data = array_slice($columns,1,8);
        $difference = array_diff($columan_headers[0], $stripped_column_data);
        if(!empty($difference))
        {
            return redirect()->back()->withErrors(['The file columns are not in order as import script OR column headers are not in proper written please chcek' ]);
        }
        else
        {

            // Slice out first element from csv which is not data
            $csv_data = array_slice($data, 1);

            // Check if file contains any empty or null value
            if(in_array(array('', ' ', null),$csv_data))
            {
                return redirect()->back()->withErrors(['Empty and null values are not allowd in import operation please recheck and try again']);
            }
            else{
                // Inserting rows
                foreach($csv_data as $values)
                {
                    $date = date('Y-m-d', strtotime(str_replace('-', '/', $values[0])));
                    $category = strtolower($values[1]);

                    // Find category if exist
                    $find_category_id = categoryInfo::firstOrCreate(['category'=>$category]);
                    $category_id = $find_category_id->id;
                    $lot_title = $values[2];
                    $location = $values[3];
                    $condition = strtolower($values[4]);

                    // Find condition defination if exist
                    $find_condition_id = lotconditionInfo::firstOrCreate(['lot_condition' => $condition]);
                    $condition_id = $find_condition_id->id;
                    $pre_tax_amount = $values[5];
                    $tax_name = strtolower($values[6]);

                    // Find tax rule if exist
                    $find_tax_name = TaxInfo::firstOrCreate(['tax_name' => $tax_name]);
                    $tax_name_id = $find_tax_name->id;
                    $tax_amount = $values[7];

                    // Creating new database inventory entries if not exist
                    $new_inventory = InventoryInfo::firstOrCreate([
                        'date' => $date,
                        'category' => $category_id,
                        'lot_title' => $lot_title,
                        'lot_location' => $location,
                        'lot_condition' => $condition_id,
                        'pre_tax_amount' => $pre_tax_amount,
                        'tax_name' => $tax_name_id,
                        'tax_amount' => $tax_amount
                    ]);
                }
                return redirect()->back()->with('message', 'Succesfully imported data');
            }
        }
    }
}
