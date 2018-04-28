@extends('layouts.layout')

@section('title')
    Продукты
@endsection

@section('content')
    <div class="col-xs-10 col-xs-offset-1">
        <table id="products-table">
            <thead>
                <tr class='header-wrap'>
                    <td class='header-wrap' rowspan="1">ID продукта</td>
                    <td class='header-wrap' rowspan="1">Название партнера</td>
                    <td class='header-wrap' colspan="1">Поставщик</td>
                    <td class='header-wrap' colspan="1">Цена</td>
                </tr>
            </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td class="product_id">
                           <span>{{$product->id}}</span>
                        </td>
                        <td>
                            {{$product->name}}
                        </td>
                        <td>
                            {{$product->vendor->name}}
                        </td>
                        <td>
                            <span class="price">{{$product->price}}</span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
        </table>
        <div class="col-xs-12 pagination-block">
            <?php echo $products->render(); ?>
        </div>
    </div>

{{--Модальное окно для смены цены --}}
    <div id="change-price-modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Укажите новую цену</h4>
                </div>
                <div class="modal-body">
                    <input type="text" class="new-price" name="new-price">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary save-price" data-dismiss="modal">Сохранить изменения</button>
                </div>
            </div>
        </div>
    </div>
@endsection
