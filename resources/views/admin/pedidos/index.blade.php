@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col s4">
        <div class="card-panel orange lighten-1 center-align">
          <i class="material-icons">search</i>
          <h5>Em análise</h5>
          <p>{{ $produtosPendentes }}</p> 
          <p>Nenhum pedido no momento. Compartilhe os seus links nas redes sociais e receba pedidos!</p>
        </div>
      </div>
      <div class="col s4">
        <div class="card-panel yellow lighten-1 center-align">
          <i class="material-icons">build</i>
          <h5>Em produção</h5>
          
          <p>Receba pedidos e visualize os que estão em produção</p>
        </div>
      </div>
      <div class="col s4">
        <div class="card-panel green lighten-1 center-align">
          <i class="material-icons">check_circle</i>
          <h5>Prontos para entrega</h5>
          <p>0</p>
          <p>Receba pedidos e visualize os prontos para entrega.</p>
        </div>
      </div>
    </div>
    <div class="row">
      {{-- <div class="col s6">
        <p>Balcão: Não informado</p>
      </div>
      <div class="col s6">
        <a class="waves-effect waves-light btn">Editar Delivery</a>
      </div> --}}
    </div>
  </div>
</body>
</html>
@endsection