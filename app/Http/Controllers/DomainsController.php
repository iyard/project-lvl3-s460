<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Jobs\ParseJob;
use DiDom\Document;

class DomainsController extends Controller
{
    private $guzzle;
    
    public function __construct(\GuzzleHttp\Client $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['url' => 'required|URL']);
        if ($validator->fails()) {
            $urlErrorMessage = 'Not a valid url. Please enter valid URL (example - http://varvy.com)';
            return redirect()->route('index.show', ['urlErrorMessage' => $urlErrorMessage]);
        }
        $url = $request->input('url');

        if ($this->isUrlAddedToDB($url)) {
            $urlErrorMessage = 'Url is already added to database.';
            return redirect()->route('index.show', ['urlErrorMessage' => $urlErrorMessage]);
        }
        
        $response = $this->guzzle->request('GET', $url);
        $contentLengthHeader = $response->getHeader('Content-Length');
        $contentLength = isset($contentLengthHeader[0]) ? $contentLengthHeader[0] : 0;
        $responseCode = $response->getStatusCode();

        $id = DB::table('domains')->insertGetId(['name' => $url,
                                                 'created_at' => Carbon::now()->toDateTimeString(),
                                                 'contentLength' => $contentLength,
                                                 'responseCode' => $responseCode,
                                                 'body' => '',
                                                 'h1' => '',
                                                 'keywords' => '',
                                                 'description' => ''
                                                 ]);
        dispatch(new ParseJob($url));
        return redirect()->route('domains.show', ['id' => $id]);
    }
    
    public function show($id)
    {
        $url = DB::select('select * from domains where id = ?', [$id]);
        return view('domains', ['url' => $url]);
    }

    public function index(Request $request, $page = 1)
    {
        $urls = DB::table('domains')->paginate(4);
        return view('domainsIndex', ['urls' => $urls]);
    }

    public function isUrlAddedToDB($urlName)
    {
        $url = DB::select('select * from domains where name = ?', [$urlName]);
        return !empty($url);
    }
}
