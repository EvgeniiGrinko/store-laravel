<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyOptionRequest;
use App\Models\Property;
use App\Models\PropertyOption;

class PropertyOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Property $property)
    {
        $propertyOptions = PropertyOption::paginate(10);
        return view('auth.property-options.index', compact('propertyOptions', 'property'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Property $property)
    {

        return view('auth.property-options.form', compact('property', ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyOptionRequest $request, Property $property, )
    {

        $params = $request->all();
        $params['property_id'] = $request->property->id;
        PropertyOption::create($params);
        $propertyOptions = PropertyOption::paginate(10);

        return view('auth.property-options.index', compact('property', 'propertyOptions'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PropertyOption  $propertyOption
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property, PropertyOption $propertyOption)
    {
        return view('auth.property-options.show', compact('propertyOption', 'property'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PropertyOption  $propertyOption
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property, PropertyOption $propertyOption)
    {
        return view('auth.property-options.form', compact('propertyOption', 'property'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PropertyOption  $propertyOption
     * @return \Illuminate\Http\Response
     */
    public function update( PropertyOptionRequest $request, Property $property, PropertyOption $propertyOption, )
    {

        $params = $request->all();
        $propertyOption->update($params);
        $propertyOptions = PropertyOption::paginate(10);

        return view('auth.property-options.index', compact('propertyOption', 'property', 'propertyOptions'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PropertyOption  $propertyOption
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property, PropertyOption $propertyOption)
    {
        $propertyOption->delete();
        return redirect()->route('property-options.index', compact('property'));
    }
}
