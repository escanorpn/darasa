<?php

namespace App\Http\Controllers;

use App\Models\kidato;
use App\Models\subject;
use App\Models\sbj;
use App\Models\cl;
use App\Models\mk;
use App\Http\Requests\StorekidatoRequest;
use App\Http\Requests\UpdatekidatoRequest;
use DB;
use Illuminate\Http\Request;

class KidatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $kidatos = Kidato::all();
            $amk=[];
            foreach ($kidatos as $v) {
               $c=Cl::where('kid', date("Y").$v->id)->count(); 
                $nmk = (object) [
                ];
                $nmk->id=$v->id;
                $nmk->name=$v->name;
                $nmk->created_at=$v->created_at;
                $nmk->c=$c;
                array_push($amk, $nmk);
               
            }
            return response()->json([
            "success" => true,
            "message" => "Item List",
            "val" => "2",
            "data" => $amk,
        ]);
    }
    public function showSubjects()
    {
            $Subjects = Subject::all();
            return response()->json([
            "success" => true,
            "message" => "Item List",
            "val" => "2",
            "data" => $Subjects,
        ]);
    }
    public function students()
    {
        $s="student";
        $students = DB::table('users')
        ->where('role', '=', $s )
        ->get();
        // $students = DB::table('users')
        // // ->where('cls.kid', '=',date("Y").$request->class_id )
        // ->where('role', '=','student' )
        // ->join('cls', 'users.id', '!=', 'cls.uid')
        // // ->join('users', 'users.role', '=', 'student')
        // ->select('users.*', 'cls.id' )
        // ->get();

        $cid = DB::table('cls')->pluck('uid')->all();
$students = DB::table('users')->whereNotIn('id', $cid)->select('id','name','code','role') ->where('role', '=','student' )->get();
        
        return response()->json([
        "success" => true,
        "message" => "Item List",
        "val" => "2",
        "data" => $students,
    ]);
    }
    public function mSubjects(Request $request)
    {
        $subjects = DB::table('subjects')
            ->where('sbjs.cid', '=',date("Y").$request->class_id )
            ->join('sbjs', 'subjects.id', '=', 'sbjs.sid')
            // ->where('role', '=','student' )
            // ->join('users', 'users.role', '=', 'student')
            ->select('subjects.*', 'sbjs.cid', )
            ->get();
            $aSubjects=[];
           
            foreach ($subjects as $value) {
                $nSubjects = (object) [
              
                ];
                $nSubjects->total=100;
                $nSubjects->id=$value->id;
                $nSubjects->name=$value->name;
                $nSubjects->cid=$value->cid;
                array_push($aSubjects, $nSubjects);
                
                // echo($nSubjects->id);
            }
            
            // $subjects->total=100;
        return response()->json([
        "success" => true,
        "message" => "Item List",
        "val" => "2",
        "data" => $aSubjects,
    ]);
    }
    public function admited(Request $request)
    {
        $users = DB::table('users')
            ->where('cls.kid', '=',date("Y").$request->class_id )
            ->join('cls', 'users.id', '=', 'cls.uid')
            ->where('role', '=','student' )
            // ->join('users', 'users.role', '=', 'student')
            ->select('users.*', 'cls.kid', )
            ->get();

    
        return response()->json([
        "success" => true,
        "message" => "Item List",
        "val" => "2",
        "data" => $users,
    ]);
    }
    public function gMarks(Request $request)
    {
        //    if (Mk::where('uid', $request->uid)->where('y', $request->y)->where('t', $request->t)->
        //         where('mid', $request->mid)->where('sid', '=', $v->id )->count() > 0) {
        $mks = DB::table('mks')
            ->where('uid', '=',$request->uid )
            ->join('subjects', 'subjects.id', '=', 'mks.sid')
            // ->where('role', '=','student' )
            // ->join('users', 'users.role', '=', 'student')
            // ->select('subjects.name', 'mks.y','mks.t','mks.mid', 'mks.score', 'mks.total','mks.created_at', )
            // ->groupBy(['subjects.name','mks.y', 'mks.t', 'mks.mid', 'mks.score', 'mks.total','mks.created_at',])
            ->select('subjects.name', 'mks.id','mks.y','mks.t','mks.mid', 'mks.score', 'mks.total','mks.created_at', )
            // ->groupBy(['subjects.name','mks.y', 'mks.t', 'mks.mid', 'mks.score', 'mks.total','mks.created_at',])
            ->get();

            $amk=[];
            foreach ($mks as $v) {
                
                $nmk = (object) [
                ];
                $nmk->gb=$v->y." Term: ".$v->t." mid: ".$v->mid;
                $nmk->id=$v->id;
                $nmk->name=$v->name;
                $nmk->y=$v->y;
                $nmk->t=$v->t;
                $nmk->mid=$v->mid;
                $nmk->score=$v->score;
                $nmk->total=$v->total;
                $nmk->p=$v->score/$v->total*100;
                $nmk->created_at=$v->created_at;
                array_push($amk, $nmk);
               
            }
            
        return response()->json([
        "success" => true,
        "message" => "Item List",
        "val" => "2",
        "data" => $amk,
    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addSubject(Request $request)
    {
        //
        $response = [];
        $item = new Subject;
        $item->name =$request->name;
        // $item->cid =$request->cid;
        $item->save();
     
        return response()->json([
                "success" => true,
                "val" => "2",
                "message" => "Record successfully added",
         
            ]);
        return response()->json($response);
    }

    public function create(Request $request)
    {
        //
        if (Kidato::where('name', '=', $request->name )->count() > 0) {
            return response()->json([
                "success" => true,
                "val" => "3",
                "message" => "CLass already exists",
         
            ]);
        return response()->json($response);
        }else{
            $response = [];
            $item = new Kidato;
            $item->name =$request->name;
            $item->save();
         
            return response()->json([
                    "success" => true,
                    "val" => "2",
                    "message" => "Record successfully added",
             
                ]);
            return response()->json($response);
        }
       
    }

    public function aSubjects(Request $request)
    {
        $response = [];
        $d=$request->selected;
        foreach ($d as $value) {
            // print $value;
            if (Sbj::where('sid', '=', $value )->where('cid', date("Y").$request->class_id)->count() > 0) {
                // user found
                echo " ".$value." found";
                // return;
             }else{
                // echo json_decode(json_encode($value));
                $item = new Sbj;
                $item->sid =$value;
                $item->cid =date("Y").$request->class_id;
                $item->save();
             }
           
          }
    
     
        return response()->json([
                "success" => true,
                "val" => "2",
                "message" => "Record successfully added",
         
            ]);
        return response()->json($response);
    }
    
    public function aMarks(Request $request)
    {
        $response = [];
    // echo $request
            $d=$request->mSub;
            foreach ($d as $value) {
                   $v=(object)$value;
                //    echo $v->total
        // return response()->json(["res"=>gettype((object)$value),$v->total]);
                if (Mk::where('uid', $request->uid)->where('y', $request->y)->where('t', $request->t)->
                where('mid', $request->mid)->where('sid', '=', $v->id )->count() > 0) {
                    echo"entry present";
                }else{
                    $item = new Mk;
                    $item->uid =$request->uid;
                    $item->sid =$v->id;
                    $item->y =$request->y;
                    $item->t =$request->t;
                    
                    $item->mid =$request->mid;
                    $item->score =$v->score;
                    $item->total =$v->total;
                    $item->save();
                }

            }
              
        return response()->json([
                "success" => true,
                "val" => "2",
                "message" => "Record successfully added", 
                "data" => $request->mSub,
         
            ]);
        return response()->json($response);
    }
    public function admiting(Request $request)
    {
        $response = [];
        $d=$request->selected;
        
        foreach ($d as $value) {
            // print $value;
            if (Cl::where('uid', '=', $value)->where('kid', date("Y").$request->class_id)->count() > 0) {
                // $cat=Cl::select('created_at',)->where('uid', $value)->get();
                // $dateValue = strtotime($cat[0]->created_at);                     
                // $yr = date("Y", $dateValue) ." "; 
                echo " ".$value." found: ";
                // echo "".gettype($yr). "".gettype(date("Y"));
                // if(intval(date("Y"))==intval($yr)){
                //     echo " ".$value." found: ".$yr; 
                // }else{
                //     $item = new Cl;
                //     $item->uid =$value;
                //     $item->kid =date("Y").$request->class_id;
                //     $item->save();
                // }
                // return;
             }else{
                // echo json_decode(json_encode($value));
                $item = new Cl;
                $item->uid =$value;
                $item->kid =date("Y").$request->class_id;
                $item->save();
             }
           
          }
    
     
        return response()->json([
                "success" => true,
                "val" => "2",
                "message" => "Record successfully added",
         
            ]);
        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorekidatoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorekidatoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kidato  $kidato
     * @return \Illuminate\Http\Response
     */
    public function show(kidato $kidato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kidato  $kidato
     * @return \Illuminate\Http\Response
     */
    public function edit(kidato $kidato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatekidatoRequest  $request
     * @param  \App\Models\kidato  $kidato
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatekidatoRequest $request, kidato $kidato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kidato  $kidato
     * @return \Illuminate\Http\Response
     */
    public function destroy(kidato $kidato)
    {
        //
    }
}
