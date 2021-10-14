<?php require_once(VIEWS_PATH."nav.php"); 
use DAO\CompanyDAO as CompanyDAO;
use Models\Company as Company;
?>

<div class="container">
    <div id="box" class="row justify-content-center" style="background-color: #242424;">
      
        <div class="container">
        <form action="<?= FRONT_ROOT ?>Company/CompanySearch" method="POST" class="bg-light-alpha p-5">
            <div class="row align-items-center">
                
                <div class="col-md-4">
                    <div class="form-content">
                        <div class="form-group">
                        <select name= "" id """ class="form-control" >
                        <option value="" disabled selected> Seleccione </option>
                           <?php 
                                $company= new companyDao();
                                $companyList= $company->GetAll();
                                
                                  foreach($companyList as $company){
                            ?>
                                   <option value="<?=$company->getName()?>"><?=$company->getName()?></option>
                            <?php 
                                }
                            ?>
                        </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-content">
                        <div class="form-group">
                        <button  class="btn btn-primary" type="submit">Buscar</button>
                        </div>
                    </div>
                </div>
            </div>  
        </form>
            
        </div>
    </div>
</div>