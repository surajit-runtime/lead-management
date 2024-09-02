<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Exception;
use DateTime;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\redirect;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class CSVuploadController extends Controller
{
    //



    function ImportCSV2Array($filename)
    {
        $row = 0;
        $col = 0;

        $handle = @fopen($filename, "r");
        if ($handle) {
            while (($row = fgetcsv($handle, 4096)) !== false) {
                if (empty($fields)) {
                    $fields = $row;
                    continue;
                }

                foreach ($row as $k => $value) {
                    $results[$col][$fields[$k]] = $value;
                }
                $col++;
                unset($row);
            }
            if (!feof($handle)) {
                return redirect()->back()->with('error', 'unexpected fgets() failn');

            }
            fclose($handle);
        }

        return $results;
    }
    function sanitizeInput($input)
    {
        // Strip unnecessary characters (extra space, tab, newline)
        $input = trim($input);
        // Remove backslashes
        $input = stripslashes($input);
        // Convert special characters to HTML entities to prevent injection
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        return $input;
    }

    public function importCsv(Request $request)
    {

        $csv = $request->file('csv_file');

        if ($csv) {
            // Store the file in a temporary location
            $csvPath = $csv->store('temp');
            $filename = storage_path('app/' . $csvPath);

            $csvArray = $this->ImportCSV2Array($filename);



            $inserted = 0;
            $err_arr = array();
            $mob_email_err = array();
            $pincode_err = array();
            $first_last_name_error = array();
            $state_district_err = array();
            $position = 0;
            foreach ($csvArray as $row) {

                $lead_frm = ucfirst($row['Lead Source']);
                $pincode = $row['Pincode'];

                $timestamp = Carbon::now();
                $emailRegex = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,4}$/';
                // $pattern = '/^[A-Za-z]+$/';
                // if (!preg_match($pattern, $row['First Name']) || !preg_match($pattern, $row['Last Name'])) {
                //     $first_last_name_error[] = array(


                //         'email' => $row['Email'],
                //         'mobile' => $row['Mobile'],
                //         'first_name' => $row['First Name'],
                //         'last_name' => $row['Last Name']
                //     );
                // }
                $pattern = '/^[A-Za-z]+$/';


                $firstName = $this->sanitizeInput($row['First Name']);
                $lastName = $this->sanitizeInput($row['Last Name']);

                // Validate inputs



                if ((strlen((string) $row['Mobile']) == 10 && is_numeric($row['Mobile']) && preg_match($emailRegex, $row['Email']))) {
                    if (preg_match($pattern, $firstName) && preg_match($pattern, $lastName)) {


                        if (strlen((string) $row['Pincode']) == 6 && is_numeric($row['Pincode'])) {
                            $leads = DB::table('tbl_lead')->Where('mobile', $row['Mobile'])->get();
                            if ($leads->count() == 0) {
                                // $lead_type = DB::table('tbl_lead_type')->where('lead_type_name', $leadType)->select('id')->first();﻿

                                $state_dist_map = DB::table('tbl_distributor_pin_maps')->select('state_id', 'district_id', 'zone_id')->where('pin_code', $pincode)->first();
                                if ($state_dist_map) {
                                    $leads_ins = DB::table('tbl_lead')->insert(['first_name' => $row['First Name'], 'last_name' => $row['Last Name'], 'mobile' => $row['Mobile'], 'email' => $row['Email'], 'state_id' => $state_dist_map->state_id, 'district_id' => $state_dist_map->district_id, 'created_from' => $lead_frm, 'lead_date' => $timestamp, 'is_manual' => '1', 'zone_id' => $state_dist_map->zone_id, 'pincode' => $pincode]);

                                } else {
                                    $leads_ins = DB::table('tbl_lead')->insert(['first_name' => $row['First Name'], 'last_name' => $row['Last Name'], 'mobile' => $row['Mobile'], 'email' => $row['Email'], 'state_id' => 0, 'district_id' => 0, 'created_from' => $lead_frm, 'lead_date' => $timestamp, 'is_manual' => '1', 'zone_id' => 0, 'pincode' => $pincode]);

                                }
                                $inserted++;


                            } else {

                                foreach ($leads as $lead) {
                                    $err_arr[] = array(
                                        'position'   => $position,
                                        'user_id'    => $lead->id,
                                        'email'      => $row['Email'],
                                        'mobile'     => $row['Mobile'],
                                        'first_name' => $row['First Name'],
                                        'last_name'  => $row['Last Name']
                                    );
                                }

                            }
                        } else {

                            $pincode_err[] = array(
                                'position'   => $position,

                                'email'      => $row['Email'],
                                'mobile'     => $row['Mobile'],
                                'first_name' => $row['First Name'],
                                'last_name'  => $row['Last Name'],
                                'pincode'    => $pincode
                            );


                        }
                    } else {
                        $first_last_name_error[] = array(
                            'email'      => $row['Email'],
                            'mobile'     => $row['Mobile'],
                            'first_name' => $firstName,
                            'last_name'  => $lastName
                        );
                    }
                } else {

                    $mob_email_err[] = array(


                        'email'      => $row['Email'],
                        'mobile'     => $row['Mobile'],
                        'first_name' => $row['First Name'],
                        'last_name'  => $row['Last Name']
                    );

                }



            }

            return redirect()->back()->with(['success' => $inserted . ' Leads are uploaded', 'err_arr' => $err_arr, 'mob_email_err' => $mob_email_err, 'pincode_err' => $pincode_err, 'first_last_name_error' => $first_last_name_error]);




        } else {
            return redirect()
                ->back()
                ->with('error', 'CSV file not found');
        }
    }


    public function userDetails($id)
    {
        try {
            $userdetail = DB::table('tbl_lead')->select('first_name', 'last_name', 'created_from', 'lead_date', 'mobile', 'email', 'state_id', 'lead_status_id', 'lead_type_id', 'BM_id', 'executive_id_assign_to')->where('id', $id)->first();
            if ($userdetail) {
                $state_nm = DB::table('tbl_state')->select('state_name')->where('id', $userdetail->state_id)->first();
                $lead_status_name = DB::table('tbl_lead_status')->select('lead_status_name')->where('id', $userdetail->lead_status_id)->first();
                $lead_type_name = DB::table('tbl_lead_type')->select('lead_type_name')->where('id', $userdetail->lead_type_id)->first();
                $Bm_name = DB::table('tbl_distributor')->select('bm_name')->where('id', $userdetail->BM_id)->first();
                if (empty($lead_status_name)) {
                    $lead_status_name = (object) ['id' => null, 'lead_status_name' => 'No Status'];
                }
                if (empty($lead_type_name)) {
                    $lead_type_name = (object) ['id' => null, 'lead_type_name' => 'No Type'];
                }
                if (empty($Bm_name)) {
                    $Bm_name = (object) ['id' => null, 'bm_name' => 'No BM'];
                }
                if ($userdetail->executive_id_assign_to === NULL) {
                    $userdetail->executive_id_assign_to = 'NO Distributor';
                }
            }

            return view('frontend.userDuplicateDataCsvDetail', ['userdetail' => $userdetail, 'state_nm' => $state_nm, 'lead_status_name' => $lead_status_name, 'lead_type_name' => $lead_type_name, 'Bm_name' => $Bm_name]);
        } catch (Exception $e) {
            // Handle the error and return a response with an error message
            return response()->json(['error' => 'User details not found.'], 404);
        }
    }
    public function Manually_Adn_Page()
    {
        $states = DB::table('tbl_state')->select('id', 'state_name')->get();
        $district_list = DB::table('cities')->select('id', 'city', 'state_id')->get();
        return view('frontend.addLeadManually', ['states' => $states, 'district_list' => $district_list]);
    }
    public function storeLeadManually(Request $request)
    {
        $validatedData = $request->validate([

            'first_name'   => 'required|alpha',
            'last_name'    => 'required|alpha',

            'mobile'       => 'required',
            'email'        => 'required|email',

            'created_from' => 'required',
            'pincode'      => 'required',
        ]);


        try {
            $leads = DB::table('tbl_lead')->Where('mobile', $validatedData['mobile'])->get();
            $timestamp_today = Carbon::now();
            if ($leads->count() == 0) {
                // $lead_type = DB::table('tbl_lead_type')->where('lead_type_name', $leadType)->select('id')->first();﻿

                $state_dist_map = DB::table('tbl_distributor_pin_maps')->select('state_id', 'district_id', 'zone_id')->where('pin_code', $validatedData['pincode'])->first();
                if ($state_dist_map) {
                    $leads_ins = DB::table('tbl_lead')->insert(['first_name' => $validatedData['first_name'], 'last_name' => $validatedData['last_name'], 'mobile' => $validatedData['mobile'], 'email' => $validatedData['email'], 'state_id' => $state_dist_map->state_id, 'district_id' => $state_dist_map->district_id, 'created_from' => $validatedData['created_from'], 'lead_date' => $timestamp_today, 'is_manual' => '1', 'zone_id' => $state_dist_map->zone_id, 'pincode' => $validatedData['pincode']]);

                } else {
                    $leads_ins = DB::table('tbl_lead')->insert(['first_name' => $validatedData['first_name'], 'last_name' => $validatedData['last_name'], 'mobile' => $validatedData['mobile'], 'email' => $validatedData['email'], 'state_id' => 0, 'district_id' => 0, 'created_from' => $validatedData['created_from'], 'lead_date' => $timestamp_today, 'is_manual' => '1', 'zone_id' => 0, 'pincode' => $validatedData['pincode']]);

                }


                return redirect()->back()->with('success', 'Lead is inserted successfully.');


            } else {

                return redirect()->back()->with('error', $validatedData['mobile'] . ' already present');

            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }



    public function fetchDistricts(Request $request)
    {
        $stateId = $request->input('stateId');

        $districts = DB::table('cities')->where('state_id', $stateId)->get();

        return response()->json($districts);
    }
}
