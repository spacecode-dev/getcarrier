<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\View\View as ViewModel;

class IndexController extends Controller
{
    /**
     * @return Factory|ViewModel|void
     */
    public function get()
    {
//        $entity = parent::homeIndex();
//        $entity->indexClasses = [];
        return view('getcarrier.page.single');
    }
}