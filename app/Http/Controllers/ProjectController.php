<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ProjectController extends Controller
{
    public function index($theme)
    {
        $projects = Cache::remember('github_projects', 86400, function () {
            $response = Http::withHeaders([
                'User-Agent' => 'Portfolio-App'
            ])->get('https://api.github.com/users/foustujian-sketch/repos');
            
            if ($response->successful()) {
                $allRepos = $response->json();
                $bestRepos = ['Dashboard_DSS_laravelFramework', 'Laravel-use-of-API', 'evnt-news-app', 'Android-App-For-Plant-Care'];
                
                return array_filter($allRepos, function($repo) use ($bestRepos) {
                    return in_array($repo['name'], $bestRepos);
                });
            }
            return [];
        });

        if ($theme === 'clean') {
            return view('clean.projects', ['projects' => $projects]);
        }
        
        return view('creative.projects', ['projects' => $projects]);
    }
}
