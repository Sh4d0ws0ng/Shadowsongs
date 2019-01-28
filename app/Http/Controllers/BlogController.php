<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Review;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class BlogController extends Controller {

  public function __construct() {
    $this->middleware('auth')->except(['index', 'show']);
  }

  public function index() {
    $blogs = Blog::latest()->paginate(15);

    return view('blogs.index', compact('blogs'));
  }

  public function create() {
    $tags = Tag::orderBy('name', 'asc')->get();
    return view('blogs.create', compact('tags'));
  }

  public function show(Blog $blog) {
    $reviews = DB::table('reviews')->where('blog_id', $blog->id)->get();
    $listentothis = Blog::latest()->where('id', '!=', $blog->id)->first();
    return view('blogs.show', compact('blog', 'reviews', 'listentothis'));
  }

  public function store(Request $request, $type) {
    $specialCharacters = array('<', '>', '?', '"', ':', '|', '\\', '/', '*', '#');

    $this->validate(request(), [
      'blog_title' => 'required',
      'blog_content' => 'required'
    ]);

    if($request->hasFile('blog_img')) {
      if($request->blog_img->isValid()) {
        $extension = $request->blog_img->extension();
        $img = request('blog_title'). '.' . $extension;
        $img = str_replace($specialCharacters, "_", $img);
        $filePath = $request->blog_img->storeAs('public/blog', $img);
      }
    } else {
      $img = "";
    }

    switch($type) {
      case 'blogstd':
        $blog = Blog::create([
          'title' => request('blog_title'),
          'content' => request('blog_content'),
          'img' => $img,
          'user_id' => auth()->id()
        ]);
        break;


      case 'review_catchup':
        $titles = $request->input('sReview_titles.*');
        $artists = $request->input('sReview_artists.*');
        $contents = $request->input('sReview_contents.*');
        $ratings = $request->input('sReview_ratings.*');

        if($request->hasFile('sReview_imgs.*')) {
          $files = 0;
          foreach($request->file('sReview_imgs.*') as $file) {
            $imgs[$files] = $file;
            $files++;
          }
        }

        if(!is_null($titles[0])) {
          for($i = 0; $i < count($titles); $i++) {
            if($request->hasFile('sReview_imgs.*')) {
              if($imgs[$i]->isValid()) {
                $extension = $imgs[$i]->extension();
                $img[$i] = $artists[$i].' - '.$titles[$i].'.'.$extension;
                $img[$i] = str_replace($specialCharacters, "_", $img[$i]);
                $filePath = $imgs[$i]->storeAs('public/cover', $img[$i]);
              } else {
                $img[$i] = "";
              }
            } else {
              $img[$i] = "";
            }

            Review::create([
              'title'  => $titles[$i],
              'artist' => $artists[$i],
              'content'=> $contents[$i],
              'img'    => $img[$i],
              'rating' => $ratings[$i],
              'user_id' => auth()->id(),
              'blog_id' => $blog->id
            ]);
          }
        }

        $blog = Blog::create([
          'title' => request('blog_title'),
          'content' => request('blog_content'),
          'img' => $img,
          'user_id' => auth()->id()
        ]);
        break;


      case 'listentothis':
        if($request->has('blog_url')) {
          $urlSplit = explode("?v=", request('blog_url'));
          $content = request('blog_content') . '<iframe width="640" height="360" class="iframe" src="https://www.youtube.com/embed/' . $urlSplit[1] . '?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
          $img = request('blog_title');
          $img = str_replace($specialCharacters, "_", $img);
          $imgData = file_get_contents('http://img.youtube.com/vi/' . $urlSplit[1] .'/maxresdefault.jpg');
          Storage::put('public/blog/' . $img . '.jpg', $imgData);

          $blog = Blog::create([
            'title' => request('blog_title'),
            'content' => $content,
            'img' => $img . '.jpg',
            'link' => request('blog_url'),
            'user_id' => auth()->id()
          ]);
          break;
        }
    }

    if($request->has(['blog_tags'])) {
      $tags = $request->input('blog_tags.*');
      for($i = 0; $i < count($tags); $i++) {
        $blog->tags()->attach($tags[$i]);
      }
    }

    session()->flash('message', 'Blogeintrag erfolgreich erstellt!');

    return redirect('/blog');
  }

  public function edit(Blog $blog) {
    $reviews = DB::table('reviews')->where('blog_id', $blog->id)->get();
    $tags = Tag::orderBy('name', 'asc')->get();
    return view('blogs.edit', compact('blog', 'reviews', 'tags'));
  }

  public function update(Blog $blog, Request $request) {
    $specialCharacters = array('<', '>', '?', '"', ':', '|', '\\', '/', '*', '#');

    $this->validate(request(), [
      'blog_title' => 'required',
      'blog_content' => 'required',
      'blog_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);
    switch(request('type')) {
      case 'blogstd':
        if($request->hasFile('blog_img')) {
          if($request->blog_img->isValid()) {
            $extension = $request->blog_img->extension();
            $img = request('blog_title'). '.' . $extension;
            $specialCharacters = array('<', '>', '?', '"', ':', '|', '\\', '/', '*', '#');
            $img = str_replace($specialCharacters, "_", $img);
            $filePath = $request->blog_img->storeAs('public/blog', $img);
          }
          $blog->fill([
            'title' => request('blog_title'),
            'content' => request('blog_content'),
            'img' => $img,
            'user_id' => auth()->id()
          ]);
        } else {
          $blog->fill([
            'title' => request('blog_title'),
            'content' => request('blog_content'),
            'user_id' => auth()->id()
          ]);
        }
        break;


      case 'review_catchup':
        if($request->hasFile('blog_img')) {
          if($request->blog_img->isValid()) {
            $extension = $request->blog_img->extension();
            $img = request('blog_title'). '.' . $extension;
            $specialCharacters = array('<', '>', '?', '"', ':', '|', '\\', '/', '*', '#');
            $img = str_replace($specialCharacters, "_", $img);
            $filePath = $request->blog_img->storeAs('public/blog', $img);
          }
          $blog->fill([
            'title' => request('blog_title'),
            'content' => request('blog_content'),
            'img' => $img,
            'user_id' => auth()->id()
          ]);
        } else {
          $blog->fill([
            'title' => request('blog_title'),
            'content' => request('blog_content'),
            'user_id' => auth()->id()
          ]);
        }

        if($request->has(['blog_tags'])) {
          $blog->tags()->detach();
          $tags = $request->input('blog_tags.*');
          for($i = 0; $i < count($tags); $i++) {
            $blog->tags()->attach($tags[$i]);
          }
        }
        break;

      case 'listentothis':
        $content = request('blog_content');
        $start = strpos($content, '<iframe');
        $end   = strpos($content, '</iframe>');
        $length = abs($start - $end);
        $between = substr($content, $start, $length + 9);
        $content = str_replace($between, '', $content);

        if($request->has('blog_link')) {
          Storage::delete('/public/blog/'.$blog->img);
          $urlSplit = explode("?v=", request('blog_link'));
          $content = $content . '<iframe width="640" height="360" class="iframe" src="https://www.youtube.com/embed/' . $urlSplit[1] . '?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
          $img = request('blog_title');
          $img = str_replace($specialCharacters, "_", $img);
          $imgData = file_get_contents('http://img.youtube.com/vi/' . $urlSplit[1] .'/maxresdefault.jpg');
          Storage::put('public/blog/' . $img . '.jpg', $imgData);

          $blog->fill([
            'title' => request('blog_title'),
            'content' => $content,
            'img'     => $img . '.jpg',
            'link'    => request('blog_link'),
            'user_id' => auth()->id()
          ]);
          break;
        }
    }

    $blog->save();

    session()->flash('message', 'Blogeintrag erfolgreich aktualisiert!');

    return redirect('/blog/'.$blog->id);
  }

  public function delete(Blog $blog) {
    if($blog->img != '') {
      Storage::delete('/public/blog/'.$blog->img);
    }

    Blog::destroy($blog->id);

    return redirect('/blog');
  }
}
