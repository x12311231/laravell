<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BaseController extends Controller
{
    protected $table;
    protected $request;
    protected $db;

    public function __construct(Request $request) {
        $this->request = $request;
        $this->db = DB::table($this->table);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->parseWhere();
        $data = $this->db
            ->paginate(10);
        return $data;
    }

    /**
     * $filter eg [["id","=",1]] | [["id","in",[1,3,5]],["is_close","=",0]]
     * @return void
     * @throws \Exception
     */
    protected function parseWhere() : void
    {
//        $this->db->where('id', '=', 1);
        $filter = $this->request->input('filter', '[]');
//        $filter = '[["id","=",1]]';
//        logger()->info('aaaaaaaa' . json_encode([['id', '=', 1]]));
        $filter = json_decode($filter);
//        logger()->info('fffffffffffff' . var_export($filter, true));
        foreach ((array)$filter as $k => $v) {
            $key = $v[0];
            $op = $v[1];
            $value = $v[2];
            switch ($op) {
                case '=':
                    $this->db->where([$key => $value]);
                    break;
                case 'in':
                    if (!is_array($value)) {
                        throw new \Exception('must be array with condition in');
                    }
                    $this->db->whereIn($key, $value);
                    break;
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
