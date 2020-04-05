<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Repositories\BlogCategoryRepository;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Http\Requests\BlogCategoryCreateRequest;
use Illuminate\Support\Str;


class CategoryController extends BaseController
{
    /**
     * Blog Category control
     *
     * @package App\Http\Controllers\Blog\Admin
     */

     private $blogCategoryRepository;

     public function __construct(){
         parent::__construct();

         $this->blogCategoryRepository = app(BlogCategoryRepository::class);
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = $this->blogCategoryRepository->getAllWithPaginate(5);

        return view('blog.admin.categories.index',compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new BlogCategory();
        $categoryList = $this
            ->blogCategoryRepository
            ->getForComboBox();

        return view('blog.admin.categories.edit',
            compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreateRequest $request)
    {
       $data = $request->input();
       if(empty($data['slug'])) {
           $data['slug'] = Str::slug($data['title']);
       }

       // Create object but not add in DB
        $item = new BlogCategory($data);
        $item->save();

        if($item) {
            return redirect()->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'Saved successfull!']);
        } else {
            return back()->withErrors(['msg' => 'Create error'])
                ->withInput();
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
        $item = $this->blogCategoryRepository->getEdit($id);
        if(empty($item)){
            abort(404);
        }

        $categoryList = $this
            ->blogCategoryRepository
            ->getForComboBox();

        return view('blog.admin.categories.edit',
            compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        $item = BlogCategory::find($id);
        if(empty($item)){
            return back()
                ->withErrors(['msg' => "Record id[{$id}] is not found"])
                ->withInput();
        }

        $data = $request->all();
        $result = $item->update($data);

        if($result) {
            return redirect()
                   ->route('blog.admin.categories.edit', $item->id)
                   ->with(['success' => 'Saved']);
        } else {
            return back()
                ->withErrors(['msg' => "Saved error"])
                ->withInput();
        }

    }
}
