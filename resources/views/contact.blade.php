<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajax Todo List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>

<div class="container mt-4">
    <div id="todo">
        <div class="row">
            <div class="col-md-6 m-auto">
                <div class="card">
                    <div class="card-header bg-light text-light">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="text-primary">Add New Item</h4>
                            </div>
                            <div class="col-md-6">
                                <a href="#" id="addItemBtn" data-toggle="modal" data-target="#todoModal"
                                   class="btn btn-primary float-right">
                                    <i class="fa fa-plus fa-fw"></i>Add new</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($contacts as $key => $contact)
                            <li class="list-group-item ourItem" data-toggle="modal"
                                data-target="#todoModal">{{ $contact->name }}
                                {{--<span class="pr-2">{{ $key +1 }}</span>--}}
                                <input type="hidden" id="itemId" value="{{ $contact->id }}">
                            </li>
                            @endforeach
                        </ul>
                        <p>{{ $contacts->links() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="todoModal" tabindex="-1" role="dialog" aria-labelledby="todoModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Add New Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{--<form action="{{ route('contact.store') }}" method="POST">--}}
            {{--@csrf--}}
            {{--@method('POST')--}}
            <div class="modal-body">
                <input type="hidden" id="id">
                <p><input type="text" name="name" placeholder="Write item name"
                          id="addItem" class="form-control"></p>
            </div>
            <div class="modal-footer">
                <button type="submit" data-dismiss="modal" class="btn btn-danger btn-sm" id="deleteItem">
                    <i class="fa fa-trash"></i>
                    DELETE</button>
                <button type="submit" data-dismiss="modal" class="btn btn-success btn-sm" id="updateItem">
                    <i class="fa fa-sync"></i>
                    UPDATE</button>
                <button type="submit" data-dismiss="modal" class="btn btn-success btn-sm" id="addNewItem">
                    <i class="fa fa-plus"></i>
                    SAVE</button>
            </div>
            {{--</form>--}}
        </div>
    </div>
</div>

{{--@csrf--}}
{{ csrf_field() }}




<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        $(document).on('click', '.ourItem', function () {
            var text = $(this).text();
            var id = $(this).find('#itemId').val();
            var text = $.trim(text);
            $('#addItem').val(text);
            $('#title').text('Edit Item');
            $('#deleteItem').show('400');
            $('#updateItem').show('400');
            $('#addNewItem').hide('400');
            $('#id').val(id);
            console.log(text);
        });
        // $('.ourItem').each(function () {
        //     $(this).click(function () {
        //         var text = $(this).text();
        //         var id = $(this).text();
        //         $('#addItem').val(text);
        //         $('#title').text('Edit Item');
        //         $('#deleteItem').show('400');
        //         $('#updateItem').show('400');
        //         $('#addNewItem').hide('400');
        //         $('#id').val(id);
        //         console.log(text);
        //     })
        // });
        $(document).on('click', '#addItemBtn', function () {
            $('#deleteItem').hide('400');
            $('#updateItem').hide('400');
            $('#addNewItem').show('400');
        });
        // $('#addItemBtn').click(function () {
        //     $('#deleteItem').hide('400');
        //     $('#updateItem').hide('400');
        //     $('#addNewItem').show('400');
        // });
        $(document).on('click', '#addNewItem', function () {
            var text = $('#addItem').val();
            if (text == ""){
                alert('Please type a item name.');
            }else {
                $.post(
                    'contact',
                    {'name': text, '_token': $('input[name=_token]').val()},function (data) {
                        console.log(data);
                        $('#todo').load(location.href + ' #todo');
                    });
            }

        });
        // $('#addNewItem').click(function () {
        //     var text = $('#addItem').val();
        //     $.post(
        //         'contact',
        //         {'name': text, '_token': $('input[name=_token]').val()},function (data) {
        //              console.log(data);
        //             $('#todo').load(location.href + ' #todo');
        //         });
        // });
        
        $('#deleteItem').click(function () {
            var id = $('#id').val();
            $.post('contact.delete',
                {'id': id, '_token': $('input[name=_token]').val()},
            function (data) {
                console.log(data);
                $('#todo').load(location.href + ' #todo');
            });
        });

        $('#updateItem').click(function () {
            var id = $('#id').val();
            var value = $('#addItem').val();
            $.post('contact.update',
                {
                    'id': id,
                    'name': value,
                    '_token': $('input[name=_token]').val()},
                function (data) {
                    $('#todo').load(location.href + ' #todo');
                    console.log(data);
                });
        });

    });
</script>
</body>
</html>
