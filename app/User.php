<?php

namespace App;

use App\Post;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class User
{
    private $post;

    public function __construct(Post $post){
        $this->post = $post;
    }

    public function get()
    {
        $response = Http::get(config('api.endpoint') . '/users');
        
        if($response->clientError()) {
            abort(404);
        }

        $users = $response->json();

        for($i=0; $i < count($users); $i++) {
            $users[$i]['posts'] = $this->post->getByUser($users[$i]);
            for($j=0; $j < count($users[$i]['posts']); $j++) {
                $users[$i]['posts'][$j]['valuation'] = $this->post->getValuation($users[$i]['posts'][$j], $users[$i]['posts']);
            }

            $users[$i]['posts'] = $this->post->orderByValuation($users[$i]['posts'], 'desc');
            $users[$i]['valuation'] = $this->calculateValuation($users[$i]['posts']);
        }

        $users = $this->orderByValuation($users, 'desc');

        return $users;
    }

    private function calculateValuation($posts) {
        return array_reduce($posts, function($carry, $post) {
            return $carry += $post['valuation'];
        });
    }

    private function orderByValuation($users, $order = 'asc') {
        if($order == 'desc') {
            return array_reverse(array_values(Arr::sort($users, function ($user) {
                return $user['valuation'];
            })));
        } else {
            return array_values(Arr::sort($users, function ($user) {
                return $user['valuation'];
            }));
        }
    }
}
