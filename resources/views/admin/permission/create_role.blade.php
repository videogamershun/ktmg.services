@extends('layouts.app')

@section('content')
<br/>
  
  <section class="content">

    <div class="card card-solid ">
      <div class="card-body pb-0 ">

          <div class="d-flex align-items-stretch flex-column">
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Jogosultság - létrehozás</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{url('export_event')}}" method="post">
                      @csrf
           
                      <div class="card-body">
                        
                          <div class="form-group">
                            <label>Jogosultság - megnevezése</label>
                            <input type="text" class="form-control" name="name"  placeholder="Pályaválasztási tanácsadás">
                          </div>              
                        <div class="form-group">
                            <label>Mikor:</label>
                              <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                  <input type="date" name="event_date" class="form-control datetimepicker-input">
                              </div>
                          </div>
                          <div class="form-group">
                            <label>Esemény - láthatóság</label>
                            <select class="form-control select2" name="publicity" style="width: 100%;">
                              <option selected="selected">Publikus</option>
                              <option>DÖK</option>
                            </select>
                        </div>
                        <div class="form-group">
                          <label>Maximum létszám</label>
                          <input type="number" class="form-control" name="max_members" placeholder="Maximum létszám: 20">
                        </div>    
                        <div class="form-group">
                                <label>Osztály:</label>
                                <select id="selector" name="years[]" multiple>
                                  <optgroup label="12. évfolyam">
              
                                  <option selected="selected">12.F</option>
                                  <option>12.D</option>
                                </optgroup>
                                <optgroup label="11. évfolyam">
              
                                    <option>11.C</option>
                                </optgroup>
                                <optgroup label="10. évfolyam">
              
                                    <option>10.B</option>
                                  </optgroup>
                                  <optgroup label="9. évfolyam">
              
                                    <option>9.A</option>
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


@endsection
