<div class="container-fluid">

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">	
      <h2 class="page-header">Registros</h2>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Nome</center</th>
              <th>Email</th>
              <th>cpf</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($records as $record){ 

                //$datetime = explode(" ",$record->datetime);
                //$date = explode("-",$datetime[0]);
                echo '<tr>';
                        echo '<td>'.$record->nome.'</td>';
                        echo '<td>'.$record->email.'</td>';
                        echo '<td>'.$record->cpf.'</td>';             
                echo '</tr>';
            } ?>
              
               <?php/* foreach($records as $record){ 

                $datetime = explode(" ",$record->datetime);
                $date = explode("-",$datetime[0]);
                echo '<tr>';
                        echo '<td>'.$date[2].'/'.$date[1].'/'.$date[0].'</td>';
                        echo '<td>'.$datetime[1].'</td>';
                        //se for imagem mostrar no primeiro modal, senão mostrar no segundo
                        if($record->mediatype == 'image'){
                            echo '<td><a href="#" data-toggle="modal" data-target="#myModal" src="'.$record->url.'">Clique aqui</a></td>';
                        }else{
                            echo '<td><a href="#" data-toggle="modal" data-target="#myModal2" src="'.$record->url.'">Clique aqui</a></td>';
                        }
                        if($record->validated == 'true'){
                            echo '<td><input type="button" class="btn btn-info btn-xs" value="Validado" disabled></td>';
                        }else{
                            echo '<td><a role="button" class="btn btn-warning btn-xs" href="' . base_url('nurse/validate/'.$record->id.'/'.$record->iduser). '">Validar</a></td>';
                        }
                echo '</tr>';
            }*/ ?>
              
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>