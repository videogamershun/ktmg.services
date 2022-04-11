@extends('layouts.app')

@section('content')
    <?php
    
    function userHasPermission()
    {
        if (Auth::user()->hasPermissionTo('admin.user.index')) {
        } else {
            header('Location: /home');
            die();
        }
    }
    
    userHasPermission();
    
    ?>

    <br />

    <section class="content">




        <div class="d-flex align-items-stretch flex-column">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Esemény - módósítás</h3>
                </div>
                <!-- /.card-header -->




                <!-- form start -->
                <form action="{{ url('create_users') }}" method="post">
                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-3">
                                        <input type="text" class="form-control" placeholder="Felhasználó azonosító"
                                            disabled>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" placeholder="Jelszó" disabled>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" placeholder="Osztály" disabled>
                                    </div>
                                </div>
                                <br />
                                <div id="inputFormRow">
                                    <div class="row">

                                        <div class="col-3">
                                            <input type="text" class="form-control" placeholder="gipsz.jakab"
                                                name="name[]">
                                        </div>
                                        <div class="col-3">
                                            <input type="text" class="form-control" placeholder="12345678"
                                                name="password[]">
                                        </div>
                                        <div class="col-3">

                                            <div class="form-group">
                                                <select class="custom-select rounded-0" id="exampleSelectRounded0"
                                                    name="years[]">
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
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="newRow"></div>
                                    <button id="addRow" type="button" class="btn btn-info">Hozzáadás</button>

                                    <button type="submit" class="btn btn-primary">Mentés</button>

                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->


                </form>
            </div>
        </div>






    </section>
    <script type="text/javascript">
        // add row
        $("#addRow").click(function() {
            var html = '';
            html += '<div id="inputFormRow">';
            html +=
                '<div class="row"><div class="col-3"><input type="text" class="form-control" placeholder="gipsz.jakab" name="name[]"></div><div class="col-3"><input type="text" class="form-control" placeholder="12345678" name="password[]"></div><div class="col-3"><div class="form-group"><select class="custom-select rounded-0" name="years[]"><optgroup label="12. évfolyam"><option>12.A</option><option>12.B</option><option>12.C</option><option>12.D</option><option>12.F</option></optgroup><optgroup label="11. évfolyam"><option>11.A</option><option>11.B</option><option>11.C</option><option>11.D</option><option>11.F</option></optgroup><optgroup label="10. évfolyam"><option>10.A</option><option>10.B</option><option>10.C</option><option>10.D</option><option>10.F</option></optgroup><optgroup label="9. évfolyam"><option>9.A</option><option>9.B</option><option>9.C</option><option>9.D</option><option>9.F</option><option>9.AJTP</option></optgroup></select></div></div><div class="col-2"><button id="removeRow" type="button" class="btn btn-danger">Törlés</button></div></div></div>';
            html += '</div>';

            $('#newRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeRow', function() {
            $(this).closest('#inputFormRow').remove();
        });
    </script>
@endsection
