<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\Etudiant;
use App\Models\Post;
use Illuminate\Http\Request;
use Exception;

class PostsController extends Controller
{

    /**
     * Display a listing of the posts.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::with('club','etudiant')->paginate(25);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $clubs = Club::pluck('name','id')->all();
$etudiants = Etudiant::pluck('name','id')->all();
        
        return view('posts.create', compact('clubs','etudiants'));
    }

    /**
     * Store a new post in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            Post::create($data);

            return redirect()->route('posts.post.index')
                ->with('success_message', 'Post was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified post.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $post = Post::with('club','etudiant')->findOrFail($id);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $clubs = Club::pluck('name','id')->all();
$etudiants = Etudiant::pluck('name','id')->all();

        return view('posts.edit', compact('post','clubs','etudiants'));
    }

    /**
     * Update the specified post in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            $post = Post::findOrFail($id);
            $post->update($data);

            return redirect()->route('posts.post.index')
                ->with('success_message', 'Post was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified post from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->delete();

            return redirect()->route('posts.post.index')
                ->with('success_message', 'Post was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    
    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
                'club_id' => 'nullable',
            'Titre' => 'string|min:1|nullable',
            'description' => 'string|min:1|max:1000|nullable',
            'photo' => ['file','nullable'],
            'date' => 'string|min:1|nullable',
            'lieu' => 'string|min:1|nullable',
            'etudiant_id' => 'nullable', 
        ];

        
        $data = $request->validate($rules);

        if ($request->has('custom_delete_photo')) {
            $data['photo'] = null;
        }
        if ($request->hasFile('photo')) {
            $data['photo'] = $this->moveFile($request->file('photo'));
        }



        return $data;
    }
  
    /**
     * Moves the attached file to the server.
     *
     * @param Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return string
     */
    protected function moveFile($file)
    {
        if (!$file->isValid()) {
            return '';
        }
        

        $path = config('laravel-code-generator.files_upload_path', 'uploads');
        $saved = $file->store('public/' . $path, config('filesystems.default'));

        return substr($saved, 7);
    }
}
