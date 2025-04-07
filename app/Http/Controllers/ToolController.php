<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use App\Http\Requests\StoreToolRequest;
use App\Http\Requests\UpdateToolRequest;

class ToolController extends Controller
{
  

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreToolRequest $request)
    {
        $tool = Tool::create($request->validated());

        return redirect()->route('home')->with('success', 'Tool created successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateToolRequest $request, Tool $tool)
    {
        $tool->update($request->validated());

        return redirect()->route('home')->with('success', 'Tool updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tool $tool)
    {
        $tool->delete();

        return redirect()->route('home')->with('success', 'Tool deleted successfully');
    }
}
