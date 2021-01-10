<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Response;

class FileGeneratorController extends Controller
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function csv()
    {
        if(file_exists('users_posts_valuation.csv')){
            unlink('users_posts_valuation.csv');
        }

        $users = $this->user->get();

        $output = [
            ['Id Usuario', 'Nombre usuario', 'Valoración de usuario', 'Id Post', 'Valoración de post']
        ];

        foreach($users as $user) {
            $userData = [
                $user['id'],
                $user['name'],
                $user['valuation'],
            ];

            foreach($user['posts'] as $post) {
                $postData = [
                    $post['id'],
                    $post['valuation']
                ];
                
                $output[] = array_merge($userData, $postData);
            }
        }
        
        $file = fopen("users_posts_valuation.csv", "a");

        foreach($output as $fields) {
            fputcsv($file, $fields);
        }

        fclose($file);

        return response()->json([
            'success' => true,
        ]);
    }

    public function download() {
        $filename = "users_posts_valuation.csv";

        $headers = array(
            'Content-Type' => 'text/csv',
        );
    
        return Response::download($filename, 'users_posts_valuation.csv', $headers);
    }
}
