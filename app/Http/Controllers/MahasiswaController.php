<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMahasiswaRequest;
use App\Http\Requests\EditMahasiswaRequest;
use App\Models\Laporan;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Pemagangan;
use App\Models\User;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(in_array(auth()->user()->role, ['admin','Direktur'])){
            $data_mahasiswa = Mahasiswa::all();
            $trash = Mahasiswa::onlyTrashed()->count();
        }else{
            $jurusan = jurusan();
            $data_mahasiswa = Mahasiswa::where('jurusan', $jurusan)->get();
            $trash = Mahasiswa::onlyTrashed()->where('jurusan',$jurusan)->count();
        }
        return view('mahasiswa.index', ['data_mahasiswa' => $data_mahasiswa, 'trash' => $trash, 'jurusan' => $jurusan??'']);
    }

    public function trash()
    {
        $mahasiswa = Mahasiswa::onlyTrashed()->get();
        return view('mahasiswa.trash', compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateMahasiswaRequest $request)
    {
        //inisialisasi store data user
        $user = new \App\Models\User;
        $user->role = 'mahasiswa';
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt('passwordmahasiswa');
        $user->remember_token = Str::random(60);
        $user->save();

        //add user_id
        $request->request->add(['user_id' => $user->id]);
        //store data ke tabel mahasiswa
        $mahasiswa = Mahasiswa::create($request->all());
        //pengecekan gambar dan mengalihkan gambar ke folder images
        if($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $mahasiswa->avatar = $request->file('avatar')->getClientOriginalName();
            $mahasiswa->save();
        }
        return redirect('/mahasiswa')->with('sukses','Data Berhasil di input');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function dataBimbingan()
    {
        if(Gate::allows('hrd')){
            $mahasiswa = Pemagangan::with(['laporan'=>function($laporan){
                return $laporan->where('status_laporan','pending')->get();
            }])->whereHas('pembimbingIndustri', function($q){
                return $q->where('industri_id', auth()->user()->pembimbingIndustri->industri_id);
            });
        }else{
            $id=auth()->user()->dosenPembimbing->id??
                auth()->user()->pembimbingIndustri->id;
            $where=!is_null(auth()->user()->dosenPembimbing)?
                    ['dosenpembimbing_id'=>$id]:['pembimbingindustri_id'=>$id];
            $mahasiswa = Pemagangan::where($where);
            if(!is_null(auth()->user()->dosenPembimbing)){
                $mahasiswa->orWhere(['dosenpembimbing2_id'=>$id]);
            }
        }
        $mahasiswa=$mahasiswa->whereHas('mahasiswa')->get();
        return view('mahasiswa.data',compact('mahasiswa'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $data_mahasiswa = Mahasiswa::findOrFail($id);
        $logs = $data_mahasiswa->user->logs()->latest()->limit(10)->get();
        return view('mahasiswa.detail', ['mahasiswa' => $data_mahasiswa, 'logs'=>$logs]);
    }

    public function detail_bimbingan(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.detail-histori', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_mahasiswa = Mahasiswa::find($id);
        return view('mahasiswa.edit', ['mahasiswa' => $data_mahasiswa]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditMahasiswaRequest $request, $id)
    {
        $data_mahasiswa = Mahasiswa::find($id);
        $data_mahasiswa->update($request->all());
        if($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $data_mahasiswa->avatar = $request->file('avatar')->getClientOriginalName();
            $data_mahasiswa->save();
        }
        return redirect('/mahasiswa')->with('sukses','Data Berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data_mahasiswa = Mahasiswa::find($id);
        $email = $data_mahasiswa->email;
        // User::where('email', $email)->delete();
        $data_mahasiswa->delete($id);
        return redirect('/mahasiswa')->with('sukses','Data Berhasil di hapus');
    }

    public function absen(Request $request)
    {
        if(auth()->user()->mahasiswa){
            $pemagang = auth()->user()->mahasiswa->pemagangan()->select('mulai_magang', 'selesai_magang', 'id')->first();
        }else{
            $pemagang = null;
        }

        $dates = [];

        if($pemagang){
            $absen = $pemagang->laporan()->select(DB::raw("DATE_FORMAT(tanggal_laporan, '%Y-%m-%d') as tanggal"))->pluck('tanggal');
            $period = CarbonPeriod::create($pemagang->mulai_magang, $pemagang->selesai_magang);
            foreach($period as $i => $date){
                $dates[$i] = [
                    'id' => 'date-'.$i,
                    'start' => $date->toDateString()
                ];
                if(in_array($date->toDateString(), $absen->toArray())){
                    // $dates[$i]['title'] = 'Hadir';
                    $dates[$i]['color'] = '#3c763d';
                }elseif($date->toDateString()<date('Y-m-d')){
                    // $dates[$i]['title'] = 'Alfa';
                    $dates[$i]['color'] = '#e63d3a';
                }
            }
        }

        return $request->ajax()?response()->json($dates):view('mahasiswa.absen');
    }

    public function delete_selected(Request $request)
    {
        if($request->delete_all=='true'){
            Mahasiswa::query()->delete();
        }else{
            Mahasiswa::whereIn('id', explode(',', $request->id))->delete();
        }
        return back()->with('sukses', 'Berhasil menghapus mahasiswa');
    }

    public function restore($id)
    {
        Mahasiswa::withTrashed()->find($id)->restore();

        return redirect('/mahasiswa')->with('sukses','Data Berhasil direstore');
    }

    public function restore_selected(Request $request)
    {
        if($request->restore_all=='true'){
            Mahasiswa::withTrashed()->restore();
        }else{
            Mahasiswa::withTrashed()->whereIn('id', explode(',', $request->id))->restore();
        }
        return redirect('/mahasiswa')->with('sukses', 'Berhasil menghapus mahasiswa');
    }
}
