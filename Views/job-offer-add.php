<?php
     require_once('nav.php');

     use Controllers\Company as Company;
     use DAO\CompanyDao as CompanyDAO;
     
     $companyDAO = new CompanyDAO();
     $companiesList = $companyDAO->GetAllMySql();
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregando Ofertas laborales</h2>
               <form action="<?php echo FRONT_ROOT ?>JobOffer/Add" method="post" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4 ml-10">
                              <div class="form-group">
                                   <label for="jobPositionId">Posicion de trabajo</label>
                                   <select name="jobPositionId">
                                   <option value="1" selected>Ingeniero naval jr</option>
                                   <option value="2" >Ingeniero naval ssr</option>
                                   <option value="3">Ingeniero naval sr</option>
                                   <option value="4">Ingeniero de pesca jr</option>
                                   <option value="5">Ingeniero pesquero ssr</option>
                                   <option value="6">Ingeniero senior de pesca</option>
                                   <option value="7">Desarrollador Java Jr</option>
                                   <option value="8">Desarrollador PHP Jr</option>
                                   <option value="9">Ssr develope</option>
                                   <option value="10">Full Stack developer</option>
                                   <option value="11">Sr developer</option>
                                   <option value="12">Project manager</option>
                                   <option value="13">Scrum Master</option>
                                   <option value="14">Jr textile operator</option>
                                   <option value="15">Textile production assistant manager</option>
                                   <option value="16">Textile design assistant</option>
                                   <option value="17">Textile production supervisor</option>
                                   <option value="18">Head of administration</option>
                                   <option value="19">Management analyst</option>
                                   <option value="20">Administration intern</option>
                                   <option value="21">Environmental management specialist</option>
                                   <option value="22">Environmental management coordinator</option>
                                   <option value="23">Received technician</option>
                                   </select>
                              </div>
                         </div>
                         <div class="col-lg-4 ">
                              <div class="form-group">
                                   <label for="companyId">Empresa</label><br>
                                   <select name="companyId">
                                   <option value="6" selected>Jail Ismael Valenzuela </option>
                                   </select>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="dateTime">Fecha de comienzo</label>
                                   <input type="date" name="dateTime" id = "dateTime" value="" class="form-control" min="1950-01-01" step="1" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="limitDate">Fecha Limite</label>
                                   <input type="date" name="limitDate" id = "limitDate" value="" class="form-control" min="tomorrow" step="1" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="state">Estado</label>
                                   <input type="text" name="state" id= "state" value="" class="form-control" required>
                              </div>
                         </div>
                         
                      
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                
                    <a href="<?php echo FRONT_ROOT . 'Administrator/ShowPanelView' ?>" class="btn btn-primary">Volver</a> 
                    <button type="submit" class="btn btn-dark ml-auto d-block">Agregar</button> 
               </div>
                    
               </div>

               
                   
               </form>
          </div>
     </section>
     <?php
          if (isset ($message))
          echo $message;
     ?>

</main>