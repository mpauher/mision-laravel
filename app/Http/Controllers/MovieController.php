<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index(){
        try{
            $movies = Movie::all();
            if(count($movies) == 0) {
                return response()->json();
            }
            return response()->json([
                'movies' => $movies,          
            ], 200);

        }catch (\Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }

    public function show($id){
        try{
            $movie = Movie::find($id);

            return response()->json([
                'movie' => $movie
            ],200);

        }catch (\Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }

    public function create(Request $request){
        try{
            $request->validate([
            'name'=>'required|string',
            'year'=>'required|integer',
            'director'=>'required|string',
            'category'=>'string',
            'description'=>'string',
            ]);

            $movie = Movie::create([
            'name'=>$request->name,
            'year'=>$request->year,
            'director'=>$request->director,
            'category'=>$request->category,
            'description'=>$request->description,
            ]);

            return response()->json([
                'message'=>'Movie created successfully'
            ]);
        }catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }

    public function update($id, Request $request){
        try{
            $movie = Movie::find($id);

            if(!$movie){
                return response()->json([
                    'error'=>'Movie not found'
                ],404);
            }

            $movie->update($request->all());

            return response()->json([
                'message' => 'Movie update succesfully',
            ],200);
        }catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }

    public function destroy($id){
        try{
            $movie = Movie::find($id);
            if(!$movie){
                return response()->json([
                    'error' =>'Movie not found',
                ],404);    
            }

            Movie::destroy($id);

            return response()->json([
                'message' => 'Movie deleted succesfully',
            ],200);
        } catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }

    }
}
