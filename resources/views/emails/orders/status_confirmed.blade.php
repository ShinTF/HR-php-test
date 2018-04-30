<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Заказ {{$data['id']}} звершен</title>

        <style type="text/css">
            body{
                text-align: center;
            }
            table{
                width: 700px;
            }
            .header{
                width: 100%;
                padding: 10px;
                font-size: 18px;
                text-align: center;
            }
            .empty{
                height: 50px;
                width: 100%;
            }
            .name-title, .price-title, .total-title, .total-sum{
                text-align: center;
                font-size: 18px;
                border: 2px solid grey;
            }
            .name-title, .name, .total-title{
                text-align: center;
                width: 70%;
            }
            .price-title, .price, .total-sum{
                text-align: center;
                width: 30%;
            }

        </style>
    </head>
    <body>
        <table cellpadding="0" cellspacing="0" border="0" style="margin:20px 0; padding:0; width:100%;">
            <tr>
               <td class="header">
                    Заказ {{$data['id']}} завершен
               </td>
            </tr>
            <tr>
                <td class="empty">
                </td>
            </tr>
            <tr>
                <td class="name-title">
                    Наименование товара
                </td>
                <td class="price-title">
                    Стоимость товара
                </td>
            </tr>
            @foreach($data['product_list'] as $product)
                <tr>
                    <td class="name">
                        {{$product['name']}}
                    </td>
                    <td class="price">
                        {{$product['price']}}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td class="total-title">
                    Итоговая стоимость
                </td>
                <td class="total-sum">
                    {{$data['total_sum']}}
                </td>
            </tr>
        </table>
    </body>
</html>
