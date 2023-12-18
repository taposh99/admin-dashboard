<?php

namespace App\Http\Controllers;

use App\Models\ParentService;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $serviceData = Service::latest()->get();
        return view("service.index", [
            'serviceData' => $serviceData,
        ]);
    }

    //create service srore
    public function store(Request $request)
    {
        $request->validate([
            'service_name' => 'required',

        ]);

        Service::create([
            'service_name' => $request->service_name,

        ]);

        return back()->with('success', 'Data created successfully');
    }

    public function parentServiceIndex()
    {

        $parentService = Service::with('parentService')->latest()->get();
        $allParentServices = ParentService::with('service')->latest()->get();
        return view('parentService.index', compact('parentService','allParentServices',));
    }

    

    public function parentServiceStore(Request $request)
    {
        $request->validate([
            'service_id' => 'required',
            'parent_description' => 'required',
            'image' => 'required',
        ]);



        // Initialize $fileName
        // $fileName = null;

        // Check if an image is provided
        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('public/images', $fileName);
        }
 

        ParentService::create([
            'service_id' => $request->service_id,
            'parent_description' => $request->parent_description,
            'image' => $fileName,

        ]);
        
        return back()->with('success', 'Data created successfully');
    }

    //child service
    public function childServiceIndex()
    {

        $parentService = Service::with('parentService')->latest()->get();
        // $allParentServices = ParentService::with('service')->latest()->get();
        return view('childService.index', compact('parentService',));
    }
    
    public function childServiceStore(Request $request)
    {

        $request->validate([
            'service_id' => 'required',
            'child_description' => 'required',
            'child_icon' => 'required',
            'banner' => 'required',
        ]);



        // Initialize $fileName
        // $fileName = null;

        // Check if an image is provided
        if ($request->hasFile('banner')) {
            $fileNamebanner = time() . '.' . $request->banner->getClientOriginalExtension();
            $request->banner->storeAs('public/images', $fileNamebanner);
        }
 
        if ($request->hasFile('child_icon')) {
            $fileNameicon = time() . '.' . $request->child_icon->getClientOriginalExtension();
            $request->child_icon->storeAs('public/images', $fileNameicon);
        }
 

        ParentService::create([
            'service_id' => $request->service_id,
            'child_description' => $request->child_description,
            'banner' => $fileNamebanner,
            'child_icon' => $fileNameicon,

        ]);
        
        return back()->with('success', 'Data created successfully');
    }



}
