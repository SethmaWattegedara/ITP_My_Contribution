<?php

namespace App\Http\Controllers;
use App\eventReport;
use PDF;
use DB;
use Illuminate\Http\Request;

class EreportController extends Controller
{
    public function index()
    {
        $eventreport = eventReport::all();
        return view('e_report.index', compact('eventreport'));

        $eventreport = $this->get_report_data();
        return view('/ereport')->with('eventreport',$eventreport);
    }

    public function get_report_data()
    {
         $eventreport = DB::table('event_reports')
                        ->limit(10)
                        ->get();
         return $eventreport;

    }

    public function create()
    {
        return view('e_report.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name'=>'required',
            'event_date'=>'required',
            'event_time'=>'required',
            'event_manager'=>'required',
            'attendence'=>'required',
            'cost'=>'required',
            'etotal'=>'required',
            'btotal'=>'required',
        ]);

        $eventreport = new eventReport([
            'customer_name' => $request->get('customer_name'),
            'event_date' => $request->get('event_date'),
            'event_time' => $request->get('event_time'),
            'event_manager' => $request->get('event_manager'),
            'attendence' => $request->get('attendence'),
            'cost' => $request->get('cost'),
            'etotal' => $request->get('etotal'),
            'btotal' => $request->get('btotal')

        ]);

        $eventreport->save();
        return redirect('/ereport')->with('success', 'Contact saved!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $eventreport = eventReport::find($id);
        return view('e_report.edit', compact('eventreport'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_name'=>'required',
            'event_date'=>'required',
            'event_time'=>'required',
            'event_manager'=>'required',
            'attendence'=>'required',
            'cost'=>'required',
            'etotal'=>'required',
            'btotal'=>'required',
        ]);


        $eventreport = eventReport::find($id);

        $eventreport->customer_name =  $request->get('customer_name');
        $eventreport->event_date =  $request->get('event_date');
        $eventreport->event_time = $request->get('event_time');
        $eventreport->event_manager = $request->get('event_manager');
        $eventreport->attendence = $request->get('attendence');
        $eventreport->cost = $request->get('cost');
        $eventreport->etotal = $request->get('etotal');
        $eventreport->btotal = $request->get('btotal');

        $eventreport->save();

        return redirect('/ereport')->with('success', 'Contact updated!');
    }

    public function destroy($id)
    {
        $eventreport= eventReport::find($id);
        $eventreport ->delete();

        return redirect('/ereport')->with('success', 'Contact deleted!');
    }

    public function pdf()
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_report_data_to_html());
        return $pdf->stream();
    }

    function convert_report_data_to_html()
    {
        $eventreport = $this->get_report_data();
        $output = '<table class="table table-bordered">
            <tr>
            <th>Customer name </th>
            <th>Event Date</th>
            <th>Event Time</th>
            <th>Event Manager</th>
            <th>Estimated No. of Attendence of guest for the Event </th>
            <th>Proposed Registration cost for a each person</th>
            <th>Actual Expence</th>
            <th>Budget Expence</th>
            </tr>
            

           ';
        foreach ($eventreport as $ereport)
        {
            $output .='        
                <tbody>
                <tr>           
                    <td>'.$ereport->customer_name.'</td>                    
                    <td>'.$ereport->event_date.' </td>                   
                    <td>'.$ereport->event_time.'</td>                    
                    <td>'.$ereport->event_manager.'</td>                   
                    <td>'.$ereport->attendence.'</td>
                    <td>'.$ereport->cost.'</td>      
                    <td>'.$ereport->etotal.'</td>
                     <td>'.$ereport->btotak.'</td>
                 

                </tr>

                </tbody>';
        }
        $output.='</table>';
        return $output;

    }

    public function search(Request $request){

        $search =$request->get('search');
        $eventreport = DB::table('event_reports')->where('customer_name', 'like','%'.$search.'%')->paginate(5);
        return view('e_report.index', ['eventreport' => $eventreport]);
    }

}
