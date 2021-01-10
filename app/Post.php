<?php

namespace App;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class Post
{
    public function getByUser($user)
    {
        $response = Http::get(config('api.endpoint') . '/posts', ['userId' => $user['id']]);
        
        if($response->clientError()) {
            abort(404);
        }

        return $response->json();
    }

    public function orderByValuation($posts, $order = 'asc')
    {
        if($order == 'desc') {
            return array_reverse(array_values(Arr::sort($posts, function ($post) {
                return $post['valuation'];
            })));
        } else {
            return array_values(Arr::sort($posts, function ($post) {
                return $post['valuation'];
            }));
        }
    }

    public function getValuation($evaluablePost, $posts)
    {
        $value = 0;

        $evaluatedWords = [];

        $titleWords = explode(' ', $evaluablePost['title']);
        $bodyWords = explode(' ', $evaluablePost['body']);

        foreach($titleWords as $titleWord) {
            if( ! in_array($titleWord, $evaluatedWords) ) {
                $value += $this->evaluateRepeatedWord($titleWord, $posts);
                $evaluatedWords[] = $titleWord;
            }
        }

        foreach($bodyWords as $bodyWord) {
            if( ! in_array($bodyWord, $evaluatedWords) ) {
                $value += $this->evaluateRepeatedWord($bodyWord, $posts);
                $evaluatedWords[] = $bodyWord;
            }
        }

        return $value;
    }

    private function evaluateRepeatedWord($word, $posts)
    {
        $value = 0;

        foreach($posts as $post) {
            $titleWords = explode(' ', $post['title']);
            $bodyWords = explode(' ', $post['body']);

            foreach($titleWords as $titleWord) {
                if( $word == $titleWord ) {
                    $value += 2;
                }
            }
    
            foreach($bodyWords as $bodyWord) {
                if( $word == $bodyWord ) {
                    $value += 1;
                }
            }
        }

        return $value ?? 1;
    }
}