<?php namespace Halo;

use Aastategija\Administrator;
use Aastategija\GetScores;

class scores extends Controller
{
    // does not require a logged in user
    public $requires_auth = false;

    function index()
    {
        // get all results
        $this->scores = Administrator::getResults();
    }
}