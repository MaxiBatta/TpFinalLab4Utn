<?php
    require_once('nav.php');
?>
<main class="py-5">
<section id="listado" class="mb-5">
          <div class="container">
              <h2 class="mb-4">Listado de estudiantes</h2>
              <table>
                <thead>
                    <th>Legajo</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    
                </thead>
                <tbody>
                    <?php
                     $Students;
                     $Studentslist = $Students->GetAll();
                     foreach($Studentslist as $key => $value){ 
                     if($value->getActive()==true){
                           ?> <tr>
                               <td><?php echo $value->getStudentId()?></td>
                               <td><?php echo $value->getFirstName()?></td>
                               <td><?php echo $value->getlastName()?></td>
                           </tr>
                           <?php
                         }
                 
                     }
                     ?>
                     
                     
                </tbody>
              </table>
          </div>
          
     </section>
</main>