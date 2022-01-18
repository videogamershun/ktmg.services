@extends('layouts.app')

@section('content')
<br/>
  
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
                    <form>
           
                      <div class="card-body">
                        <div class="form-group">
                            <label>Esemény - létrehozó</label>
                            <input type="text" class="form-control" placeholder="{{ Auth::user()->name; }}" disabled>
                          </div>              
                        <div class="form-group">
                            <label>Mikor:</label>
                              <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                  <input type="date" class="form-control datetimepicker-input"  id="birthday" name="birthday">
                              </div>
                          </div>
                          <div class="form-group">
                            <label>Esemény - láthatóság</label>
                            <select class="form-control select2" style="width: 100%;">
                              <option selected="selected">Publikus</option>
                              <option>DÖK</option>
                            </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Maximum létszám</label>
                          <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Maximum létszám: 20">
                        </div>    
                        <div class="form-group">
                                <label>Osztály:</label>
                                <select id="selector" name="hobby[]" multiple>
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
                                    <div class="editor">
                         
                                    </div>
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
<script>ClassicEditor
        .create( document.querySelector( '.editor' ), {
            
            licenseKey: '',
            
            
            
        } )
        .then( editor => {
            window.editor = editor;
    
            
            
            
        } )
        .catch( error => {
            console.error( 'Oops, something went wrong!' );
            console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
            console.warn( 'Build id: blnkaf5i3jfd-nohdljl880ze' );
            console.error( error );
        } );
</script>

@endsection
