<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

use App\Tag;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // Tutti i dati dal più nuovo al più vecchio
        $posts = Post::orderBy('created_at', 'desc')->paginate(7);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        // Mi servono i tag (dall'array contenente html,css,javascript ecc creato nella pagina tags.seeder) per creare la checkbox con label associate
        $tags= Tag::all();   

        return view('posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Get data 
        $data = $request->all();
        // Validation
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            // Deve essere di tipo img
            'path_img' => 'image'
        ]);
        // ?Set slug
        $data['slug'] = Str::slug($data['title'], '-');
        // ?Controllo presenza img
        if(!empty($data['path_img'])) {
            $data['path_img'] = Storage::disk('public')->put('images', $data['path_img']);
        }
        // Salvataggio dati metodo $fillable
        $newPost = new Post();
        $newPost->fill($data);

        $saved = $newPost->save();

        if($saved) {
            if(!empty($data['tags'])) {
                $newPost->tags()->attach($data['tags']);
            }
            return redirect()->route('posts.index');
        } else return redirect()->route('homepage');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // Show by slug sintax w/ no unique (in questo caso dico di prendere il primo elemento che corrisponde a tale slug)
        $post = Post::where('slug', $slug)->first();
         // Check sull'esistenza del post quando l'utente cerca erroneamente tramite url (se non c'è = null e restitutisco vista 404 peronalizzata)
         if(empty($post)) {
            abort(404);
        }

         return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {   
        $post = Post::where('slug', $slug)->first();
        $tags = Tag::all();


        return view('posts.edit', compact('post', 'tags'));
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
        // Get data 
        $data = $request->all();
        // Validazione
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            // Deve essere di tipo img
            'path_img' => 'image'
        ]);
        // Get post to updated
        $post = Post::find($id);

        // ?Gestione slug in caso di cambiamento titolo 
        $data['slug'] = Str::slug($data['title'], '-');

        // ?Controllo presenza img nel caso di update dell'immagine esistente quella di prima va eliminata e rimpiazzata con quella nuova
        if(!empty($data['path_img'])) {
            if(!empty($post->path_img)) {
                Storage::disk('public')->delete($post->path_img);
            }

            $data['path-img'] = Storage::disk('public')->put('images', $data['path_img']);
        }
        // Update
        $updated = $post->update($data); // Fillable 
        // Redirect
        if($updated) {

            if(!empty($data['tags'])) {
                $post->tags()->sync($data['tags']);
            } else $post->tags()->detach();

            return redirect()->route('posts.show', $post->slug);
        }else return redirect()->route('homepage');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = Post::where('slug', $slug)->first();

        $title = $post->title;

        $deleted = $post->delete();

        // Tags relations delete when post deletes
        $post->tags()->detach();

        if($deleted) {
            if(!empty($post->path_img)) {
                Storage::disk('public')->delete($post->path_img);
            }
            return redirect()->route('posts.index')->with('post-deleted', $title);
        } else {
            return redirect()->route('homepage');
        }
    }
}
