<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use App\Models\Solution;
use Illuminate\Http\Request;

class ControllerSolutions extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = $_GET["query"] ?? null;
        $order = "solutions." . ($_GET["order"] ?? "id");
        $keyword = $_GET["keyword"] ?? "desc";
        $filter = $_GET["filter"] ?? null;

        if (isset($_GET['problem'])) {
            $problem = Problem::find($_GET['problem']);
        } else {
            $problem = null;
        }

        $solutions = Solution::join("products", "products.id", "=", "solutions.product_id")
            ->select('solutions.*',
                'products.title as product_title',
                'products.id as product_id')
            ->when(!is_null($filter), function ($query) use ($filter) {
                $query->where('solutions.solution_id', $filter);
            })
            ->when(!is_null($search), function ($query) use ($search) {
                $query->where('solutions.theme', 'like', '%' . $search . '%')
                    ->orWhere('solutions.description', 'like', '%' . $search . '%');
            })
            ->orderBy($order, $keyword)
            ->paginate(10);

        if (isset($problem)) {
            return view('containers.solutions.index', ['solutions' => $solutions, 'problem' => $problem]);
        } else {
            return view('containers.solutions.index', ['solutions' => $solutions]);
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
        $solution = Solution::find($id)->get();

        if (isset($_GET['problem'])) {
            $problem = Problem::find($_GET['problem']);
        } else {
            $problem = null;
        }

        if (isset($problem)) {
            return view('containers.solutions.show', ['solution' => $solution[0], 'problem' => $problem]);
        } else {
            return view('containers.solutions.show', ['solution' => $solution[0]]);
        }
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
