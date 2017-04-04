#Uso de DataTables

1. Instalacion 
```bash
$ composer require yajra/laravel-datatables-oracle:^6.0
```
2. En el archivo `config/app.php` agregar.
```php
'providers' => [
    // ...
    Yajra\Datatables\DatatablesServiceProvider::class,
],
```
3. Luego ejecutar el siguiente comando
```bash
$ php artisan vendor:publish --tag=datatables
```
4. Con los modelos y controladores ya definidos, tambien lo que es **relationships**, En este caso utilizamos los modelos **label** con los atributos('id','name','slug') y  **track**  con los atributos ('id','title','release_date','label_id').
5. En el controlador de Track _TrackController_ definimos una funcion **getTracks**
    **Nota:**  
```php
public function getTracks(){
        $tracks = DB::table('labels')
                   ->join('tracks', 'labels.id', '=', 'tracks.label_id')
                   ->select(['labels.id AS label_id', 'labels.name','tracks.id AS track_id', 'tracks.title']);
        /*Con esa consulta  hacemos un join entre labels y tracks a traves del 
        id de labels y label_id de tracks
        Y con select-> seleccionamos las columnas que quermos mostrar en este caso mostramos las columnas
         label_id (labels), name (labels), id(Tracks), title (tracks))
        */
               return Datatables::of($tracks)
                   ->make(true);
                   /* y al final retornamos un Datatable de la variable ya definida $tracks */
    }
```
6. En la vista que queremos mostrar el datatable agregamos
```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tracks</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/dt-1.10.13/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/dt-1.10.13/datatables.min.js"></script>
</head>
<body>
    <h1>Here is Tracks</h1>
    <div class="container">
        <table id="track" class="table table-hover table-condensed">
            <thead>
            <tr>
                <th>Label id</th>
                <th>label name</th>
                <th>track title</th>
                <th>track title</th>
            </tr>
            </thead>
        </table>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            var oTable = $('#track').DataTable({
                "dom": '<"top"if>rt<"col-sm-7"p><"row"><"col-sm-4"l>',
                bInfo: true,
                bLengthChange: true,
                bFilter: true,
                processing: true,
                serverSide: true,
                lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
                scrollY:        400,
                deferRender:    true,
                scroller:       true,
                ajax: "{{ route('datatable.tracks') }}",
                columns: [
                    {data: 'label_id', name: 'label_id'},
                    {data: 'name', name: 'name'},
                    {data: 'track_id', name: 'track_id'},
                    {data: 'title', name: 'title'}
                ],
                search: {
                    "regex": true
                }
            });
        });
    </script>
</body>
</html>
```

**Notas de codigo:**
Librerias de bootstrap y datatables 
```html
<!--libreria de Bootstrap-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!--libreria de Datatables-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/dt-1.10.13/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/dt-1.10.13/datatables.min.js"></script>
```

Dentro del body del html definimos una tabla con un **id**, dentro incluimos las cabeceras, en este caso son *label_id* *label name* *track title* *track title*.
```html
<table id="track" class="table table-hover table-condensed">
    <thead>
        <tr>
            <th>Label id</th>
            <th>label name</th>
            <th>track title</th>
            <th>track title</th>
        </tr>
    </thead>
</table>
```

y dentro de las etiquetas **script**, definimos una variable *oTable* al que se le asigna el 'id' de la tabla creada anteriormente y luego utilizamos el metodo de 'DataTable'.
En el cual escribimos las opciones para configurar el datatable
los mas importantes son:
**ajax** donde especificamos la ruta 'datatable.tracks (definido en las rutas de laravel `web.php`)
```php
Route::get('/tracks', 'TrackController@index');
Route::get('/tracksData', 'TrackController@getTracks')->name('datatable.tracks');

```
**columns** donde nombramos las columnas que seleccionamos en el paso **5**, en este caso seleccionamos las columnas label_id, name, track_id, title

**bInfo** Nos muestra un select de la cantidad a mostrar.
**bFilter** Nos muestra un input para realizar filtros.


```html
<script type="text/javascript">
        $(document).ready(function() {
            var oTable = $('#track').DataTable({
                "dom": '<"top"if>rt<"col-sm-7"p><"row"><"col-sm-4"l>',
                bInfo: true,
                bLengthChange: true,
                bFilter: true,
                processing: true,
                serverSide: true,
                lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
                scrollY:        400,
                deferRender:    true,
                scroller:       true,
                ajax: "{{ route('datatable.tracks') }}",
                columns: [
                    {data: 'label_id', name: 'label_id'},
                    {data: 'name', name: 'name'},
                    {data: 'track_id', name: 'track_id'},
                    {data: 'title', name: 'title'}
                ],
                search: {
                    "regex": true
                }
            });
        });
    </script>
```

