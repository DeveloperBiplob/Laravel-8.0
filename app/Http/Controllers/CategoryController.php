<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categorys = Category::all();
        return view('category.index', compact('categorys'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();

        $request->validate([
            'name' => ['required'],
            'image' => ['required']
        ]);

        $file = $request->file('image');
        $fileName = time() . '_' . uniqid() . '.' . $file->extension();
        storage::putFileAs("public/image", $file, $fileName);
        $path = "storage/image/" . $fileName;
        
        

        $data = [
            'name'=> $request->name,
            'user_id'=>1, // Authorazition perpose
            'slug'=> Str::slug($request->name),
            'status'=> $request->status,
            'image'=> $path,
        ];
        $result = Category::create($data);

        // if($result){
        //     $this->setErrorMessage('Data save!', 'success');
        //     return redirect()->route('category.index');
        // }else{
        //     return back();
        // }
        return redirect()->route('category.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        // $category = Category::findOrFail($id);
        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        //     Gate::allows('isAdmin') ? Response::allow()
        //          : abort(403);
    
        //  # Or 
        //      if (Gate::allows('isAdmin')) {
        //          dd('Only admin can access this page');
        //      } else {
        //          dd('You are not Admin');
        //      }
        //     return view('gate.post.create');
    
        //   # Or
        //     if (Gate::denies('isAdmin')) {
    
        //         dd('You are not admin');
    
        //     } else {
        //         dd('Admin allowed');
        //     }

        // controller e use korle, jodi url jene o thake o taw access korte parbe na. 
        // jodi shudu view file e @can e use kore tile url janle access korte parbe
        // ti controller plus view 2ta te use korbo
        Gate::allows('edit-category', $category) ? Response::allow() 
            : abort(403);




        // $category = Category::findOrFail($id);
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // $request->validate([
        //     'name' => ['required'],
        //     'image' => ['required']
        // ]);

        $oldImgPath = $category->image;
        
        if($request->file('image')){

            $file = $request->file('image');
            $fileName = time() . '_' . uniqid() . '.' . $file->extension();
            storage::putFileAs("public/image", $file, $fileName);
            $path = "storage/image/" . $fileName;
            
            
            
            $data = [
                'name'=> $request->name,
                'slug'=> Str::slug($request->name),
                'status'=> $request->status,
                'image'=> $path,
            ];
            $category->update($data);

            if(file_exists($oldImgPath)){
                unlink($oldImgPath);
            }
        }else{
            $category->update([
                'name'=> $request->name,
                'slug'=> Str::slug($request->name),
                'status'=> $request->status,
            ]);
        }

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // return $category->destroy($category);

        if(file_exists($category->image)){
            unlink($category->image);
        }
        $category->delete();
        return back();

    }
}
