<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Management;
use App\Models\Page;
use App\Models\Study;
use App\Models\Relive;
use App\Models\Tender;
use Illuminate\Http\Request;
use App\Models\Trainingevent;

class PageController extends Controller
{
    public function home(Request $request)
    {
        return view('frontend.home');
    }

    public function vision(Request $request)
    {
        return view('frontend.vision');
    }
    public function room(Request $request)
    {
        return view('frontend.room');
    }
    public function infastructure(Request $request)
    {
        return view('frontend.infastructure');
    }

    public function mission(Request $request)
    {
        return view('frontend.mission');
    }

    public function contact_us(Request $request)
    {
        return view('frontend.contact');
    }

    public function hostel_facility(Request $request)
    {
        return view('frontend.hostel');
    }

    public function about(Request $request)
    {
        return view('frontend.about');
    }



    public function gallery(Request $request)
    {
        return view('frontend.gallery');
    }

    public function galleryDetail($slug)
    {
        $gallery = Gallery::where('slug', $slug)->first();
        if ($gallery) {
            return view('frontend.gallery-detail', compact('gallery'));
        } else {
            abort(404);
        }
    }

    public function tenders(Request $request)
    {
        return view('frontend.tenders');
    }

    public function placementservice(Request $request)
    {
        return view('frontend.placementservice');
    }

    public function boardofdirectory(Request $request)
    {
        return view('frontend.boardofdirectory');
    }
    public function teamofmember(Request $request)
    {
        return view('frontend.teammember');
    }
    public function traningprogramme(Request $request)
    {
        return view('frontend.traningprogramme');
    }
    public function studymaterial(Request $request)
    {
        return view('frontend.studymaterial');
    }
    public function relivingorders(Request $request)
    {
        return view('frontend.relivingorders');
    }
    public function feedback(Request $request)
    {
        return view('frontend.feedback');
    }


    public function training_show($id)
    {

        $trainingEvents = Trainingevent::where('category_id', $id)->get();
        return view('frontend.show', compact('trainingEvents'));
    }
    public function reliving_show($id)
    {
        $trainingEvents = Relive::where('category_id', $id)->get();
        return view('frontend.relivingshow', compact('trainingEvents'));
    }


    public function study_show($id)
    {
        $trainingEvents = Study::where('category_id', $id)->get();
        return view('frontend.studyshow', compact('trainingEvents'));
    }

    public function tender_show($id)
    {
        $trainingEvents = Tender::where('category_id', $id)->get();
        return view('frontend.tendersshow', compact('trainingEvents'));
    }
    public function page($slug)
    {
        $page = Page::where('slug', $slug)->first();
        return view('frontend.page', compact('page'));
    }
    public function managementDetail($slug)
    {
        $management = Management::where('slug', $slug)->first();
        return view('frontend.management-detail', compact('management'));
    }
}
