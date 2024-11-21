@extends('adminlte::page')

@section('title', 'Predicciones')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Predicción de Ventas</h3>
                    </div>
                    <div class="card-body">
                        <iframe
                            src="http://localhost:8501"
                            width="100%"
                            height="800"
                            frameborder="0"
                            style="overflow:hidden"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        iframe {
            min-height: 800px;
        }
    </style>
@endsection
