<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use DB;
use App\categoryInfo;
use App\lotconditionInfo;
use App\InventoryInfo;
use App\TaxInfo;
class ReportController extends Controller
{
    //

    public function report_parse(Request $request){
        
        $timeline='M';
        //$timeline = $request->get('timeline');
        $category = $request->get('category');

        // Check condition
        if($timeline == 'M' && $category != 0){
            $data = DB::table('inventory_info')
                ->select(
                    DB::raw('YEAR(date) as year'),
                    DB::raw('MONTH(date) as month'),
                    DB::raw('SUM(pre_tax_amount) as sum')
                )
                ->where('category', $category)
                ->groupBy('year', 'month')
                ->get();
            return redirect()->back()->with(['search_result' => $data,'category'=> $category])->withInput();
        }else if($timeline == 'M'){
            $data = DB::table('inventory_info')
                ->select(
                    DB::raw('YEAR(date) as year'),
                    DB::raw('MONTH(date) as month'),
                    DB::raw('SUM(pre_tax_amount) as sum')
                )
                ->groupBy('year', 'month')
                ->get();
            //return redirect()->back()->with(['search_result' => $data])->withInput();
            return view('reportlist')->with('data', $data);
        }
        else
        {
            // New conditions will be apllies here to get more advance search.
        }
        
    }
    public function report_lists(Request $request){
        $timeline=$request->get('timeline');
        $category = $request->get('category');
        $data = DB::table('inventory_info')
        ->select(
            DB::raw('YEAR(date) as year'),
            DB::raw('MONTH(date) as month'),
            DB::raw('SUM(pre_tax_amount) as sum')
        )
        ->where('category', $category)
        ->groupBy('year', 'month')
        ->get();
        $returnHTML = view('catlist')->with(['data' => $data,'category'=> $category])->render();
        return response()->json( array('success' => true, 'htmls'=>$returnHTML) );
    }
}
