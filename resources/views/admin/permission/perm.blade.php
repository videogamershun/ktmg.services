@extends('layouts.app')

@section('content')
@if (session('status'))
<script>
    swal("Siker!", "{{ session('status') }}!", "success");
</script>
@endif

    <br />

    <section class="content">

        <div class="card card-solid ">
            <div class="card-body pb-0 ">

                <div class="d-flex align-items-stretch flex-column">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Permission</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ url('create_new_perm') }}" method="post">
                            @csrf

                            <div class="card-body">

                                <div class="form-group">
                                    <label>Permission - megnevezése</label>
                                    <input type="text" class="form-control" name="permName"
                                        placeholder="index.home">
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Létrehozás</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        </div>



    </section>
    <script>
        $('#selector').select2({
            width: '100%',
            placeholder: "Adj hozzá jogot",
            allowClear: true,
        });
    </script>
@endsection
