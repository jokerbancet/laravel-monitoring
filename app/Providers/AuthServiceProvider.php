<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Laporan;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('dosenpembimbing', function(User $user){
            return $user->role=='dosenpembimbing';
        });
        Gate::define('pembimbingindustri', function(User $user){
            return $user->role=='pembimbingindustri';
        });
        Gate::define('mahasiswa', function(User $user){
            return $user->role=='mahasiswa';
        });
        Gate::define('status-laporan', function(User $user, Laporan $laporan){
            $pemagang = $laporan->pemagangan;
            if($pemagang->dosenPembimbing==auth()->user()->dosenpembimbing){
                return $laporan->approve_dosen!='pending';
            }elseif($pemagang->dosenPembimbing2==auth()->user()->dosenpembimbing){
                return $laporan->approve_dosen2!='pending';
            }else{
                return $laporan->approve_industri!='pending'&&!is_null($laporan->approve_industri_nilai);
            }
        });
        //
    }
}
