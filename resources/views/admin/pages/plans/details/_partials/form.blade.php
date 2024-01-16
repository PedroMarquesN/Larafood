@include('admin.includes.alerts')
@csrf

<div class="form-group">
    <label>Detalhe:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{$detail->name ?? old('name')}}">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-info" placeholder="Nome">Enviar</button>
</div>