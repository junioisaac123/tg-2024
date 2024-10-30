<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChessController extends Controller
{
    //
    public function startGame()
    {

        return view('chess.game');
    }
}
