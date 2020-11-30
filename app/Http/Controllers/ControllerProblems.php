<?php

namespace App\Http\Controllers;

use App\Mail\FeedbackMail;
use App\Models\Problem;
use App\Models\Product;
use App\Models\Solution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerProblems extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();

        if ($user->role == 1) {
            $status = $_GET["status"] ?? 1;
            $filter = $_GET["filter"] ?? null;
        } else {
            $status = $_GET["status"] ?? 2;
            $filter = $_GET["filter"] ?? $user->specialization;
        }

        $search = $_GET["query"] ?? null;
        $order = "problems." . ($_GET["order"] ?? "id");
        $keyword = $_GET["keyword"] ?? "desc";
        $problems = Problem::join("products", "products.id", "=", "problems.product_id")
            ->join("statuses", "statuses.id", "=", "problems.status")
            ->select('problems.*',
            'products.title as product_title',
            'statuses.id as status',
            'products.id as product_id')
            ->when(!is_null($filter), function ($query) use ($filter) {
                $query->where('problems.product_id', $filter);
            })
            ->when(!is_null($search), function ($query) use ($search) {
                $query->where('problems.theme', 'like', '%' . $search . '%')
                    ->orWhere('problems.description', 'like', '%' . $search . '%');
            })
            ->where('status', $status)
            ->orderBy($order, $keyword)
            ->paginate(10);
        return view('containers.problems.index', ['problems' => $problems]);
    }

    public function addAnswer($solution_id, $problem_id)
    {
        $problem = Problem::find($problem_id);
        $problem->solution_id = $solution_id;
        $problem->solution_time = date_diff(
            date_create(date('y-m-d h:m:s')),
            date_create($problem->detection_date))
            ->format('%d дней %h часов %i минут');
        $problem->status = 3;
        $problem->save();

        $mail = new ControllerMail();
        $mail->send(Problem::find($problem_id), Solution::find($solution_id), Auth::user()->name);
        return redirect("/solutions/feedback");
    }

    public function answer(Request $request, $id, $theme, $product)
    {
        $this->validate($request, [
            'description' => ['required', 'string']
        ]);

        $solution_id = Solution::create([
            'theme' => $theme,
            'description' => $request->input('description'),
            'product_id' => $product,
            'solution_date' => date("y-m-d h:m:s"),
            'user_id' => Auth::user()->id
        ])->id;

        $solution_date = Solution::find($solution_id)->solution_date;

        $problem = Problem::find($id);
        $problem->status = 3;
        $problem->solution_id = $solution_id;
        $problem->solution_time = date_diff(
            date_create($solution_date),
            date_create($problem->detection_date))
            ->format('%d днів %h годин %i хвилин %s секунд');
        $problem->save();

        $mail = new ControllerMail();
        $mail->send(Problem::find($id), Solution::find($solution_id), Auth::user()->name);
        return redirect("/solutions/feedback");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('containers.problems.create', ['products' => $products]);
    }

    public function sendToExperts($id)
    {
        $problem = Problem::find($id);
        $problem->status = 2;
        $problem->save();

        return redirect("/problems");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'theme' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'product_id' => ['required', 'numeric', 'nullable']
        ]);
        Problem::create([
            'theme' => $request->input('theme'),
            'description' => $request->input('description'),
            'username' => $request->input('username'),
            'detection_date' => date("y-m-d h:m:s"),
            'email' => $request->input('email'),
            'product_id' => $request->input('product_id'),
        ]);
        return redirect('/feedback');
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
    public function edit(Request $request, $id)
    {
        $solution = Problem::find($id)->solution_id;
        $problem = Problem::join("products", "products.id", "=", "problems.product_id")
            ->join("statuses", "statuses.id", "=", "problems.status")
            ->when(!is_null($solution), function ($query) use ($solution) {
                $query->join("solutions", "solutions.id", "=", "problems.solution_id")
                    ->select('problems.*',
                        'solutions.id as solution_id',
                        'solutions.solution_date as solution_date',
                        'statuses.id as status',
                        'products.title as products_title');
            })
            ->when(is_null($solution), function ($query) use ($solution) {
                $query->select('problems.*',
                    'statuses.id as status',
                    'products.title as products_title');
            })
            ->where('problems.id', $id)
            ->get();

        $user = Auth::user();

        return view('containers.problems.edit', ['problem' => $problem[0], 'user' => $user]);
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
