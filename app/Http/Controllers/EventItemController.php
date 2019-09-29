<?php

namespace App\Http\Controllers;

use App\eventItem;

use Illuminate\Http\Request;


class EventItemController extends Controller
{


    public function index()
    {

        $eitem = eventItem::all();
        return view('e_item.index', compact('eitem'));

    }


    public function create()
    {
        return view('e_item.create');

    }


    public function store(Request $request)
    {
        $request->validate([
            'event_date'=>'required',
            'rq_date'=>'required',
            'item_name'=>'required',
            'qty'=>'required',
        ]);

        $items = new eventItem([
            'event_date' =>$request->get('event_date'),
            'rq_date' =>$request->get('rq_date'),
            'item_name' =>$request->get('item_name'),
            'qty' =>$request->get('qty')

        ]);


        $items->save();
        return redirect('/eitems')->with('success','Item saved!');
    }




    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $eitem = eventItem::find($id);
        return view('e_item.edit',compact('eitem'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'event_date'=>'required',
            'rq_date'=>'required',
            'item_name'=>'required',
            'qty'=>'required'

        ]);

        $eitem = eventItem::find($id);
        $eitem->event_date =  $request->get('event_date');
        $eitem->rq_date = $request->get('rq_date');
        $eitem->item_name = $request->get('item_name');
        $eitem->qty = $request->get('qty');

        $eitem->save();

        return redirect('/eitems')->with('success', 'item is  updated!');
    }

    public function destroy($id)
    {
        $eitem= eventItem::find($id);
        $eitem->delete();

        return redirect('/eitems')->with('success', 'item deleted!');
    }

}
