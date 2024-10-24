@extends('admin.layouts.principal')

@section('conteudo-principal')

<section class="section container">
    @if($errors->any())
        <span style="color: #ff0000">
            @foreach ($errors->all() as $error)
                {{ $error}}<br>
            @endforeach
        </span>
        <br>
    @endif

    <!-- Adiciona o componente Livewire -->
    
    <livewire:cliente-form />
        
    
</section>

@endsection
