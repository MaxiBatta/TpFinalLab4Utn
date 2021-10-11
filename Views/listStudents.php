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
                    <th>Apellido</th>
                    <th>Nombre</th>
                </thead>
                <tbody>
                    <?php
                     $Students = new StudentDAO();
                    $Students->GetAll();
                     foreach($Students as $key => $value){ 
                     if($value->getActive()==1){
                           ?> <tr>
                               <td><?php echo $value->getStudentId()?></td>
                               <td><?php echo $value->getFirstName()?></td>
                               <td><?php echo $value->getFirstName()?></td>
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