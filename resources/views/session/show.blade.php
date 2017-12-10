@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Session Details
                </div>

                <div class="panel-body">
                    <div class="form-group">
                        <table width="100%">
                            <tr>
                                <td width="10%"><strong>Session Type</strong></td>
                                <td>: {{ $session->session_type }}</td>
                            </tr>
                            <tr>
                                <td><strong>Place/Venue</strong></td>
                                <td>: {{ $session->place }}</td>
                            </tr>
                            <tr>
                                <td><strong>Date & Time</strong></td>
                                <td>: {{ $session->session_date }} {{ $session->session_time }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    Agenda/s
                </div>

                <div class="panel-body">                    
                    @if($session->agendas()->count() > 0)
                        <div class="panel-group">
                        @foreach($session->agendas as $key => $agenda)                             
                              <div class="panel panel-success">
                                <div class="panel-heading">
                                  <h4 class="panel-title">
                                    #{{ $key+1 }} {{ $agenda->title }}
                                  </h4>
                                </div>
                                <div id="collapse{{ $key }}" class="panel-collapse collapsed">
                                    <div class="panel-body">
                                        <div style="text-decoration: underline;">Proponents</div>
                                        @if(!is_null($agenda->proponents))
                                        <ul>
                                            @foreach (explode('###', $agenda->proponents) as $proponent)
                                                <li>{{ \App\Proponent::find($proponent)->name }}</li>
                                            @endforeach
                                        </ul>                                            
                                        @endif


                                        @if($agenda->attachments()->count() > 0)
                                            <div style="text-decoration: underline">Attachments</div>
                                            <ul>
                                                @foreach ($agenda->attachments as $attachment)
                                                    <li>
                                                        <a href="{{ asset("storage/$attachment->path") }}" target="_blank">{{ $attachment->filename }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                              </div>                            
                        @endforeach
                        </div> 
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
