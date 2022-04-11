@extends('layouts.app')

@section('content')
    <?php
    
    function userHasPermission()
    {
        if (Auth::user()->hasPermissionTo('admin.event.create')) {
        } else {
            header('Location: /home');
            die();
        }
    }
    userHasPermission();
    
    ?>


    <br />

    <section class="content">

        <div class="card card-solid ">
            <div class="card-body pb-0 ">

                <div class="d-flex align-items-stretch flex-column">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Esemény - létrehozás</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ url('export_event') }}" method="post">
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label>Esemény - létrehozó</label>
                                    <input type="text" class="form-control" name="owner" value="{{ Auth::user()->id }}"
                                        hidden>
                                    <input type="text" class="form-control"  value="{{ Auth::user()->name }}"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label>Esemény - megnevezése</label>
                                    <input type="text" class="form-control" name="name"
                                        placeholder="Pályaválasztási tanácsadás">
                                </div>
                                <div class="form-group">
                                    <label>Mikor:</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="date" name="event_date" class="form-control datetimepicker-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Maximum létszám</label>
                                    <input type="number" class="form-control" name="max_members"
                                        placeholder="Maximum létszám: 20">
                                </div>
                                <div class="form-group">
                                    <label>Osztály:</label>
                                    <select id="selector" name="years[]" multiple>
                                        <optgroup label="12. évfolyam">
                                            <option>12.A</option>
                                            <option>12.B</option>
                                            <option>12.C</option>
                                            <option>12.D</option>
                                            <option>12.F</option>
                                        </optgroup>
                                        <optgroup label="11. évfolyam">
                                            <option>11.A</option>
                                            <option>11.B</option>
                                            <option>11.C</option>
                                            <option>11.D</option>
                                            <option>11.F</option>
                                        </optgroup>
                                        <optgroup label="10. évfolyam">
                                            <option>10.A</option>
                                            <option>10.B</option>
                                            <option>10.C</option>
                                            <option>10.D</option>
                                            <option>10.F</option>
                                        </optgroup>
                                        <optgroup label="9. évfolyam">
                                            <option>9.A</option>
                                            <option>9.B</option>
                                            <option>9.C</option>
                                            <option>9.D</option>
                                            <option>9.F</option>
                                            <option>9.AJTP</option>
                                        </optgroup>
                                        <optgroup label="Egyéb">
                                            <option>Iskola</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">

                                    <div class="centered">
                                        <div class="editor-container">
                                            <textarea class="form-group" id="editor" name="content"></textarea>

                                        </div>
                                    </div>
                                </div>


                            </div>
                            <!-- /.card-body -->

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
            placeholder: "Válassz osztályt",
            allowClear: true,
        });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
