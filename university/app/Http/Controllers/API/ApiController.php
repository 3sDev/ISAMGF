<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PostLikeStudent;
use App\Models\PostLikeTeacher;
use App\Models\Student;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    use BaseController;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    //Like Post(Forum) Student ------------------------------------------------------------------
    public function createNewLikeStudent(Request $request)
    {
        $post              = new PostLikeStudent;
        $post->post_id     = $request->input('post_id');
        $post->student_id  = $request->input('student_id');
        $post->statut      = $request->input('statut');
    
        $post->save();
    }

    public function getAllLikeFromAllPostStudent()
    {
        $resultSQL = DB::select('Select s.id as idStudent, p.id as idPost, pls.id as idPostLikeTable, pls.statut as likeStatut, s.full_name as fullNameStudent from post_like_students pls INNER JOIN posts p INNER JOIN students s WHERE s.id = pls.student_id and p.id = pls.post_id');
        return  $resultSQL;
    }

    public function getAllLikeFromAllPostByIdStudent($id)
    {
        $resultSQL = DB::select('Select s.id as idStudent, p.id as idPost, pls.id as idPostLikeTable, pls.statut as likeStatut, s.full_name as fullNameStudent from post_like_students pls INNER JOIN posts p INNER JOIN students s WHERE s.id = pls.student_id and p.id = pls.post_id and pls.student_id = ?', [$id]);
        return  $resultSQL;
    }

    public function getAllLikeFromAllPostByIdPost($id)
    {
        $resultSQL = DB::select('Select s.id as idStudent, p.id as idPost, pls.id as idPostLikeTable, pls.statut as likeStatut, s.full_name as fullNameStudent, s.nom as nomStudent, s.prenom as prenomStudent, s.profile_image as photoProfileStudent, s.email as email, s.classe_id as idClasseStudent, s.diplome as niveauEtudeStudent, s.filiere as filiereStudent, cl.abbreviation as nomClasseStudent from post_like_students pls INNER JOIN posts p INNER JOIN students s INNER JOIN classes cl WHERE s.id = pls.student_id and p.id = pls.post_id and cl.id = s.classe_id and pls.post_id = ?', [$id]);
        return  $resultSQL;
    }

    public function deleteLikePostStudent($id)
    {
        return PostLikeStudent::destroy($id);
    }
     
    public function testLikeOfPostFromStudent($idPost, $idStudent)
    {
        $verify = PostLikeStudent::where('post_id', '=', $idPost)->where('student_id', '=', $idStudent)->first();
        if ($verify) {
            return $verify;
        }
        else{
            return $verify=[];
        }
    }



    //Like Post(Forum) Teacher ------------------------------------------------------------------
    public function createNewLikeTeacher(Request $request)
    {
        $post              = new PostLikeTeacher;
        $post->post_id     = $request->input('post_id');
        $post->teacher_id  = $request->input('teacher_id');
        $post->statut      = $request->input('statut');
    
        $post->save();
    }

    public function getAllLikeFromAllPostTeacher()
    {
        $resultSQL = DB::select('Select t.id as idTeacher, p.id as idPost, pls.id as idPostLikeTable, pls.statut as likeStatut, t.full_name as fullNameTeacher from post_like_teachers pls INNER JOIN post_teachers p INNER JOIN teachers t WHERE t.id = pls.teacher_id and p.id = pls.post_id');
        return  $resultSQL;
    }

    public function getAllLikeFromAllPostByIdTeacher($id)
    {
        $resultSQL = DB::select('Select t.id as idTeacher, p.id as idPost, pls.id as idPostLikeTable, pls.statut as likeStatut, t.full_name as fullNameTeacher from post_like_teachers pls INNER JOIN post_teachers p INNER JOIN teachers t WHERE T.id = pls.teacher_id and p.id = pls.post_id and pls.teacher_id = ?', [$id]);
        return  $resultSQL;
    }

    public function getAllLikeFromAllPostByIdPostTeacher($id)
    {
        $resultSQL = DB::select('Select t.id as idTeacher, p.id as idPost, pls.id as idPostLikeTable, pls.statut as likeStatut, t.full_name as fullNameTeacher, t.nom as nomTeacher, t.prenom as prenomTeacher, t.profile_image as photoProfileTeacher, t.email as email, t.poste as professionTeacher from post_like_teachers pls INNER JOIN post_teachers p INNER JOIN teachers t WHERE t.id = pls.teacher_id and p.id = pls.post_id and pls.post_id = ?', [$id]);
        return  $resultSQL;
    }

    public function deleteLikePostTeacher($id)
    {
        return PostLikeTeacher::destroy($id);
    }
     
    public function testLikeOfPostFromTeacher($idPost, $idTeacher)
    {
        $verify = PostLikeTeacher::where('post_id', '=', $idPost)->where('teacher_id', '=', $idTeacher)->first();
        if ($verify) {
            return $verify;
        }
        else{
            return $verify=[];
        }
    }










    public function myUrl ()
    {
        $myurl = DB::select('select localServer from api');
       	return $myurl;
    }

    public function login(Request $request)
    {

        $students = DB::select('select * from personal_access_tokens where tokenable_id = ?', [9]);
        if ($students === null) {
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
                $user = Auth::user(); 
                $success['token'] =  $user->createToken('StudentApp')-> accessToken; 
                $success['name'] =  $user->name;
       
                return $this->sendResponse($success, 'User login successfully.');
            } 
            else{ 
                return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
            } 

        } else {
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
                $user = Auth::user(); 
                $success['token'] =  $user->createToken('StudentApp')-> accessToken; 
                $NewToken = $success['token']; 
       
                $updateTokenStudent = DB::table('personal_access_tokens')->where('tokenable_id', 9)->update(array('token' => $NewToken));
            return $this->sendResponse($success, 'Student New Login Token successfully.');
            }
            else{ 
                return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
            }
        }

        


        // if(!Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        // {
        //     return response()->json([
        //         "success"=>false,
        //         "status"=>200
        //     ]);
        // }
        // $user = auth()->user();
        // return $user;
        // $token = $user->createToken($request->token_name);
        // return $token->$token->plainTextToken;

        // $token = $request->user()->createToken($request->token_name);
        // return ['token' => $token->plainTextToken];
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
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(!Auth::attempt($request->only('email', 'password')))
        {
            throw new AuthenticationException();
        }

        return [
            'token' => auth()->user()->createToken('web')->plainTextToken
        ];
    }
    
    public function storeStudentToken(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(!Auth::attempt($request->only('email', 'password')))
        {
            throw new AuthenticationException();
        }

        return [
            'token' => auth()->user()->createToken('web')->plainTextToken
        ];
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
