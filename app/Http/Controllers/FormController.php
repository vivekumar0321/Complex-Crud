<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function show()
    {
        $data = Form::all();
        return view('welcome', compact('data'));
    }
    public function index()
    {
        return view('index');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string',
            'country' => 'required|string',
            'skill' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $data = new Form();
        $data->name = $request->name;
        $data->gender = $request->gender;
        $data->country = $request->country;
        $skills = $request->skill;
        $data->skill = is_array($skills) ? implode(',', $skills) : null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $image->move(public_path('storage/images'), $imageName);
            $data->image = $imageName;
        }
        $data->save();
        return redirect()->route('show')->with('success', 'Record added successfully!');
    }

    public function edit($id)
    {
        $data = Form::findOrFail($id);
        return view('edit', compact('data'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string',
            'country' => 'required|string',
            'skill' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = Form::findOrFail($id);
        $data->name = $request->name;
        $data->gender = $request->gender;
        $data->country = $request->country;
        $skills = $request->skill;
        $data->skill = is_array($skills) ? implode(',', $skills) : null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/images'), $imageName);
            $data->image = $imageName;
        }
        $data->save();
        return redirect()->route('show')->with('success', 'Record updated successfully!');
    }
    public function destroy($id)
    {
        $data = Form::findOrFail($id);
        $data->delete();
        return redirect()->route('show')->with('success', 'Record deleted successfully!');
    }
}
