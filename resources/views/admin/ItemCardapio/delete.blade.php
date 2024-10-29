@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Confirm Deletion</h4>
    <p>Are you sure you want to delete the item <strong>{{ $itemCardapio->nome }}</strong>?</p>
    <p>This action cannot be undone.</p>

    <div class="actions">
        <form action="{{ route('itemCardapio.destroy', $itemCardapio->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn red">Yes, Delete</button>
            <a href="{{ route('itemCardapio.index') }}" class="btn grey">Cancel</a>
        </form>
    </div>
</div>

<style>
    .actions {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }
</style>
@endsection
