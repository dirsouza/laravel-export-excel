<?php

namespace App\Http\Controllers;

use App\Exports\CommandErrorExport;

class CommandErrorController extends Controller
{
    public function export(int $year = null)
    {
        return new CommandErrorExport($year);
    }
}
