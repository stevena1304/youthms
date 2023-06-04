<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Segmen;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewMessageNotification;
use Illuminate\Support\Facades\Notification;
use Session;
use Illuminate\Support\Carbon;

class BlogController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $segmen = Segmen::all();
        $pag = Blog::paginate(5);
        $today = date('Y-m-d');
        $Sweek = date('Y-m-d', strtotime('last Monday'));
        $Eweek = date('Y-m-d', strtotime('next Sunday'));

        $populer = blog::orderby('visitor', 'desc')->get();
        $weekly = blog::wherebetween('created_at', [$Sweek, $Eweek])->orwherebetween('updated_at', [$Sweek, $Eweek])->orderby('visitor', 'desc')->get();
        // $terpilih = blog::where()->get();        //pending

        $seminggu = Carbon::now()->subWeek();
        // $orderedbyadmin = ;          //pending
        $recently_uploaded = blog::orderby('created_at', 'desc')->get();
        $recently_lastweek = blog::where('created_at', '>', $seminggu)->get();


        if (auth()->check()) {
            $u = auth()->user()->role->role;
            $admin = ['admin', 'owner'];
            if (in_array($u, $admin)) {
                return view('Admin.blog.index', compact('blog', 'segmen'));
            } else {
                return view('EU.blog.index', compact('blog', 'segmen'));
            }
        } else {
            return view('EU.blog.index', compact('blog', 'segmen'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $segmen = Segmen::all();
        return view('Admin.blog.add', compact('segmen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //insert id artikel
        $blog = Blog::count();
        $currentNumber = $blog;
        $nextNumber = str_pad(++$currentNumber, 5, '0', STR_PAD_LEFT); // "00002"

        //insert tanggal sekarang
        $tanggal = date('Y-m-d');

        //proses image dari summernote
        $content = $request->isi;
        $dom = new \DomDocument();
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');

        foreach ($imageFile as $item => $image) {
            $data = $image->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $imgeData = base64_decode($data);
            $image_name = "/upload/" . time() . $item . '.png';
            $path = public_path() . $image_name;
            file_put_contents($path, $imgeData);

            $image->removeAttribute('src');
            $image->setAttribute('src', $image_name);
        }

        $content = $dom->saveHTML();

        //simpan ke db
        $blog = Blog::create([
            'id_artikel' => $nextNumber,
            'judul' =>  $request->judul,
            'tanggal' =>  $tanggal,
            'segmen_id' =>  $request->segmen_id,
            'users_id' => auth()->user()->id,
            'isi' => $content,
        ]);

        notify()->success('Artikel Berhasil Ditambahkan !!');
        // mengirim notifikasi
        $user = User::whereHas('role', function ($query) {
            $query->whereIn('role', ['admin', 'owner']);
        })->get();
        $message = "Artikel Berhasil Ditambahkan !!";
        $notification = new NewMessageNotification($message);
        $notification->setUrl(route('blog.show', ['blog' => $blog->id])); // Ganti dengan rute yang sesuai
        Notification::send($user, $notification);
        return redirect('blog');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        $data = Blog::find($blog->id);
        return view('Admin.blog.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $segmen = Segmen::all();
        $data = Blog::find($blog->id);
        return view('Admin.blog.edit', compact('data', 'segmen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);
        //insert tanggal sekarang
        $tanggal = date('Y-m-d');

        //proses image dari summernote
        $content = $request->isi;
        libxml_use_internal_errors(true);
        $dom = new \DomDocument();
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | libxml_use_internal_errors(true));
        $imageFile = $dom->getElementsByTagName('img');

        foreach ($imageFile as $item => $image) {
            $data = $image->getAttribute('src');
            if (strpos($data, ';') === false) {
                continue;
            }
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $imgeData = base64_decode($data);
            $image_name = "/upload/" . time() . $item . '.png';
            $path = public_path() . $image_name;
            file_put_contents($path, $imgeData);

            $image->removeAttribute('src');
            $image->setAttribute('src', $image_name);
        }

        $content = $dom->saveHTML();


        //simpan ke db
        $blog->update([
            'id_artikel' => $request->id_artikel,
            'judul' =>  $request->judul,
            'tanggal' =>  $tanggal,
            'segmen_id' =>  $request->segmen_id,
            'users_id' => $request->users_id,
            'isi' => $content,
        ]);
        notify()->success($request->judul . ' Berhasil Diubah !!');
        // mengirim notifikasi
        $user = User::whereHas('role', function ($query) {
            $query->whereIn('role', ['admin', 'owner']);
        })->get();
        $message = $request->judul . " Berhasil Diubah !!";
        $notification = new NewMessageNotification($message);
        $notification->setUrl(route('blog.show', ['blog' => $blog->id])); // Ganti dengan rute yang sesuai
        Notification::send($user, $notification);
        return redirect('blog/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }

    public function hapus($id)
    {
        $data = Blog::find($id);
        $data->delete();
        notify()->success('Artikel Berhasil Dihapus !!');
        // mengirim notifikasi
        $user = User::whereHas('role', function ($query) {
            $query->whereIn('role', ['admin', 'owner']);
        })->get();
        $message = "Artikel Berhasil Dihapus !!";
        $notification = new NewMessageNotification($message);
        $notification->setUrl(route('blog.index')); // Ganti dengan rute yang sesuai
        Notification::send($user, $notification);
        return redirect('blog')->with('hapus', 'Artikel Berhasil Dihapus!!');
    }
}
