<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DomainsController extends Controller
{
    /**
     * Store a new domain.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['url' => 'required|URL']);
        if ($validator->fails()) {
            $urlErrorMessage = 'Not a valid url. Please enter valid URL (example - http://varvy.com)';
            return redirect()->route('index', ['urlErrorMessage' => $urlErrorMessage]);
        }
        $url = $request->input('url');
        $id = DB::table('domains')->insertGetId(['name' => $url]);
        return redirect()->route('showdomain', ['id' => $id]);
    }
    
    public function show($id)
    {
        $url = DB::select('select * from domains where id = ?', [$id]);
        return view('domains', ['url' => $url]);
    }
}
